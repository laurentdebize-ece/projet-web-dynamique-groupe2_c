<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom_matiere = $_POST['nom_matiere'];
$volume_horaire = $_POST['volume_horaire'];

// Suppression de l'utilisateur dans la base de données
$sql = "DELETE FROM matiere WHERE nom_matiere = :nom_matiere AND volume_horaire = :volume_horaire";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'nom_matiere' => $nom_matiere,
    'volume_horaire' => $volume_horaire,
));

// Redirection vers la page d'accueil
header("Location: page_accueil_etudiant.php");
exit;
?>