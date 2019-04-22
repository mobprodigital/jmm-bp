	<?php $this->load->view('login/header');?>

	<div class="">
		<div class="register-box-body">
		<?php if(isset($msg)){ ?>
			<p id="msg" style="color:green;"><?php echo $msg['msg'];?></p>
		<?php } ?>
			<div class="head-title">
				<h2>Sign Up for Advertiser Account</h2>
			</div>
			<form action="<?php echo base_url();?>advertiser/signup" method="post" accept-charset="utf-8" class="form-signin">
				<div class="col-md-6">
				<div class="form-group has-feedback">
					<label>Email</label>
					<font style="color:#900;">*</font>
					<input type="text" name="email" value="" class="form-control">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group has-feedback">
						<label>First Name</label>
						<font style="color:#900;">*</font>
						<input type="text" name="firstName" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-3">

				<div class="form-group has-feedback">
					<label>Last Name</label>
					<font style="color:#900;">*</font>
					<input type="text" name="lastname" value="" class="form-control">
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group has-feedback">
					<label>Password</label>
					<font style="color:#900;">*</font>
					<input type="password" name="password" value="" class="form-control">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group has-feedback">
					<label>Confirm Password</label>
					<font style="color:#900;">*</font>
					<input type="password" name="cnfm-password" value="" class="form-control">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				</div>
				<div class="col-md-6">
					<div class="form-group has-feedback">
						<label>Company Name</label>
						<font style="color:#900;">*</font>
						<input type="text" name="company" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group has-feedback">
						<label>Skype Id</label>
						<input type="text" name="skypw" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group has-feedback">
						<label>Phone</label>
						<input type="text" name="phone" value="" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="submit" name="submit" value="Sign In" class="btn btn-large btn-primary">
					</div>
				</div>
			</form> 
		</div>
	</div>
