function showClasses(nom_promotion) {
    // Clear student details when showing classes
    $("#student-details").html('');
    $.get("page_Prof_Etudiants_Classes.php", {
        nom_promotion: nom_promotion
    }, function(data) {
        var classNames = data.split(','); // Assuming the names are comma-separated
        var html = '';
        for (var i = 0; i < classNames.length; i++) {
            html += '<button  class="btn btn-primary classe-button" onclick="showStudentDetails(\'' + classNames[i] + '\')">' + classNames[i] + '</button>';
        }
        $("#results").html(html);
    });
}

function showStudentDetails(nom_classe) {
    $.get("page_Prof_Etudiants_Tab.php", {
        nom_classe: nom_classe
    }, function(data) {
        var students = data.split(';');
        var html = '<table class="centered-table">';
        html += '<tr><th>Nom</th><th>Prenom</th><th>Email</th></tr>';
        for (var i = 0; i < students.length; i++) {
            var details = students[i].split(',');
            html += '<tr><td>' + details[0] + '</td><td>' + details[1] + '</td><td>' + details[2] + '</td></tr>';
        }
        html += '</table>';
        $("#student-details").html(html);
    });
}


