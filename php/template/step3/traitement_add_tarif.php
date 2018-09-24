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


?>
