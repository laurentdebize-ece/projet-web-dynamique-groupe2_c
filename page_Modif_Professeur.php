<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Modifier un professeur</title>
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
        <form method="post" action="traitement_Modif_Professeur.php">

            <h1>Modifier un professeur</h1>
            <label for="etudiant">Professeur à modifier:</label>
            <select id="etudiant" name="etudiant" required>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
                $query = "SELECT p.id_professeur, u.Nom, u.Prenom FROM professeur p JOIN utilisateur u ON p.id_utilisateur = u.Id_utilisateur";
                $stmt = $bdd->query($query);

                while ($donnees = $stmt->fetch()) {
                    $nom = $donnees['Nom'];
                    $prenom = $donnees['Prenom'];
                    echo '<option value="' . $donnees['id_professeur'] . '">' . $prenom . ' ' . $nom . '</option>';
                }

                $stmt->closeCursor();
                ?>
            </select><br>
            <h3>Modifiez les champs nécessaires</h3>

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
