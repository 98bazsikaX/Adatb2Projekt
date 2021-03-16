<?php
/*
API test
frontend megvalositas: ../index.php
*/ 
/* if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['testpost'])){
        echo "POST is set\n";
        //exit(0);
    }else{
        echo "POST is not set\n";
        //exit(0);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['test'])){
        echo "GET IS SET\n";
        //exit(0);
    }else{
        echo "GET is not set\n";
        //exit(0);
    }
} */
 /* teszt kod csak ugy,nézegetheto, kommentelheto,torolheto, JSON echo-ra */
include '../classes/airline.php';
$asd = new airlines("0x32","Wizzair","Europe","#123456");
echo   $asd->jsonEncode();
?>