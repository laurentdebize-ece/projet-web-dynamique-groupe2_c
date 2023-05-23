<!DOCTYPE html>
<html lang="en">
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Accueil Professeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
    <script type="text/javascript" src="page_accueil_etudiant.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
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

                        <?php $premiere_connexion = $_SESSION['premiere_connexion'] = 0; ?>
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
    
    <h1>Professeur</h1>
    <canvas id="bubbleCanvas"></canvas>

    <div class="container text-center">
        <div style="width: 90%; margin: auto;">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="ecole1.png" alt="ecole1">
                        <div class="carousel-caption">
                        </div>
                    </div>

                    <div class="item">
                        <img src="lions.png" alt="lions">
                        <div class="carousel-caption">
                        </div>
                    </div>

                    <div class="item">
                        <img src="dinos.png" alt="dinos">
                        <div class="carousel-caption">
                        </div>
                    </div>
                </div>

                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div><br>
        <h3>Omnes MySkills</h3><br>
        <p>Bienvenue sur Omnes MySkills, le site web qui permet aux étudiants de l'école Omnes d'évaluer leurs compétences dans chaque matière. Grâce à notre plateforme, les professeurs pourront lister les compétences à acquérir dans leur matière respective, et les étudiants pourront s'auto-évaluer pour chaque compétence. Tout au long de l'année, les professeurs pourront confirmer ou infirmer l'acquisition de ces compétences, permettant ainsi aux étudiants de suivre leur progression. Nous espérons que cette plateforme vous sera utile dans votre parcours éducatif à Omnes.</p>
    </div>

    <?php pied_de_page(); ?>
</body>

</html>