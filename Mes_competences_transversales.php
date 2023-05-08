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

    while ($row = $result->fetch_assoc()) {
        // Récupérer la valeur actuelle du niveau d'acquisition depuis la base de données
        $niveauAcquisitionActuel = $row["Id_niveau_acquisition"];
        $nomProf= $row["Nom_prof"];
        $acquisition = $row['acquisition'];
        

        $class = '';
        if ($acquisition === 'Acquis') {
            $class = 'acquis';
        } elseif ($acquisition === 'En cours d\'acquisition'){
            $class = 'en-cours';
            } elseif ($acquisition === 'Non acquis') {
            $class = 'non-acquis';
            }
        echo "<tr>
                <td>" . $row["nom_matiere"] . "</td>
                <td>" . $nomProf . "</td>
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
    }

    echo "Les valeurs ont été mises à jour avec succès.";
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

