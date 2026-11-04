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
            cursor: pointer;
            text-align: center;
        }

        .message-label {
            background-image: none !important;
            background-color: green !important;
            cursor: auto;
        }

        .message-label * {
            font-size: 125% !important;
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

        /* da replies */

        .reply {
            display: none;
            background-color: gray;
            background-image: none;
            cursor: auto;
            background-color: gray;
        }

        /* da about */
        .about {
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            width: 50%;
            margin: 15px auto;
            justify-content: center;
            flex-direction: column;
        }
    </style>

    <script>
        function toggleReplies(message) {
            const id = parseInt(message.id)
            let replies = document.getElementsByName("reply" + id)
            message.classList.toggle("replyShowing")

            const repliesShowing = message.classList.contains("replyShowing")
            for (let replyMessage of replies) {
                replyMessage.style.display = (repliesShowing) ? "flex" : "none"
            }

        }

        function figureOutReplies() {
            let allNotReplies = document.querySelectorAll('.message:not(.reply):not(.message-label)');
            allNotReplies = [...allNotReplies]
            for (let message of allNotReplies) {
                let replies = document.getElementsByName("reply" + message.id)
                if (replies.length > 0) {
                    let firstReply = replies[replies.length - 1]
                    for (let replyMessage of [...replies].reverse()) {
                        message.before(replyMessage)
                    }
                    firstReply.before(message)
                }

                document.getElementById("nreplies" + message.id).innerHTML = `${replies.length} Replies
                ${(replies.length > 4) ? "... wow, you're popular!" : ""}`
            }

            // onload stuff

            let allReplyingTo = document.getElementsByClassName("replyingTo")
            for (let whatId of allReplyingTo) {
                let whatReplyingTo = document.getElementById(whatId.innerHTML)
                let titleOfWhatReplyingTo = whatReplyingTo.firstElementChild.innerHTML
                whatId.innerHTML = `Replying To '${titleOfWhatReplyingTo}'`
            }

            var youare = localStorage.getItem("username")
            document.getElementById("youare").innerHTML = (youare) ?
                `Signed in as '${localStorage.getItem("username")}' <a href="/signup.php">See sign up page</a>` :
                "<a href='/signup.php'>You aren't signed in! You can do that by clicking here!!!</a>"
            document.getElementsByName("author")[0].value = youare ?? "Guest"

            var allAuthors = document.getElementsByClassName("author")
            for (let author of allAuthors) {
                if (author.innerHTML != "Guest") {
                    author.style.fontWeight = "bold"
                } else {
                    author.style.color = "#444"
                }
            }
        }
    </script>
</head>

<body onload="figureOutReplies()">

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

        <div class="about">
            <p>Talk about stuff here</p>
            <a href="/links.php">What is Hammerhead Records?</a>
            <p id="youare"></p>
        </div>

        <form class="message-input" action="index.php" method="POST">
            <h3 style="color: black">Write a message!</h3>
            <input name="title" type="text" placeholder="title" />
            <input style="display:none" name="author" type="text" />
            <textarea name="msg" placeholder="whatcha gonna say to da world??"></textarea>
            <select name="parent_id" placeholder="whatcha gonna say to da world??">
                <option style="color: lightgray" value="null">Who are ya replyin' to?? (leave it as this if ur not replying to anyone :p)</option>
                <?php
                $query = "SELECT * FROM messages WHERE parent_id='null'";
                $rows = $db->query($query)->fetchAll();
                foreach (array_reverse($rows) as $row) {
                    echo '<option value=' . $row[0] . '>"' . $row[1] . '"' . " by " . $row[3] . ' </option>';
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
            <p class="replies">Replies / Replying To</p>
            <p class="created_at">Created At</p>
        </div>
        <?php
        try {
            $query = "SELECT * FROM messages";
            $rows = $db->query($query)->fetchAll();
            foreach (array_reverse($rows) as $row) {

                if ($row[4] != "null") {
                    echo '<div class="message reply" name="reply' . $row[4] . '">
                    <h1 class="title" title="id: ' . $row[0] . ' parent_id: ' . $row[4] . '">' . $row[1] . '</h1>
                    <p class="msg"' . 'title=\'' . $row[2] . '\'>' . mb_strimwidth($row[2], 0, 150, "hover over to see full msg") . '</p>
                    <p class="author">' . $row[3] . '</p>
                    <p class="replyingTo">' . $row[4] . '</p>
                    <p class="created_at">' . $row[5] . '</p>
                </div>
                ';
                } else {
                    echo '<div class="message"  onclick="toggleReplies(this)" id="' . $row[0] . '">
                    <h1 class="title" title="id: ' . $row[0] . ' parent_id: ' . $row[4] . '">' . $row[1] . '</h1>
                    <p class="msg"' . 'title=\'' . $row[2] . '\'>' . mb_strimwidth($row[2], 0, 150, "hover over to see full msg") . '</p>
                    <p class="author">' . $row[3] . '</p>
                    <p class="numreplies" id="nreplies' . $row[0] . '"></p>
                    <p class="created_at">' . $row[5] . '</p>
                </div>
                ';
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </div>

</body>

</html>