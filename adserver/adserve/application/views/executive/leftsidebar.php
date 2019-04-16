<?php

	if(isset($_GET['clientid'])){ 
		$clientString 	= '?clientid='.$_GET['clientid'];
	}else{
		$clientString 	= '';
	}
?>
<aside class="main-sidebar" style="color:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo '#ebebeb'; }else{echo '#fff';} }else{echo '#fff';} ?>">
	<section class="sidebar">
	
		<ul class="sidebar-menu" id="inventory_sidebar" style="display:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
			
			<li class="treeview <?php if(isset($activeaction)){if($activeaction=='compaign' ||  $activeaction == 'targeting'||$activeaction == 'viewcompaign'|| $activeaction == 'linked_zone'|| $activeaction == 'linked_trackers') {echo 'active';}}?>"><a href="#"><i class="fa fa-gamepad"></i><span>Campaigns</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewcompaign'){echo 'active';}}?>><a href="<?php echo base_url();?>advertiser/advertiser-campaigns<?php echo $clientString;?>" class="active-submenu">View campaign</a></li>
				</ul>
            </li>
		</ul>
			
		
			<!-- Statistics section left sidebar -->
			
			<ul class="sidebar-menu"  id="stats_sidebar"  style="display:<?php if(isset($cat)){ if($cat	== 'statistics'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
				<li class="treeview  <?php if(isset($activeaction)){if(($activeaction=='adcampstats' || $activeaction =='videoadreport') && $breakthrough=='') {echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active-sidebar';}}?>" href="<?php echo base_url().'executive/adcampstats?clientid='.$_GET['clientid'];?>"><i class="fa fa-buysellads"></i><span>Advertiser Statistics</span><i class="fa fa-angle-left pull-right"></i></a>
				</li>
				<li class="treeview  <?php if(isset($activeaction)){if(($activeaction=='adcampstats' || $activeaction =='videoadreport')&& $breakthrough) {echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active-sidebar';}}?>" href="<?php echo base_url().'executive/adcampstats?clientid='.$_GET['clientid'].'&breakthrough=campaign';?>"><i class="fa fa-buysellads"></i><span>Campaigns</span><i class="fa fa-angle-left pull-right"></i></a>
				
				<!--<li class="treeview  <?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport') {echo 'active-sidebar';}}?>" href="<?php echo base_url().'executive/adcampstats?clientid='.$_GET['clientid'];?>"><i class="fa fa-buysellads"></i><span>Website Distribution</span><i class="fa fa-angle-left pull-right"></i></a>
				-->
				
			</ul>
			
			
		</section>
      </aside>
