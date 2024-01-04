<?php session_start();

    require_once('connexion.php');

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM patients');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $user = $request->fetchAll();

    include_once('navbar.php');

?>

<section class="container text-center mx-auto ">
    <img class="w-50" src="./image/pngwing.com.png"></a>
</section>


