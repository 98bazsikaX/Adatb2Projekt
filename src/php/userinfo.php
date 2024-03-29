<?php
session_start();
if(!isset($_SESSION['user']) || $_GET['id']!=$_SESSION['user']['email']){
    header('Location: login.php');
    return;
}
$session_id = $_SESSION['user']['email'];
echo "<input type='hidden' id='SessionEmail' value='$session_id'>";
?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../javascript/userinfo.js"></script>
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <link rel="stylesheet" href="../resources/stylesheets/user.css">
    <title>Profil</title>
</head>
<body>
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

    }
    ?>

</div>
<h1>Heló</h1>
<div class="results2">
<h2>Az ön rendelései</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Mennyiség</th>
        <th>Dátum</th>
        <th>Státusz</th>
        <th>Ár</th>
        <th>Légitársaság</th>
        <th>Felszálás ideje</th>
        <th>Leszállás ideje</th>
        <th>Indulás</th>
        <th>Érkezés</th>
        <th>Törlés</th>
    </tr>
<?php
include_once './dotenv/dotenv.php';
load_env('./dotenv/.env');

$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
if(!$connection){
    exit(420);
}

$query = "SELECT
    purchases.id,
    purchases.quantity,
    purchases.purchase_date,
    purchases.PURCHASE_STATE,
    purchase_states.state_name,
    flights.price,
    flights.takeoff_date,
    airlines.airline_name,
    flights.landing_date,
    airports.airport_name AS airport_dep,
    airports1.airport_name AS airport_arr
FROM
         purchases
    INNER JOIN flights ON purchases.flight_id = flights.id
    INNER JOIN airports ON flights.takeoff_airport_code = airports.code
    INNER JOIN purchase_states ON purchases.purchase_state = purchase_states.id
    INNER JOIN airplanes ON flights.airplane_id = airplanes.id
    INNER JOIN airlines ON airplanes.airline_code = airlines.code
    INNER JOIN airports airports1 ON flights.landing_airport_code = airports1.code WHERE PURCHASES.USER_EMAIL=:mail ORDER BY PURCHASE_DATE desc";

$parsed = oci_parse($connection,$query);
oci_bind_by_name($parsed,":mail",$_SESSION['user']['email']);

if(oci_execute($parsed)){
    while($row = oci_fetch_array($parsed)){
        $id = $row['ID'];
        echo "<tr>";
        echo "<td>".$row['ID']."</td>";
        echo "<td>".$row['QUANTITY']."</td>";
        echo "<td>".$row['PURCHASE_DATE']."</td>";
        echo "<td>".$row['STATE_NAME']."</td>";
        echo "<td>".$row['PRICE']."</td>";
        echo "<td>".$row['AIRLINE_NAME']."</td>";
        echo "<td>".$row['TAKEOFF_DATE']."</td>";
        echo "<td>".$row['LANDING_DATE']."</td>";
        echo "<td>".$row['AIRPORT_DEP']."</td>";
        echo "<td>".$row['AIRPORT_ARR']."</td>";
        if($row['PURCHASE_STATE'] != '2' && $row['PURCHASE_STATE'] != '3'){
            echo "<td><button onclick='delete_order($id)'>Törlés</button></td>";
        }
        echo "</tr>";
    }
}


?>
</table>
</div>
<div class="results2">
<h2>Az ön jegyei</h2>
    <table>
        <tr>
            <th>Járat</th>
            <th>Név</th>
            <th>Születési Dátum</th>
        </tr>
        <?php
        $query = "SELECT
    airports.airport_name,
    airports1.airport_name AS airport_name1,
    tickets.first_name,
    tickets.last_name,
    tickets.birth_date
    FROM flights
    INNER JOIN airports ON flights.takeoff_airport_code = airports.code
    INNER JOIN airports airports1 ON flights.landing_airport_code = airports1.code
    INNER JOIN purchases ON purchases.flight_id = flights.id
    INNER JOIN tickets ON tickets.purchase_id = purchases.id";
        $parsed = oci_parse($connection,$query);
        if(oci_execute($parsed)){
            while($row = oci_fetch_array($parsed)){
                echo "<tr>";
                echo "<td>". $row['AIRPORT_NAME'] . " -> " . $row['AIRPORT_NAME1']  ."</td>";
                echo "<td>".$row['FIRST_NAME'] ." ".$row['LAST_NAME'] ."</td>";
                echo "<td>".$row['BIRTH_DATE']."</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>
<div class="results3" >
<h2>Az ön adatai</h2>
<form method="post" action="functions/changeUserData.php">
    <?php

        $query = "SELECT * FROM USERS WHERE EMAIL=:mail";
        $parsed = oci_parse($connection,$query);
        oci_bind_by_name($parsed,":mail",$_SESSION['user']['email']);
        if(oci_execute($parsed)){
            while($row = oci_fetch_array($parsed)){
                $email = $row['EMAIL'];
                $first = $row['FIRST_NAME'];
                $last = $row['LAST_NAME'];
                $birth = $row['BIRTH_DATE'];

                $phone = $row['PHONE_NUM'];
                $country = $row['COUNTRY'];
                $postcode = $row['POST_CODE'];
                $city = $row['CITY'];
                $address = $row['HOME_ADDRESS'];

                echo '<label for="mail">Email</label><br>';
                echo "<input type='text' id='mail' disabled value='$email'><br>"; //ezeknek nincs neve mert disabled input
                echo '<label for="fistname">Keresztnév</label><br>';
                echo "<input type='text' id='firstname' value='$first' disabled ><br>";
                echo '<label for="lastname">Vezetéknév</label><br>';
                echo "<input type='text' id='lastname' value='$last' disabled ><br>";
                echo  '<label for="bdate">Születésnap</label><br>';
                echo "<input type='text' id='bdate' value='$birth' disabled><br>";

                echo ' <label for="country">Ország </label><br>';
                echo "<input type='text' id='country' value='$country' disabled><br>";

                echo '<label for="postcode">Irányítószám</label><br>';
                echo  "<input type='text' id='postcode' name='postcode' value='$postcode' required><br>";

                echo '<label for="city">Város</label><br>';
                echo "<input type='text' name='city' id='city'  value='$city' required> <br>";

                echo '<label for="address">Utca Házszám:</label><br>';
                echo "<input type='text' id='address' name='address'  value='$address' required> <br>";

                echo '<label for="phonenum">Telefonszám</label><br>';
                echo "<input type='tel' name='phonenum' id='phonenum' value='$phone' required> <br>";
                echo "<input type='hidden'  name='user_email' value='$email'>";
            }
        }

    ?>
    <input type='submit' name="changeuser" value="Adatok módosítása">
</div>
<div class="results2">
    <h2>Az ön keresései</h2>
    <table>
        <tr>
            <th>Repterek</th>
            <th>Dátum</th>
            <th>Ár</th>
            <th>Keresés ideje</th>
        </tr>
    <?php

    $query = "SELECT * FROM SEARCHES WHERE USER_EMAIL=:mail";
    $parsed = oci_parse($connection,$query);
    oci_bind_by_name($parsed,":mail",$_SESSION['user']['email']);
    oci_execute($parsed);
    while($row = oci_fetch_array($parsed)){
        echo "<tr>";
        $dep = $row['TAKEOFF_COUNTRY'] . "  " . $row['TAKEOFF_CITY'];
        $arr = $row['LANDING_COUNTRY'] . "  " . $row['LANDING_CITY'];
        $dates = $row['FROM_DATE'] . " => " . $row['TO_DATE'];
        $price =  $row['FROM_PRICE']. " =>" . $row['TO_PRICE'];
        $date = $row['SEARCH_DATE'];
        echo "<td>$dep => $arr</td>";
        echo "<td>$dates</td>";
        echo "<td>$price</td>";
        echo "<td>$date</td>";
        echo "<tr>";
    }
    ?>
    </table>
   <a href="functions/deleteSearches.php">Keresési előzmények törlése (eskü töröljük, nem mint a google)</a>
</div>
</form>
</body>
</html>
