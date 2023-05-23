<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

if (isset($_POST['professeur']) && isset($_POST['classe'])) {
    $id_professeur = $_POST['professeur'];
    $id_classe = $_POST['classe'];

    echo "ID Professeur : " . $id_professeur . "<br>";
    echo "ID Classe : " . $id_classe;
} else {
    echo "Echec ";
}

// nom professeur
$query_professeur = "SELECT Nom_prof FROM professeur WHERE id_professeur = :id_professeur";
$stmt_professeur = $bdd->prepare($query_professeur);
$stmt_professeur->execute(['id_professeur' => $id_professeur]);
$result_professeur = $stmt_professeur->fetch(PDO::FETCH_ASSOC);
$nom_professeur = $result_professeur['Nom_prof'];

// nom classe
$query_classe = "SELECT nom_classe FROM classe WHERE id_classe = :id_classe";
$stmt_classe = $bdd->prepare($query_classe);
$stmt_classe->execute(['id_classe' => $id_classe]);
$result_classe = $stmt_classe->fetch(PDO::FETCH_ASSOC);
$nom_classe = $result_classe['nom_classe'];

$sql = "INSERT INTO professeur_classe (id_professeur, id_classe) VALUES (:id_professeur, :id_classe)";
$requete = $bdd->prepare($sql);
$requete->execute(array(
    'id_classe' => $id_classe,
    'id_professeur' => $id_professeur
));

if ($requete->rowCount() > 0) {
    $message = "Le professeur '$nom_professeur' a été affecté à la classe '$nom_classe'.";
    echo '<script>alert("Succes : ' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Affecter_Prof-Classe.php";
    </script>';
    exit();
}
