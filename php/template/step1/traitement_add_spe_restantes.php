<?php
include('../../config.php');
$id_restantes = $_GET['id_restantes'];
$id_element_affectation = $_GET['id_element_affectation'];
$id_audit = $_GET['id_audit'];
$specifications_modale = $_GET['specifications_modale'];

$a = 1;
foreach($specifications_modale as $specification) {
  $sql2      = "INSERT INTO `audits2018_affectation_specification` (`id`, `id_audit`, `id_affectation_element`, `id_specification`, `valeur`, `ordre`)
  VALUES (NULL, '".$id_audit."', '".$id_element_affectation."', '".$specification."', '', '".$a."');";
  echo $sql2;
  $result2  = mysqli_query($db, $sql2);
  $a++;
}
?>
