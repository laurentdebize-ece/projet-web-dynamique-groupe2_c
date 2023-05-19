<?php
if (isset($_POST['id_matiere'])) {
    $id_matiere = $_POST['id_matiere'];
  
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $query = "
      SELECT c.id_competences, c.nom_competences
      FROM competences_matieres cm
      INNER JOIN competences c ON cm.id_competence = c.id_competences
      WHERE cm.id_matiere = :id_matiere
    ";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['id_matiere' => $id_matiere]);
    $competences = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    echo json_encode($competences);
  }
  
?>
