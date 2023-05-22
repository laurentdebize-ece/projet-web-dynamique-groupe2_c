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
$id_professeur = $_SESSION['id_professeur'];
$nom_classe = $_GET['nom_classe'];

$sql = "SELECT DISTINCT u.Nom, u.Prenom, u.email, em.id_matiere, com.nom_competences, ac.nom, e.id_etudiant, com.id_competences
FROM utilisateur u
JOIN etudiant e ON u.Id_utilisateur = e.id_utilisateur
JOIN etudiiant_matiere em ON e.id_etudiant = em.id_etudiant
JOIN matiere m ON em.id_matiere = m.id_matiere
JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
JOIN professeur p ON pm.id_professeur = p.id_professeur
JOIN classe c ON e.id_classe = c.id_classe
JOIN competences_etudiants ce ON e.id_etudiant = ce.id_etudiant
JOIN competences com ON ce.id_competence = com.id_competences
JOIN acquisition_competences ac ON ce.Id_niveau_acquisition = ac.id
WHERE c.nom_classe = '$nom_classe' AND em.id_matiere = '$ID_matiere_prof'AND em.id_prof = '$id_professeur'";

$result = $conn->query($sql);

$studentDetails = '';
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $studentDetails .= $row['id_matiere'] . ',' . $row['Prenom'] . ',' . $row['email'] . ',' . $row['nom_competences'] . ',' . $row['nom'] . ',' . $row['id_competences'] .',' . $row['id_etudiant'] .';';
    }
} 

// Remove the last semicolon
$studentDetails = rtrim($studentDetails, ';');

echo $studentDetails;

$conn->close();
?>
