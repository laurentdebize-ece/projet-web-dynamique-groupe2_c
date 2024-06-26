<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Competences Transverses</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_Etu_MesCompTransv.css">
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
</head>

<body>
    <?php barre_de_navigation_etudiants(); ?>
    <h1>Competences Transverses</h1>
    <?php
    $conn = new mysqli("localhost", 'root', 'root', "projet_info_ing2");
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    session_start();
    if (!isset($_SESSION['id_utilisateur'])) {
        die("ID utilisateur non disponible en session.");
    }

    $idUtilisateur = $_SESSION['id_utilisateur'];

    // Requête SQL pour récupérer les données
    $sql = "SELECT DISTINCT m.id_matiere, m.nom_matiere, c.id_competence, c.nom_competences, ce.Id_niveau_acquisition, e.id_utilisateur, ce.commentaire, p.Nom_prof, (SELECT ac.nom FROM acquisition_competences ac WHERE ac.id = ce.Id_niveau_acquisition) AS acquisition
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

    // On regroupe les données par compétences
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

    // On affiche les résultats (si au moins 1ligne)
    if ($result->num_rows > 0) {
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

    if (isset($_POST['submit'])) {
        // On parcour les valeurs du formulaire soumis

        foreach ($_POST['nouvelleValeur'] as $idMatiereCompetence => $nouvelleValeur) {
            $idArray = explode("_", $idMatiereCompetence);
            $idMatiere = $idArray[0];
            $idCompetence = $idArray[1];

            // Recuperation de la nouvelle valeur saisie par l'utilisateur
            $nouvelleValeur = intval($nouvelleValeur);
            $idEtudiant = $_POST["idEtudiant"];

            if ($nouvelleValeur >= 1 && $nouvelleValeur <= 3) {
                // Requête de mise à jour
                $requete = $conn->prepare("UPDATE compet_trans_etudiant SET Id_niveau_acquisition = ? WHERE id_etudiant = ? AND id_competence = ?");
                $requete->bind_param("iii", $nouvelleValeur, $idEtudiant, $idCompetence);

                $requete->execute();
            } else {
                echo "La valeur saisie pour la matière avec l'ID $idMatiere et la compétence avec l'ID $idCompetence n'est pas valide. Veuillez saisir une valeur entre 1 et 3.";
            }

            // Requête SQL pour vérifier si l'enregistrement existe déjà
            $sql = "SELECT * FROM compet_trans_etudiant WHERE id_etudiant = $idUtilisateur AND id_matiere = $idMatiere AND id_competence = $idCompetence";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $sql = "UPDATE compet_trans_etudiant SET Id_niveau_acquisition = $nouvelleValeur WHERE id_etudiant = $idUtilisateur AND id_matiere = $idMatiere AND id_competence = $idCompetence";
            } else {
                // Insertion d'un nouvel enregistrement
                $sql = "INSERT INTO compet_trans_etudiant (id_etudiant, id_matiere, id_competence, Id_niveau_acquisition) VALUES ($idUtilisateur, $idMatiere, $idCompetence, $nouvelleValeur)";
            }
            if ($conn->query($sql) === TRUE) {
                echo "Mise à jour effectuée avec succès.";
            } else {
                echo "Erreur lors de la mise à jour : " . $conn->error;
            }
        }
        // Actualiser la page pour afficher les nouvelles valeurs

        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }

    $conn->close();
    pied_de_page(); ?>
</body>

</html>