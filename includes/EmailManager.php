<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require_once 'includes/src/PHPMailer.php';
require_once 'includes/src/SMTP.php';
require_once 'includes/src/Exception.php';

class EmailManager {
    public static function sendEmail($to, $subject, $message) {
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ardona@gmail.com'; // Replace with your Gmail address
            $mail->Password = '12345678';   // Replace with your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email settings
            $mail->setFrom('ardona@gmail.com', 'A-Tech'); // Must match $mail->Username
            $mail->addAddress($to); // Recipient email address

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send the email
            $mail->send();
            return "Email sent successfully to $to.";
        } catch (Exception $e) {
            // Log the error and return a failure message
            error_log("Email error: {$mail->ErrorInfo}", 3, 'logs/email_errors.log');
            return "Failed to send email. Error: {$mail->ErrorInfo}";
        }
    }
}
?>