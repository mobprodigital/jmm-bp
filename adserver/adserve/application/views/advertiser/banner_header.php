<div class="ad-menu" style="display:<?php 
if( $activeaction == 'banner' || $activeaction == 'invocation'){
	if(isset($_GET['bannerid'])){
		echo 'block';
	}else{
		echo 'none';
	}
	}else{
		echo 'block';
	}?>">
	
	<ul class="menu1">
		<li><a href="<?php  echo base_url().'advertiser/banner?bannerid='.$banner[0]->bannerid.'&campaignid='.$banner[0]->campaignid.'&clientid='.$banner[0]->clientid;?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'banner'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="home">Banner Properties</a></li>
		<li><a href="<?php  echo base_url().'advertiser/banner_acl?bannerid='.$banner[0]->bannerid.'&campaignid='.$banner[0]->campaignid.'&clientid='.$banner[0]->clientid;?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'banner_acl'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Delivery Option</a></li>
		<li><a href="<?php  echo base_url().'advertiser/linked_zone?bannerid='.$banner[0]->bannerid.'&campaignid='.$banner[0]->campaignid.'&clientid='.$banner[0]->clientid;?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_zone'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Linked Zones</a></li>
		<li><a href="<?php  echo base_url().'advertiser/linked_trackers';?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_trackers'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="inventory">Advanced</a></li>
	</ul>
</div>







