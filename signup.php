<?php
session_start(); // Fillimi sessionit

$servername = "localhost";
$username = "root";
$password = "";
$database = "users"; 

    //Krijo lidhje

$conn = new mysqli($servername, $username, $password, $database);

// Verifiko lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// A eshte dorzuar forma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // A jane dhene te githa format e kerkuara
    if (!empty($_POST["txt"]) && !empty($_POST["email"]) && !empty($_POST["pswd"])) {
        // Merr daten
        $username = $_POST['txt']; // txt osht field per username
        $email = $_POST['email'];
        $password = $_POST['pswd'];


        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

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

$conn->close();
?>
