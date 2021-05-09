<?php
session_start();
include_once 'dotenv/dotenv.php';
load_env('./dotenv/.env');
$fid=$_GET['id'];
$_SESSION['fid']=$fid;
$mail=$_SESSION['user']['email'];



$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
$query = oci_parse($connection,"SELECT USERS.birth_date FROM USERS WHERE USERS.email=:mail");
oci_bind_by_name($query,":mail",$mail);

oci_execute($query);
while($row = oci_fetch_array($query)){
    $_SESSION['birth']=$row['BIRTH_DATE'];
}





var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="hu">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vásárlás</title>

    <!--Stylesheets-->
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <link rel="stylesheet" href="../resources/stylesheets/buying.css">





</head>
<body onload="main()">
<div id="main">
    <form method="get" action="API/buyingAPI.php">
   <label class ="labname" >fő: </label>
 <br>
 <input class ="inaname" type="number" name="quantity" id="quantity" min="1" value="1" required>
   <br>

   <input type="submit" class ="but" value="Vásárlás">
  </div>
</form>
 </div>

</body>
</html>