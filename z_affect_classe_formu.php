<?php
if (isset($_POST['id_professeur'])) {
    $id_professeur = $_POST['id_professeur'];
    function getClasses($id_professeur)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
        $stmt = $bdd->prepare("
        SELECT classe.id_classe, classe.nom_classe
        FROM classe
        LEFT JOIN professeur_classe ON classe.id_classe = professeur_classe.id_classe AND professeur_classe.id_professeur = :id_professeur
WHERE professeur_classe.id_classe IS NULL
        ");
        $stmt->execute(['id_professeur' => $id_professeur]);

        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $classes;
    }

    $classes = getClasses($id_professeur);
    echo json_encode($classes);
}
