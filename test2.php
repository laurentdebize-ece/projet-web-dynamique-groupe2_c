<?php
// Connexion à la base de données
$serveur = "localhost";
$nomUtilisateur = "votre_nom_dutilisateur";
$mdpUtilisateur = "votre_mot_de_passe";
$baseDeDonnees = "projet_info_ing2";

// Connexion à la base de données
$conn = mysqli_connect($serveur, 'root', 'root', $baseDeDonnees);

// Vérification de la connexion
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données du formulaire
$email = $_POST['email'];
$password = $_POST['mot_de_passe'];

// Requête SQL pour vérifier si l'utilisateur existe dans la base de données
$sql = "SELECT * FROM utilisateurs WHERE email='$email' AND password='$mot_de_passe'";
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
