<!DOCTYPE html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Mes Competences</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="page_Etud_MesComp.js"></script>
    <link rel="stylesheet" href="page_Etu_MesCompTransv.css">
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" href="page_Etud_MesComp.css">
    <style>
        table {
            margin-top: 14%;
        }
    </style>
</head>

<body>
    <?php barre_de_navigation_etudiants(); ?>
    <h1>Mes Competences</h1>
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

    // Requête SQL
    $sql = "SELECT m.id_matiere, m.nom_matiere, c.id_competences, c.nom_competences, ce.Id_niveau_acquisition, e.id_utilisateur, ce.commentaire, ce.date_evaluation, p.Nom_prof, ac.nom AS acquisition, vp.nom_validation
    FROM matiere AS m
    JOIN competences_matieres AS cm ON m.id_matiere = cm.id_matiere
    JOIN competences AS c ON cm.id_competence = c.id_competences
    JOIN competences_etudiants AS ce ON c.id_competences = ce.id_competence
    JOIN etudiant AS e ON ce.id_etudiant = e.id_etudiant
    JOIN professeur AS p ON c.id_professeur = p.id_professeur
    JOIN acquisition_competences AS ac ON ce.Id_niveau_acquisition = ac.id
    JOIN validation_prof AS vp ON ce.validation_prof = vp.id_validation
    WHERE e.id_utilisateur = $idUtilisateur;
    ";



    // Bouton reset appuyé?
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

    // résultats
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
                <th>Validation du professeur</th>
                <th>Date evaluation du professeur</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {

            $niveauAcquisitionActuel = $row["Id_niveau_acquisition"];
            $nomProf = $row["Nom_prof"];
            $acquisition = $row['acquisition'];
            $nom_validation = $row['nom_validation'];


            $class = '';
            if ($acquisition === 'Acquis') {
                $class = 'acquis';
            } elseif ($acquisition === 'En cours d\'acquisition') {
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
                <td>" . $row["nom_validation"] . "</td>
                <td>" . $row["date_evaluation"] . "</td>
                </tr>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "Aucun résultat trouvé.";
    }

    if (isset($_POST['submit'])) {

        foreach ($_POST['nouvelleValeur'] as $idMatiereCompetence => $nouvelleValeur) {


            $idArray = explode("_", $idMatiereCompetence);
            $idMatiere = $idArray[0];
            $idCompetence = $idArray[1];


            $nouvelleValeur = intval($nouvelleValeur);
            $idEtudiant = $_POST["idEtudiant"];


            if ($nouvelleValeur >= 1 && $nouvelleValeur <= 3) {

                $requete = $conn->prepare("UPDATE competences_etudiants SET Id_niveau_acquisition = ?, commentaire = '', validation_prof = 0 WHERE id_etudiant = ? AND id_competence = ?");
                $requete->bind_param("iii", $nouvelleValeur, $idEtudiant, $idCompetence);
                $requete->execute();
            } else {
                echo "La valeur saisie pour la matière avec l'ID $idMatiere et la compétence avec l'ID $idCompetence n'est pas valide. Veuillez saisir une valeur entre 1 et 3.";
            }
        }

        echo "Les valeurs ont été mises à jour avec succès.";

        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_trie">
        <label class=" titreTrier" for="sort">Trier le tableau:</label><br></br>
        <select name="sort" id="sort">
            <option value="croissant_competences">Ordre alphabétique croissant du nom des compétences</option>
            <option value="decroissant_competences">Ordre alphabétique décroissant du nom des compétences</option>
            <option value="croissant_date">Date d'évaluation croissante</option>
            <option value="decroissant_date">Date d'évaluation décroissante</option>
            <input class="btn btn-primary btn_trier" type="submit" value="Trier">
        </select>
    </form>
    <div style="display : none" id="FiltreUnAUN" class="form-container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre">
            <label for="teacher">Filtrer par professeur :</label><br></br>
            <select name="teacher" id="teacher">
                <?php
                $result = $conn->query("SELECT id_professeur, Nom_prof FROM professeur");
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id_professeur'] . '">' . $row['Nom_prof'] . '</option>';
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
                    echo '<option value="' . $row['id_matiere'] . '">' . $row['nom_matiere'] . '</option>';
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

    <div style="display : none" id="FiltrePlusieurs" class="form-container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre4">
            <label for="teacher">Filtrer par professeur :</label><br></br>
            <select name="teacher" id="teacher">
                <?php
                $result = $conn->query("SELECT id_professeur, Nom_prof FROM professeur");
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id_professeur'] . '">' . $row['Nom_prof'] . '</option>';
                }
                ?>
            </select>
            <label for="subject">Filtrer par matière :</label><br></br>
            <select name="subject" id="subject">
                <?php
                $result = $conn->query("SELECT id_matiere, nom_matiere FROM matiere");
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id_matiere'] . '">' . $row['nom_matiere'] . '</option>';
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
        <input class="btn btn-primary button-position" type="submit" name="reset" value="Réinitialiser">
    </form>


    <button class="btn btn-primary idBoutonUnAUn" onclick="UnFiltre()">Filtrer une seule compétence à la fois</button>
    <button class="btn btn-primary idBoutonPlusieurs" onclick="PlusieursFiltres()">Filtrer plusieurs compétences</button>
    <?php pied_de_page(); ?>
</body>

</html>