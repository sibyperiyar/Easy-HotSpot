<?php 
if ( !isset($_SESSION) ) session_start();

if (($_SESSION['user_level'] == 1) and (!empty($_GET['user_id']))) { 
	include('dbconfig.php');

	$user_id=$_GET['user_id'];
	$username=strtolower($_GET['username']);
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_users WHERE username = :username AND user_id != :user_id");
	$stmt->execute(array(':username' => $username, ':user_id' => $user_id));
	$count = $stmt->rowCount();

	if ($count != 0) {
		echo 1;
		}
	else
		{
		$firstname=$_GET['firstname'];
		$lastname=$_GET['lastname'];
		$user_level=$_GET['user_level'];
		$status=$_GET['status'];

		$stmt = $DB_con->prepare("update hotspot_users set username=:username, firstname = :firstname , lastname = :lastname,
			user_level = :user_level, status = :status where user_id= :user_id");
		$stmt->execute(array(':username' => $username, ':firstname' => $firstname, ':lastname' => $lastname,
			':user_level' => $user_level, ':user_id' => $user_id, ':status' => $status));
		echo 2;
	}
}
else
	{
	echo 0;
}	
// End Adding a new System User Details, Returned from modal_add_user.php
?>