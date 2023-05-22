<!DOCTYPE html>
<html lang="en">
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Ajout & Modification</title>
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
                    <a href="page_Ajout_Etudiant.php">Ajouter un étudiant</a>
                    <a href="page_Ajout_Professeur.php">Ajouter un professeur</a>
                    <a href="page_Ajout_Administrateur.php">Ajouter un administrateur</a>
                    <a href="page_Ajout_Matiere.php">Ajouter une matière</a>
                    <a href="page_Ajout_Classe.php">Ajouter une classe</a>
                    <a href="page_Ajout_Promo.php">Ajouter une promotion</a>
                    <a href="page_Ajout_Ecole.php">Ajouter une ecole</a>
                    <a href="page_Ajout_Competence.php">Ajouter une compétence</a>
                    <a href="page_Ajout_CompTransv.php">Ajouter une compétence transverse</a>
                    <a href="page_Affecter_Matiere-Classe.php">Affecter une classe à une matière</a>
                    <a href="page_Affecter_Mat-Prof.php">Affecter un professeur à une matière</a>
                    <a href="page_Affecter_Prof-Classe.php">Affecter un professeur à une classe</a>
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
                    <a href="page_Modif_Etudiant.php">Modifier un étudiant</a>
                    <a href="page_Modif_Professeur.php">Modifier un professeur</a>
                    <a href="page_Modif_Matiere.php">Modifier une matière</a>
                    <a href="page_Modif_Classe.php">Modifier une classe</a>
                    <a href="page_Modif_Ecole.php">Modifier une ecole</a>
                    <a href="page_Modif_Competence.php">Modifier une compétence</a>
                    <a href="page_Modif_CompTransv.php">Modifier une compétence transverse</a>
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
                    <a href="page_Supp_Utilisateur.php">Supprimer un utilisateur</a>
                    <a href="page_Supp_Matiere.php">Supprimer une matière</a>
                    <a href="page_Supp_Classe.php">Supprimer une classe</a>
                    <a href="page_Supp_Promotion.php">Supprimer une promotion</a>
                    <a href="page_Supp_Ecole.php">Supprimer une ecole</a>
                    <a href="page_Supp_Competence.php">Supprimer une compétence</a>
                    <a href="page_Supp_CompTransv.php">Supprimer une compétence transverse</a>
                </div>
            </div>
        </div>
    </div><br>
    <?php pied_de_page(); ?>
</body>

</html>
