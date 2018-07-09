<?php
//Start Removing All Validity Expired Guest User Accounts
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));
if ( !isset($_SESSION) ) session_start();
if ($_SESSION['user_level'] <= 3) {	
	
	$printRequest = new RouterOS\Request('/ip hotspot user print');
	$printRequest->setArgument('.proplist', '.id,limit-uptime,uptime,name');
	//$printRequest->setQuery(RouterOS\Query::where('name', 'admin', RouterOS\Query::OP_EQ) ->not()); 
	$printRequest->setQuery(RouterOS\Query::where('.id', '*0', RouterOS\Query::OP_EQ) ->not()); 

	$idList = '';
	foreach ($client->sendSync($printRequest)->getAllOfType(RouterOS\Response::TYPE_DATA) as $item) {
		if (!empty($item->getProperty('limit-uptime'))) {
			if (!($item->getProperty('uptime') < $item->getProperty('limit-uptime'))) {
				$idList .= ',' . $item->getProperty('.id');
			}
		}	
	}
	$idList = substr($idList, 1);
	//$idList now contains a comma separated list of all IDs.

	$removeRequest = new RouterOS\Request('/ip hotspot user remove');
	$removeRequest->setArgument('numbers', $idList);
	$client->sendSync($removeRequest); 
}
//End Removing All Validity Expired Guest User Accounts
?>
