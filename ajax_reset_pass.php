<?php 
if ( !isset($_SESSION) ) session_start();
if ($_SESSION['user_level'] == 1) { 
	include('dbconfig.php');
	$user_id= $_GET['user_id'];
	$password='password';
	$password=sha1($password);
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_users WHERE user_id = :user_id");
	$stmt->execute(array(':user_id' => $user_id));
	$count = $stmt->rowCount();
	if ($count == 0){
		echo 1;
		}
	else
		{
		$stmt = $DB_con->prepare("update hotspot_users set password=:password where user_id= :user_id");
		$stmt->execute(array(':password' => $password, ':user_id' => $user_id));
		echo 2;
	}	
}
else
	{
	echo 0;
}
//End Resetting a System User Password, called from modal_reset_psd.php Modal
?>