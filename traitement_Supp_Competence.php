<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_competences = $_POST['competence'];

// Récupération du nom de la compétence
$sql1 = "SELECT nom_competences FROM competences WHERE id_competences = :id_competences";
$stmt = $bdd->prepare($sql1);
$stmt->execute(['id_competences' => $id_competences]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nom_competence = $result['nom_competences'];


$sql4 = "DELETE FROM competences_etudiants WHERE id_competence = :id_competences";
$requete4 = $bdd->prepare($sql4);
$requete4->execute(array(
    'id_competences' => $id_competences
));

$sql2 = "DELETE FROM competences_matieres WHERE id_competence = :id_competences";
$requete = $bdd->prepare($sql2);
$requete->execute(array(
    'id_competences' => $id_competences
));

$sql3 = "DELETE FROM competences WHERE id_competences = :id_competences";
$requete3 = $bdd->prepare($sql3);
$requete3->execute(array(
    'id_competences' => $id_competences
));



if ($requete->rowCount() > 0) {
    $message = "La compétence '$nom_competence' a été supprimée avec Succes";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Supp_Competence.php";
    </script>';
    exit();
}
