<?php
include('../../config.php');

$sql2    = "DELETE FROM `audits2018_liste_elements` WHERE `audits2018_liste_elements`.`id` = '" . $_GET['id_element'] . "' ";
echo $sql2;
$result2 = mysqli_query($db, $sql2);

$sql2a    = "DELETE FROM `audits2018_liste_specifications` WHERE `audits2018_liste_specifications`.`id_element` = '" . $_GET['id_element'] . "' ";
echo $sql2a;
$result2a = mysqli_query($db, $sql2a);

?>
