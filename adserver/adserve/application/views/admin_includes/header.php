<?php
ob_start();
error_reporting(E_ALL); //E_ALL ^ E_NOTICE ^ E_DEPRECATED
ini_set('display_errors', 1);

$Admin_description = 'Adserver Admin';
$title_for_admin = 'Adserver'

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
	<head>
		<meta charset="UTF-8">
		<title>Media Adserver<?php //echo $title_for_admin;?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!-- Font Awesome Icons -->
		<!-- Theme style -->
		 <link href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css"  rel="stylesheet" type="text/css">
		<!-- iCheck -->
		 <link href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css"  rel="stylesheet" type="text/css">
		<!-- Ionicons -->
		<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		 <!-- daterange picker -->
		<link href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

		<!-- Bootstrap time Picker -->
		<link href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
		 <!-- DATA TABLES -->
		 <link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css"  rel="stylesheet" type="text/css">
		<!-- Theme style -->
		
		<link href="<?php echo base_url();?>assets/dist/css/skins/skin-blue.min.css"  rel="stylesheet" type="text/css">

		<link href="<?php echo base_url();?>assets/dist/css/jquery-ui.css" rel="stylesheet">
		<!-- Morris charts -->
		<link href="<?php echo base_url();?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/ngDialog.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/ngDialog-theme-default.css">
		<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/dashboard-widget.css">
		-->

		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    
		

		<script>
			 var uname  = <?php echo json_encode($this->session->userdata('username')); ?>; 
			 var siteurl = '<?php echo base_url();?>';
		</script> 
		<style>
		 .content-header .form-control{display:none;}.content-header #submit{display:none;}.content-header .btn-primary{display:none;}
		.ad-menu .menu1 li a {
			background:#093145;
		}
		</style>
	</head>
	<body class="skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="#" class="logo">
					<span class="logo-mini"><b>M</b>Ads</span>
					<span class="logo-lg"><b>Media </b> Adserver</span>
				</a>
				<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				

				<!---------- Notification Section  ------------>
				
				<div class="navbar-custom-menu">
					
					
						<ul class="nav navbar-nav">
							<li class="dropdown notifications-menu ">
							
							<?php //print_r($this->session->userdata('notification_array'));
							$my_array = $this->session->userdata('notification_array'); 
							//print_r($my_array);
							//print_r($this->session->userdata('countNotifications')); 
							$count = count($this->session->userdata('notification_array')); ?>
							<a  data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false" id="notify" >
							
								<i class="fa fa-bell"></i>
									<span class="label label-warning" id="abc"><?php echo $count;?></span>
								</a>
								
								<ul class="dropdown-menu" >
									<li class="header">You have <?php echo $count;?> notifications</li>
									<li>
									<!-- inner menu: contains the actual data -->

									<ul class="menu" >
									<?php $i=0;   
									foreach($my_array as $CampData)
									{ 
										$camp_type = $CampData['type'];
										if($camp_type == 'under_delivered') {$campaign_per = $CampData['per']; }
									?>
										<li>
											<a href="#">
											<i class="fa fa-users text-aqua"></i> 
											<?php
											if($camp_type == 'under_delivered')
											{
											echo '<b>Under-Delivery</b> -Detected:Today Line item <b>'.$CampData['campaignname'].'</b> in order '.$CampData['campaignname'].' may not meat its delivery goal. It has delivered <b>'.$CampData['per'].'%</b> of what was  expect by now and ends on <b>'.$CampData['expire_time'].'</b>'; 
											} 
											elseif($camp_type == 'active')
											{
											echo '<b>Active</b> - Detected:Today Line item <b>'.$CampData['campaignname'].'</b> in order '.$CampData['campaignname'].' is activate within last 24 hours and ends on <b>'.$CampData['expire_time'].'</b>'; 
											}
											elseif($camp_type == 'expired')
											{
											echo '<b>Expired</b> - Detected:Today Line item <b>'.$CampData['campaignname'].'</b> in order '.$CampData['campaignname'].' was expired on <b>'.$CampData['expire_time'].'</b>'; 
											}
											?>
											</a>
										</li>
									<?php 
									$i++;
									if($i==5) break; } ?>
									</ul>
									


								</li>
								<li class="footer"><a href="<?php echo base_url('notification/get_all_notifications') ?>">View all</a></li>
								</ul>

							</li>
							<li class="dropdown user user-menu">
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								  <img src="<?php echo base_url();?>assets/dist/img/avatar.png" class="user-image" alt="User Image" />
								  <span class="hidden-xs"><?php echo ucfirst($this->session->userdata('username')); ?></span>
								</a>
								
								<ul class="dropdown-menu">
									<li class="user-body">
										<div class="col-xs-4 text-center">
										  <a href="#"></a>
										</div>
										<div class="col-xs-4 text-center">
										  <a href="#"></a>
										</div>
										<div class="col-xs-4 text-center">
										  <a href="#"></a>
										</div>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<a href="<?php echo base_url().'users/preferences/setting?uid='.$this->session->userdata('uid');?>" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?php echo site_url('admin/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
				</div>
				<!----------- Notification Section Ends ------------>
				</nav>
				<div class="ad-menu">
					<ul class="menu1">
						<li><a href="<?php  echo base_url().'users/dashboard/home';?>" style="<?php if(isset($cat)){ if($cat	== 'home'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="home">Home</a></li>
						<li><a href="<?php  echo base_url().'users/adcampstats';?>" style="<?php if(isset($cat)){ if($cat	== 'statistics'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="stats">Statistics</a></li>
						<?php $role	= $this->session->userdata('role');if($role != 'view report'){ ?>
						<li><a href="<?php  echo base_url().'users/viewadvertiser';?>"  style="<?php if(isset($cat)){ if($cat	== 'inventory'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="inventory">Inventory</a></li>
						<?php } ?>
						<li><a href="<?php  echo base_url().'users/preferences/setting';?>" style="<?php if(isset($cat)){ if($cat	== 'preferences'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="preferences">Preferences</a></li>
						
					</ul>
				</div>
			  </header>
			  
			<script>
				var script	= "<?php echo base_url();?>";
				var aa= document.getElementById("notify");
			
				$("#notify").click(function(){
				//sessionStorage.removeItem('countNotifications');
				//jQuery.session.remove('countNotifications');
				jQuery('#abc').remove();
				//document.location = 'logout.php';
                });
			</script>
			  
