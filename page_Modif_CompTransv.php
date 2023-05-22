<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Modifier une competence transversale</title>
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
        <form method="post" action="traitement_Modif_CompTransv.php">

            <h1>Modifier une competence transversale</h1>
            <label for="competence">Compétence transversale à modifier:</label>
            <select id="competence" name="competence" required>
                <?php
                // Connexion à la base de données
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                // Récupération des données de la table 'competences'
                $query = "SELECT id_competence, nom_competences FROM competences_transversales";
                $stmt = $bdd->query($query);

                // Affichage des options de la liste déroulante
                while ($donnees = $stmt->fetch()) {
                    $nom_competences = $donnees['nom_competences'];
                    echo '<option value="' . $donnees['id_competence'] . '">' . $nom_competences . '</option>';
                }

                // Fermeture de la connexion à la base de données
                $stmt->closeCursor();
                ?>
            </select><br>

            <h3>Modifiez les champs nécessaires</h3>

            <label for="nom">Nom de la competence :</label>
            <input type="text" id="nom" name="nom">

            <label for="matiere">Matiere:</label>
            <select id="matiere" name="matiere">
                <?php
                // Récupération des données de la table 'matiere'
                $query = "SELECT id_matiere, nom_matiere FROM matiere";
                $stmt = $bdd->query($query);

                // Affichage des options de la liste déroulante
                while ($donnees = $stmt->fetch()) {
                    $nom_matiere = $donnees['nom_matiere'];
                    echo '<option value="' . $donnees['id_matiere'] . '">' . $nom_matiere . '</option>';
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