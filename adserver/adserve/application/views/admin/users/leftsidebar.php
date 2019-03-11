<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<!-- search form -->
		<!-- /.search form -->
		<!-- sidebar menu: :style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">Inventory</li>
			<li class="treeview">
				<a href="#"><span>Advertiser</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/advertisement">Add	Advertiser</a></li>
					<li><a href="<?php echo base_url();?>user/editadvertiser">Edit Advertiser</a></li>
					<li><a href="<?php echo base_url();?>user/viewadvertiser">View Advertiser</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><span>Publisher</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/addpublisher">Add Publisher</a></li>
					<li><a href="<?php echo base_url();?>user/editpublisher">Edit Publisher</a></li>
					<li><a href="<?php echo base_url();?>user/viewpublisher">View Publisher</a></li>
				</ul>
			</li>
			
			<li class="treeview">
				<a href="#"><span>Video Ad</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/uploadvideo">Upload Video</a></li>
					<li><a href="<?php echo base_url();?>user/generatesource">Generate Code</a></li>
					<li><a href="<?php echo base_url();?>user/videoadreport">Reports</a></li>
					<li><a href="<?php echo base_url();?>user/listuploadsvideos">List</a></li>


				</ul>
			</li>
			
			
			<!--<li class="treeview">
				<a href="#"><span>Banner</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/addbanner">Add Banner</a></li>
					<li><a href="<?php echo base_url();?>user/editbanner">Edit Banner</a></li>
					<li><a href="<?php echo base_url();?>user/viewbanner">View Banner</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><span>Compaign</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/addcompaign">Add Compaign</a></li>
					<li><a href="<?php echo base_url();?>user/editcompaign">Edit Publisher</a></li>
					<li><a href="<?php echo base_url();?>user/viewcompaign">View Publisher</a></li>
				</ul>
			</li><li class="treeview">
				<a href="#"><span>Channel</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/addchannel">Add Channel</a></li>
					<li><a href="<?php echo base_url();?>user/editchannel">Edit Channel</a></li>
					<li><a href="<?php echo base_url();?>user/viewchannel">View Channel</a></li>
				</ul>
			</li><li class="treeview">
				<a href="#"><span>Zone</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>user/addzone">Add Zone</a></li>
					<li><a href="<?php echo base_url();?>user/editzone">Edit Zone</a></li>
					<li><a href="<?php echo base_url();?>user/viewzone">View Zone</a></li>
				</ul>
			</li>-->
			<li class="treeview">
				<a href="<?php echo base_url();?>user/sendemail"><span>Send Email</span><i class="fa fa-angle-left pull-right"></i></a>
			</li>
		</ul>
	</section>
    <!-- /.sidebar -->
</aside>