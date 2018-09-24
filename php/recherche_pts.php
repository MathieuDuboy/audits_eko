<?php

include("config.php");
$type_de_recherche = $_GET['type'];
$recherche = $_GET['recherche'];
$entreprise = $_GET['entreprise'];
$phrase = $_GET['phrase'];

//echo $client;

global $db;
global $label_obj;
if($type_de_recherche == 'fort') {
	$query = "SELECT * from audits2018_pts_forts_faibles WHERE type = 'fort' ORDER BY id";
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
}else if($type_de_recherche == 'faible') {
	$query = "SELECT * from audits2018_pts_forts_faibles WHERE type = 'faible' ORDER BY id";
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
