<?php 
if ( !isset($_SESSION) ) session_start();
include('dbconfig.php');

$np = $_GET['np'];
If ($_SESSION['user_level'] <= 3) {
	$np = sha1($np);
	$stmt = $DB_con->prepare("update hotspot_users set password = :np where user_id = :session_id");
	$stmt->execute(array(':np' => $np, ':session_id' => $_SESSION['id']));
	echo 1;
	}
else
	{
		echo 0;
}
?>