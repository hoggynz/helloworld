<?php
echo '<h1>Hello World</h1></br>';
echo '<h2>Application running on instance '.`hostname`.'</h2></br>';

echo date('Y-m-d H:i:s').'<br>';

// Get PaaS environment variables
$app = getenv('VCAP_APPLICATION');
$app_json = json_decode($app,true);
$services = getenv('VCAP_SERVICES');
$services_json = json_decode($services,true);

print '<pre>';
print 'Application:'."\n";
echo print_r($app_json,true)."\n\n";
print 'Services:'."\n";
echo print_r($services_json,true)."\n\n";
print '</pre>';

if (isset($services_json['mariadb'][0])) {
        $credentials = & $services_json['mariadb'][0]['credentials'];
        $mysqli = new mysqli($credentials['hostname'],$credentials['username'],$credentials['password'],$credentials['name']);
        if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "</br>\n";
		exit;
	}
        echo "MySQL Host: " . $mysqli->host_info . "</br>\n";

        $res = $mysqli->query("SHOW VARIABLES");
        $res->data_seek(0);
        while ($row = $res->fetch_assoc()) {
                echo "<pre>".print_r($row,true)."</pre></br>\n";
        }
}

phpinfo();
?>
