<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom_competence = $_POST['nom_competence'];
$id_matiere = $_POST['matiere'];
$id_professeur = $_POST['professeur'];


// Vérification des données récupérées
if (isset($nom_competence) && isset($id_matiere)) {
    echo "Données récupérées avec succès";
} else {
    echo "Erreur lors de la récupération des données";
}


// Récupération du nouvel ID de compétence
$sql = "SELECT MAX(id_competence) as max_id FROM competences_transversales";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;


// Insertion des données dans la table "competences_transversales"
$sql2 = "INSERT INTO competences_transversales (id_competence, nom_competences, id_professeur) VALUES (:id, :nom_competence, :id_professeur)";
$requete = $bdd->prepare($sql2);
$requete->execute(array(
    'id' => $nouvel_id,
    'nom_competence' => $nom_competence,
    'id_professeur' => $id_professeur
));


//Selection des eleves appartenant a la classe a laquel un professeur appartient
$sql3 = "SELECT e.id_etudiant
        FROM etudiant e
        JOIN classe c ON e.id_classe = c.id_classe
        JOIN professeur_classe pc ON c.id_classe = pc.id_classe
        WHERE pc.id_professeur = :id_professeur";

$requete = $bdd->prepare($sql3);
$requete->bindParam(":id_professeur", $id_professeur);
$requete->execute();

$etudiants = $requete->fetchAll(PDO::FETCH_COLUMN);

// Insertion des données dans la table "compet_trans_etudiant" pour les étudiants de la classe du professeur
$sql4 = "INSERT INTO compet_trans_etudiant (id_competence, id_etudiant, Id_niveau_acquisition, commentaire, date_evaluation) 
         VALUES (:id, :id_etudiant, 1, '', NULL)"; // 1 correspond à 'non-acquis'
$requete = $bdd->prepare($sql4);
foreach ($etudiants as $etudiant) {
    $requete->execute(array(
        'id' => $nouvel_id,
        'id_etudiant' => $etudiant
    ));
}

// Insertion des données dans la table "compet_trans_matiere"
$sql5 = "INSERT INTO compet_trans_matiere (id_competence, id_matiere) VALUES (:id, :id_matiere)";
$requete = $bdd->prepare($sql5);
$requete->execute(array(
    'id' => $nouvel_id,
    'id_matiere' => $id_matiere
));

if ($requete->rowCount() > 0) {
    $message = "Succes : La compétence transversale '$nom_competence' a été ajoutée";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Ajout_Competence.php";
    </script>';
    exit();
}
