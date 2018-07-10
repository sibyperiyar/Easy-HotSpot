<div id="delete<?php echo $item->getProperty('name'); ?>" class="child-modal modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">	
			<form class="form-horizontal" method="post">
				<div class="modal-body">
					<div class="alert alert-info text-center"><strong>Delete Guest User</strong></div>
					<div class="form-group">
						<label class="control-label col-xs-3">Username</label>
						<div class="col-xs-7">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="text" size="40" name="username" value="<?php echo $item->getProperty('name'); ?>" readonly>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="uptime">Limit Uptime</label>
						<div class="col-xs-7">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="text" name="uptime" value="<?php echo $item->getProperty('limit-uptime'); ?>" readonly>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Address</label>
						<div class="col-xs-7">
							<input type="text" name="firstname" value="<?php echo $item->getProperty('address'); ?>" readonly>
						</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="lastname">Uptime</label>
						<div class="col-xs-7">
							<input type="text" name="lastname" value="<?php echo $item->getProperty('uptime'); ?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="session-time-left">Session time Left</label>
						<div class="col-xs-7">
							<input type="text" name="session-time-left" value="<?php echo $item->getProperty('session-time-left'); ?>" readonly>
						</div>
					</div>
				</div>	
				<div class="modal-footer">
					<div class="col-sm-12">
						<div class="col-sm-3 col-sm-offset-3">
							<div class="pull-right">
								<button name="issuing" onClick="removeAjax('<?php echo $item->getProperty('name'); ?>')" class="btn btn-success" data-dismiss="modal"><i class="icon-save icon-large"></i></a>&nbsp;Remove</button>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="pull-left">
								<button class="btn btn-error" data-dismiss="modal" ><i class="icon-save icon-large"></i></a>&nbsp;BACK</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>