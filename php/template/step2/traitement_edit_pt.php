<?php
include('../../config.php');
$id = $_GET['id'];
$commentaires = addslashes($_GET['commentaires']);

$sql      = "UPDATE `audits2018_affectation_pts_forts_faibles` SET `commentaires` = '".$commentaires."' WHERE `audits2018_affectation_pts_forts_faibles`.`id` = '".$id."' ";
echo $sql;
$result   = mysqli_query($db, $sql);
?>
