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
    <header>Belépés</header>
    <!--TODO: ha be van az illető jelentkezve akkor kijelentkezés only, vagy esetleg az adatainak szerkesztése,flex implementálása,aka session-->
    <div id="common">
        <div id="reg">
            <h2>Regisztráció</h2>
            <form>
                <label for="r_email">Email:</label>
                <input type="email"  id="r_email" autocomplete="on" required>
                <br>
                <label for="r_password">Jelszó:</label>
                <input type="password" id="r_password" autocomplete="on" required>
                <br>
                <label for="pwd_again">Jelszó megerősítése:</label>
                <input type="password" id="pwd_again" autocomplete="on" required>
                <br>
                <label for="first_name">Keresztnév: </label>
                <input type="text" id="first_name" name="first_name" required>
                <br>
                <label for="last_name">Vezetéknév: </label>
                <input type="text" id="last_name" name="last_name" required>
                <br>
                <label for="phonenum">Telefonszám: </label>
                <input type="tel" id="phonenum" name="phonenum" required>
                <br>
                <label for="bday">Születés dátuma: </label>
                <input type="date" id="bday" name="bday" required>
                <br>
                <label for="country">Ország: </label>
                <select id="country" name="country" required></select>
                <br>
                <label for="city">Város: </label>
                <input type="text" name="city" id="city" required>
                <br>
                <label for="address">Utca/Házszám: </label>
                <input type="text" id="address" name="address" required>
                <input type="submit" value="Regisztráció">
            </form>

        </div>
        <div id="login">
            <h2>Belépés</h2>
                <form>
                    <label for="l_email">Email:</label>
                    <input type="email" id="l_email" autocomplete="on" required>
                    <br>
                    <label for="l_password">Jelszó:</label>
                    <input type="password" id="l_password" autocomplete="on" required><br>
                    <input type="submit" value="Bejelentkezés">
                </form>
        </div>    
    </div>
</body>
</html>