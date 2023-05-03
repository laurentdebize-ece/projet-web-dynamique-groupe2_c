<!DOCTYPE html>
<html>

<head>
	<title>Exemple de boutons</title>
	<link rel="stylesheet" href="TP7.css">
</head>

<body>
	<h1>TP7 : Bases De Données</h1>
	<form action="" method="post">
		<input type="submit" name="liste_membres" value="Liste des membres"><br>
		<input type="submit" name="ordre_croissant" value="Prénom croissant">
		<input type="submit" name="ordre_decroissant" value="Prénom décroissant">
		<input type="submit" name="date_avant_1960" value="Date de naissance < 1960">
		<input type="submit" name="prenom_en_g" value="Prénom commençant par G">
		<input type="submit" name="prenom_en_ma" value="Prénom contenant MA">
	</form>

	<table>
		<thread>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Statut</th>
				<th>Date de Naissance</th>
			</tr>


			<?php
			try {
				$bdd = new PDO("mysql:host=localhost;dbname=famille;charset=utf8", "root", "root");
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {
				die("Erreur : " . $e->getMessage());
			}

			$sql = "SELECT * FROM membre";

			if (isset($_POST['ordre_croissant'])) {
				$sql .= " ORDER BY Prenom ASC";
			} elseif (isset($_POST['ordre_decroissant'])) {
				$sql .= " ORDER BY Prenom DESC";
			} elseif (isset($_POST['liste_membres'])) {
				$sql = "SELECT * FROM membre";
			} elseif (isset($_POST['date_avant_1960'])) {
				$sql .= " WHERE `Date Naissance` < '1960-01-01'";
			} elseif (isset($_POST['prenom_en_g'])) {
				$sql .= " WHERE Prenom LIKE 'G%'";
			} elseif (isset($_POST['prenom_en_ma'])) {
				$sql .= " WHERE Prenom LIKE '%MA%'";
			}

			$resultat = $bdd->query($sql);
			while ($donnees = $resultat->fetch()) {
				echo "<tr>";
				echo "<td>" . $donnees['ID'] . "</td>";
				echo "<td>" . $donnees['Nom'] . "</td>";
				echo "<td>" . $donnees['Prenom'] . "</td>";
				echo "<td>" . $donnees['Statut'] . "</td>";
				echo "<td>" . $donnees['Date Naissance'] . "</td>";
				echo "</tr>";
			}

			$resultat->closeCursor();
			?>
	</table>
</body>

</html>