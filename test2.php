<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>


<?php
// Votre code de connexion à la base de données
include 'barre_de_navigation.php';

// Connexion à la base de données
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "projet_info_ing2";

$conn = new mysqli($servername, 'root', 'root', $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['Id_utilisateur'])) {
    die("ID utilisateur non disponible en session.");
}
// ID de l'étudiant
$idEtudiant = $_SESSION['Id_utilisateur'];

// Requête SQL
$sql = "SELECT c.nom_competences, ac.nom AS acquisition
        FROM competences_etudiants ce
        INNER JOIN competences c ON ce.id_competence = c.id_competences
        INNER JOIN acquisition_competences ac ON ce.Id_niveau_acquisition = ac.id
        WHERE ce.id_etudiant = $idEtudiant";

// Exécution de la requête
$result = mysqli_query($conn, $sql);

// Tableau HTML
if ($result->num_rows > 0) {
    echo "<style>
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            
            table {
                width: 100%;
                height : 50%;
                border-collapse: collapse;
            }
            
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            th {
                background-color: #f2f2f2;
                height : 30%;
            }
        </style>";
    
    echo "<div class='container'>";
    echo "<table>
            <tr>
                <th>Competences</th>
                <th>Acquisitions</th>
            </tr>";

    // Parcourir les résultats
    while ($row = mysqli_fetch_assoc($result)) {
        $competence = $row['nom_competences'];
        $acquisition = $row['acquisition'];

        // Couleur de la case en fonction de l'acquisition
        

        // Affichage des données dans une ligne du tableau
        
        echo "<tr>
                <td>" . $competence . "</td>
                <td>" . $acquisition . "</td>        
            </tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "Aucun résultat trouvé.";
}
// Fermer la connexion à la base de données
$conn->close();

?>
<body>
    <?php barre_de_navigation(); ?>

    <br><br><br><br><br><br><br><br>
    <?php pied_de_page(); ?>
</body>

</html>