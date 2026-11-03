<!-- da form submission -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $msg = htmlspecialchars($_POST['msg']);
    $author = htmlspecialchars($_POST['author']);
    $parent_id = htmlspecialchars($_POST["parent_id"]);

    $db = new PDO('sqlite:my_database.db');

    $sql = "INSERT INTO messages (title, msg, author, parent_id) VALUES (:title, :msg, :author, :parent_id)";
    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':title' => $title,
        ':msg' => $msg,
        ':author' => $author,
        ':parent_id' => $parent_id
    ]);
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
            overflow-x: hidden
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

        /* da message input */

        .message-input {
            display: flex;
            flex-direction: column;
            border: 5px solid purple;
            margin: 50px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: linear-gradient(100deg, orange, red);
        }

        .message-input * {
            margin: 5px 20px;
        }

        .message-input textarea {
            color: black;
            resize: vertical;
            min-height: 40px;
            box-sizing: border-box;
            padding: 8px;
        }


        /* da messages */

        .forum {
            padding: 5px 25px;

        }

        .message {
            background-image: linear-gradient(to bottom, rgba(255, 0, 0, 0.75), rgba(255, 255, 0, 0.75));
            background-color: rgba(0, 0, 0, 0);
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
            font-size: 15px;
            padding: 10px 0px;
            justify-content: center;
            max-width: 25%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>

    <?php
    try {
        $db = new PDO('sqlite:my_database.db');

        $sql = 'CREATE TABLE IF NOT EXISTS messages(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            msg TEXT NOT NULL,
            author TEXT,
            parent_id INTEGER DEFAULT null,
            created_at TEXT DEFAULT current_timestamp,
            FOREIGN KEY (parent_id) REFERENCES messages (id) ON DELETE CASCADE
        )';

        $db->exec($sql);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

    <div class="main-title">
        <div class="main-stuff">
            <div class="tenor-gif-embed gif" data-postid="24834746" data-share-method="host" data-aspect-ratio="1.09215" data-width="100%"><a href="https://tenor.com/view/the-el-hammerhead-shark-shark-gif-24834746">The El Hammerhead Shark GIF</a>from <a href="https://tenor.com/search/the+el-gifs">The El GIFs</a></div>
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <h1>Hammerhead Records Messaging Forum!!</h1>
            <div class="tenor-gif-embed gif" data-postid="5148062" data-share-method="host" data-aspect-ratio="1" data-width="100%"><a href="https://tenor.com/view/shark-funny-computer-gif-5148062">Shark Funny GIF</a>from <a href="https://tenor.com/search/shark-gifs">Shark GIFs</a></div>
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
        </div>
        <p>Talk about stuff here</p>

        <form class="message-input" action="index.php" method="POST">
            <h3 style="color: black">Write a message!</h3>
            <input name="title" type="text" placeholder="title" />
            <input name="author" type="text" placeholder="who are you?" />
            <textarea name="msg" placeholder="whatcha gonna say to da world??"></textarea>
            <select name="parent_id" placeholder="whatcha gonna say to da world??">
                <option style="color: lightgray" value="null">Who are ya replyin' to?? (leave it as this if ur not replying to anyone :p)</option>
                <?php
                $query = "SELECT * FROM messages";
                $rows = $db->query($query)->fetchAll();
                foreach (array_reverse($rows) as $row) {
                    echo '<option value='. $row[0] . '>"' . $row[1] . '"' . " by " . $row[2] . ' </option>';
                }
                ?>
            </select>
            <input type="submit" value="Submit!!" />
        </form>
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
            $query = "SELECT * FROM messages";
            $rows = $db->query($query)->fetchAll();
            foreach (array_reverse($rows) as $row) {
                echo '<div class="message">
                <h1 class="title" title="ID: ' . $row[0] . ' PID: ' . $row[4] .'">' . $row[1] . '</h1>
                <p class="msg"' . 'title=\'' . $row[2] . '\'>' . mb_strimwidth($row[2], 0, 150, "hover over to see full msg") . '</p>
                <p class="author">' . $row[3] . '</p>
                <p class="created_at">' . $row[5] . '</p>
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