<?php
session_start();

// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom']) || !isset($_SESSION['date_naissance'])) {
	// Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
	header('Location: login.php');
	exit();
}

// Récupération des informations de l'utilisateur depuis la session
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$date_naissance = $_SESSION['date_naissance'];

// Affichage des informations de l'utilisateur

?>
<?php include 'barre_de_navigation.php'; ?>

<!DOCTYPE html>
<html>

<head>
	<title>Profil</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="page_profile.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>

<body>
	<?php barre_de_navigation(); ?>
	
	<div class="container-titre">
		<h1>Profil</h1>
		<div class="profile-info">
			<div class="photo-container">
				<img src="photo_utilisateur.png" alt="Photo utilisateur" width="100" height="100">
			</div>
			<div class="text-container">
				<p><strong>Nom :</strong> <?php echo $nom ?></p>
				<p><strong>Prénom :</strong> <?php echo $prenom ?></p>
				<p><strong>Date de naissance :</strong> <?php echo $date_naissance ?></p>
			</div>
		</div>
	</div>
	<?php pied_de_page(); ?>
</body>
</html>