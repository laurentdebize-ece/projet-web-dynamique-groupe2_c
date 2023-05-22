<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_ecole = $_POST['ecole'];
$nom_ecole = $_POST['nom'];

// Modification de l'école dans la base de données
$sql = "UPDATE ecole SET Nom_ecole = :nom_ecole WHERE id_ecole = :id_ecole";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(':nom_ecole' => $nom_ecole, ':id_ecole' => $id_ecole));

if ($stmt->rowCount() > 0) {
    $message = "Succès : L'école $nom_ecole a été modifiée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Modif_Ecole.php";
    </script>';
    exit();
}
?>
