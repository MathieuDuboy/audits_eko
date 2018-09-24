<?php
include('../../config.php');
$pt = addslashes($_GET['pt']);
$type = $_GET['type'];

$sql      = "INSERT INTO audits2018_pts_forts_faibles (id, nom, type) VALUES (NULL, '" . $pt . "', '".$type."')";
echo $sql;
$result   = mysqli_query($db, $sql);

?>
