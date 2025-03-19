<?php
ob_start(); // ✅ Mettre tout en haut

include "connection.php";
include "mail.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999); // Génère l'OTP

    $sql = "INSERT INTO users (email, password, otp_code) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $email, $password, $otp);

    if ($stmt->execute()) {
        // ✅ Envoie l'email de vérification
        sendVerificationEmail($email, $otp);

        // ✅ Redirection vers verify.php
        header("Location: verify.php?email=$email");
        exit();
    } else {
        echo "Error.";
    }
}
if (sendVerificationEmail($email, $otp)) {
    echo "Email envoyé avec OTP : " . $otp; // 🛠 Debug
} else {
    echo "Couldn't send OTP.";
}


// Ce message ne s'affichera que si l'inscription échoue
echo "Click here to <a href='index.php'>Login</a>";

ob_end_flush(); // ✅ Fin du buffer
?>
