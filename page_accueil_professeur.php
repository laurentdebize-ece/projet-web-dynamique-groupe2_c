<!DOCTYPE html>
<html lang="en">
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Accueil Professeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_professeur.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <script>
    $(document).ready(function() {
        <?php
        session_start();
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $premiere_connexion = $_SESSION['premiere_connexion'];

        if ($premiere_connexion == 1) {
            ?>
            var mdp = prompt("Entrez votre nouveau mot de passe (il ne sera plus modifiable) : ");
            $.ajax({
                type: 'POST',
                url: 'modification_mdp.php',
                data: {
                    mot_de_passe: mdp,
                    id_utilisateur: '<?php echo $id_utilisateur; ?>'
                },
                success: function(response) {
                    alert("Le mot de passe a été modifié avec succès. Voici votre nouveau mot de passe : " + response);
                    
                    <?php $premiere_connexion = $_SESSION['premiere_connexion'] = 0;?>
                },
                error: function() {
                    alert('Une erreur est survenue lors de la modification du mot de passe.');
                }
            });
        <?php
        }
        ?>
    });
</script>

</head>

<body>
    <?php barre_de_navigation_professeurs(); ?>
    <div class="container text-center">
        <h1>Professeur</h1>
        <div class="photo-container">
            <img src="omnes_photo.png" alt="Photo Omnes">
        </div><br>
        <h3>Omnes MySkills</h3><br>
        <p>Bienvenue sur Omnes MySkills, le site web qui permet aux étudiants de l'école Omnes d'évaluer leurs compétences dans chaque matière. Grâce à notre plateforme, les professeurs pourront lister les compétences à acquérir dans leur matière respective, et les étudiants pourront s'auto-évaluer pour chaque compétence. Tout au long de l'année, les professeurs pourront confirmer ou infirmer l'acquisition de ces compétences, permettant ainsi aux étudiants de suivre leur progression. Nous espérons que cette plateforme vous sera utile dans votre parcours éducatif à Omnes.</p>
    </div>
    <?php pied_de_page(); ?>
</body>

</html>