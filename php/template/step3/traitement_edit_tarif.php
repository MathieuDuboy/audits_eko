<?php
include('../../config.php');
$id = $_GET['id'];
$commentaires = addslashes($_GET['commentaires']);
$tarif = addslashes($_GET['tarif']);
$nom = addslashes($_GET['recommandation']);
$sql      = "UPDATE `audits2018_affectation_tarif` SET `commentaires` = '".$commentaires."', nom = '".$nom."', tarif = '".$tarif."' WHERE `audits2018_affectation_tarif`.`id` = '".$id."' ";
echo $sql;
$result   = mysqli_query($db, $sql);
?>
