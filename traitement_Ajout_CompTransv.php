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
$id_matiere = $_POST['matiere'];


// Vérification des données récupérées
if (isset($nom_competence) && isset($id_matiere)) {
	echo "Données récupérées avec succès";
} else {
	echo "Erreur lors de la récupération des données";
}


// Récupération du nouvel ID de compétence
$sql = "SELECT MAX(id_competence) as max_id FROM competences_transversales";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la table "competences_transversales"
$sql2 = "INSERT INTO competences_transversales (id_competence, nom_competences) VALUES (:id, :nom_competence)";
$requete = $bdd->prepare($sql2);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom_competence' => $nom_competence
));

// Insertion des données dans la table "compet_trans_matiere"
$sql5 = "INSERT INTO compet_trans_matiere (id_competence, id_matiere) VALUES (:id, :id_matiere)";
$requete = $bdd->prepare($sql5);
$requete->execute(array(
	'id' => $nouvel_id,
	'id_matiere' => $id_matiere
));

if ($requete->rowCount() > 0) {
    $message = "Succes : La compétence transversale '$nom_competence' a été ajoutée";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Ajout_Competence.php";
    </script>';
    exit();
}
