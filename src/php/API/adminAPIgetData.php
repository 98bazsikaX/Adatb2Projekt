<?php


include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');


if(isset($_POST['airlines'])){
    //echo "<p>mukodik lol</p>";
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if(!$connection){
        exit(420);
    }
    $query = oci_parse($connection,"SELECT * FROM AIRLINES");
    oci_execute($query);

    echo "<table>\n";
    while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
}else if(isset($_POST['flights'])){

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if (!$connection) {
        exit(420);
    }
    $query = oci_parse($connection, "SELECT * FROM FLIGHTS");
    if(oci_execute($query)){
    echo "<table>\n";
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
    }else{
        http_response_code(503);
    }

}else if(isset($_POST['planes'])){
    //SELECT airplanes.airplane_id , airplanes.airplane_type ,airplanes.capacity , airlines.airline_name  FROM AIRPLANES INNER JOIN AIRLINES ON airplanes.airline_code=airlines.code
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if (!$connection) {
        exit(420);
    }
    $query = oci_parse($connection, "SELECT airplanes.airplane_id , airplanes.airplane_type ,airplanes.capacity , airlines.airline_name  FROM AIRPLANES INNER JOIN AIRLINES ON airplanes.airline_code=airlines.code");
    if(oci_execute($query)){
        echo "<table>\n";
        while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>\n";
            foreach ($row as $item) {
                echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }else{
        http_response_code(503);
    }
}else if(isset($_POST['discount'])){
    echo "<p>learazasok</p>";
}

