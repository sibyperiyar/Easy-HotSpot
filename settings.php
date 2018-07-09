<?php
	if (isset($_POST['btn_update'])){
		$newhost = $_POST['newhost'];
		$newuser = $_POST['newuser'];
		$newpass = $_POST['newpass'];
						
		$file = 'config.php';
		$message = '<?php '."\n";
		$message = $message.'$host = "'.$newhost.'";'."\n";
		$message = $message.'$user = "'.$newuser.'";'."\n";
		$message = $message.'$pass = "'.$newpass.'";'."\n";
		$message = $message."?>";
		try {
			file_put_contents($file, $message);
				echo '<script>cmodal("Success!", "Successfully saved the new settings!", "success", "index.php")</script>';
			}
		catch(PDOException $e) {
				echo '<script>cmodal("Access Denied!", "Error while updating settings!", "error", "index.php")</script>';
			}										
	}
?>
<div class="container">
	<header>
		<h1 style="text-align:center;">Easy Hotspot</h1>	
		<h2 style="text-align:center;">Simple HotSpot User Management Utility</h2>
		<h3 style="text-align:center;">By TEAM ZETOZONE</h3>
	</header>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 well" style="box-shadow: 10px 10px 5px #888888;">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<p><strong>Please update the below settings</strong></p>
				</div>
				<div class="panel-body">		
					<form class="form-horizontal" id="loginform" action="" method="POST">
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="inputEmail">Host IP</label>
							<div class="col-sm-8">
								<input type="text" id="txt_username" name="newhost" placeholder="Registered Username" value="<?php echo $host; ?>" required class="form-control" autofocus>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="inputEmail">Username</label>
							<div class="col-sm-8">
								<input type="text" id="txt_username" name="newuser" placeholder="Registered Username" value="<?php echo $user; ?>" required class="form-control" autofocus>
							</div>
						</div>						
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="inputPassword">Password</label>
							<div class="col-sm-8">
								<input type="password" id="txt_password" name="newpass" placeholder="Password" placeholder="Password" value="<?php echo $pass; ?>" required class="form-control">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<div class="col-sm-2 col-sm-offset-4">
								<button id="btn_update" name="btn_update" type="submit" class="btn btn-primary">&nbsp;Submit</button>
							</div>
							<div class="col-sm-2">
								<button id="btn_cancel" name="btn_cancel" type="close" class="btn btn-success">&nbsp;Cancel</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>