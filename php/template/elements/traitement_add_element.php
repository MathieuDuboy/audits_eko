<?php
include('../../config.php');
$element = addslashes($_GET['element']);
$nom_specification = $_GET['nom_specification'];
$categorie = $_GET['categorie'];
$sql      = "INSERT INTO audits2018_liste_elements (id, nom, categorie) VALUES (NULL, '" . $element . "', '" . $categorie . "')";
echo $sql;
$result   = mysqli_query($db, $sql);
$id_element = mysqli_insert_id($db);
$a        = 1;
$b        = 0;
foreach ($nom_specification as $value) {
  if($value != '')  {
    $sql2    = "INSERT INTO `audits2018_liste_specifications` (`id`, `id_element`, `nom`, `ordre`) VALUES (NULL, '".$id_element."', '".$value."', '" . $a . "');";
    echo $sql2;
    $result2 = mysqli_query($db, $sql2);
    $a++;
    $b++;
  }
}
?>
