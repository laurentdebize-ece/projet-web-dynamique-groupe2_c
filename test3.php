<!DOCTYPE html>
<html>
<head>
  <title>Exemple de Filtrage</title>
  <style>
    .form-container {
      display: none;
      margin-bottom: 10px;
    }
  </style>
  <script>
    function toggleMultipleFilterForm() {
      var form = document.getElementById("barre_de_filtre4");
      form.style.display = form.style.display === "none" ? "block" : "none";
    }
    
    function toggleSingleFilterForm() {
      var forms = document.getElementsByClassName("form-container");
      for (var i = 0; i < forms.length; i++) {
        var form = forms[i];
        form.style.display = form.style.display === "none" ? "block" : "none";
      }
    }
  </script>
</head>
<body>
  <button onclick="toggleMultipleFilterForm()">Filtrer plusieurs compétences</button>
  <button onclick="toggleSingleFilterForm()">Filtrer une seule compétence à la fois</button>

  <div id="barre_de_filtre4" class="form-container">
    <!-- Formulaire pour le premier bouton -->
    <form>
      <!-- Vos éléments de formulaire ici -->
      <label for="competence1">Compétence 1:</label>
      <input type="text" id="competence1" name="competence1">
      <!-- Autres champs de formulaire ici -->
    </form>
  </div>

  <div class="form-container">
    <!-- Formulaire pour le deuxième bouton -->
    <form>
      <!-- Vos éléments de formulaire ici -->
      <label for="competence2">Compétence 2:</label>
      <input type="text" id="competence2" name="competence2">
      <!-- Autres champs de formulaire ici -->
    </form>
  </div>

  <div class="form-container">
    <!-- Formulaire pour le deuxième bouton -->
    <form>
      <!-- Vos éléments de formulaire ici -->
      <label for="competence3">Compétence 3:</label>
      <input type="text" id="competence3" name="competence3">
      <!-- Autres champs de formulaire ici -->
    </form>
  </div>

  <div class="form-container">
    <!-- Formulaire pour le deuxième bouton -->
    <form>
      <!-- Vos éléments de formulaire ici -->
      <label for="competence4">Compétence 4:</label>
      <input type="text" id="competence4" name="competence4">
      <!-- Autres champs de formulaire ici -->
    </form>
  </div>
</body>
</html>
