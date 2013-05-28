<?php
// process type!
include './DataTransfer.php';
include './FORM.php';
$type = $_GET['type'];
function writeTop(){
echo "<!DOCTYPE html>
<html>
<head>
<style>
.formError {
	color: #FF0000;
	}
</style>
</head>			
<body>";
}

function writeBottom(){
	echo "</body>
	</html>";
}

/* 
 * $_GET - first time through this code... values passed from GetPersonID
 */
$FirstName = "";
$LastName = "";
$Email = "";
if(isset($_GET["FirstName"])){
	$FirstName = $_GET["FirstName"]; 
	}
if(isset($_GET["LastName"])){
	$LastName = $_GET["LastName"]; 
	}
if(isset($_GET["Email"])){
	$Email = $_GET["Email"]; 
	}

	writeTop();
	/* update database here */
	$arr = array("FirstName" => $FirstName, "LastName" => $LastName, "Email" => $Email);
	$dT = new DataTransfer($arr, $type, "DELETE");
	if($dT->getSuccess()){
		header("Location:../html/DefaultPage.html");
		exit;
		}
	else 
		{
		header("Location:../html/DefaultFailurePage.html");
		exit;
		}
	
	writeBottom();
?>