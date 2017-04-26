<div class="child-modal modal fade" id="change-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="chPassword" method="post">
				<div class="modal-body">
					<div class="alert alert-info text-center"><strong>Welcome <?php echo $_SESSION['username'].', '; ?> Change Your Login Password</strong></div>
					<div class="form-group">
						<label class="control-label col-sm-6">Type-in New Password</label>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters length" name="np" id="newpassword" placeholder="New Password" required="true" autofocus tabindex="1">
								<div id='chPassword_np_errorloc' class="error_strings"></div>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6">Re-type New Password</label>
						<div class="col-sm-6">
							<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters length" name="rp" id="retypepassword" placeholder="Re-type New Password" required="true" tabindex="2">
							<div id='chPassword_rp_errorloc' class="error_strings"></div>
						</div>
					</div>
				</div>	
				<div class="modal-footer">
					<div class="col-sm-12">
						<div class="col-sm-3 col-sm-offset-3">
							<div class="pull-right">
								<button name="update_pass" id="update_pass" type="submit" onClick="changePass(this.form);" class="btn btn-success" data-dismiss="modal" tabindex="3"><i class="icon-save icon-large"></i>&nbsp;Update</button>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="pull-left">	
								<a href="index.php" data-dismiss="modal" class="btn btn-info" tabindex="4"><i class="icon-arrow-left icon-large"></i>&nbsp;Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		<!--	<script type="text/javascript">
				var frmvalidator  = new Validator("chPassword");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();
				
				frmvalidator.addValidation("np","req","Please enter your New Password");
				frmvalidator.addValidation("np","regexp=^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$",
                                          "Must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters length");
				frmvalidator.addValidation("rp","req","Please retype your New Password");
				frmvalidator.addValidation("rp","regexp=^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$",
                                          "Must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters length");						  
				frmvalidator.addValidation("np","eqelmnt=rp", "Both Passwords should be same");						  
			</script> 
			<script type="text/javascript">
				window.onload = function (){
				eventHandler = function (e){
				if (e.keyCode === 13 ) //Enter key to Trap
					{
					event.preventDefault();
					$("#update_pass").trigger('click'); /*
					var cti = document.activeElement.tabIndex;
					if (cti == 1 ) 
						$('[tabindex=' + (cti + 1) + ']').focus();
					else
						$('[tabindex=' + (cti - 1) + ']').focus();
					return false; */
					}
				}
			window.addEventListener('keydown', eventHandler, false);
			} ;
			</script> -->
		</div>	
	</div>
</div>