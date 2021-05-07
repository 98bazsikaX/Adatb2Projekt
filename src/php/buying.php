<?php

include_once 'dotenv/dotenv.php';
//probálgatás miatt bent hagytam itt is az inclludeot
include '../php/functions/userdataForBuying.php';
include_once './dotenv/dotenv.php';
load_env('./dotenv/.env');
$Fid = $_GET['id'];
if(isset($_POST['search'])){
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $arr = $_POST['arr'];
    $dep = $_POST['dep'];
    $query = oci_parse($connection,"SELECT * FROM FLIGHTS WHERE TAKEOFF_AIRPORT_CODE = '$dep' AND LANDING_AIRPORT_CODE='$arr'");
    $parsed = oci_parse($connection,$query);

    if(oci_execute($parsed)){
        while($row = oci_fetch_array($parsed)) {

            $takeoff = $row['TAKEOFF_AIRPORT_CODE'];
            $land = $row['LANDING_AIRPORT_CODE'];

        }
    }
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vásárlás</title>

    <!--Stylesheets-->
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <link rel="stylesheet" href="../resources/stylesheets/buying.css">





</head>
<body onload="main()">
<div id="main">
    <form method="post" action="API/buyingAPI.php">
<?php


?>
   <label class ="labname" >fő: </label>
 <br>
 <input class ="inaname" type="number" name="person" id="person" required>
   <br>

   <input type="submit" class ="but" value="Vásárlás">
  </div>
</form>
 </div>

</body>
</html>