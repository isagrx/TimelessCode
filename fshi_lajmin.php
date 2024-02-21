<?php
include_once 'lidhja_db.php'; 

// Check se a o perdor metoda post edhe a u zgjedh 1 artikull mu fshi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Id e artikullit mu fshi
    $id = $_POST["id"];

    // Sql per me fshi prej tabeles
    $sql = "DELETE FROM news_articles WHERE id=?";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    // Egzekutimi i sql
    if ($stmt->execute()) {
        // Mbyllja e deklarates
        $stmt->close();

        // T kthen n dashboard
        header("Location: admin_dashboard.php");
        exit(); // Mu siguru qe scripti ndalet pas kthimit
    } else {
        echo "Gabim: " . $conn->error;
    }
} else {
    echo "Nuk është zgjedhur asnjë lajm për fshirje.";
}

// Mbyllja lidhjes me db
$conn->close();
?>
