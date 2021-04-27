<?php


include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');


if(isset($_POST['setairline'])){
    $code = $_POST['code'];
    $name = $_POST['name'];
    $abbr = ( (isset($_POST['abbr'])) ? $_POST['abbr'] : "");
    $nat = $_POST['nat'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

    $query = "INSERT INTO AIRLINES(CODE,AIRLINE_NAME,AIRLINE_NAME_ABBR,COUNTRY) VALUES (:code,:nev,:abv,:nat)";

    $res = oci_parse($connection,$query);

    oci_bind_by_name($res,":code",$code);
    oci_bind_by_name($res,":nev",$name);
    oci_bind_by_name($res,":abv",$abbr);
    oci_bind_by_name($res,":nat",$nat);
    if(oci_execute($res)){
        http_response_code(200);
    }else{
        http_response_code(503); //csak ugy random, TODO: atirni normalisra
    }
}