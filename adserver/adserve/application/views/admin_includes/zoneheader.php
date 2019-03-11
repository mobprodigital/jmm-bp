<div class="ad-menu" style="display:<?php 
if( $activeaction == 'zones' || $activeaction == 'zone_include' || $activeaction == 'zone_advance' || $activeaction == 'zone_invocation' || $activeaction == 'zone_probability'|| $activeaction == 'zone_invocation_vast'){
	
	if(isset($_GET['zoneid'])){
		$zoneid			= $_GET['zoneid'];
		$affiliateid	= $_GET['affiliateid'];
		echo 'block';
	}else{
		

		echo 'none';
	}
	}else{
		echo 'block';
	}?>">
	<?php if(isset($_GET['zoneid'])){ ?>
	<ul class="menu1">
		<li><a href="<?php  echo base_url().'users/zone?affiliateid='.$affiliateid.'&zoneid='.$zoneid;?>"   style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction=='zones'){echo 'background:#428bca;'; } } ?>" class="top-menu"    id="home">Zone Properties</a></li>
		<li><a href="<?php  echo base_url().'users/zone_advance?affiliateid='.$affiliateid.'&zoneid='.$zoneid;?>"    style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction=='zone_advance'){echo 'background:#428bca;'; } } ?>" class="top-menu"   id="stats">Advance</a></li>
		<li><a href="<?php  echo base_url().'users/zone_include?affiliateid='.$affiliateid.'&zoneid='.$zoneid;?>"    style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction=='zone_include'){echo 'background:#428bca;'; } } ?>" class="top-menu"    id="inventory">Linked Banners</a></li>
		<li><a href="<?php  echo base_url().'users/zone_probability?affiliateid='.$affiliateid.'&zoneid='.$zoneid;?>"  style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction=='zone_probability'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="preferences">Probabilty</a></li>
		<li><a href="<?php  echo base_url().'users/zone_invocation?affiliateid='.$affiliateid.'&zoneid='.$zoneid;?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction=='zone_invocation'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="preferences">Invocation Code</a></li>
		<?php if(isset($zoneData[0]->delivery) && $zoneData[0]->delivery == 'html'){ ?>
		<li><a href="<?php  echo base_url().'users/zone_invocation_vast?affiliateid='.$affiliateid.'&zoneid='.$zoneid;?>" style="<?php if(isset($cat)){ if($cat	== 'inventory' && $activeaction=='zone_invocation_vast'){echo 'background:#428bca;'; } } ?>" class="top-menu"  id="preferences">Generate Vast Tags</a></li>
		<?php } ?>
	</ul>
	<?php } ?>
</div>
<?php //echo '<pre>';print_r($zoneData);die;?>