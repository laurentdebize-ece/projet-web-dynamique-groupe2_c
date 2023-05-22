<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_etudiant = $_POST['etudiant'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$id_classe = $_POST['classe'];

// Modification des données dans la base de données
$sql = "UPDATE utilisateur SET";
$parameters = array();

if (!empty($nom)) {
    $sql .= " Nom = :nom,";
    $parameters[':nom'] = $nom;
}

if (!empty($prenom)) {
    $sql .= " Prenom = :prenom,";
    $parameters[':prenom'] = $prenom;
}

if (!empty($email)) {
    $sql .= " email = :email,";
    $parameters[':email'] = $email;
}

$sql = rtrim($sql, ",");

$sql .= " WHERE Id_utilisateur = (
    SELECT id_utilisateur FROM etudiant WHERE id_etudiant = :id_etudiant
)";

$parameters[':id_etudiant'] = $id_etudiant;

$stmt = $bdd->prepare($sql);
$stmt->execute($parameters);

// Modification du champ id_classe dans la table etudiant
if (!empty($id_classe)) {
    $sql_etu = "UPDATE etudiant SET id_classe = :id_classe WHERE id_etudiant = :id_etudiant";
    $stmt_etu = $bdd->prepare($sql_etu);
    $stmt_etu->execute(array(':id_classe' => $id_classe, ':id_etudiant' => $id_etudiant));
}

if ($stmt->rowCount() > 0 || $stmt_etu->rowCount() > 0) {
    $message = "Succès : L'étudiant $prenom $nom a été modifié avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Modif_Etudiant.php";
    </script>';
    exit();
}
