<?php
session_start();

//ebbe a playerét

include_once './dotenv/dotenv.php';
load_env('./dotenv/.env');
if(!isset($_SESSION['user'])){
    header('Location: login.php');
    return;
}
$session_id = $_SESSION['user']['email'];
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

$query = "SELECT * FROM USERS WHERE EMAIL=:mail";
$parsed = oci_parse($connection,$query);
oci_bind_by_name($parsed,":mail",$_SESSION['user']['email']);

if(oci_execute($parsed)){
    while($row = oci_fetch_array($parsed)) {
        $email = $row['EMAIL'];
        $first = $row['FIRST_NAME'];
        $last = $row['LAST_NAME'];
        $birth = $row['BIRTH_DATE'];
    }
}


