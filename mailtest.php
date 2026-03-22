<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

try {
$mail->isSMTP();
$mail->Host       = 'pl05.marcaria.net';
$mail->SMTPAuth   = true;
$mail->Username   = 'contact@newdigit.al';   // your email
$mail->Password   = 'Wanker1999$$';   // your password
$mail->SMTPSecure = 'ssl';                   // or 'tls'
$mail->Port       = 465;                     // or 587 if using tls

    $mail->setFrom('contact@newdigit.al', 'New Digit Contact');
    $mail->addAddress('bobbyoerzen@gmail.com');

    $mail->Subject = 'SMTP2Go Test Email';
    $mail->Body    = 'This message was sent using SMTP2Go and PHPMailer.';

    $mail->send();
    echo '✅ Message sent!';
} catch (Exception $e) {
    echo '❌ Error: ' . $mail->ErrorInfo . '<br>';
    echo 'Trace: ' . $e->getMessage();
}
?>
