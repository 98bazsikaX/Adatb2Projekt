<?php
include_once 'dotenv/dotenv.php';
load_env('dotenv/.env');
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

session_start();
if(!isset($_SESSION['user'])  ||intval($_SESSION['user']['role'])!=5){
    header("Location:/php/login.php");
}
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
  stz <label class ='labname' id="fnumber"><?php echo $_POST['fnumber']; ?> járat </label>"
   <br>
  <label class ="labname" for="r_email">Email:</label>
  <br>
   <input  class ="inaname" type="email"  id="r_email" autocomplete="on" required>
  <br>
   <label class ="labname" >fő: </label>
 <br>
 <input class ="inaname" type="number" name="person" id="person" required>
   <br>
   <button class ="but"onclick="makeTicket()" value="Vásárlás">Vásárlás</button>
  </div>

 </div>

</body>
</html>