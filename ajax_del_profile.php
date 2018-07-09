<?php
header('Content-Type: application/json');
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
if ( !isset($_SESSION) ) session_start();
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));

$profile_name=strtolower($_GET['profile_name']);

if ($_SESSION['user_level'] == 1) {
	
	if (!empty($profile_name)) {
		
		$printRequest = new RouterOS\Request('/ip hotspot user profile print');
		$printRequest->setArgument('.proplist', '.id,name');
		$printRequest->setQuery(RouterOS\Query::where('name', $profile_name)); 

		$idList = '';
		foreach ($client->sendSync($printRequest)->getAllOfType(RouterOS\Response::TYPE_DATA) as $item) {
			$idList .= ',' . $item->getProperty('.id');
		}
		$idList = substr($idList, 1);
		//$idList now contains a comma separated list of all IDs.

		$removeRequest = new RouterOS\Request('/ip hotspot user profile remove');
		$removeRequest->setArgument('numbers', $idList);
		$client->sendSync($removeRequest); 
		echo 2; //Success
		}
	else
		{
		echo 1; //Profile name Empty
	}
}
else
	{
		echo 0; //Not Authorised
}
?>