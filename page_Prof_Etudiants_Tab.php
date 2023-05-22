<?php
session_start();
$conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$userId = $_SESSION['id_utilisateur'];
 
// Récupérer l'ID du professeur
$sql_professeur = "SELECT id_professeur FROM professeur WHERE id_utilisateur = $userId";
$result_professeur = $conn->query($sql_professeur);
 
if ($result_professeur && $result_professeur->num_rows > 0) {
    $row_professeur = $result_professeur->fetch_assoc();
    $id_professeur = $row_professeur['id_professeur'];
} else {
    echo 'Erreur1';
}
// Récupérer l'ID de la matière enseignée par le professeur
$sql_matiere_prof = "SELECT id_matiere FROM professeur_matiere WHERE id_professeur = $id_professeur";
$result_matiere_prof = $conn->query($sql_matiere_prof);
 
if ($result_matiere_prof && $result_matiere_prof->num_rows > 0) {
    $row_matiere_prof = $result_matiere_prof->fetch_assoc();
    $ID_matiere_prof = $row_matiere_prof['id_matiere'];
} else {
    echo 'Erreur2';
}
$nom_classe = $_GET['nom_classe'];
$sql = "SELECT DISTINCT u.Nom, u.Prenom, u.email, em.id_matiere
FROM utilisateur u
JOIN etudiant e ON u.Id_utilisateur = e.id_utilisateur
JOIN etudiiant_matiere em ON e.id_etudiant = em.id_etudiant
JOIN matiere m ON em.id_matiere = m.id_matiere
JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
JOIN professeur p ON pm.id_professeur = p.id_professeur
JOIN classe c ON e.id_classe = c.id_classe
WHERE c.nom_classe = '$nom_classe' AND em.id_matiere = '$ID_matiere_prof'AND em.id_prof = '$id_professeur'";
////////////PROBLEME : CHAMP 'id_prof' dans la table 'etudiiant_matiere'//////////////
 
$result = $conn->query($sql);
 
$studentDetails = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $studentDetails .= $row['Nom'] . ',' . $row['Prenom'] . ',' . $row['email'] . ';';
    }
}else {
    echo '<script>alert("Aucun professeur correspondant trouvé.");
    window.location.href = "page_Affecter_Matiere-Classe.php";
    </script>';
        exit();
}
// Remove the last semicolon
$studentDetails = rtrim($studentDetails, ';');
 
echo $studentDetails;
 
$conn->close();
 
 