<?php session_start();

    require_once('connexion.php');
    if (!empty($_POST['idDelete'])) {
        $identifiant = $_POST['idDelete'];
        $sqlQuery3 = "DELETE FROM appointments WHERE idPatients=$identifiant";
        $insertRecipe3 = $db->prepare($sqlQuery3);
        $insertRecipe3->execute();

        $delete =  $db->query("DELETE FROM patients WHERE id=$identifiant");
        $userApp = $delete->fetch();
        
        echo '<p class="alert alert-success text-center">Vous avez supprimé le patient</p>';
        
        }
    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM patients ORDER BY lastname');

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
<div class="d-flex align-items-center justify-content-evenly my-5">
<h1 class="text-success text-center">Liste des patients</h1> 
<form action = "search-patient.php " method = "get">
   <input type = "search" name = "terme" placeholder="Nom du patient...">
   <input type = "submit" name = "s" value = "Rechercher">
</form>
  </div>
   <div class="container w-75 text-light  my-5">
    
<div class="card text-center bg-dark text-light mx-auto" >
        <div class="card-body text-center">
    <?php  foreach ($user as $key => $value) {
        $identifiant = $user[$key]['id'];
        echo '<div class="text-center my-2 ">';
         $transi = $user[$key]['lastname'] . ' ' . $user[$key]['firstname'] .'<br>' ;
         echo "<li class='border border-bottom border-light'>$transi</li><br>"; ?>
            <form action="liste-patients.php" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-12 my-2">
            <input type="hidden" name="idDelete" value="<?php echo $identifiant ?>">
            <button class="btn btn-danger my-1" type="submit">Supprimer ce patient</button>
            </form>
            <form action="profil-patient.php?id=<?php echo $user[$key]['id'] ?>" method="post" class="needs-validation d-inline" novalidate>
            <button class="btn btn-success" type="submit">Détail fiche patient</button>
            </form>
            <form action="profil-patient.php?id=<?php echo $user[$key]['id'] ?>" method="post" class="needs-validation d-inline" novalidate>
            <button class="btn btn-primary" type="submit">Modifier fiche patient</button>
            </form>
            <?php echo '</div>'; } ?>
    </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>