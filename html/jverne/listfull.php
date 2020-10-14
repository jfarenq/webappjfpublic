<html>

<head>
    <title>The Jules Verne's book DB</title>
    <link rel="stylesheet" href="/css/jverne.css" type="text/css">
</head>

<body>

<h4>LEPP (Linux, Nginx, PHP, PostgreSQL) Sample Page</h4>
<hr/>
<p>Hello and welcome. This web page is dynamically showing a product list from a PostgreSQL database
<a href="/index.html" class="btn1">Return to home</a>
</p>
<hr/>
<?php
ini_set('display_errors','on');
error_reporting (E_ALL);
//$db = pg_connect("host=10.7.28.145 port=5432 dbname=jvernedb user=postgres password=bonjour")
//
//include "./pdodbconfig.php"; // Database connection using PDO
//
$host_name = "localhost";
$database = "jvernedb";
$username = "postgres";
$password = "postgres";


    $con = pg_connect("host=$host_name port=5432 dbname=$database user=$username password=$password")
            or die ("Could not connect to server\n");

    $query = "SELECT * FROM book order by jvid";
    $resultset = pg_query($con, $query) or die("Cannot execute query: $query\n");
    $rowcount = pg_numrows($resultset);

    for($index = 0; $index < $rowcount; $index++) {
            $row = pg_fetch_array($resultset, $index);
            echo $row["jvid"] , " - ", $row["etitle"];
            echo "<br>";
    }
?>
</br>
<!-- <a href="/jverne/jverne.html"><b>HOME</b></a> -->
<a href="/index.html" class="btn1">Return to home</a>
</body>
</html>
