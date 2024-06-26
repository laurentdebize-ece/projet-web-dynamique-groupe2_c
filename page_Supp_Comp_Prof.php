<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Supprimer une competence</title>
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
        <form method="post" action="traitement_Supp_Comp_Prof.php">

            <h1>Modifier une compétence</h1>
            <label for="competence">Compétence à modifier:</label>
            <select id="competence" name="competence" required>
                <?php

                session_start();
                $id_utilisateur = $_SESSION['id_utilisateur'];

                $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT id_professeur FROM professeur WHERE id_utilisateur = :id_utilisateur";
                $stmt = $bdd->prepare($query);
                $stmt->execute(['id_utilisateur' => $id_utilisateur]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $id_professeur = $result['id_professeur'];

                    $query_matiere = "
            SELECT m.id_matiere, m.nom_matiere
            FROM matiere m
            INNER JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
            WHERE pm.id_professeur = :id_professeur
        ";
                    $stmt_matiere = $bdd->prepare($query_matiere);
                    $stmt_matiere->execute(['id_professeur' => $id_professeur]);
                    $matieres = $stmt_matiere->fetchAll(PDO::FETCH_ASSOC);


                    foreach ($matieres as $matiere) {
                        echo "<optgroup label='" . $matiere['nom_matiere'] . "'>";


                        $query_competence = "
                SELECT c.id_competences, c.nom_competences
                FROM competences c
                INNER JOIN competences_matieres cm ON c.id_competences = cm.id_competence
                WHERE cm.id_matiere = :id_matiere
            ";
                        $stmt_competence = $bdd->prepare($query_competence);
                        $stmt_competence->execute(['id_matiere' => $matiere['id_matiere']]);
                        $competences = $stmt_competence->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($competences as $competence) {
                            echo "<option value='" . $competence['id_competences'] . "'>" . $competence['nom_competences'] . "</option>";
                        }

                        echo "</optgroup>";
                    }
                }
                ?>
            </select>

            <input type="submit" value="Supprimer">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>