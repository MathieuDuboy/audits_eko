<?php
include('config.php');
$id_audit = $_GET['id_audit'];

$sql     = "DELETE FROM `audits2018_audits` WHERE `audits2018_audits`.`id` = '" . $id_audit . "' ";
$result  = mysqli_query($db, $sql);

$sql2    = "DELETE FROM `audits2018_affectation_element` WHERE `audits2018_affectation_element`.`id_audit` = '" . $id_audit . "' ";
$result2 = mysqli_query($db, $sql2);

$sql3    = "DELETE FROM `audits2018_affectation_pts_forts_faibles` WHERE `audits2018_affectation_pts_forts_faibles`.`id_audit` = '" . $id_audit . "' ";
$result3 = mysqli_query($db, $sql3);

$sql4    = "DELETE FROM `audits2018_affectation_specification` WHERE `audits2018_affectation_specification`.`id_audit` = '" . $id_audit . "' ";
$result4 = mysqli_query($db, $sql4);

?>
