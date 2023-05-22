<?php
session_start();
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "projet_info_ing2";

// Créer une connexion
$conn = new mysqli($servername, 'root', 'root', $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['Id_utilisateur'];
$ID_matiere_prof = $_SESSION['id_matiere']; // ou une autre méthode pour obtenir l'ID de l'utilisateur connecté
$nom_classe = $_GET['nom_classe'];

$sql = "SELECT DISTINCT u.Nom, u.Prenom, u.email, em.id_matiere
FROM utilisateur u
JOIN etudiant e ON u.Id_utilisateur = e.id_utilisateur
JOIN etudiiant_matiere em ON e.id_etudiant = em.id_etudiant
JOIN matiere m ON em.id_matiere = m.id_matiere
JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
JOIN professeur p ON pm.id_professeur = p.id_professeur
JOIN classe c ON e.id_classe = c.id_classe
WHERE c.nom_classe = '$nom_classe' AND em.id_matiere = '$ID_matiere_prof'";


$result = $conn->query($sql);

$studentDetails = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $studentDetails .= $row['Nom'] . ',' . $row['Prenom'] . ',' . $row['email'] . ';';
    }
} 

// Remove the last semicolon
$studentDetails = rtrim($studentDetails, ';');

echo $studentDetails;

$conn->close();
?>