<!DOCTYPE html>
<html lang="en">
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_Admin_6_Ajout&Modif.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>

<body>
    <?php barre_de_navigation_administrateur(); ?>
    <div class="container">
        <h2>Competences</h2>
        <div class="cadre">
            <p>Une compétence pour un élève est une capacité essentielle à accomplir une tâche spécifique ou à résoudre un problème donné. Elle regroupe les connaissances, les aptitudes et les habiletés nécessaires à la réussite dans un domaine particulier.</p>
            <div class="custom-dropdown">
                <button class="custom-dropbtn">Choisissez une option</button>
                <div class="custom-dropdown-content">
                    <a href="page_Ajout_Comp_Prof.php"target="_blank">Ajouter</a>
                    <a href="page_Ajout_Professeur.php"target="_blank">Modifier</a>
                    <a href="page_Ajout_Administrateur.php"target="_blank">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <?php pied_de_page(); ?>
</body>

</html>