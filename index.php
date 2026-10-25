<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hammerhead Records Messaging Board</title>

    <style>
        .message{
            border: 5px solid black;
        }

        .message .title{
            font-size: 32px;
        }

        .message .msg{
            font-size: 18px
        }

        .message .author{
            font-size: 18px
        }
        
        .message .author{
            font-size: 18px
        }
    </style>
</head>

<body>

    <h1>My Tasks</h1>

    <?php
    try {
        $db = new PDO('sqlite:my_database.db');

        $sql = 'CREATE TABLE IF NOT EXISTS messages(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            msg TEXT NOT NULL,
            author TEXT,
            created_at TEXT DEFAULT current_timestamp
        )';

        $db->exec($sql);

        $sql = "INSERT INTO messages (title, msg, author) VALUES (:title, :msg, :author)";
        $stmt = $db->prepare($sql);

        $title = 'Hey';
        $msg = 'woah';
        $author = "me";

        $stmt->execute([
            ':title' => $title,
            ':msg' => $msg,
            ':author' => $author
        ]);

        $query = "SELECT * FROM messages";
        foreach($db->query($query) as $row){
            echo '<div class="message">
                <h1>' . $row[1] . '</h1>
                <p>' . $row[2] . '</p>
                <p>' . $row[3] . '</p>
                <p>' . $row[4] . '</p>

            </div>
            ';
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

</body>

</html>