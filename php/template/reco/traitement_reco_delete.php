<?php
include('../../config.php');
$id = $_GET['id'];
$sql     = "DELETE FROM `audits2018_recommandations` WHERE `audits2018_recommandations`.`id` = '" . $id . "' ";
$result   = mysqli_query($db, $sql);
?>
