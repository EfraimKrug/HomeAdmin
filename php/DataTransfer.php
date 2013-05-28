<?php
include 'DB.php';
// Data Objects...

class DataTransfer
{
  var $fieldArray = array();
	//fieldArray - fields should be named database fields
	//@param: $type - database record (Contractor, Manager...)
	//@param: $action - (Update, Insert...)
	//@return: sets $this->success to True/False
	//@return: sets recordSet 
  function DataTransfer($fieldArray, $type, $action, $sql = "")
  {
	foreach ($fieldArray as $key=>$val){
		$this->$key = $val;
		}
	$this->valueArray = $fieldArray;
	$this->type = $type;
	$this->action = $action;
	$this->sql = $sql;
	$this->recordSet = "";
	$this->recordCount = 0;
	$this->fieldCount = 0;
	$this->success = False;
	$this->doRecordType($this->type);
  }
  
  function doRecordType($type){
	$this->success = False;
  	$db = new DB("localhost","root","","HomeAdmin");
	
	/*
	 * Determine action type: INSERT, SELECT, UPDATE, OR DELETE
	 * Then build the appropriate sql
	 * Connect to the datebase (DB.php)
	 * Execute the sql statement
	 * Return information in the DataTransfer Object
	 * including error fields
	 */
	if($this->action == 'INSERT'){
		if($this->sql == ""){
			$db->SQLSetup($this->insertRecord($type));
			if(($type == "Contractor")||($type == "ContractorTrack")){
				$db->SQLCheckSetup($this->checkConstraintsContractor($type));
				}
			if($type == "Manager"){
				$db->SQLCheckSetup($this->checkConstraintsManager($type));
				}
			if($type == "Owner"){
				$db->SQLCheckSetup($this->checkConstraintsOwner($type));
				}
			}
		$db->DBSetup();
		if(($type == "Contractor")||($type == "Manager")||($type == "Owner")){
			$db->DBInsertOnly();
			}
		if($type == "ContractorTrack"){
			$db->DBInsertAlso();
			}		
		if($type == "Property"){
			$db->DBInsert();
			}		
		$this->success = $db->DBGetSuccess();
		}
	if($this->action == 'SELECT'){
		$db->SQLSetup($this->sql);
		$db->DBSetup();
		$db->DBSelect();
		$this->recordCount = $db->RecordCount;
		
		$this->recordSet = $db->RecordSet;
		if($this->recordCount > 0){
			$this->fieldCount = count($db->RecordSet[0])/2;
			$this->success = $db->DBGetSuccess();
			}
		else {
			$this->success = False;
			}
		}
	if($this->action == 'UPDATE'){
		if($this->sql == ""){
			$db->SQLSetup($this->updateRecord($type));
			}
		$db->DBSetup();
		$db->DBUpdate();
		$this->success = $db->DBGetSuccess();
		}
	if($this->action == 'DELETE'){
		if($this->sql == ""){
				$db->SQLSetup($this->deleteRecord($type));
			}
		$db->DBSetup();
		$db->DBDelete();
		$this->success = $db->DBGetSuccess();
		}

	}
	
  // error tracking 
  function getSuccess() {
	return $this->success;
  }
  
  // building an "insert" sql statement
  //
  function insertRecord($type){
	$firstSw = True;
	$sql = "INSERT INTO " . $type . " ( ";
	foreach ($this->valueArray as $key=>$val){
		if(!$firstSw){
			$sql .= "," . $key;
			}
		else {
			$sql .= $key;
			$firstSw = False;
			}
		}
	$sql .= ") VALUES (";
	$firstSw = True;
	foreach ($this->valueArray as $key=>$val){
		if(!$firstSw){
			$sql .= ",'" . $val . "'";
			}
		else {
			$sql .= "'" . $val . "'";
			$firstSw = False;
			}
		}
	$sql .= ")";
	return $sql;
  }
  // building an "update" sql statement
  // update used for the person - contractor, manager, or owner
  function updateRecord($type){
	$firstSw = True;
	$sql = "UPDATE " . $type . " SET ";
	foreach ($this->valueArray as $key=>$val){
		if(!$firstSw){
			$sql .= ", " . $key . "='" . $val . "'";
			}
		else {
			$sql .= $key . "='" . $val . "'";
			$firstSw = False;
			}
		}
	if(($type == "Contractor") || ($type == "Manager") || ($type == "Owner")){
		$sql .= " WHERE (Email" . "='" . $this->valueArray['Email'] . 
			"' OR (FirstName='" . $this->valueArray['FirstName'] . 
			"' AND LastName='" . $this->valueArray['LastName'] . "'))";
			}
	return $sql;	
  }
  // building "delete" sql statement
  // delete used for contactor, owner, or manager (i.e. any person)
   function deleteRecord($type){
	$sql = "DELETE FROM " . $type;
	$sql .= " WHERE (Email" . "='" . $this->valueArray['Email'] . "' OR (FirstName='" . $this->valueArray['FirstName'] . "' AND LastName='" .
			$this->valueArray['LastName'] . "'))";

	return $sql;	
  }
//
// next functions build sql to check for constraints 
//
// new manager must have a unique e-mail address listed
  function checkConstraintsManager($type){
	if($type == "Manager"){
		$sql = "SELECT * FROM Manager WHERE Email='" . $this->valueArray['Email'] . "'";
		}
	return $sql;
  }
	// new owner must have a unique e-mail address listed
  function checkConstraintsOwner($type){
	if($type == "Owner"){
		$sql = "SELECT * FROM Owner WHERE Email='" . $this->valueArray['Email'] . "'";
		}
	return $sql;
  }
  // new contractor must have a unique e-mail address listed
  function checkConstraintsContractor($type){
	if($type == "Contractor"){
		$sql = "SELECT * FROM Contractor WHERE Email='" . $this->valueArray['Email'] . "'";
		}
	if($type == "ContractorTrack"){
		$sql = "SELECT * FROM Contractor WHERE PhoneNumber='" . $this->valueArray['PhoneNumber'] . "'";
		}
	return $sql;
  }
  // used for testing
  function displayContractor(){
	foreach ($this->valueArray as $key=>$val){
		echo "<br>" . $key . "-->>" .  $val;
		}
		
	echo "<br>Type: " . $this->type;
	echo "<br>Action: " . $this->action;
  }
  // displays the record set - used for testing
  function displayRecordSet(){
	foreach ($this->recordSet as $i=>$row){
		echo "<br>" . $i;
		foreach ($row as $k=>$val){
			echo "<br><b>" . $k . "</b> <i>" . $val . "</i>";
			}
		}
	}
}

?>