<?php
include './DataTransfer.php';
include './FORM.php';
if(isset($_GET['type'])){
	$type = $_GET['type'];
	}
if(isset($_POST['type'])){
	$type = $_POST['type'];
	}

function writeTop(){
echo "<!DOCTYPE html>
<html>
<head>
<style>
.formError {
	color: #FF0000;
	}
#thisID {
		position:absolute;
		border:0px solid #bbb;
		margin-left:0px;
		width:420px;
		color:black;
		z-index:10;
		background-color:#b18e5c;
		background-repeat:no-repeat;
		height 458px;	
	}
</style>
</head>			
<body>
<div id='thisID'>";
}

function writeBottom(){
	echo "</div></body>
	</html>";
}

/* 
 * $_GET - first time through this code... values passed from GetContractorID
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

$FatalError = False;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	unset($_POST['type']);
	$errorArray = $_POST;
	$verifiedArray = $_POST;
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
		}
	}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!$FatalError){
		writeTop();
		/* update database here */
		$dT = new DataTransfer($verifiedArray, $type, "UPDATE");
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
		exit;
		}
	else {
		/* rewrite form here based on $errorArray and $verifiedArray */
		writeTop();
		$errorArray = $_POST;
		$verifiedArray = $_POST;
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
			}
		$hiddenArray = array("type" => $type);
		$a = getNewArray($type);
		buildForm($a, $verifiedArray, $errorArray, $hiddenArray);
		writeBottom();
		exit;
		}
	}
		/* first time through on the $_GET... */
		/* select contractor and display update form */
	$sql = "SELECT * FROM " . $type . " WHERE (FirstName = '" . 
		$FirstName . "' AND LastName = '" . $LastName . "') OR Email = '" .
		$Email . "'";
 
	$dT = new DataTransfer($_GET, $type, "SELECT", $sql);
	$verifiedArray = $dT->recordSet[0];
	$a = getNewArray($type);
	
	$hiddenArray = array("type" => $type);
	writeTop();
	$a['ActiveFlag'] = $verifiedArray['ActiveFlag'];
	buildForm($a, $verifiedArray, array(), $hiddenArray);
	//buildForm($verifiedArray, $verifiedArray, array(), $hiddenArray);
	writeBottom();
?>