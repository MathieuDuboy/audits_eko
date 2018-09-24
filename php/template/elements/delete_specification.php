<?php
include('../../config.php');

$sql2    = "DELETE FROM `audits2018_liste_specifications` WHERE `audits2018_liste_specifications`.`id` = '" . $_GET['id_stache'] . "' ";
echo $sql2;
$result2 = mysqli_query($db, $sql2);

?>
