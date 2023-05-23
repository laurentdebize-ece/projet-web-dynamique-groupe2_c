<?php
include 'barre_de_navigation.php';
session_start();
// Vérifier si l'utilisateur est connecté


// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'id de la matière
$id_matiere = intval($_GET['matiere_id']);

// Récupérer les compétences liées à la matière
$sql = "SELECT c.id_competences, c.nom_competences FROM competences_matieres cm JOIN competences c ON cm.id_competence = c.id_competences WHERE cm.id_matiere = ?";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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