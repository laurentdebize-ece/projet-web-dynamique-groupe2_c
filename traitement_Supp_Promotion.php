<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération de l'id de la promotion à supprimer
$id_promotion = $_POST['promotion'];

// Mettre id_promotion à null dans la table 'classe' pour les enregistrements qui référencent cette promotion
$sql_update = "UPDATE classe SET id_promotion = NULL WHERE id_promotion = :id_promotion";
$stmt_update = $bdd->prepare($sql_update);
$stmt_update->execute(array(':id_promotion' => $id_promotion));

// Suppression de la promotion dans la base de données
$sql_delete = "DELETE FROM promotion WHERE id_promotion = :id_promotion";
$stmt_delete = $bdd->prepare($sql_delete);
$stmt_delete->execute(array(':id_promotion' => $id_promotion));

if ($stmt_delete->rowCount() > 0) {
    $message = "Succès : La promotion a été supprimée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Supp_Promotion.php";
    </script>';
    exit();
}
?>
