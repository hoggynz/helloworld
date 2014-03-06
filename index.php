<?php
echo '<h1>Hello World</h1></br>';

//$name=$_SERVER["COMPUTERNAME"];
$name=$_SERVER["WEBSITE_INSTANCE_ID"];

//echo "<h2>Hi, my name is ".$name." running on ".php_uname()."</h2>";

echo date('Y-m-d H:i:s').'<br>';

phpinfo();
?>
