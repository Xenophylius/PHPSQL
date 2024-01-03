<?php session_start();

    require_once('connexion.php');
    
    
    // Ecriture de la requete
    $sqlQuery = 'INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)';
    $request =  $db->query('SELECT * FROM patients');
    // Préparation 
    $insertRecipe = $db->prepare($sqlQuery);
    $user = $request->fetchAll();
    

    function dump($variable){
        echo '<pre>';
        print_r($variable);
        echo '</pre>';
       };

       
    
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
  <div class="container w-75 text-light border border-info-emphasis text-center">
    <form action="ajout-rendezvous.php" method="post" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6 py-2">
        <label for="idPatients" class="form-label">Séléctionner le patient</label><br>
        <select name="idPatients">
          <?php foreach($user as $key => $value){ ?>
                
                <option value="<?=$user[$key]['id']?>"><?=$user[$key]['lastname']?> <?=$user[$key]['firstname']?></option>
                                            
            <?php } ?>
        </select>
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
