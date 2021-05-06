<?php
include_once 'dotenv/dotenv.php';
load_env('dotenv/.env');
$connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);

session_start();

if(!isset($_SESSION['user']) || $_GET['id']!=$_SESSION['user']['email']){
    header('Location: login.php');
    return;
}
$session_id = $_SESSION['user']['email'];
echo "<input type='hidden' id='SessionEmail' value='$session_id'>";

if(!isset($_SESSION['user'])  ||intval($_SESSION['user']['role'])!=5){
    header("Location:/php/login.php");
	return;
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
<div class="topnav">
    <a href="login.php">regisztráció/bejelentkezés</a>
    <a href="admin.php">admin</a>
    <a href="info.php">infók</a>
    <a href="search.php">keresés</a>
    <a href="us.php">rólunk</a>
    <?php
    if(isset($_SESSION['user'])){
        $id = $_SESSION['user']['email'];
        echo "<a href='userinfo.php?id=$id'>Profilom</a>";
        echo "<a href='buying.php?id=$id'>jegy vásárlás</a>";
    }
    ?>

</div>
<div id="main">
    <select class ="inaname" id="flight" name="flight">
        <?php
        $query = oci_parse($connection,"SELECT CODE , AIRLINE_NAME FROM  ");
        oci_execute($query);

        while($row = oci_fetch_array($query,OCI_ASSOC+OCI_RETURN_NULLS)){
            $code = $row[''];
            $name = $row['AIRLINE_NAME'];
            echo "<option class='airline_option' value='$code'>$name</option>";
        }


        ?>
    </select>
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