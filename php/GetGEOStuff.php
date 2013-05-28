<?php
include './DataTransfer.php';
include './FORM.php';
// This is the coolest code I have in this application... 
// This supports the form in MobilePage.html and phoneApp.html

function writeTop(){
echo "<!DOCTYPE html>
<html>
<head>
</head>			
<body>";
}

function writeBottom(){
	echo "</body>
	</html>";
}
//
// This code responds to a page with two forms on it... executed
// by two submit buttons - but they do basically the same thing -
// one logs a contractor "IN" and one logs the contractor "OUT"
// The fields on the second form have a "2" at the end of their 
// id fields- so here we remove those "2"s - so the names match
// the database.
//
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$PostHold = array();
	foreach($_POST as $p=>$p_value)
		{
			$key = preg_replace("/(.*)2$/", "$1", $p);
			$PostHold[$key] = $p_value;			
		}
	}
/* 
 * Now we update the database
 */
if($_SERVER["REQUEST_METHOD"] == "POST"){
		$PostHold['PhoneNumber'] = preg_replace("/\D/", "", $PostHold['PhoneNumber']); //@remove "-" from phone number
		foreach($PostHold as $p=>$p_value){
			echo "<br>..." . $p . " ..." . $p_value . "... ";
			}
		$verifiedArray = $PostHold;
		$dT = new DataTransfer($verifiedArray, "ContractorTrack", "INSERT");
		if($dT->getSuccess()){
				foreach($PostHold as $p=>$p_value)
				{
					echo "<br>$p ... $p_value";
				}

			header("Location:../html/DefaultPage.html");
			exit;
			}
		else 
			{
			header("Location:../html/DefaultFailurePage.html");
			exit;
			}
		}
?>