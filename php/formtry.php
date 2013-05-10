<?php

// define variables and initialize with empty values

$nameErr = $addrErr = $emailErr = $howManyErr = $favFruitErr = "";
$name = $address = $email = $howMany = "";
$favFruit = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Missing";
    }
    else {
        $name = $_POST["name"];
    }
    if (empty($_POST["address"])) {
        $addrErr = "Missing";
    }
    else {
        $address = $_POST["address"];
  }
  if (empty($_POST["email"]))  {
        $emailErr = "Missing";
    }
  else {
        $email = $_POST["email"];
    }
    if (!isset($_POST["howMany"])) {
        $howManyErr = "You must select 1 option";
    }
    else {
        $howMany = $_POST["howMany"];
    }
    if (empty($_POST["favFruit"])) {
        $favFruitErr = "You must select 1 or more";
    }
    else {
        $favFruit = $_POST["favFruit"];
    }
}
echo "
<html>
<head>
<style>
.error {
	color: #FF0000;
	}
</style>

</head>
<body>
<h1>Form Try</h1>
<form 
		action='";
echo htmlspecialchars($_SERVER['PHP_SELF']); 
echo "' method='POST'>
Name: <input type='text' name='name' value='";
echo htmlspecialchars($name);
echo "'><span class='error'>";
echo $nameErr;
echo "</span><br>
Address: <input type='text' name='address' value=''><span class='error'>";
echo $addrErr;
echo "</span><br>
Email: <input type='text' name='email' value=''><span class='error'>";
echo $emailErr;
echo "</span><br>
<input type='radio' name='howMany' value='zero'> 0
<input type='radio' name='howMany' value='one'> 1
<input type='radio' name='howMany' value='two'> 2<br><br>
<select name='favFruit[]' size='4' multiple>
 <option value='apple'>Apple</option>
 <option value='banana'>Banana</option>
 <option value='plum'>Plum</option>
 <option value='pomegranate'>Pomegranate</option>
 <option value='strawberry'>Strawberry</option>
 <option value='watermelon'>Watermelon</option>
</select>
<input type='submit' name='submit' value='Submit'>
</form>
</body>
</html>";
