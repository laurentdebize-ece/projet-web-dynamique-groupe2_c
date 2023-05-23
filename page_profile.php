<?php
session_start();


if (isset($_GET['deconnexion'])) {
	session_destroy();
	echo '<script>alert("Vous avez été déconnecté avec succès !");
    window.location.href = "page_identification.php";
    </script>';
	exit();
}
// recup des inofs depuis la session
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$mot_de_passe = $_SESSION['mot_de_passe'];
$Statut = $_SESSION['Statut'];



?>
<?php include 'barre_de_navigation.php'; ?>

<!DOCTYPE html>
<html>

<head>
	<title>Profil</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">ƒ
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="page_accueil_etudiant.js"></script>
	<link rel="stylesheet" href="page_accueil_etudiant.css">
	<link rel="stylesheet" href="page_profile.css">
	<link rel="stylesheet" href="barre_de_navigation.css">
	<link rel="stylesheet" href="pied_de_page.css">
</head>

<body>

	<a href="?deconnexion=true" class="btn-deconnexion"><i class="ion-log-out"></i></a>

	<canvas id="bubbleCanvas"></canvas>

	<?php
	switch ($Statut) {
		case 'Etudiant':
			barre_de_navigation_etudiants();
			break;
		case 'Professeur':
			barre_de_navigation_professeurs();
			break;
		case 'Administrateur':
			barre_de_navigation_administrateur();
			break;
		default:
			barre_de_navigation_etudiants();
			break;
	} ?>

	<div class="container-titre">
		<h1>Profil</h1>
		<div class="profile-info">
			<div class="photo-container">
				<img src="photo_utilisateur.png" alt="Photo utilisateur" width="100" height="100">
			</div>
			<div class="text-container">
				<p><strong>Statut :</strong> <?php echo $Statut ?></p>
				<p><strong>Nom :</strong> <?php echo $nom ?></p>
				<p><strong>Prénom :</strong> <?php echo $prenom ?></p>
				<p><strong>Email :</strong> <?php echo $email ?></p>
				<p><strong>Mot de Passe :</strong> <?php echo $mot_de_passe ?></p>
			</div>
		</div>
	</div>
	<?php pied_de_page(); ?>
</body>

</html>