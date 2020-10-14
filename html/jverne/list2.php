<html>
<head>
        <meta charset="UTF-8">
        <title>The Jules Verne's book DB</title>
        <link rel="stylesheet" href="/css/jverne.css" type="text/css">
</head>
<body>

<body background="/jverne/img/water1.jpg">


<h4>LEPP (Linux, Nginx, PHP, PostgreSQL) Sample Page</h4>
<hr/>
<p>Hello and welcome. This web page is dynamically showing a product list from a PostgreSQL database</p>
<a href="/index.html" class="btn1">Return to home</a>
<br>

<div>
<?php
ini_set('display_errors','on');
error_reporting (E_ALL);
//http://www2.hawaii.edu/~takebaya/cent285/postgresql_sql_php/postgresql_sql_php.html
//  $pdoString = "pgsql:host=10.7.28.145 dbname=jvernedb user=postgres password=bonjour";
//  $pdoString = "pgsql:host=webappjf-backend-service dbname=jvernedb user=postgres password=postgres";
//  $pdo = new PDO($pdoString);
//  if (!$pdo) {
//    die("Could not connect");
//  }
include "./pdodbconfig.php";

  $sql = "select * from book order by jvid";
  $statement = $pdo->query($sql);
  $display = "    <table border=\"1\">\n";
  $display .= "<td><center><b>" . "index" . "</b></center></td>" . "<td><center><b>" . "English Title" . "</b></center></td>" . "<td><center><b>" . "French Title" . "</b></center></td>" . "<td><center><b>" . "Author" . "</b></center></td>" ."<td><center><b>" . "Year" . "</b></center></td>\n";
  while (($row = $statement->fetch(PDO::FETCH_ASSOC))) {
    $display .= "      <tr>\n";
    $display .= "        <td>" . $row["jvid"] . "</td>\n";
    $display .= "        <td>" . $row["etitle"] . "</td>\n";
    $display .= "        <td>" . $row["ftitle"] . "</td>\n";
    $display .= "        <td>" . $row["author"] . "</td>\n";
    $display .= "        <td>" . $row["year"] . "</td>\n";
    $display .= "      </tr>\n";
  }
  $display .= "</table>\n";
  echo $display;

//  $display2 = "<a href=" . "/jverne/jverne.html" . ">" . "<b>" . "HOME display2" . "</b></a>";
//  echo $display2;

//  echo '<br><a href="/jverne/jverne.html">Click here</a>';

//  echo "<br>";
//  echo "<a href=" . "/jverne/jverne.html" . ">" . "<b>" . "HOME" . "</b></a>";

?>
</div>
</br>
<!-- <a href="/jverne/jverne.html"><b>HOME</b></a> -->
<a href="/index.html" class="btn1">Return to home</a>

</body>
</html>

