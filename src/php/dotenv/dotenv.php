<?php
/*
input: $path : a .env file bemeneti helye

Ez a file include utan betolti a $_ENV valtozoba a .env file tartalmat
ezaltal nem kell a scriptekben tarolni az adatbazishoz valo kapcsolodas parametereit
a .env file gitignoralt, a .env filet mindenki maganak csinalja 

returns: boolean, az alapjan hogy sikeresen lefutott e
*/


function load_env($path){

if(!is_readable($path)){
    return false;
}

$lines = file($path,FILE_IGNORE_NEW_LINES |FILE_SKIP_EMPTY_LINES);

foreach($lines as $line){
    $_ENV[trim(explode("=",$line)[0])] = trim(explode("=",$line)[1]);
}

return true;
}

?>