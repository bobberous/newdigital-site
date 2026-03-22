<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

header('Content-Type: application/json');

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'pl05.marcaria.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contact@newdigit.al';
    $mail->Password   = 'Wanker1999$$';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // 🚨 NO DEBUGGING OUTPUT IN PROD
    $mail->SMTPDebug = 0;

    // Sanitize input
    $name    = htmlspecialchars($_POST['name'] ?? '');
    $email   = htmlspecialchars($_POST['email'] ?? '');
    $message = nl2br(htmlspecialchars($_POST['message'] ?? ''));
    $subject = htmlspecialchars($_POST['subject'] ?? 'Website Contact');

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['response' => 'error', 'info' => 'Missing required fields']);
        exit;
    }

    $mail->setFrom('contact@newdigit.al', 'Website Contact');
    $mail->addAddress('bobbyoerzen@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "
        <strong>Name:</strong> {$name}<br>
        <strong>Email:</strong> {$email}<br>
        <strong>Message:</strong><br>{$message}
    ";

    $mail->send();
    echo json_encode(['response' => 'success']); // ✅ This matches what contact.js wants
} catch (Exception $e) {
    echo json_encode(['response' => 'error', 'info' => $mail->ErrorInfo]);
}
?>