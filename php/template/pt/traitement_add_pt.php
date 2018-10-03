<?php
include('../../config.php');
$pt = addslashes($_GET['pt']);
$type = $_GET['type'];
$commentaires = addslashes($_GET['commentaires']);

$sql      = "INSERT INTO audits2018_pts_forts_faibles (id, nom, commentaire_de_base, type) VALUES (NULL, '" . $pt . "', '".$commentaires."',  '".$type."')";
echo $sql;
$result   = mysqli_query($db, $sql);

?>
