<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_matiere = $_POST['matiere'];
$id_professeur = $_POST['professeur'];

// Vérifier si id_matiere est NULL dans la table professeur_matiere
$query = "SELECT id_matiere FROM professeur_matiere WHERE id_professeur = :id_professeur";
$stmt = $bdd->prepare($query);
$stmt->execute(['id_professeur' => $id_professeur]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupération du nom de la matière
$query_matiere = "SELECT nom_matiere FROM matiere WHERE id_matiere = :id_matiere";
$stmt_matiere = $bdd->prepare($query_matiere);
$stmt_matiere->execute(['id_matiere' => $id_matiere]);
$result_matiere = $stmt_matiere->fetch(PDO::FETCH_ASSOC);
$nom_matiere = $result_matiere['nom_matiere'];

// Récupération du nom du professeur
$query_professeur = "SELECT Nom_prof FROM professeur WHERE id_professeur = :id_professeur";
$stmt_professeur = $bdd->prepare($query_professeur);
$stmt_professeur->execute(['id_professeur' => $id_professeur]);
$result_professeur = $stmt_professeur->fetch(PDO::FETCH_ASSOC);
$nom_professeur = $result_professeur['Nom_prof'];



if (is_array($result) && $result['id_matiere'] === NULL) {
    // Mettre à jour id_matiere dans la table professeur_matiere
    $sql = "UPDATE professeur_matiere SET id_matiere = :id_matiere WHERE id_professeur = :id_professeur";
    $requete = $bdd->prepare($sql);
    $requete->execute(array(
        'id_matiere' => $id_matiere,
        'id_professeur' => $id_professeur
    ));
    $message = "La matière $nom_matiere a été affectée au professeur $nom_professeur.";
} else {
    // Insérer une nouvelle ligne dans la table professeur_matiere
    $sql = "INSERT INTO professeur_matiere (id_professeur, id_matiere) VALUES (:id_professeur, :id_matiere)";
    $requete = $bdd->prepare($sql);
    $requete->execute(array(
        'id_professeur' => $id_professeur,
        'id_matiere' => $id_matiere
    ));
    $message = "La matière $nom_matiere a été affectée au professeur $nom_professeur.";
}

// Afficher l'alerte en fonction de l'action effectuée
if ($requete->rowCount() > 0) {
    echo '<script>alert("Succes : ' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Affecter_Mat-Prof.php";
        </script>';
    exit();
}
