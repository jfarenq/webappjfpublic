<?php
ini_set('display_errors','on');
error_reporting (E_ALL);
//http://www2.hawaii.edu/~takebaya/cent285/postgresql_sql_php/postgresql_sql_php.html
//include "/jverne/pdodbconfig.php"; // Database connection using PDO
//include "./pdodbconfig.php"; // Database connection using PDO
$host_name = "localhost";
$database = "jvernedb";
$username = "postgres";
$password = "postgres";
$con = pg_connect("host=$host_name port=5432 dbname=$database user=$username password=$password")
        or die ("Could not connect to server\n");


/echo "Test";

//$sql="SELECT ftitle,year FROM book order by year";
//$sql="SELECT ftitle,year FROM book order by jvid";
$sql="SELECT ftitle,year FROM book";
//  $statement = $pdo->query($sql);
echo "<select ftitle=book value=''>ftitle</option>";

foreach ($dbo->query($sql) as $row){

echo "<option value=$row[jvid]>$row[ftitle]</option>";
//echo "<option value=$row[year]>$row[year],$row[ftitle]</option>";
//echo "$row[id] , $row[ftitle]<br>";
//echo "$row [year] , $row[ftitle]<br>";


}

 echo "</select>";// Closing of list box


?>
