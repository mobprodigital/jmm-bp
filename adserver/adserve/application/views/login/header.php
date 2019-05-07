<?php

$Login_description = 'Admin';
$title_for_layout = 'Adserver'
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title_for_layout;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
     <link href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css"  rel="stylesheet" type="text/css">
    <!-- iCheck -->
     <link href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css"  rel="stylesheet" type="text/css">
	<style>
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
	.register-box-body{
		width: 72%;
		margin-left: 10%;
		margin-top: 5%;
	}
	.head-title{margin-left: 3.5%;padding:0px;}
	.login-page, .register-page {
		background: #fff;
	}
	.a{
		color:#fff;
		
	
	}
	</style>
  </head>
  <body class="login-page">
  <header id="top-header" class="header">
	<a href="<?php echo base_url();?>" style="color:#fff;">MediaAds</a>
  <div class="signup">
		<a href="<?php echo base_url();?>registration" class="signup-link">Sign Up</a>
	</div>
	<div class="login-select">
		<a href="#" class="login-link">Login</a>
			<div class="login-item">
				<ul>
					<li><a href="<?php echo base_url();?>publisher/login">Publisher</a></li>
					<li><a href="<?php echo base_url();?>advertiser/login">Advertiser</a></li>

				</ul>
			</div>
	</div>
	
  
  
  &nbsp;</header>