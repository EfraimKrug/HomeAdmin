<?php
$notempty = array("FirstName","LastName","Email","TextAddress","HouseNumber","Street","City","Country");
$countryOptions = array("USA", "Israel", "Mexico", "Thailand");
$Country = array();
$FatalError = False;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$errorArray = $_POST;
	$verifiedArray = $_POST;
	foreach($_POST as $p=>$p_value)
		{
		if(in_array($p, $notempty))
			{
			if(empty($p_value))
				{
				$errorArray[$p] = "Missing";
				$FatalError = True;
				}
			else 
				{
				unset($errorArray[$p]);
				$verifiedArray[$p] = $p_value;
				}
		}
		if ($p == "ActiveFlag")
			{
			if(!isset($_POST[$p]))
				{
				$errorArray[$p] = "Active Flag is not selected!";
				}
			else
				{
				unset($errorArray[$p]);
				$verifiedArray[$p] = $p_value;
				}
			}
		if (($p == "SocialSecurityNumber")||($p == "PhoneNumber"))
			{
			if(empty($_POST[$p]))
				{
				$FatalError = True;
				$errorArray[$p] = "No Number!";
				}
			else
				{
				unset($errorArray[$p]);
				$verifiedArray[$p] = $p_value;
				}
			}
		if ($p == "Country")
			{
			if(empty($_POST[$p]))
				{
				$FatalError = True;
				$errorArray[$p] = "Everyone's gotta be someplace!";
				}
			else
				{
				unset($errorArray[$p]);
				$verifiedArray[$p] = $p_value;
				}
			}
		}
	}

	

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!$FatalError){
		echo "<html><head></head><body>Posting to Database!</body></html>";
		header("Location:../../html/DefaultPage.html");
		exit;
	}
}
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
if(isset($verifiedArray['FirstName']))
{
echo htmlspecialchars($verifiedArray['FirstName']);
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
if(isset($verifiedArray['LastName']))
{
echo htmlspecialchars($verifiedArray['LastName']);
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
if(isset($verifiedArray['Email']))
{
echo htmlspecialchars($verifiedArray['Email']);
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
if(isset($verifiedArray['SocialSecurityNumber']))
{
echo htmlspecialchars($verifiedArray['SocialSecurityNumber']);
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
if(isset($verifiedArray['PhoneNumber']))
{
echo htmlspecialchars($verifiedArray['PhoneNumber']);
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
if(isset($verifiedArray['TextAddress']))
{
echo htmlspecialchars($verifiedArray['TextAddress']);
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
if(isset($verifiedArray['HouseNumber']))
{
echo htmlspecialchars($verifiedArray['HouseNumber']);
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
if(isset($verifiedArray['Street']))
{
echo htmlspecialchars($verifiedArray['Street']);
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
if(isset($verifiedArray['City']))
{
echo htmlspecialchars($verifiedArray['City']);
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
if(isset($verifiedArray['MailingCode']))
{
echo htmlspecialchars($verifiedArray['MailingCode']);
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
	if(isset($verifiedArray['ActiveFlag']) && ($verifiedArray['ActiveFlag'] == '1'))
		{
		echo " checked";
		}
 echo ">Active
<input type='radio' name='ActiveFlag' value='0'";
	if(isset($verifiedArray['ActiveFlag']) && $verifiedArray['ActiveFlag'] == '0')
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