<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/stylesheets/global.css">

    <title>Járat keresése</title>
    <style>
        #wrapper{
            width: 100%;
            display: flex;
        }
        .flex_child{
            flex: 1;
            border: 2px solid yellow;
            border-radius: 20%;
        }
        #options{
            height: available;
            width: 20%;
        }
        #results{
            width: 80%;
        }

    </style>
</head>
<body>
    <header>Járatok keresése</header>
    <br>
    <div id="wrapper">
        <!-- bal oldali opciók div -->
        <div id="options" class="flex_child">
            <p>Opciók</p>
            <!-- TODO: implementalni a lekerdezest ugy hogy unique adatokat kerjen le -->
            <button>Keresés</button>
                <div id="airline_option">
                    <p>Légitársaságok</p>
                </div>
                <div id="departure">
                    <p>Indulás helye</p>
                </div>
                <div id="arrival">
                    <p>Érkezés helye</p>
                </div>
                <div id="departure_time">
                    <label for="dep_time_box">Indulás ideje:</label>
                    <input type="date" id="dep_time_box" name="departure-date" min="2021-04-17">

                </div>
            <button>Keresés</button>
        </div>
        <!-- mellette lévő eredmények div -->
        <div id="results" class="flex_child">
            <p>Eredmény</p>
            <!-- TODO: a beallitott opciok alapjan lekerdezni a dolgokat -->
        </div>
    </div>
</body>
</html>
<script src="../javascript/search_frontend.js"></script>