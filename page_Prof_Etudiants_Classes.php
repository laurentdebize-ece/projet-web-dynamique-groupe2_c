<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "projet_info_ing2";
session_start();
// Créer une connexion
$conn = new mysqli($servername, 'root', 'root', $dbname);
 
// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$nom_promotion = $_GET['nom_promotion'];
// Récupérer l'ID du professeur
$userId = $_SESSION['id_utilisateur'];
 
$sql_professeur = "SELECT id_professeur FROM professeur WHERE id_utilisateur = $userId";
$result_professeur = $conn->query($sql_professeur);
 
if ($result_professeur && $result_professeur->num_rows > 0) {
    $row_professeur = $result_professeur->fetch_assoc();
    $id_professeur = $row_professeur['id_professeur'];
} else {
    echo 'Erreur: Aucun professeur correspondant trouvé.';
    exit();
}
 

$sql = "SELECT c.nom_classe
FROM classe c
JOIN promotion p ON c.id_promotion = p.id_promotion
JOIN professeur_classe pc ON c.id_classe = pc.id_classe
WHERE p.nom_promotion = '$nom_promotion' AND pc.id_professeur = $id_professeur";
 
$result = $conn->query($sql);
$classNames = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $classNames[] = $row['nom_classe'];
    }
}else{
    echo 'Erreur: Aucune classe correspondant trouvé.';
 
}
 
echo implode(",", $classNames);
 
$conn->close();
?>
 