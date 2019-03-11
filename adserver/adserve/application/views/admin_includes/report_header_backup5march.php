
<div class="ad-menu" style="margin-bottom:20px;display:<?php 
if( $activeaction == 'adcampstats' || $activeaction =='videoadreportnew'){
	if(isset($_GET['id'])){
		echo 'block';
	}else{
		echo 'block';
	}
	}else{
		echo 'block';
	}?>">
	<ul class="menu1">
		<li>
			<a href="<?php  echo base_url().'users/adcampstats';?>" style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'adcampstats'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="home">Banner Report</a>
		</li>
		<li>
			<a href="<?php echo base_url().'users/videoadreportnew';?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'videoadreportnew'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Video Ad Report</a>
		</li>
		
		
		<?php if((isset($_GET['bannerid']) && ($_GET['bannerid'] != 'null')) && ($this->uri->segment(2) == 'videoadreportnew' || $this->uri->segment(2) == 'videoadimpression')){ ?>
		<li style="display:<?php if(isset($_GET['bannerid'])){ echo 'block';}else{echo 'none';}?>">
			<a href="<?php echo base_url().'users/videoadimpression?bannerid='.$_GET['bannerid'];?>"  style="<?php if(isset($cat)){ if($cat	== 'statistics' && $activeaction == 'videoadimpression'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Video Impression</a>
		</li>
		<?php } ?>
		<?php $role					= $this->session->userdata('role');?>
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