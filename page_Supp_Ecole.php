<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Supprimer une école</title>
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
        <h1>Supprimer une école</h1>
        <form method="post" action="traitement_Supp_Ecole.php">

        <label for="ecole">Ecole :</label>
            <select id="ecole" name="ecole" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                $reponse = $bdd->query('SELECT id_ecole, Nom_ecole FROM ecole');
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_ecole'] . '">' . $donnees['Nom_ecole'] . '</option>';
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