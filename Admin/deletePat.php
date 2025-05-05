<?php
include "../connect.php" ;

$id_doc = $_GET['id'];


$sql = "DELETE FROM patient WHERE id_patient = $id_doc" ;


$reponse = $bdd->query($sql);


header("location: listePatient.php");


?>