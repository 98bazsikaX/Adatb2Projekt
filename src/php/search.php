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
    <link rel="stylesheet" href="../resources/stylesheets/search.css">
    <script src="../javascript/search_frontend.js"></script>

    <title>Járat keresése</title>

</head>
<body onload="main()">

<div class="topnav">
    <a href="login.php">regisztráció/bejelentkezés</a>
    <a href="admin.php">admin</a>
    <a href="info.php">infók</a>
    <a href="search.php">keresés</a>
    <a href="us.php">rólunk</a>
    <?php
    if(isset($_SESSION['user'])){
        $id = $_SESSION['user']['email'];
        echo "<a href='userinfo.php?id=$id'>Profilom</a>";
        echo "<a href='buying.php?id=$id'>jegy vásárlás</a>";
    }
    ?>

</div>
    <header>Járatok keresése</header>
    <br>
    <div id="wrapper">
        <!-- bal oldali opciók div -->
        <div id="options" class="flex_child">
            <p>Opciók</p>
            <!-- TODO: implementalni a lekerdezest ugy hogy unique adatokat kerjen le , kell egy lekerdezes az alap adatokhoz, es egy ami a kereses-->
            <button class ="but" onclick="makeRequest()">Keresés</button>
                <div id="airline_option">
                    <label for="airline_select">Légitársaságok</label>
                    <select class ="inaname" id="airline_select" name="airline_select">
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
                    <select class ="inaname" id="departure_select" name="departure_select">
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
                    <select class ="inaname" id="arrival_select" name="arrival_select">
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
                    <input class ="inaname" type="date" id="dep_time_box" name="departure-date" >

                </div>
            <button class ="but" onclick="makeRequest()">Keresés</button>
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