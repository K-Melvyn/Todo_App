<?php
include "connection.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM todos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error.";
    }
}
?>

