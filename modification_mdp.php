    <?php
    session_start();

    if (isset($_POST['mot_de_passe']) && isset($_POST['id_utilisateur'])) {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=Projet_info_ing2;charset=utf8", "root", "root");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $premiere_connexion = $_SESSION['premiere_connexion'];
            $id_utilisateur = $_POST['id_utilisateur'];
            $mot_de_passe = $_SESSION['mot_de_passe']  = $_POST['mot_de_passe'];

            $premiere_connexion = 0;

            $sql = "UPDATE utilisateur SET mot_de_passe = :mot_de_passe, premiere_connexion = :premiere_connexion WHERE Id_utilisateur = :id_utilisateur";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
            $stmt->bindParam(':premiere_connexion', $premiere_connexion);
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt->execute();

            echo $mot_de_passe; // On retourne le mdp

        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
    ?>
