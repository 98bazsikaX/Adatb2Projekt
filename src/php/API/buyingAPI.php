<?php

include_once '../dotenv/dotenv.php';
include_once '../dotenv/dotenv.php';
include '../php/functions/userdataForBuying.php';
load_env('../dotenv/.env');


if(isset($_POST['buying'])){
$email = $_POST['email'];
$quantity = $_POST['quantity'];
$state=1;
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

