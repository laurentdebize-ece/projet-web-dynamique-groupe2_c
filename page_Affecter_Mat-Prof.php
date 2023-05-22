<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Affecter une matière a un professeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" type="text/css" href="css_Id_Ajout_Modif_Supp.css">
    <script>
        $(document).ready(function() {
            $('#matiere').change(function() {
                var id_matiere = $(this).val();
                $.ajax({
                    url: 'z_affect_prof_formu.php',
                    type: 'POST',
                    data: {
                        id_matiere: id_matiere
                    },
                    success: function(response) {
                        var professeurs = JSON.parse(response);
                        var options = '';
                        for (var i = 0; i < professeurs.length; i++) {
                            options += '<option value="' + professeurs[i].id_professeur + '">' + professeurs[i].nom_prof + '</option>';
                        }
                        $('#professeur').html(options);
                    }
                });
            });
        });
        $('form').submit(function() {
        var selectedProfesseurId = $('#professeur').val();
        $('<input>').attr({
            type: 'hidden',
            name: 'id_professeur',
            value: selectedProfesseurId
        }).appendTo($(this));
    });
    </script>
</head>

<body>
    <div class="logo_centré">
        <img src="logo.png" alt="Logo Omnes" width="375" height="125">
    </div>
    <div class="login-box">
        <h1>Affecter une matière a un professeur</h1>

        <form method="post" action="traitement_Affect_Mat-Prof.php">

            <label for="matiere">Matière :</label>
            <select id="matiere" name="matiere" required>
            <option disabled selected value="">Sélectionnez une Matière</option>


                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT id_matiere, nom_matiere FROM matiere');
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_matiere'] . '">' . $donnees['nom_matiere'] . '</option>';
                }
                $reponse->closeCursor();
                ?>
            </select>

            <label for="professeur">Professeur :</label>
            <select id="professeur" name="professeur" required>
                
            </select>

            <input type="submit" value="Ajouter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>