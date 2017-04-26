<!DOCTYPE html>
<html lang="en">
<?php
//Start session
if ( !isset($_SESSION) ) session_start();
//Check whether the session variables present or not, and assign them to Ordinary variables, if present.
if (!isset($_SESSION['user_level']) || (trim($_SESSION['user_level']) == '' || (trim($_SESSION['user_level']) >= 4))) {
    header("location:login.php");
}
?>
<?php include('header.php'); ?>
<?php include('dbconfig.php'); ?>
<?php 
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
require_once 'config.php';
$util = new RouterOS\Util($client = new RouterOS\Client("$host", "$user", "$pass"));
?>  

<body>
	<div class="container">
	<div class="no_print">
        <!-- Start Logo Section -->
        <section id="logo-section" class="text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo text-center">
                            <h1>Easy HotSpot</h1>
                            <span style="color:#333333;font-size:20px;font-weight:bold">Simple Hotspot User Management Utility</span>
							<span style="color:#888888;font-size:20px;font-weight:bold">By Team Zetozone, Ph:+91 9020 150 150</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Logo Section -->
		
		<!-- Start Main Body Section -->
        <div class="mainbody-section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="menu-item blue">
                            <a href="#single-user" data-toggle="modal">
                                <i class="fa fa-child"></i>
                                <p>Add Single User</p>
                            </a>
                        </div>
						<div class="menu-item red">
                            <a href="#multi-user" data-toggle="modal">
                                <i class="fa fa-users"></i>
                                <p>Add Multiple Users</p>
                            </a>
                        </div>
                        <div class="menu-item green">
                            <a href="#list-users" data-toggle="modal">
                                <i class="fa fa-ambulance"></i>
                                <p>List Inactive Users</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="menu-item skyblue">
                            <a href="#active-users" data-toggle="modal">
                                <i class="fa fa-signal"></i>
                                <p>List Active Users</p>
                            </a>
                        </div>
                        <div class="menu-item purple">
                            <a href="#remove-selected" data-toggle="modal">
                                <i class="fa fa-ban"></i>
                                <p>Remove Selected Users</p>
                            </a>
                        </div>
                        <div class="menu-item olive">
                            <a href="#remove-expired" data-toggle="modal">
                                <i class="fa fa-bug"></i>
                                <p>Remove All Expired Users</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="menu-item coral">
                            <a href="#server-log" data-toggle="modal">
                                <i class="fa fa-paw"></i>
                                <p>Server Log</p>
                            </a>
                        </div>
                        <div class="menu-item navy">
                            <a href="voucher.php">
                                <i class="fa fa-bars"></i>
                                <p>Voucher Printing</p>
                            </a>
                        </div>
                        <div class="menu-item purple">
                            <a href="#system-user" data-toggle="modal">
                                <i class="fa fa-user-md"></i>
                                <p>System Users</p>
                            </a>
                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="menu-item fuchsia">
                            <a href="#remove-uninitiated" data-toggle="modal">
                                <i class="fa fa-gears"></i>
                                <p>Remove Un-Initiated Guests</p>
                            </a>
                        </div>
                        <div class="menu-item gold">
                            <a href="#profiler" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                <p>HotSpot User Profiles</p>
                            </a>
                        </div>
                        <div class="menu-item blue">
							<a href="index.php" >
                                <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                <p>Refresh</p>
                            </a>
                        </div>
                    </div>
                </div>
				<input type="button" style="background-color: #f0ff0a;" onclick="log_out()" value="<?php echo $_SESSION['username']; ?>"/>
            </div>
        </div>
	</div>	
	
        <!-- End Main Body Section -->

		<!-- 1. End Single Guest User Creation Experiment Section -->
		<div class="child-modal modal fade" id="single-user" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="no_print">
						<div class="row">
							<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
								<div class="panel panel-primary">
									<div class="panel-heading"><h3 class="text-center">Single User Creation</h3></div>
									<div class="panel-body">
										<div class="form-horizontal">
											<div class="form-group form-group-sm">
												<div class="col-sm-4">
													<label class="col-sm-6 control-label" >User Name</label>
													<div class="col-sm-6">
														<input type="text" placeholder="Please enter required username *" name="uname" id="uname" required >
													</div>
												</div>
												<div class="col-sm-4">
													<label class="col-sm-6 control-label" >Password</label>
													<div class="col-sm-6">
														<input type="text" placeholder="Please enter the required password *" name="psw" id="psw" required>
													</div>
												</div>
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" >Time Limit (Days)</label>
													<div class="col-sm-6">
														<select class="myCombo" id="slimit_uptime" name="slimit_uptime">
															<option value="2d">2 Days</option>									
															<option value="1d">1 Day</option>
															<option value="2d">2 Days</option>
															<option value="3d">3 Days</option>
															<option value="4d">4 Days</option>
															<option value="5d">5 Days</option>
														</select>
													</div>
												</div>
											</div>	
											<div class="form-group form-group-sm">
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" for="limit_bytes">Maximum Usage Limit(GB)</label>
													<div class="col-sm-6">
														<select class="myCombo" id="slimit_bytes" name="slimit_bytes">
															<option value="0">NONE</option>									
															<option value="1">1 GB</option>
															<option value="5">5 GB</option>
															<option value="10">10 GB</option>
															<option value="20">20 GB</option>
															<option value="50">50 GB</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" >Bandwidth (Mbps) Profile</label>
													<div class="col-sm-6">
														<?php
														$util->setMenu('/ip hotspot user profile');
														echo '<select class="myCombo" id="sprofile" name="sprofile" required>';
														foreach ($util->getAll() as $item) {
															echo '<option>', $item->getProperty('name'), '</option>';
														}
														echo '</select>'; ?>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="col-sm-3 col-sm-offset-3">
														<div class="pull-right">
															<button name="issuing" id="issuing" onClick="ajaxSingle()" class="btn btn-success"><i class="icon-save icon-large"></i></a>&nbsp;Issue</button>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="pull-left">
															<button  data-dismiss="modal" class="btn btn-warning" ><i class="icon-save icon-large"></i></a>&nbsp;BACK</button>
														</div>
													</div>
												</div>	
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div id="single"></div>
				</div>
			</div>
		</div>	
        <!-- 1. End Single Guest User Creation Experiment Section -->
		
		<!-- 2. Start Multi Guest User Creation Section -->
		<div class="child-modal modal fade" id="multi-user" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="no_print">
						<div class="row">
							<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
								<div class="panel panel-primary">
									<div class="panel-heading"><h3 class="text-center">Create Multiple Users</h3></div>
									<div class="panel-body">
										<div class="form-horizontal">
											<div class="form-group form-group-sm">
												<div class="col-sm-4">
													<label class="col-sm-6 control-label" for="no_of_users">Users</label>
													<div class="col-sm-6">
														<input type="number" min="2" max="150" id="no_of_users" name="no_of_users" value="2" autofocus >
													</div>
												</div>
												<div class="col-sm-4">
													<label class="col-sm-6 control-label" for="user_prefix">Name Prefix</label>
													<div class="col-sm-6">
														<input type="text" id="user_prefix" name="user_prefix">
													</div>
												</div>
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" for="pass_length">Password length</label>
													<div class="col-sm-6">
														<input type="number" min="4" max="10" id="pass_length" name="pass_length" value="5">
													</div>
												</div>
											</div>	
											<div class="form-group form-group-sm">
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" for="limit_uptime">Time Limit (Days)</label>
													<div class="col-sm-6">
														<select class="myCombo" id="limit_uptime" name="limit_uptime">
															<option value="2d">2 Days</option>									
															<option value="1d">1 Day</option>
															<option value="2d">2 Days</option>
															<option value="3d">3 Days</option>
															<option value="4d">4 Days</option>
															<option value="5d">5 Days</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" for="profile">Bandwidth (Mbps) Profile</label>
													<div class="col-sm-6">
														<?php
														$util->setMenu('/ip hotspot user profile');
														echo '<select class="myCombo" id="profile" name="profile">';
														foreach ($util->getAll() as $item) {
															echo '<option>', $item->getProperty('name'), '</option>';
														}
														echo '</select>'; ?>
													</div>
												</div>
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label">Username & Password</label>
													<div class="col-sm-6">
														<select class="myCombo" id="same_pass" name="same_pass">
															<option value="1">Same</option>									
															<option value="2">Different</option>
														</select>
													</div>
												</div>
											</div>	
											<div class="form-group form-group-sm">
												<div class="col-sm-4">						
													<label class="col-sm-6 control-label" for="limit_bytes">Maximum Usage Limit(GB)</label>
													<div class="col-sm-6">
														<select class="myCombo" id="limit_bytes" name="limit_bytes">
															<option value="0">NONE</option>									
															<option value="1">1 GB</option>
															<option value="5">5 GB</option>
															<option value="10">10 GB</option>
															<option value="20">20 GB</option>
															<option value="50">50 GB</option>
														</select>
													</div>
												</div>											
												<div class="col-sm-2">
													<div class="pull-right">
														<button name="missuing" id="missuing" onClick="ajaxMultiple()" class="btn btn-success">&nbsp; Issue</button>
													</div>
												</div>
												<div class="col-sm-2">
													<div class="pull-left">
														<button data-dismiss="modal" class="btn btn-warning"><i class="icon-save icon-large"></i>&nbsp; BACK </button>
													</div>
												</div>
											</div>	
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div id="multiple"></div>					
				</div>
			</div>
		</div>	

        <!-- 2. End Multi Guest User Creation Section -->
		
		<!-- 3. Start List All Inactive Users Section -->
        <div class="child-modal modal fade" id="list-users" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>	
                    <div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
						<?php $util->setMenu('/ip hotspot user'); ?>
						<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="table-01">
							<div class="alert alert-info">
								<strong><i class="icon-user icon-large"></i><h3 class="text-center">Users inactive at the moment</h3></strong>
							</div>
							<thead>
								<tr>
									<th>#</th>
									<th>User</th>
									<th>Profile</th>
									<th>Bytes In</th>
									<th>Bytes Out</th>
									<th>Total Permitted Usage</th>
									<th>Time Used</th>
									<th>Validity Limit</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								foreach ($util->getAll() as $item) {
									$i++;
									if ($item->getProperty('limit-bytes-total')) {
										$limit_bytes_total = $item->getProperty('limit-bytes-total').' Bytes';
									}
									else { $limit_bytes_total = 'Unlimited'; }
									
									if ($item->getProperty('limit-uptime')) {
										$limit_uptime = $item->getProperty('limit-uptime');
									}
									else { $limit_uptime = 'Not Limited'; }
									echo '<tr>';
										echo '<td>'.$i.'</td>';
										echo '<td>', $item->getProperty('name'),'</td>';
										echo '<td>', $item->getProperty('profile'), '</td>';
										echo '<td>', $item->getProperty('bytes-in'), '</td>';
										echo '<td>', $item->getProperty('bytes-out'), '</td>';
										echo '<td>', $limit_bytes_total, '</td>';
										echo '<td>', $item->getProperty('uptime'), '</td>';
										echo '<td>', $limit_uptime, '</td>';
									echo '</tr>';
								} ?>
							</tbody>
						</table>
                    </div>
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>
                </div>
            </div>
        </div>
        <!-- 3. End List All Inactive Users Section -->

		<!-- 4. Start List Active Users Section -->
        <div class="child-modal modal fade" id="active-users" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>
                    <div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
						<?php $util->setMenu('/ip hotspot active'); ?>
						<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="table-01">
							<div class="alert alert-info">
								<strong><i class="icon-user icon-large"></i><h3 class="text-center">List of Users Active at the moment</h3></strong>
							</div>
							<thead>
								<tr>
									<th>#</th>
									<th>Server</th>
									<th>Domain</th>
									<th>User</th>
									<th>IP Address</th>
									<th>Uptime</th>
									<th>Session Time left</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								foreach ($util->getAll() as $item) {
									$i++;	
									echo '<tr>';
										echo '<td>'.$i.'</td>';
										echo '<td>', $item->getProperty('server'),'</td>';
										echo '<td>', $item->getProperty('domain'), '</td>';
										echo '<td>', $item->getProperty('user'),'</td>';
										echo '<td>', $item->getProperty('address'), '</td>';
										echo '<td>', $item->getProperty('uptime'), '</td>';
										echo '<td>', $item->getProperty('session-time-left'), '</td>';
									echo '</tr>';
								} ?>
							</tbody>
						</table>
                    </div>
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>
                </div>
            </div>
        </div>
        <!-- 4. End List Active Users Section -->

		<!-- 5. Start Remove Selected users Section -->
        <div class="child-modal modal fade" id="remove-selected" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>
					<form id="checkboxForm" class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
								<?php $util->setMenu('/ip hotspot user'); ?>
								<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="table-01">
									<div class="alert alert-info">
										<strong><i class="icon-user icon-large"></i><h3 class="text-center">List of users accounts which can be removed and not active at the moment</h3></strong>
									</div>
									<thead>
										<tr>
											<th>#</th>
											<th>User</th>
											<th>Profile</th>
											<th>Bytes In</th>
											<th>Bytes Out</th>
											<th>Total Permitted Usage</th>
											<th>Time Used</th>
											<th>Validity Limit</th>
											<?php if($_SESSION['user_level'] <= 2) { //Administrator/Unit Head Only
												echo '<th>Remove</th>';
											} ?>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										foreach ($util->getAll() as $item) {
											$i++;
											if ($item->getProperty('limit-bytes-total')) {
												$limit_bytes_total = $item->getProperty('limit-bytes-total').' Bytes';
											}
											else { $limit_bytes_total = 'Unlimited'; }
										
											if ($item->getProperty('limit-uptime')) {
												$limit_uptime = $item->getProperty('limit-uptime');
											}
											else { $limit_uptime = 'Not Limited'; }
										echo '<tr>';
											echo '<td>'.$i.'</td>';
											$rid = $item->getProperty('name');
											echo '<td>', $rid,'</td>';
											echo '<td>', $item->getProperty('profile'), '</td>';
											echo '<td>', $item->getProperty('bytes-in'), '</td>';
											echo '<td>', $item->getProperty('bytes-out'), '</td>';
											echo '<td>', $limit_bytes_total, '</td>';
											echo '<td>', $item->getProperty('uptime'), '</td>';
											echo '<td>', $limit_uptime, '</td>';
											if($_SESSION['user_level'] <= 2) { //Administrator/Unit Head Only
												echo '<td>';
												echo '<label for="'.$rid.'"></label>
													<input type="checkbox" name="removal_list[]" value="'.$rid.'" id="'.$rid.'" class="styled" />';
													echo '<a title="Delete the Guest User Account" id="id'.$i.'"  href="#delete'.$item->getProperty('name').'" data-toggle="modal"  class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;';
													include('modal_delete_guest.php'); ?>
													<?php
												echo '</td>';
											}
										echo '</tr>';
										} ?>
									</tbody>
								</table>
								<div class="col-sm-2 col-sm-offset-4">
									<button name="removal" id="removal" data-dismiss="modal" onClick="removeSelected(this.form);" class="btn btn-success"><i class="icon-save icon-large"></i></a>&nbsp;Remove Selected</button>&nbsp;&nbsp;&nbsp;
								</div>	
								<div class="col-sm-2">
									<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
        <!-- 5. End Remove Selected users Section -->		

		<!-- 6. Start Remove All Expired Guest Users Section -->
        <div class="child-modal modal fade" id="remove-expired" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>
                    <div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
						<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="table-01">
							<div class="alert alert-info">
								<strong><i class="icon-user icon-large"></i><h3 class="text-center">Validity expired users available in System</h3></strong>
							</div>
							<thead>
								<tr>
									<th>#</th>
									<th>Server</th>
									<th>User</th>
									<th>Profile</th>
									<th>Limit Uptime</th>
									<th>Uptime</th>
									<th>Limit Bytes Total</th>
									<th>Bytes In</th>
									<th>Bytes Out</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$printRequest = new RouterOS\Request('/ip hotspot user print');
								$printRequest->setArgument('.proplist', '.id,server,name,profile,limit-uptime,limit-bytes-total,uptime,bytes-in,bytes-out');
								$printRequest->setQuery(RouterOS\Query::where('.id', '*0', RouterOS\Query::OP_EQ) ->not()); 

								$idList = '';
								$i = 0;
								foreach ($client->sendSync($printRequest)->getAllOfType(RouterOS\Response::TYPE_DATA) as $item) {
									if (!empty($item->getProperty('limit-uptime'))) {
										if (!($item->getProperty('uptime') < $item->getProperty('limit-uptime'))) {
											$i++;
											echo '<tr>';
												echo '<td>'.$i.'</td>';
												echo '<td>', $item->getProperty('server'),'</td>';
												echo '<td>', $item->getProperty('name'), '</td>';
												echo '<td>', $item->getProperty('profile'), '</td>';
												echo '<td>', $item->getProperty('limit-uptime'), '</td>';
												echo '<td>', $item->getProperty('uptime'),'</td>';
												echo '<td>', $item->getProperty('limit-bytes-total'), '</td>';
												echo '<td>', $item->getProperty('bytes-in'), '</td>';
												echo '<td>', $item->getProperty('bytes-out'), '</td>';
											echo '</tr>';
										}
									}	
								}
								?>
							</tbody>
						</table>
                    </div>
					<div class="col-sm-3 col-sm-offset-5">
						<button name="uissuing" id="uissuing" onClick="ajaxExpired();" class="btn btn-success"><i class="icon-save icon-large"></i></a>&nbsp;Remove All</button>&nbsp;&nbsp;&nbsp;
						<button data-dismiss="modal" class="btn btn-info" ><i class="icon-save icon-large"></i></a>&nbsp;BACK</button>
					</div>
                </div>
            </div>
        </div>
        <!-- 6. Start Remove All Expired Guest Users Section -->		
	
		<!-- 7. Start Server Log Section -->
        <div class="child-modal modal fade" id="server-log" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
						<div class="col-sm-2 col-sm-offset-5">
							<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
						</div>
						<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="table-01">
								<div class="alert alert-info">
									<strong><i class="icon-user icon-large"></i><h3 class="text-center">Server Event Log - Last 1000 activities</h3></strong>
								</div>
								<thead>
									<tr>
										<th>#</th>
										<th>Time</th>
										<th>Topic</th>
										<th>Description</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									foreach ($util->setMenu('/log')->getAll() as $entry) {
										$i++;	
										echo '<tr>';
											echo '<td>'.$i.'</td>';
											echo '<td>', $entry('time'),'</td>';
											echo '<td>', $entry('topics'), '</td>';
											echo '<td>', $entry('message'), '</td>';
										echo '</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-sm-2 col-sm-offset-5">
							<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
						</div>						
					</div>
				<!--</div>-->
				</div>
			</div>
		</div>
        <!-- 7. End Server Log Section -->		

		<!-- 9. Start System User Management Section -->
		<div class="child-modal modal fade" id="system-user" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="no_print">
						<div class="row">
							<div class="col-sm-4 col-sm-offset-4">
								<a href="#change-password" data-toggle="modal" class="btn btn-primary btn-lg center-element"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Change My Password</a>&nbsp;&nbsp;
							</div>
							<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="table-01">
									<div class="alert alert-info">
										<strong><i class="icon-user icon-large"></i><h3 class="text-center">System Users managing Hotspot Activities</h3></strong>
									</div>
									<thead>
										<tr>
											<th>Username</th>
											<th>Password</th>                                 
											<th>Firstname</th>                                 
											<th>Lastname</th>
											<th>Level</th>
											<?php if($_SESSION['user_level'] == 1) { //Administrator Only
												echo '<th>Actions</th>';
											} ?>	
										</tr>
									</thead>
									<tbody>
										<?php 
										$stmt = $DB_con->prepare("SELECT * FROM hotspot_users WHERE 1");
										$stmt->execute(array());
										while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
											$id=$row['user_id'];
											if ($row['status'] == 'Active') { echo '<tr class="alert-info">'; } else { echo '<tr class="alert-danger">'; }
											?>
												<td><?php echo $row['username']; ?></td> 
												<td><?php echo '..............'; ?></td> 
												<td><?php echo $row['firstname']; ?></td> 
												<td><?php echo $row['lastname']; ?></td>
												<?php 
												switch ($row['user_level']) {
													case 1 :
														echo '<td>Administrator</td>';
														break;
													case 2 :
														echo '<td>Unit Head</td>';
														break;
													case 3 :
														echo '<td>System User</td>';
														break;
												} 
												if($_SESSION['user_level'] == 1) { //Administrator Only
													echo '<td>';
														echo '<a title="Get Details of User & More Actions" id="'.$id.'" data-id="'.$id.'" name="'.$id.'"  href="#getUserModal" data-toggle="modal" class="btn btn-primary btn-lg"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a>&nbsp;&nbsp;';
													echo '</td>';
												} ?>
											</tr>
											<?php
										} ?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-2 col-sm-offset-5">
								<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- 9. End System User Management Section -->		
		
		<!-- 10. Start Remove All Un-Initiated Guest Users Section -->
        <div class="child-modal modal fade" id="remove-uninitiated" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
					<div class="col-sm-2 col-sm-offset-5">
						<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
					</div>
                    <div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
						<?php $util->setMenu('/ip hotspot user'); ?>
						<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="table-01">
							<div class="alert alert-info">
								<strong><i class="icon-user icon-large"></i><h3 class="text-center">User accounts not yet initiated any activities, and can be removed</h3></strong>
							</div>
							<thead>
								<tr>
									<th>#</th>
									<th>Server</th>
									<th>User</th>
									<th>Profile</th>
									<th>Uptime Limit</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								foreach ($util->getAll() as $item) {
									if ($item->getProperty('uptime') == 0) {
									$i++;										
										echo '<tr>';
											echo '<td>'.$i.'</td>';
											echo '<td>', $item->getProperty('server'),'</td>';
											echo '<td>', $item->getProperty('name'),'</td>';
											echo '<td>', $item->getProperty('profile'),'</td>';
											echo '<td>', $item->getProperty('limit-uptime'), '</td>';
										echo '</tr>';
									}
								} ?>
							</tbody>
						</table>
                    </div>
					<div class="col-sm-3 col-sm-offset-5">
						<?php if($_SESSION['user_level'] <= 2) {
							echo '<button name="uissuing" id="uissuing" onClick="ajaxUninitiated();" class="btn btn-success"><i class="icon-save icon-large"></i></a>&nbsp;Remove All</button>&nbsp;&nbsp;&nbsp;';
						} ?>	
						<button data-dismiss="modal" class="btn btn-info" ><i class="icon-save icon-large"></i></a>&nbsp;CANCEL</button>
					</div>
                </div>
            </div>
        </div>
        <!-- 10. Start Remove All Un-Initiated Guest Users Section -->
		
		<!-- 11. Start HotSpot User Profiles Management Section -->
		<div class="child-modal modal fade" id="profiler" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="no_print">
						<div class="row">
							<div class="col-sm-2 col-sm-offset-5">
								<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
							</div>
							<div class="col-sm-12 col-md-12 thumbnail" style="box-shadow: 10px 10px 5px #888888;">
								<?php $util->setMenu('/ip hotspot user profile'); ?>								
								<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="table-01">
									<div class="alert alert-info">
										<strong><i class="icon-user icon-large"></i><h3 class="text-center">HotSpot User Profiles Available</h3></strong>
									</div>
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Session Timeout</th>                                 
											<th>Keepalive Timeout</th>
											<th>Shared Users</th>
											<th>Rate Limit(Rx/Tx)</th>
											<th>MAC Cookie Timeout</th>
											<?php if($_SESSION['user_level'] == 1) { //Administrator Only
												echo '<th>Actions</th>';
											} ?>	
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										foreach ($util->getAll() as $item) {
											$i++;										
											echo '<tr>';
												echo '<td>'.$i.'</td>';
												echo '<td>', $item->getProperty('name'),'</td>';
												echo '<td>', $item->getProperty('session-timeout'), '</td>';
												echo '<td>', $item->getProperty('keepalive-timeout'), '</td>';
												echo '<td>', $item->getProperty('shared-users'), '</td>';
												echo '<td>', $item->getProperty('rate-limit'), '</td>';
												echo '<td>', $item->getProperty('mac-cookie-timeout'), '</td>';

												if($_SESSION['user_level'] == 1) { //Administrator Only
													echo '<td>';
													echo '<a title="Get Details of the Profile & More Actions" id="'.$id.'" data-id="'.$item->getProperty('name').'" name="'.$id.'"  href="#getProfileModal" data-toggle="modal" class="btn btn-primary btn-lg"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a>';
												echo '</td>';
												} ?>
											</tr>
											<?php
										} ?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-2 col-sm-offset-5">
								<button data-dismiss="modal" class="btn btn-info center-element" ><i class="icon-save icon-large"></i>&nbsp;BACK</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 11. End HotSpot User Profiles Management Section -->
	</div>		
</body>

<?php
include('modal_change_pass.php');
include('modal_get_user.php');
include('modal_delete_user.php');
include('modal_edit_user.php');
include('modal_reset_pass.php');
include('modal_get_profiles.php');	
?>