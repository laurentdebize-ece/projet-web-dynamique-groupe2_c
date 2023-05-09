<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Page d'ajout d'un Etudiant</title>
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
        <h1>Ajouter un Etudiant</h1>
        <form method="post" action="traitement_Ajout_Etudiant.php">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required><br>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>

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

            <input type="submit" value="Ajouter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>