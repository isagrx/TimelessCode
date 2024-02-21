<?php
session_start(); // Fillimi sessionit

// A eshte mbushur forma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // A eshte email dhe paswordi i shkruar
    if (!empty($_POST["email"]) && !empty($_POST["pswd"])) {
        // Merr infot 
        $email = trim($_POST["email"]);
        $password = trim($_POST["pswd"]);
        
        $servername = "localhost"; 
        $username = "root"; 
        $db_password = "";
        $database = "users";

        // Lidhja me databaz
        $conn = new mysqli($servername, $username, $db_password, $database);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        } else {

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
            $stmt->bind_param("ss", $email, $password);

            $stmt->execute();
            $result = $stmt->get_result();

            // A egziston useri
            if ($result->num_rows == 1) {
                // Merr daten(data) e userit
                $row = $result->fetch_assoc();
                // Verifikim i passit
                if ($password == $row['password']) {
                    // A eshte admin useri
                    if ($row['UserType'] == 1) {
                        // Ndrro variablen e sessionit per ta konfirmuar qe eshte kyqur
                        $_SESSION["loggedin"] = true;
                        // Ktheje adminin n dashboard
                        header("Location: admin_dashboard.php");
                        exit;
                    } else {
                    header("Location: lajmet.php");
                    }
                } else {
                    echo "Invalid email or password. Please try again.";
                }
            } else {
                echo "Invalid email or password. Please try again.";
            }

            // Mbyll deklaraten dhe lidhjen
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "Please provide both email and password.";
    }
} else {
        echo "Form not submitted.";
}
?>
