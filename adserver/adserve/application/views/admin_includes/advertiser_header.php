<div class="ad-menu" style="display:<?php 
if( $activeaction == 'advertisement'  || $activeaction == 'advetiseruserstart'){
	
	if(isset($_GET['id'])){
		echo 'block';
	}else{
		echo 'none';
	}
	}else{
		echo 'block';
	}?>">
	<ul class="menu1">
		<li><a href="<?php  echo base_url().'users/advertisement?id='.$_GET['id'];?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'advertisement'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="home">Advertiser Properties</a></li>
		<li><a href="<?php  //echo base_url().'users/linked_zone';?>"  style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_zone'){echo 'background:#428bca;'; } } ?>" class="top-menu" id="stats">Trackers</a></li>
		<li><a href="<?php  echo base_url().'users/client-access?id='.$_GET['id'];?>"  style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'advetiseruserstart'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="inventory">User Access</a></li>
	</ul>
</div>