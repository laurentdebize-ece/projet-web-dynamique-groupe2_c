<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informations des professeurs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>
<body>
    <div class="container">
        <h2>Informations des professeurs</h2>
        <?php
        include 'barre_de_navigation.php';
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "projet_info_ing2";

        // Créer une connexion
        $conn = new mysqli($servername, 'root', 'root', $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT pr.Nom_prof AS Professeur, m.nom_matiere AS Matiere, c.nom_competences AS Competences, cl.nom_classe, p.nom_promotion
                FROM professeur pr
                JOIN professeur_matiere pm ON pr.id_professeur = pm.id_professeur
                JOIN matiere m ON pm.id_matiere = m.id_matiere
                JOIN competences_matieres cm ON m.id_matiere = cm.id_matiere
                JOIN competences c ON cm.id_competence = c.id_competences
                JOIN classe cl ON pr.id_classe = cl.id_classe
                JOIN promotion p ON cl.id_promotion = p.id_promotion";
                
        $result = $conn->query($sql);

        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>Professeur</th><th>Matière</th><th>Classe</th><th>Promotion</th><th>Compétences</th></tr></thead>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['Professeur'] . "</td><td>" . $row['Matiere'] . "</td><td>" . $row['nom_classe'] . "</td><td>" . $row['nom_promotion'] . "</td><td>" . $row['Competences'] . "</td></tr>";
            }
        }else{
            echo'0000';
        }
        echo "</table>";

        $conn->close();
        ?>
    </div>
    <?php barre_de_navigation(); ?>
    <?php pied_de_page(); ?>
</body>
</html>
