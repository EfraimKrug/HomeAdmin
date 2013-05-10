<?php
$notempty = array("FirstName" => "","LastName" => "","Email" => "");

$FatalError = False;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	foreach($_POST as $p=>$p_value)
		{
		if(!empty($p_value))
			{
			$notempty[$p] = $p_value;
			}
		}
	if(($notempty["FirstName"] == "") || ($notempty["LastName"] == "")){
		$FatalError = True;
		}
	if(!isset($notempty["Email"])){
		$FatalError = True;
		}	

	if(!$FatalError){
		//echo "<html><head></head><body>Looking up contractor on database! (" . $FatalError . $notempty["FirstName"] . "/" . $notempty["LastName"] . ")</body></html>";
		header("Location:../displayContractor.php?FirstName=" . $notempty['FirstName'] . "&LastName=" . $notempty['LastName']);
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
<tr><td></td><td>Enter the full name or the e-mail address!</td></tr>
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
<tr><td></td><td><input type='submit' value='Submit'></td></tr>
</table>
</form>
</body>
</html>";