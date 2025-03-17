<?php
include "connection.php";

include "mail.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999); // Define OTP here

    $sql = "INSERT INTO users ( email, password, otp_code) VALUES ( ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $email, $password, $otp);

    if ($stmt->execute()) {
        // ✅ Send OTP Email
        sendVerificationEmail($email, $otp);

        // ✅ Redirect to verification page
        header("Location: verify.php?email=$email");
        exit();
    } else {
        echo "Erreur d'inscription.";
    }
}
     echo "Click here to <a href='login.php'>Login</a>";
?>

