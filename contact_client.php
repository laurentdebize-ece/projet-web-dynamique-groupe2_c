<?php
include 'barre_de_navigation.php'; 
session_start();
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$adresseEmailDestinataire = 'antoine.dejesus@edu.ece.fr';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['name'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Construire le sujet et le corps de l'e-mail
    $corps = "Nom: $nom\n";
    $corps .= "Prénom: $prenom\n";
    $corps .= "Email: $email\n";
    $corps .= "Message: $message\n";

    // En-têtes de l'e-mail
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoyer l'e-mail
    mail($adresseEmailDestinataire, $sujet, $corps, $headers);


    exit();
}
?>