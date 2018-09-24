<?php
include('../../config.php');
$element = addslashes($_GET['element']);
$id_element = addslashes($_GET['id_element']);

$nom_spe = $_GET['nom_spe'];
$id_spe = $_GET['id_spe'];
$categorie = $_GET['categorie'];

$sql      = "UPDATE `audits2018_liste_elements` SET `nom` = '" . trim($element) . "', `categorie` = '" . trim($categorie) . "' WHERE `audits2018_liste_elements`.`id` = '" . $id_element . "' ";
echo $sql;
$result   = mysqli_query($db, $sql);
$a        = 1;
$c        = 0;
foreach ($nom_spe as $value) {
    if($id_spe[$c] == '') {
      if($value != '') {
        $sql3 = "INSERT INTO `audits2018_liste_specifications` (`id`, `id_element`, `nom`,  `ordre`) VALUES (NULL, '".$id_element."', '".$value."',  '".$a."');";
        echo $sql3;
        $result3 = mysqli_query($db, $sql3);
      }
    }else {
      $sql3 = "UPDATE `audits2018_liste_specifications` SET `nom` = '".$value."',  `ordre` = '".$a."' WHERE `audits2018_liste_specifications`.`id` = '".$id_spe[$c]."' ";
      echo $sql3;
      $result3 = mysqli_query($db, $sql3);
    }
    $a++;
    $c++;
}
?>
