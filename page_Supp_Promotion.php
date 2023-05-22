<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Supprimer une promotion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <h1>Supprimer une promotion</h1>
        <form method="post" action="traitement_Supp_Promotion.php">

        <label for="promotion">Promotion :</label>
            <select id="promotion" name="promotion" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                $reponse = $bdd->query('SELECT id_promotion, nom_promotion FROM promotion');
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_promotion'] . '">' . $donnees['nom_promotion'] . '</option>';
                }
                $reponse->closeCursor();
                ?>
            </select>
            
            <input type="submit" value="Supprimer">
        </form>
    </div><br>
    <?php pied_de_page(); ?>
</body>

</html>