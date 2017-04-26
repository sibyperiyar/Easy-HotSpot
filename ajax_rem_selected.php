<?php
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));
if ( !isset($_SESSION) ) session_start();
$i = 0;

if ($_SESSION['user_level'] <= 3) {	

	$guest_list=$_GET['removal_list'];
	if (count($guest_list) != 0) {
		$printRequest = new RouterOS\Request('/ip/hotspot/user/print');
		$printRequest->setArgument('.proplist', '.id,name');
		$removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
		foreach ($guest_list as $guest) {
			$i++;
			//$printRequest->setArgument('.proplist', '.id,name');
			$printRequest->setQuery(RouterOS\Query::where('name', $guest));
			$id = $client->sendSync($printRequest)->getProperty('.id');

			//$removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
			$removeRequest->setArgument('numbers', $id);
			$client->sendSync($removeRequest);
		}
		echo $i;
	}
	else
	{
		echo -1;
	}
}	
else
	{
	echo 0; 
}
//$id = $client->sendSync(new Request('/ip/hotspot/user/profile/print .proplist=.id', null, Query::where('name', $profile_name)))->getArgument('.id');
?>