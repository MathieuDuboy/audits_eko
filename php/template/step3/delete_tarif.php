<?php
include('../../config.php');
$id = $_GET['id'];

$sql2     = "DELETE FROM `audits2018_affectation_tarif` WHERE `audits2018_affectation_tarif`.`id` = '" . $id . "' ";
echo $sql2;
$result2  = mysqli_query($db, $sql2);
?>
