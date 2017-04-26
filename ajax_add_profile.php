<?php
header('Content-Type: application/json');
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
if ( !isset($_SESSION) ) session_start();
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));

$profile_name=strtolower($_GET['profile_name']);
$session_timeout=$_GET['session_timeout'];
$shared_users=$_GET['shared_users'];
$mac_cookie_timeout=$_GET['mac_cookie_timeout'];
$keepalive_timeout=$_GET['keepalive_timeout'];
$rx_rate_limit=$_GET['rx_rate_limit'];
$tx_rate_limit=$_GET['tx_rate_limit'];

$rate_limit = $rx_rate_limit.'/'.$tx_rate_limit;
if (empty($session_timeout)) $session_timeout = '3d 00:00:00';
if (empty($mac_cookie_timeout)) $mac_cookie_timeout = '3d 00:00:00';
if (empty($keepalive_timeout)) $keepalive_timeout = '00:02:00';

if ($_SESSION['user_level'] == 1) {
	
	if (!empty($profile_name)) {
		
			$util->setMenu('/ip hotspot user profile');
			if(strtolower($session_timeout) == 'none') $session_timeout = '00:00:00';
			$util->add(
				array(
					'name' => "$profile_name",
					'rate-limit' => "$rate_limit",
					'session-timeout' => "$session_timeout",
					'shared-users' => "$shared_users",
					'mac-cookie-timeout' => "$mac_cookie_timeout",
					'keepalive-timeout' => "$keepalive_timeout"
				)
			);
			/*
			if(strtolower($session_timeout) == 'none') {
				$id = $client->sendSync(new Request('/ip/hotspot/user/profile/print .proplist=.id', null, Query::where('name', $profile_name)))->getArgument('.id');
				$util->setMenu('/ip hotspot user profile');
				$util->unsetValue($id, 'session-timeout');
			} */
			echo 2; //Success
		}
	else
		{
		echo 1; //Profile name/Session Timeout Empty
	}
}
else
	{
		echo 0; //Not Authorised
}
?>