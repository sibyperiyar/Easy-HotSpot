<?php
header('Content-Type: application/json');
if ( !isset($_SESSION) ) session_start();
if (($_SESSION['user_level'] == 1) and (!empty($_GET['user_id']))) { 
	include('dbconfig.php');
	$user_id=$_GET['user_id'];
	
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_users WHERE user_id =:user_id");
	$stmt->execute(array(':user_id' => $user_id));

	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	echo json_encode($row);
}
// End Getting Sysuser details
?>