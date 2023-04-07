<?php
    
    // $host = "cosc360.ok.ubc.ca";
    // $database = "db_63271324";
    // $user = "63271324";
    // $pass = "63271324";

    $host = "localhost";
    $database = "skiit";
    $user = "webuser";
    $pass= "P@ssw0rd";
    
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$database",$user, $pass);
    }
    catch(PDOException $e){
        die($e->getMessage());
    }

?>