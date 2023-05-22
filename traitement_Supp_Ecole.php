<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération de l'id de l'école à supprimer
$id_ecole = $_POST['ecole'];

// Mettre id_ecole à null dans la table 'classe' pour les enregistrements qui référencent cette école
$sql_update = "UPDATE classe SET id_ecole = NULL WHERE id_ecole = :id_ecole";
$stmt_update = $bdd->prepare($sql_update);
$stmt_update->execute(array(':id_ecole' => $id_ecole));

// Suppression de l'école dans la base de données
$sql_delete = "DELETE FROM ecole WHERE id_ecole = :id_ecole";
$stmt_delete = $bdd->prepare($sql_delete);
$stmt_delete->execute(array(':id_ecole' => $id_ecole));

if ($stmt_delete->rowCount() > 0) {
    $message = "Succès : L'école a été supprimée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Supp_Ecole.php";
    </script>';
    exit();
}
?>
