<div class="ad-menu" style="margin-bottom:20px;display:<?php
$zoneString = ''; 
if( $activeaction == 'webzonestats'){ 
	if(isset($_GET['affiliateid'])){
		
		if(isset($_GET['breakthrough'])){
			$breakthrough 	= $_GET['breakthrough'];
			if(isset($_GET['zoneid'])){
				$zoneString = '&zoneid='.$_GET['zoneid']; 
			}

		}else{
			$breakthrough = '';
		}
		
		$queryString	= '&affiliateid='.$_GET['affiliateid'];
		echo 'block';
	}else{
		$queryString		= '';
		$breakthrough = '';

		echo 'none';
	}
	}else{
		$breakthrough = '';
		echo 'none';
	}?>">
	<ul class="menu1">
		<li>
			<a href="<?php  echo base_url().'publisher/webzonestats?'.$queryString;?>" style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'webzonestats' && ($breakthrough == 'affiliate' || $breakthrough == '')){echo 'background:#428bca;'; } } ?>" class="top-menu" id="home">Website Statistics</a>
		</li>
		<li>
			<a href="<?php echo base_url().'publisher/webzonestats?breakthrough=zone'.$queryString;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'webzonestats' && $breakthrough == 'zone'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Zone </a>
		</li>
		<li>
			<a href="<?php echo base_url().'publisher/webzonestats?breakthrough=campaigns'.$queryString.$zoneString;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'webzonestats' && $breakthrough == 'campaigns'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Campaign Distribution</a>
		</li>
		
		<!-- start website video ad report -->
		<?php if(isset($checkVideoPub) && $checkVideoPub['checkVideoPubStatus']){
		if($checkVideoPub['expansionType'] == 'Zone'){
			$videoReportUrl ="?breakthrough=zone&zoneid=".$checkVideoPub['zoneid']."&affiliateid=".$checkVideoPub['affiliateid']; 
			
		}else{
			$videoReportUrl ="?breakthrough=affiliate&affiliateid=".$checkVideoPub['affiliateid']; 
			
		}
		
		?>
		<li>
			<a href="<?php echo base_url().'publisher/webzonevideostats'.$videoReportUrl;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'webzonestats' && $breakthrough == 'video'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats"> <?php echo $checkVideoPub['expansionType'];?> Video Report</a>
		</li>
		<?php } ?>
		<!-- end website video ad report -->

		
		
		
		<?php if((isset($_GET['bannerid']) && ($_GET['bannerid'] != 'null')) && ($this->uri->segment(2) == 'videoadreportnew' || $this->uri->segment(2) == 'videoadimpression')){ ?>
		<li style="display:<?php if(isset($_GET['bannerid'])){ echo 'block';}else{echo 'none';}?>">
			<a href="<?php echo base_url().'publisher/videoadimpression?bannerid='.$_GET['bannerid'];?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'videoadimpression'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Video Impression</a>
		</li>
		<?php } ?>
		<?php $role		= $this->session->userdata('role');?>
		<?php if($role == 'view report'){ ?>
		<li >
			<a href="<?php echo base_url().'publisher/videoadimpression';?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'videoadimpression'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Video Impression</a>
		</li>
		
		<?php } ?>
			
		<!--<li>
			<a href="<?php  echo base_url().'users/stats?breakthrough=advertiser';?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'stats' && $breakthrough=='advertiser'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Advertiser History</a>
		</li>
		
		<li>
			<a href="<?php  echo base_url().'users/stats?breakthrough=campaigns';?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'stats'&& $breakthrough=='campaigns'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Campaign</a>
		</li>
		
		
		<?php  if(isset($_GET['bannerid'])){ ?>
		<li>
			<a href="<?php  if(isset($_GET['bannerid'])){
				$bannerParam		= '&bannerid='.$_GET['bannerid'];
			}else{
				$bannerParam		= '';
				
			}
			echo base_url().'users/stats?breakthrough=placements'.$bannerParam;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'stats'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Website Distribution</a>
		</li>
		
		<?php } ?>
		-->
		
	</ul>
		<input type="hidden" name="scriptName" id="scriptName" value="<?php echo $this->uri->segment(2);?>">

</div>