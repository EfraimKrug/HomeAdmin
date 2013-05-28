<?php
// Data Objects...
// database access...

class DB
{
  /*
   * @param $url: "localhost"
   * @param $user: "root"
   * @param $pwd: ""
   * @param $db: "HomeAdmin"
   * @return: RecordSet is double array of rows
   * @return: RecordCount is the number of rows
   * @return: Success - True/False
   * SQLCheck - sql to check contraints... 
   */
   var $url = "";
   var $user = "";
   var $pwd = "";
   var $db = "";
   
  function DB($url, $user, $pwd, $db)
  {
    $this->url = $url;
    $this->user = $user;
    $this->pwd = $pwd;
	$this->db = $db;
	$this->con = "";
	$this->sql = "";
	$this->SQLCheck = "";
	$this->RecordCount = 0;
	$this->Success = False;
	$this->RecordSet = array();
  }

  // main sql to be executed
  function SQLSetup($sql)
  { 
	$this->sql = $sql;
  }
  // sql used to check constraints
  function SQLCheckSetup($sql)
  {
	$this->SQLCheck = $sql;
  }
  
  // set up the connection and the database...
  function DBSetup()
  {
  $this->con = mysql_connect($this->url,$this->user,$this->pwd,$this->db);
  if (!$this->con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($this->db, $this->con);
  }

  function DBInsertOnly()
  {//check for redundancy - post new record if unique
	$this->Success = False;
	$rs = mysql_query($this->SQLCheck, $this->con);
	if($this->DBCheckExistance($rs)){
		mysql_close($this->con);
		$this->Success = False;
		}
	else {
		mysql_query($this->sql);
		mysql_close($this->con);
		$this->Success = True;
	}
  }

  function DBInsertAlso()
  {//check for existance - post new record if there exists some record
	$this->Success = False;
	$rs = mysql_query($this->SQLCheck, $this->con);
	if($this->DBCheckExistance($rs)){
		mysql_query($this->sql);
		mysql_close($this->con);
		$this->Success = True;
		}
	else {
		mysql_close($this->con);
		$this->Success = False;
	}
  }

  function DBInsert()
  {//check nothing - post new record
	$this->Success = False;
	mysql_query($this->sql);
	mysql_close($this->con);
	$this->Success = True;
  }

  // update the database...
  function DBUpdate()
  {
	$this->Success = False;
	$result = mysql_query($this->sql);
	
	if($result){
		$this->Success = True;
		}
	mysql_close($this->con);
  }
  // delete a record from the database
  function DBDelete()
  {
	$this->Success = False;
	$result = mysql_query($this->sql);
	
	if($result){
		$this->Success = True;
		}
	mysql_close($this->con);
  }
  // select from the database
  function DBSelect()
  {
	$this->Success = False;
	$rs = mysql_query($this->sql);
	$this->RecordCount = mysql_num_rows($rs);
	while($row = mysql_fetch_array($rs)){
		$this->RecordSet[] = $row;
	}
	mysql_close($this->con);
	$this->Success = True;
  }
  // returning success ...
  function DBGetSuccess()
  {
	return $this->Success;
  }
  // a type of constraint checking... sometimes existance allows
  // a new record to be posted (i.e. Phone number for contractorTrack record
  // must exist as a contractor's phone number) and other times the
  // existance blocks the record (i.e. email address for a contractor must
  // be unique.
  function DBCheckExistance($recordSet)
  {
	$this->Success = False;
	try 
		{		
			$this->RecordCount = mysql_num_rows($recordSet);
		} 
	catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		$this->Success = True;
		return $this->RecordCount;
  }
}

?>


