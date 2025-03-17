<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function  sendVerificationEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@example.com'; // Your SMTP username
        $mail->Password   = 'your_email_password'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('your_email@example.com', 'ToDo App');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email';
        $mail->Body    = "Your OTP is: <b>$otp</b>";

        $mail->send();

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Email send succesfully !";
        }
        

        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
