<?php
include('config.php');
$id_audit = $_POST['id_audit'];
$uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/audits/uploads/".$id_audit.'/';
mkdir($uploaddir, 0755, true);
$nom_ref = '/audits/uploads/'.$id_audit.'/';
$url = $_POST['retour_url'];
$now = time();
foreach($_FILES['userfile']['tmp_name'] as $key => $tmp_name) {
  $uploadfile = $uploaddir . basename($tmp_name);
  $nom = $_FILES['userfile']['name'][$key];
  $nom_complet = $uploaddir.$nom;

  $nom_ref_complet = '/audits/uploads/'.$id_audit.'/'.$nom;
  echo $nom_ref_complet;
  if (move_uploaded_file($tmp_name, $nom_complet)) {
    $sql    = "INSERT INTO `audits2018_fichiers` (`id`, `chemin`,  `id_audit`,  `date_depot`)
    VALUES (NULL, '".$nom_ref_complet."', '".$id_audit."', '".$now."');";

    $result = mysqli_query($db, $sql);
  } else {
    header('Location: '.$url);
  }
}
header('Location: '.$url);
/*
echo $key.$_FILES['userfile']['name'][$key].'<br />';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($key.$_FILES['userfile']['name'][$key], $uploadfile)) {
  // enregistrer les fichiers dans la table
  $nom =  $key.$_FILES['userfile']['name'][$key];
  echo $key.$_FILES['userfile']['name'][$key].'<br />';
  $sql    = "INSERT INTO `audits2018_fichiers` (`id`, `chemin`,  `id_audit`,  `date_depot`)
  VALUES (NULL, '".$uploaddir."/".$nom."', '".$id_audit."', '".$now."');";
  echo $sql;
  $result = mysqli_query($db, $sql);

} else {
//  header('Location: '.$url);
}

*/
//header('Location: '.$url);
//exit;
/*
echo 'Voici quelques informations de débogage :';
print_r($_FILES);

echo '</pre>';

*/
?>
