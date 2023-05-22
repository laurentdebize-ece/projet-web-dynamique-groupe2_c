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

$nom_promotion = $_GET['nom_promotion'];
$sql = "SELECT c.nom_classe FROM classe c JOIN promotion p ON c.id_promotion = p.id_promotion WHERE p.nom_promotion = '$nom_promotion'";

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
