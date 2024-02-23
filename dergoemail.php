<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $dbname = "contact_form_db";

    // Lidha db
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check se a osht lidh
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];


    $name = htmlspecialchars(trim($name));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
    $subject = htmlspecialchars(trim($subject));
    $message = htmlspecialchars(trim($message));

    // Mi qu tdhanat ndb
    if ($name && $email && $subject && $message) {
        $sql = "INSERT INTO contact_entries (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
            header("Location: aboutus.html");
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid form data. Please check your input.";
    }

    // Mbylla db
    $conn->close();
} else {
    // T kthen n aboutus
    header("Location: aboutus.html");
    exit();
}
?>
