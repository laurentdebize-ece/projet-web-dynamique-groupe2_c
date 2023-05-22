<?php
session_start();

$conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$userId = $_SESSION['id_utilisateur'];
$nom_classe = $_GET['nom_classe'];
 
$sql = "SELECT DISTINCT u.Nom, u.Prenom, u.email
FROM utilisateur u
JOIN etudiant e ON u.Id_utilisateur = e.id_utilisateur
JOIN etudiiant_matiere em ON e.id_etudiant = em.id_etudiant
JOIN matiere m ON em.id_matiere = m.id_matiere
JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
JOIN professeur p ON pm.id_professeur = p.id_professeur
JOIN classe c ON e.id_classe = c.id_classe
WHERE c.nom_classe = '$nom_classe'";
 

$result = $conn->query($sql);
 
$studentDetails = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $studentDetails .= $row['Nom'] . ',' . $row['Prenom'] . ',' . $row['email'] . ';';
    }
}
 
$studentDetails = rtrim($studentDetails, ';');
 
echo $studentDetails;
 
$conn->close();
