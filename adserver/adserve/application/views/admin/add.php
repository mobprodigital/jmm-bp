<div class="content-wrapper">
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<img src="<?php echo base_url()?>assets/upimages/icon-advertiser-add-large.png" class="header-image"/><h3 class="header"><span style="color:#333333;">Add new user</span></h3>
					</div>
					<form  method="post" name="adduser" id="adduser">
					<div class="message localMessage" style="display:<?php if(isset($msg)){echo 'block';}else{echo 'none';}?>">
							<div class="panelMessage confirm">
								<div class="icon"></div>
								<p class="message_p"><b><?php echo $msg;?></b></p>
								<div class="topleft"></div>
								<div class="topright"></div>
								<div class="bottomleft"></div>
								<div class="bottomright"></div>
								<div class="close">x</div>
							</div>
						</div>
						<div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
									<label for="username">Username<font style="color:#900;">*</font></label>
									<input type="text" class="form-control" id="username"   name="username" value="<?php if(isset($users[0]->username)){echo $users[0]->username;}?>">
									<span style="color:red" id="span_username" class="errorspan"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="password">Password<font style="color:#900;">*</font></label>
									<input type="password" class="form-control errorhandle" id="password" name="password" value="<?php if(isset($users[0]->password)){echo $users[0]->password;}?>">
									<span style="color:red"  class="errorspan" id="span_password"></span>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname" >Firstname<font style="color:#900;">*</font></label>
									<input type="text" class="form-control  errorhandle" id="firstname" name="firstname" value="<?php if(isset($users[0]->firstname)){echo $users[0]->firstname;}?>">
									<span style="color:red"  class="errorspan" id="span_firstname"></span>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname" >Lastname<font style="color:#900;">*</font></label>
									<input type="text" class="form-control  errorhandle" id="lastname"   name="lastname" value="<?php if(isset($users[0]->lastname)){echo $users[0]->lastname;}?>">
									<span style="color:red"  class="errorspan" id="span_lastname"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label >Role</label>
									<select class="form-control  errorhandle" name="role" id="role" class="form-control">
										<?php if(isset($users[0]->role)){?>
										<option value="<?php echo $users[0]->role;?>"><?php echo ucfirst($users[0]->role);?></option>
										<?php } ?>
										<option value="">--Role--</option>
										<option value="advertiser">Advertiser</option>
										<option value="publisher">Publisher</option>
										<option value="view report">View Report</option>
									</select>
									<span style="color:red"  class="errorspan" id="span_role"></span>
								</div>
							</div>
						
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit"  class="btn btn-primary" value="Submit" name="submit" id="submit">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
