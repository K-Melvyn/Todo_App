<?php
include 'connection.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les tâches
$todos = [];
$stmt = $conn->prepare("SELECT * FROM todos WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $todos[] = $row;
}
?>

<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TO DO</title>

    <style>
      .logo{
        font-size: 40px;
       color: rgb(236, 154, 0);
       font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      }
      .butt{
        background-color: rgb(236, 154, 0);
        height: 30px;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin: 10px;
        padding: 5px 2px 5px 2px;
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
    <h2 class="logo">ToDo </h2>

    <h3>Add a ToDo</h3>

<form action="add.php" method="POST">

    <input class type="text" name="title" required placeholder="Enter a new task">

    <button class="butt" type="submit">Add</button>

</form>

    <ul>
        <?php foreach ($todos as $todo): ?>
            <li>
                <?= htmlspecialchars($todo['title']) ?> - <?= $todo['status'] ?>
               <button class="butt" > <a  href="update.php?id=<?= $todo['id'] ?>">Modify</a> </button>
               <button class="butt" > <a  href="delete.php?id=<?= $todo['id'] ?>">Delete</a> </button>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>