<?php
session_start();

if (!empty($_POST)) {
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
	$mot_de_passe = $_POST['mot_de_passe'];

	// Récupération du mot de passe correspondant à l'utilisateur
	$sql = "SELECT Statut FROM membre WHERE Nom = :nom AND Prenom = :prenom AND `Date Naissance` = :date_naissance";
	$requete = $bdd->prepare($sql);
	$requete->execute(array(
		'nom' => $nom,
		'prenom' => $prenom,
		'date_naissance' => $date_naissance
	));
	$resultat = $requete->fetch();
	$mot_de_passe_bdd = $resultat['Statut'];

	// Vérification du mot de passe
	if (password_verify($mot_de_passe, $mot_de_passe_bdd)) {
		// Mot de passe correct : on enregistre les informations de l'utilisateur en session
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
		$_SESSION['date_naissance'] = $date_naissance;

		// Redirection vers la page souhaitée (à adapter)
		header('Location: page_accueil_etudiant.php');
		exit();
	} else {
		// Mot de passe incorrect : affichage d'un message d'erreur
		echo "Nom, prénom, date de naissance ou mot de passe incorrects.";
	}
}
?>
