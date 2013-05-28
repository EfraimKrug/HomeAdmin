<?php
$FirstName = $_GET['FirstName'];
$MiddleName = $_GET['MiddleName']; 
$LastName = $_GET['LastName']; 
$Email = $_GET['Email'];
$SocialSecurityNumber = $_GET['SocialSecurityNumber'];
$PhoneNumber = $_GET['PhoneNumber'];
$TextAddress = $_GET['TextAddress']; 
$ActiveFlag = $_GET['ActiveFlag';
$StartDate = $_GET['StartDate'];  											
$HouseNumber = $_GET['HouseNumber']; 
$Street = $_GET['Street']; 
$City = $_GET['City']; 
$Country = $_GET['Country']; 
$MailingCode = $_GET['MailingCode'];

$countryOptions = array("USA", "Israel", "Mexico", "Thailand");
$Country = array();

//echo "<br>... " . $FirstName . "><" . $LastName . ">><BR>";
$sql = "UPDATE Contractor SET " . 
					"FirstName = '" . $FirstName .
					"', MiddleName = '" . $MiddleName .
					"', LastName = '" . $LastName .
					"', Email = '" . $Email .
					"', SocialSecurityNumber = '" . $SocialSecurityNumber .
					"', PhoneNumber = '" . $PhoneNumber	.
					"', TextAddress = '" . $TextAddress .
					"', ActiveFlag = '" . $ActiveFlag .
					"', StartDate = '" . $StartDate .
					"', HouseNumber = '" . $HouseNumber .
					"', Street = '" . $Street .
					"', City = '" . $City .
					"', Country = '" . $Country .
					"', MailingCode = '" . $MailingCode . "' WHERE Email = '" . $Email . "'";
 
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
//echo $sql;
$resultSet = mysql_query($sql);

//while($row = mysql_fetch_array($resultSet))
//	{
//	echo "<br>" . $row['FirstName'] . " >>>>" . $row['LastName'] . " " . $row['Email'] . " <" . $row['City'] . ">" . $row['Email'];
//	echo "<br>";
//	}
$row = mysql_fetch_array($resultSet);
mysql_close($con);
/*       =============== build the html contractor form =================== */
echo "<!DOCTYPE html>
<html>
<head>
<style>
.formError {
	color: #FF0000;
	}
</style>
</head>			
<body>	
<form 	action='";
echo htmlspecialchars($_SERVER['PHP_SELF']);
echo "' 	method='post'>
<table>
<tr><td></td><td>Enter your information!</td></tr>
<tr><td>First Name</td><td><input type=text name='FirstName' 
					value='";
if(isset($row['FirstName']))
{
echo htmlspecialchars($row['FirstName']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['FirstName']))
						{
						echo $errorArray['FirstName']; 
						}
echo "</span>
					</td></tr>
<tr><td>Middle Name</td><td><input type=text name='MiddleName'></td></tr>
<tr><td>Last Name</td><td><input type=text name='LastName'
					value='";
if(isset($row['LastName']))
{
echo htmlspecialchars($row['LastName']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['LastName']))
						{
						echo $errorArray['LastName']; 
						}
echo "</span>
					</td></tr>

<tr><td>Email</td><td><input type=text name='Email'
					value='";
if(isset($row['Email']))
{
echo htmlspecialchars($row['Email']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['Email']))
						{
						echo $errorArray['Email']; 
						}
echo "</span>

</td></tr>
<tr><td>Social Security</td><td><input type=text name='SocialSecurityNumber'
					value='";
if(isset($row['SocialSecurityNumber']))
{
echo htmlspecialchars($row['SocialSecurityNumber']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['SocialSecurityNumber']))
						{
						echo $errorArray['SocialSecurityNumber']; 
						}
echo "</span>
</td></tr>
<tr><td>Phone Number</td><td><input type=text name='PhoneNumber'
					value='";
if(isset($row['PhoneNumber']))
{
echo htmlspecialchars($row['PhoneNumber']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['PhoneNumber']))
						{
						echo $errorArray['PhoneNumber']; 
						}
echo "</span>
</td></tr>
<tr><td>Text Address</td><td><input type=text name='TextAddress'
					value='";
if(isset($row['TextAddress']))
{
echo htmlspecialchars($row['TextAddress']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['TextAddress']))
						{
						echo $errorArray['TextAddress']; 
						}
echo "</span>
</td></tr>
<tr><td>House Number</td><td><input type=text name='HouseNumber'
					value='";
if(isset($row['HouseNumber']))
{
echo htmlspecialchars($row['HouseNumber']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['HouseNumber']))
						{
						echo $errorArray['HouseNumber']; 
						}
echo "</span>
</td></tr>
<tr><td>Street</td><td><input type=text name='Street'
					value='";
if(isset($row['Street']))
{
echo htmlspecialchars($row['Street']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['Street']))
						{
						echo $errorArray['Street']; 
						}
echo "</span>
</td></tr>
<tr><td>City/Town</td><td><input type=text name='City'
					value='";
if(isset($row['City']))
{
echo htmlspecialchars($row['City']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['City']))
						{
						echo $errorArray['City']; 
						}
echo "</span>
</td></tr>
<tr><td>Country</td><td>
					<select name='Country[]' size=4 multiple=''>";
foreach ($countryOptions as $opt) {
		echo "<option value='" . $opt . "'";
		if (in_array($opt, $Country))
			{
			echo " selected";
			}
		echo ">" . ucfirst($opt) . "</option>";
		}

echo 	"</select><span class='formError'>";
echo "</span>
					</td></tr>
<tr><td>Mailing Code</td><td><input type=text name='MailingCode'
					value='";
if(isset($row['MailingCode']))
{
echo htmlspecialchars($row['MailingCode']);
}
echo "'><span class='formError'>";
					if(isset($errorArray['Street']))
						{
						echo $errorArray['Street']; 
						}
echo "</span>
</td></tr>

<tr><td>Active </td><td>
<input type='radio' name='ActiveFlag' value='1'";
	if(isset($row['ActiveFlag']) && ($row['ActiveFlag'] == '1'))
		{
		echo " checked";
		}
 echo ">Active
<input type='radio' name='ActiveFlag' value='0'";
	if(isset($row['ActiveFlag']) && $row['ActiveFlag'] == '0')
		{
		echo " checked";
		}
echo ">Inactive
<span class='formError'>";	

					if(isset($errorArray['ActiveFlag']))
						{
						echo $errorArray['ActiveFlag']; 
						}
echo "</span>
</td></tr>
<tr><td></td><td><input type='submit' value='Submit'></td></tr>
</table>
</form>
</body>
</html>";
?>