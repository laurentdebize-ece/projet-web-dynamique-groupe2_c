<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
	<title>Page d'identification</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="pied_de_page.css">
	<link rel="stylesheet" type="text/css" href="css_Id_Ajout_Modif_Supp.css">
</head>

<body>
	<div class="logo_centré">
		<img src="logo.png" alt="Logo Omnes" width="375" height="125">
	</div>
	<div class="login-box">
		<h1>Identification</h1>
		<form method="post" action="traitement_identification.php">
			<label for="email">Email :</label>
			<input type="email" name="email" id="email" required>
			<label for="password">Mot de passe :</label>
			<input type="password" name="mot_de_passe" id="mot_de_passe" required>
			<input type="submit" value="M'identifier">
		</form>
	</div><br>
    <?php pied_de_page(); ?>
</body>

</html>