<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Demande d'évaluation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" type="text/css" href="css_Id_Ajout_Modif_Supp.css">
    <script>
        $(document).ready(function() {
            $('#matiere').change(function() {
                var id_matiere = $(this).val();
                $.ajax({
                    url: 'z_affect_comp_formu.php',
                    type: 'POST',
                    data: {
                        id_matiere: id_matiere
                    },
                    success: function(response) {
                        var competences = JSON.parse(response);
                        var options = '';
                        for (var i = 0; i < competences.length; i++) {
                            options += '<option value="' + competences[i].id_competences + '">' + competences[i].nom_competences + '</option>';
                        }
                        $('#competence').html(options);
                    }
                });
            });
        });
        $('form').submit(function() {
            var selectedCompetenceId = $('#competence').val();
            $('<input>').attr({
                type: 'hidden',
                name: 'id_competence',
                value: selectedCompetenceId
            }).appendTo($(this));
        });
    </script>
</head>

<body>
    <div class="logo_centré">
        <img src="logo.png" alt="Logo Omnes" width="375" height="125">
    </div>
    <div class="login-box">
        <h1>Demander a une classe de s'auto-évaluer</h1>
        <form method="post" action="traitement_Dmd_Eval.php">

            <label for="matiere">Matière :</label>

            <?php
            session_start();
            $id_utilisateur = $_SESSION['id_utilisateur'];

            $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Requête pour récupérer id_professeur en fonction de id_utilisateur
            $query = "SELECT id_professeur FROM professeur WHERE id_utilisateur = :id_utilisateur";
            $stmt = $bdd->prepare($query);
            $stmt->execute(['id_utilisateur' => $id_utilisateur]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification si l'id_professeur existe
            if ($result) {
                $id_professeur = $result['id_professeur'];

                // Requête pour récupérer les matières du professeur
                $query_matiere = "
        SELECT m.id_matiere, m.nom_matiere
        FROM matiere m
        INNER JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
        WHERE pm.id_professeur = :id_professeur
    ";
                $stmt_matiere = $bdd->prepare($query_matiere);
                $stmt_matiere->execute(['id_professeur' => $id_professeur]);
                $matieres = $stmt_matiere->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>

            <select id="matiere" name="matiere" required>
            <option disabled selected value="">Sélectionnez une Matière</option>
                <?php foreach ($matieres as $matiere) : ?>
                    <option value="<?php echo $matiere['id_matiere']; ?>"><?php echo $matiere['nom_matiere']; ?></option>
                <?php endforeach; ?>
            </select>



            <label for="classe">Classe :</label>
            <select id="classe" name="classe" required>
                <?php
                // Requête pour récupérer les classes du professeur
                $query_classe = "
        SELECT c.id_classe, c.nom_classe
        FROM classe c
        INNER JOIN professeur_classe pc ON c.id_classe = pc.id_classe
        INNER JOIN professeur p ON pc.id_professeur = p.id_professeur
        WHERE p.id_professeur = :id_professeur
    ";

                $stmt_classe = $bdd->prepare($query_classe);
                $stmt_classe->execute(['id_professeur' => $id_professeur]);
                $classes = $stmt_classe->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($classes as $classe) : ?>
                    <option value="<?php echo $classe['id_classe']; ?>"><?php echo $classe['nom_classe']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="competence">Compétence à faire évaluer :</label>
            <select id="competence" name="competence"></select>

            <label for="commentaire">Commentaire :</label>
            <input type="text" id="commentaire" name="commentaire">

            <label for="date">Date d'évaluation :</label>
            <input type="date" id="date" name="date">

            <input type="submit" value="Demander">
        </form>
    </div><br>
    <?php pied_de_page(); ?>

</body>

</html>