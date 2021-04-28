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
    if(oci_execute($res) === false){
        echo oci_error($res);
        http_response_code(500);
    }


}else if(isset($_POST['airport'])){

    $code = $_POST['code'];
    $name = $_POST['name'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query = "INSERT INTO AIRPORTS(CODE,AIRPORT_NAME,COUNTRY,CITY) values(:code,:airName,:country,:city)";

    $result = oci_parse($connection,$query);
    oci_bind_by_name($result,":code",$code);
    oci_bind_by_name($result,":airName",$name);
    oci_bind_by_name($result,":country",$country);
    oci_bind_by_name($result,":city",$city);

    if(oci_execute($result) === false){
        echo oci_error($result);
        http_response_code(500);
    }

}else if(isset($_POST['delete_user'])){
    $email = $_POST['email'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query = "DELETE FROM USERS WHERE email='$email'";
    $result = oci_parse($connection,$query);
    if(oci_execute($result) === false){
        echo oci_error($result);
        http_response_code(500);
    }else{
        echo $email;
    }
}