<?php
include('../../config.php');
$id_audit = $_GET['id_audit'];
$type = $_GET['type'];
$recommandation = addslashes($_GET['recommandation']);
$commentaires = addslashes($_GET['commentaires']);
$tarif = addslashes($_GET['tarif']);

$sql      = "INSERT INTO `audits2018_affectation_tarif` (`id`, `id_audit`, `nom`, `tarif`, `type`, `commentaires`)
VALUES (NULL, '".$id_audit."', '".$recommandation."', '".$tarif."', '".$type."', '".$commentaires."');";
echo $sql;
$result   = mysqli_query($db, $sql);

$sql2 = "SELECT * FROM `audits2018_recommandations` WHERE `nom` = '".$recommandation."' ";
echo $sql2;
$result2   = mysqli_query($db, $sql2);
$nb = mysqli_num_rows($result2);
if($nb == 0) {
  $sql2a      = "INSERT INTO `audits2018_recommandations` (`id`, `nom`, `type`) VALUES (NULL, '".$recommandation."', '".$type."');";
  echo $sql2a;
  $result2a   = mysqli_query($db, $sql2a);
}
?>
