<?php
include "connect.php" ;

$id_rend = $_GET['id'];


$sql = "DELETE FROM rendez_vous WHERE id_rend = $id_rend" ;


$reponse = $bdd->query($sql);


header("location: docteurs.php");


?>