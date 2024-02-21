<?php
// Database connection parameters
$servername = "127.0.0.1"; // Your database server address
$username = "root"; // Your database username
$password = ""; // Your database password (if any)
$database = "users"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}

// Close connection
$conn->close();
?>
