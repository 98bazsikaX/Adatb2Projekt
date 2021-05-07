<?php


include_once '../dotenv/dotenv.php';
load_env('../dotenv/.env');

if(isset($_POST['airlines'])){
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if(!$connection){
        exit(420);
    }
    $query = oci_parse($connection,"SELECT * FROM AIRLINES");

    include_once '../classes/airline.php';
    $toEcho = [];

    if(oci_execute($query)){
        while($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)){
            $code = $row['CODE'];
            $name = $row['AIRLINE_NAME'];
            $country = $row['COUNTRY'];
            $abbr = $row['AIRLINE_NAME_ABBR']==null?"":$row['AIRLINE_NAME_ABBR'];
            $ap = new airlines($code,$name,$country,$abbr);
            array_push($toEcho,$ap->jsonEncode());
        }
    }
    echo json_encode($toEcho);

}else if(isset($_POST['flights'])){

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if (!$connection) {
        exit(420);
    }
    $query = oci_parse($connection, "SELECT * FROM FLIGHTS");
    if(oci_execute($query)){
    echo "<table>\n";
    $header = false;
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {

        if ($header == false) {
            // this is the first iteration of the while loop so output the header.
            echo '<thead><tr>';
            foreach (array_keys($row) as $key) {
                print '<th>'.($key !== null ? htmlentities($key, ENT_QUOTES) :
                        '').'</th>';
            }
            echo '</tr></thead>';

            $header = true; // make sure we don't output the header again.
        }
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
    $query = oci_parse($connection, "SELECT airplanes.airplane_id , airplanes.airplane_type ,airplanes.capacity , airlines.airline_name,AIRLINE_CODE,ID  FROM AIRPLANES INNER JOIN AIRLINES ON airplanes.airline_code=airlines.code ORDER BY AIRLINE_NAME desc,airplanes.airplane_id");
    $toEcho = [];
    if(oci_execute($query)){
        while($row = oci_fetch_array($query)){
            //var_dump($row);
            $apid = $row['AIRPLANE_ID'];
            $aptype = $row['AIRPLANE_TYPE'];
            $cap = $row['CAPACITY'];
            $name = $row['AIRLINE_NAME'];
            $arcode = $row['AIRLINE_CODE'];
            $id = $row['ID'];
            $topush = array("airplane_id"=>$apid,"type"=>$aptype,"capacity"=>$cap,"airline_name"=>$name,"airline_code"=>$arcode,"id"=>$id);
            array_push($toEcho,json_encode($topush));
        }
        echo json_encode($toEcho);
    }else{
        http_response_code(503);
    }

}else if(isset($_POST['discount'])){
    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if (!$connection) {
        exit(420);
    }

    $query = oci_parse($connection,"SELECT * FROM DISCOUNTS INNER JOIN FLIGHTS ON discounts.flight_id=flights.id");
    if(oci_execute($query)){
        echo "<table>\n";
        $header = false;
        while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
            if ($header == false) {
                // this is the first iteration of the while loop so output the header.
                echo '<thead><tr>';
                foreach (array_keys($row) as $key) {
                    print '<th>'.($key !== null ? htmlentities($key, ENT_QUOTES) :
                            '').'</th>';
                }
                echo '</tr></thead>';

                $header = true; // make sure we don't output the header again.
            }
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
}else if(isset($_POST['airport'])){
    include '../classes/airport.php';

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if (!$connection) {
        exit(420);
    }
    $query = oci_parse($connection, "SELECT * FROM AIRPORTS");
    $toEcho = [];
    if(oci_execute($query)){
        while($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)){

            $code = $row['CODE'];
            $name = $row['AIRPORT_NAME'];
            $country = $row['COUNTRY'];
            $city = $row['CITY'];
            $ap = new airport($code,$name,$country,$city);
            array_push($toEcho,$ap->jsonEncode());
        }
    }
    echo json_encode($toEcho);

}else if(isset($_POST['users'])){

    $connection = oci_connect($_ENV['DATABASE_USERNAME'],$_ENV['DATABASE_PASSWORD'],$_ENV['DATABASE_LOCATION']);
    if (!$connection) {
        exit(420);
    }
    $query = oci_parse($connection, "SELECT r.ROLE_NAME, users.EMAIL, users.FIRST_NAME , users.LAST_NAME , users.country , users.CITY FROM USERS INNER JOIN ROLES R on USERS.ROLE_ID = R.ID");
    if(oci_execute($query)){
        $header = false;
        echo "<table>\n";
        while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
            if ($header == false) {
                // this is the first iteration of the while loop so output the header.
                echo '<thead><tr>';
                foreach (array_keys($row) as $key) {
                    print '<th>'.($key !== null ? htmlentities($key, ENT_QUOTES) :
                            '').'</th>';
                }
                echo '</tr></thead>';

                $header = true; // make sure we don't output the header again.
            }
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
}

