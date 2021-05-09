<?php
session_start();
include_once '../dotenv/dotenv.php';
include '../php/functions/userdataForBuying.php';
include '../php/functions/flightdataforbuying.php';
load_env('../dotenv/.env');

$fid=$_GET['id'];

if(isset($_POST['buying'])){
    $quantity=$_POST['quantity'];
    $email=$_SESSION['email'];
    $first=$_SESSION['first'];
    $last=$_SESSION['last'];
    $birth=$_SESSION['birth'];
    $fid=$_SESSION['flight_ID'];


    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

    $query = "CALL PADD(:email,:fid,:quantity); CALL TADD(:email,:first,:last,:birth); CALL SADD(:fid,:quantity);";

    $rec = oci_parse($connection,$query);


    oci_bind_by_name($rec,":email",$email);
    oci_bind_by_name($rec,":quantity",$quantity);
    oci_bind_by_name($rec,":first",$first);
    oci_bind_by_name($rec,":last",$last);
    oci_bind_by_name($rec,":birth",$birth);
    oci_bind_by_name($rec,":fid",$fid);


    if(oci_execute($rec) === false){
        echo oci_error($rec);
        http_response_code(500);
    }

}

