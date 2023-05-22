<!DOCTYPE html>
<html>
<?php include 'barre_de_navigation.php'; ?>

<head>
    <title>Toutes les compétences</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="page_accueil_etudiant.css">
    <link rel="stylesheet" href="barre_de_navigation.css">
    <link rel="stylesheet" href="pied_de_page.css">
    <link rel="stylesheet" href="page_Etud_ToutesComp.css">
</head>

<body>
    <h1>Toutes les compétences OMNES</h1>
    <?php barre_de_navigation_etudiants(); ?>
    <?php
    $conn = new mysqli("localhost", "root", "root", "projet_info_ing2");
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }
    session_start();
    if (!isset($_SESSION['id_utilisateur'])) {
        die("ID utilisateur non disponible en session.");
    }
    $idUtilisateur = $_SESSION['id_utilisateur'];

    // Récupérer l'id de l'étudiant à partir de l'id_utilisateur
    $sql = "SELECT id_etudiant FROM etudiant WHERE id_utilisateur = $idUtilisateur";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idEtudiant = $row['id_etudiant'];
    } else {
        die("Aucun enregistrement d'étudiant trouvé pour cet utilisateur.");
    }


    $sql1 = "SELECT c.id_competences, c.nom_competences
        FROM competences c
        JOIN competences_etudiants ce ON c.id_competences = ce.id_competence
        JOIN etudiant e ON ce.id_etudiant = e.id_etudiant
        WHERE e.id_utilisateur = $idEtudiant";

    $sql2 = "SELECT c.id_competences, c.nom_competences
        FROM competences c
        LEFT JOIN competences_etudiants ce ON c.id_competences = ce.id_competence
        LEFT JOIN etudiant e ON ce.id_etudiant = e.id_etudiant
        WHERE e.id_utilisateur <> $idEtudiant OR e.id_utilisateur IS NULL";

    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);

    $competencesEtudiant = array();

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $competencesEtudiant[$row["id_competences"]] = $row["nom_competences"];
        }
    }

    if ($result1->num_rows > 0 || $result2->num_rows > 0) {
        echo "<div class='container'>";
        echo "<table class='tableau'>            
        <tr>
                <th>id_competences</th>
                <th>nom_competences</th>
                <th>Ajouter</th>
            </tr>";

        foreach ($competencesEtudiant as $id_competences => $nom_competences) {
            echo "<tr>
                <td>" . $id_competences . "</td>
                <td>" . $nom_competences . "</td>
                <td>Compétence déjà acquise</td>
              </tr>";
        }

        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                if (!isset($competencesEtudiant[$row["id_competences"]])) {
                    echo "<tr>
                        <td>" . $row["id_competences"] . "</td>
                        <td>" . $row["nom_competences"] . "</td>
                        <td>
                            <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
                                <input type='hidden' name='id_competence' value='" . $row["id_competences"] . "'>
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
        $id_etudiant = intval($_SESSION['id_etudiant']);
        $requete = $conn->prepare("INSERT INTO competences_etudiants (id_competence, id_etudiant, Id_niveau_acquisition, commentaire, date_evaluation) VALUES (?, ?, 1, 'testos', '2023-05-10')");
        $requete->bind_param("ii", $id_competence, $id_etudiant);
        $requete->execute();

        echo "La compétence a été ajoutée à votre profil avec succès.";
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
    ?>

    <?php pied_de_page(); ?>

</body>

</html>