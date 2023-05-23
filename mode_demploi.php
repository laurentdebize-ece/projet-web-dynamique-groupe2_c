<!DOCTYPE html>
<html lang="en">

<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Mode d'emploi Ajout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="page_accueil_etudiant.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="mode_demploi.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <style>
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php barre_de_navigation_administrateur(); ?>
    <h1>Mode d'emploi</h1>
    <canvas id="bubbleCanvas"></canvas>
    <div class="container">
        Ce mode d'emploi est necessaire pour vous assurer d'entrer corresctement vos données dans la base. Pour ajouter une entité, il faut s'assurer que les entités
        situés au dessus de celle-ci dans la liste soient déjà créées. Si elles n'existent point, il vous faudra créer cette entitée. <br><br>
        <ul>
            <li>Existance de l'école</li>
            <li>Existance de la promotion dans cette école</li>
            <li>Existance de la matiere</li>
            <li>Existance de la classes correspondante a une promotion et une ecole</li>
            <li>Existance d'un professeur</li>
            <li>Existance des etudiants</li>
            <li>Lien entre une matiere et un professeur</li>
            <li>Lien entre une classe et un professeur</li>
            <li>Lien entre une classe et une matiere</li>
        </ul>
    </div>
    <?php pied_de_page(); ?>
</body>

</html>