<?php
$FirstName = $_GET["FirstName"]; 
$LastName = $_GET["LastName"]; 
//$Email = $_GET["Email"]; 
echo "<br>... " . $FirstName . "><" . $LastName . ">><BR>";
$sql = "SELECT * FROM Contractor WHERE FirstName = '" . $FirstName . "' AND LastName = '" . $LastName . "'; ";
 
$sql1 = "SELECT * FROM Contractor WHERE " . 
		"FirstName ='" . $FirstName . "' AND LastName='" . $LastName . "';";
//Connect to the database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//Select the database
mysql_select_db("HomeAdmin", $con);
echo $sql;
$resultSet = mysql_query($sql1);

while($row = mysql_fetch_array($resultSet))
	{
	echo "<br>" . $row['FirstName'] . " >>>>" . $row['LastName'] . " " . $row['Email'] . " <" . $row['City'] . ">";
	echo "<br>";
	}
	
mysql_close($con);
?>