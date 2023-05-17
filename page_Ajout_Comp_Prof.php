<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Page d'ajout d'une Compétence</title>
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
        <h1>Ajouter une Compétence</h1>
        <form method="post" action="traitement_Ajout_Comp_Prof.php">
            <label for="nom_competence">Nom :</label>
            <input type="text" id="nom_competence" name="nom_competence" required><br>

            <label for="matiere">Matière :</label>
            <select id="matiere" name="matiere" required>
                <?php
                // Récupération de l'identifiant du professeur depuis la session
                $id_professeur = $_SESSION['id_professeur'];

                // Requête pour récupérer les matières enseignées par le professeur
                $stmt = $bdd->prepare("
                    SELECT m.id_matiere, m.nom_matiere
                    FROM matiere m
                    INNER JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
                    WHERE pm.id_professeur = :id_professeur
                ");
                $stmt->bindParam(':id_professeur', $id_professeur);
                $stmt->execute();
                while ($donnees = $stmt->fetch()) {
                    echo '<option value="' . $donnees['id_matiere'] . '">' . $donnees['nom_matiere'] . '</option>';
                }
                ?>
            </select>

            <label for="classe">Classe :</label>
            <select id="classe" name="classe" required>
                <!-- Ajoutez ici les options correspondant aux classes -->
            </select>

            <input type="submit" value="Ajouter">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>
