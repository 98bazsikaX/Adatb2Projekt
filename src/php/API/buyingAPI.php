<?php

include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');


if(isset($_POST['buying'])){
$r_email = $_POST['r_mail'];
$quantity = $_POST['person'];
$f_number = $_POST['fnumber'];
$dates=$_POST['date'];
$state=1;
$purchase_state=1;
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

$query = "INSERT INTO PURCHASES (ID,USER_EMAIL,FLIGHT_ID,QUANTITY,PURCHASE_DATE,PURCHASE_STATE)VALUES(:state,:user_email,:flight_id,:quantity,:dates,:purchase_state)";

      $rec = oci_parse($connection,$query);


    oci_bind_by_name($rec,":user_email",$r_email);
    oci_bind_by_name($rec,":flight_id",$f_number);
    oci_bind_by_name($rec,":quantity",$person);
    oci_bind_by_name($rec,":purchase_date",$date);
    oci_bind_by_name($rec,":purchase_state",$state);
    if(oci_execute($rec) === false){
        echo oci_error($rec);
        http_response_code(500);
    }

  }

