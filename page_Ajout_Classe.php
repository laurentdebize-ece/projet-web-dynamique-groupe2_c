<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Ajouter une classe</title>
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
        <h1>Ajouter une classe</h1>
        <form method="post" action="traitement_Ajout_Classe.php">

            <label for="ecole">Ecole :</label>
            <select id="ecole" name="ecole" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                // On récupe les données de la table 'matiere'
                $query = "SELECT id_ecole, Nom_ecole FROM ecole";
                $stmt = $bdd->query($query);

                // On affiche
                while ($donnees = $stmt->fetch()) {
                    $Nom_ecole = $donnees['Nom_ecole'];
                    echo '<option value="' . $donnees['id_ecole'] . '">' . $Nom_ecole . '</option>';
                }
                $stmt->closeCursor();
                ?>
            </select><br>

            <label for="promotion">Promotion :</label>
            <select id="promotion" name="promotion" required>
                <?php
                // On récupe les données de la table 'promotion'
                $query = "SELECT id_promotion, nom_promotion FROM promotion";
                $stmt = $bdd->query($query);

                // On affiche
                while ($donnees = $stmt->fetch()) {
                    echo '<option value="' . $donnees['id_promotion'] . '">' . $donnees['nom_promotion'] . '</option>';
                }
                $stmt->closeCursor();
                ?>
            </select><br>

            <label for="classe">Nom de la classe :</label>
            <input type="text" id="classe" name="classe" required><br>

            <input type="submit" value="Ajouter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>
</body>

</html>