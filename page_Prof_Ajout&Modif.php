<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Ajout & Modification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_Admin_6_Ajout&Modif.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>

<body>
    <?php barre_de_navigation_professeurs(); ?>
    <div class="container">
        <h2>Competences</h2>
        <div class="cadre">
            <p>Une compétence pour un élève est une capacité essentielle à accomplir une tâche spécifique ou à résoudre un problème donné. Elle regroupe les connaissances, les aptitudes et les habiletés nécessaires à la réussite dans un domaine particulier.</p>
            <div class="custom-dropdown">
                <button class="custom-dropbtn">Choisissez une option</button>
                <div class="custom-dropdown-content">
                    <a href="page_Ajout_Comp_Prof.php">Ajouter</a>
                    <a href="page_Modif_Comp_Prof.php">Modifier</a>
                    <a href="page_Supp_Comp_Prof.php">Supprimer</a>
                </div>
            </div>
        </div><br><br>
        <h2>Evaluations</h2>
        <div class="cadre">
            <p>Il est possible d'ajouter une fonctionnalité d'auto-évaluation pour les élèves, vous permettant de saisir un commentaire et une date d'évaluation. Cette fonctionnalité favorise la réflexion sur les compétences, la documentation des progrès et contribue à leur développement personnel et académique.</p>
            <button class="custom-dropbtn" onclick="window.open('page_Prof_Dmd_Eval.php')">Ajouter</button>
        </div>

    </div>
    <?php pied_de_page(); ?>
</body>

</html>