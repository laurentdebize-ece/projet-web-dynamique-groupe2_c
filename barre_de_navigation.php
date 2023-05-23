<?php
function barre_de_navigation_etudiants()
{
?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="page_accueil_etudiant.php">
                    <img src="logo_blanc2.png" alt="Logo" style="height: 30px; width: 100px;">
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="page_accueil_etudiant.php">Accueil</a></li>
                    <li><a href="page_Etud_Matiere.php">Matières</a></li>
                    <li><a href="page_Etud_MesComp.php">Mes Compétences</a></li>
                    <li><a href="page_Etu_MesCompTransv.php">Compétences transverses</a></li>
                    <li><a href="page_Etud_ToutesComp.php">Toutes les Compétences</a></li>
                    <li><a href="page_profile.php">Mon Compte</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="page_nous_contacter.php">Nous Contacter</a></li>
                            <li><a href="#">Crédits</a></li>
                            <li><a href="#">Omnes & Moi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}
?>


<?php
function barre_de_navigation_professeurs()
{
?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="page_accueil_professeur.php">
                    <img src="logo_blanc2.png" alt="Logo" style="height: 30px; width: 100px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="page_accueil_professeur.php">Accueil</a></li>
                    <li><a href="page_Prof_Etudiants.php">Etudiants</a></li>
                    <li><a href="page_Prof_Competences.php">Compétences</a></li>
                    <li><a href="page_Prof_Validation.php">Validations</a></li>
                    <li><a href="page_Prof_Ajout&Modif.php">Ajouts/Modifications</a></li>
                    <li><a href="page_profile.php">Mon Compte</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="page_nous_contacter.php">Nous Contacter</a></li>
                            <li><a href="#">Crédits</a></li>
                            <li><a href="#">Omnes & Moi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}
?>


<?php
function barre_de_navigation_administrateur()
{
?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="page_accueil_administrateur.php">
                <img src="logo_blanc2.png" alt="Logo" style="height: 30px; width: 100px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="page_accueil_administrateur.php">Accueil</a></li>
                    <li><a href="page_Admin_Profs.php">Professeurs</a></li>
                    <li><a href="page_Admin_Etudiants.php">Etudiants</a></li>
                    <li><a href="page_Admin_Matieres.php">Matieres</a></li>
                    <li><a href="page_Admin_Competences.php">Competences</a></li>
                    <li><a href="page_Admin_6_Ajout&Modif.php">Ajouts/Modifications</a></li>
                    <li><a href="page_profile.php">Mon Compte</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="page_nous_contacter.php">Nous Contacter</a></li>
                            <li><a href="#">Crédits</a></li>
                            <li><a href="#">Omnes & Moi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}
?>




<?php
function pied_de_page()
{
?>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="https://instagram.com/m.matisss?igshid=MjEwN2IyYWYwYw=="><i class="icon ion-social-instagram"></i></a><a href="https://www.linkedin.com/in/matis-mur-52856019b/"><i class="icon ion-social-linkedin"></i></a><a href="https://www.linkedin.com/in/lilian-rage-408a7921b/"><i class="icon ion-social-twitter"></i></a><a href="https://github.com/laurentdebize-ece/projet-web-dynamique-groupe2_c"><i class="icon ion-social-github"></i></a></div>

            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Accueil</a></li>
                <li class="list-inline-item"><a href="#">Mentions Légales</a></li>
                <li class="list-inline-item"><a href="page_nous_contacter.php">Nous Contacter</a></li>
                <li class="list-inline-item"><a href="#">Crédits</a></li>
            </ul>
            <p class="text-center">Omnes MySkills© 2023<br><br>

                <em> Credits : <br>Louise - Antoine - Lilian - Matis</em>
            </p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

<?php
}
