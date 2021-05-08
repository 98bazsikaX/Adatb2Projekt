<?php

//ebbe akarom a flight adatait lekérni
include_once './dotenv/dotenv.php';
load_env('./dotenv/.env');

$Fid = $_GET['id'];
if(isset($_POST['search'])){
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);


    $query = oci_parse($connection,"SELECT * FROM FLIGHTS WHERE ID='$Fid'");
    $parsed = oci_parse($connection,$query);

    if(oci_execute($parsed)){
        while($row = oci_fetch_array($parsed)) {

            $_SESSION['takeoff'] = $row['TAKEOFF_AIRPORT_CODE'];

            $_SESSION['landig'] = $row['LANDING_AIRPORT_CODE'];

            $Fid=$row['ID'];
        }
    }
}

