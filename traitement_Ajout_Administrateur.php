<?php
session_start();

try {
	$bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die("Erreur : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$statut = 'Administrateur'; // Modification de la valeur de 'statut'
$premiere_connexion = $_POST['premiere_connexion'] = 1;


// Générer un mot de passe aléatoire
$mot_de_passe = generateRandomPassword();

// Fonction pour générer un mot de passe aléatoire
function generateRandomPassword($length = 8) {
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    $charsetLength = strlen($charset);

    // Générer des caractères aléatoires pour former le mot de passe
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = random_int(0, $charsetLength - 1);
        $password .= $charset[$randomIndex];
    }

    return $password;
}

// Récupération du nouvel ID
$sql = "SELECT MAX(Id_utilisateur) as max_id FROM utilisateur";
$resultat = $bdd->query($sql);
$max_id = $resultat->fetch()['max_id'];
$nouvel_id = $max_id + 1;


// Insertion des données dans la base de données
$sql2 = "INSERT INTO utilisateur (Id_utilisateur, Nom, Prenom, email, mot_de_passe, statut, premiere_connexion) VALUES (:id, :nom, :prenom, :email, :mot_de_passe, :statut, :premiere_connexion)";
$requete = $bdd->prepare($sql2);
$requete->execute(array(
	'id' => $nouvel_id,
	'nom' => $nom,
	'prenom' => $prenom,
	'email' => $email,
	'mot_de_passe' => $mot_de_passe,
	'statut' => $statut,
    'premiere_connexion' => $premiere_connexion
));

// Récupération du nouvel ID administrateur
$sql4 = "SELECT MAX(Id_administrateur) as max_id_administrateur FROM administrateur";
$resultat_Admin = $bdd->query($sql4);
$max_id_Admin = $resultat_Admin ->fetch()['max_id_administrateur'];
$nouvel_id_Admin  = $max_id_Admin  + 1;


$sql3 = "INSERT INTO administrateur (Id_administrateur, id_utilisateur) VALUES (:Id_administrateur, :id)";
$requete = $bdd->prepare($sql3);
$requete->execute(array(
	'id' => $nouvel_id,
	'Id_administrateur' => $nouvel_id_Admin
));

// Afficher l'alerte avec les informations de l'utilisateur
if ($requete->rowCount() > 0) {
    $message = "Succes : Un nouvel administrateur a été ajouté : Nom : $nom, Prénom : $prenom, Email : $email";
    echo '<script>alert("' . $message . '");
    window.location.href = "page_Admin_6_Ajout&Modif.php";
    </script>';
    exit();
} else {
    echo '<script>alert("Erreur, aucune action effectuée.");
    window.location.href = "page_Ajout_Administrateur.php";
    </script>';
    exit();
}
