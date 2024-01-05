<?php session_start();

    require_once('connexion.php');
    include_once('navbar.php');
        
        function dump($variable){
            echo '<pre>';
            print_r($variable);
            echo '</pre>';
        };
?>

<div class="d-flex align-items-center justify-content-evenly my-5">
<h1 class="text-success text-center">Recherche patient</h1> 
<form action = "search-patient.php " method = "get">
   <input type = "search" name = "terme" placeholder="Nom du patient...">
   <input type = "submit" name = "s" value = "Rechercher">
</form>
    </div>

<?php 
    if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
{
 $_GET["terme"] = htmlspecialchars($_GET["terme"]); 
 $terme = $_GET["terme"];
 $terme = trim($terme); 
 $terme = strip_tags($terme);

 if (empty($terme)) {
    echo '<p class="alert alert-danger text-center">Aucun patient trouvé. Veuillez vérifier le nom.</p><br>';
    exit;
 } else {
  $terme = strtolower($terme);
  $select_terme = $db->prepare("SELECT * FROM patients WHERE lastname=?");
  $select_terme->execute([
    $terme,
  ]);


  while($terme_trouve = $select_terme->fetch())
  { 
        
        echo "<div class='text-center my-5 text-light'><h1>".$terme_trouve['lastname'].' '.$terme_trouve['firstname']."</h1><br>";?>
        <form action="liste-patients.php?id=<?php echo $identifiant ?>" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-12 my-2">
            <button class="btn btn-danger my-1" type="submit">Supprimer ce patient</button>
            </form>
            <form action="profil-patient.php?id=<?php echo $terme_trouve['id'] ?>" method="post" class="needs-validation d-inline" novalidate>
            <button class="btn btn-success" type="submit">Détail fiche patient</button>
            </form>
            <form action="profil-patient.php?id=<?php echo $terme_trouve['id'] ?>" method="post" class="needs-validation d-inline" novalidate>
            <button class="btn btn-primary" type="submit">Modifier fiche patient</button>
            </form>
            <div>
                <form action="liste-patients.php">
                    <button class="btn btn-secondary" type="submit">retour vers la liste des patients</button>
                </form>
            </div>
            <?php echo '</div>';  }  }
    
        }

?>

