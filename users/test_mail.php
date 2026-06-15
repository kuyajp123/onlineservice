<?php
require '../vendor/autoload.php';  // Load Composer's autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;            // Enable SMTP authentication
    $mail->Password = getenv('SMTP_PASSWORD'); // SMTP username
    $mail->Password = 'your-real-password';   // SMTP password
    $mail->SMTPSecure = 'tls';           // Enable TLS encryption
    $mail->Port       = 587;            // TCP port to connect to

    //Recipients
    $mail->setFrom('johnpaulnaag10@gmail.com', 'CvStagram');
    $mail->addAddress('kuyajp123@gmail.com', 'Recipient'); // Add a recipient

    // Content
    $mail->isHTML(true);               // Set email format to HTML
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent via PHPMailer.';
    $mail->AltBody = 'This is the plain text version for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
