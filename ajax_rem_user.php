<?php
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));
if ( !isset($_SESSION) ) session_start();

$guest_name=trim($_GET['username']);

$printRequest = new RouterOS\Request('/ip/hotspot/user/print');
$printRequest->setArgument('.proplist', '.id,name');
$printRequest->setQuery(RouterOS\Query::where('name', $guest_name));
$id = $client->sendSync($printRequest)->getProperty('.id');

$removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
$removeRequest->setArgument('numbers', $id);
$client->sendSync($removeRequest);
?>