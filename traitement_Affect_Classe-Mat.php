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
$id_classe = $_POST['classe'];

// Sélection du nom de la matière
$query = "SELECT nom_matiere FROM matiere WHERE id_matiere = :id_matiere";
$stmt = $bdd->prepare($query);
$stmt->bindParam(':id_matiere', $id_matiere, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nom_matiere = $result['nom_matiere'];

// Sélection du nom de la classe
$query = "SELECT nom_classe FROM classe WHERE id_classe = :id_classe";
$stmt = $bdd->prepare($query);
$stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nom_classe = $result['nom_classe'];

// Sélection des étudiants de la classe
$query = "SELECT id_etudiant FROM etudiant WHERE id_classe = :id_classe";
$stmt = $bdd->prepare($query);
$stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
$stmt->execute();
$etudiants = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Insertion des étudiants dans la table etudiiant_matiere
$query = "INSERT INTO etudiiant_matiere (id_etudiant, id_matiere) VALUES (:id_etudiant, :id_matiere)";
$stmt = $bdd->prepare($query);
$stmt->bindParam(':id_matiere', $id_matiere, PDO::PARAM_INT);

foreach ($etudiants as $id_etudiant) {
    $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
    $stmt->execute();
}

// Afficher l'alerte en fonction de l'action effectuée
if ($stmt->rowCount() > 0) {
    $message = "Les étudiants de la classe '$nom_classe' ont été ajoutés avec succès à la matière '$nom_matiere'.";
    echo '<script>alert("Succès : ' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Affect_Classe-Mat.php";
    </script>';
    exit();
}
