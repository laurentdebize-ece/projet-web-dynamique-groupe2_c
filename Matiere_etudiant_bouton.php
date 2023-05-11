<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <title>Matières</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
        }

        button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            width: 500px;
        }
    </style>
</head>
<?php
include 'barre_de_navigation.php';
session_start();
// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['Id_utilisateur'])) {
    header('Location: login.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", 'root', "root", "projet_info_ing2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'id de l'étudiant connecté
$id_utilisateur = $_SESSION['Id_utilisateur'];

// Récupérer les matières de l'étudiant
$sql = "SELECT m.id_matiere, m.nom_matiere FROM etudiiant_matiere em JOIN matiere m ON em.id_matiere = m.id_matiere WHERE em.id_etudiant = (SELECT id_etudiant FROM etudiant WHERE id_utilisateur = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_utilisateur);
$stmt->execute();
$result = $stmt->get_result();
$matieres = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<body>
    <?php barre_de_navigation(); ?>
    <div class="container">
        <h1>Matières</h1>
        <?php foreach ($matieres as $matiere): ?>
                <button onclick="window.location.href= 'Matiere_etudiant_competences.php?matiere_id=<?php echo $matiere['id_matiere']; ?>'"><?php echo $matiere['nom_matiere']; ?></button>
        <?php endforeach; ?>
    </div>
    <?php pied_de_page(); ?>
</body>
</html>
