<?php
session_start();

try {
	$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom_matiere = $_POST['nom_matiere'];
$volume_horaire = $_POST['volume_horaire'];

// Récupération du nouvel ID
$sql = "SELECT MAX(id_matiere) as max_id FROM matiere";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;

// Insertion des données dans la base de données
$sql = "INSERT INTO matiere (id_matiere, nom_matiere, volume_horaire) VALUES (:id, :nom_matiere, :volume_horaire)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom_matiere' => $nom_matiere,
	'volume_horaire' => $volume_horaire
));

if ($requete->rowCount() > 0) {
    $message = "Succes : La nouvelle matiere '$nom_matiere' a été ajoutée";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Ajout_Matiere.php";
    </script>';
    exit();
}