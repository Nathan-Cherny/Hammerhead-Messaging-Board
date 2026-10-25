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
        }

        /* body {
            background-image: url(shark.png);
            background-size: 250px 250px;
            background-repeat: repeat;
            background-color: rgb(0, 0, 255);
        } */

        /* da main title */

        .main-title {
            width: 100%;
            text-align: center;
            color: white;
        }

        .main-stuff {
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
            background: -webkit-linear-gradient(0deg, #9ff, #39f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        hr {
            width: 100%;
            margin: 50px auto;
            border: 1px solid white;
        }

        /* da messages */

        .forum {
            background-color: white;
            padding: 5px;
        }

        .message {
            background-image: linear-gradient(to bottom, rgba(255, 0, 0, 0.75), rgba(255, 255, 0, 0.75));
            border: 5px solid black;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            justify-content: space-around;
            text-align: center;
        }

        .message-label {
            background-image: none !important;
            background-color: green !important;
        }

        .message-label * {
            font-size: 250% !important;
        }

        .message * {
            flex: 1;
            border: 1px solid black;
            display: flex;
            margin: 0;
            align-items: center;
            justify-content: center;
        }

        .message .title {
            font-size: 32px;
        }

        .message .msg {
            font-size: 18px
        }

        .message .author {
            font-size: 18px
        }

        .message .created_at {
            font-size: 18px
        }
    </style>
</head>

<body>

    <div class="main-title">
        <div class="main-stuff">
            <div class="tenor-gif-embed gif" data-postid="24834746" data-share-method="host" data-aspect-ratio="1.09215" data-width="100%"><a href="https://tenor.com/view/the-el-hammerhead-shark-shark-gif-24834746">The El Hammerhead Shark GIF</a>from <a href="https://tenor.com/search/the+el-gifs">The El GIFs</a></div>
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <h1>Hammerhead Shark Messaging Forum!!</h1>
            <div class="tenor-gif-embed gif" data-postid="5148062" data-share-method="host" data-aspect-ratio="1" data-width="100%"><a href="https://tenor.com/view/shark-funny-computer-gif-5148062">Shark Funny GIF</a>from <a href="https://tenor.com/search/shark-gifs">Shark GIFs</a></div>
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
        </div>
        <p>Talk about stuff here</p>
        <button>Write a message!</button>
    </div>

    <hr />

    <div class="forum">
        <div class="message message-label">
            <h1 class="title">Title</h1>
            <p class="msg">Message</p>
            <p class="author">Author</p>
            <p class="created_at">Created At</p>
        </div>
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
            foreach ($db->query($query) as $row) {
                echo '<div class="message">
                <h1 class="title">' . $row[1] . '</h1>
                <p class="msg">' . mb_strimwidth($row[2], 0, 20, "click to see full msg") . '</p>
                <p class="author">' . $row[3] . '</p>
                <p class="created_at">' . $row[4] . '</p>

            </div>
            ';
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </div>

</body>

</html>