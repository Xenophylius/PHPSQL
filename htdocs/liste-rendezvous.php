<?php session_start();

    require_once('connexion.php');
    if (isset($_GET['id'])) {
    $identifiant = $_GET['id'];
    $delete =  $db->query("DELETE FROM appointments WHERE id={$_GET['id']}");
    
    
    echo '<p class="alert alert-success text-center">Vous avez supprimé le rendez-vous</p>';
    
    }
    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT appointments.id AS appointment_id, appointments.dateHour, patients.* FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id ORDER BY dateHour');
    

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $user = $request->fetchAll();

   
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

<h1 class="text-success text-center">Liste des rendez-vous</h1>
   <div class="container w-75 text-light my-5 text-center">
    
   <?php 
    foreach ($user as $key => $value) {
        $identifiant = $user[$key]['id']; 
        
    ?>
<div class="card text-center bg-dark text-light mx-auto" >
        <div class="card-body text-center">
            <?php
                echo '<div class="text-center my-5">';
                echo 'Nom : ' . $user[$key]['lastname'] . '<br>';
                echo 'Prénom : ' . $user[$key]['firstname'] . '<br>';
                echo 'Date du rendez-vous : ' . $user[$key]['dateHour'] . '<br>';
                echo "<div class='d-flex justify-content-center py-3'><a class='btn btn-secondary mx-3' href='rendezvous.php?id=$identifiant'> En savoir plus</a>";?>

                    <form action="liste-rendezvous.php?id=<?php echo $user[$key]['appointment_id'] ?>" method="post" class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">Supprimer ce rendez-vous</button>
                            
                        </div>
                    </form>
                <?php 
                

                echo '</div></div>';
                
            ?>
        </div>
        
        </div>
        
        
        
    <?php }
   ?> <a class="btn btn-secondary" href="ajout-rendezvous.php">Créer un rendez-vous.</a></div>

    
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>