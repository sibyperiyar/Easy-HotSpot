<div id="getProfileModal" class="child-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">	
			<form class="form-horizontal" method="post">
				<div class="modal-body">
					<div class="alert alert-info text-center"><strong>HotSpot User Profiles for Guest Users</strong></div>
					<div class="form-group">
						<label class="control-label col-xs-2">Profile Name</label>
						<div class="col-xs-3">
							<div class="input-group">
								<input type="hidden" id="profile_id" name="id" >
								<input type="text" id="profile_name" size="20" onChange="genClick();" required tabindex="1" autofocus>
							</div>
						</div>
						<label class="control-label col-xs-2">Validity</label>
						<div class="col-xs-3 pull-left">
							<div class="input-group">
								<input type="text" id="validity" size="20"  title="Validity can be in days ( 3d), hours (4h) or weeks (1w) etc or like 3d 10:30:00" onChange="genClick();" required tabindex="2">
							</div>
						</div>						
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2">Grace Period</label>
						<div class="col-xs-3">
							<input type="text" id="grace_period" title="Grace period, if any in wdhms format" onChange="genClick();" tabindex="3">
						</div>
						<label class="control-label col-xs-2 pull-left">On Expiry</label>
						<div class="col-xs-3 pull-left">
							<select class="myCombo" id="on_expiry" title="What to do on expiry of accounts created using this profile, Remove account or Just keep disabled" onChange="genClick();" required tabindex="4">
								<!-- <option></option> -->
								<option value="">Select...</option>
								<option value="0">None</option>								
								<option value="rem">Remove</option>
								<option value="ntf">Notice</option>
								<option value="remc">Remove & Record</option>
								<option value="ntfc">Notice & Record</option>
							</select>
						</div>						
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2">Usage Price</label>
						<div class="col-xs-3">
							<input type="number" id="price" min="0" title="Usage price if any" onChange="genClick();" tabindex="5">
						</div>
						<label class="control-label col-xs-2 pull-left">Lock User</label>
						<div class="col-xs-3 pull-left">
							<select class="myCombo" id="lock_user" title="Lock user to any single device at a time?" onChange="genClick();" required tabindex="6">
								<option></option>
								<option value="Enable">Enable</option>								
								<option value="Disable">Disable</option>
							</select>
						</div>
					</div>					
					<div class="form-group">
						<label class="control-label col-xs-2">Rate limit - Download(Rx)</label>
						<div class="col-xs-3">
							<select class="myCombo" id="rx_rate_limit" title="Select the maximum Download speed limit allowed for the profile from the list" onChange="genClick();"  required tabindex="7">
								<option></option>		
								<option value="256k">256 Kbps</option>
								<option value="512k">512 Kbps</option>
								<option value="1M">1 Mbps</option>
								<option value="2M">2 Mbps</option>
								<option value="3M">3 Mbps</option>
								<option value="4M">4 Mbps</option>
								<option value="5M">5 Mbps</option>
								<option value="6M">6 Mbps</option>
								<option value="7M">7 Mbps</option>
								<option value="8M">8 Mbps</option>
								<option value="10M">10 Mbps</option>
								<option value="25M">25 Mbps</option>
								<option value="50M">50 Mbps</option>
								<option value="100M">100 Mbps</option>
								<option value="500M">500 Mbps</option>
								<option value="800M">800 Mbps</option>
								<option value="1024M">1 Gbps</option>
								<option value="10240M">10 Gbps</option>
								<option value="20480M">20 Gbps</option>
								<option value="102400M">100 Gbps</option>
							</select>
						</div>
						<label class="control-label col-xs-2 pull-left">Rate limit - Upload(Tx)</label>
						<div class="col-xs-3 pull-left">
							<select class="myCombo" id="tx_rate_limit" title="Select the maximum Upload speed limit allowed for the profile from the list" onChange="genClick();" name="status" required tabindex="8">
								<option></option>		
								<option value="256k">256 Kbps</option>
								<option value="512k">512 Kbps</option>
								<option value="1M">1 Mbps</option>
								<option value="2M">2 Mbps</option>
								<option value="3M">3 Mbps</option>
								<option value="4M">4 Mbps</option>
								<option value="5M">5 Mbps</option>
								<option value="6M">6 Mbps</option>
								<option value="7M">7 Mbps</option>
								<option value="8M">8 Mbps</option>
								<option value="10M">10 Mbps</option>
								<option value="25M">25 Mbps</option>
								<option value="50M">50 Mbps</option>
								<option value="100M">100 Mbps</option>
								<option value="500M">500 Mbps</option>
								<option value="800M">800 Mbps</option>
								<option value="1024M">1 Gbps</option>
								<option value="10240M">10 Gbps</option>
								<option value="20480M">20 Gbps</option>
								<option value="102400M">100 Gbps</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-2">Shared Users</label>
						<div class="col-xs-3">
							<input type="number" id="shared_users" title="Select No of users allowed to share a connection ( 1- 5 )" min=1  max=5 onChange="genClick();" tabindex="9">
						</div>
						<label class="control-label col-xs-2">Session Timeout</label>
						<div class="col-xs-3 pull-left">
							<input type="text" id="session_timeout" title="Session Timeout Value in the format 3d 00:00:00, Give 00:00:00 or none for No Limits" onChange="genClick();" tabindex="10" >
						</div>						
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2">MAC Cookie Timeout</label>
						<div class="col-xs-3">
							<input type="text" id="mac_cookie_timeout" size="12" title="MAC Cookie Timeout Value in the format 1d 00:00:00" onChange="genClick();" tabindex="11">
						</div>
						<label class="control-label col-xs-2 pull-left">Keep Alive Timeout</label>
						<div class="col-xs-3 pull-left">
							<input type="text" id="keepalive_timeout" size="12" title="Keepalive Timeout Value in the format 00:00:00" onChange="genClick();" tabindex="12">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-sm-10 col-sm-offset-1">
						<?php
						echo '<button name="add_profile" id="add_profile" onClick="addprofile(this.form);" class="btn btn-info" data-dismiss="modal" tabindex="13"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add New</button>';
						echo '<button name="edit_profile" id="edit_profile" onChange="genClick();" onClick="editprofile(this.form);" class="btn btn-success" data-dismiss="modal" tabindex="14"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>';
						echo '<button name="delete_profile" id="delete_profile" onClick="deleteprofile(this.form);" class="btn btn-danger" data-dismiss="modal" tabindex="15"><i class="fa fa-trash" aria-hidden="true"></i>Delete Profile</button>';
						echo '<button name="close_btn" id="close_btn" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" tabindex="16"><i class="fa fa-times" aria-hidden="true"></i>Close</button>';
						?>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>