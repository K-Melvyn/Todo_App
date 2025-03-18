<?php 
// Infos de connexion
$host = "sql8.freesqldatabase.com";
$database = "sql8768241";
$user = "sql8768241";
$pass = "";

// Active le mode rapport d'erreur pour voir les erreurs
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failure : " . $conn->connect_error);
} else {
    echo "Connected to the data base !";
}
?>
