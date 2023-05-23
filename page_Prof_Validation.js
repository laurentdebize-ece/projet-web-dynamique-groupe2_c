function showClasses(nom_promotion) {
 
    $("#student-details").html('');
    $.get("page_Prof_Validation2.php", {
        nom_promotion: nom_promotion
    }, function (data) {
        var classNames = data.split(',');
        var html = '';
        for (var i = 0; i < classNames.length; i++) {
            html += '<button  class="btn btn-primary classe-button" onclick="showStudentDetails(\'' + classNames[i] + '\')">' + classNames[i] + '</button>';
        }
        $("#results").html(html);
    });
}
 
function showStudentDetails(nom_classe) {
    $.get("page_Prof_Validation3.php", {
        nom_classe: nom_classe
    }, function (data) {
        var students = data.split(';');
        var html = '<table class="centered-table">';
        html += '<tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Competence</th><th>Niveau d\'acquisition</th><th>Validation</th><th>Commentaire</th></tr>';
        for (var i = 0; i < students.length; i++) {
            var details = students[i].split(',');
            html += '<tr><td>' + details[0] + '</td><td>' + details[1] + '</td><td>' + details[2] + '</td><td>' + details[3] + '</td><td>' + details[4] + '</td>';
            html += '<td><form class="validation-form" action="javascript:void(0);" method="post"><input type="hidden" name="competence_id" value="' + details[5] + '"><input type="hidden" name="etudiant_id" value="' + details[6] + '"><select name="validation"><option value="1">Oui</option><option value="2">Non</option></select><input type="submit" value="Envoyer"></form></td>';
            html += '<td><form class="comment-form" action="javascript:void(0);" method="post"><input type="hidden" name="competence_id" value="' + details[5] + '"><input type="hidden" name="etudiant_id" value="' + details[6] + '"><input type="text" id="commentaire-' + details[6] + '-' + details[5] + '" name="comment" placeholder="Enter your comment here"><input type="submit" value="Submit"></form></td></tr>';
        }
        html += '</table>';
        $("#student-details").html(html);
    });
}
 
$(document).ready(function () {
    $(document).on('submit', '.comment-form', function (e) {
        e.preventDefault();
        var etudiantId = $(this).find('input[name="etudiant_id"]').val();
        var competenceId = $(this).find('input[name="competence_id"]').val();
        updateComment(etudiantId, competenceId);
    });
    $(document).on('submit', '.validation-form', function (event) {
        event.preventDefault();
        var competenceId = $(this).find('input[name="competence_id"]').val();
        var etudiantId = $(this).find('input[name="etudiant_id"]').val();
        var validation = $(this).find('select[name="validation"]').val();
        updateValidation(etudiantId, competenceId, validation);
    });
});
 
function updateComment(etudiantId, competenceId) {
    var commentaire = $('#commentaire-' + etudiantId + '-' + competenceId).val();
    $.post("update_comment.php", {
        etudiant_id: etudiantId,
        competence_id: competenceId,
        commentaire: commentaire
    }, function (response) {
        alert("Commentaire mise à jour avec succès");
        localStorage.setItem("notification", "Validation mise à jour avec succès");
    });
}
 
function updateValidation(etudiantId, competenceId, validation) {
    $.ajax({
        url: "update_validation.php",
        type: "POST",
        data: {
            etudiant_id: etudiantId,
            competence_id: competenceId,
            validation: validation
        },
        success: function (response) {
            console.log("Response from server: " + response);
            if (response === "Record updated successfully") {
                alert("Validation mise à jour avec succès");
                localStorage.setItem("notification", "Validation mise à jour avec succès");
            } else {
                alert("Erreur lors de la mise à jour de la validation");
            }
        },
        error: function () {
            alert("Une erreur s'est produite lors de la requête AJAX");
        }
    });
}
 

 