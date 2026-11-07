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
    
    <script>
        function givePeoplesInteractivity (){
            const peeps = document.getElementsByClassName("peep")
            for(let peep of peeps){
                peep.addEventListener("click", () => {
                    getPeoplesMessage(peep.innerHTML)
                })
            }
        }

        function getPeoplesMessage(peep){
            let messagesbox = document.getElementById("messages-box")

            fetch(`getpeepsmessages.php?name=${peep}`, {
                method: "GET",
            }).then(response => response.json())
            .then(data => {
                console.log(data)
                messagesbox.innerHTML = ""
                for(let message of data){
                    let div = document.createElement("div")
                    div.classList.add("message")

                    let messagetitle = document.createElement("h3")
                    let messagemsg = document.createElement("p")
                    let createdat = document.createElement("p")
                    
                    messagetitle.innerHTML = message["title"]
                    messagemsg.innerHTML = message["msg"]
                    createdat.innerHTML = message["created_at"]

                    div.append(messagetitle)
                    div.append(messagemsg)
                    div.append(createdat)

                    messagesbox.append(div)
                }
            })
        }
    </script>

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
            background: linear-gradient(90deg, rgba(0, 255, 255, 0.75), rgba(125, 255, 125, 0.75), rgba(255, 255, 0, 0.75));
            padding: 10px;
        }

        /* da list of people */

        .peoples-container {
            background-color: rgba(255, 255, 255, 0.5);
            text-align: center;
            padding: 10px 20px;
        }

        .peoples-container * {
            text-align: center;
        }

        .peoples-container h2 {
            border-bottom: 1px solid black;
            width: 50%;
            margin: auto;
        }

        .peoples-list {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .peoples-list * {
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }

        .peoples-list-and-messages-imnotgoodatnaming {
            margin-top: 15px;
            display: flex;
            justify-content: space-around;
        }

        .messages-box {
            flex: 0 0 33.33%;
            min-height: 200px;
            max-height: 500px;
            overflow-y: scroll;
            border: 1px solid black;
        }

        /* da messages */
        .message {
            background-image: linear-gradient(to bottom, rgba(255, 0, 0, 0.75), rgba(255, 255, 0, 0.75));
            background-color: rgba(0, 0, 0, 0);
            border: 5px solid black;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            justify-content: space-around;
            cursor: pointer;
            align-items: center;
            text-align: center;
        }

        .message-label {
            background-image: none !important;
            background-color: green !important;
            cursor: auto;
        }

    </style>
</head>

<body onload="givePeoplesInteractivity()">
    <form action="signup.php" method="POST" class="form">
        <h3 style="color: black">Sign up to Hammer head records!!</h3>
        <a href="/">Back to main page</a>
        <input type="text" placeholder="username" name="username" />
        <input type="password" placeholder="password" name="password" />
        <input type="submit" value="Submit" />
    </form>
    <hr />
    <div class="peoples-container">
        <h2>Join these great group of people!</h2>
        <div class="peoples-list-and-messages-imnotgoodatnaming">
            <div class="peoples-list">
                <?php
                try {
                    $query = "SELECT * from users";
                    $rows = $db->query($query)->fetchAll();
                    foreach (array_reverse($rows) as $row) {
                        echo "<h3 class='peep'>" . $row[1] . "</h3>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } ?>
            </div>
            <div style="display: flex; flex-direction: column">
                <h3>click on a name to see ALL their messages :)</h3>
                <div class="messages-box" id="messages-box">
    
                </div>
            </div>
        </div>
    </div>
</body>

</html>