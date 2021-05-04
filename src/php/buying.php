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

    <!--Scripts -->
    <script src="../javascript/reg_frontend.js"></script>

</head>
<body onload="main()"><div>
<div>
    <label class ="labname" for="r_email">Email:</label>
    <br>
    <input  class ="inaname" type="email"  id="r_email" autocomplete="on" required>
    <br>

    <label  >fő: </label>
    <br>
    <input class ="inaname" type="text" name="city" id="city" required>
    <br>
    <label  >járat: </label>
    <br>
    <label for="airline_select">Repülő: </label>
    <br>
    <select id="airline_select" name="airline_select">
        <br>
        </div>
    <input  type="submit" value="Vásárlás">
</div>
</body>
</html>