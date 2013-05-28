<?php
echo "<!DOCTYPE html>
<html>
<head>
</head>			
<body>";

	foreach($_POST as $p=>$p_value)
		{
		echo "KEY=" . $p . ", Value=" . $p_value . "<br>";
		}
echo "</body></html>";
?>			