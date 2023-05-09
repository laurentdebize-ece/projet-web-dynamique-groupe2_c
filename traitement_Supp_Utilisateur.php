<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

// Suppression de l'utilisateur dans la base de données
$sql = "DELETE FROM utilisateur WHERE Nom = :nom AND Prenom = :prenom AND email = :email";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email
));

// Redirection vers la page d'accueil
header("Location: page_accueil_etudiant.php");
exit;
?>