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

$idUtilisateur = $_SESSION['Id_utilisateur']; // Remplacez par l'ID utilisateur souhaité

// Requête SQL pour récupérer les données
$sql = "SELECT m.id_matiere, m.nom_matiere, c.id_competence, c.nom_competences, ce.Id_niveau_acquisition, e.id_utilisateur, ce.commentaire, p.Nom_prof, (SELECT ac.nom FROM acquisition_competences ac WHERE ac.id = ce.Id_niveau_acquisition) AS acquisition
    FROM etudiant e
    JOIN etudiiant_matiere em ON e.id_utilisateur = em.id_etudiant
    JOIN matiere m ON em.id_matiere = m.id_matiere
    JOIN compet_trans_matiere mc ON m.id_matiere = mc.id_matiere
    JOIN competences_transversales c ON mc.id_competence = c.id_competence
    LEFT JOIN compet_trans_etudiant ce ON c.id_competence = ce.id_competence AND e.id_utilisateur = ce.id_etudiant
    LEFT JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
    LEFT JOIN professeur p ON pm.id_professeur = p.id_professeur
    WHERE e.id_utilisateur = $idUtilisateur";

$result = $conn->query($sql);

// Fonction pour regrouper les données par compétences
function groupDataByCompetence($result)
{
    $groupedData = [];

    while ($row = $result->fetch_assoc()) {
        $competenceId = $row['id_competence'];
        $profName = $row['Nom_prof'];
        $matiereName = $row['nom_matiere'];
        if (!isset($groupedData[$competenceId])) {
            $groupedData[$competenceId] = $row;
            $groupedData[$competenceId]['profList'] = [];
            $groupedData[$competenceId]['matiereList'] = [];
        }

        $groupedData[$competenceId]['profList'][] = $profName;
        $groupedData[$competenceId]['matiereList'][] = $matiereName;
    }

    return $groupedData;
}

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
        width: 100%;
        height : 50%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border: 1px solid black;
    }
    
    th {
        background-color: #f2f2f2;
        height : 30%;
    }
    .acquis {
        background-color: green;
    }
    
    .en-cours {
        background-color: orange;
    }
    
    .non-acquis {
        background-color: red;
    }
    input[type=range] {
        -webkit-appearance: none;
        width: 100%;
        height: 10px;
        border-radius: 5px;
        background: #d3d3d3;
        outline: none;
        padding: 0;
        margin: 0;
    }
    
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #0056b3;
        cursor: pointer;
    }
    
    input[type=range]::-webkit-slider-thumb:hover {
        background: #007bff;
    }
    
    input[type=range]:focus::-webkit-slider-thumb {
        background: #007bff;
    }
    
    button[type=submit] {
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        font-family: 'Arial', sans-serif;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        background-color: #808080;
        color: #ffffff;
        margin-top : 20px;
    }
    
    button[type=submit]:hover {
        background-color: #0056b3;
    }
</style>";

echo "<div class='container'>";
echo "<table>
<tr>
    <th>Matière</th>
    <th>Nom du professeur</th>
    <th>Compétence</th>
    <th>Modifier niveau d'acquisition</th>
    <th>Niveau d'acquisition</th>
    <th>Commentaire du professeur</th>
</tr>";

$groupedData = groupDataByCompetence($result);

foreach ($groupedData as $competenceId => $row) {
$niveauAcquisitionActuel = $row["Id_niveau_acquisition"];
$profList = implode(', ', $row['profList']);
$matiereList = implode(', ', $row['matiereList']);
$acquisition = $row['acquisition'];

$class = '';
if ($acquisition === 'Acquis') {
$class = 'acquis';
} elseif ($acquisition === 'En cours d\'acquisition') {
$class = 'en-cours';
} elseif ($acquisition === 'Non acquis') {
$class = 'non-acquis';
}
echo "<tr>
    <td>" . $matiereList . "</td>
    <td>" . $profList . "</td>
    <td>" . $row["nom_competences"] . "</td>
    <td>
        <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
            <input type='range' min='1' max='3' step='1' name='nouvelleValeur[" . $row["id_matiere"] . "_" . $row["id_competence"] . "]' value='" . $niveauAcquisitionActuel . "'>
            <input type='hidden' name='idEtudiant' value='" . $row["id_utilisateur"] . "'>
            <button type='submit' name='submit'>Envoyer</button>
        </form>
    </td>
    <td class=\"$class\">" . $acquisition . "</td>
    <td>" . $row["commentaire"] . "</td>
</tr>";
}

echo "</table>";
echo "</div>";
} else {
echo "Aucun résultat trouvé.";
}

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {
// Parcourir les valeurs du formulaire soumis
foreach ($_POST['nouvelleValeur'] as $idMatiereCompetence => $nouvelleValeur) {
// Extraire l'ID de la matière et de la compétence
$idArray = explode("_", $idMatiereCompetence);
$idMatiere = $idArray[0];
$idCompetence = $idArray[1];


    // Récupérer la nouvelle valeur saisie par l'utilisateur
        $nouvelleValeur = intval($nouvelleValeur);
        $idEtudiant = $_POST["idEtudiant"];

        // Vérification si la nouvelle valeur est valide (entre 1 et 3)
        if ($nouvelleValeur >= 1 && $nouvelleValeur <= 3) {
            // Requête de mise à jour
            $requete = $conn->prepare("UPDATE compet_trans_etudiant SET Id_niveau_acquisition = ? WHERE id_etudiant = ? AND id_competence = ?");
            $requete->bind_param("iii", $nouvelleValeur, $idEtudiant, $idCompetence);

            // Exécution de la requête
            $requete->execute();
        } else {
            echo "La valeur saisie pour la matière avec l'ID $idMatiere et la compétence avec l'ID $idCompetence n'est pas valide. Veuillez saisir une valeur entre 1 et 3.";
        }
    // Requête SQL pour vérifier si l'enregistrement existe déjà
    $sql = "SELECT * FROM compet_trans_etudiant WHERE id_etudiant = $idUtilisateur AND id_matiere = $idMatiere AND id_competence = $idCompetence";
    $result = $conn->query($sql);

    // Mise à jour ou insertion de la nouvelle valeur
    if ($result->num_rows > 0) {
        // Mise à jour de l'enregistrement existant
        $sql = "UPDATE compet_trans_etudiant SET Id_niveau_acquisition = $nouvelleValeur WHERE id_etudiant = $idUtilisateur AND id_matiere = $idMatiere AND id_competence = $idCompetence";
    } else {
        // Insertion d'un nouvel enregistrement
        $sql = "INSERT INTO compet_trans_etudiant (id_etudiant, id_matiere, id_competence, Id_niveau_acquisition) VALUES ($idUtilisateur, $idMatiere, $idCompetence, $nouvelleValeur)";
    }

    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
        echo "Mise à jour effectuée avec succès.";
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}
// Actualiser la page pour afficher les nouvelles valeurs

header("Location: " . $_SERVER["PHP_SELF"]);
exit(); // Assure la fin de l'exécution du script après la redirection
}

// Fermeture de la connexion à la base de données
$conn->close();

// Inclusion du pied de page
include 'pied_de_page.php';
?>
<body>
    <?php barre_de_navigation(); ?>
    <br><br><br><br><br><br><br><br>
<?php pied_de_page(); ?>
</body>
</html>

