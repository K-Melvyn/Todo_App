<?php
include "connection.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Récupérer la tâche
$sql = "SELECT title, status FROM todos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $status);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modify</title>
</head>
<body>
    <h2>Modify</h2>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>
        <select name="status">
            <option value="in progress" <?= $status == "in progress" ? "selected" : "" ?>></option>
            <option value="Done" <?= $status == "Done" ? "selected" : "" ?>>Done</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
