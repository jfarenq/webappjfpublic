<!DOCTYPE html>
 <head>  <title>Update data from book id</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="/css/jverne.css" type="text/css">
 <style>
li {list-style: none;}
</style>
</head>
<body>
<h2>Enter bookid to update and enter</h2>
<ul>
<form name="display" action="enter-bookid.php" method="POST" >
<li>Book ID:</li><li><input type="text" name="jvid" /></li>
<li><input type="submit" name="submit" value="Search" /></li>
</form>
</ul>
</body>
</html>
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
$db = pg_connect("host=$host_name port=5432 dbname=$database user=$username password=$password")
or die ("Could not connect to server\n");
if (isset($_POST['submit']))
{
  $result = pg_query($db, "SELECT * FROM book where jvid = '$_POST[jvid]'");
  $row = pg_fetch_assoc($result);
echo "<ul>
<form name='update' action='enter-bookid.php' method='POST' >

<li>Book ID:</li><li><input type='text' name='jvid_updated' value='$row[jvid]'  /></li>
<li>French Book Name:</li><li><input type='text' name='ftitle_updated' value='$row[ftitle]' /></li>
<li>English Book Name:</li><li><input type='text' name='etitle_updated' value='$row[etitle]' /></li>
<li>Author:</li><li><input type='text' name='author_updated' value='$row[author]' /></li>
<li>Year of publication:</li><li><input type='number' name='year_updated' value='$row[year]' /></li>
<li><input type='submit' name='update' value='update' /></li>  </form>
</ul>";
}
if (isset($_POST['update']))
{
$result1 = pg_query($db, "UPDATE book SET ftitle = '$_POST[ftitle_updated]',
etitle = '$_POST[etitle_updated]', author = '$_POST[author_updated]',
year = '$_POST[year_updated]' WHERE jvid = '$_POST[jvid_updated]'");

if (!$result1)
{
#  die("Error in SQL query: " . pg_last_error());
  echo "<br>Update failed!!</br>";
} else
{
echo "Update successfull;";
}
}
?>
<a href="/index.html" class="btn1">Return to home</a>
