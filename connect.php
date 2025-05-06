<?php
session_start();
$servername = "localhost";
$database = "testos";
// $database = "sante";

$username = "root";
$password = "";


try{
    $bdd = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e){
    echo "ERREUR : " .$e->getMessage();
}

?>
