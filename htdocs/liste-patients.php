<?php session_start();

    require_once('connexion.php');

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM patients');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $user = $request->fetchAll();
       

   function dump($variable){
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
   };

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

<h1 class="text-success text-center">Liste des patients</h1>
   <div class="container w-75 text-light border border-info-emphasis my-5">
    

    <?php  foreach ($user as $key => $value) {
         $transi = $user[$key]['lastname']. ' ' . '<br>';
         echo "<li><a href='profil-patient.php?id={$user[$key]['id']}'>$transi</a></li>";
        //  echo $user[$key]['lastname']. ' ' . $user[$key]['firstname'] . '<br>' ; 
         
    }
         ?>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>