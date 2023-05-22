<!DOCTYPE html> 
<?php 
include 'barre_de_navigation.php'; 

function getProfessors($id_matiere) {
    $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
    $stmt = $bdd->prepare("
        SELECT professeur.id_professeur, professeur.Nom_prof 
        FROM professeur 
        INNER JOIN professeur_matiere 
        ON professeur.id_professeur = professeur_matiere.id_professeur 
        WHERE professeur_matiere.id_matiere = :id_matiere
    ");
    $stmt->execute(['id_matiere' => $id_matiere]);
    $professeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $professeurs;
}

?>
<head>
  <title>Page d'ajout d'une Competence</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
  <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
  <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
  <link rel="stylesheet" href="pied_de_page.css">
  <link rel="stylesheet" type="text/css" href="test_ajout4.css">

  <script>
    $(document).ready(function() {
      $('#matiere').change(function() {
        var id_matiere = $(this).val();
        $.ajax({
          url: 'test_ajout2.php',
          type: 'POST',
          data: {id_matiere: id_matiere},
          success: function(response) {
            var professeurs = JSON.parse(response);
            var options = '';
            for (var i = 0; i < professeurs.length; i++) {
              options += '<option value="' + professeurs[i].id_prof + '">' + professeurs[i].nom_prof + '</option>';
            }
            $('#professeur').html(options);
          }
        });
      });
    });
  </script>

</head>
<body>
  <div class="logo_centré">
    <img src="logo.png" alt="Logo Omnes" width="375" height="125">
  </div>
  <div class="login-box">
    <h1>Ajouter une Competence</h1>
    <form method="post" action="test_ajout3.php">
      <label for="nom_competence">Nom :</label>
      <input type="text" id="nom_competence" name="nom_competence" required><br>

      <label for="matiere">Matière :</label>
      <select id="matiere" name="matiere" required>
      <?php 
        $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
        $reponse = $bdd->query('SELECT id_matiere, nom_matiere FROM matiere');
        while ($donnees = $reponse->fetch()) {
          echo '<option value="' . $donnees ['id_matiere'] . '">' . $donnees['nom_matiere'] . '</option>';
        }
        $reponse->closeCursor(); 
      ?>
      </select><br>

      <label for="professeur">Professeur :</label>
     <select id="professeur" name="professeur" required>
        <!-- Les options seront ajoutées par jQuery -->
      </select><br>

      <input type="submit" value="Ajouter">
    </form>
  </div><br>

  <?php pied_de_page(); ?>

</body>
</html>
