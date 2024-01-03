<?php session_start();

    require_once('connexion.php');

    $identifiant = $_GET['id'];
    
    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $user = $request->fetchAll();
    
    $sqlQuery2 = "UPDATE patients SET lastname=:lastName, firstname=:firstName, birthdate=:birthdate, phone=:phone, mail=:mail WHERE id=$identifiant";
    $insertRecipe2 = $db->prepare($sqlQuery2);

    
    $sqlQuery3 = "UPDATE appointments SET dateHour=:dateHour WHERE idPatients=$identifiant";
    $insertRecipe3 = $db->prepare($sqlQuery3);

   function dump($variable){
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
   };
   if (isset($_POST['lastName']) && 
   isset($_POST['firstName']) && 
   isset($_POST['birthdate']) && 
   isset($_POST['phone']) && 
   isset($_POST['mail']) && 
   isset($_POST['dateHour'])) {

   $lastName = htmlspecialchars($_POST['lastName']);
   $firstName = htmlspecialchars($_POST['firstName']);
   $birthdate = htmlspecialchars($_POST['birthdate']);
   $phone = htmlspecialchars($_POST['phone']);
   $mail = htmlspecialchars($_POST['mail']);
   $dateHour = htmlspecialchars($_POST['dateHour']);

  $insertRecipe2->execute([
   ':lastName' => $lastName,
   ':firstName' => $firstName,
   ':birthdate' => $birthdate,
   ':phone' => $phone,
   ':mail' => $mail,
]);

$insertRecipe3->execute([
    ':dateHour' => $dateHour,
 ]);

include_once('navbar.php');
   echo '<p class="alert alert-success text-center">Vous avez modifié un rendez-vous</p>';
   echo "<li><a href='rendezvous.php?id={$identifiant}'>Retour vers la page du rendez-vous</a></li>";
   } else {
       include_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">

<h1 class="text-success text-center">Détail du rendez-vous</h1>
   <div class="container w-75 text-light border border-info-emphasis my-5">
    
    <?php
        
        foreach ($user as $key => $value) {
            if ($identifiant == $user[$key]['id']) { ?>

<div class="card text-center bg-dark text-light mx-auto" >
        <div class="card-body text-center">
            <h5 class="card-title text-success">Informations du patient</h5>
            <?php
                echo '<div class="text-center my-5">';
                echo 'Nom : ' . $user[$key]['lastname'] . '<br>';
                echo 'Prénom : ' . $user[$key]['firstname'] . '<br>';
                echo 'Date de naissance : ' . $user[$key]['birthdate'] . '<br>';
                echo 'Téléphone : ' . $user[$key]['phone']  . '<br>';
                echo 'Mail : ' . $user[$key]['mail'] . '<br>';
                echo 'Date du rendez-vous : ' . $user[$key]['dateHour'] . '<br>';
                echo '</div>';
            ?>
        </div>
    
                
            <?php } ?>
            <?php } ?>
    

    <a href="liste-rendezvous.php">Liste des rendez-vous.</a>
</div>

<div class="container container w-75 text-light">
        <h2 class="text-center text-success">Modifier les informations du rendez-vous</h2><br>

        <form action="rendezvous.php?id=<?php echo $identifiant ?>" method="post" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6 py-2">
        <label for="lastName" class="form-label">Nom</label>
        <input type="text" class="form-control" name="lastName" value="<?= $user[$key]['lastname']?>" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    <div class="col-md-6 py-2">
        <label for="firstName" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="firstName" value="<?= $user[$key]['firstname']?>" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    
    <div class="col-md-12 py-2">
        <label for="birthdate" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" name="birthdate" value="<?= $user[$key]['birthdate']?>" required>
        <div class="invalid-feedback">
        Entrez votre date de naissance. 
        </div>
    </div>
    <div class="col-md-12 py-2">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" name="phone" value="<?= $user[$key]['phone']?>" required>
        <div class="invalid-feedback">
        Entrez votre numéro de téléphone.
        </div>
    </div>
    
    <div class="col-md-12 py-2">
        <label for="mail" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="mail" value="<?= $user[$key]['mail']?>" required>
        <div class="invalid-feedback">
        Entrez votre e-mail. 
        </div>
    </div>

    <div class="col-md-6 py-2">
        <label for="dateHour" class="form-label">Séléctionner une date et une heure</label>
        <input type="datetime-local" name="dateHour" class="form-control" name="dateHour" value="<?= $user[$key]['dateHour']?>" required>
        <div class="valid-feedback">
        Looks good!
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-success" type="submit">Envoyer</button>
    </div>
</form>
<?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>