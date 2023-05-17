<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
if (isset($_POST['professeur']) && isset($_POST['classe'])) {
    $id_professeur = $_POST['professeur'];
    $id_classe = $_POST['classe'];

    echo "ID Professeur : " . $id_professeur . "<br>";
    echo "ID Classe : " . $id_classe;
}else{
    echo "Echec ";
}

$sql = "UPDATE professeur SET id_classe = :id_classe WHERE id_professeur = :id_professeur";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'id_classe' => $id_classe,
    'id_professeur' => $id_professeur
));

// Redirection vers la page d'accueil étudiant
header("Location: page_accueil_etudiant.php");
exit;
