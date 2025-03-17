<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = $_POST["otp"];

    // 1️⃣ Vérifier l'OTP
    $sql = "SELECT otp_code FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($otp_code);
    $stmt->fetch();
    $stmt->close(); 

    if ($otp_code == $otp) {
        // 2️⃣ Mettre à jour la vérification de l'utilisateur
        $sql = "UPDATE users SET is_verified = 1 WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();

        echo "✅ Compte vérifié avec succès !";
        header("Location: login.php");
        exit(); 
    } else {
        echo "❌ OTP incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> OTP Verification</title>

    <style>
      .logo{
        font-size: 40px;
       color: rgb(236, 154, 0);
       font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      }
      .butt{
        background-color: rgb(236, 154, 0);
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
      }
      .container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 100px;
      }

    </style>

</head>

<body>
    <div class="container">

    <h2 class="logo">ToDo</h2>

    <h2>Email Verification</h2>
    
    <form method="POST">
        <input type="hidden" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>">
        <label>Entrez OTP :</label>
        <input type="text" name="otp" required>
        <button class="butt" type="submit">Verify</button>
    </form>
    </div>
</body>
</html>
