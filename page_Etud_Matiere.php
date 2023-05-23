<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<html>

<head>
    <title>Mes Matières</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <title>Matières</title>
</head>

<body>
    <?php barre_de_navigation_etudiants(); ?>
    <h1>Mes Matieres</h1>
    <div class="container">
        <?php
        session_start();
        $conn = new mysqli("localhost", 'root', "root", "projet_info_ing2");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id_utilisateur = $_SESSION['id_utilisateur'];

        // On recup les matières de l'étudiant
        $sql = "SELECT m.id_matiere, m.nom_matiere FROM etudiiant_matiere em JOIN matiere m ON em.id_matiere = m.id_matiere WHERE em.id_etudiant = (SELECT id_etudiant FROM etudiant WHERE id_utilisateur = ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error during preparation of the statement: " . $conn->error);
        }

        $stmt->bind_param("i", $id_utilisateur);
        if (!$stmt->execute()) {
            die("Error executing the statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $matieres = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        foreach ($matieres as $matiere) {
            echo '<a href="page_Etud_Matiere1.php?matiere_id=' . $matiere['id_matiere'] . '" class="btn btn-primary btn-matiere">' . $matiere['nom_matiere'] . '</a>';
        }

        $conn->close();
        ?>
    </div>
    <?php pied_de_page(); ?>
</body>

</html>