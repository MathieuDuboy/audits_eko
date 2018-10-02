<?php
include('../../config.php');
$id_element = $_GET['elements_modale'];
$id_element_affectation = $_GET['id_element_affectation'];
$id_audit = $_GET['id_audit'];
$tag = addslashes($_GET['tag']);
$nb = addslashes($_GET['nb']);
$commentaires = addslashes($_GET['commentaires']);

$ids_spe = $_GET['spe_ids'];
foreach($ids_spe as $id => $valeur) {
  $sql      = "UPDATE `audits2018_affectation_specification` SET `valeur` = '" . $valeur . "' WHERE `audits2018_affectation_specification`.`id` = '" . $id . "' ";
  $result   = mysqli_query($db, $sql);
}
$sql      = "UPDATE `audits2018_affectation_element` SET `tag` = '" . $tag . "', `nb` = '" . $nb . "', `commentaires` = '" . $commentaires . "' WHERE `audits2018_affectation_element`.`id` = '" . $id_element_affectation . "' ";
echo $sql;
$result   = mysqli_query($db, $sql);


?>
