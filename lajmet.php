<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulli i Faqes Tuaj</title>
    <style>
        body {
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh; 
        }

        header {
            background-color: white;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            box-sizing: border-box; 
        }

        .font {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: black;
            text-decoration: none;
            transition: 0.7s; 
        }

        .font:hover {
            font-size: 120%; 
        }

        .foto {
            width: 150px;
            height: 150px;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button {
            width: 40%;
            height: 40px;
            color: beige;
            background: white;
            font-size: 1em;
            font-weight: bold;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        .header img {
            width: 150px;
            height: 150px;
        }

        .session-timer {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            color: black;
        }

        .news-container {
            text-align: center;
            margin-top: 20px;
        }

        .news-article {
            max-width: 800px;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .news-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .news-content {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        .news-content img {
            max-width: 300px;
            margin-right: 20px;
        }

        .news-content p {
            font-size: 16px;
            color: #666;
        }

        footer {
            background: white;
            color: black;
            padding: 20px;
            width: 100%;
            text-align: center;
            margin-top: auto;
        }

        footer div {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
        }

        footer a {
            text-decoration: none;
            color: black;
            margin: 5px;
        }

        footer p {
            margin: 5px;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <button class="font"><a href="index.html" class="font">Faqja Kryesore!</a></button>
        <div class="logo-container">
            <a href="index.html"><img src="Foto e projektit/logo.png" alt="Weistec Engineering" class="foto"></a>
        </div>
        <span class="session-timer">Session Timer: <span id="session-timer">00:00</span></span>
        <button class="font"><a href="index.html" class="font">Log Out!</a></button>
    </header>
    <div class="news-container">
        <?php
        // Lidhja me db
        include_once 'lidhja_db.php';

        // Per me marr info nga databasa
        $sql = "SELECT id, titulli, mesazhi, foto FROM news_articles";
        $result = $conn->query($sql);

        // Kontrollon a ka lajme t disponueshme
        if ($result->num_rows > 0) {
            // Percaktohu per secilin rresht dhe shfaq lajme
            while ($row = $result->fetch_assoc()) {
                echo "<div class='news-article'>";
                echo "<h2 class='news-title'>" . $row['titulli'] . "</h2>";
                echo "<div class='news-content'>";
                // Shfaq mesazhin
                echo "<p>" . $row['mesazhi'] . "</p>";
                // Shfaq foton nëse ka
                if (!empty($row['foto'])) {
                    echo "<img src='" . $row['foto'] . "' alt='Foto e Lajmit'>";
                }
                echo "</div>"; 
                echo "</div>"; 
            }
        } else {
            
            echo "<p>Asnje lajm i disponueshem</p>";
        }

        // Kryhet lidhja me db
        $conn->close();
        ?>
    </div>

    <footer>
        <div>
            <div>
                <a href="index.html">Faqja Kryesore</a><br>
                <a href="car-review.html">German Trinity</a><br>
                <a href="log-in.html">Log Out</a>
            </div>
            <p>Faleminderit për vizitën</p>
            <p>&copy; 2023 Weistec Engineering. All rights reserved</p>
        </div>
    </footer>

    <script>
        // Kalkulimi i sessionit
        let timerSeconds = 0;
        let sessionTimer = setInterval(() => {
            timerSeconds++;
            const minutes = Math.floor(timerSeconds / 60);
            const seconds = timerSeconds % 60;
            document.getElementById('session-timer').innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);
    </script>
</body>

</html>
