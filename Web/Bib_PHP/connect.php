<?php
//Définition des constantes
define("user","root");
define("password","");
define("server","localhost");
define("base","my book");

$dsn="mysql:dbname=".base.";host=".server;
try{
    $connect = new PDO($dsn,user,password);
}
catch(PDOException $e){
    exit();
}
?>