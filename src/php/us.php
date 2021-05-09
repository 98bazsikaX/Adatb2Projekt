<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS Tours</title>
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <link rel="stylesheet" href="../resources/stylesheets/us.css">


</head>
<body>
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
<div class="Row">
<div class="Column" >
    <h1> Szlavikovics Máté</h1>
    <h2>KR6M7V</h2>
    <h2>Programtervező informatikus</h2>
    <img src="img/Máté.jpg" alt="Máté" width="350" height="400">
    <h4 class="p">Máté egy rejtélyes prógamozó keveset tudni róla de egy biztos ő is imádja az online oktatást.</h4>

</div>
<div class="Column" >
     <h1> Szombati Balázs</h1>
    <h2>Z5KC4K</h2>
    <h2>Mérnökinformatikus BSc_N</h2>
    <img src="img/Balazs.jpg" alt="Balázs" width="300" height="400">
    <h4 class="p">Balázs egy igazi kis Script Matyi, ő is fantasztikas el van az online oktatásban.</h4>
</div>
<div class="Column" >
    <h1> Sárossy Bence</h1>
    <h2>JES7V1</h2>
    <h2>Mérnökinformatikus BSc_N</h2>
    <img src="img/Bence.jpg" alt="Bence" width="300" height="400">
    <h4 class="p">Bence egy igazán színes egyéniség és rendkívűl élvezi az online oktatás gyönyöreit. </h4>



</div>
</div>
</body>
</html>
