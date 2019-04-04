<style>
.sidebar-menu .treeview-menu>li.active>a{background: #c3c2c2; color: #3a3030;}
.skin-blue .sidebar-menu>li>.treeview-menu {margin: 0px;padding-left: 0px;}
.sidebar-menu .treeview-menu>li>a {padding: 5px 5px 5px 60px;}

</style>
<?php $pubId = $this->session->userdata('uid');
		if(!($pubId)){
			$pubId	= 0;
		}
	
?>
<aside class="main-sidebar" style="color:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo '#ebebeb'; }else{echo '#fff';} }else{echo '#fff';} ?>">
	<section class="sidebar">
		<ul class="sidebar-menu" id="inventory_sidebar" style="display:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
			
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='website' || $activeaction == 'viewwebsite') {echo 'active';}}?>"><a href="#"><i class="fa fa-home"></i><span>Website</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'website'){ echo 'active';}}?>><a href="<?php echo base_url()."publisher/website";?>">Add Website</a></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewwebsite'){echo 'active';}}?>><a href="<?php echo base_url()."publisher/viewwebsite";?>">View Website</a></li>
				</ul>
            </li>
			
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='zones' || $activeaction == 'viewzones' || $activeaction == 'zones' || $activeaction == 'zone_advance' || $activeaction == 'zone_include' || $activeaction == 'zone_probability' || $activeaction == 'zone_invocation') {echo 'active';}}?>"><a href="#"><i class="fa fa-file-o"></i><span>Zones</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'zones'){ echo 'active';}}?>><a href="<?php echo base_url()."publisher/zone";?>">Add Zones</a></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewzones' ){echo 'active';}}?>><a href="<?php echo base_url()."publisher/viewzone";?>">View Zones</a></li>
				</ul>
            </li>
			
			</ul>	
			
			<!-- Statistics section left sidebar -->
			<ul class="sidebar-menu"  id="stats_sidebar"  style="display:<?php if(isset($cat)){ if($cat	== 'statistics'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
				<li class="treeview <?php if(isset($activeaction)){if($activeaction == 'webzonestats' || $activeaction=='webzonevideostats'){echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='webzonestats' || $activeaction =='webzonestats' ) {echo 'active-sidebar';}}?>"  href="<?php echo base_url().'publisher/webzonestats';?>"><i class="fa fa-home"></i><span>Websites & Zones</span><i class="fa fa-angle-left pull-right"></i></a></li>
				
			</ul>
	</section>
</aside>