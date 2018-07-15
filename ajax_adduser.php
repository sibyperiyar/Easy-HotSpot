<?php
//require_once 'settings.php';

use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));

if (isset($_GET['name'])) $username = $_GET['name'];
if (isset($_GET['psd'])) $password = $_GET['psd'];
if (isset($_GET['limit_uptime'])) $limit_uptime = $_GET['limit_uptime'];
if (isset($_GET['limit_bytes'])) $limit_bytes = $_GET['limit_bytes'];
if (isset($_GET['profile'])) $profile = $_GET['profile'];
if ( !isset($_SESSION) ) session_start();

$util->setMenu('/ip hotspot user');
$iv = count($util);

if ((!empty($username)) and (!empty($password)) and (!empty($profile))) {
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
		include('dbconfig.php');
		$stmt = $DB_con->prepare("SELECT booking_id from hotspot_vouchers ORDER BY booking_id DESC LIMIT 1");
		$stmt->execute(array());
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$booking_id = $row['booking_id'];
		$booking_id++;
		$uid = $booking_id.'-1-'.date('dmY');
		//$creator = $_SESSION['username'].'['.$_SESSION['id'].']';
		$stmt = $DB_con->prepare("UPDATE hotspot_vouchers set status=:status WHERE 1");
		$stmt->execute(array(':status' => 'Over'));
			$stmt = $DB_con->prepare("insert into hotspot_vouchers (created_on, created_by, creator, user_name, password, printed_times,
			printed_last, status, group_of, booking_id, limit_uptime, limit_bytes, profile, uid)
			values(NOW(), :created_by, :creator, :user_name, :password, :printed_times, :printed_last, :status, :group_of, 
			:booking_id, :limit_uptime, :limit_bytes, :profile, :uid)");
		$stmt->execute(array(':created_by' => $_SESSION['username'], ':creator' => $_SESSION['id'], ':user_name' => $username, ':password' => $password,
			':printed_times' => 0, ':printed_last' => '', ':status' => 'Active', ':group_of' => 1,
			':booking_id' => $booking_id, ':limit_uptime' => $limit_uptime, ':limit_bytes' => $limit_bytes,
			':profile' => $profile, ':uid' => $uid));	
			
		// here starts Echo String
		$echo_text ='			
			<div class="container">
				<div class="row" style="padding-top:20px;">	
					<div class="col-sm-12 col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading"><h3 class="text-center">Hotspot User Voucher</h3></div>
							<div class="panel-body">
								<form id="userForm" class="form-horizontal" method="GET" action="" enctype="multipart/form-data">
									<div class="col-sm-12 col-md-12">
										<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
											<thead>
												<tr>
													<th width="10%"></th>
													<th colspan="2">Username</th>                                 
													<th colspan="2">Password</th>
												</tr>
											</thead>
											<tbody>';
											$echo_text .= '<tr>
													<td width="10%" style="margin:0px; border: 0px; padding: 2px;"><img src="images/logo.png" width="250" height="50"></td>
													<td colspan="2"><input type="text" name="username" class="form-control" value="Username : '.$username.'" placeholder="User Name" readonly></td>
													<td colspan="2"><input type="text" name="password" class="form-control" value="Password : '.$password.'" placeholder="Password"  readonly></td>
												</tr>
												<tr>';
												if (intval($limit_bytes) != 0) {
													$echo_text .= '<td colspan="5">Validity : '.$limit_uptime.'ays; Counts from First login;  Data usage Maximum : '.$limit_bytes_total.' Bytes; Bandwidth : '.$profile.'; HAPPY BROWSING...</td>';
													}
												else
													{
													$echo_text .= '<td colspan="5">Validity : '.$limit_uptime.'ays; Counts from First login; Bandwidth/Profile : '.$profile.'; HAPPY BROWSING...</td>';
													}
												$echo_text .= '
												</tr>
											</tbody>
										</table>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-5">
						<button onclick="window.print();" class="btn btn-primary" ><i class="icon-save icon-large"></i></a>&nbsp;PRINT</button>&nbsp;&nbsp;
						<button onclick="document.getElementById("single").style.display="none !important;" type="reset" class="btn btn-danger"><i class="icon-save icon-large"></i></a>&nbsp;Reset</button>&nbsp;&nbsp;
						<button data-dismiss="modal" class="btn btn-info" ><i class="icon-save icon-large"></i></a>&nbsp;BACK</button>&nbsp;&nbsp;
					</div>
				</div>
			</div>';
				echo $echo_text;
		}
	else
		{
		echo '<script>cmodalOkCancel("ERROR/DUPLICATE", " Username '.$username.' is not added, Found as Duplicate. Try some other name", "error");</script>';
	}	
}
//End Adding a Guest User
?>