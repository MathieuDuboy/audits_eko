<?php
include('../../config.php');
$id_element_affectation = $_GET['id_element_affectation'];

$sql     = "DELETE FROM `audits2018_affectation_element` WHERE `audits2018_affectation_element`.`id` = '" . $id_element_affectation . "' ";
echo $sql;
$result  = mysqli_query($db, $sql);

$sql2     = "DELETE FROM `audits2018_affectation_specification` WHERE `audits2018_affectation_specification`.`id_affectation_element` = '" . $id_element_affectation . "' ";
echo $sql2;
$result2  = mysqli_query($db, $sql2);
?>
