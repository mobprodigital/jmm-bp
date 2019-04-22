<?php $this->load->view('advertiser/header');?>
<style>
.content-wrapper,.main-footer{margin-left:0px;}

	#top-header {
    background: none repeat scroll 0 0 #093145;
    padding: 0;
    line-height: 45px;
}
	.form-control{width:100%;}
	.login-select{
		float:right;
		width:4%;

	}
	.signup{
	    float: right;
		width: 15%;
	}
	 .login-link,.signup-link{
		color:#fff;
		font-size: 14px;
		font-weight: 500;
	}
	
	.login-item a {
		color:black;
		font-size: 14px;
		font-weight: 500;
	}
	
	.login-item  li{
		list-style:none;
		line-height: 24px;
	}
	
	.login-select{
		position :relative;
		
	}
	.login-select:hover .login-item {
		display: block;
	}
	
	.login-item{
		display: none;
		position :absolute;
		z-index:12;
		background: #ddd;
		width: 222px;
		right: 0px;
		top: 45px;
		text-align: center;
	}
	.col-md-6{width:50%;}
	
	.register-box-body {
   
    border: none;
}
	.head-title{margin-left: 3.5%;padding:0px;}
	.login-page, .register-page {
		background: #fff;
	}
	.a{
		color:#fff;
		
	
	}
	
</style>
<div class="content-wrapper" style="min-height: 368px;">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<?php if(isset($msg)){ ?>
						<div id="messagePlaceholder" class="messagePlaceholder">
							<div class="message localMessage">
								<div class="panel confirm">
									<div class="icon"></div>
									<p><?php echo $msg;?></p>
									<div class="topleft"></div>
									<div class="topright"></div>
									<div class="bottomleft"></div>
									<div class="bottomright"></div>
									<div class="close">x</div>
								</div>
							</div>
						</div>
					<?php } ?>
					</div>
					<div class="box-body">
					<div class="">
					
			<div class="register-box-body">
			<?php if(isset($profile) && !empty($profile)){ ?>
			
			<div class="head-title">
				<h2>Account Info</h2>
			</div>
			<form action="<?php echo base_url();?>advertiser/profile?uid=<?php echo $_GET['uid'];?>" method="post" accept-charset="utf-8" class="form-signin">
				<div class="col-md-6">
				<div class="form-group has-feedback">
					<label>Email</label>
					<font style="color:#900;">*</font>(This is your username that you will use to login.)
					<input type="text" name="email" value="<?php echo $profile->username;?>" class="form-control">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group has-feedback">
						<label>First Name</label>
						<font style="color:#900;">*</font>
						<input type="text" name="firstname" value="<?php echo $profile->firstname;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">

				<div class="form-group has-feedback">
					<label>Last Name</label>
					<font style="color:#900;">*</font>
					<input type="text" name="lastname" value="<?php echo $profile->lastname;?>" class="form-control">
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group has-feedback">
					<label>Password</label>
					<font style="color:#900;">*</font>
					<input type="password" name="password" value="<?php echo $profile->password;?>" class="form-control">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				</div>
				<div class="col-md-6">
					<div class="form-group has-feedback">
						<label>Company Name</label>
						<font style="color:#900;">*</font>
						<input type="text" name="company" value="<?php echo $profile->company;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group has-feedback">
						<label>Skype Id</label>
						<input type="text" name="company" value="<?php echo $profile->skype;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group has-feedback">
						<label>Phone</label>
						<input type="text" name="phone" value="<?php echo $profile->phone;?>" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" style="margin-left: 35px;">
						<input type="submit" name="submit" value="Update" class="btn btn-large btn-primary">
					</div>
				</div>
			</form> 
			<?php }else{ ?>
			<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">Account Info not exist</div>
			<?php } ?>
			</div>
			</div>
					
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('admin_includes/footer');?>

		



			