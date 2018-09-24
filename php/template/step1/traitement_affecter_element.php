<?php
include('../../config.php');
$categorie = $_GET['categorie_element'];
$id_element = $_GET['elements_modale'];
$id_audit = $_GET['id_audit'];
$tag = addslashes($_GET['tag']);
$nb = addslashes($_GET['nb']);
$commentaires = addslashes($_GET['commentaires']);

$specifications_modale = $_GET['specifications_modale'];

$sql      = "INSERT INTO `audits2018_affectation_element` (`id`, `id_audit`, `id_element`, `tag`, `categorie`, `ordre`, `nb`, `commentaires`)
VALUES (NULL, '".$id_audit."', '".$id_element."', '".$tag."', '".$categorie."', '', '".$nb."', '".$commentaires."');";
echo $sql;
$result   = mysqli_query($db, $sql);
// last id
$last_id = mysqli_insert_id($db);
$a = 1;
foreach($specifications_modale as $specification) {
  $sql2      = "INSERT INTO `audits2018_affectation_specification` (`id`, `id_audit`, `id_affectation_element`, `id_specification`, `valeur`, `ordre`)
  VALUES (NULL, '".$id_audit."', '".$last_id."', '".$specification."', '', '".$a."');";
  echo $sql2;
  $result2  = mysqli_query($db, $sql2);
  $a++;
}
?>

<?



?>
