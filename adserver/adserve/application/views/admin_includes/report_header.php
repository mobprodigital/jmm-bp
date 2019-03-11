<div class="ad-menu" style="margin-bottom:20px;display:<?php
$campaignString = '';
$bannerQueryString	= '';
$affiliateReport    = false;
$bannerReport		= false; 
if( $activeaction == 'adcampstats'){ 
	if(isset($_GET['clientid'])){
		if(isset($_GET['breakthrough'])){
			
			$breakthrough 	= $_GET['breakthrough'];
			
			if(isset($_GET['campaignid'])){
				$campaignString = '&campaignid='.$_GET['campaignid']; 
			}
			if(isset($_GET['bannerid'])){
				$bannerQueryString	= '&bannerid='.$_GET['bannerid'];
				$bannerReport	= true; 
				
			}
			if(isset($_GET['affiliateid'])){
				$affiliateReport	= true; 
			}
		
		}else{
			$breakthrough = '';
		}
		
		$queryString	= '&clientid='.$_GET['clientid'];
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
	<?php if((!$bannerReport) && (!$affiliateReport)){ ?>
		<li>
			<a href="<?php  echo base_url().'users/adcampstats?breakthrough=client'.$queryString;?>" style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'adcampstats' && ($breakthrough == 'client' || $breakthrough == '')){echo 'background:#428bca;'; } } ?>" class="top-menu" id="home">Advertiser Statistics</a>
		</li>
		<li>
			<a href="<?php echo base_url().'users/adcampstats?breakthrough=campaign'.$queryString;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'adcampstats' && $breakthrough == 'campaign'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Campaigns </a>
		</li>
	<?php } ?>	
		<!-- start banner  report -->
		<?php if(isset($_GET['campaignid'])){
			$bannerReportUrl ="?breakthrough=banner&campaignid=".$_GET['campaignid']."&clientid=".$_GET['clientid'].$bannerQueryString; 
		?>
		<li>
			<a href="<?php echo base_url().'users/adcampstats'.$bannerReportUrl;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'adcampstats' && $breakthrough == 'banner'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Banners</a>
		</li>
		<?php } ?>
		
		<!-- end banner  report -->
		<li>
			<a href="<?php echo base_url().'users/adcampstats?breakthrough=affiliate'.$queryString.$affiliateQueryString;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'adcampstats' && $breakthrough == 'affiliate'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Website Distribution</a>
		</li>
		
		<!-- start website video ad report -->
		<?php if(isset($checkVideoAdvt) && $checkVideoAdvt['checkVideoAdvtStatus'] && !(isset($_GET['affiliateid']))){
			
		if($checkVideoAdvt['expansionType'] == 'Ad'){
			$videoReportUrl ="?breakthrough=banner&bannerid=".$checkVideoAdvt['bannerid']."&campaignid=".$checkVideoAdvt['campaignid']."&clientid=".$checkVideoAdvt['clientid']; 
		
		}elseif($checkVideoAdvt['expansionType'] == 'Campaign'){
			$videoReportUrl ="?breakthrough=campaign&campaignid=".$checkVideoAdvt['campaignid']."&clientid=".$checkVideoAdvt['clientid']; 
		
		}else{
			$videoReportUrl ="?breakthrough=client&clientid=".$checkVideoAdvt['clientid']; 
			
		}
		
		?>
		<li>
			<a href="<?php echo base_url().'users/adcampvideostats'.$videoReportUrl;?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'adcampstats' && $breakthrough == 'video'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats"> <?php echo $checkVideoAdvt['expansionType'];?> Video Report</a>
			
		</li>
		<?php } ?>
		<!-- end website video ad report -->

		
		
		
		<?php if((isset($_GET['bannerid']) && ($_GET['bannerid'] != 'null')) && ($this->uri->segment(2) == 'videoadreportnew' || $this->uri->segment(2) == 'videoadimpression')){ ?>
		<li style="display:<?php if(isset($_GET['bannerid'])){ echo 'block';}else{echo 'none';}?>">
			<a href="<?php echo base_url().'users/videoadimpression?bannerid='.$_GET['bannerid'];?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'videoadimpression'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Video Impression</a>
		</li>
		<?php } ?>
		<?php $role		= $this->session->userdata('role');?>
		<?php if($role == 'view report'){ ?>
		<li >
			<a href="<?php echo base_url().'users/videoadimpression';?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'videoadimpression'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Video Impression</a>
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