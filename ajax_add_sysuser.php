<?php 
if ( !isset($_SESSION) ) session_start();
if (($_SESSION['user_level'] == 1) and (!empty($_GET['username']))) { 
	include('dbconfig.php');
	$password='password';
	$password=sha1($password);
	$username=strtolower($_GET['username']);
	$firstname=$_GET['firstname'];
	$lastname=$_GET['lastname'];
	$user_level=$_GET['user_level'];
	$status=$_GET['status'];
	
	
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_users WHERE username =:username");
	$stmt->execute(array(':username' => $username));
	$count = $stmt->rowCount();
	
	if ($count != 0) {
		echo 1;
	}
 else
	{
		$stmt = $DB_con->prepare("insert into hotspot_users (username, password, firstname, lastname, date_added, user_level, status)
			values(:username, :password, :firstname, :lastname, CURDATE(), :user_level, :status)");
		$stmt->execute(array(':username' => $username, ':password' => $password, ':firstname' => $firstname,
			':lastname' => $lastname, ':user_level' => $user_level, ':status' => $status));
		echo 2;
	}
}
else {
	echo 0;
}	
// End Adding a new System User Details, Returned from modal_add_user.php
?>