<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_classe = $_POST['classe'];

// Récupération du nom de la classe à partir de la table 'classe'
$requete = $bdd->prepare("SELECT nom_classe FROM classe WHERE id_classe = :id_classe");
$requete->execute(['id_classe' => $id_classe]);
$nom_classe = $requete->fetch()['nom_classe'];

// Mise à jour de l'id_classe à NULL pour tous les étudiants appartenant à la classe
$sql_update_etudiants = "UPDATE etudiant SET id_classe = NULL WHERE id_classe = :id_classe";
$stmt_update_etudiants = $bdd->prepare($sql_update_etudiants);
$stmt_update_etudiants->execute(['id_classe' => $id_classe]);

// Mise à jour de l'id_classe à NULL pour tous les professeurs appartenant à la classe
$sql_update_professeurs = "UPDATE professeur SET id_classe = NULL WHERE id_classe = :id_classe";
$stmt_update_professeurs = $bdd->prepare($sql_update_professeurs);
$stmt_update_professeurs->execute(['id_classe' => $id_classe]);

// Suppression de la classe dans la base de données
$sql_delete_classe = "DELETE FROM classe WHERE id_classe = :id_classe";
$stmt_delete_classe = $bdd->prepare($sql_delete_classe);
$stmt_delete_classe->execute(['id_classe' => $id_classe]);

if ($stmt_delete_classe->rowCount() > 0) {
    $message = "La classe '$nom_classe' a été supprimée avec succès.         Attention, veuillez attribuer une nouvelle classe aux etudiants et aux professeurs de $nom_classe";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Supp_Classe.php";
    </script>';
    exit();
}
?>
