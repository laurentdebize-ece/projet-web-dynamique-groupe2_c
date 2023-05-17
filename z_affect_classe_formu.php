<?php
if (isset($_POST['id_professeur'])) {
    $id_professeur = $_POST['id_professeur'];
    function getClasses($id_professeur)
    {
    $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
    $stmt = $bdd->prepare( "
SELECT classe.id_classe, classe.nom_classe
FROM classe
LEFT JOIN professeur ON classe.id_classe != professeur.id_classe OR professeur.id_classe IS NULL
WHERE professeur.id_professeur = :id_professeur
");
$stmt->execute(['id_professeur' => $id_professeur]);

$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $classes;

    }

    $classes = getClasses($id_professeur);
    echo json_encode($classes);
}
