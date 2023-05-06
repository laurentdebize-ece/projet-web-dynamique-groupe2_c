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

// ID utilisateur à utiliser dans la requête
$idUtilisateur = $_SESSION['Id_utilisateur']; // Remplacez par l'ID utilisateur souhaité

// Requête SQL
$sql = "SELECT u.Nom, u.Prenom, p.id_professeur, p.Nom_prof, m.nom_matiere
        FROM utilisateur u
        JOIN professeur p ON u.Id_utilisateur = p.id_utilisateur
        JOIN professeur_matiere pm ON p.id_professeur = pm.id_professeur
        JOIN matiere m ON pm.id_matiere = m.id_matiere
        WHERE u.Id_utilisateur = $idUtilisateur";


$result = $conn->query($sql);

// Affichage des résultats
if ($result->num_rows > 0) {
    echo "<style>
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            
            table {
                width: 50%;
                border-collapse: collapse;
            }
            
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            th {
                background-color: #f2f2f2;
            }
        </style>";
    
    echo "<div class='container'>";
    echo "<table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>ID Professeur</th>
                <th>Nom Professeur</th>
                <th>Matière</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Nom"] . "</td>
                <td>" . $row["Prenom"] . "</td>
                <td>" . $row["id_professeur"] . "</td>
                <td>" . $row["Nom_prof"] . "</td>
                <td>" . $row["nom_matiere"] . "</td>
            </tr>";
    }
    
    echo "</table>";
    echo "</div>";
} else {
    echo "Aucun résultat trouvé.";
}

// Fermeture de la connexion
$conn->close();
?>

<body>
    <?php barre_de_navigation(); ?>

    <br><br><br><br><br><br><br><br>
    <?php pied_de_page(); ?>
</body>

</html>
