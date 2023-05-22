<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<html>
<head>
<title>Les Competences</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>
<body>
<?php barre_de_navigation_administrateur(); ?>
<h1>Les Competences</h1>
<?php

$conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 
$sql = "SELECT c.nom_competences, m.nom_matiere, GROUP_CONCAT(DISTINCT p.Nom_prof SEPARATOR '<br />') as professeurs
    FROM competences c
    JOIN competences_matieres cm ON c.id_competences = cm.id_competence
    JOIN matiere m ON cm.id_matiere = m.id_matiere
    JOIN professeur p ON c.id_professeur = p.id_professeur
    GROUP BY c.nom_competences, m.nom_matiere
    ORDER BY c.nom_competences";
 
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
  echo "<div class='table-container'><table><tr><th>Compétences</th><th>Matière</th><th>Professeur</th></tr>";
  // Afficher les données de chaque ligne
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["nom_competences"]."</td><td>".$row["nom_matiere"]."</td><td>".$row["professeurs"]."</td></tr>";
  }
  echo "</table></div>";
} else {
  echo "0 results";
}
$conn->close();
?>
    </div>
    <div id="results" class="centered"></div>
    <div id="student-details" class="centered"></div>
    <?php pied_de_page(); ?>
</body>
</html>
 