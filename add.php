<?php
include "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];

    $sql = "INSERT INTO todos (user_id, title, status) VALUES (?, ?, 'in progress')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $title);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error .";
    }
}
?>

