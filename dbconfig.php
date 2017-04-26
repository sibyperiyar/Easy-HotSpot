<?php
	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "root123";
	$DB_name = "mikrotik";

	try
		{
			$DB_con = new PDO("mysql:host={$DB_host}",$DB_user,$DB_pass);
			$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$dbname = "`".str_replace("`","``",$DB_name)."`";
			$DB_con->query("CREATE DATABASE IF NOT EXISTS $dbname");
			$DB_con->query("use $dbname");
		}
		catch(PDOException $e) {
			echo "Error Creating/Locating Database $dbname: " . $e->getMessage();
	}
	
	/* Old Version, NOT creating DB if NOT Exist
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	*/
?>