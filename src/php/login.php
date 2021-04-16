<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belépés</title>
    <link rel="stylesheet" href="../stylesheets/global.css">
    <script src="../javascript/reg_frontend.js"></script>
    <style>
        header{
            width: 100%;
            height: fit-content;
        }
        .common{
            width: 80%;
            border: 1px solid black;
            overflow: hidden; /* will contain if #first is longer than #second */
            display: inline-flex;
        }
        .reg{
            width: 50%;
            border: 1px solid red;
        }
        .login{
            width: 50%;
            border: 1px solid green;
            
        }

    </style>
</head>
<body>
    <header>Belépés</header>
    <!--Adnám ha  akettő div egymás mellett lenne :) TODO: megcsinálni 
    TODO: ha be van az illető jelentkezve akkor kijelentkezés only, vagy esetleg az adatainak szerkesztése
    -->
    <div id="common">
        <div id="reg">
            <h2>Regisztráció</h2>
            <form>
                <label for="r_email">Email:</label>
                <input type="email" id="r_email" autocomplete="on">
                <br>
                <label for="r_password">Jelszó:</label>
                <input type="password" id="r_password" autocomplete="on">
                <br>
                <label for="pwd_again">Jelszó megerősítése:</label>
                <input type="password" id="pwd_again" autocomplete="on">
                <br>
            </form>

            <button onclick="register()">Nyomj ram lol</button>
                
        </div>
        <div id="login">
            <h2>Belépés</h2>
                <form>
                    <label for="l_email">Email:</label>
                    <input type="email" id="l_email" autocomplete="on">
                    <br>
                    <label for="l_password">Jelszó:</label>
                    <input type="password" id="l_password" autocomplete="on">
                </form>


        </div>    
    </div>
</body>
</html>