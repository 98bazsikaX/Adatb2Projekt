<?php

include_once 'dotenv/dotenv.php';
include '../php/functions/userdataForBuying.php';

load_env('./dotenv/.env');

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
    <form method="post" action="API/buyingAPI.php">
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