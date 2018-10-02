<?php
include('../../config.php');
$id_audit = $_GET['id_audit'];
$type = $_GET['type'];
$id_pt = addslashes($_GET['id_pt']);
if($type == 'fort') {
  $nom_pt = addslashes($_GET['pt_fort_input']);
}else {
  $nom_pt = addslashes($_GET['pt_faible_input']);
}
$commentaires = addslashes($_GET['commentaires']);


$sql      = "INSERT INTO `audits2018_affectation_pts_forts_faibles` (`id`, `id_audit`, `id_pts_forts_faibles`,  `type`, `commentaires`, `ordre`)
VALUES (NULL, '".$id_audit."', '".$id_pt."', '".$type."', '".$commentaires."', '');";
echo $sql;
$result   = mysqli_query($db, $sql);

$sql2 = "SELECT * FROM `audits2018_pts_forts_faibles` WHERE `nom` = '".$nom_pt."' ";
echo $sql2;
$result2   = mysqli_query($db, $sql2);
$nb = mysqli_num_rows($result2);
if($nb == 0) {
  $sql2a      = "INSERT INTO `audits2018_pts_forts_faibles` (`id`, `nom`, `type`) VALUES (NULL, '".$nom_pt."', '".$type."');";
  echo $sql2a;
  $result2a   = mysqli_query($db, $sql2a);
}

?>
