<?php
try {
	$bdd = new PDO("mysql:host=localhost;dbname=famille;charset=utf8", "root", "root");
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$date_naissance = $_POST['date_naissance'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

// Récupération du nouvel ID
$sql = "SELECT MAX(ID) as max_id FROM membre";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la base de données
$sql = "INSERT INTO membre (ID, Nom, Prenom, `Date Naissance`, Statut) VALUES (:id, :nom, :prenom, :date_naissance, :mot_de_passe)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom' => $nom,
	'prenom' => $prenom,
	'date_naissance' => $date_naissance,
	'mot_de_passe' => $mot_de_passe
));

// Redirection vers la page d'identification
header("Location: identification.php");
exit;
?>
