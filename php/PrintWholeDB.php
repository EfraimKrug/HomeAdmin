<?php
/*
 * get the form fields, etc...
 * and validate the email address - if not ok, 
 * send the user back to the previous page
 */
echo "<br>================ C O N T R A C T O R S ==========================<br><br>";

$sql = "SELECT * FROM Contractor";
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("HomeAdmin", $con);
$rs = mysql_query($sql, $con);

while($row = mysql_fetch_array($rs))
	{
	echo "<br>([" . $row['ContractorID'] . "-" . $row['PhoneNumber'] . "]" . $row['FirstName'] . ")" . $row['MiddleName'] . " " . $row['LastName'] . "..." . $row['Email'] . "...~" . $row['ActiveFlag'];
	}

echo "<br>================ M A N A G E R S ==========================<br><br>";
$sql = "SELECT * FROM Manager";
$rs = mysql_query($sql, $con);

while($row = mysql_fetch_array($rs))
	{
	echo "<br>([" . $row['ManagerID'] . "]"  . $row['FirstName'] . ")" . $row['MiddleName'] . " " . $row['LastName'] . "..." . $row['Email'] . "...~" . $row['ActiveFlag'];
	}

echo "<br>================ O W N E R S ==========================<br><br>";
$sql = "SELECT * FROM Owner";
$rs = mysql_query($sql, $con);

while($row = mysql_fetch_array($rs))
	{
	echo "<br>([" . $row['OwnerID'] . "]"  . $row['FirstName'] . ")" . $row['MiddleName'] . " " . $row['LastName'] . "..." . $row['Email'] . "...~" . $row['ActiveFlag'];
	}

echo "<br>================ P R O P E R T Y  ==========================<br><br>";
$sql = "SELECT * FROM Property";
$rs = mysql_query($sql, $con);

while($row = mysql_fetch_array($rs))
	{
	echo "<br>([" . $row['PropertyID'] . "]"  . $row['HouseNumber'] . ")" . $row['Street'] . " " . $row['City'] . "..." . $row['Country'] . "...~" . $row['ActiveFlag'];
	}

echo "<br>================ C O N T R A C T O R   T R A C K  ==========================<br><br>";
$sql = "SELECT * FROM ContractorTrack";
$rs = mysql_query($sql, $con);

while($row = mysql_fetch_array($rs))
	{
	echo "<br>([" . $row['TrackID'] . "]" . ")" . $row['Place'] . " " . "...~" . $row['Latitude'] . "*" . $row['Longitude'] . "*" . $row['PhoneNumber'];
	}
	
mysql_close($con);

?>