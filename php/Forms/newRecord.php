<?php
/*
 * @param: $type Contractor/Manager/Property/Owner
 */
if(isset($_GET['type'])){
	$type = $_GET['type'];
	}
// if the type comes in a hidden field in the form...
if(isset($_POST['type'])){
	$type = $_POST['type'];
	}

include '../DataTransfer.php';
include '../FORM.php';

function writeTop($type){
echo "<!DOCTYPE html>
<html>
<head>
<style>
.formError {
	color: #FF0000;
	}
</style>
</head>			
<body>" . $type . " Add a new one!";
}

function writeBottom(){
	echo "</body>
	</html>";
}

/*
 * $_POST: fields just entered
 * $verifiedArray: build array of correctly entered fields
 * $errorArray: build array of error messages
 * set FatalError.
 */
$FatalError = False;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['PhoneNumber'])){
		$_POST['PhoneNumber'] = preg_replace("/\D/", "", $_POST['PhoneNumber']); //@remove "-" from phone number
		}
	unset($_POST['type']);
	$verifiedArray = $_POST;
	$errorArray = $_POST;
	foreach($_POST as $p=>$p_value)
		{
		if(in_array($p, getMandatoryArray($type)))
			{
			if(empty($p_value))
				{
				$errorArray[$p] = "Required!";
				$FatalError = True;
				}
			else 
				{
				unset($errorArray[$p]);
				$verifiedArray[$p] = $p_value;
				}
			}
		else 
			{
				unset($errorArray[$p]);
				$verifiedArray[$p] = $p_value;
			}
		}
	}

	/* 
	 * DataTransfer inserts values into database...
	 */
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!$FatalError){
		//echo "Transfering Data now...";
		$dT = new DataTransfer($verifiedArray, $type, "INSERT");
		if($dT->getSuccess()){
			header("Location:../../html/DefaultPage.html");
			exit;
			}
		else 
			{
			header("Location:../../html/DefaultFailurePage.html");
			exit;
			}
		}
	/*
	 * there was a fatalError - 
	 * build the form again - load verifiedArray values and errorArray messages
	 */
	writeTop($type);
	//$a = getNewArray($type);
	//echo $type;
	$hiddenArray = array("type" => $type);
	buildForm($verifiedArray, $verifiedArray, $errorArray, $hiddenArray);
	writeBottom();
	exit;
	}
/*
 * first time through the code
 * build an empty form
 */
writeTop($type);
//echo $type;
$a = array();
$a = getNewArray($type);
$hiddenArray = array("type" => $type);
buildForm($a, array(), array(), $hiddenArray);	
writeBottom();
 