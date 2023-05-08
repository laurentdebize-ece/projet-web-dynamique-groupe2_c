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
$mot_de_passe = $_POST['mot_de_passe'];

// Récupération du nouvel ID
$sql = "SELECT MAX(Id_utilisateur) as max_id FROM utilisateur";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la base de données
$sql = "INSERT INTO utilisateur (Id_utilisateur, Nom, Prenom, email, mot_de_passe) VALUES (:id, :nom, :prenom, :email, :mot_de_passe)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom' => $nom,
	'prenom' => $prenom,
	'email' => $email,
	'mot_de_passe' => $mot_de_passe
));

// Redirection vers la page d'identification
header("Location: page_accueil_etudiant.php");
exit;
?>
