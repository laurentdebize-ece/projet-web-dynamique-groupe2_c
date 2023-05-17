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

$sql = "UPDATE professeur_matiere SET id_matiere = :id_matiere WHERE id_professeur = :id_professeur";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'id_matiere' => $id_matiere,
    'id_professeur' => $id_professeur
));

// Redirection vers la page d'accueil étudiant
header("Location: page_accueil_etudiant.php");
exit;
