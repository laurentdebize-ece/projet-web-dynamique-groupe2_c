<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Ajouter une matiere</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" type="text/css" href="css_Id_Ajout_Modif_Supp.css">
</head>

<body>
    <div class="logo_centré">
        <img src="logo.png" alt="Logo Omnes" width="375" height="125"> 
    </div>
    <div class="login-box">
        <h1>Ajouter une matiere</h1>
        <form method="post" action="traitement_Ajout_Matiere.php">

            <label for="nom_matiere">Nom :</label>
            <input type="text" id="nom_matiere" name="nom_matiere" required><br>

            <label for="volume_horaire">Volume horaire :</label>
            <input type="number" id="volume_horaire" name="volume_horaire" min="0" required><br>

            <input type="submit" value="Ajouter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>
</body>

</html>