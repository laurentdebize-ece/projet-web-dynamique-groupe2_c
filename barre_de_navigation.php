<?php
function barre_de_navigation_etudiants() {
?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                <a href="page_accueil_etudiant.php">                    
                    <img src="logo_blanc2.png" alt="Logo" style="height: 25px; width: 100px;">
                    </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="page_accueil_etudiant.php">Accueil</a></li>
                    <li><a href="Matiere_etudiant_bouton.php">Matières</a></li>
                    <li><a href="Mes_Competences_Etudiant.php">Mes Compétences</a></li>
                    <li><a href="Mes_competences_transversales.php">Compétences transverses</a></li>
                    <li><a href="Toutes_les_compet.php">Toutes les Compétences</a></li>
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
function barre_de_navigation_professeurs() {
?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="logo_blanc2.png" alt="Logo" style="height: 25px; width: 100px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="page_accueil_etudiant.php">Accueil</a></li>
                    <li><a href="#band">Etudiants</a></li>
                    <li><a href="#tour">Compétences</a></li>
                    <li><a href="#contact">Validations</a></li>
                    <li><a href="#contact">Ajouts/Modifications</a></li>
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
function barre_de_navigation_administrateur() {
?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="logo_blanc2.png" alt="Logo" style="height: 25px; width: 100px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="page_accueil_etudiant.php">Accueil</a></li>
                    <li><a href="#band">Professeurs</a></li>
                    <li><a href="#tour">Etudiants</a></li>
                    <li><a href="#contact">Matieres</a></li>
                    <li><a href="#contact">Competences</a></li>
                    <li><a href="#contact">Ajouts/Modifications</a></li>
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
function pied_de_page () {
    ?>
        <div class="footer-basic">
            <footer>
                <div class="social">
                    <a href="https://www.linkedin.com/in/lilian-rage-408a7921b/"><img src="instagram.png"></a>
                    <a href="https://www.linkedin.com/in/lilian-rage-408a7921b/"><img src="linkedin.png" alt="Linkedin"></a>
                    <a href="https://www.linkedin.com/in/lilian-rage-408a7921b/"><img src="twitter.png" alt="Twitter"></a>
                    <a href="https://www.linkedin.com/in/lilian-rage-408a7921b/"><img src="facebook.png" alt="Facebook"></a>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Accueil</a></li>
                    <li class="list-inline-item"><a href="#">Mentions Légales</a></li>
                    <li class="list-inline-item"><a href="page_nous_contacter.php">Nous Contacter</a></li>
                    <li class="list-inline-item"><a href="#">Crédits</a></li>
                </ul>
                <p class="text-center">Omnes MySkills© 2023<br><br>
    
                <em> Credits : <br>Louise  -  Antoine  -  Lilian  -  Matis</em>
                </p>
            </footer>
        </div>
    <?php
    }
    
