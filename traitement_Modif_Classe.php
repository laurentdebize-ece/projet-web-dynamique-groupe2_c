<?php
session_start();

try {
    $bdd = new PDO("mysql:host=localhost;dbname=projet_info_ing2;charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$id_classe = $_POST['classe'];
$nom_classe = $_POST['nom'];

// Modification de la classe dans la base de données
$sql = "UPDATE classe SET nom_classe = :nom_classe WHERE id_classe = :id_classe";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(':nom_classe' => $nom_classe, ':id_classe' => $id_classe));

if ($stmt->rowCount() > 0) {
    $message = "Succès : La classe $nom_classe a été modifiée avec succès";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Modif_Classe.php";
    </script>';
    exit();
}
?>
