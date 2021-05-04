<?php
include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');

if(isset($_POST['registration'])){
    $email = $_POST['r_email'];
    $password = $_POST['r_password'];
    $passwordAgain = $_POST['pwd_again'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phonenum'];
    $bday = $_POST['bday'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $role = 0;

    if($password!=$passwordAgain){
        echo "nem ugyanaz a ket jelszo"; //todo: jobb implementalas
        return;
    }

    $password = password_hash($password,PASSWORD_BCRYPT);
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

    $query = "INSERT INTO USERS(EMAIL, PWD, PHONE_NUM, FIRST_NAME, LAST_NAME, BIRTH_DATE, COUNTRY, POST_CODE, CITY, HOME_ADDRESS, ROLE_ID) VALUES (:email,:password,:phone,:firstname,:lastname,TO_DATE(:birthdate,'YYYY-MM-DD'),:country,:postcode,:city,:address,:role)";

    $result = oci_parse($connection,$query);

    oci_bind_by_name($result,":email",$email);
    oci_bind_by_name($result,":password",$password);
    oci_bind_by_name($result,":phone",$phone);
    oci_bind_by_name($result,":firstname",$first_name);
    oci_bind_by_name($result,":lastname",$last_name);
    oci_bind_by_name($result,":birthdate",$bday);
    oci_bind_by_name($result,":country",$country);
    oci_bind_by_name($result,":postcode",$postcode);
    oci_bind_by_name($result,":city",$city);
    oci_bind_by_name($result,":address",$address);
    oci_bind_by_name($result,":role",$role);

    if(oci_execute($result)===false){
        var_dump(oci_error($result));
    }else{
        echo "Sikeres regisztrácio :D";
    }
}