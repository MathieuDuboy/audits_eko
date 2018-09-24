<?php
include('../../config.php');
$id_audit = $_GET['id_audit'];
$note = addslashes($_GET['note']);

$sql      = "UPDATE `audits2018_audits` SET `note` = '".$note."' WHERE `audits2018_audits`.`id` = '".$id_audit."' ";
echo $sql;
$result   = mysqli_query($db, $sql);


?>
