<?php

require __DIR__ . "/vendor/autoload.php"; // Ensure Composer autoloader is included

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get email from POST data
$email = $_POST["email"];

// Generate a unique token
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);

// Token expiration time (30 minutes)
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

// Connect to the database
$mysqli = require __DIR__ . "/database.php";

// Update the database with the reset token and expiry
$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

// Check if the email exists and a row was updated
if ($mysqli->affected_rows) {
    // Configure PHPMailer instance
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

        // Email content
        $mail->setFrom("sahadevthapawork@gmail.com", "TADMIN_PANEL");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->isHTML(true);
        $mail->Body = <<<END
            <p>Click <a href="http://localhost/ADMIN_PANEL/backend/reset-password.php?token=$token">here</a> 
            to reset your password. This link will expire in 30 minutes.</p>
        END;

        $mail->AltBody = "Click this link to reset your password: http://localhost/ADMIN_PANEL/backend/reset-password.php?token=$token";

        // Send email
        $mail->send();
        echo "Message sent, please check your inbox.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
} else {
    echo "No user found with that email address.";
}
?>

