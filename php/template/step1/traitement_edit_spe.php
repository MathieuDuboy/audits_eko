<?php
include('../../config.php');
$id = $_GET['id'];
$valeur = $_GET['valeur'];


$sql      = "UPDATE `audits2018_affectation_specification` SET `valeur` = '" . $valeur . "' WHERE `audits2018_affectation_specification`.`id` = '" . $id . "' ";
echo $sql;
$result   = mysqli_query($db, $sql);


?>
