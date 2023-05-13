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

$sql2 = "DELETE FROM competences_matieres WHERE id_competence = :id_competences";
$requete2 = $bdd->prepare($sql2);
$requete2->execute(array(
    'id_competences' => $id_competences
));


$sql3 = "DELETE FROM competences WHERE id_competences = :id_competences";
$requete3 = $bdd->prepare($sql3);
$requete3->execute(array(
    'id_competences' => $id_competences
));

// Redirection vers la page d'accueil
header("Location: page_accueil_etudiant.php");
exit;
?>
