<?php
// introducing $type parameter....
//include '../DataTransfer.php';
if (isset($_POST['Delete'])){
	$DeleteSW = $_POST['Delete'];
	}
if (isset($_GET['Delete'])){
	$DeleteSW = $_GET['Delete'];
	}
if (isset($_POST['type'])){
	$type = $_POST['type'];
	}
if (isset($_GET['type'])){
	$type = $_GET['type'];
	}
include '../FORM.php';
echo $type;
if($DeleteSW == "NO"){
	echo " Update";
	}
else {
	echo " Delete";
	}
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

$paramArray = array("FirstName" => "","LastName" => "","Email" => "");

$FatalError = False;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	unset($_POST['type']);
	foreach($_POST as $p=>$p_value)
		{
		if(!empty($p_value))
			{
			$paramArray[$p] = $p_value;
			}
		}
	
	if(empty($paramArray["Email"])){
		if(($paramArray["FirstName"] == "") || ($paramArray["LastName"] == "")){
			$FatalError = True;
			}
		}
		
	if(!empty($paramArray["Email"])){
		$FatalError = False;
		}	
	
	if(!$FatalError){
		if($_POST['Delete'] == 'delete'){
			header("Location:../deletePerson.php?type=" . $type . "&FirstName=" . 
								$paramArray['FirstName'] . "&LastName=" . 
								$paramArray['LastName'] . "&Email=" . 	
								$paramArray['Email']);
			exit;
		}
		header("Location:../displayPerson.php?type=" . $type . "&FirstName=" . 
								$paramArray['FirstName'] . "&LastName=" . 
								$paramArray['LastName'] . "&Email=" . 	
								$paramArray['Email']);
		exit;
	}
}

writeTop();
$hiddenArray = array("Delete" => $DeleteSW, "type" => $type);
$a = array();
$a = getNewArray($type . "ID");
buildForm($a, array(), array(), $hiddenArray);	
writeBottom();
