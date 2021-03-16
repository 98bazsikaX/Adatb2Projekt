<?php
/*
GET method pelda
*/ 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['testpost'])){
        echo "POST is set\n";
    }else{
        echo "POST is not set\n";
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['test'])){
        echo "GET IS SET\n";
    }else{
        echo "GET is not set\n";
    }
}


/*
API test
frontend megvalositas: ../index.php
*/


?>