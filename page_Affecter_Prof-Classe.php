<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Page d'affectation d'un professeur à une classe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" type="text/css" href="css_Id_Ajout_Modif_Supp.css">
    <script>
        $(document).ready(function() {
            $('#professeur').change(function() {
                var idProfesseur = $(this).val();
                $.ajax({
                    url: 'z_affect_classe_formu.php',
                    type: 'POST',
                    data: {
                        id_professeur: idProfesseur
                    },
                    success: function(response) {
                        var classes = JSON.parse(response);
                        var options = '';
                        for (var i = 0; i < classes.length; i++) {
                            options += '<option value="' + classes[i].id_classe + '">' + classes[i].nom_classe + '</option>';
                        }
                        $('#classe').html(options);
                    }
                });
            });

            $('form').submit(function() {
                var selectedClasseId = $('#classe').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id_classe',
                    value: selectedClasseId
                }).appendTo($(this));
            });
        });
    </script>
</head>

<body>
    <div class="logo_centré">
        <img src="logo.png" alt="Logo Omnes" width="375" height="125">
    </div>
    <div class="login-box">
        <h1>Affecter un professeur à une classe</h1>
        <form method="post" action="traitement_Affect_Prof-Classe.php">

            <label for="professeur">Professeur :</label>
            <select id="professeur" name="professeur" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT id_professeur, nom_prof FROM professeur');
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_professeur'] . '">' . $donnees['nom_prof'] . '</option>';
                }
                $reponse->closeCursor();
                ?>
            </select>


            <label for="classe">Classe :</label>
            <select id="classe" name="classe" required>

            </select>

            <input type="submit" value="Affecter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>
