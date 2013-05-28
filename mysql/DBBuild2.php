<!DOCTYPE html>
<html>
<body>
/*
 * NOTE: CHANGE INDEX FROM 0 TO 1 DEPENDING ON CREATING THE DATABASE OR NOT...
 */
 
<?php

$sql = array(	
"DROP TABLE ContractorTrack",
"CREATE TABLE  ContractorTrack
	(TrackID smallint NOT NULL AUTO_INCREMENT,
	Movement varchar(3),
	Latitude varchar(26),
	Longitude varchar(26),
	PhoneNumber varchar(12),
	DateTime varchar(26),
	Place varchar(75),
	PRIMARY KEY(TrackID))",
);

	
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("HomeAdmin", $con);
for($i=0;$i<count($sql);$i++)
{
if (mysql_query($sql[$i],$con))
  {
  echo "<br>" . $sql[$i] . " Successful<br>";
  }
else
  {
  echo "<br>Database Error: (" . $sql[$i] . ")" . mysql_error();
  }
}
//FOREIGN KEY (PhoneNumber) REFERENCES Contractor (PhoneNumber),
mysql_close($con);
?> 

</body>
</html>