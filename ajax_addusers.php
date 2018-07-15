<?php  error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once 'settings.php';
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));

if (isset($_GET['no_of_users'])) $no_of_users = $_GET['no_of_users'];
if (isset($_GET['pass_length'])) $passLength = $_GET['pass_length'];
if (isset($_GET['user_prefix'])) $user_prefix = $_GET['user_prefix'];
if (isset($_GET['limit_uptime'])) $limit_uptime = $_GET['limit_uptime'];
if (isset($_GET['limit_bytes'])) $limit_bytes = $_GET['limit_bytes'];
if (isset($_GET['profile'])) $profile = $_GET['profile'];
if (isset($_GET['same_pass'])) $same_pass = $_GET['same_pass'];
if (isset($_GET['pass_type'])) $pass_type = $_GET['pass_type'];

if ( !isset($_SESSION) ) session_start();

switch ($pass_type) {
	case "s":
		$passAlphabet = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
		$user_prefix = strtolower($user_prefix);
		break;
	case "c":
		$passAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$user_prefix = strtoupper($user_prefix);
		break;
	case "n":
		$passAlphabet = "123456789123456789123456789123456789123456789123456789";
		break;
	case "sc":
		$passAlphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		break;
	case "sn":
		$passAlphabet = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz123456789123456789123456789";
		$user_prefix = strtolower($user_prefix);
		break;
	case "cn":
		$passAlphabet = "123456789123456789123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789123456789123456789";
		$user_prefix = strtoupper($user_prefix);
		break;
	case "scn":
		$passAlphabet = "abcdefghijklmnopqrstuvwxyz123456789123456789123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
		break;
}

$passAlphabetLimit = strlen($passAlphabet)-1;
	
if($_SESSION['user_level'] >= 1 and $_SESSION['user_level'] <= 3) {
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT booking_id from hotspot_vouchers ORDER BY booking_id DESC LIMIT 1");
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$booking_id = $row['booking_id'];
	$booking_id++;
	
	$stmt = $DB_con->prepare("UPDATE hotspot_vouchers set status=:status WHERE 1");
	$stmt->execute(array(':status' => 'Over'));

	$stmt = $DB_con->prepare("insert into hotspot_vouchers (created_on, created_by, creator, user_name, password, printed_times,
		printed_last, status, group_of, booking_id, limit_uptime, limit_bytes, profile, uid)
		values(NOW(), :created_by, :creator,  :user_name, :password, :printed_times, :printed_last, :status, :group_of, 
		:booking_id, :limit_uptime, :limit_bytes, :profile, :uid)");
		
	$k = 1;
	for($i=0; $i < $no_of_users; $i++){
		//$passAlphabet = 'abcdefghikmnpqrstuvxyz23456789';
		//$passAlphabetLimit = strlen($passAlphabet)-1;
		$pass = '';
		$uid = '';
		//Password generation
		for ($j = 0; $j < $passLength; ++$j) {
			$pass .= $passAlphabet[mt_rand(0, $passAlphabetLimit)];
		}
		$pass = str_shuffle($pass);
		//Username generation
		for ($j = 0; $j < $passLength; ++$j) {
			$uid .= $passAlphabet[mt_rand(0, $passAlphabetLimit)];
		}
		//Adding prefix to username
		$user_name = $user_prefix.$uid;
		
		//username & password same or different
		if ($same_pass == 2) {	$pass_word = $pass; } else { $pass_word = $user_name; }
		
		$util->setMenu('/ip hotspot user');
		$iv = count($util);
		
		if (intval($limit_bytes) != 0) {
			$limit_bytes_total = (intval($limit_bytes) * 1024 * 1024 * 1024 );
			$util->add(
				array(
					'name' => "$username",
					'password' => "$password",
					'disabled' => "no",
					'limit-uptime' => "$limit_uptime",
					'limit-bytes-total' => "$limit_bytes_total",
					'profile' => "$profile",
					'comment' => "Zetozone",
				)
			);
		}
		else
			{
			$util->add(
				array(
					'name' => "$username",
					'password' => "$password",
					'disabled' => "no",
					'limit-uptime' => "$limit_uptime",
					'profile' => "$profile",
					'comment' => "Zetozone",
				)
			);
			$limit_bytes = 0; // For Adding it to Local database
		}	

		if ($iv != count($util)) {
			$uid = $booking_id.'-'.$k.'-'.$no_of_users.date('dmY');
			//$creator = $_SESSION['username'].'['.$_SESSION['id'].']';
			$stmt->execute(array(':created_by' => $_SESSION['username'], ':creator' => $_SESSION['id'], ':user_name' => $user_name, ':password' => $pass_word,
				':printed_times' => 0, ':printed_last' => '', ':status' => 'Active', ':group_of' => $no_of_users,
				':booking_id' => $booking_id, ':limit_uptime' => $limit_uptime, ':limit_bytes' => $limit_bytes,
				':profile' => $profile, ':uid' => $uid));			
			$k++;	
		} 	
	}
	echo $k - 1; //Successful
}
else
	{
	echo 0; // Not an Authorised User
}
?>