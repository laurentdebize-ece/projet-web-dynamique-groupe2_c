<!DOCTYPE html>
<?php include 'barre_de_navigation.php';
session_start(); ?>
 
<head>
    <title>Mes Validation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js></script>
    <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js></script>
    <script type="text/javascript" src="page_Prof_Validation.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" href="page_Prof_Validation.css">
 
</head>
 
<body>
    <?php barre_de_navigation_professeurs(); ?>
    <h1>Mes Validations</h1>
    <div class="flex-container">
        <div id="promotions" class="centered">
            <?php
            $conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
 
            $userId = $_SESSION['id_utilisateur'];
           
 
            $sql = "SELECT DISTINCT p.nom_promotion
    FROM promotion p
    JOIN classe c ON p.id_promotion = c.id_promotion
    JOIN etudiant e ON c.id_classe = e.id_classe
    JOIN etudiiant_matiere em ON e.id_etudiant = em.id_etudiant
    JOIN matiere m ON em.id_matiere = m.id_matiere
    JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
    JOIN professeur prof ON pm.id_professeur = prof.id_professeur
    WHERE prof.id_utilisateur = $userId";
 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<button class=" btn btn-primary promo-button" onclick="showClasses(\'' . $row["nom_promotion"] . '\')">' . $row["nom_promotion"] . '</button>';
                }
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
 