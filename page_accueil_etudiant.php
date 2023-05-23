<!DOCTYPE html>
<html lang="en">

<?php include 'barre_de_navigation.php'; ?>

<head>
  <title>Accueil Etudiant</title>
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
  <?php barre_de_navigation_etudiants(); ?>
  <canvas id="bubbleCanvas"></canvas>
  <h1>Etudiant</h1>
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
            <a href="page_Etud_Matiere1.php?matiere_id=2"><img src="Physique.jpg" alt="Physique"></a>
            <div class="carousel-caption">
              <h3>Physique</h3>
            </div>
          </div>

          <div class="item">
            <a href="page_Etud_Matiere1.php?matiere_id=1"><img src="maths.jpg" alt="Mathématiques"></a>
            <div class="carousel-caption">
              <h3>Mathématiques</h3>
            </div>
          </div>

          <div class="item">
            <a href="page_Etud_Matiere1.php?matiere_id=3"><img src="info.jpg" alt="Informatique"></a>
            <div class="carousel-caption">
              <h3>Informatique</h3>
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
    <h3>Omnes MySkills</h3>
    <p>Bienvenue sur Omnes MySkills, le site web qui permet aux étudiants de l'école Omnes d'évaluer leurs compétences dans chaque matière. Grâce à notre plateforme, les professeurs pourront lister les compétences à acquérir dans leur matière respective, et les étudiants pourront s'auto-évaluer pour chaque compétence. Tout au long de l'année, les professeurs pourront confirmer ou infirmer l'acquisition de ces compétences, permettant ainsi aux étudiants de suivre leur progression. Nous espérons que cette plateforme vous sera utile dans votre parcours éducatif à Omnes.</p>
  </div>

  <div id="notificationContainer"></div>
  <?php
  $conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
  if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
  }
  $idUtilisateur = $_SESSION['id_utilisateur'];

  $sql2 = "SELECT DISTINCT m.id_matiere, m.nom_matiere, c.id_competences, c.nom_competences, ce.Id_niveau_acquisition, e.id_utilisateur,e.id_etudiant, ce.commentaire, ce.date_evaluation, p.Nom_prof, ac.nom AS acquisition, vp.nom_validation
  FROM matiere AS m
  JOIN competences_matieres AS cm ON m.id_matiere = cm.id_matiere
  JOIN competences AS c ON cm.id_competence = c.id_competences
  JOIN competences_etudiants AS ce ON c.id_competences = ce.id_competence
  JOIN etudiant AS e ON ce.id_etudiant = e.id_etudiant
  JOIN professeur AS p ON c.id_professeur = p.id_professeur
  JOIN acquisition_competences AS ac ON ce.Id_niveau_acquisition = ac.id
  JOIN validation_prof AS vp ON ce.validation_prof = vp.id_validation
  WHERE e.id_utilisateur = $idUtilisateur AND ce.date_evaluation = CURDATE()";

  $result2 = $conn->query($sql2);

  if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $idNiveauAcquisition = $row["Id_niveau_acquisition"];

    if ($idNiveauAcquisition == 1) {
      $nomCompetence = $row["nom_competences"];
      echo '<script>
        localStorage.setItem("notification2", "Compétence à évaluer pour ce jour : <br><br>' . $nomCompetence . '");
    </script>';
      echo '<div id="notificationContainer2"></div>';
    }
  }
  ?>
  ƒ

  <?php pied_de_page(); ?>
</body>

</html>