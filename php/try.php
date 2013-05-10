<?php
echo "<html>
<head>
</head>
<body>
Hello!";
$GLOBALS[0] = "this";
//$GLOBALS[0] = array(1,2,3,4,5,6,7);
echo "<br>-->$GLOBALS[0]<--";
echo "<br>END IT ALL</body>
</html>";
?>