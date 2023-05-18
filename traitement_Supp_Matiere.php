<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_matiere = $_POST['matiere'];

// Récupération du nom de la matière à partir de la table 'matiere'
$requete_nom_matiere = $bdd->prepare("SELECT nom_matiere FROM matiere WHERE id_matiere = :id_matiere");
$requete_nom_matiere->execute(['id_matiere' => $id_matiere]);
$nom_matiere = $requete_nom_matiere->fetch()['nom_matiere'];

// Suppression de la matière dans la base de données
$sql = "DELETE FROM matiere WHERE id_matiere = :id_matiere";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'id_matiere' => $id_matiere,
));

if ($requete->rowCount() > 0) {
    $message = "La matière '$nom_matiere' a été supprimée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Supp_Matiere.php";
    </script>';
    exit();
}
?>