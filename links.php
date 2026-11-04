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
    </style>
    </head>
</html>