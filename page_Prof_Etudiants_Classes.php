<?php
session_start();
$conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$nom_promotion = $_GET['nom_promotion'];
$idUtilisateur = $_SESSION['id_utilisateur'];
 

$sqlIdProfesseur = "SELECT p.id_professeur
                    FROM professeur p
                    WHERE p.id_utilisateur = '$idUtilisateur'";
$resultIdProfesseur = $conn->query($sqlIdProfesseur);
 
if ($resultIdProfesseur->num_rows > 0) {
  $rowIdProfesseur = $resultIdProfesseur->fetch_assoc();
  $idProfesseur = $rowIdProfesseur['id_professeur'];
}else{
    echo '0 result';
}
 
$sql = "SELECT c.nom_classe
        FROM classe c
        JOIN promotion p ON c.id_promotion = p.id_promotion
        JOIN professeur_classe pc ON c.id_classe = pc.id_classe
        WHERE p.nom_promotion = '$nom_promotion' AND pc.id_professeur = '$idProfesseur'";
 
$result = $conn->query($sql);
$classNames = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $classNames[] = $row['nom_classe'];
    }
}
 
echo implode(",", $classNames);
 
$conn->close();
?>
 
 