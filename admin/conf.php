<?php 
     


$host       = 'mysql:host=localhost;dbname=shop'; //or localhost
$database   = 'shop';
$port       = 8081;
$user       = 'root';
$password   = '';


    try{
        $con  = new PDO( $host , $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    catch(PDOException $e)
    {
        echo 'Failed To Connected' . $e->getMassage();
    }
     

?>