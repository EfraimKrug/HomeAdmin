<?php
/*
 * @param $fieldArray - keys are FieldNames (upper/lower case)
 * @					values are the data values 
 * @param $verifiedArray - validated values for the table
 * @param $errorArray - error messages for validated values
 * @param $hiddenArray - allows coder to pass hidden values in table... i.e. DeleteSW
 * 
 */
function buildForm($fieldArray, $verifiedArray, $errorArray, $hiddenArray){
	echo "<style>#centerTable { border:8px solid #c8a77c; padding:5px } </style><br>";
	echo "<style>input { background:#c8a77c } </style><br>";

	echo "<form 	action='";
	echo htmlspecialchars($_SERVER['PHP_SELF']);
	echo "' 	method='post'>
	<table id='centerTable'>";

	foreach ($fieldArray as $key=>$val){
		$fieldName = preg_replace("/([A-Z])/", " $1", $key); //@required UpperLowerCase... form
		if($key == "ActiveFlag"){
		echo "<tr><td>" . $fieldName . "</td><td><input type=radio name='ActiveFlag' value=True ";
			if($val == "T"){
					echo " checked='checked'>Active<BR><input type=radio name='ActiveFlag' value=False>Inactive";
				}
			else {
						echo ">Active<BR><input type=radio name='ActiveFlag'  value=False checked='checked'>Inactive";
			} 
		
		echo "<span class='formError'>";
				if(isset($errorArray[$key]))
				{
					echo $errorArray[$key]; 
				}

			}
		
		else {
			echo 	"<tr><td>" . $fieldName . "</td><td><input type=text name='" . $key . "' value='";
					if(isset($verifiedArray[$key]))
					{
						echo htmlspecialchars($verifiedArray[$key]);
					}
			echo "'><span class='formError'>";
					if(isset($errorArray[$key]))
					{
						echo $errorArray[$key]; 
					}
			echo "</span></td></tr>";
			}
		}
	
	foreach ($hiddenArray as $key=>$val){
		$fieldName = $key; 
		echo "<tr><td></td><td><input type=hidden name='" . $key . "' value='" . $val . "'>";
		}

echo "</td></tr><tr><td></td><td><input type='submit' value='Submit'></td></tr></table></form>";
}

// @param $type - tablename
// @return complete array of columns (keys but no values)
function getNewArray($type){
$arr = array();
if($type == "Contractor"){
	//echo "Contractor";
	$arr['FirstName'] = ""; 
	$arr['MiddleName'] = "";
	$arr['LastName'] = "";
	$arr['Email'] = "";
	$arr['SocialSecurityNumber'] = "";
	$arr['PhoneNumber'] = "";
	$arr['TextAddress'] = "";
	$arr['ActiveFlag'] = "";
	$arr['HouseNumber'] = "";
	$arr['Street'] = "";
	$arr['City'] = "";
	$arr['State'] = "";
	$arr['Country'] = ""; 
	$arr['MailingCode'] = "";
	}

if($type == "ContractorTrack"){
	//echo "Contractor";
	$arr['Movement'] = ""; 
	$arr['Latitude'] = "";
	$arr['Longitude'] = "";
	$arr['PhoneNumber'] = "";
	$arr['DateTime'] = "";
	$arr['Place'] = "";
	}

if($type == "Manager"){
	//echo "Manager";
	$arr['FirstName'] = ""; 
	$arr['MiddleName'] = "";
	$arr['LastName'] = "";
	$arr['Email'] = "";
	$arr['SocialSecurityNumber'] = "";
	$arr['PhoneNumber'] = "";
	$arr['TextAddress'] = "";
	$arr['ActiveFlag'] = "";
	$arr['HouseNumber'] = "";
	$arr['Street'] = "";
	$arr['City'] = "";
	$arr['State'] = "";
	$arr['Country'] = ""; 
	$arr['MailingCode'] = "";
	}

if($type == "Owner"){
	//echo "Manager";
	$arr['FirstName'] = ""; 
	$arr['MiddleName'] = "";
	$arr['LastName'] = "";
	$arr['Email'] = "";
	$arr['SocialSecurityNumber'] = "";
	$arr['PhoneNumber'] = "";
	$arr['TextAddress'] = "";
	$arr['ActiveFlag'] = "";
	$arr['HouseNumber'] = "";
	$arr['Street'] = "";
	$arr['City'] = "";
	$arr['State'] = "";
	$arr['Country'] = ""; 
	$arr['MailingCode'] = "";
	}

if($type == "Property"){
	//echo "Manager";
	$arr['OwnerID'] = 0;
	$arr['ContractorID'] = 0; 
	$arr['ManagerID'] = 0;
	$arr['PhoneNumber'] = "";
	$arr['PolicePhoneNumber'] = "";
	$arr['FirePhoneNumber'] = "";
	$arr['ActiveFlag'] = "";
	$arr['StartDate'] = "";
	$arr['HouseNumber'] = ""; 
	$arr['Street'] = "";
	$arr['City'] = "";
	$arr['State'] = "";
	$arr['Country'] = ""; 
	$arr['MailingCode'] = ""; 
	$arr['FrequencyNeeded'] = "";
	$arr['Notes'] = "";
	}

if($type == "PropertyID"){
	$arr['HouseNumber'] = ""; 
	$arr['Street'] = "";
	$arr['City'] = "";
	$arr['State'] = "";
	$arr['Country'] = ""; 
	}
		
if($type == "ContractorID"){
	//echo "ContractorID";
	$arr['FirstName'] = ""; 
	$arr['LastName'] = "";
	$arr['Email'] = "";
	}

if($type == "OwnerID"){
	//echo "OwnerID";
	$arr['FirstName'] = ""; 
	$arr['LastName'] = "";
	$arr['Email'] = "";
	}

if($type == "ManagerID"){
	//echo "ManagerID";
	$arr['FirstName'] = ""; 
	$arr['LastName'] = "";
	$arr['Email'] = "";
	}

return $arr;
}

// Each table ($type) may have a list of required fields - 
// this function returns an array of those required field names
// it is then used for editing 
function getMandatoryArray($type){
$arr = array();
if($type == "ContractorTrack"){
	$arr[] = 'Movement';
	$arr[] = 'Latitude';
	$arr[] = 'Longitude';
	$arr[] = 'PhoneNumber';
	$arr[] = 'DateTime';
	$arr[] = 'Place';
	}
	
if($type == "Contractor"){
	$arr[] = 'FirstName';
	$arr[] = 'LastName';
	$arr[] = 'Email';
	$arr[] = 'SocialSecurityNumber';
	$arr[] = 'PhoneNumber';
	$arr[] = 'TextAddress';
	$arr[] = 'HouseNumber';
	$arr[] = 'Street';
	$arr[] = 'City';
	$arr[] = 'State';
	$arr[] = 'Country';
	}
	
if($type == "Manager"){
	$arr[] = 'FirstName';
	$arr[] = 'LastName';
	$arr[] = 'Email';
	$arr[] = 'SocialSecurityNumber';
	$arr[] = 'PhoneNumber';
	$arr[] = 'TextAddress';
	$arr[] = 'HouseNumber';
	$arr[] = 'Street';
	$arr[] = 'City';
	$arr[] = 'State';
	$arr[] = 'Country';
	}

if($type == "Owner"){
	$arr[] = 'FirstName';
	$arr[] = 'LastName';
	$arr[] = 'Email';
	$arr[] = 'SocialSecurityNumber';
	$arr[] = 'PhoneNumber';
	$arr[] = 'TextAddress';
	$arr[] = 'HouseNumber';
	$arr[] = 'Street';
	$arr[] = 'City';
	$arr[] = 'State';
	$arr[] = 'Country';
	}

if($type == "Property"){
	$arr[] = 'HouseNumber';
	$arr[] = 'Street';
	$arr[] = 'City';
	$arr[] = 'State';
	$arr[] = 'Country'; 
	}

return $arr;
}
?>