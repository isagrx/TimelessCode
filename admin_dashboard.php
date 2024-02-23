<!DOCTYPE html>

<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paneli i Administrimit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: auto;
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        form {
            background-color: #fff;
            color: #000; 
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px; 
            margin: 20px auto; /
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <form action="shto_lajmin.php" method="post" enctype="multipart/form-data">
            <h2>Shto Lajm</h2>
            <label for="titulli">Titulli:</label>
            <input type="text" id="titulli" name="titulli" required>
            
            <label for="mesazhi">Mesazhi:</label>
            <textarea id="mesazhi" name="mesazhi" rows="4" required></textarea>
            
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">
            
            <button type="submit">Shto Lajmin</button>
        </form>

        <form action="perditeso_lajmin.php" method="post" enctype="multipart/form-data">
            <h2>Përditëso Lajmin</h2>
            <label for="id_lajmit">Zgjidh Lajmin:</label>
            <select id="id_lajmit" name="id_lajmit">
                <?php
                include_once 'lidhja_db.php';
                $sql = "SELECT id, titulli FROM news_articles";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['titulli'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nuk ka lajme për të përditësuar</option>";
                }
                ?>
            </select>
            
            <label for="titulli_i_ri">Titulli i Ri:</label>
            <input type="text" id="titulli_i_ri" name="titulli_i_ri">
            
            <label for="mesazhi_i_ri">Mesazhi i Ri:</label>
            <textarea id="mesazhi_i_ri" name="mesazhi_i_ri" rows="4"></textarea>
            
            <label for="foto_e_re">Foto e Re:</label>
            <input type="file" id="foto_e_re" name="foto_e_re">
            
            <button type="submit">Përditëso Lajmin</button>
        </form>

        <form action="fshi_lajmin.php" method="post">
            <h2>Fshi Lajmin</h2>
            <label for="id_lajmit_per_te_fshire">Zgjidh Lajmin për të Fshire:</label>
            <select id="id_lajmit_per_te_fshire" name="id">
                <?php
                include_once 'lidhja_db.php';
                $sql = "SELECT id, titulli FROM news_articles";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['titulli'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nuk ka lajme për të fshirë</option>";
                }
                ?>
            </select>
            
            <button type="submit">Fshi Lajmin</button>
        </form>

    </div>
</body>
</html>
