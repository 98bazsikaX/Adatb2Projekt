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
    <script src="../javascript/adminFrontend.js"></script>
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <title>Admin</title>
    <style>
        table,th,td{
            border-radius: 5px;
            border-color: #21031e;
        }

        #airportTable,#airlinesTable{
            overflow-y: scroll;
            height: 400px;
        }
    </style>
</head>
<body onload="main()">
<!-- TODO: megoldani hogy tényleg csak admin lephessen be xd -->

<div id="addFlight">
    <h1>Járatok: </h1><br>
    <!-- List flights -->
    <div id="flightsTable">

    </div>

</div>
<div id="airline">
    <h1>Légitársaságok: </h1><br>
    <div id="airlinesTable">
    </div>
    <!-- Mező airline beillesztésére -->
    <div id="addAirline">
        <h2>Légitársaság hozzáadása: </h2><br>
        <form id="airlineForm">
            <label for="AirlineCode">Légitársaság kódja: </label><br>
            <input type="text" id="AirlineCode" name="AirlineCode"><br>
            <label for="name">Légitársaság neve: </label><br>
            <input type="text" id="name" name="name"><br>
            <label for="abr">Rövidítés: </label><br>
            <input type="text" id="abr" name="abr"><br>
            <label for="country">Ország:</label><br>
            <input type="text" id="country" name="country">
        </form>
        <button onclick="setAirline()">Elküldés</button>
    </div>
</div>
<div id="addAirPlane">
    <h1>Repülőgépek: </h1><br>
    <div id="airplaneTable">

    </div>
</div>
<!-- learazas tipusok -->
<!--<div id="discountTypes">
    <h1>Leárazás típusok: </h1><br>
    <div id="discounTypesTable">

    </div>

    <div id="addDiscountType">
        <h2>Leárazás típus hozzáadása: </h2><br>
    </div>


</div> -->

<div id="discounts">
    <h1>Leárazások:</h1><br>
    <div id="discountTable">

    </div>
    <div id="addDiscount">
        <h2>Leárazás hozzáadása: </h2>
    </div>
</div>

<div id="airports">
    <h1>Repülőterek: </h1><br>
    <div id="airportTable">

    </div>
    <div id="addAirport">

    </div>
</div>

</body>
</html>