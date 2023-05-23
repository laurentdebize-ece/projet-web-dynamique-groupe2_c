<?php 
$conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$competenceId = $_POST['competence_id'];
$validation = $_POST['validation'];
$etudiantId = $_POST['etudiant_id'];
 
$sql = "UPDATE competences_etudiants SET validation_prof = ? WHERE id_competence = ? AND id_etudiant = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $validation, $competenceId, $etudiantId); 
 
if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
 
$stmt->close();
$conn->close();
?>