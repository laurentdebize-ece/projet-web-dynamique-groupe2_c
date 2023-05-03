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
$statut = $_POST['statut'];
$date_naissance = $_POST['date_naissance'];

// Récupération du nouvel ID
$sql = "SELECT MAX(ID) as max_id FROM membre";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la base de données
$sql = "INSERT INTO membre (ID, Nom, Prenom, Statut, `Date Naissance`) VALUES (:id, :nom, :prenom, :statut, :date_naissance)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom' => $nom,
	'prenom' => $prenom,
	'statut' => $statut,
	'date_naissance' => $date_naissance
));

echo "Inscription réussie !";
?>
