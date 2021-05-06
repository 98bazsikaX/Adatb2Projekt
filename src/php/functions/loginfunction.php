<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hiba</title>
</head>
<body>
<?php
include_once  '../classes/User.php';
include_once '../dotenv/dotenv.php';
load_env('../dotenv/file.env');
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
                $_SESSION['user'] = $user->toAssoc();
                header("Location: /php/index.php");
            }else{
                echo "<p>Hibás jelszó</p><br>";
                echo "<a href='/php/login.php'>Próbáljon újra bejelentkezni</a>";
            }
        }

    }else{
        echo "<p>Hiba</p>";
        echo "<a href='/php/login.php'>Próbáljon újra bejelentkezni</a>";
    }

}else{
    session_abort();
}
?>
<p>
    Hiba!
</p>
<a href='/php/login.php'>Próbáljon újra bejelentkezni</a>


</body>
</html>
