<aside class="main-sidebar" style="color:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo '#ebebeb'; }else{echo '#fff';} }else{echo '#fff';} ?>">
	<section class="sidebar">
	
		<ul class="sidebar-menu" id="inventory_sidebar" style="display:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
			
            <!--<li class="treeview <?php if(isset($activeaction)){if($activeaction=='createuser' || $activeaction == 'viewuser') {echo 'active';}}?>"><a href="#"><i class="fa fa-user"></i> <span>Users</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'createuser'){ echo 'active';}}?>><?php echo anchor('admin/users/create','Create User');?></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewuser'){ echo 'active';}}?>><?php echo anchor('users/viewuser', 'List Users');?></a></li>
				</ul>
            </li>
			-->
			<!--  hide advertser operation  for executive--------->
			<?php $role = $this->session->userdata('role');if($role == 2){ ?>
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='advertisement' || $activeaction == 'viewadvertiser') {echo 'active';}}?>"><a href="#"><i class="fa fa-buysellads"></i><span>Advertisers</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'advertisement'){ echo 'active';}}?>><a href="<?php echo base_url();?>advertiser/advertisement" class="active-submenu">Add Advertiser</a></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewadvertiser'){echo 'active';}}?>><a href="<?php echo base_url();?>advertiser/viewadvertiser" class="active-submenu">View Advertiser</a></li>
				</ul>
            </li>
			<?php } ?>
			
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='compaign' ||  $activeaction == 'targeting'||$activeaction == 'viewcompaign'|| $activeaction == 'linked_zone'|| $activeaction == 'linked_trackers') {echo 'active';}}?>"><a href="#"><i class="fa fa-gamepad"></i><span>Campaigns</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'compaign'){echo 'active';}}?>>
					
					<?php if(isset($_GET['clientid'])){$client= '?clientid='.$_GET['clientid'];}else{$client='';}?>
					
					<a href="<?php echo base_url();?>advertiser/compaign<?php echo $client;?>" class="active-submenu">Add campaign</a></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewcompaign'){echo 'active';}}?>><a href="<?php echo base_url();?>advertiser/viewcompaign" class="active-submenu">View campaign</a></li>
				</ul>
            </li>
			
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='banner' || $activeaction == 'viewbanner'|| $activeaction == 'banner_acl' || $activeaction == 'invocation' || $activeaction == 'generatevasttags') {echo 'active';}}?>"><a href="#"><i class="fa fa-book"></i><span>Banners</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'banner'){ echo 'active';}}?>>
						<?php if(isset($_GET['clientid']) && isset($_GET['campaignid'])){
							$defaultClientCampaignId	= '?clientid='.$_GET['clientid'].'&campaignid='.$_GET['campaignid'];
						}else{
							$defaultClientCampaignId		= '';
						}
						echo anchor('advertiser/banner'.$defaultClientCampaignId, 'Add banner');?>
					</a></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewbanner'){echo 'active';}}?>><?php echo anchor('advertiser/viewbanner', 'View banner');?></li>
				</ul>
            </li>
			
			
			
			
			
			</ul>
			
		
			<!-- Statistics section left sidebar -->
			
			<ul class="sidebar-menu"  id="stats_sidebar"  style="display:<?php if(isset($cat)){ if($cat	== 'statistics'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
				<li class="treeview  <?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active-sidebar';}}?>" href="<?php echo base_url().'advertiser/adcampstats';?>"><i class="fa fa-buysellads"></i><span>Advertisers & Campaigns</span><i class="fa fa-angle-left pull-right"></i></a></li>
				
				
			
			</ul>
			
			
		</section>
      </aside>
