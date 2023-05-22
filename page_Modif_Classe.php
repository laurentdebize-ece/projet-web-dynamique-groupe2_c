<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Modifier une classe</title>
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
        <form method="post" action="traitement_Modif_Classe.php">

            <h1>Modifier une classe</h1>
            <label for="classe">Classe à modifier:</label>
            <select id="classe" name="classe" required>
                <?php
                // Connexion à la base de données
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                // Récupération des données de la table 'classe'
                $query = "SELECT id_classe, nom_classe FROM classe";
                $stmt = $bdd->query($query);

                // Affichage des options de la liste déroulante
                while ($donnees = $stmt->fetch()) {
                    $nom_classe = $donnees['nom_classe'];
                    echo '<option value="' . $donnees['id_classe'] . '">' . $nom_classe . '</option>';
                }

                // Fermeture de la connexion à la base de données
                $stmt->closeCursor();
                ?>
            </select><br>
            <h3>Modifiez les champs nécessaires</h3>

            <label for="nom">Nom de la classe :</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="ecole">Ecole :</label>
            <select id="ecole" name="ecole" required>
                <?php
                // Récupération des données de la table 'matiere'
                $query = "SELECT id_ecole, Nom_ecole FROM ecole";
                $stmt = $bdd->query($query);

                // Affichage des options de la liste déroulante
                while ($donnees = $stmt->fetch()) {
                    $Nom_ecole = $donnees['Nom_ecole'];
                    echo '<option value="' . $donnees['id_ecole'] . '">' . $Nom_ecole . '</option>';
                }

                // Fermeture de la connexion à la base de données
                $stmt->closeCursor();
                ?>
            </select><br>

            <label for="promotion">Promotion :</label>
            <select id="promotion" name="promotion" required>
                <?php
                // Récupération des données de la table 'matiere'
                $query = "SELECT id_promotion, nom_promotion FROM promotion";
                $stmt = $bdd->query($query);

                // Affichage des options de la liste déroulante
                while ($donnees = $stmt->fetch()) {
                    echo '<option value="' . $donnees['id_promotion'] . '">' . $donnees['nom_promotion'] . '</option>';
                }

                // Fermeture de la connexion à la base de données
                $stmt->closeCursor();
                ?>
            </select><br>

            <input type="submit" value="Modifier">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>