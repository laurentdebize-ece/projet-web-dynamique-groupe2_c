<?php
session_start();

$id_utilisateur = $_SESSION['id_utilisateur'];

$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['competence'])) {
    $id_competence = $_POST['competence'];
    $nom = $_POST['nom'];
    $id_classe = $_POST['classe'];
    $commentaire = $_POST['commentaire'];
    $date_evaluation = $_POST['date'];

    // Vérifier si les champs ont été remplis
    if (!empty($nom) || !empty($commentaire) || !empty($date_evaluation)) {
        // Mettre à jour la compétence dans la table 'competences'
        if (!empty($nom)) {
            $query_update_competence = "UPDATE competences SET nom_competences = :nom WHERE id_competences = :id_competence";
            $stmt_update_competence = $bdd->prepare($query_update_competence);
            $stmt_update_competence->execute(['nom' => $nom, 'id_competence' => $id_competence]);
        }

        // Mettre à jour la compétence dans la table 'competences_etudiants'
        $query_update_comp_etudiant = "
            UPDATE competences_etudiants
            SET commentaire = :commentaire, date_evaluation = :date_evaluation
            WHERE id_competence = :id_competence AND id_etudiant IN (
                SELECT id_etudiant FROM etudiant WHERE id_classe = :id_classe
            )
        ";
        $stmt_update_comp_etudiant = $bdd->prepare($query_update_comp_etudiant);
        $stmt_update_comp_etudiant->execute([
            'commentaire' => $commentaire,
            'date_evaluation' => $date_evaluation,
            'id_competence' => $id_competence,
            'id_classe' => $id_classe
        ]);

        $message = "Succès : La compétence a été modifiée avec succès";
        echo '<script>alert("' . $message . '"); window.location.href = "page_Prof_Ajout&Modif.php";</script>';
        exit();
    } else {
        $message = "Erreur : Aucune action effectuée car aucun champ n'a été rempli";
        echo '<script>alert("' . $message . '"); window.location.href = "page_Modif_Competence.php";</script>';
        exit();
    }
} else {
    $message = "Erreur : Aucune action effectuée car la compétence n'a pas été sélectionnée";
    echo '<script>alert("' . $message . '"); window.location.href = "page_Modif_Competence.php";</script>';
    exit();
}
?>
