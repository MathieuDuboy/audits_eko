<?php
define ("DB_HOST", "localhost"); //Databse Host.
/*define ("DB_USER", "eko_backoff"); //Databse User.
define ("DB_PASS", "_Pq034wo"); //database password.
define ("DB_NAME", "ekobackoffice"); //database Name.*/

//define("DB_USER", "root"); //Databse User.
//define("DB_PASS", "root"); //database password.
//define("DB_NAME", "eko_audits"); //database Name.*/

// Sur mon-chatbot.com (test)
define("DB_USER", "of2ds84i_robert"); //Databse User.
define("DB_PASS", "Pm7xojnz"); //database password.
define("DB_NAME", "of2ds84i_wp587"); //database Name.

// inforamtions statiques car obtenues grâce à l'initialisation du CRM EKO
// Obligation de simuler ici

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno > 0) {
    die('Unable to connect to database 1 [' . $db->connect_error . ']');
}
$db->set_charset("utf8");

?>
