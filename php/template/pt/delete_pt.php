<?php
include('../../config.php');

$sql2    = "DELETE FROM `audits2018_pts_forts_faibles` WHERE `audits2018_pts_forts_faibles`.`id` = '" . $_GET['id_pt'] . "' ";
echo $sql2;
$result2 = mysqli_query($db, $sql2);

?>
