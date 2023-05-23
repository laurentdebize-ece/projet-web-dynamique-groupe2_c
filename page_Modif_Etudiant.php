<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Modifier un etudiant</title>
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
        <form method="post" action="traitement_Modif_Etudiant.php">

            <h1>Modifier un Etudiant</h1>
            <label for="etudiant">Etudiant à modifier:</label>
            <select id="etudiant" name="etudiant" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                // On recup les données de la table 'etudiant' avec les infos de l'utilisateur
                $query = "SELECT e.id_etudiant, u.Nom, u.Prenom FROM etudiant e JOIN utilisateur u ON e.id_utilisateur = u.Id_utilisateur";
                $stmt = $bdd->query($query);

                while ($donnees = $stmt->fetch()) {
                    $nom = $donnees['Nom'];
                    $prenom = $donnees['Prenom'];
                    echo '<option value="' . $donnees['id_etudiant'] . '">' . $prenom . ' ' . $nom . '</option>';
                }
                $stmt->closeCursor();
                ?>
            </select><br>
            <h3>Modifiez les champs necessaires</h3>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom">

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email">

            <label for="classe">Classe :</label>
            <select id="classe" name="classe">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');

                // recup des données de la table 'classe'
                $reponse = $bdd->query('SELECT id_classe, nom_classe FROM classe');

                while ($donnees = $reponse->fetch()) {
                    echo '<option value="' . $donnees['id_classe'] . '">' . $donnees['nom_classe'] . '</option>';
                }
                $reponse->closeCursor();
                ?>
            </select><br>

            <input type="submit" value="Modifier">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>