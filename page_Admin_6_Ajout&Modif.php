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
        <h2>Ajout</h2>
        <div class="cadre">
            <p>Les possibilités d'ajouts offertes sont variées et permettent de gérer efficacement votre système. Vous pouvez ajouter de nouveaux profils d'utilisateurs avec ses informations personnelles. Explorez ces options pour personnaliser votre système selon vos besoins spécifiques.</p>
            <div class="custom-dropdown">
                <button class="custom-dropbtn">Choisissez une option</button>
                <div class="custom-dropdown-content">
                    <a href="page_Ajout_Etudiant.php"target="_blank">Ajouter un étudiant</a>
                    <a href="page_Ajout_Professeur.php"target="_blank">Ajouter un professeur</a>
                    <a href="page_Ajout_Administrateur.php"target="_blank">Ajouter un administrateur</a>
                    <a href="page_Ajout_Matiere.php"target="_blank">Ajouter une matière</a>
                    <a href="page_Ajout_Classe.php"target="_blank">Ajouter une classe</a>
                    <a href="page_Ajout_Competence.php"target="_blank">Ajouter une compétence</a>
                    <a href="page_Ajout_CompetenceTransv.php"target="_blank">Ajouter une compétence transverse</a>
                    <a href="#"target="_blank">Affecter une classe à une matière</a>
                    <a href="page_Affecter_Mat-Prof.php"target="_blank">Affecter un professeur à une matière</a>
                    <a href="page_Affecter_Prof-Classe.php"target="_blank">Affecter un professeur à une classe</a>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
    <h2>Modification</h2>
        <div class="cadre">
        <p>Les possibilités de modification offertes sont variées et permettent de mettre à jour efficacement votre système. Vous pouvez modifier les profils d'utilisateurs existants en modifiant leurs informations personnelles. Explorez ces options pour personnaliser votre système selon vos besoins spécifiques.</p>
            <div class="custom-dropdown">
                <button class="custom-dropbtn">Choisissez une option</button>
                <div class="custom-dropdown-content">
                    <a href="a.php"target="_blank">Modifier un étudiant</a>
                    <a href="b.php"target="_blank">Modifier un professeur</a>
                    <a href="c.php"target="_blank">Modifier une matière</a>
                    <a href="ajouter_matiere.php"target="_blank">Modifier une compétence</a>
                    <a href="ajouter_matiere.php"target="_blank">Modifier une compétence transverse</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
    <h2>Suppression</h2>
        <div class="cadre">
        <p>Les possibilités de suppression offertes sont variées et permettent de gérer efficacement votre système. Vous pouvez supprimer des profils d'utilisateurs existants ainsi que leurs informations personnelles. Explorez ces options pour personnaliser votre système selon vos besoins spécifiques.</p>
            <div class="custom-dropdown">
                <button class="custom-dropbtn">Choisissez une option</button>
                <div class="custom-dropdown-content">
                    <a href="page_Supp_Utilisateur"target="_blank">Supprimer un utilisateur</a>
                    <a href="page_Supp_Matiere.php"target="_blank">Supprimer une matière</a>
                    <a href="page_Supp_Competence.php"target="_blank">Supprimer une compétence</a>
                    <a href="page_Supp_CompetenceTransv.php"target="_blank">Supprimer une compétence transverse</a>
                </div>
            </div>
        </div>
    </div>
    <?php pied_de_page(); ?>
</body>

</html>