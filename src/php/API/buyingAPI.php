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
    $query = oci_parse($connection,'BEGIN PADD(:mail,:fid,:quant);END;');

    oci_bind_by_name($query,":mail",$email);
    oci_bind_by_name($query,":fid",$fid);
    oci_bind_by_name($query,":quant",$quantity);

    if(oci_execute($query) === false){
        var_dump(oci_error($query));
        http_response_code(500);
    }
    $query = oci_parse($connection,'BEGIN TADD(:mail,:fir,:las,:birthd);END;');
    oci_bind_by_name($query,":mail",$email);
    oci_bind_by_name($query,":fir",$first);
    oci_bind_by_name($query,":las",$last);
    oci_bind_by_name($query,":birthd",$birth);
    if(oci_execute($query) === false){
        var_dump(oci_error($query));
        http_response_code(500);
    }
//

    $query = oci_parse($connection,'BEGIN SADD(:fid,:quant);END;');
    oci_bind_by_name($query,":fid",$fid);
    oci_bind_by_name($query,":quant",$quantity);
    if(oci_execute($query) === false){
        var_dump(oci_error($query));
        http_response_code(500);
    }






