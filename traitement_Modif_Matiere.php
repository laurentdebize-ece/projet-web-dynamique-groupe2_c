<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_matiere = $_POST['matiere'];
$nom_matiere = $_POST['nom'];
$volume_horaire = $_POST['temps'];

// Modification des données dans la base de données
$sql = "UPDATE matiere SET";
$parameters = array();

if (!empty($nom_matiere)) {
    $sql .= " nom_matiere = :nom_matiere,";
    $parameters[':nom_matiere'] = $nom_matiere;
}

if (!empty($volume_horaire)) {
    $sql .= " volume_horaire = :volume_horaire,";
    $parameters[':volume_horaire'] = $volume_horaire;
}

$sql = rtrim($sql, ",");

$sql .= " WHERE id_matiere = :id_matiere";

$parameters[':id_matiere'] = $id_matiere;

$stmt = $bdd->prepare($sql);
$stmt->execute($parameters);

if ($stmt->rowCount() > 0) {
    $message = "Succès : La matière a été modifiée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Modif_Matiere.php";
    </script>';
    exit();
}
?>
