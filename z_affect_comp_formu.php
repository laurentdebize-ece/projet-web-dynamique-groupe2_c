<?php
if (isset($_POST['id_matiere'])) {
    $id_matiere = $_POST['id_matiere'];

    session_start();
    $id_utilisateur = $_SESSION['id_utilisateur'];

    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête pour récupérer id_professeur en fonction de id_utilisateur
    $query = "SELECT id_professeur FROM professeur WHERE id_utilisateur = :id_utilisateur";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['id_utilisateur' => $id_utilisateur]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_professeur = $result['id_professeur'];

    $query = "
        SELECT c.id_competences, c.nom_competences
        FROM competences_matieres cm
        INNER JOIN competences c ON cm.id_competence = c.id_competences
        WHERE cm.id_matiere = :id_matiere AND c.id_professeur = :id_professeur
    ";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['id_matiere' => $id_matiere, 'id_professeur' => $id_professeur]);
    $competences = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($competences);
}
