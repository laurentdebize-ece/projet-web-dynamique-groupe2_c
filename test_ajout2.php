<?php
if (isset($_POST['id_matiere'])) {
    $id_matiere = $_POST['id_matiere'];

    include 'barre_de_navigation.php'; 

    function getProfessors($id_matiere) {
        $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
        $stmt = $bdd->prepare("
            SELECT professeur.id_professeur, professeur.nom_prof 
            FROM professeur 
            INNER JOIN professeur_matiere 
            ON professeur.id_professeur = professeur_matiere.id_professeur 
            WHERE professeur_matiere.id_matiere = :id_matiere
        ");
        $stmt->execute(['id_matiere' => $id_matiere]);
        $professeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $professeurs;
    }

    echo json_encode(getProfessors($id_matiere));
}
?>
