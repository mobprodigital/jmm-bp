<?php $this->load->view('login/header');?>
		<div class="">
			<div class="register-box-body">
			<div class="head-title">
				<h2>Sign Up for Publisher Account</h2>
			</div>
			<form action="<?php echo base_url();?>publisher/signup" method="post" accept-charset="utf-8" class="form-signin">
				<div class="col-md-6">
				<div class="form-group has-feedback">
					<label>Email</label>
					<font style="color:#900;">*</font>(This is your username that you will use to login.)
					<input type="text" name="email" value="" class="form-control">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group has-feedback">
						<label>First Name</label>
						<font style="color:#900;">*</font>
						<input type="text" name="firstname" value="" class="form-control">
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
						<input type="text" name="company" value="" class="form-control">
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

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>