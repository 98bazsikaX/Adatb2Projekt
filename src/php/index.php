<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS Tours</title>
    <link rel="stylesheet" href="../resources/stylesheets/global.css">

</head>
<body>
    <header>
        Üdvözöljük a Szlavikovics - Sárossy - Szombati utazási iroda weboldalán.
    </header>

    <?php
    session_start();
        if(isset($_SESSION['user'])){
            echo $_SESSION['user']['email'];
        }

    ?>
    <footer>
        All rights reserved
    </footer>

</body>
</html>