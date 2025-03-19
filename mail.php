<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendVerificationEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Correct SMTP server for Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tmelvyn32@gmail.com'; // Your Gmail
        $mail->Password   = 'jsge mams xyzz quma'; // Your Gmail App Password (NOT your real password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('tmelvyn32@gmail.com', 'ToDo App');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email';
        $mail->Body    = "Your OTP is: <b>$otp</b>";

        $mail->send(); // Send email

        echo "Email sent successfully!";
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }
}

?>
