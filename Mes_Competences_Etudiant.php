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

    <style>
        #Barre_de_trie {
            position: absolute;
            top: 150px;
            left: 20px;
        }
        #Barre_de_filtre {
            position: absolute;
            top: 150px;
            left: 500px;
        }
        #Barre_de_filtre2 {
            position: absolute;
            top: 150px;
            left: 700px;
        }
        #Barre_de_filtre3 {
            position: absolute;
            top: 150px;
            left: 900px;
        }
        #Barre_de_filtre4 {
            position: absolute;
            top: 150px;
            left: 1250px;
        }
        .idBoutonUnAUn{
            position: absolute;
            top: 100px;
            left: 650px;
        }
        .idBoutonPlusieurs{
            position: absolute;
            top: 100px;
            left: 1250px;
        }
    </style>
    <script>
    function UnFiltre() {
      var form = document.getElementById("FiltreUnAUN");
      form.style.display = form.style.display === "none" ? "block" : "none";
    }
    
    function PlusieursFiltres() {
      var form = document.getElementById("FiltrePlusieurs");
      form.style.display = form.style.display === "none" ? "block" : "none";
    }
  </script>
</head>

<p>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_trie">
    <label for="sort">Trier le tableau:</label><br></br>
    <select name="sort" id="sort">
        <option value="croissant_competences">Ordre alphabétique croissant du nom des compétences</option>
        <option value="decroissant_competences">Ordre alphabétique décroissant du nom des compétences</option>
        <option value="croissant_date">Date d'évaluation croissante</option>
        <option value="decroissant_date">Date d'évaluation décroissante</option>
        <input type="submit" value="Trier">
    </select>
</form>

</p>

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
$sql = "SELECT m.id_matiere, m.nom_matiere, c.id_competences, c.nom_competences, ce.Id_niveau_acquisition, e.id_utilisateur, ce.commentaire,ce.date_evaluation, p.Nom_prof, (SELECT ac.nom FROM acquisition_competences ac WHERE ac.id = ce.Id_niveau_acquisition) AS acquisition
    FROM etudiant e
    JOIN etudiiant_matiere em ON e.id_utilisateur = em.id_etudiant
    JOIN matiere m ON em.id_matiere = m.id_matiere
    JOIN competences_matieres mc ON m.id_matiere = mc.id_matiere
    JOIN competences c ON mc.id_competence = c.id_competences
    JOIN competences_etudiants ce ON c.id_competences = ce.id_competence AND e.id_utilisateur = ce.id_etudiant
    JOIN professeur_matiere pm ON m.id_matiere = pm.id_matiere
    JOIN professeur p ON pm.id_professeur = p.id_professeur
    WHERE e.id_utilisateur = $idUtilisateur";

// Vérifier si le bouton reset a été appuyé
if (!isset($_POST['reset'])) {
    // Ajout du critère de tri à la requête SQL
    if (isset($_POST['sort'])) {
        $sort = $_POST['sort'];
        switch ($sort) {
            case 'croissant_competences':
                $sql .= " ORDER BY c.nom_competences ASC";
                break;
            case 'decroissant_competences':
                $sql .= " ORDER BY c.nom_competences DESC";
                break;
            case 'croissant_date':
                $sql .= " ORDER BY ce.date_evaluation ASC";
                break;
            case 'decroissant_date':
                $sql .= " ORDER BY ce.date_evaluation DESC";
                break;
            // Ajoutez des cas supplémentaires pour les autres options de tri
        }
    }
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        $sql .= " AND m.id_matiere = $subject";
    }

    if (isset($_POST['teacher'])) {
        $teacher = $_POST['teacher'];
        $sql .= " AND p.id_professeur = $teacher";
    }

    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        switch ($status) {
            case 'acquis':
                $sql .= " AND ce.Id_niveau_acquisition = 3";
                break;
            case 'en_cours':
                $sql .= " AND ce.Id_niveau_acquisition = 2";
                break;
            case 'non_acquis':
                $sql .= " AND ce.Id_niveau_acquisition = 1";
                break;
        }
    }
}

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
                <th>Date evaluation du professeur</th>
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
                        <input type='range' min='1' max='3' step='1' name='nouvelleValeur[" . $row["id_matiere"] . "_" . $row["id_competences"] . "]' value='" . $niveauAcquisitionActuel . "'>
                        <input type='hidden' name='idEtudiant' value='" . $row["id_utilisateur"] . "'>
                        <button type='submit' name='submit'>Envoyer</button>
                    </form>
                </td>
                <td class=\"$class\">" . $acquisition . "</td>
                <td>" . $row["commentaire"] . "</td>
                <td>" . $row["date_evaluation"] . "</td>
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
                $requete = $conn->prepare("UPDATE competences_etudiants SET Id_niveau_acquisition = ? WHERE id_etudiant = ? AND id_competence = ?");
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
    <div style = "display : none" id="FiltreUnAUN" class="form-container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre">
            <label for="teacher">Filtrer par professeur :</label><br></br>
            <select name="teacher" id="teacher">
                <?php
                    $result = $conn->query("SELECT id_professeur, Nom_prof FROM professeur");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id_professeur'].'">'.$row['Nom_prof'].'</option>';
                    }
                ?>
            </select>
            <input type="submit" value="Filtrer">
        </form>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre2">
            <label for="subject">Filtrer par matière :</label><br></br>
            <select name="subject" id="subject">
                <?php
                    $result = $conn->query("SELECT id_matiere, nom_matiere FROM matiere");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id_matiere'].'">'.$row['nom_matiere'].'</option>';
                    }
                ?>
            </select>
            <input type="submit" value="Filtrer">
        </form>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre3">
            <label for="status">Filtrer par statut de compétence :</label><br></br>
            <select name="status" id="status">
                <option value="acquis">Acquis</option>
                <option value="en_cours">En cours d'acquisition</option>
                <option value="non_acquis">Non acquis</option>
            </select>
            <input type="submit" value="Filtrer">
        </form>
    </div>

    <div style = "display : none" id="FiltrePlusieurs" class="form-container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre4">
            <label for="teacher">Filtrer par professeur :</label><br></br>
            <select name="teacher" id="teacher">
                <?php
                    $result = $conn->query("SELECT id_professeur, Nom_prof FROM professeur");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id_professeur'].'">'.$row['Nom_prof'].'</option>';
                    }
                ?>
            </select>
            <label for="subject">Filtrer par matière :</label><br></br>
            <select name="subject" id="subject">
                <?php
                    $result = $conn->query("SELECT id_matiere, nom_matiere FROM matiere");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id_matiere'].'">'.$row['nom_matiere'].'</option>';
                    }
                ?>
            </select>
            <label for="status">Filtrer par statut de compétence :</label><br></br>
            <select name="status" id="status">
                <option value="acquis">Acquis</option>
                <option value="en_cours">En cours d'acquisition</option>
                <option value="non_acquis">Non acquis</option>
            </select>
            <input type="submit" value="Filtrer">
        </form>
    </div>
    
    
    
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="submit" name="reset" value="Réinitialiser">
    </form>


    <button class = "idBoutonUnAUn" onclick="UnFiltre()">Filtrer une seule compétence à la fois</button>
    <button class = "idBoutonPlusieurs" onclick="PlusieursFiltres()">Filtrer plusieurs compétences</button>
    <br><br><br><br><br><br><br><br>
<?php pied_de_page(); ?>
</body>
</html>
