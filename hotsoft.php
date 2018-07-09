<?php
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));

if (isset($_GET['action'])) { $action = $_GET['action']; } else { $action = 'checkout'; }
if (isset($_GET['username'])) $username = $_GET['username'];
/*Sample Call
	FORMAT: localhost/hotsoft.php?action=checkin&username=101&password=spice&limit_uptime=10d&limit_bytes=10&profile=default
	action & username are REQUIRED, all other fields are optional
	action can be 'checkin' or 'checkout'.  if action is 'checkout', only user name need to be specified
	username can be room number or any username
	password - if password is not given, the given username will be the password
	limit_uptime - if given in the format '10d' for 10 days, '1d 10:30:00' for 1 day 10 hours and 30 minutes
	limit_bytes - if given the total upload/download bytes in GB, eg '10' means 10Gb
	profile - if given any user profile name available in the Wifi hotspot
	
	sample call:
	192.168.100.10/hotsoft.php?action=checkin&username=101&password=spice  - While checking in a room
	192.168.100.10/hotsoft.php?action=checkout&username=101 - While checking out a room
	
	Return Values
	0 - Success (Successfully created user account or Successfully removed User account)
	1 - Wrong action verb
	2 - Invalid or blank username
	3 - Call with an already existing/Duplicate username
	4 - 
 
*/
if (strtolower($action) == 'checkin')) {
	if (!empty($username)) {
		if (isset($_GET['password'])) { $password = $_GET['password']; } else { $password = $username; } 
		if (isset($_GET['limit_uptime'])) $limit_uptime = $_GET['limit_uptime'];
		if (isset($_GET['limit_bytes'])) $limit_bytes = $_GET['limit_bytes'];
		if (isset($_GET['profile'])) { $profile = $_GET['profile']; } else { $profile = 'default'; } 
	
		$util->setMenu('/ip hotspot user');
		$iv = count($util);

		if ((intval($limit_bytes) != 0) and (!empty($limit_uptime))) {
			$limit_bytes_total = (intval($limit_bytes) * 1024 * 1024 * 1024 );
			$util->add(
				array(
					'name' => "$username",
					'password' => "$password",
					'limit-uptime' => "$limit_uptime",
					'limit-bytes-total' => "$limit_bytes_total",
					'profile' => "$profile"
				)
			);
		}
		elseif (intval($limit_bytes) != 0) {
			$limit_bytes_total = (intval($limit_bytes) * 1024 * 1024 * 1024 );
			$util->add(
				array(
					'name' => "$username",
					'password' => "$password",
					'limit-bytes-total' => "$limit_bytes_total",
					'profile' => "$profile"
				)
			);	
			}
		else
			{
			$util->add(
				array(
					'name' => "$username",
					'password' => "$password",
					'limit-uptime' => "$limit_uptime",
					'profile' => "$profile"
				)
			);
			$limit_bytes = 0; // For Adding it to Local database
		}		

		if ($iv != count($util)) {
			include('dbconfig.php');
			$stmt = $DB_con->prepare("SELECT booking_id from hotspot_vouchers ORDER BY booking_id DESC LIMIT 1");
			$stmt->execute(array());
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$booking_id = $row['booking_id'];
			$booking_id++;
			$uid = $booking_id.'-1-'.date('dmY');
			$creator = 999;
			$created_by = 'Hotsoft';
			$stmt = $DB_con->prepare("UPDATE hotspot_vouchers set status=:status WHERE 1");
			$stmt->execute(array(':status' => 'Over'));
				$stmt = $DB_con->prepare("insert into hotspot_vouchers (created_on, created_by, creator, user_name, password, printed_times,
				printed_last, status, group_of, booking_id, limit_uptime, limit_bytes, profile, uid)
				values(NOW(), :created_by, :creator, :user_name, :password, :printed_times, :printed_last, :status, :group_of, 
				:booking_id, :limit_uptime, :limit_bytes, :profile, :uid)");
			$stmt->execute(array(':created_by' => $created_by, ':creator' => $creator, ':user_name' => $username, ':password' => $password,
				':printed_times' => 0, ':printed_last' => '', ':status' => 'Active', ':group_of' => 1,
				':booking_id' => $booking_id, ':limit_uptime' => $limit_uptime, ':limit_bytes' => $limit_bytes,
				':profile' => $profile, ':uid' => $uid));
			echo 0; //Success
			}
		else
			{
				echo 3; // Duplicate/Existing username
		}	
	}
else
	{
		echo 2; //Blank Username
	}	
	//End Adding a Guest User
}
elseif (strtolower($action) == 'checkout'))  {
	//Removal
	$username=trim($_GET['username']);
	if (!empty($username)) {
		$printRequest = new RouterOS\Request('/ip/hotspot/user/print');
		$printRequest->setArgument('.proplist', '.id,name');
		$printRequest->setQuery(RouterOS\Query::where('name', $username));
		$id = $client->sendSync($printRequest)->getProperty('.id');

		$removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
		$removeRequest->setArgument('numbers', $id);
		$client->sendSync($removeRequest);
		echo 0; //Success
	}
	else
		{
		echo 2; //Blank Username
	}
}
else
{
	echo 1; //Wrong Action Verb
}
?>