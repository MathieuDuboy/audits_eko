<?php
include("config.php");

$nom = addslashes($_GET['nom']);
$id_manager = $_GET['id_manager'];
$manager = $_GET['manager'];
$id_client = $_GET['id_client'];
$client = $_GET['client'];
$entreprise = $_GET['entreprise'];
$etat = $_GET['etat'];
$now = date("d/m/Y");

$sql    = "INSERT INTO `audits2018_audits` (`id`, `nom`, `id_client`, `nom_client`, `id_manager`, `nom_manager`, `etat`, `url_pdf`, `time_generation_pdf`,  `date_ajout`,`commentaires` ,`note`)
VALUES (NULL, '".$nom."', '".$id_client."', '".$client."', '".$id_manager."', '".$manager."', '".$etat."', '','', '".$now."', '', '');";
echo $sql;
$result = mysqli_query($db, $sql);
?>
