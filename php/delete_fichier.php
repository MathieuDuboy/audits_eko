<?php
include('config.php');
$id_fichier = $_GET['id_fichier'];

$sql     = "DELETE FROM `audits2018_fichiers` WHERE `audits2018_fichiers`.`id` = '" . $id_fichier . "' ";
echo $sql;
$result  = mysqli_query($db, $sql);

?>
