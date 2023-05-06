<?php
$serveur = "localhost";
$nomUtilisateur = "votre_nom_dutilisateur";
$mdpUtilisateur = "votre_mot_de_passe";
$baseDeDonnees = "projet_info_ing2";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, 'root', 'root', $baseDeDonnees);

// Vérification de la connexion
if (!$connexion) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// Récupération des données envoyées via le formulaire
$Nom = $_POST['Nom'];
$Prenom = $_POST['Prenom'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];
// Récupération du dernier ID_utilisateur inséré dans la table "utilisateur"
$sql = "SELECT MAX(Id_utilisateur) as max_id FROM utilisateur";
$resultat = mysqli_query($connexion, $sql);
$max_id = mysqli_fetch_assoc($resultat)['max_id'];

// Incrémentation de l'ID_utilisateur pour la nouvelle inscription
$nouvel_id = $max_id + 1;


// Préparation de la requête SQL pour insérer les données dans la table "utilisateurs"
$sql = "INSERT INTO utilisateur (Id_utilisateur,Nom, Prenom, email, mot_de_passe) VALUES ('$nouvel_id','$Nom', '$Prenom', '$email', '$mot_de_passe')";

// Exécution de la requête SQL
if (mysqli_query($connexion, $sql)) {
    echo "Enregistrement effectué avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>