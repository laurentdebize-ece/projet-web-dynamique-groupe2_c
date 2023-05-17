<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Page d'ajout d'une Competence</title>
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
        <h1>Ajouter une Competence</h1>
        <form method="post" action="traitement_Ajout_Comp_Prof.php">

            <label for="matiere">Matière :</label>
            <select id="matiere" name="matiere" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                $reponse = $bdd->query('SELECT id_matiere, nom_matiere FROM matiere');
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_matiere'] . '">' . $donnees['nom_matiere'] . '</option>';
                }
                $reponse->closeCursor();
                ?>

            </select>

            <label for="classe">Classe :</label>
            <select id="classe" name="classe" required>
                <?php
                // Connexion à la base de données
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                // Récupération des données de la table 'classe'
                $reponse = $bdd->query('SELECT id_classe, nom_classe FROM classe');

                // Affichage des options de la liste déroulante
                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_classe'] . '">' . $donnees['nom_classe'] . '</option>';
                }

                // Fermeture de la connexion à la base de données
                $reponse->closeCursor();
                ?>
            </select>

            <label for="nom_competence">Nom :</label>
            <input type="text" id="nom_competence" name="nom_competence" required><br>


            <input type="submit" value="Ajouter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>