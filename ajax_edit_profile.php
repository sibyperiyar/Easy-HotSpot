<?php
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
//$client = new RouterOS\Client("$host", "$user", "$pass");
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));

if ( !isset($_SESSION) ) session_start();

$profile_name=strtolower($_GET['profile_name']);
$rx_rate_limit=$_GET['rx_rate_limit'];
$tx_rate_limit=$_GET['tx_rate_limit'];
$session_timeout=$_GET['session_timeout'];
$shared_users=$_GET['shared_users'];
$mac_cookie_timeout=$_GET['mac_cookie_timeout'];
$keepalive_timeout=$_GET['keepalive_timeout'];
if (empty($rx_rate_limit))  $rx_rate_limit = "256k";
if (empty($tx_rate_limit))  $tx_rate_limit = "128k";
$rate_limit = $rx_rate_limit.'/'.$tx_rate_limit;
if (empty($session_timeout))  $session_timeout = "1d 00:00:00";
if (empty($shared_users))  $shared_users = 1;
if (empty($mac_cookie_timeout))  $mac_cookie_timeout = "1d 00:00:00";
if (empty($keepalive_timeout))  $keepalive_timeout = "00:02:00";
if ($_SESSION['user_level'] == 1) {
	
	if (!empty($profile_name)) {
		
		$printRequest = new RouterOS\Request('/ip/hotspot/user/profile/print');
		$printRequest->setArgument('.proplist', '.id');
		$printRequest->setQuery(RouterOS\Query::where('name', $profile_name));
		$id = $client->sendSync($printRequest)->getProperty('.id');

		$setRequest = new RouterOS\Request('/ip/hotspot/user/profile/set');
		$setRequest->setArgument('numbers', $id);
		$setRequest->setArgument('rate-limit', $rate_limit);
		if(strtolower($session_timeout) != 'none') { 
			$setRequest->setArgument('session-timeout', $session_timeout);
		}
		else
			{
			$setRequest->setArgument('session-timeout', '00:00:00');
		}
		$setRequest->setArgument('shared-users', $shared_users);
		$setRequest->setArgument('mac-cookie-timeout', $mac_cookie_timeout);
		$setRequest->setArgument('keepalive-timeout', $keepalive_timeout);

		$client->sendSync($setRequest);
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
		echo 1; //Profile name Improper
	}
}
else
	{
		echo 0; //Not Authorised
}
?>