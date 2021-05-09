<?php
session_start();
include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');

    $quantity=$_GET['quantity'];
    $email=$_SESSION['user']['email'];
    $first=$_SESSION['user']['first_name'];
    $last=$_SESSION['user']['last_name'];
    $birth=$_SESSION['birth'];
    $fid=$_SESSION['fid'];

;


    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query = oci_parse($connection,"BEGIN CALL PADD(:email,:fid,:quantity); CALL TADD(:email,:first,:last,:birth); CALL SADD(:fid,:quantity); END;");

    oci_bind_by_name($query,":email",$email);
    oci_bind_by_name($query,":quantity",$quantity);
    oci_bind_by_name($query,":first",$first);
    oci_bind_by_name($query,":last",$last);
    oci_bind_by_name($query,":birth",$birth);
    oci_bind_by_name($query,":fid",$fid);

    if(oci_execute($query) === false){
        echo oci_error($query);
        http_response_code(500);
    }





