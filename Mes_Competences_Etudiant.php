<?php
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
$sql = "SELECT m.nom_matiere, c.nom_competences, ce.Id_niveau_acquisition, e.id_utilisateur
        FROM etudiant e
        JOIN etudiiant_matiere em ON e.id_utilisateur = em.id_etudiant
        JOIN matiere m ON em.id_matiere = m.id_matiere
        JOIN competences_matieres mc ON m.id_matiere = mc.id_matiere
        JOIN competences c ON mc.id_competence = c.id_competences
        LEFT JOIN acquisition_competences ac ON c.id_competences = ac.id
        LEFT JOIN competences_etudiants ce ON c.id_competences = ce.id_competence AND e.id_utilisateur = ce.id_etudiant
        WHERE e.id_utilisateur = $idUtilisateur";

$result = $conn->query($sql);

// Affichage des résultats
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Matière</th>
                <th>Compétence</th>
                <th>Niveau d'acquisition</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        // Récupérer la valeur actuelle du niveau d'acquisition depuis la base de données
        $niveauAcquisitionActuel = $row["Id_niveau_acquisition"];

        echo "<tr>
                <td>" . $row["nom_matiere"] . "</td>
                <td>" . $row["nom_competences"] . "</td>
                <td>
                    <form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
                    <input type='range' min='1' max='3' step='1' name='nouvelleValeur' value='" . $niveauAcquisitionActuel . "'>
                    <input type='hidden' name='idEtudiant' value='" . $row["id_utilisateur"] . "'>
                    <button type='submit' name='submit'>Envoyer</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Aucun résultat trouvé.";
}

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupération de la nouvelle valeur saisie par l'utilisateur
    $nouvelleValeur = $_POST["nouvelleValeur"];
    $idEtudiant = $_POST["idEtudiant"];

    // Vérification si la nouvelle valeur est valide (entre 
    if ($nouvelleValeur >= 1 && $nouvelleValeur <= 3) {
        // Requête de mise à jour
        $requete = $conn->prepare("UPDATE competences_etudiants SET Id_niveau_acquisition = ? WHERE id_etudiant = ?");
        $requete->bind_param("ii", $nouvelleValeur, $idEtudiant);

        // Exécution de la requête
        $requete->execute();

        echo "La valeur a été mise à jour avec succès.";

        // Redirection vers la page actuelle
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit(); // Assure la fin de l'exécution du script après la redirection
    } else {
        echo "La valeur saisie n'est pas valide. Veuillez saisir une valeur entre 1 et 3.";
    }
}
?>
