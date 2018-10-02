<?php
include('../../config.php');
$id = $_GET['id'];
$val = addslashes($_GET['val']);

$sql      = "UPDATE `audits2018_recommandations` SET `nom` = '".$val."' WHERE `audits2018_recommandations`.`id` = '".$id."' ";
$result   = mysqli_query($db, $sql);
?>
