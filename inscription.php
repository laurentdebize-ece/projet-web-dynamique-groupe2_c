<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>
	<h1>Inscription</h1>
	<form action="traitement_inscription.php" method="post">
		<label for="nom">Nom :</label>
		<input type="text" id="nom" name="nom" required><br>

		<label for="prenom">Prénom :</label>
		<input type="text" id="prenom" name="prenom" required><br>

		<label for="date_naissance">Date de naissance :</label>
		<input type="date" id="date_naissance" name="date_naissance" required><br>

		<label for="mot_de_passe">Mot de passe :</label>
		<input type="password" id="mot_de_passe" name="mot_de_passe" required><br>

		<input type="submit" value="S'inscrire">
	</form>
</body>
</html>
