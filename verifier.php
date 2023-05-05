<?php
// Connexion à la base de données
$servername = "localhost";
$username = "nom_utilisateur";
$password = "mot_de_passe";
$dbname = "projet_info_ing2";

$conn = mysqli_connect($servername, 'root', 'root', $dbname);

// Vérification de la connexion
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Requête SQL pour vérifier si l'utilisateur existe dans la base de données
$sql = "SELECT * FROM utilisateurs WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

// Vérification du résultat de la requête
if (mysqli_num_rows($result) == 1) {
  echo "Vous êtes connecté.";
} else {
  echo "Email ou mot de passe incorrect.";
}

// Fermeture de la connexion
mysqli_close($conn);
?>
