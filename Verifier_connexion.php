<?php
session_start();

if (!empty($_POST)) {
	try {
		$bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die("Erreur : " . $e->getMessage());
	}

	// Récupération des données du formulaire
	$email = $_POST['email'];
	$mot_de_passe = $_POST['mot_de_passe'];
  
	// Récupération des attributs de l'utilisateur
	$sql = "SELECT * FROM utilisateur WHERE `email` = :email";
	$requete = $bdd->prepare($sql);
	$requete->execute(array('email' => $email));
	$resultat = $requete->fetch();

  //echo password_verify($mot_de_passe, $resultat['mot_de_passe']);
	// Vérification du mot de passe
	if ($mot_de_passe == $resultat['mot_de_passe']) {
		// Mot de passe correct : on enregistre les informations de l'utilisateur en session
		$_SESSION['Id_utilisateur'] = $resultat['Id_utilisateur'];
		$_SESSION['Nom'] = $resultat['Nom'];
		$_SESSION['Prenom'] = $resultat['Prenom'];
		$_SESSION['email'] = $resultat['email'];
		$_SESSION['Statut'] = $resultat['Statut'];

		// Redirection vers la page souhaitée (à adapter)
		header('Location: page_accueil_etudiant.php');
		exit();
	} else {
		// Mot de passe incorrect : affichage d'un message d'erreur
		echo "Email ou mot de passe incorrect.";
	}
}
?>
