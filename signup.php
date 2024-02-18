<?php
session_start(); // Start session to manage user login state

// Database connection parameters
$servername = "localhost"; // Update with your database server address
$username = "root"; // Update with your database username
$password = ""; // Update with your database password (if any)
$database = "users"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are provided
    if (!empty($_POST["txt"]) && !empty($_POST["email"]) && !empty($_POST["pswd"])) {
        // Retrieve form data
        $username = $_POST['txt']; // Assuming 'txt' corresponds to 'username'
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        // Prepare SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registered successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

// Close connection
$conn->close();
?>
