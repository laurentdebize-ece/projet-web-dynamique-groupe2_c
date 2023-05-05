<?php
$serveur = "localhost";
$nomUtilisateur = "votre_nom_dutilisateur";
$mdpUtilisateur = "votre_mot_de_passe";
$baseDeDonnees = "nom_de_votre_base_de_donnees";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $nomUtilisateur, $mdpUtilisateur, $baseDeDonnees);

// Vérification de la connexion
if (!$connexion) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// Récupération des données envoyées via le formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

// Préparation de la requête SQL pour insérer les données dans la table "utilisateurs"
$sql = "INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES ('$nom', '$prenom', '$email', '$mdp')";

// Exécution de la requête SQL
if (mysqli_query($connexion, $sql)) {
    echo "Enregistrement effectué avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>
