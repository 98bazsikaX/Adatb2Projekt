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
    $query = "DELETE FROM USERS WHERE email=:del_email";
    $result = oci_parse($connection,$query);
    oci_bind_by_name($result,":del_email",$email);
    if(oci_execute($result) === false){
       var_dump(oci_error($result));
        http_response_code(500);
    }else{
        echo $email;
    }
}else if(isset($_POST['flight'])){

    $airplane = $_POST['airplane'];
    $price=$_POST['price'];
    $depTime = $_POST['depTime'];
    $arrTime = $_POST['arrTime'];
    $depCode = $_POST['depCode'];
    $arrCode = $_POST['arrCode'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query = "INSERT INTO FLIGHTS(AIRPLANE_ID,PRICE,TAKEOFF_DATE,TAKEOFF_AIRPORT_CODE,LANDING_DATE,LANDING_AIRPORT_CODE) values(:plane,:price,TO_DATE(:takeoff,'YYYY-MM-DD'),:takeoffId,TO_DATE(:landing,'YYYY-MM-DD'),:landingId)";
    $result = oci_parse($connection,$query);

    oci_bind_by_name($result,":plane",$airplane);
    oci_bind_by_name($result,":price",$price);
    oci_bind_by_name($result,":takeoff",   $depTime);
    oci_bind_by_name($result,":takeoffId",$depCode);
    oci_bind_by_name($result,":landing",$arrTime);
    oci_bind_by_name($result,":landingId",$arrCode);

    if(oci_execute($result) === false){
        echo oci_error($result);
        http_response_code(500);
    }else{
        echo $airplane;
    }
}else if(isset($_POST['setRole'])){
    $email = $_POST['email'];
    $role = $_POST['type'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query = "UPDATE USERS SET ROLE_ID=:role WHERE EMAIL=:mail";
    $result = oci_parse($connection,$query);
    oci_bind_by_name($result,":mail",$email);
    oci_bind_by_name($result,":role",$role);
    if(oci_execute($result) === false){
        echo oci_error($result);
        http_response_code(500);
    }else{
        echo $email;
    }

}