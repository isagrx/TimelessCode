<?php
include_once 'lidhja_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_lajmit"])) {
    $id = $_POST["id_lajmit"];
    if (!empty($_POST["titulli_i_ri"]) && !empty($_POST["mesazhi_i_ri"])) {
        $titulli_i_ri = $_POST['titulli_i_ri'];
        $mesazhi_i_ri = $_POST['mesazhi_i_ri'];
        if ($_FILES["foto_e_re"]["size"] > 0) {
            $folder = "fotot/";
            $foto_e_re = $folder . basename($_FILES["foto_e_re"]["name"]);
            move_uploaded_file($_FILES["foto_e_re"]["tmp_name"], $foto_e_re);
            $sql = "UPDATE news_articles SET titulli=?, mesazhi=?, foto=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $titulli_i_ri, $mesazhi_i_ri, $foto_e_re, $id);
        } else {
            $sql = "UPDATE news_articles SET titulli=?, mesazhi=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $titulli_i_ri, $mesazhi_i_ri, $id);
        }
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
} else {
    echo "Nuk është zgjedhur asnjë lajm për të përditësuar.";
}

$conn->close();
?>
