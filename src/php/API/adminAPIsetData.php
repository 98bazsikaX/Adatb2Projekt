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

}else if(isset($_POST['airplaneSetter'])){
    $airline = $_POST['airlineForPlane'];
    $type=$_POST['type'];
    $cap = $_POST['cap'];
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query="INSERT INTO AIRPLANES(AIRPLANE_ID, AIRLINE_CODE, AIRPLANE_TYPE, CAPACITY) VALUES (NVL((SELECT MAX(AIRPLANE_ID)+1 FROM AIRPLANES WHERE AIRLINE_CODE=:airlineCode),0) ,:airlineCode,:type,:cap)";
    $result = oci_parse($connection,$query);
    oci_bind_by_name($result,":airlineCode",$airline);
    oci_bind_by_name($result,":type",$type);
    oci_bind_by_name($result,":cap",$cap);
    if(oci_execute($result) === false){
        echo oci_error($result);
        http_response_code(500);
    }else{
        echo $airline.";".$type;
    }
}else if(isset($_POST['delAirplane'])){
    $airline = $_POST['toDelAirline'];
    $code = $_POST['toDelCode'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $result = oci_parse($connection,"DELETE FROM AIRPLANES WHERE AIRLINE_CODE=:code AND AIRPLANE_ID=:apid");
    oci_bind_by_name($result,":code",$airline);
    oci_bind_by_name($result,":apid",$code);
    if(oci_execute($result) === false){
        echo oci_error($result);
        http_response_code(500);
    }else{
        echo $airline.";".$code;
    }

}else if(isset($_POST['createDiscount'])){
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $result = oci_parse($connection,"INSERT INTO DISCOUNTS(FLIGHT_ID, DISCOUNT_TYPE_NAME, AMOUNT, VALID_FROM,VALID_TO)  VALUES(:fid,:dtype,:damount,TO_DATE(:vfrom,'YYYY-MM-DD'),TO_DATE(:vto,'YYYY-MM-DD'))");
    oci_bind_by_name($result,":fid",$_POST['id']);
    oci_bind_by_name($result,":dtype",$_POST['type']);
    oci_bind_by_name($result,":damount",$_POST['amount']);
    oci_bind_by_name($result,":vfrom",$_POST['from']);
    oci_bind_by_name($result,"vto",$_POST['to']);
    if(oci_execute($result)==false){
        //echo oci_error($result);
        http_response_code(500);
    }else{
        echo $_POST['id'];
    }
}else if(isset($_POST['delDiscount'])){
    $id = $_POST['id'];
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $result = oci_parse($connection,"DELETE FROM DISCOUNTS WHERE ID=:azon");
    oci_bind_by_name($result,":azon",$id);
    if(oci_execute($result)==false){
        http_response_code(500);
    }else{
        echo $id;
    }
}