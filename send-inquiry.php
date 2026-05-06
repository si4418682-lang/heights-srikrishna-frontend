<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name      = trim($_POST['name'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $unit_type = trim($_POST['unit_type'] ?? '');
    $message   = trim($_POST['message'] ?? '');

    if ($name === '' || $phone === '') {
        die("Name and Phone are required.");
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // 🔴 YOUR GMAIL HERE
        $mail->Username   = 'saidulislamshaan@gmail.com';
        $mail->Password   = 'hufs kroq qcrx tkvc';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // EMAIL DETAILS
        $mail->setFrom('saidulislamshaan@gmail.com', 'Krishna Heights');
        $mail->addAddress('saidulislamshaan@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'New Inquiry - Krishna Heights';

        $mail->Body = "
        <h3>New Inquiry Received</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Unit Type:</strong> $unit_type</p>
        <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();

        echo "Inquiry sent successfully.";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
