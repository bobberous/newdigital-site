<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer (manual include)
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mail.newdigit.al'; // change if needed
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@newdigit.al'; // your email
    $mail->Password = 'Wanker1999$$';       // your email password
    $mail->SMTPSecure = 'ssl'; // or 'tls'
    $mail->Port = 465;         // or 587 for TLS

    // Set sender/recipient
    $mail->setFrom('contact@newdigit.al', 'Website Contact');
    $mail->addAddress('bobbyoerzen@gmail.com'); // where to send

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = "<strong>Name:</strong> {$_POST['name']}<br>
                      <strong>Email:</strong> {$_POST['email']}<br>
                      <strong>Message:</strong><br>{$_POST['message']}";

    $mail->send();
    echo json_encode(['response' => 'success']);
} catch (Exception $e) {
    echo json_encode(['response' => 'error', 'info' => $mail->ErrorInfo]);
}
?>