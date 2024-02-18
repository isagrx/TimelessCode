<?php
session_start(); // Start session to manage user login state

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are provided
    if (!empty($_POST["emaill"]) && !empty($_POST["pswdd"])) {
        // Retrieve form data
        $email = $_POST["emaill"];
        $password = $_POST["pswdd"];

        // Database connection parameters
        $servername = "localhost"; // Your database server address
        $username = "root"; // Your database username
        $password = ""; // Your database password (if any)
        $database = "users"; // Your database name

        // Database connection
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        } else {
            // Prepare SQL statement for retrieval
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
            $stmt->bind_param("ss", $email, $password);
            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();
            // Check if user exists
            if ($result->num_rows == 1) {
                // Set session variable to indicate user is logged in
                $_SESSION["loggedin"] = true;
                // Redirect user to the news page or wherever you want
                header("Location: news.php");
                exit;
            } else {
                echo "Invalid email or password. Please try again.";
            }
            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "Please provide both email and password.";
    }
}
?>
