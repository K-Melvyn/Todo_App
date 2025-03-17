<?php 
//connection to database
$host= "localhost";
$database ='todo_app';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $database);
if($conn->connect_error){
    die('Could not connect to DB Server on $host' .  $conn->connect_error);
}
    else{
        echo 'Connected to the database';
    }
    

?>