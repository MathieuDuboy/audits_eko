<?php
include('../../config.php');
$id_audit = $_GET['id_audit'];
$type = $_GET['type'];
$id_pt = addslashes($_GET['id_pt']);
$commentaires = addslashes($_GET['commentaires']);


$sql      = "INSERT INTO `audits2018_affectation_pts_forts_faibles` (`id`, `id_audit`, `id_pts_forts_faibles`,  `type`, `commentaires`, `ordre`)
VALUES (NULL, '".$id_audit."', '".$id_pt."', '".$type."', '".$commentaires."', '');";
echo $sql;
$result   = mysqli_query($db, $sql);


?>
