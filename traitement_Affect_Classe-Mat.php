<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

$id_matiere = $_POST['matiere'];
$id_classe = $_POST['classe'];

$query = "SELECT professeur.id_professeur
          FROM professeur
          JOIN professeur_matiere ON professeur.id_professeur = professeur_matiere.id_professeur
          JOIN matiere ON professeur_matiere.id_matiere = matiere.id_matiere
          WHERE professeur.id_professeur IN (
              SELECT professeur.id_professeur
              FROM professeur
              JOIN professeur_classe ON professeur.id_professeur = professeur_classe.id_professeur
              JOIN classe ON professeur_classe.id_classe = classe.id_classe
              WHERE classe.id_classe = :id_classe
          )
          AND matiere.id_matiere = :id_matiere";


$stmt = $bdd->prepare($query);
$stmt->execute(['id_classe' => $id_classe, 'id_matiere' => $id_matiere]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $id_professeur = $result['id_professeur'];

    // nom  matière
    $query = "SELECT nom_matiere FROM matiere WHERE id_matiere = :id_matiere";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id_matiere', $id_matiere, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $nom_matiere = $result['nom_matiere'];

    //  nom classe
    $query = "SELECT nom_classe FROM classe WHERE id_classe = :id_classe";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $nom_classe = $result['nom_classe'];



    // étudiants de la classe
    $query = "SELECT id_etudiant FROM etudiant WHERE id_classe = :id_classe";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
    $stmt->execute();
    $etudiants = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // on insere des étudiants dans la table etudiiant_matiere
    $query = "INSERT INTO etudiiant_matiere (id_etudiant, id_matiere, id_prof) VALUES (:id_etudiant, :id_matiere, :id_professeur)";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id_matiere', $id_matiere, PDO::PARAM_INT);
    $stmt->bindParam(':id_professeur', $id_professeur, PDO::PARAM_INT);

    foreach ($etudiants as $id_etudiant) {
        $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $stmt->execute();
    }

    if ($stmt->rowCount() > 0) {
        $message = "Les étudiants de la classe '$nom_classe' ont été ajoutés avec succès à la matière '$nom_matiere'.";
        echo '<script>alert("Succès : ' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
        exit();
    } else {
        echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Affecter_Matiere-Classe.php";
    </script>';
        exit();
    }
} else {
    echo '<script>alert("Aucun professeur correspondant trouvé.");
    window.location.href = "page_Affecter_Matiere-Classe.php";
    </script>';
        exit();
}
