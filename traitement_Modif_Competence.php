<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_competence = $_POST['competence'];
$nom_competence = $_POST['nom'];
$id_matiere = $_POST['matiere'];

// Modification des données dans la table 'competences'
if (!empty($nom_competence)) {
    $sql = "UPDATE competences SET nom_competences = :nom_competence WHERE id_competences = :id_competence";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':nom_competence' => $nom_competence, ':id_competence' => $id_competence));
}

// Modification des données dans la table 'competences_matieres'
if (!empty($id_matiere)) {
    $sql = "UPDATE competences_matieres SET id_matiere = :id_matiere WHERE id_competence = :id_competence";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(':id_matiere' => $id_matiere, ':id_competence' => $id_competence));
}

if ($stmt->rowCount() > 0) {
    $message = "Succès : La compétence $nom_competence a été modifiée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Modif_Competence.php";
    </script>';
    exit();
}
?>
