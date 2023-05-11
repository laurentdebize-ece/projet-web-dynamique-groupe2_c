<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre">
        <label for="teacher">Filtrer par professeur :</label><br></br>
        <select name="teacher" id="teacher">
            <?php
                $result = $conn->query("SELECT id_professeur, Nom_prof FROM professeur");
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['id_professeur'].'">'.$row['Nom_prof'].'</option>';
                }
            ?>
        </select>
        <label for="subject">Filtrer par matière :</label><br></br>
        <select name="subject" id="subject">
            <?php
                $result = $conn->query("SELECT id_matiere, nom_matiere FROM matiere");
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['id_matiere'].'">'.$row['nom_matiere'].'</option>';
                }
            ?>
        </select>
        <label for="status">Filtrer par statut de compétence :</label><br></br>
        <select name="status" id="status">
            <option value="acquis">Acquis</option>
            <option value="en_cours">En cours d'acquisition</option>
            <option value="non_acquis">Non acquis</option>
        </select>
        <input type="submit" value="Filtrer">
    </form>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="submit" name="reset" value="Réinitialiser">
    </form>