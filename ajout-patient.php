<?php session_start();

    require_once('connexion.php');

    // Ecriture de la requete
    $sqlQuery = 'INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:lastName, :firstName, :birthdate, :phone, :mail)';

    // Préparation 
    $insertRecipe = $db->prepare($sqlQuery);

    

   function dump($variable){
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
   };


   
   if (isset($_POST['lastName']) && 
    isset($_POST['firstName']) && 
    isset($_POST['birthdate']) && 
    isset($_POST['phone']) && 
    isset($_POST['mail'])) {

    $lastName = htmlspecialchars($_POST['lastName']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $phone = htmlspecialchars($_POST['phone']);
    $mail = htmlspecialchars($_POST['mail']);

// Execution 
    $insertRecipe->execute([
    ':lastName' => $lastName,
    ':firstName' => $firstName,
    ':birthdate' => $birthdate,
    ':phone' => $phone,
    ':mail' => $mail,
]);

    echo '<p>Vous avez ajouté un patient</p>';

    } else {

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-dark ">

    <h1 class="text-success text-center">Ajoutez un patient</h1>
  <div class="container w-75 text-light border border-info-emphasis">
    <form action="ajout-patient.php" method="post" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6 py-2">
        <label for="lastName" class="form-label">Nom</label>
        <input type="text" class="form-control" name="lastName" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    <div class="col-md-6 py-2">
        <label for="firstName" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="firstName" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    
    <div class="col-md-12 py-2">
        <label for="birthdate" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" name="birthdate" required>
        <div class="invalid-feedback">
        Entrez votre date de naissance. 
        </div>
    </div>
    <div class="col-md-12 py-2">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" name="phone" required>
        <div class="invalid-feedback">
        Entrez votre numéro de téléphone.
        </div>
    </div>
    
    <div class="col-md-12 py-2">
        <label for="mail" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="mail" required>
        <div class="invalid-feedback">
        Entrez votre e-mail. 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>