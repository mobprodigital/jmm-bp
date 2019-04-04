<div class="ad-menu" style="display:<?php 
if( $activeaction == 'website'){
	if(isset($_GET['affiliateid'])){
		echo 'block';
	}else{
		echo 'none';
	}
	}else{
		echo 'block';
	}?>">
	<ul class="menu1">
		<li><a href="<?php  echo base_url().'publisher/website?affiliateid='.$_GET['affiliateid'];?>"   	style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'website'){echo 'background:#428bca;'; } } ?>" class="top-menu"    		id="home">Website Properties</a></li>
		<li><a href="<?php  ///echo base_url().'users/linked_zone';?>"    				style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_zone'){echo 'background:#428bca;'; } } ?>" class="top-menu"   		id="stats">Invocation Code</a></li>
		<li><a href="<?php  //echo base_url().'users/linked_trackers';?>"     		style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction == 'linked_trackers'){echo 'background:#428bca;'; } } ?>" class="top-menu"   	id="inventory">User Access</a></li>
	</ul>
</div>






