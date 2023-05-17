<?php
session_start();

try {
	$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$matiere = $_POST['matiere'];
$classe = $_POST['classe'];
$nom_competence = $_POST['nom_competence'];

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

// Lien entre la nouvelle compétence et tous les étudiants de la classe
$sql3 = "INSERT INTO competence_etudiant (id_competences, id_etudiant) SELECT :id, id_etudiant FROM etudiant WHERE id_classe = :classe";
$requete2 = $bdd->prepare($sql3);
$requete2->execute(array(
	'id' => $nouvel_id,
	'classe' => $classe
));

// Redirection vers la page d'accueil étudiant
header("Location: page_accueil_etudiant.php");
exit;
?>
