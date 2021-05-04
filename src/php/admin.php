<?php
    include_once 'dotenv/dotenv.php';
    load_env('dotenv/.env');
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

    session_start();
    if(!isset($_SESSION['user'])  ||intval($_SESSION['user']['role'])!=5){

        //header("Location:/php/login.php");
    }

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

        #airportTableContainer,#airlinesTable,#userTable{
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
    <div id="addFlight">
        <h2>Járat hozzáadása:</h2><br>
        <form id="addflightform">
            <label for="airline_select">Repülő: </label>
            <select id="airline_select" name="airline_select">
            <?php
            /*TODO: par feltoltott adat utan megirni ezt*/
            /*echo "<option value='wizz'>Wizzair</option>";
            echo "<option value='ryan'>Ryan Air</option>";*/

            $query = oci_parse($connection,"SELECT AIRPLANES.AIRPLANE_TYPE ,  AIRLINES.AIRLINE_NAME , AIRPLANES.ID FROM AIRPLANES INNER JOIN AIRLINES ON AIRLINES.CODE =AIRPLANES.AIRLINE_CODE");
            oci_execute($query);

            while($row = oci_fetch_array($query,OCI_ASSOC+OCI_RETURN_NULLS)){
                //print_r($row);
                $code = $row['ID'];
                $name = $row['AIRLINE_NAME'] . " - " . $row['AIRPLANE_TYPE'];
                echo "<option class='airline_option' value='$code'>$name</option>";
            }


            ?>
            </select><br>
            <label for="price">Ár: </label>
            <input type="number" name="price" id="price"><br>
            <label for="depTime">Indulás ideje: </label>
            <input type="date" id="depTime" name="depTime"><br>
             <label for="arrTime">Érkezés ideje: </label>
            <input type="date" id="arrTime" name="arrTime"><br>
            <label for="flight_airport">Indulási reptér:</label>
            <select id="flight_airport" name="flight_airport">

            </select><br>
            <label for="arrId">Érkezési reptér kódja: </label>
            <select id="arrId" name="arrId">

            </select>
            <br>
        </form>
        <button onclick="setFlights()">Elküldés</button><br>
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
    <div id="airportTableContainer">
        <table id="airportTable">

        </table>
    </div>



    <div id="addAirport">
        <h2>Repülőtér hozzáadása: </h2><br>
        <form id="airportForm">
            <label for="AirportCode">Repülőtér kódja: </label><br>
            <input type="text" id="AirportCode" name="AirportCode"><br
            <label for="AirportName">Repülőtér neve: </label><br>
            <input type="text" id="AirportName" name="AirportName"><br>
            <label for="AirportCountry">Repülőtér országa: </label><br>
            <input type="text" id="AirportCountry" name="AirportCountry"><br>
            <label for="AirportCity">Repülőtér városa: </label><br>
            <input type="text" id="AirportCity" name="AirportCity"><br>
        </form>
        <button onclick="setAirport()">Elküldés</button>
    </div>
</div>

<div id="users">
    <h1>Felhasználók: </h1><br>
    <div id="userTable">

    </div>
     <div id="deleteUser">
         <h2>Felhasználó törlése email alapján: </h2><br>
         <form>
             <label for="deleteEmail">A felhasználó email címe: </label><br>
             <input type="email" id="deleteEmail" name="deleteEmail">
         </form>
         <button onclick="deleteUser()">Felhasználó törlése</button>

     </div>
</div>

</body>
</html>