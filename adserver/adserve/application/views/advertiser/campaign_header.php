<div class="ad-menu" style="display:<?php 
if( $activeaction == 'compaign'){
	if(isset($_GET['campaignid'])){
		echo 'block';
	}else{
		echo 'none';
	}
	}else{
		echo 'block';
	}?>">
	<!--<ul class="menu1">
		<li><a href="<?php  echo base_url().'advertiser/compaign?campaignid='.$_GET['campaignid'].'&clientid='.$_GET['clientid']?>"  style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'compaign'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="home">Campaign Properties</a></li>
		<li><a href="<?php  echo base_url().'advertiser/targeting?campaignid='.$_GET['campaignid'].'&clientid='.$_GET['clientid'].$target;?>"  	style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'targeting'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Targeting</a></li>
		<li><a href="<?php  echo base_url().'advertiser/linked_zone';?>"  style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_zone'){echo 'background:#428bca;'; } } ?>" class="top-menu"   		id="stats">Linked Zones</a></li>
		<li><a href="<?php  echo base_url().'advertiser/linked_trackers';?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_trackers'){echo 'background:#428bca;'; } } ?>" class="top-menu"   	id="inventory">Linked Trackers</a></li>
	</ul>
	-->
</div>



 





