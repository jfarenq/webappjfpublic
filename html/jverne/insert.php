<?php
//set the debug parameters
ini_set('display_errors','on');
error_reporting (E_ALL);

//start the motor
switchboard();

function switchboard(){
    if (isset($_POST['submit'])){
        processForm();
    }
    displayForm();
}


function displayForm(){
    echo <<<HTML
<html>
<head>
<title>Create book data</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/css/jverne.css" type="text/css">
<style>
li {listt-style: none;}
</style>
</head>
<body>
<h2>Enter new book information</h2>
<ul>
<!-- <form name="insert" action="insert.php" method="POST" >
 <form action="{$_SERVER['PHP_SELF']}" method="POST"> -->
<form action="insert.php" method="POST">
<li>French Book Title:</li><input type="text" name="ftitle" />
<li>English Book Title:</li><input type="text" name="etitle" />
<li>Author:</li><input type="text" name="author" />
<li>Year:</li><input type="number" name="year" />
<br><br><input type="submit" name="submit" value="Save" />
</form>
</ul>
</body>
</html>
HTML;
}

function processForm(){
    //connect to the database
ini_set('display_errors','on');
error_reporting (E_ALL);
//$db = pg_connect("host=10.7.28.145 port=5432 dbname=jvernedb user=postgres password=bonjour") or die ("Could not connect to server\n");
$host_name = "localhost";
$database = "jvernedb";
$username = "postgres";
$password = "postgres";
$db = pg_connect("host=$host_name port=5432 dbname=$database user=$username password=$password") or die ("Could not connect to server\n");
if (!$db) {
  echo "An error occurred connect.\n";
  exit;
}

$query = "INSERT INTO book (ftitle,etitle,author,year) VALUES ('$_POST[ftitle]','$_POST[etitle]', '$_POST[author]','$_POST[year]')";
$result = pg_query($db, $query);
if (!$result) {
  die("Error in SQL query: " . pg_last_error());
}
else
{
  echo "Saved";
}
}
?>
<a href="/index.html" class="btn1">Return to home</a>
