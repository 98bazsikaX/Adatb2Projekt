<?php
session_start();
include_once '../dotenv/dotenv.php';
include_once '../dotenv/dotenv.php';
include '../php/functions/userdataForBuying.php';
include '../php/functions/flightdataforbuying.php';
load_env('../dotenv/.env');


if(isset($_POST['buying'])){

$state=1;
    $email=$_SESSION['email'];
    $first=$_SESSION['first'];
    $last=$_SESSION['last'];
    $birth=$_SESSION['birth'];

$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

$query = "INSERT INTO PURCHASES (USER_EMAIL,FLIGHT_ID,QUANTITY,PURCHASE_STATE)VALUES(:r_email,:flight_id,:quantity,:state)";

      $rec = oci_parse($connection,$query);


    oci_bind_by_name($rec,":user_email",$email);
    oci_bind_by_name($rec,":quantity",$quantity);
    oci_bind_by_name($rec,":purchase_state",$state);
    if(oci_execute($rec) === false){
        echo oci_error($rec);
        http_response_code(500);
    }

  }

