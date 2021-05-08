<?php
session_start();
if(isset($_SESSION['user'])){
    include_once '../dotenv/dotenv.php';
    load_env('../dotenv/.env');
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if(!$connection){
        header('Location: /php/userinfo.php');
        return;
    }
    $query = oci_parse($connection,"DELETE FROM SEARCHES WHERE USER_EMAIL=:mail");
    oci_bind_by_name($query,":mail",$_SESSION['user']['email']);
    oci_execute($query);
    header("Location: /php/userinfo.php?id=".$_SESSION['user']['email']);
}
header("Location: /php/login.php");
