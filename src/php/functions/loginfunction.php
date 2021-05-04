<?php
include_once  '../classes/User.php';
include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');
session_start();
if(isset($_POST['login'])){
    $email = $_POST['l_email'];
    $password = $_POST['l_password'];

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

    $query = "SELECT EMAIL,COUNTRY,FIRST_NAME,LAST_NAME,ROLE_ID,PWD FROM USERS WHERE EMAIL=:email_a";

    $result = oci_parse($connection,$query);
    oci_bind_by_name($result,":email_a",$email);

    if(oci_execute($result)){
        $user = new User(1,1,1,1,1);
        while($row = oci_fetch_array($result, OCI_ASSOC)){
            if(password_verify($password,$row['PWD'])){
                $user = new User($row['EMAIL'],$row['COUNTRY'],$row['FIRST_NAME'],$row['LAST_NAME'],$row['ROLE_ID']);
            }else{
                echo "<p>Hibás jelszó</p><br>";
            }
        }
        $_SESSION['user'] = $user;
        echo "Sikeres bejelentkezés<br>";
        echo $_SESSION['user']->toString()."<br>";
    }else{
        echo "Hiba";
        session_abort();
    }

}else{
    session_abort();
}