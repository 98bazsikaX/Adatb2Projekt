<?php
if(isset($_POST['airlines'])){
    //echo "<p>mukodik lol</p>";
    $connection = oci_connect("Szombati","1234","localhost:1521/XE");
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
}

