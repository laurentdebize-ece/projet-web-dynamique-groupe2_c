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
	$sql = "SELECT u.Id_utilisateur, u.Nom, u.Prenom, u.email, u.mot_de_passe, c.nom_classe, ec.Nom_ecole, e.id_etudiant
     FROM utilisateur u
     JOIN etudiant e ON u.Id_utilisateur = e.id_utilisateur
     JOIN classe c ON e.id_classe = c.id_classe
     JOIN ecole ec ON c.id_ecole = ec.id_ecole
     WHERE `email` = :email AND u.Id_utilisateur = e.id_utilisateur";
	
    
    
    $requete = $bdd->prepare($sql);
	$requete->execute(array('email' => $email));
	$resultat = $requete->fetch();
	//echo $resultat['id_etudiant'];
  //echo password_verify($mot_de_passe, $resultat['mot_de_passe']);
	// Vérification du mot de passe
	echo $mot_de_passe;
	echo $resultat['mot_de_passe'];
	echo $email;
	echo $resultat['email'];

	if ($mot_de_passe == $resultat['mot_de_passe']) {
		// Mot de passe correct : on enregistre les informations de l'utilisateur en session
		$_SESSION['Id_utilisateur'] = $resultat['Id_utilisateur'];
		$_SESSION['Nom'] = $resultat['Nom'];
		$_SESSION['Prenom'] = $resultat['Prenom'];
		$_SESSION['email'] = $resultat['email'];
		$_SESSION['Statut'] = $resultat['Statut'];
        $_SESSION['nom_classe'] = $resultat['nom_classe'];
        $_SESSION['Nom_ecole'] = $resultat['Nom_ecole'];
		$_SESSION['id_etudiant'] = $resultat['id_etudiant'];
		
		

		// Redirection vers la page souhaitée (à adapter)
		header('Location: page_accueil_etudiant.php');
		exit();
	} else {
		// Mot de passe incorrect : affichage d'un message d'erreur
		echo "Email ou mot de passe incorrect.";
	}

	// Récupération des attributs de l'utilisateur
	$sql2 = "SELECT u.Id_utilisateur, u.Nom, u.Prenom, u.email, u.mot_de_passe, p.id_professeur, pm.id_matiere
     FROM utilisateur u
     JOIN professeur p ON u.Id_utilisateur = p.id_utilisateur
	 JOIN professeur_matiere pm ON p.id_professeur = pm.id_professeur
     WHERE `email` = :email AND u.Id_utilisateur = p.id_utilisateur";
	
    
    
    $requete = $bdd->prepare($sql2);
	$requete->execute(array('email' => $email));
	$resultat = $requete->fetch();
	//echo $resultat['id_etudiant'];
  //echo password_verify($mot_de_passe, $resultat['mot_de_passe']);
	// Vérification du mot de passe
	echo $mot_de_passe;
	echo $resultat['mot_de_passe'];
	echo $email;
	echo $resultat['email'];

	if ($mot_de_passe == $resultat['mot_de_passe']) {
		// Mot de passe correct : on enregistre les informations de l'utilisateur en session
		$_SESSION['Id_utilisateur'] = $resultat['Id_utilisateur'];
		$_SESSION['Nom'] = $resultat['Nom'];
		$_SESSION['Prenom'] = $resultat['Prenom'];
		$_SESSION['email'] = $resultat['email'];
		$_SESSION['Statut'] = $resultat['Statut'];
		$_SESSION['id_etudiant'] = $resultat['id_etudiant'];
		
		

		// Redirection vers la page souhaitée (à adapter)
		header('Location: page_accueil_etudiant.php');
		exit();
	} else {
		// Mot de passe incorrect : affichage d'un message d'erreur
		echo "Email ou mot de passe incorrect.";
	}
}
?>