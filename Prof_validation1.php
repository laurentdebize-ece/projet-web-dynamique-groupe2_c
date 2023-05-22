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
            background-color: #808080;
            
        }
        .classe-button {
            padding: 10px 20px;
            font-size: 20px;
            margin: 10px;
            cursor: pointer;
            border-radius: 12px;
            margin-top: 50px;
            background-color: #808080;
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
            background-color: #0056b3;
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
            $.get("Prof_validation2.php", {nom_promotion: nom_promotion}, function(data){
                var classNames = data.split(','); // Assuming the names are comma-separated
                var html = '';
                for (var i = 0; i < classNames.length; i++) {
                    html += '<button  class="btn btn-primary classe-button" onclick="showStudentDetails(\'' + classNames[i] + '\')">' + classNames[i] + '</button>';
                }
                $("#results").html(html);
            });
        }

        function showStudentDetails(nom_classe) {
            $.get("Prof_validation3.php", {nom_classe: nom_classe}, function(data){
                var students = data.split(';');
                var html = '<table class="centered-table">';
                html += '<tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Competence</th><th>Niveau d\'acquisition</th><th>Validation</th><th>Commentaire</th></tr>';
                for (var i = 0; i < students.length; i++) {
                    var details = students[i].split(',');
                    html += '<tr><td>' + details[0] + '</td><td>' + details[1] + '</td><td>' + details[2] + '</td><td>' + details[3] + '</td><td>' + details[4] + '</td>';
                    html += '<td><form class="validation-form" action="javascript:void(0);" method="post"><input type="hidden" name="competence_id" value="' + details[5] + '"><input type="hidden" name="etudiant_id" value="' + details[6] + '"><select name="validation"><option value="1">Oui</option><option value="2">Non</option></select><input type="submit" value="Envoyer"></form></td>';
                    html += '<td><form class="comment-form" action="javascript:void(0);" method="post"><input type="hidden" name="competence_id" value="' + details[5] + '"><input type="hidden" name="etudiant_id" value="' + details[6] + '"><input type="text" id="commentaire-'+details[6]+'-'+details[5]+'" name="comment" placeholder="Enter your comment here"><input type="submit" value="Submit"></form></td></tr>';
                }
                html += '</table>';
                $("#student-details").html(html);
            });
        }

        $(document).ready(function() {
            $(document).on('submit', '.comment-form', function(e) {
                e.preventDefault();
                var etudiantId = $(this).find('input[name="etudiant_id"]').val();
                var competenceId = $(this).find('input[name="competence_id"]').val();
                updateComment(etudiantId, competenceId);
            });
            $(document).on('submit', '.validation-form', function(event) {
                event.preventDefault();
                var competenceId = $(this).find('input[name="competence_id"]').val();
                var etudiantId = $(this).find('input[name="etudiant_id"]').val();
                var validation = $(this).find('select[name="validation"]').val();
                updateValidation(etudiantId, competenceId, validation);
            });
        });

        function updateComment(etudiantId, competenceId) {
            var commentaire = $('#commentaire-'+etudiantId+'-'+competenceId).val();
            $.post("update_comment.php", {etudiant_id: etudiantId, competence_id: competenceId, commentaire: commentaire}, function(response) {
                // This function is called when the request is successful
                console.log("Response from server: " + response);
                // Here you can update your page based on the response from the server
                if (response == "Record updated successfully") {
                    alert("Comment updated successfully");
                } else {
                    alert("Error updating comment");
                }
            });
        }
        
        function updateValidation(etudiantId, competenceId, validation) {
            $.ajax({
                url: "update_validation.php",
                type: "POST",
                data: { etudiant_id: etudiantId, competence_id: competenceId, validation: validation },
                success: function(response) {
                    console.log("Response from server: " + response);
                    if (response === "Record updated successfully") {
                        alert("Validation mise à jour avec succès");
                    } else {
                        alert("Erreur lors de la mise à jour de la validation");
                    }
                },
                error: function() {
                    alert("Une erreur s'est produite lors de la requête AJAX");
                }
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
        echo '<button class=" btn btn-primary promo-button" onclick="showClasses(\'' . $row["nom_promotion"] . '\')">' . $row["nom_promotion"] . '</button>';
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
    
</body>
<p><?php pied_de_page(); ?></p>
</html>

