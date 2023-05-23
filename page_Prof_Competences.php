<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<html>

<head>
    <title>Mes Competences</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" href="page_Prof_Competences.css">
</head>

<body>
    <?php barre_de_navigation_professeurs(); ?>
    <h1>Mes Competences</h1>
    <?php
    session_start();
    $conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id_utilisateur = $_SESSION['id_utilisateur'];

    // on recup l'ID professeur à partir de l'ID utilisateur
    $sql = "SELECT id_professeur FROM professeur WHERE id_utilisateur = '$id_utilisateur'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_professeur = $row['id_professeur'];
    } else {
        echo "Erreur : Aucun professeur trouvé pour cet utilisateur.";
        exit();
    }

    $sql_matiere_prof = "SELECT id_matiere FROM professeur_matiere WHERE id_professeur = '$id_professeur'";
    $result_matiere_prof = $conn->query($sql_matiere_prof);

    if ($result_matiere_prof === false || $result_matiere_prof->num_rows === 0) {
        echo "Erreur : Aucune matière trouvée pour cet utilisateur.";
        exit();
    }

    $row_matiere_prof = $result_matiere_prof->fetch_assoc();
    $ID_matiere_prof = $row_matiere_prof['id_matiere'];


    $sql = "SELECT m.nom_matiere, c.nom_competences
    FROM matiere m
    JOIN competences_matieres mc ON m.id_matiere = mc.id_matiere
    JOIN competences c ON mc.id_competence = c.id_competences
    WHERE m.id_matiere = '$ID_matiere_prof' AND c.id_professeur = '$id_professeur'";

    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>Matière</th><th>Compétence</th></tr>";
    if ($result->num_rows > 0) {
        $displayedCompetences = array();  
        while ($row = $result->fetch_assoc()) {

            if (!in_array($row['nom_competences'], $displayedCompetences)) {
                echo "<tr><td>" . $row['nom_matiere'] . "</td><td>" . $row['nom_competences'] . "</td></tr>";
                $displayedCompetences[] = $row['nom_competences'];  
            }
        }
    } else {
        echo "<tr><td colspan='2'>Aucun résultat</td></tr>";
    }
    echo "</table>";

    $conn->close();
    ?>

    <div id="results" class="centered"></div>
    <div id="student-details" class="centered"></div>
    <?php pied_de_page(); ?>
</body>

</html> 