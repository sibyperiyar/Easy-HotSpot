<!DOCTYPE html>
<html lang="en">
<?php
include ('header.php');
if ( !isset($_SESSION) ) session_start(); ?>
<body>
	<div class="container" style="margin-top:50px;">
		<div class="no_print">
		<div class="row">
			<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
				<div class="panel panel-primary">
					<div class="panel-heading"><h3 class="text-center">HotSpot User Voucher Printing</h3></div>
					<div class="panel-body">
						<form class="form-horizontal" method="post">
							<div class="alert alert-info text-center"><strong>Printing of last set of vouchers</strong></div>
							<div class="form-group">
								<div class="col-xs-4">
									<img src="images/shot1.png" width="240" height="100" class="center">
									<button name="voucher1" id="voucher1" class="btn btn-success center-element"  tabindex="1" title="Single Account Per Row(Plain List)">Single Account Per Row(Plain List)</button></a>
								</div>
								<div class="col-xs-4">
									<img src="images/shot2.png" width="240" height="100" class="center">
									<button name="voucher2" id="voucher2" class="btn btn-primary center-element"  tabindex="2" title="2 Accounts per Row(Plain List)">2 Accounts per Row(Plain List)</button>
								</div>
								<div class="col-xs-4">
									<img src="images/shot3.png" width="240" height="100" class="center">
									<button name="voucher3" id="voucher3"  class="btn btn-info center-element" title="Only use with Accounts having same username and password" tabindex="3">3 Accounts per Row(Plain List)</button>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-4">
									<img src="images/shot4.png" width="240" height="100" class="center">
									<button name="voucher4" id="voucher4" class="btn btn-danger center-element" tabindex="4" title="2 Rows for Single Account(Plain List)">2 Rows for Single Account(Plain List)</button>
								</div>
								<div class="col-xs-4">
									<img src="images/shot5.png" width="240" height="100" class="center">
									<button name="voucher5" id="voucher5" class="btn btn-warning center-element" tabindex="5" title="Single Voucher/row - ID Card Format, Suitable for printing on envelope type sheets">Single Voucher/row - ID Card Format</button>
								</div>
								<div class="col-xs-4">
									<img src="images/shot6.png" width="240" height="100" class="center">
									<button name="voucher6" id="voucher6" class="btn btn-primary center-element" tabindex="5" title="3 Vouchers/row - ID Card Format, Suitable for printing on A4/similar size Sheets">3 Vouchers/row - ID Card Format</button>
								</div>
							</div>	
							<div class="form-group">
								<div class="col-xs-4 col-xs-offset-4">
									<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>
									<button name="submit" type="submit" class="btn btn-primary" tabindex="7"><i class="icon-save icon-large"></i>Refresh Page</button>
									<a href="index.php" class="btn btn-danger" tabindex="8"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
								</div>	
							</div>							
						</form>
					</div>
				</div>	
			</div>
		</div>
		</div>
<?php
if (isset($_POST['voucher1'])) {
	if (!(($_SESSION['user_level'] <= 3) AND ($_SESSION['user_level'] >= 1))) {
		echo '<script>cmodalOkCancel("Access Denied", "User Rights Issue,  Consult Administrator", "information", "index.php");</script>';
	}
else
	{
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_vouchers WHERE status = :status");
	$stmt->execute(array(':status' => 'Active'));
	if ($stmt->rowCount() == 0) {
		echo '<script>cmodal("No Data Found","NO entries available meeting the current options, Try Selecting a different period", "error")</script>';
	}
	?>
	<div class="child-modal">
	<div class="row">
		<div class="col-sm-2 col-sm-offset-6"><button onclick="window.print();" class="btn btn-primary"><i class="icon-save icon-large"></i></a>&nbsp;PRINT</button></div>
		<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
			<table cellpadding="0" cellspacing="0" border="1" class="table table-bordered" id="example">
				<caption class="text-center">HOTSPOT USER LIST - <?php echo date('d-m-Y'); ?></caption>
				<div class="alert alert-info">
					<h1 class="text-center"><strong>HotSpot User Voucher</strong></h1>
				</div>
				<thead>
					<tr>
						<th>#</th>
						<th></th>
						<th>Username</th>
						<th>Password</th>
						<th>Limit Uptime</th>
						<th>Limit Bytes</th>
						<th>Bandwidth Profile</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					$sn = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$sn += 1;
						$id = $row['id'];
						$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
						echo '<tr>';
							echo '<td>'.$sn.'</td>';
							echo '<td><img src="images/success.png" width="50px" height="50px"></td>';
							echo '<td>Username: '.$row['user_name'].'</td>';
							echo '<td>Password: '.$row['password'].'</td>';
							echo '<td>Uptime Limit: '.$row['limit_uptime'].'ays</td>';
							echo '<td>Usage Limit: '.$limit_bytes.'</td>';
							echo '<td>Bandwidth Profile: '.$row['profile'].'</td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-3 col-sm-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>						
	</div>
	</div>
	<?php
	}
}	?>
<?php 
if (isset($_POST['voucher2'])) {
	if (!(($_SESSION['user_level'] <= 3) AND ($_SESSION['user_level'] >= 1))) {
		echo '<script>cmodalOkCancel("Access Denied", "User Rights Issue,  Consult Administrator", "information", "index.php");</script>';
		}
	else
	{
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_vouchers WHERE status = :status");
	$stmt->execute(array(':status' => 'Active'));
	if ($stmt->rowCount() == 0) {
		echo '<script>cmodal("No Data Found","NO entries available for Printing, Create Vouchers First from the Main menu, Add Multiple Users", "error")</script>';
	}
	?>
	<div class="child-modal">
	<div class="row">
		<div class="col-sm-2 col-sm-offset-6"><button onclick="window.print();" class="btn btn-primary"><i class="icon-save icon-large"></i></a>&nbsp;PRINT</button></div>
		<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
				<caption class="text-center">HOTSPOT USER LIST - <?php echo date('d-m-Y'); ?></caption>
				<div class="alert alert-info">
					<h1 class="text-center"><strong>HotSpot User Voucher - 2 in 1 Row(Plain)</strong></h1>
				</div>
				<thead>
					<tr>
						<th>#</th>
						<th></th>
						<th>Username</th>
						<th>Password</th>
						<th></th>
						<th>#</th>
						<th></th>
						<th>Username</th>
						<th>Password</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sn = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$sn += 1;
						$id = $row['id'];
						$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
						echo '<tr>';
							echo '<td>'.$sn.'</td>';
							echo '<td><img src="images/success.png" width="50px" height="50px"></td>';
							echo '<td>Username: '.$row['user_name'].'</td>';
							echo '<td>Password: '.$row['password'].'</td>';
							echo '<td></td>';
							if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$sn += 1;
								$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
								echo '<td>'.$sn.'</td>';
								echo '<td><img src="images/success.png" width="50px" height="50px"></td>';
								echo '<td>Username: '.$row['user_name'].'</td>';
								echo '<td>Password: '.$row['password'].'</td>';
							}	
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-3 col-sm-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>						
	</div>
	</div>
	<?php
	}
}
?>
<?php 
if (isset($_POST['voucher3'])) { //3 Units per Line, For Same Username and Password Accounts
	if (!(($_SESSION['user_level'] <= 3) AND ($_SESSION['user_level'] >= 1))) {
		echo '<script>cmodalOkCancel("Access Denied", "User Rights Issue,  Consult Administrator", "information", "index.php");</script>';
		}
	else
	{
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_vouchers WHERE status = :status");
	$stmt->execute(array(':status' => 'Active'));
	if ($stmt->rowCount() == 0) {
		echo '<script>cmodal("No Data Found","NO entries available for Printing, Create Vouchers First from the Main menu, Add Multiple Users", "error")</script>';
	}
	?>
	<div class="child-modal">
	<div class="row">
		<div class="col-sm-2 col-sm-offset-6"><button onclick="window.print();" class="btn btn-primary"><i class="icon-save icon-large"></i></a>&nbsp;PRINT</button></div>
		<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
				<caption class="text-center">HOTSPOT USER LIST - <?php echo date('d-m-Y'); ?></caption>
				<div class="alert alert-info">
					<h1 class="text-center"><strong>HotSpot User Voucher - 3 in 1 Row(Plain, For Same Username & Password Accounts)</strong></h1>
				</div>
				<thead>
					<tr>
						<th>#</th>
						<th></th>
						<th>Details</th>
						<th></th>
						<th>#</th>
						<th></th>
						<th>Details</th>
						<th></th>
						<th>#</th>
						<th></th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sn = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$sn += 1;
						$id = $row['id'];
						$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
						echo '<tr>';
							echo '<td>'.$sn.'</td>';
							echo '<td><img src="images/success.png" width="50px" height="50px"></td>';
							echo '<td>ID & Psd: '.$row['user_name'].'</td>';
							echo '<td></td>';
							if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$sn += 1;
								$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
								echo '<td>'.$sn.'</td>';
								echo '<td><img src="images/success.png" width="50px" height="50px"></td>';
								echo '<td>ID & Psd: '.$row['user_name'].'</td>';
								echo '<td></td>';
							}	
							if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$sn += 1;
								$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
								echo '<td>'.$sn.'</td>';
								echo '<td><img src="images/success.png" width="50px" height="50px"></td>';
								echo '<td>ID & Psd: '.$row['user_name'].'</td>';
							}	
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-3 col-sm-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>						
	</div>
	</div>
	<?php
	}
}
?>
<?php
if (isset($_POST['voucher4'])) { //1 Account per 2 Rows; Little decorative
	if (!(($_SESSION['user_level'] <= 3) AND ($_SESSION['user_level'] >= 1))) {
		echo '<script>cmodalOkCancel("Access Denied", "User Rights Issue,  Consult Administrator", "information", "index.php");</script>';
	}
else
	{
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_vouchers WHERE status = :status");
	$stmt->execute(array(':status' => 'Active'));
	if ($stmt->rowCount() == 0) {
		echo '<script>cmodal("No Data Found","NO entries available meeting the current options, Try Selecting a different period", "error")</script>';
	}
	?>
	<div class="child-modal">
	<div class="row">
		<div class="col-sm-2 col-sm-offset-6"><button onclick="window.print();" class="btn btn-primary"><i class="icon-save icon-large"></i></a>&nbsp;PRINT</button></div>
		<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
			<table cellpadding="0" cellspacing="0" border="2" class="table table-bordered" id="table-01">
				<caption class="text-center">HOTSPOT USER LIST - <?php echo date('d-m-Y'); ?></caption>
				<div class="alert alert-info">
					<h1 class="text-center"><strong>HotSpot User Voucher - 1 Account spanning 2 rows</strong></h1>
				</div>
				<thead>
					<tr>
						<th>#</th>
						<th></th>
						<th>Username</th>
						<th>Password</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sn = 0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$sn += 1;
						$id = $row['id'];
						$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
						echo '<tr>';
							echo '<td rowspan="2">'.$sn.'</td>';
							echo '<td rowspan="2"><img src="images/success.png" width="50px" height="50px"></td>';
							echo '<td>Username: '.$row['user_name'].'</td>';
							echo '<td>Password: '.$row['password'].'</td>';
							echo '<td><strong>Counting Starts from 1st Login</strong></td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td>Uptime Limit: '.$row['limit_uptime'].'ays</td>';
							echo '<td>Usage Limit: '.$limit_bytes.'</td>';
							echo '<td>Bandwidth Profile: '.$row['profile'].'</td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-3 col-sm-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>						
	</div>
	</div>
	<?php
	}
}	?>

<?php
if (isset($_POST['voucher5'])) { //1 Account per Card Format; Little decorative
	if (!(($_SESSION['user_level'] <= 3) AND ($_SESSION['user_level'] >= 1))) {
		echo '<script>cmodalOkCancel("Access Denied", "User Rights Issue,  Consult Administrator", "information", "index.php");</script>';
	}
else
	{
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_vouchers WHERE status = :status");
	$stmt->execute(array(':status' => 'Active'));
	if ($stmt->rowCount() == 0) {
		echo '<script>cmodal("No Data Found","NO entries available meeting the current options, Try Selecting a different period", "error")</script>';
	}
	echo '<div class="col-sm-6 col-sm-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>';
		
	$sn = 0;
	echo '<div class="card-deck">';
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$sn += 1;
		$id = $row['id'];
		$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
		?>
		<div class="row">
			<div class="col-sm-4">
				<div class="card card-inverse">
					<img class="card-img-top" src="images/logo.png" style="background-origin: content-box; background-size: cover; border-radius: 10px 10px 0px 0px;" alt="Card image/Logo">
					<div class="card-img-overlay">
						<h6 class="card-title text-center">WIFI HOTSPOT</h6>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">ID: <?php echo $sn.' ['.$row['uid'].']'; ?></li>
							<li class="list-group-item">User Name: <?php echo $row['user_name']; ?></li>
							<li class="list-group-item">Password : <?php echo $row['password']; ?></li>
							<li class="list-group-item">Uptime Limit : <?php echo $row['limit_uptime']; ?>ays</li>
							<li class="list-group-item">Usage Limit  : <?php echo $limit_bytes; ?></li>
							<li class="list-group-item">Bandwidth Profile  : <?php echo $row['profile']; ?></li>
						</ul>
					</div>
				</div>	
			</div>
		</div>	
		<?php
		}
		?>
		</div>
		<div class="col-sm-6 col-sm-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>						
	</div>
	<?php
	}
}	?>


<?php
if (isset($_POST['voucher6'])) { //Card Format;
	if (!(($_SESSION['user_level'] <= 3) AND ($_SESSION['user_level'] >= 1))) {
		echo '<script>cmodalOkCancel("Access Denied", "User Rights Issue,  Consult Administrator", "information", "index.php");</script>';
	}
else
	{
	include('dbconfig.php');
	$stmt = $DB_con->prepare("SELECT * FROM hotspot_vouchers WHERE status = :status");
	$stmt->execute(array(':status' => 'Active'));
	if ($stmt->rowCount() == 0) {
		echo '<script>cmodal("No Data Found","NO entries available meeting the current options, Try Selecting a different period", "error")</script>';
	}
	echo '<div class="col-xs-6 col-xs-offset-5">
			<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
			<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
			<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
		</div>';
		
	$sn = 0;
	echo '<div class="card-deck-wrapper">
	<div class="card-deck">';
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$sn += 1;
		$id = $row['id'];
		$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
		?>
		<div class="row">
			<div class="col-xs-4">
				<div class="card card-inverse">
					<img class="card-img-top" src="images/logo.png" style="background-origin: content-box; background-size: cover; border-radius: 10px 10px 0px 0px;" alt="Card image/Logo">
					<div class="card-img-overlay">
						<h6 class="card-title text-center">WIFI HOTSPOT</h6>
						<div class="card-block">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">ID: <?php echo $sn.' ['.$row['uid'].']'; ?></li>
								<li class="list-group-item">User Name: <?php echo $row['user_name']; ?></li>
								<li class="list-group-item">Password : <?php echo $row['password']; ?></li>
								<li class="list-group-item">Uptime Limit : <?php echo $row['limit_uptime']; ?>ays</li>
								<li class="list-group-item">Usage Limit  : <?php echo $limit_bytes; ?></li>
								<li class="list-group-item">Bandwidth Profile  : <?php echo $row['profile']; ?></li>
							</ul>
						</div>
					</div>	
				</div>
			</div>		
			<?php if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$sn += 1;
			$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
			?>
			<div class="col-xs-4">
				<div class="card card-inverse">
					<img class="card-img-top" src="images/logo.png" style="background-origin: content-box; background-size: cover; border-radius: 10px 10px 0px 0px;" alt="Card image/Logo">
					<div class="card-img-overlay">
						<h6 class="card-title text-center">WIFI HOTSPOT</h6>
						<div class="card-block">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">ID: <?php echo $sn.' ['.$row['uid'].']'; ?></li>
								<li class="list-group-item">User Name: <?php echo $row['user_name']; ?></li>
								<li class="list-group-item">Password : <?php echo $row['password']; ?></li>
								<li class="list-group-item">Uptime Limit : <?php echo $row['limit_uptime']; ?>ays</li>
								<li class="list-group-item">Usage Limit  : <?php echo $limit_bytes; ?></li>
								<li class="list-group-item">Bandwidth Profile  : <?php echo $row['profile']; ?></li>
							</ul>
						</div>
					</div>	
				</div>
			</div>
			<?php } ?>
			<?php  if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$sn += 1;
			$limit_bytes = ($row['limit_bytes'] == 0) ? 'None' : $row['limit_bytes'].' Gb';
			?>			
			<div class="col-xs-4">
				<div class="card card-inverse">
					<img class="card-img-top" src="images/logo.png" style="background-origin: content-box; background-size: cover; border-radius: 10px 10px 0px 0px;" alt="Card image/Logo">
					<div class="card-img-overlay">
						<h6 class="card-title text-center">WIFI HOTSPOT</h6>
						<div class="card-block">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">ID: <?php echo $sn.' ['.$row['uid'].']'; ?></li>
								<li class="list-group-item">User Name: <?php echo $row['user_name']; ?></li>
								<li class="list-group-item">Password : <?php echo $row['password']; ?></li>
								<li class="list-group-item">Uptime Limit : <?php echo $row['limit_uptime']; ?>ays</li>
								<li class="list-group-item">Usage Limit  : <?php echo $limit_bytes; ?></li>
								<li class="list-group-item">Bandwidth Profile  : <?php echo $row['profile']; ?></li>
							</ul>
						</div>
					</div>	
				</div>
			</div>
		</div>	
		<?php
			}
	}
	echo '</div>';
	echo '</div>';
	?>
	<div class="col-xs-6 col-xs-offset-5">
		<button onclick="window.print();" class="btn btn-danger"><i class="icon-save icon-large"></i>PRINT</button>&nbsp;&nbsp;&nbsp;
		<button name="submit" type="submit" class="btn btn-success" tabindex="6"><i class="icon-save icon-large"></i>Reset</button>&nbsp;&nbsp;&nbsp;
		<a href="index.php" class="btn btn-info" tabindex="7"><i class="icon-arrow-left icon-large"></i>Main Menu</a>
	</div>						
</div>
<?php
}
}	?>
	</div>
</body>