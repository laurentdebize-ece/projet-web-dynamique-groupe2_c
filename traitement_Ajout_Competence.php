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


// Récupération du nouvel ID
$sql = "SELECT MAX(id_competences) as max_id FROM competences";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la base de données
$sql2 = "INSERT INTO competences (id_competences, nom_competences) VALUES (:id, :nom_competence)";
$requete = $bdd->prepare($sql2);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom_competence' => $nom_competence
));
// Insertion des données dans la base de données
$sql3 = "INSERT INTO competences_matieres (id_competence, id_matiere) VALUES (:id, :id_matiere)";
$requete = $bdd->prepare($sql3);
$requete->execute(array(
	'id' => $nouvel_id,
	'id_matiere' => $id_matiere
));

// Redirection vers la page d'identification
header("Location: page_accueil_etudiant.php");
exit;
?>
