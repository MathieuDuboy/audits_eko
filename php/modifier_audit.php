<?php
include('config.php');

$id_audit = $_GET['id_audit'];
$now = time();
if(isset($_GET['id_manager'])) {
  $sql = "UPDATE `audits2018_audits` SET `nom_manager` = '".addslashes($_GET['manager'])."', `id_manager` = '".$_GET['id_manager']."' WHERE `audits2018_audits`.`id` = $id_audit;";
}else if(isset($_GET['id_client']))  {
  $sql = "UPDATE `audits2018_audits` SET `nom_client` = '".addslashes($_GET['client'])."', `id_client` = '".$_GET['id_client']."' WHERE `audits2018_audits`.`id` = $id_audit;";
}else if(isset($_GET['nom']))  {
  $sql = "UPDATE `audits2018_audits` SET `nom` = '".addslashes($_GET['nom'])."' WHERE `audits2018_audits`.`id` = $id_audit;";
}else if(isset($_GET['date_ajout']))  {
  $sql = "UPDATE `audits2018_audits` SET `date_ajout` = '".$_GET['date_ajout']."' WHERE `audits2018_audits`.`id` = $id_audit;";
}else if(isset($_GET['etat']))  {
  $sql = "UPDATE `audits2018_audits` SET `etat` = '".$_GET['etat']."' WHERE `audits2018_audits`.`id` = $id_audit;";
}else if(isset($_GET['commentaires']))  {
  $sql = "UPDATE `audits2018_audits` SET `commentaires` = '".addslashes($_GET['commentaires'])."' WHERE `audits2018_audits`.`id` = $id_audit;";
}
echo $sql;
$result = mysqli_query($db, $sql);

?>
