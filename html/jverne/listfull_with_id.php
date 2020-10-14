<html>

<head>
    <title>The Jules Verne's book DB</title>
</head>

<body>

<h4>LEPP (Linux, Nginx, PHP, PostgreSQL) Sample Page</h4>
<hr/>
<p>Hello and welcome. This web page is dynamically showing a product list from a PostgreSQL database</p>

<?php
//include "./pdodbconfig.php"; // Database connection using PDO
$host_name = "localhost";
$database = "jvernedb";
$username = "postgres";
$password = "postgres";


    $con = pg_connect("host=$host_name port=5432 dbname=$database user=$username password=$password")
            or die ("Could not connect to server\n");

    $query = "SELECT * FROM book";
    $resultset = pg_query($con, $query) or die("Cannot execute query: $query\n");
    $rowcount = pg_numrows($resultset);

    for($index = 0; $index < $rowcount; $index++) {
            $row = pg_fetch_array($resultset, $index);
            echo $row["jvid"], "  - ", $row["etitle"];
            echo "<br>";
    }
?>
</br>
<a href="/jverne/jverne.html"><b>HOME</b></a>
</body>
</html>
