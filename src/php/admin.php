<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../javascript/adminFrontend.js"></script>
    <link rel="stylesheet" href="../resources/stylesheets/global.css">
    <title>Admin</title>
</head>
<body onload="main()">
<!-- TODO: megoldani hogy tényleg csak admin lephessen be xd -->

<div id="addFlight">
    <!-- List flights -->
    <?php
        $connection = oci_connect("Szombati","1234","localhost:1521/XE");
        if(!$connection){
            exit(420);
        }
        $query = oci_parse($connection,"SELECT * FROM FLIGHTS");
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

    ?>

</div>
<div id="airline">
    <div id="airlinesTable">

    </div>
    <!-- Mező airline beillesztésére -->
    <div id="addAirline">
        <form id="airlineForm">
            <label for="AirlineCode">Légitársaság kódja: </label><br>
            <input type="text" id="AirlineCode" name="AirlineCode"><br>
            <label for="name">Légitársaság neve: </label><br>
            <input type="text" id="name" name="name"><br>
            <label for="abr">Rövidítés: </label><br>
            <input type="text" id="abr" name="abr"><br>
            <label for="country">Ország:</label><br>
            <input type="text" id="country" name="country">
        </form>
        <button onclick="setAirline()">Elküldés</button>
    </div>
</div>
<div id="addAirPlane">

</div>
<div id="addDiscount">

</div>


</body>
</html>