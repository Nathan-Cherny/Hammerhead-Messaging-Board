<!-- da form submission -->
<?php
try {
    $db = new PDO('sqlite:my_database.db');

    $sql = 'CREATE TABLE IF NOT EXISTS users(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            password TEXT NOT NULL
        )';

    $db->exec($sql);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $db = new PDO('sqlite:my_database.db');

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':username' => $username,
        ':password' => $password
    ]);

    echo "<script>";
    echo "localStorage.setItem('username', " . json_encode($username) . ");";
    echo "</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hammerhead Records Messaging Board</title>

    <style>
        /* da main, stuff */

        html {
            background-color: rgb(0, 0, 255);
            background-image: url(shark.png);
            background-size: 250px 250px;
            background-repeat: repeat;
        }

        * {
            font-family: 'Comic Sans MS';
        }

        body {
            background-color: rgba(0, 0, 255, 0.75);
            margin: 0;
            overflow-x: hidden;
            padding-bottom: 100px;
        }

        /* da main title */

        .main-title {
            padding-top: 10px;
            width: 100%;
            text-align: center;
            color: white;
        }

        .main-stuff {
            background: linear-gradient(90deg, rgb(30, 57, 77), rgb(20, 60, 100));
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly;
            border: 1px solid white;
        }

        .main-stuff .gif {
            max-height: 75px;
            max-width: 100px;
        }

        .main-stuff h1 {
            background: -webkit-linear-gradient(90deg, #9ff, #06d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        hr {
            width: 100%;
            margin: 50px auto;
            border: 1px solid white;
        }

        /* da form */
        .form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-direction: column;
            background: rgba(0, 255, 255, 0.75);
            padding: 10px;
        }
    </style>
</head>

<body>
    <form action="signup.php" method="POST" class="form">
        <h3 style="color: black">Sign up to Hammer head records!!</h3>
        <a href="/">Back to main page</a>
        <input type="text" placeholder="username" name="username" />
        <input type="password" placeholder="password" name="password" />
        <input type="submit" value="Submit" />
    </form>
    <hr />
    <h2>Join these great group of people!</h2>
    <?php
    try {
        $query = "SELECT * from users";
        $rows = $db->query($query)->fetchAll();
        foreach (array_reverse($rows) as $row) {
            echo "<h3>" . $row[1] . "</h3>";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    } ?>
</body>

</html>