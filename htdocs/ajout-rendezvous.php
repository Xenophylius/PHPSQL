<?php session_start();

    require_once('connexion.php');

    // Ecriture de la requete
    $sqlQuery = 'INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)';

    // Préparation 
    $insertRecipe = $db->prepare($sqlQuery);

    if (isset($_POST['dateHour']) && 
    isset($_POST['idPatients'])) {

    $dateHour = htmlspecialchars($_POST['dateHour']);
    $idPatients = htmlspecialchars($_POST['idPatients']);
   

// Execution 
    $insertRecipe->execute([
    ':dateHour' => $dateHour,
    ':idPatients' => $idPatients,
    
]);
    include_once('navbar.php');
    echo '<p class="alert alert-success text-center">Vous avez ajouté un rendez-vous</p><br>';
    echo '<a href="liste-rendezvous.php">Cliquez pour aller vers la liste des rendez-vous</a>';

    } else {

    include_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajoutez un rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-dark ">

    <h1 class="text-success text-center">Ajoutez un rendez-vous</h1>
  <div class="container w-75 text-light border border-info-emphasis">
    <form action="ajout-rendezvous.php" method="post" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6 py-2">
        <label for="idPatients" class="form-label">Séléctionner le patient</label>
        <input type="text" class="form-control" name="idPatients" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    <div class="col-md-6 py-2">
        <label for="firstName" class="form-label">Séléctionner une date et une heure</label>
        <input type="datetime-local" name="dateHour" class="form-control" name="firstName" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    

    <div class="col-12 py-2">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Acceptez les conditions.
        </label>
        <div class="invalid-feedback">
            Vous devez acceptez les conditions. 
        </div>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-success" type="submit">Envoyer</button>
    </div>
    </form>
</div>  

<?php } ?>
<script>

(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
