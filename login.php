<?php
include "connection.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparation de la requête
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Vérification du mot de passe et de l'état de vérification
    if ($user && password_verify($password, $user['password']) && $user['is_verified'] == 1) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid credentials or unverified email !";
    }
}
echo'<br/>';
echo'<br/>';
echo'<br/>';
echo "Click here to <a href='login.html'>Login</a>";
?>
