<div class="ad-menu" style="margin-bottom:20px;display:block">
	<ul class="menu1">
		<!-- start website video ad report -->
		<?php /* if(isset($checkVideoPub) && $checkVideoPub['checkVideoPubStatus']){
		if($checkVideoPub['expansionType'] == 'Zone'){
			$videoReportUrl ="?breakthrough=zone&zoneid=".$checkVideoPub['zoneid']."&affiliateid=".$checkVideoPub['affiliateid']; 
		}else{
			$videoReportUrl ="?breakthrough=affiliate&affiliateid=".$checkVideoPub['affiliateid']; 
		} */
		$videoReportUrl	="";
		?>
		<li>
			<a href="<?php echo base_url().'users/webzonevideostats'.$videoReportUrl;?>"  style="background:#428bca;" class="top-menu" id="stats"><?php //echo $checkVideoPub['expansionType'];?> Video Report</a>
		</li>
		<?php //} ?>
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
			
	
		
	</ul>
		<input type="hidden" name="scriptName" id="scriptName" value="<?php echo $this->uri->segment(2);?>">

</div>