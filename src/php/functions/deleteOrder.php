<?php
session_start();
if(isset($_SESSION['user']) && isset($_GET['id']) && isset($_GET['session']) && $_SESSION['user']['email'] == $_GET['session']){
    include_once '../dotenv/dotenv.php';
    load_env('../dotenv/file.env');
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if(!$connection){
        header('Location: /php/userinfo.php');
        return;
    }

    $query = oci_parse($connection,"UPDATE PURCHASES SET PURCHASE_STATE=:deleted WHERE USER_EMAIL=:email AND ID=:id AND PURCHASE_STATE!=:forbidden_state");
    $deleted_state=2;
    oci_bind_by_name($query,":deleted",$deleted_state);
    oci_bind_by_name($query,":email",$_GET['session']);
    oci_bind_by_name($query,":id",$_GET['id']);
    $forbiddenState = 3;
    oci_bind_by_name($query,":forbidden_state",$forbiddenState);
    if(oci_execute($query)){
        oci_commit($connection);
        header('Location: /php/userinfo.php?id='.$_SESSION['user']['email']);
        return;
    }else{
        echo "Hiba történt, próbálja meg később!";
    }
}
