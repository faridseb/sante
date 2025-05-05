<?php
include "../connect.php" ;

$id_doc = $_GET['id'];


$sql = "DELETE FROM docteurs WHERE id_doc = $id_doc" ;


$reponse = $bdd->query($sql);


header("location: doc.php");


?>