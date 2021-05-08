<?php
    include_once 'dotenv/dotenv.php';
    load_env('dotenv/.env');
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

    session_start();
    if(!isset($_SESSION['user'])  ||intval($_SESSION['user']['role'])!=5){
        header("Location:/php/login.php");
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
<div id="discounts">
    <h1>Leárazások:</h1><br>
    <div id="discountTable">

    </div>
    <div id="addDiscount">
        <h2>Leárazás hozzáadása: </h2>
        <label for="discountFlight">Járat azonosítója: </label><br>
        <input type="number" id="discountFlight"><br>
        <label for="discountAmount">Leárazás mértéke: </label><br>
        <input type="number" id="discountAmount"><br>
        <label for="discountType">Típusa: </label><br>
        <select id="discountType">
        <?php
        $query = oci_parse($connection,"SELECT * FROM DISCOUNT_TYPES");
        oci_execute($query);
        while($row = oci_fetch_array($query)){
            $name = $row['DISCOUNT_NAME'];
            echo "<option value='$name'>$name</option>";
        }
        ?>
        </select>
        <label for="discountFrom">Kezdet: </label><br>
        <input type="date" id="discountFrom"><br>
        <label for="discountTo">Vége: </label>
        <input type="date" id="discountTo"><br>
        <button onclick="createDiscount()">Küldés</button>
    </div>
    <h2>Leárazás törlése</h2>
    <div id="delDiscount">
        <label for="delDiscountID">Leárazás ID-je</label><br>
        <input type="number" id="delDiscountID"><br>
        <button onclick="deleteDiscount()">Törlés</button>
    </div>
</div>

<div id="airline">
    <h1>Légitársaságok: </h1><br>
    <table id="airlinesTable">
    </table>
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
    <table id="airplaneTable">

    </table>
    <div id="addAirplane">
        <h2>Gép hozzáadása</h2>
        <label for="airlineForAirplane">Légitársaság</label><br>
        <select id="airlineForAirplane">

        </select><br>
        <label for="airplaneType">Típusa: </label><br>
        <input type="text" maxlength="20" id="airplaneType"><br>
        <label for="airplaneCap">Férőhelyek:</label><br>
        <input type="number" maxlength="3" id="airplaneCap"><br>
        <button onclick="setAirplane()">Küldés</button>
    </div>
    <div id="delAirplane">
        <h2>Gép Törlése</h2>
        <label for="delAirlineForAirplane">Légitársaság</label><br>
        <select id="delAirlineForAirplane">

        </select><br>
        <label for="delAirplaneCode">Légitársaságon belüli kódja:</label><br>
        <input type="number" maxlength="4" id="delAirplaneCode"><br>
        <button onclick="delAirplane()">Törlés</button><br>

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
         <br>
         <br>
         <br>
         <form>
             <label for="roleEmail">Email címe: </label><br>
             <input type="email" id="roleEmail"><br>
             <label for="setRole">Új role: </label><br>
             <select id="setRole" required>
                 <?php
                 $query = oci_parse($connection,"SELECT * FROM ROLES");
                 oci_execute($query);
                 while($row = oci_fetch_array($query)){
                     $value = $row['ID'];
                     $name = $row['ROLE_NAME'];
                     echo "<option value='$value'>$name</option>";
                 }
                 ?>
             </select><br>

         </form>
         <button onclick="newRoleStuff()">Beállítás</button>
     </div>
</div>

</body>
</html>