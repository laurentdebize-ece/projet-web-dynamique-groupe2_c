<!DOCTYPE html>
<html>
<?php include 'barre_de_navigation.php'; ?>

<head>
  <title>Les Professeurs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
  <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
  <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
  <link rel="stylesheet" href="page_Admin_Profs.css">
  <link rel="stylesheet" href="page_accueil_etudiant.css">
  <link rel="stylesheet" href="barre_de_navigation.css">
  <link rel="stylesheet" href="pied_de_page.css">
</head>

<body>
  <?php barre_de_navigation_administrateur(); ?>
  <h1>Professeurs</h1>
  <?php

  $conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT p.Nom_prof, m.nom_matiere,GROUP_CONCAT(DISTINCT pr.nom_promotion SEPARATOR '<br />')as promotions, GROUP_CONCAT(DISTINCT cl.nom_classe SEPARATOR '<br />') as classes, GROUP_CONCAT(DISTINCT c.nom_competences SEPARATOR '<br />') as competences
    FROM professeur p
    JOIN professeur_matiere pm ON p.id_professeur = pm.id_professeur
    JOIN matiere m ON pm.id_matiere = m.id_matiere
    JOIN professeur_classe pc ON p.id_professeur = pc.id_professeur
    JOIN classe cl ON pc.id_classe = cl.id_classe
    JOIN promotion pr ON cl.id_promotion = pr.id_promotion
    JOIN competences_matieres cm ON m.id_matiere = cm.id_matiere
    JOIN competences c ON cm.id_competence = c.id_competences
    GROUP BY p.Nom_prof, m.nom_matiere
    ORDER BY p.Nom_prof";


  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<div class='table-container'>";
    echo "<table><tr><th>Professeur</th><th>Matière</th><th>Promotion</th><th>Classe</th><th>Compétences</th></tr>";
    // Afficher les données de chaque ligne
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["Nom_prof"] . "</td><td>" . $row["nom_matiere"] . "</td><td>" . $row["promotions"] . "</td><td>" . $row["classes"] . "</td><td>" . $row["competences"] . "</td></tr>";
    }
    echo "</table>";
    echo "</div>";
  } else {
    echo "0 resultats";
  }
  $conn->close();
  ?>
  </div>
  <div id="results" class="centered"></div>
  <div id="student-details" class="centered"></div>
  <?php pied_de_page(); ?>
</body>

</html>