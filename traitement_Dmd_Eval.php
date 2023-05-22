<?php
session_start();

// Connexion à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_competence = $_POST["competence"];
    $id_classe = $_POST["classe"];

    if ($_POST['commentaire'] === NULL) {
        $commentaire = '';
    } else {
        $commentaire = $_POST['commentaire'];
    }
    if ($_POST['date'] === '') {
        $date = NULL;
    } else {
        $date = $_POST['date'];
    }

    // Récupérer les ID des étudiants de la classe sélectionnée
    $query_students = "
        SELECT id_etudiant
        FROM etudiant
        WHERE id_classe = :id_classe
    ";
    $stmt_students = $bdd->prepare($query_students);
    $stmt_students->execute(['id_classe' => $id_classe]);
    $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

    // Parcourir la liste des ID des étudiants et effectuer la modification

    foreach ($students as $student) {
        $id_etudiant = $student['id_etudiant'];

        // Requête de modification des données pour chaque étudiant
        $query = "
            UPDATE competences_etudiants
            SET Id_niveau_acquisition = 1, commentaire = :commentaire, date_evaluation = :date_evaluation
            WHERE id_competence = :id_competence AND id_etudiant = :id_etudiant
        ";
        $stmt = $bdd->prepare($query);
        $result = $stmt->execute([
            'commentaire' => $commentaire,
            'date_evaluation' => $date,
            'id_competence' => $id_competence,
            'id_etudiant' => $id_etudiant
        ]);

        $affected = 0; // Nombre de lignes affectées

        if ($result && $stmt->rowCount() > 0) {
            $affected++;
        }
    }

    // Vérifier si aucune ligne n'a été affectée
    if ($affected === 0) {
        echo '<script>
            alert("Aucun étudiant de la classe sélectionnée n\'a été affecté à la compétence sélectionnée.");
            window.location.href = "page_Prof_Dmd_Eval.php";
        </script>';
        exit();
    } else {
        echo '<script>
            alert("Ajout de l auto-evaluation de competence effectué.");
            window.location.href = "page_Prof_Ajout&Modif.php";
        </script>';
        exit();
    }
}
