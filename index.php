<?php

    require_once('connexion.php');

    // on commence par préparer la requète grace à query()
    $request =  $db->query('SELECT * FROM clients ORDER BY lastName');

    // on récupère la réponse à la requète grâce à fetch(), car je n'ai qu'un seul user en BDD
    $user = $request->fetchAll();
       
   $i = 0;
//    foreach ($user as $key => $use) {
//     echo '<pre>';
//    print_r($user[$key]['lastName']);
//    echo '</pre>';
   
//    while ($i < 20) {
//     echo '<pre>';
//     print_r($user[$i]['lastName']);
//     echo '</pre>';
//     $i++;
//    }

// foreach ($user as $key => $use) {
//     echo '<pre>';
//    print_r($user[$key]['lastName']);
//    echo '</pre>';
// }
// $ordreAlpha = [];

foreach ($user as $key => $use) {
    if (str_starts_with($user[$key]['lastName'], 'M')) {
    echo '<pre>';
   echo "Nom : " . $user[$key]['lastName']. '<br>';
   echo "Prénom : " . $user[$key]['firstName'];
   echo '</pre>';
        // array_push($ordreAlpha, $user[$key]['lastName']);

    }
}
//     sort($ordreAlpha);
//     echo '<pre>';
//    var_dump($ordreAlpha);
//    echo '</pre>';
   
//    ?>