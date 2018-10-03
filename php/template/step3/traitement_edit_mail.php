<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// A modifier pour ton serveur
require '/home/of2ds84i/public_html/audits/vendor/autoload.php';
require '/home/of2ds84i/public_html/audits/vendor/phpmailer/phpmailer/src/Exception.php';
require '/home/of2ds84i/public_html/audits/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '/home/of2ds84i/public_html/audits/vendor/phpmailer/phpmailer/src/SMTP.php';

include('../../config.php');
$id = $_GET['id'];
$commentaires = addslashes($_GET['commentaires']);
$objet = addslashes($_GET['objet']);
$destinataire = addslashes($_GET['destinataire']);
$pdf = urldecode($_GET['pdf']);
// mailer

//  A Modifier avec tes infos
$Sendermail = "mathieu.duboy@gmail.com";
$Sendername = "Mathieu DUBOY";
$collabto = $destinataire;

$mail = new PHPMailer;


$mail->SMTPDebug = 1;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//  A Modifier avec tes infos
$mail->Username = 'mathieu.duboy@gmail.com';
$mail->Password = 'Pm7xojnz';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true);


$mail->setFrom($Sendermail, $Sendername);
$mail->addReplyTo($Sendermail, $Sendername);
$mail->addAddress($collabto ,$collabto );
//$mail->addBCC($bcc, $bcc);
$mail->Subject = $objet;
$mail->msgHTML($commentaires);


$numero_audit = 'A'.date("Ymd")."".$id;
$titlefact = $numero_audit.".pdf";
$mail->addStringAttachment(file_get_contents($pdf), $titlefact);
$mail->Encoding = "base64";
$mail->send();

?>
