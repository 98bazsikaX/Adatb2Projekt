<?php
session_start();
include_once './dotenv/dotenv.php';
load_env('./dotenv/.env');

if(isset($_POST['search'])){
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
//valami nem fasza hívom a mentőket
    $arr = $_POST['arr'];
    $dep = $_POST['dep'];
$query = oci_parse($connection,"SELECT * FROM FLIGHTS WHERE TAKEOFF_AIRPORT_CODE = '$dep' AND LANDING_AIRPORT_CODE='$arr'");
$parsed = oci_parse($connection,$query);


if(oci_execute($parsed)){
    while($row = oci_fetch_array($parsed)) {
        $Fid = $row['ID'];
        $takeoff = $row['TAKEOFF_AIRPORT_CODE'];
        $lland = $row['LANDING_AIRPORT_CODE'];

    }
}
}