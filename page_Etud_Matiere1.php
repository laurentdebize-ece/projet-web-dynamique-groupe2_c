<?php
include 'barre_de_navigation.php';
session_start();
 $conn = new mysqli("localhost", "root", "root", "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_utilisateur = $_SESSION['id_utilisateur'];
$sql2 = "SELECT e.id_classe
        FROM etudiant e
        WHERE e.id_utilisateur = $id_utilisateur";
 
$result2 = $conn->query($sql2);
if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $id_classe_etudiant = $row["id_classe"];
    }
} else {
    echo "0 resultats";
}
 
$id_matiere = intval($_GET['matiere_id']);
 

// On recup les compétences lies à la matière
$sql = "SELECT c.id_competences, c.nom_competences
        FROM competences_matieres cm
        JOIN competences c ON cm.id_competence = c.id_competences
        JOIN professeur p ON c.id_professeur = p.id_professeur
        JOIN professeur_classe pc ON p.id_professeur = pc.id_professeur
        WHERE cm.id_matiere = ?  AND pc.id_classe = $id_classe_etudiant";
       
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_matiere);
$stmt->execute();
$result = $stmt->get_result();
$competences = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css>
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <title>Compétences</title>
</head>
 
<body>
    <?php barre_de_navigation_etudiants(); ?>
    <h1>Compétences</h1>
    <div class="container">
        <a href="page_Etud_Matiere.php" class="back-button" style="margin-top:20px;">
            &#8592; Retour
        </a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la compétence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competences as $competence) : ?>
                    <tr>
                        <td><?php echo $competence['id_competences']; ?></td>
                        <td><?php echo $competence['nom_competences']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php pied_de_page(); ?>
</body>
 
</html>
 