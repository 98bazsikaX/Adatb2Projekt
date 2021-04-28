<?php

include_once 'dotenv/dotenv.php';
load_env('dotenv/.env');
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <script src="../javascript/search_frontend.js"></script>

    <title>Járat keresése</title>
    <style>
        #wrapper{
            width: 100%;
            display: flex;
        }
        .flex_child{
            flex: 1;
           /* border: 2px solid yellow;
            border-radius: 20%;*/
        }
        #options{
            height: available;
            width: 20%;
            background-color: rgb(50, 58, 65);
            flex-basis: 20%;
        }
        #results{
            width: 80%;
            background-color: rgb(12, 17, 24);
            flex-basis: 80%;
        }
        option{
            width: auto;
        }

    </style>
</head>
<body onload="main()">
    <header>Járatok keresése</header>
    <br>
    <div id="wrapper">
        <!-- bal oldali opciók div -->
        <div id="options" class="flex_child">
            <p>Opciók</p>
            <!-- TODO: implementalni a lekerdezest ugy hogy unique adatokat kerjen le , kell egy lekerdezes az alap adatokhoz, es egy ami a kereses-->
            <button onclick="makeRequest()">Keresés</button>
                <div id="airline_option">
                    <label for="airline_select">Légitársaságok</label>
                    <select id="airline_select" name="airline_select">
                        <?php
                            /*TODO: par feltoltott adat utan megirni ezt*/
                        /*echo "<option value='wizz'>Wizzair</option>";
                        echo "<option value='ryan'>Ryan Air</option>";*/

                        $query = oci_parse($connection,"SELECT CODE , AIRLINE_NAME FROM AIRLINES ");
                        oci_execute($query);

                        while($row = oci_fetch_array($query,OCI_ASSOC+OCI_RETURN_NULLS)){
                            $code = $row['CODE'];
                            $name = $row['AIRLINE_NAME'];
                            echo "<option class='airline_option' value='$code'>$name</option>";
                        }


                        ?>
                    </select>
                </div>
                <div id="departure">
                    <label for="departure_select">Indulás helye</label>
                    <select id="departure_select" name="departure_select">
                        <?php
                        $query = oci_parse($connection,"SELECT CODE , AIRPORT_NAME FROM AIRPORTS ");
                        oci_execute($query);

                        while($row = oci_fetch_array($query,OCI_ASSOC+OCI_RETURN_NULLS)){
                            $code = $row['CODE'];
                            $name = $row['AIRPORT_NAME'];
                            echo "<option class='departure_option' value='$code'>$name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="arrival">
                    <label for="arrival_select">Érkezés helye</label>
                    <select id="arrival_select" name="arrival_select">
                        <?php
                        $query = oci_parse($connection,"SELECT CODE , AIRPORT_NAME FROM AIRPORTS ");
                        oci_execute($query);

                        while($row = oci_fetch_array($query,OCI_ASSOC+OCI_RETURN_NULLS)){
                            $code = $row['CODE'];
                            $name = $row['AIRPORT_NAME'];
                            echo "<option class='arrival_option' value='$code'>$name</option>";
                        }

                        ?>
                    </select>
                </div>
                <div id="departure_time">
                    <label for="dep_time_box">Indulás ideje:</label>
                    <input type="date" id="dep_time_box" name="departure-date" >

                </div>
            <button onclick="makeRequest()">Keresés</button>
        </div>

        <!---------------------------------->
        <!-- mellette lévő eredmények div -->
        <!---------------------------------->
        <div id="results" class="flex_child">
            <p>Eredmény</p>
            <!-- TODO: a beallitott opciok alapjan lekerdezni a dolgokat, ezt JS-el tölti fel -->
        </div>
    </div>
</body>
</html>
<script src="../javascript/search_frontend.js"></script>