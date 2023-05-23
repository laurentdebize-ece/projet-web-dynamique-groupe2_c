<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>
<html>

<head>
    <title>Les Matieres</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>

<body>
    <?php barre_de_navigation_administrateur(); ?>
    <h1>Les Matieres</h1>
    <?php
    $conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT m.nom_matiere, GROUP_CONCAT(DISTINCT cl.nom_classe SEPARATOR '<br />') as classes, GROUP_CONCAT(DISTINCT p.Nom_prof SEPARATOR '<br />') as professeurs
    FROM matiere m
    JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
    JOIN professeur p ON pm.id_professeur = p.id_professeur
    JOIN professeur_classe pc ON p.id_professeur = pc.id_professeur
    JOIN classe cl ON pc.id_classe = cl.id_classe
    GROUP BY m.nom_matiere
    ORDER BY m.nom_matiere";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-container'><table><tr><th>Matière</th><th>Classe</th><th>Professeur</th></tr>";
        // Afficher les données de chaque ligne
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nom_matiere"] . "</td><td>" . $row["classes"] . "</td><td>" . $row["professeurs"] . "</td></tr>";
        }
        echo "</table></div>";
    } else {
        echo "0 resultats";
    }
    $conn->close();
    ?>
    </div>
    <div id="results" class="centered"></div>
    <div id="student-details" class="centered"></div>
    <?php pied_de_page(); ?>
</body>

</html>