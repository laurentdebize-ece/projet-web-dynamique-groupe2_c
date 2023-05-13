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

$idUtilisateur = $_SESSION['Id_utilisateur']; // ID utilisateur actuel
$idEtudiant = $_SESSION['id_etudiant'];
echo $idEtudiant;
// Récupérer les compétences de l'étudiant actuellement connecté
$sql1 = "SELECT c.id_competences, c.nom_competences
        FROM competences c
        JOIN competences_etudiants ce ON c.id_competences = ce.id_competence
        JOIN etudiant e ON ce.id_etudiant = e.id_etudiant
        WHERE e.id_utilisateur = $idEtudiant";

// Récupérer toutes les compétences qui ne sont pas associées à l'étudiant actuellement connecté
$sql2 = "SELECT c.id_competences, c.nom_competences
        FROM competences c
        LEFT JOIN competences_etudiants ce ON c.id_competences = ce.id_competence
        LEFT JOIN etudiant e ON ce.id_etudiant = e.id_etudiant
        WHERE e.id_utilisateur <> $idEtudiant OR e.id_utilisateur IS NULL";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);

// Tableau pour stocker les id_competences
$competencesEtudiant = array();

// Stocker les compétences de l'étudiant dans un tableau
if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
        $competencesEtudiant[$row["id_competences"]] = $row["nom_competences"];
    }
}

// Affichage des résultats
if ($result1->num_rows > 0 || $result2->num_rows > 0) {
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
                <th>id_competences</th>
                <th>nom_competences</th>
                <th>Ajouter</th>

            </tr>";

    // Affichage des compétences de l'étudiant actuellement connecté
    foreach($competencesEtudiant as $id_competences => $nom_competences) {
        echo "<tr>
                <td>" . $id_competences . "</td>
                <td>" . $nom_competences . "</td>
                <td>Compétence déjà acquise</td>
              </tr>";
    }

    // Affichage des compétences qui ne sont pas associées à l'étudiant actuellement connecté
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            if (!isset($competencesEtudiant[$row["id_competences"]])) { // Si la compétence n'est pas déjà associée à l'étudiant
                echo "<tr>
                        <td>" . $row["id_competences"] . "</td>
                        <td>" . $row["nom_competences"] . "</td>
                        <td>
                            <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
                                <input type='hidden' name='id_competence' value='".$row["id_competences"]."'>
                                <input type='submit' name='submit' value='Ajouter à mes compétences'>
                            </form>
                        </td>
                      </tr>";
            }
        }
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "Aucun résultat trouvé.........";
}

if (isset($_POST['submit'])) {
    $id_competence = intval($_POST['id_competence']);
    $id_etudiant = intval($_SESSION['Id_utilisateur']);
    $requete = $conn->prepare("INSERT INTO competences_etudiants (id_competence, id_etudiant, Id_niveau_acquisition, commentaire, date_evaluation) VALUES (?, ?, 1, 'testos', '2023-05-10')");
    $requete->bind_param("ii", $id_competence, $id_etudiant);
    $requete->execute();
    
    echo "La compétence a été ajoutée à votre profil avec succès.";
    // Redirection vers la page actuelle
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit(); // Assure la fin de l'exécution du script après la redirection
}

include 'pied_de_page.php';
?>

<body>
    
    <?php barre_de_navigation(); ?>
    <br><br><br><br><br><br><br><br>
<?php pied_de_page(); ?>
</body>
</html>

