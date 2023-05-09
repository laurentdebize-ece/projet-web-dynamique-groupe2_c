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
$statut = 'Etudiant'; // ajout du champ 'statut' avec la valeur 'Etudiant'
$id_classe = $_POST['classe'];


// Récupération du nouvel ID
$sql = "SELECT MAX(Id_utilisateur) as max_id FROM utilisateur";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;


// Insertion des données dans la base de données
$sql2 = "INSERT INTO utilisateur (Id_utilisateur, Nom, Prenom, email, mot_de_passe, statut) VALUES (:id, :nom, :prenom, :email, :mot_de_passe, :statut)";
$requete = $bdd->prepare($sql2);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom' => $nom,
	'prenom' => $prenom,
	'email' => $email,
	'mot_de_passe' => $mot_de_passe,
	'statut' => $statut // ajout de la valeur de 'statut'
));

// Récupération du nouvel ID etudiant
$sql4 = "SELECT MAX(id_etudiant) as max_id_etudiant FROM etudiant";
$resultat_etu = $bdd->query($sql4);
$max_id_etudiant = $resultat_etu->fetch()['max_id_etudiant'];
$nouvel_id_etudiant = $max_id_etudiant + 1;


$sql3 = "INSERT INTO etudiant (id_etudiant, id_utilisateur, id_classe) VALUES (:id_etudiant, :id, :id_classe)";
$requete_etu = $bdd->prepare($sql3);
$requete_etu->execute(array(
	'id' => $nouvel_id,
	'id_etudiant' => $nouvel_id_etudiant,
	'id_classe' => $id_classe // ajout de la valeur de 'statut
));

// Redirection vers la page d'identification
header("Location: page_accueil_etudiant.php");
exit;
?>
