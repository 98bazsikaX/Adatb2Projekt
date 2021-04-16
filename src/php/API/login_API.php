<?php

/*
 * megnezni hogy application/json-e a request a biztonsag kedveert
 */

if($_SERVER['CONTENT_TYPE'] != 'application/json'){
    header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error');
    exit();
}


echo trim(file_get_contents("php://input"));

