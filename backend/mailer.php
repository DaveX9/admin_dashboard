<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com"; // Your email provider's SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = "sahadevthapawork@gmail.com"; // Your email address
    $mail->Password = "yyry vtil xiko nhaz"; // Use an App Password if you're using Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Enable HTML
    $mail->isHTML(true);
} catch (Exception $e) {
    echo "Mailer could not be initialized. Error: {$e->getMessage()}";
}
?>