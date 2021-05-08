<?php

include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
if(!$connection){
    exit(420);
}

session_start();

if(isset($_POST['search'])){
 //TODO: json api

    $query = oci_parse($connection,"SELECT
    flights.id,
    CALC_DISCOUNT(flights.id) AS PRICE,
    flights.takeoff_date,
    flights.landing_date,
    airlines.airline_name,
    airports.airport_name     AS dep_arp_name,
    airports.city             AS dep_arp_city,
    airports1.airport_name    AS  arr_arp_name,
    airports1.city            AS  arr_arp_city
    FROM flights
    INNER JOIN airplanes ON flights.airplane_id = airplanes.id
    INNER JOIN airlines ON airplanes.airline_code = airlines.code
    INNER JOIN airports ON flights.takeoff_airport_code = airports.code
    INNER JOIN airports airports1 ON flights.landing_airport_code = airports1.code
    WHERE TAKEOFF_AIRPORT_CODE =:dep AND LANDING_AIRPORT_CODE=:arr AND (PRICE BETWEEN :min_price AND :max_price)  AND (TAKEOFF_DATE BETWEEN TO_DATE(:fromDate,'YYYY-MM-DD') AND TO_DATE(:toDate,'YYYY-MM-DD'))
    ORDER BY PRICE 
    "); //AND (PRICE BETWEEN :min_price AND :max_price)

    oci_bind_by_name($query,":dep",$_POST['dep']);
    oci_bind_by_name($query,":arr",$_POST['arr']);
    oci_bind_by_name($query,":max_price",$_POST['max_price']);
    oci_bind_by_name($query,":min_price",$_POST['min_price']);
    oci_bind_by_name($query,":fromDate",$_POST['time']);
    oci_bind_by_name($query,":toDate",$_POST['time_max']);

    oci_execute($query);

    $toEcho = [];
    while ($row = oci_fetch_array($query)) {
        array_push($toEcho,json_encode($row));
    }

    echo json_encode($toEcho);


    if(isset($_SESSION['user']) && isset($_SESSION['user']['email'])){
        insertSearch();
    }


}else if(isset($_POST['ALL'])){
    $query = oci_parse($connection,"SELECT
    flights.id,
    CALC_DISCOUNT(flights.id) AS PRICE,
    flights.takeoff_date,
    flights.landing_date,
    airlines.airline_name,
    airports.airport_name     AS dep_arp_name,
    airports.city             AS dep_arp_city,
    airports1.airport_name    AS  arr_arp_name,
    airports1.city            AS  arr_arp_city
    FROM flights
    INNER JOIN airplanes ON flights.airplane_id = airplanes.id
    INNER JOIN airlines ON airplanes.airline_code = airlines.code
    INNER JOIN airports ON flights.takeoff_airport_code = airports.code
    INNER JOIN airports airports1 ON flights.landing_airport_code = airports1.code WHERE TAKEOFF_DATE>=SYSDATE ORDER BY PRICE");
    oci_execute($query);

    $toEcho = [];
    while ($row = oci_fetch_array($query)) {
        array_push($toEcho,json_encode($row));
    }

    echo json_encode($toEcho);


}


function insertSearch(){
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    $query = oci_parse($connection,"INSERT INTO SEARCHES(USER_EMAIL, TAKEOFF_COUNTRY, TAKEOFF_CITY, LANDING_COUNTRY, LANDING_CITY, FROM_DATE, TO_DATE, FROM_PRICE, TO_PRICE)
                                            VALUES (:mail,
                                                    (SELECT COUNTRY FROM AIRPORTS WHERE CODE=:dep),
                                                    (SELECT AIRPORT_NAME FROM AIRPORTS WHERE CODE=:dep),
                                                    (SELECT COUNTRY FROM AIRPORTS WHERE CODE=:arr),
                                                    (SELECT AIRPORT_NAME FROM AIRPORTS WHERE CODE=:arr),
                                                    TO_DATE(:fromDate,'YYYY-MM-DD'),
                                                    TO_DATE(:toDate,'YYYY-MM-DD'),
                                                    :min_price,
                                                    :max_price)");
    oci_bind_by_name($query,":dep",$_POST['dep']);
    oci_bind_by_name($query,":arr",$_POST['arr']);
    oci_bind_by_name($query,":max_price",$_POST['max_price']);
    oci_bind_by_name($query,":min_price",$_POST['min_price']);
    oci_bind_by_name($query,":fromDate",$_POST['time']);
    oci_bind_by_name($query,":toDate",$_POST['time_max']);
    oci_bind_by_name($query,":mail",$_SESSION['user']['email']);

    oci_execute($query);
    return;
}