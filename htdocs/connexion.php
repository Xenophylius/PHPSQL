<?php 
   try
   {
        
        $dsn = 'mysql:host=127.0.0.1;dbname=hospitalE2N';
        $user = 'root';
        $password = '';
        $db = new PDO( $dsn, $user, $password);
   }
   catch (Exception $message){
        echo "ya un blem <br>" . "<pre>$message</pre>" ;
   }
   ?>