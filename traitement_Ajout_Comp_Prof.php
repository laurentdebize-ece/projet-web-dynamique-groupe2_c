<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom_competence = $_POST['nom_competence'];
$matiere = $_POST['matiere'];
$classe = $_POST['classe'];

if ($_POST['commentaire'] === NULL) {
    $commentaire = '';
} else {
    $commentaire = $_POST['commentaire'];
}
if ($_POST['date'] === '') {
    $date = NULL;
} else {
    $date = $_POST['date'];
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupération de l'id_professeur et id_classe de l'utilisateur
$query = "SELECT professeur.id_professeur, professeur_classe.id_classe
          FROM professeur
          LEFT JOIN professeur_classe ON professeur.id_professeur = professeur_classe.id_professeur
          WHERE professeur.id_utilisateur = :id_utilisateur";
$stmt = $bdd->prepare($query);
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$id_professeur = $result['id_professeur'];
$id_classe = $result['id_classe'];


// Récupération du nouvel ID
$sql = "SELECT MAX(id_competences) as max_id FROM competences";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la table "competences"
$sql2 = "INSERT INTO competences (id_competences, nom_competences) VALUES (:id, :nom_competence)";
$requete1 = $bdd->prepare($sql2);
$requete1->execute(array(
    'id' => $nouvel_id,
    'nom_competence' => $nom_competence
));

// Insertion des données dans la table "competences_matieres"
$sql3 = "INSERT INTO competences_matieres (id_competence, id_matiere) VALUES (:id, :matiere)";
$requete2 = $bdd->prepare($sql3);
$requete2->execute(array(
    'id' => $nouvel_id,
    'matiere' => $matiere
));

// Sélection des élèves appartenant à la classe du professeur
$sql4 = "SELECT e.id_etudiant
        FROM etudiant e
        JOIN classe c ON e.id_classe = c.id_classe
        WHERE c.id_classe = :id_classe";

$requete3 = $bdd->prepare($sql4);
$requete3->bindParam(":id_classe", $id_classe);
$requete3->execute();

$etudiants = $requete3->fetchAll(PDO::FETCH_COLUMN);

// Insertion des données dans la table "competences_etudiants" pour les étudiants de la classe du professeur
$sql5 = "INSERT INTO competences_etudiants (id_competence, id_etudiant, Id_niveau_acquisition, commentaire, date_evaluation) 
         VALUES (:id, :id_etudiant, 1, :commentaire, :date_evaluation)";
$requete4 = $bdd->prepare($sql5);
foreach ($etudiants as $etudiant) {
    $requete4->execute(array(
        'id' => $nouvel_id,
        'id_etudiant' => $etudiant,
        'commentaire' => $commentaire,
        'date_evaluation' => $date
    ));
}

if ($requete1->rowCount() > 0) {
    $message = "Succes : La compétence '$nom_competence' a été ajoutée à la classe '$nom_classe'";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Prof_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Ajout_Comp_Prof.php";
    </script>';
    exit();
}
