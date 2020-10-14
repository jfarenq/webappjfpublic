<?php
ini_set('display_errors','on');
error_reporting (E_ALL);
//$host_name = "webappjf-backend-service";
//$database = "jvernedb"; // Change your database name
//$username = "postgres";          // Your database user id
//$password = "bonjour";          // Your password
$host_name = "$PGSQL_HOST";
$database = "$PGSQL_DBNAME";
$username = "$PGSQL_PASSWORD";
$password = "$PGSQL_USERNAME";

//////// Do not Edit below /////////
try {

$dbo = new PDO("pgsql:host=$host_name dbname=$database user=$username password=$password");
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>
