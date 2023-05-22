<?php
session_start();

$id_utilisateur = $_SESSION['id_utilisateur'];

$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['competence'])) {
    $id_competence = $_POST['competence'];

    // Supprimer les correspondances dans la table 'competences_matieres'
    $query_delete_comp_matiere = "DELETE FROM competences_matieres WHERE id_competence = :id_competence";
    $stmt_delete_comp_matiere = $bdd->prepare($query_delete_comp_matiere);
    $stmt_delete_comp_matiere->execute(['id_competence' => $id_competence]);

    // Supprimer les correspondances dans la table 'competences_etudiants'
    $query_delete_comp_etudiant = "DELETE FROM competences_etudiants WHERE id_competence = :id_competence";
    $stmt_delete_comp_etudiant = $bdd->prepare($query_delete_comp_etudiant);
    $stmt_delete_comp_etudiant->execute(['id_competence' => $id_competence]);

    // Supprimer la compétence dans la table 'competences'
    $query_delete_competence = "DELETE FROM competences WHERE id_competences = :id_competence";
    $stmt_delete_competence = $bdd->prepare($query_delete_competence);
    $stmt_delete_competence->execute(['id_competence' => $id_competence]);

    $message = "Succès : La compétence a été supprimée avec succès";
    echo '<script>alert("' . $message . '"); window.location.href = "page_Prof_Ajout&Modif.php";</script>';
    exit();
} else {
    $message = "Erreur : Aucune action effectuée car la compétence n'a pas été sélectionnée";
    echo '<script>alert("' . $message . '"); window.location.href = "page_Supp_Comp_Prof.php";</script>';
    exit();
}
?>
