<div id="getProfileModal" class="child-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">	
			<form class="form-horizontal" method="post">
				<div class="modal-body">
					<div class="alert alert-info text-center"><strong>HotSpot User Profiles for Guest Users</strong></div>
					<div class="form-group">
						<label class="control-label col-xs-3">Profile Name</label>
						<div class="col-xs-7">
							<div class="input-group">
								<input type="hidden" id="profile_id" name="id" >
								<input type="text" id="profile_name" size="40" onChange="genClick();" required tabindex="1" autofocus>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Session Timeout</label>
						<div class="col-xs-7">
							<input type="text" id="session_timeout" title="Session Timeout Value in the format 3d 00:00:00, Give 00:00:00 or none for No Limits" onChange="genClick();" tabindex="2">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Rate limit - Download(Rx)</label>
						<div class="col-xs-3">
							<select class="myCombo" id="rx_rate_limit" title="Select the maximum Download speed limit allowed for the profile from the list" onChange="genClick();" name="status" required tabindex="3">
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
							</select>
						</div>
						<label class="control-label col-xs-3 pull-left">Rate limit - Upload(Tx)</label>
						<div class="col-xs-3 pull-left">
							<select class="myCombo" id="tx_rate_limit" title="Select the maximum Upload speed limit allowed for the profile from the list" onChange="genClick();" name="status" required tabindex="4">
								<option></option>		
								<option value="128k">128 Kbps</option>
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
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3">Shared Users</label>
						<div class="col-xs-7">
							<input type="number" id="shared_users" title="Select No of users allowed to share a connection ( 1- 5 )" min=1  max=5 onChange="genClick();" tabindex="5">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">MAC Cookie Timeout</label>
						<div class="col-xs-3">
							<input type="text" id="mac_cookie_timeout" size="12" title="MAC Cookie Timeout Value in the format 1d 00:00:00" onChange="genClick();" tabindex="6">
						</div>
						<label class="control-label col-xs-3 pull-left">Keep Alive Timeout</label>
						<div class="col-xs-3 pull-left">
							<input type="text" id="keepalive_timeout" size="12" title="Keepalive Timeout Value in the format 00:00:00" onChange="genClick();" tabindex="7">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-sm-10 col-sm-offset-1">
						<?php
						echo '<button name="add_profile" id="add_profile" onClick="addprofile(this.form);" class="btn btn-info" data-dismiss="modal" tabindex="8"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add New</button>';
						echo '<button name="edit_profile" id="edit_profile" onChange="genClick();" onClick="editprofile(this.form);" class="btn btn-success" data-dismiss="modal" tabindex="9"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>';
						echo '<button name="delete_profile" id="delete_profile" onClick="deleteprofile(this.form);" class="btn btn-danger" data-dismiss="modal" tabindex="10"><i class="fa fa-trash" aria-hidden="true"></i>Delete Profile</button>';
						echo '<button name="close_btn" id="close_btn" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" tabindex="11"><i class="fa fa-times" aria-hidden="true"></i>Close</button>';
						?>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>