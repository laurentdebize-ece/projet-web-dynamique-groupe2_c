<?php
if (isset($_POST['id_matiere'])) {
    $id_matiere = $_POST['id_matiere'];

    function getProfessors($id_matiere)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=projet_info_ing2;charset=utf8', 'root', 'root');
        $stmt = $bdd->prepare("
        SELECT DISTINCT p.id_professeur, p.nom_prof
FROM professeur p
LEFT JOIN professeur_matiere pm ON p.id_professeur = pm.id_professeur
WHERE pm.id_matiere = :id_matiere
AND p.id_professeur IN (
    SELECT id_professeur
    FROM professeur_matiere
    WHERE id_matiere = :id_matiere
    AND id_professeur = p.id_professeur
)


        ");
        $stmt->execute(['id_matiere' => $id_matiere]);
        $professeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $professeurs;
    }

    $professeurs = getProfessors($id_matiere);
    echo json_encode($professeurs);
}
