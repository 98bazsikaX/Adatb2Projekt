<?php
session_start();

$isSession = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belépés</title>

<!--Stylesheets-->
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <link rel="stylesheet" href="../resources/stylesheets/reg.css">

<!--Scripts -->
    <script src="../javascript/reg_frontend.js"></script>

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

    }
    ?>

</div>

    <!--TODO: ha be van az illető jelentkezve akkor kijelentkezés only, vagy esetleg az adatainak szerkesztése,flex implementálása,aka session-->
   <div id="common">
        <div id="reg">
            <h1>Regisztráció</h1>
            <form method="post" action="./functions/regfunction.php">
                <label class ="labname" for="r_email">Email:</label>
                <br>
                <input  class ="inaname" type="email"  id="r_email" name="r_email" autocomplete="on" required>
                <br>
                <label  class ="labname" for="r_password">Jelszó:</label>
                <br>
                <input  class ="inaname" type="password" id="r_password" name="r_password" autocomplete="on" required>
                <br>
                <label  class ="labname" for="pwd_again">Jelszó megerősítése:</label>
                <br>
                <input class ="inaname" type="password" name="pwd_again" id="pwd_again" autocomplete="on" required>
                <br>
                <label  class ="labname" for="first_name">Keresztnév: </label>
                <br>
                <input class ="inaname" type="text" id="first_name" name="first_name" required>
                <br>
                <label  class ="labname" for="last_name">Vezetéknév: </label>
                <br>
                <input class ="inaname" type="text" id="last_name" name="last_name" required>
                <br>
                <label  class ="labname" for="phonenum">Telefonszám: </label>
                <br>
                <input class ="inaname"class ="inaname" type="tel" id="phonenum" name="phonenum" required>
                <br>
                <label  class ="labname" for="bday">Születés dátuma: </label>
                <br>
                <input class ="inaname" type="date" id="bday" name="bday" required>
                <br>
                <label  class ="labname" for="country">Ország: </label>
                <br>
                <select class ="inaname" id="country" name="country" required></select>
                <br>
                <label  class ="labname" for="city">Város: </label>
                <br>
                <input class ="inaname" type="text" name="city" id="city" required>
                <br>
                <label for="postcode">Postcode:</label>
                <br>
                <input type="text" name="postcode" id="postcode" class="inaname">
                <br>
                <label  class ="labname" for="address">Utca/Házszám: </label>
                <br>
                <input class ="inaname" type="text" id="address" name="address" required>
                <br>
                <input  class="but" name="registration" type="submit" value="Regisztráció"
                    <?php
                    if($isSession){
                        echo "disabled";
                    }
                    ?>
                >
            </form>

        </div>
        <div id="login">
            <h1>Belépés</h1>
                    <form  method="post" action="./functions/loginfunction.php">
                    <label class ="labname" for="l_email">Email:</label>
                    <input class ="inaname" type="email" name="l_email" id="l_email" autocomplete="on" required>
                    <br>
                    <label class ="labname" for="l_password">Jelszó:</label>
                    <input class ="inaname" type="password" id="l_password" name="l_password" autocomplete="on" required><br>
                    <input class="but" type="submit" value="Bejelentkezés" name="login"
                        <?php
                            if($isSession){
                                echo "disabled";
                            }
                        ?>
                    >
                    <?php
                    if($isSession){
                        echo'<div id="logout"><a href="functions/logout.php">Kilépés</a></div>';
                    }
                    ?>
                </form>

        </div>

    </div>

</body>
</html>