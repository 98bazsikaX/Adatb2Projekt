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
    <title>Profil</title>
</head>
<body>
<h1>Heló</h1>
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
    INNER JOIN airports airports1 ON flights.landing_airport_code = airports1.code WHERE PURCHASES.USER_EMAIL=:email";

$parsed = oci_parse($connection,$query);
oci_bind_by_name($parsed,":email",$_SESSION['user']['email']);

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
        echo "<td><button onclick='delete_order($id)'>Törlés</button></td>";
        echo "</tr>";
    }
}


?>
</table>
</body>
</html>
