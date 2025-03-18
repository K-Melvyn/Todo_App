<?php 
//connection to database
$host= "dpg-cvcbrnhu0jms73eq2g60-a";
$database ='todo_app_0im1';
$user = 'root';
$pass = 'cleGgu5aAPm47R83Szr8yLYN5Vw2pZGm';

$conn = new mysqli($host, $user, $pass, $database);
if($conn->connect_error){
    die('Could not connect to DB Server on $host' .  $conn->connect_error);
}
    else{
        echo 'Connected to the database';
    }
    

?>