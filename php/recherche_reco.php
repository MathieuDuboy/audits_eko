<?php

include("config.php");
$type_de_recherche = $_GET['type'];
$recherche = $_GET['recherche'];
$entreprise = $_GET['entreprise'];
$phrase = $_GET['phrase'];

//echo $client;

global $db;
global $label_obj;
if($type_de_recherche == 'OBLIGATOIRE') {
	$query = "SELECT * from audits2018_recommandations WHERE type = 'OBLIGATOIRE' ORDER BY id";
  $result = $db->query($query) or die($db->error);
  $content = '';
  $count = 0;

  $tab = array();
$a = 0;
  while($row = $result->fetch_array()) {
    extract($row);
    $tab[$a]["visuel"] = $nom;
		$tab[$a]["id"] = $id;
    $a++;

  }//loop ends here.
}else if($type_de_recherche == 'RECOMMANDE') {
	$query = "SELECT * from audits2018_recommandations WHERE type = 'RECOMMANDE' ORDER BY id";
  $result = $db->query($query) or die($db->error);
  $content = '';
  $count = 0;

  $tab = array();
$a = 0;
  while($row = $result->fetch_array()) {
    extract($row);
    $tab[$a]["visuel"] = $nom;
		$tab[$a]["id"] = $id;

    $a++;

  }//loop ends here.
}
else if($type_de_recherche == 'CONFORT') {
	$query = "SELECT * from audits2018_recommandations WHERE type = 'CONFORT' ORDER BY id";
  $result = $db->query($query) or die($db->error);
  $content = '';
  $count = 0;

  $tab = array();
$a = 0;
  while($row = $result->fetch_array()) {
    extract($row);
    $tab[$a]["visuel"] = $nom;
		$tab[$a]["id"] = $id;

    $a++;

  }//loop ends here.
}
echo json_encode($tab);

?>
