<?php
$conn = new mysqli("", 'root', 'root', "projet_info_ing2");
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$competenceId = $_POST['competence_id'];
$commentaire = $_POST['commentaire'];
$etudiantId = $_POST['etudiant_id'];
 
$sql = "UPDATE competences_etudiants SET commentaire = ? WHERE id_competence = ? AND id_etudiant = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $commentaire, $competenceId, $etudiantId);
 
if ($stmt->execute()) {
    echo "succes";
} else {
    echo "Erreur: " . $conn->error;
}
 
$stmt->close();
$conn->close();
?>
 