<?php

include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');

if(isset($_POST['search'])){
    //TODO: jobb lekerdezes+json api-ra attervezes
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if(!$connection){
        exit(420);
    }
    $arr = $_POST['arr'];
    $dep = $_POST['dep'];
    $query = oci_parse($connection,"SELECT * FROM FLIGHTS WHERE TAKEOFF_AIRPORT_CODE = '$dep' AND LANDING_AIRPORT_CODE='$arr'");

    oci_execute($query);

    echo "<table>\n";
    $header = false;
    while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
        if ($header == false) {
            // this is the first iteration of the while loop so output the header.
            print '<thead><tr>';
            foreach (array_keys($row) as $key) {
                print '<th>'.($key !== null ? htmlentities($key, ENT_QUOTES) :
                        '').'</th>';
            }
            print '</tr></thead>';

            $header = true; // make sure we don't output the header again.
        }
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        $id =$row['ID'];
        echo "    <td> <a href='buying.php?id=$id'>jegy vásárlás</a> </td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";


}