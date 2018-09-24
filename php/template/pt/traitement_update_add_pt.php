<?php
include('../../config.php');
$id_pt = $_GET['id_pt'];
$pt = addslashes($_GET['pt']);
$type = $_GET['type'];


$sql      = "UPDATE `audits2018_pts_forts_faibles` SET `nom` = '" . $pt . "',  `type` = '" . $type . "' WHERE `audits2018_pts_forts_faibles`.`id` = '" . $id_pt . "' ";
echo $sql;
$result   = mysqli_query($db, $sql);

?>
