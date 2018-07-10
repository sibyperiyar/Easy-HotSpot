<div id="getUserModal" class="child-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">	
			<form class="form-horizontal" method="post">
				<div class="modal-body">
					<div class="alert alert-info text-center"><strong>Edit System User</strong></div>
					<div class="form-group">
						<label class="control-label col-xs-3">Username</label>
						<div class="col-xs-7">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="hidden" id="user_id" name="id" >
								<input type="text" id="username" size="40" onChange="genClick();" name="username" required tabindex="1" autofocus>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Firstname</label>
						<div class="col-xs-7">
							<input type="text" id="firstname" onChange="genClick();" name="firstname"  required tabindex="2">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Lastname</label>
						<div class="col-xs-7">
							<input type="text" id="lastname" onChange="genClick();" name="lastname" tabindex="3">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">User Level</label>
						<div class="col-xs-7">
							<select id="user_level" onChange="genClick();" name="user_level" required tabindex="4">
								<?php
								switch ($row['user_level']) {
									case 1 :
										echo '<option value="1">Administrator</option>';
										break;
									case 2 :
										echo '<option value="2">Unit Head</option>';
										break;
									case 3 :
										echo '<option value="3">System User</option>';
										break;
								} ?>
								<option value="3">System User</option>
								<option value="2">Unit Head</option>
								<option value="1">Administrator</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">User Status</label>
						<div class="col-xs-3">
							<select class="myCombo" id="status" onChange="genClick();" name="user_status" required tabindex="5">
								<option></option>		
								<option value="Active">Active</option>
								<option value="Disabled">Disabled</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-sm-12">
						<?php
						echo '<button name="add_user" id="add_user" onClick="addsysuser(this.form)" class="btn btn-primary" data-dismiss="modal"><i class="icon-save icon-large"></i>Add User</button>';
						echo '<button name="edit_user" id="edit_user" onChange="genClick();" onClick="edituser(this.form);" class="btn btn-success" data-dismiss="modal" tabindex="6"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>';
						echo '<button name="delete_user" id="delete_user" onClick="deleteuser(this.form);" class="btn btn-danger" data-dismiss="modal" tabindex="7"><i class="fa fa-trash" aria-hidden="true"></i>Remove User</button>';
						echo '<button name="reset_psd" id="reset_psd" onClick="resetpass(this.form);" class="btn btn-info" data-dismiss="modal" tabindex="8"><i class="fa fa-bolt" aria-hidden="true"></i>Reset Pass</button>';
						echo '<button name="close_button" id="close_button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" tabindex="9"><i class="fa fa-times" aria-hidden="true"></i>Close</button>';
						?>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>