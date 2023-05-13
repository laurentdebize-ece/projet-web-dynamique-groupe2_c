<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f6f6f6;
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        th {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 10px;
        }
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #dddddd;
        }
        tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
<?php
    include 'barre_de_navigation.php';
    session_start();
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "projet_info_ing2";

    // Créer une connexion
    $conn = new mysqli($servername, 'root', 'root', $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $ID_matiere_prof = $_SESSION['id_matiere']; // ou une autre méthode pour obtenir l'ID de l'utilisateur connecté

    $sql = "SELECT m.nom_matiere, c.nom_competences, ct.nom_competences 
    FROM matiere m 
    JOIN competences_matieres mc ON m.id_matiere = mc.id_matiere 
    JOIN competences c ON mc.id_competence = c.id_competences 
    JOIN compet_trans_matiere ctm ON m.id_matiere = ctm.id_matiere
    JOIN competences_transversales ct ON ctm.id_competence = ct.id_competence
    WHERE m.id_matiere = '$ID_matiere_prof'";

    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>Matiere</th><th>Competence</th></tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['nom_matiere'] . "</td><td>" . $row['nom_competences'] . "</td></tr>";
        }
    }
    echo "</table>";

    $conn->close();
?>
<?php barre_de_navigation(); ?>
    </div>
    <div id="results" class="centered"></div>
    <div id="student-details" class="centered"></div>
    <?php pied_de_page(); ?>
</body>
</html>