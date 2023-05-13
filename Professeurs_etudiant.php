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
        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            
        }
        .promo-button {
            padding: 10px 20px;
            font-size: 20px;
            margin: 10px;
            cursor: pointer;
            border-radius: 12px;
            margin-top: 200px;
        }
        .classe-button {
            padding: 10px 20px;
            font-size: 20px;
            margin: 10px;
            cursor: pointer;
            border-radius: 12px;
            margin-top: 50px;
        }
        .centered {
            width: 100%;
            text-align: center;
            
        }
        .centered-table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            width: 50%; 
            margin-top: 50px;
        }
        .centered-table th, .centered-table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .centered-table th {
            background-color: #4CAF50;
            color: white;
        }

        .centered-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function showClasses(nom_promotion) {
            // Clear student details when showing classes
            $("#student-details").html('');
            $.get("Professeurs_etudiants_Bouton_classe.php", {nom_promotion: nom_promotion}, function(data){
                var classNames = data.split(','); // Assuming the names are comma-separated
                var html = '';
                for (var i = 0; i < classNames.length; i++) {
                    html += '<button class="classe-button" onclick="showStudentDetails(\'' + classNames[i] + '\')">' + classNames[i] + '</button>';
                }
                $("#results").html(html);
            });
        }

        function showStudentDetails(nom_classe) {
            $.get("Professeurs_etudiants_tableaux_etudiants.php", {nom_classe: nom_classe}, function(data){
            var students = data.split(';');
            var html = '<table class="centered-table">';
            html += '<tr><th>Nom</th><th>Prenom</th><th>Email</th></tr>';
            for (var i = 0; i < students.length; i++) {
                var details = students[i].split(',');
                html += '<tr><td>' + details[0] + '</td><td>' + details[1] + '</td><td>' + details[2] + '</td></tr>';
            }
            html += '</table>';
            $("#student-details").html(html);
            });
        }

    </script>
</head>
<body>
    <div class="flex-container">
    <div id="promotions" class="centered">
    
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

    $userId = $_SESSION['Id_utilisateur'];

    $sql = "SELECT DISTINCT p.nom_promotion 
    FROM promotion p
    JOIN classe c ON p.id_promotion = c.id_promotion
    JOIN etudiant e ON c.id_classe = e.id_classe
    JOIN etudiiant_matiere em ON e.id_etudiant = em.id_etudiant
    JOIN matiere m ON em.id_matiere = m.id_matiere
    JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
    JOIN professeur prof ON pm.id_professeur = prof.id_professeur
    WHERE prof.id_utilisateur = $userId";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<button class="promo-button" onclick="showClasses(\'' . $row["nom_promotion"] . '\')">' . $row["nom_promotion"] . '</button>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<?php barre_de_navigation(); ?>
    </div>
    <div id="results" class="centered"></div>
    <div id="student-details" class="centered"></div>
    <?php pied_de_page(); ?>
</body>
</html>

