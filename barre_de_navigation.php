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
                    <img src="logo_blanc2.png" alt="Logo" style="height: 25px; width: 100px;">
                </a>
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
                            <li><a href="#">Nous Contacter</a></li>
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
                            <li><a href="#">Nous Contacter</a></li>
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
                            <li><a href="#">Nous Contacter</a></li>
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
