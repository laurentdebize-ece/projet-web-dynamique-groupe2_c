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
	//echo $mot_de_passe;
	//echo $resultat['mot_de_passe'];
	//echo $email;
	//echo $resultat['email'];

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
		echo "Email ou mot de passe incorrect.1";
	}

	// Récupération des attributs de l'utilisateur
	$sql2 = "SELECT u.Id_utilisateur, u.Nom, u.Prenom, u.email, u.mot_de_passe, p.id_professeur, pm.id_matiere
     FROM utilisateur u
     JOIN professeur p ON u.Id_utilisateur = p.id_utilisateur
	 JOIN professeur_matiere pm ON p.id_professeur = pm.id_professeur
     WHERE `email` = :email AND u.Id_utilisateur = p.id_utilisateur";
	
    
    
    $requete2 = $bdd->prepare($sql2);
	$requete2->execute(array('email' => $email));
	$resultat2 = $requete2->fetch();
	//echo $resultat['id_etudiant'];
  //echo password_verify($mot_de_passe, $resultat['mot_de_passe']);
	// Vérification du mot de passe
	//echo $mot_de_passe;
	//echo $resultat2['mot_de_passe'];
	//echo $email;
	//echo $resultat2['email'];
	echo $resultat2['id_professeur'];

	if ($mot_de_passe == $resultat2['mot_de_passe']) {
		// Mot de passe correct : on enregistre les informations de l'utilisateur en session
		$_SESSION['Id_utilisateur'] = $resultat2['Id_utilisateur'];
		$_SESSION['Nom'] = $resultat2['Nom'];
		$_SESSION['Prenom'] = $resultat2['Prenom'];
		$_SESSION['email'] = $resultat2['email'];
		$_SESSION['Statut'] = $resultat2['Statut'];
		$_SESSION['id_matiere'] = $resultat2['id_matiere'];
		$_SESSION['id_professeur'] = $resultat2['id_professeur'];
		
		

		//Redirection vers la page souhaitée (à adapter)
		header('Location: page_accueil_etudiant.php');
		exit();
	} else {
		// Mot de passe incorrect : affichage d'un message d'erreur
		echo "Email ou mot de passe incorrect.2";
	}


	// Récupération des attributs de l'utilisateur
	$sql3 = "SELECT u.Id_utilisateur, u.Nom, u.Prenom, u.email, u.mot_de_passe, a.Id_administrateur
     FROM utilisateur u
     JOIN administrateur a ON u.Id_utilisateur = a.id_utilisateur
     WHERE `email` = :email AND u.Id_utilisateur = a.id_utilisateur";
	
    
    
    $requete3 = $bdd->prepare($sql3);
	$requete3->execute(array('email' => $email));
	$resultat3 = $requete3->fetch();
	//echo $resultat['id_etudiant'];
  //echo password_verify($mot_de_passe, $resultat['mot_de_passe']);
	// Vérification du mot de passe
	//echo $mot_de_passe;
	//echo $resultat2['mot_de_passe'];
	//echo $email;
	//echo $resultat2['email'];
	echo $resultat3['id_professeur'];

	if ($mot_de_passe == $resultat3['mot_de_passe']) {
		// Mot de passe correct : on enregistre les informations de l'utilisateur en session
		$_SESSION['Id_utilisateur'] = $resultat3['Id_utilisateur'];
		$_SESSION['Nom'] = $resultat3['Nom'];
		$_SESSION['Prenom'] = $resultat3['Prenom'];
		$_SESSION['email'] = $resultat3['email'];
		$_SESSION['Statut'] = $resultat3['Statut'];
		$_SESSION['Id_administrateur'] = $resultat3['Id_administrateur'];
		
		

		//Redirection vers la page souhaitée (à adapter)
		header('Location: page_accueil_etudiant.php');
		exit();
	} else {
		// Mot de passe incorrect : affichage d'un message d'erreur
		echo "Email ou mot de passe incorrect.2";
	}
}
?>