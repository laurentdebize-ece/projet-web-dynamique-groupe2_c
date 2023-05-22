<?php
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

$competenceId = $_POST['competence_id'];
$commentaire = $_POST['commentaire'];
$etudiantId = $_POST['etudiant_id'];

$sql = "UPDATE competences_etudiants SET commentaire = ? WHERE id_competence = ? AND id_etudiant = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $commentaire, $competenceId, $etudiantId); // "sii" indicates the types of the parameters: in this case, a string and two integers.

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
