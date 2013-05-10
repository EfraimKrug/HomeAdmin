<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

echo "<html><body>";
$sql2 = "DROP TABLE Walker";
$sql3 = "CREATE TABLE Walker (	WkFName varchar(15), 
						WkLName varchar(15), 
						WkEMail varchar(25), 
						WkPassword varchar(25),
						WkPicture varchar(50),
						WkBlurblet varchar (1600),
						WkKey smallint NOT NULL AUTO_INCREMENT,
						PRIMARY KEY(WkKey))";
session_start();
$con = mysql_connect("localhost","rofeh_walkathon","winter99");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
echo "<br>Database Connected.";
//Select Database
$result = mysql_select_db("rofeh_walkathon", $con);
if($result){
	echo "<br>Database Selected";
	}
else {
	echo "<br>Database not selected: " . mysql_error();
}
//Drop Table
if (mysql_query($sql2,$con))
  {
  echo $sql2 . " Successful<br>";
  }
else
  {
  echo "<br>Database Error: (" . $sql2 . ")" . mysql_error() .  "<br>";
  }
//Create Table
if (mysql_query($sql3,$con))
  {
  echo $sql3 . " Successful<br>";
  }
else
  {
  echo "<br>Database Error: (" . $sql3 . ")" . mysql_error() . "<br>";
  }

mysql_close($con);
echo "</body></html>";
?>