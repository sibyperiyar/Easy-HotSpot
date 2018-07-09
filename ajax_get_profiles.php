<?php
header('Content-Type: application/json');
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';

$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));
if ( !isset($_SESSION) ) session_start();
if ($_SESSION['user_level'] == 1) {
	$util->setMenu('/ip hotspot user profile print');
	$profile_name=$_GET['profile_name'];
	
	$printRequest = new RouterOS\Request('/ip hotspot user profile print');
	$printRequest->setArgument('.proplist', '.id,name,address-pool,rate-limit,session-timeout,shared-users,mac-cookie-timeout,keepalive-timeout');
	$printRequest->setQuery(RouterOS\Query::where('name', $profile_name)); 

	foreach ($client->sendSync($printRequest)->getAllOfType(RouterOS\Response::TYPE_DATA) as $item) {

	$tname =  $item->getProperty("name");
	$taddress_pool =  $item->getProperty("address-pool");
	$tshared_users =  $item->getProperty("shared-users");
	$trate_limit =  $item->getProperty("rate-limit");
	$tsession_timeout =  $item->getProperty("session-timeout");
	$tshared_users =  $item->getProperty("shared-users");
	$tmac_cookie_timeout =  $item->getProperty("mac-cookie-timeout");
	$tkeepalive_timeout =  $item->getProperty("keepalive-timeout");

	$arr = array('name' => $tname, 'address_pool' => $taddress_pool, 'rate_limit' => $trate_limit, 'session_timeout' => $tsession_timeout,
		'shared_users' => $tshared_users, 'mac_cookie_timeout' => $tmac_cookie_timeout,
		'keepalive_timeout' => $tkeepalive_timeout );

	echo json_encode($arr); 
	}
}	
?>