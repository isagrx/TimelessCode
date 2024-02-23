<?php
include_once 'lidhja_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["titulli"]) && !empty($_POST["mesazhi"])) {
        $titulli = $_POST['titulli'];
        $mesazhi = $_POST['mesazhi'];
        $folder = "fotot/";
        $foto = $folder . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
        $sql = "INSERT INTO news_articles (titulli, mesazhi, foto) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $titulli, $mesazhi, $foto);
        if ($stmt->execute()) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Gabim: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Të gjitha fushat janë të detyrueshme.";
    }
}
$conn->close();
?>
