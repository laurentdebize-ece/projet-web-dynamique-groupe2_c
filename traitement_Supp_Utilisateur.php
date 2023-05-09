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

// Suppression de l'étudiant de la table 'etudiant'
$sql = "DELETE FROM etudiant WHERE id_utilisateur IN (
          SELECT Id_utilisateur FROM utilisateur
          WHERE Nom = :nom AND Prenom = :prenom AND email = :email)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email
));


// Suppression du professeur de la table 'professeur'
$sql = "DELETE FROM professeur WHERE id_utilisateur IN (
    SELECT Id_utilisateur FROM utilisateur
    WHERE Nom = :nom AND Prenom = :prenom AND email = :email)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
'nom' => $nom,
'prenom' => $prenom,
'email' => $email
));


// Suppression de l'utilisateur de la table 'utilisateur'
$sql2 = "DELETE FROM utilisateur WHERE Nom = :nom AND Prenom = :prenom AND email = :email";
$requete2 = $bdd->prepare($sql2);
$requete2->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email
));

// Redirection vers la page d'accueil
header("Location: page_accueil_etudiant.php");
exit;
?>
