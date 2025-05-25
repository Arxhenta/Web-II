<?php
session_start(); // Start the session
require_once 'includes/EmailManager.php';

// Check if the email is stored in the session
if (isset($_SESSION['user_email'])) {
    $to = $_SESSION['user_email']; // Get the email from the session
    $subject = "Welcome to A-Tech!";
    $message = "<h1>Thank you for registering on our platform!</h1><p>We are excited to have you.</p>";

    echo EmailManager::sendEmail($to, $subject, $message);
} else {
    echo "No email address found in the session.";
}
?>