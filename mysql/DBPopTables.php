<!DOCTYPE html>
<html>
<body>

<?php

$sql = array(	
	"INSERT INTO Contractor 
	(FirstName,	MiddleName,	LastName,	Email,	SocialSecurityNumber,	PhoneNumber,
	TextAddress,	ActiveFlag,	StartDate,	HouseNumber,	Street,	City,	Country,	MailingCode)
	VALUES	
	('Efraim',	'Mordechai',	'Krug',	'EfraimMKrug@GMail.com',	'565-56-5656',	'617-780-6984',
	'6177806984@att.txt.com',	'A',	'2013-5-6',	'233',	'Corey Road',	'Brighton',	'USA',	'02135')",								

	"INSERT INTO Contractor 
	(FirstName,	MiddleName,	LastName,	Email,	SocialSecurityNumber,	PhoneNumber,
	TextAddress,	ActiveFlag,	StartDate,	HouseNumber,	Street,	City,	Country,	MailingCode)
	VALUES	
	('Efraim2',	'Mordechai2',	'Krug2',	'EfraimMKrug2@GMail.com',	'565-56-7777',	'617-780-7777',
	'6177807777@att.txt.com',	'A',	'2013-5-7',	'234',	'Corey2 Road',	'Brighton2',	'USA',	'02135')",								

	"INSERT INTO Contractor 
	(FirstName,	MiddleName,	LastName,	Email,	SocialSecurityNumber,	PhoneNumber,
	TextAddress,	ActiveFlag,	StartDate,	HouseNumber,	Street,	City,	Country,	MailingCode)
	VALUES	
	('Efraim3',	'Mordechai3',	'Krug3',	'EfraimMKrug3@GMail.com',	'565-56-8888',	'617-780-8888',
	'6177808888@att.txt.com',	'A',	'2013-5-8',	'235',	'Corey3 Road',	'Brighton3',	'USA',	'02135')"								
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

mysql_close($con);
?> 

</body>
</html>