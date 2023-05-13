<?php
session_start();

// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "Projet_info_ing2";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Vérification des informations d'identification
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];
$query = "SELECT * FROM utilisateur WHERE email='$email' AND mot_de_passe='$mot_de_passe'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Enregistrement des informations de l'utilisateur dans la session
    $_SESSION['id_utilisateur'] = $row['Id_utilisateur'];
    $_SESSION['nom'] = $row['Nom'];
    $_SESSION['prenom'] = $row['Prenom'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['mot_de_passe'] = $row['mot_de_passe'];
    $_SESSION['Statut'] = $row['Statut'];
    $_SESSION['premiere_connexion'] = $row['premiere_connexion'];


   
        // Redirection vers la page en fonction du statut de l'utilisateur
        $statut = $row['Statut'];
        if ($statut == 'Etudiant') {
            header("Location: page_accueil_etudiant.php");
            exit();
        } elseif ($statut == 'Professeur') {
            header("Location: page_accueil_professeur.php");
            exit();
        } elseif ($statut == 'Administrateur') {
            header("Location: page_accueil_administrateur.php");
            exit();
        }
    }
else {
    // Affichage d'un message d'erreur si les informations d'identification sont incorrectes
    echo "Identifiant ou mot de passe incorrect.";
}

mysqli_close($conn);
?>
