<?php session_start();

    require_once('connexion.php');
    $identifiant = $_GET['id'];
    
    // on commence par préparer la requète grace à query()
    $request =  $db->query("SELECT * FROM patients WHERE id=$identifiant");
    $user = $request->fetch();
    
    $request2 =  $db->query('SELECT * FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id');
    $user2 = $request2->fetchAll();


    $sqlQuery2 = "UPDATE patients SET lastname=:lastName, firstname=:firstName, birthdate=:birthdate, phone=:phone, mail=:mail WHERE id=$identifiant";
    $insertRecipe2 = $db->prepare($sqlQuery2);
  
   
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

   $insertRecipe2->execute([
    ':lastName' => $lastName,
    ':firstName' => $firstName,
    ':birthdate' => $birthdate,
    ':phone' => $phone,
    ':mail' => $mail,
]);
include_once('navbar.php');
    echo '<p class="alert alert-success text-center">Vous avez modifié un patient</p>';
    echo "<li><a class='btn btn-secondary' href='profil-patient.php?id={$identifiant}'>Retour vers la page du patient</a></li>";
    } else {
        include_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil du patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">

<h1 class="text-success text-center my-4">Profil du patient</h1>

   <div class="d-flex text-light text-center justify-content-center ">
   <div class="d-flex justify-content-center">
        <div class="card text-center bg-dark text-light mx-auto" style="width: 18rem;">
        <div class="card-body text-center">
            <h5 class="card-title text-success">Informations du patient</h5>
            <?php
                echo '<div class="text-center my-5">';
                echo 'Nom : ' . $user['lastname'] . '<br>';
                echo 'Prénom : ' . $user['firstname'] . '<br>';
                echo 'Date de naissance : ' . $user['birthdate'] . '<br>';
                echo 'Téléphone : ' . $user['phone'] . '<br>';
                echo 'Mail : ' . $user['mail'] . '<br>';
                echo '</div>';
            ?>
        </div>
    </div></div>
    <?php 
    foreach ($user2 as $key => $value) {
        if ($identifiant == $user2[$key]['idPatients']) { 
    ?>
<div class="d-flex">
<div class="card text-center bg-dark text-light mx-auto" style="width: 18rem;">
        <div class="card-body text-center mx-auto">
        <h5 class="card-title text-success">Rendez-vous du patient</h5>
            <?php
                echo '<div class="text-center my-5">';
                echo 'Nom : ' . $user2[$key]['lastname'] . '<br>';
                echo 'Prénom : ' . $user2[$key]['firstname'] . '<br>';
                echo 'Date du rendez-vous : ' . $user2[$key]['dateHour'] . '<br>';
                echo "<a class='btn btn-secondary' href='rendezvous.php?id=$identifiant'> En savoir plus</a>"  . '<br>';
                echo '</div>';
                
            ?>
        </div>
        </div>
        </div>
        
        
        
    <?php } }
   ?> </div>
   <div class="container container w-75 text-light">
    <div class="card text-center bg-dark text-light mx-auto">
        <h2 class="text-center text-success">Modifier les informations du patient</h2><br>

        <form action="profil-patient.php?id=<?php echo $identifiant ?>" method="post" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6 py-2">
        <label for="lastName" class="form-label">Nom</label>
        <input type="text" class="form-control" name="lastName"  value="<?= $user['lastname'] ?>" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    <div class="col-md-6 py-2">
        <label for="firstName" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="firstName" value="<?= $user['firstname'] ?>"  required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    
    <div class="col-md-12 py-2">
        <label for="birthdate" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" name="birthdate" value="<?= $user['birthdate'] ?>" required>
        <div class="invalid-feedback">
        Entrez votre date de naissance. 
        </div>
    </div>
    <div class="col-md-12 py-2">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" name="phone" value="<?= $user['phone'] ?>" required>
        <div class="invalid-feedback">
        Entrez votre numéro de téléphone.
        </div>
    </div>
    
    <div class="col-md-12 py-2">
        <label for="mail" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="mail" value="<?= $user['mail'] ?>" required>
        <div class="invalid-feedback">
        Entrez votre e-mail. 
        </div>
    </div>

   
    <div class="col-12">
        <button class="btn btn-success" type="submit">Envoyer</button>
    </div>
</form>
        
   </div>
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