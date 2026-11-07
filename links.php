<html>

<head>
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

        main {
            background-color: rgba(255, 255, 255, 0.55);
            padding: 5px;
            margin: 0px 10px;
        }
    </style>
</head>

<body>
    <main>
        <h2 style="text-align: center;">Welcome to Hammerhead Records!!!</h2>
        <p>Inspired by Chainsaw Records, Hammerhead Records seeks to act as a place for internet savvy peoples, especially those in the Queercore/Punk scenes, to have an effective way to communicate with each other.</p>
        <p>To faciliate discussion, Hammerhead Records allows you to make messages, reply to people, and create an account to identify yourself. On the sign in page, you can also see a list of people and click on their name to see their messages.</p>
        <p>If you're interested, head on hover to the <a href="/">main page</a> or the <a href="signup.php">sign in page</a></p>
        <br />
        <p>Also, see this list of friendly/similar websites :) happy surfing, sharks!</p>
        <ul>
            <li><a href="https://en.wikipedia.org/wiki/Chainsaw_Records">Chainsaw Records</a></li>
            <li><a href="https://pokemondb.net/pokedex/altaria">The Pokemans (The best one)</a></li>
            <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ?message-for-you=get_rick_rolled_lmao_loser">The Guess Whats</a></li>
            <li><a href="https://www.nytimes.com/games/wordle/index.html">Words</a></li>
            <li><a href="about:blank">A Blank Page</a></li>
            <li><a href="https://www.dragonflycave.com/favorite-list/?favs=FNHZHNCdHYDVD3G8CCABAFGtJeIoCfCoCpDGDPJkCUDkCqAGIvCzAAIMC0IyFUDEDoG0ImJTBPCyGzGEIND5FMCBJSJgGNCIHDBOILI1ItBDAXBRDCBQGCIsG6F3CZI2IRHVCTACDUIqBdJKGLHM">My Favorite Pokemon</a></li>
            <li><a href="https://github.com/Nathan-Cherny">Git-Hub (10 years early)</a></li>
            <li><a href="https://en.wikipedia.org/wiki/Flipper_(band)">Flipper (fellow fish friends)</a></li>
        </ul>

    </main>
</body>

</html>