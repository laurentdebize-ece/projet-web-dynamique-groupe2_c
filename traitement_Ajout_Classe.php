<?php
session_start();

try {
	$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom_classe = $_POST['classe'];

// Récupération du nouvel ID
$sql = "SELECT MAX(id_classe) as max_id FROM classe";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la base de données
$sql = "INSERT INTO classe (id_classe, nom_classe, id_promotion) VALUES (:id, :nom_classe, 1)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom_classe' => $nom_classe,
));

// Redirection vers la page d'identification
header("Location: page_accueil_etudiant.php");
exit;
?>
