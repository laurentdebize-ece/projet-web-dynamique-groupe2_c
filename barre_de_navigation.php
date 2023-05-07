<?php
function barre_de_navigation() {
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
                    <li><a href="Matiere_etudiant.php">Matières</a></li>
                    <li><a href="Mes_Competences_Etudiant.php">Mes Compétences</a></li>
                    <li><a href="test4.php">Compétences transverses</a></li>
                    <li><a href="test2.php">Toutes les Compétences</a></li>
                    <li><a href="page_profile.php">Mon Compte</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Nous Contacter</a></li>
                            <li><a href="#">Crédits</a></li>
                            <li><a href="#">Omnes & Moi</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
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
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Accueil</a></li>
                <li class="list-inline-item"><a href="#">Mentions Légales</a></li>
                <li class="list-inline-item"><a href="#">Nous Contacter</a></li>
                <li class="list-inline-item"><a href="#">Crédits</a></li>
            </ul>
            <p class="text-center">Omnes MySkills© 2023<br><br>

            <em> Credits : <br>Louise  -  Antoine  -  Lilian  -  Matis</em>
            </p>
        </footer>
    </div>
<?php
}
?>