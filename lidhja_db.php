<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "users"; 

// Krijo lidhjen
$conn = new mysqli($servername, $username, $password, $database);

// Verifikimi lidhjes
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
