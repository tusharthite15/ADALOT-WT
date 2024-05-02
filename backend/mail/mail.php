<?php
session_start();
require './config.php'; // Assuming config.php is in the same directory as this script
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $receiver_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $sender_name = $_POST['name'];
    $sender_phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Assign sender's email
    $sender_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Send welcome email and store details in the database
    sendWelcomeEmail($receiver_email, $sender_name, $sender_email, $sender_phone, $subject, $message);

    echo '<script>alert("Your response has been successfully submitted");</script>'; 
}


function sendWelcomeEmail($toEmail, $sender_name, $sender_email, $sender_phone, $message)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pixeldeveloper15@gmail.com';
        $mail->Password = 'shxrpjaqvufflgxt';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->addAddress($toEmail);
        $mail->addReplyTo($sender_email, $sender_name); // Reply-to address set to sender's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Thank you for contacting Adalot';
        $mail->Body = "<p>Dear,</p>
                      <p>Thank you for reaching out to us!</p>
                      <p>We have received your message and will get back to you as soon as possible.</p>
                      <p>Here are the details you provided:</p>
                      <ul>
                        <li><strong>Name:</strong> $sender_name</li>
                        <li><strong>Email:</strong> $sender_email</li>
                        <li><strong>Phone:</strong> $sender_phone</li>
                        <li><strong>Message:</strong> $message</li>
                      </ul>
                      <p>In the meantime, feel free to explore our website for more information about our services and solutions.</p>
                      <p>Thank you for considering Adalot. We look forward to assisting you!</p>";

        $mail->send();
        // Optionally, you can log or handle success
        echo 'Message has been sent';
    } catch (Exception $e) {
        // Log or handle errors
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
