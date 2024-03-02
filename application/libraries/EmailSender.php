<?php
// Include PHPMailer autoload.php file
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender {
    private $mail;

    public function __construct() {
        // Create a new PHPMailer instance
        $this->mail = new PHPMailer(true); // Passing true enables exceptions
        
        // Set up the SMTP configuration
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.example.com'; // Your SMTP host
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'your_username'; // Your SMTP username
        $this->mail->Password = 'your_password'; // Your SMTP password
        $this->mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $this->mail->Port = 587; // TCP port to connect to
    }

    public function sendEmail($recipient, $subject, $body) {
        try {
            // Set up the email content
            $this->mail->setFrom('from@example.com', 'Your Name');
            $this->mail->addAddress($recipient);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            // Send the email
            $this->mail->send();
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

}

$emailSender = new EmailSender();


?>
