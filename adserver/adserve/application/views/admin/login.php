<aside class="main-sidebar"
    style="color:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo '#ebebeb'; }else{echo '#fff';} }else{echo '#fff';} ?>">
    <section class="sidebar">
        <!--<div class="user-panel">
           <div class="pull-left image">
             <img src="<?php echo base_url();?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
            </div>
			
            <div class="pull-left info">
				<p><?php echo ucfirst($this->session->userdata('username')); ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
		-->
        <?php //echo $this->session->userdata('username');die;?>

        <ul class="sidebar-menu" id="inventory_sidebar" style="display:<?php if(isset($cat)){ if($cat	== 'inventory'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
            <?php if($this->session->userdata('username')=='admin'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='createuser' || $activeaction == 'viewuser') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-user"></i> <span>Users</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'createuser'){ echo 'active';}}?>>
                        <?php echo anchor('admin/users/create','Create User');?></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewuser'){ echo 'active';}}?>>
                        <?php echo anchor('users/viewuser', 'List Users');?></a></li>
                </ul>
            </li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){  ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='advertisement' || $activeaction == 'viewadvertiser') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-buysellads"></i><span>Advertisers</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'advertisement'){ echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/advertisement"><i class="fa fa-plus"
                                aria-hidden="true"></i>Add Advertiser</a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewadvertiser'){echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/viewadvertiser"><i class="fa fa-eye"
                                aria-hidden="true"></i>View Advertiser</a></li>
                </ul>
            </li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='compaign' ||  $activeaction == 'targeting'||$activeaction == 'viewcompaign'|| $activeaction == 'linked_zone'|| $activeaction == 'linked_trackers') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-gamepad"></i><span>Campaigns</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'compaign'){echo 'active';}}?>>
                        <?php if(isset($_GET['clientid'])){$client=$_GET['clientid'];}else{$client=2;}?> <a
                            href="<?php echo base_url();?>users/compaign?clientid=<?php echo $client;?>"><i
                                class="fa fa-plus" aria-hidden="true"></i>Add campaign</a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewcompaign'){echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/viewcompaign"><i class="fa fa-eye"
                                aria-hidden="true"></i>View campaign</a></li>
                </ul>
            </li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='banner' || $activeaction == 'viewbanner'|| $activeaction == 'banner_acl' || $activeaction == 'invocation' || $activeaction == 'generatevasttags') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-book"></i><span>Banners</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'banner'){ echo 'active';}}?>>
                        <?php if(isset($_GET['clientid'])){$client=$_GET['clientid'];}else{$client=2;$campaignid=1;} if(isset($_GET['campaignid'])){$campaignid=$_GET['campaignid'];}else{$campaignid=1;}echo anchor('users/banner?clientid='.$client."&campaignid=".$campaignid, 'Add banner');?></a>
                    </li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewbanner'){echo 'active';}}?>>
                        <?php echo anchor('users/viewbanner', 'View banner');?></li>
                </ul>
            </li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='website' || $activeaction == 'viewwebsite') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-home"></i><span>Website</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'website'){ echo 'active';}}?>>
                        <?php echo anchor('users/website', 'Add Website');?></a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewwebsite'){echo 'active';}}?>>
                        <?php echo anchor('users/viewwebsite', 'View Website');?></li>
                </ul>
            </li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='zones' || $activeaction == 'viewzones' || $activeaction == 'zones' || $activeaction == 'zone_advance' || $activeaction == 'zone_include' || $activeaction == 'zone_probability' || $activeaction == 'zone_invocation') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-file-o"></i><span>Zones</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'zones'){ echo 'active';}}?>>
                        <?php echo anchor('users/zone', 'Add zones');?></a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewzones' ){echo 'active';}}?>>
                        <?php echo anchor('users/viewzone', 'View zones');?></li>
                </ul>
            </li>

            <!--<?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='channel' || $activeaction == 'viewchannel') {echo 'active';}}?>"><a href="#"><i class="fa fa-twitch"></i><span>Targeting Channels</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class =<?php if(isset($activeaction)){if($activeaction == 'channel'){ echo 'active';}}?>><?php echo anchor('users/targetchannel', 'Add channel');?></a></li>
					<li class =<?php if(isset($activeaction)){if($activeaction == 'viewchannel'){echo 'active';}}?>><?php echo anchor('users/viewtargetchannel', 'View channel');?></li>
				</ul>
            </li>
			<?php }if($this->session->userdata('role')=='admin'){ ?>
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='videoads') {echo 'active';}}?>"><a href="<?php echo base_url().'users/videoads';?>"><i class="fa fa-file-video-o"></i><span>Video Ads</span><i class="fa fa-angle-left pull-right"></i></a></li>
			<?php }if($this->session->userdata('role')=='admin'){ ?>
			
			<li class="treeview <?php if(isset($activeaction)){if($activeaction=='postbackintegration') {echo 'active';}}?>"><a href="<?php echo base_url().'users/postbackintegration';?>"><i class="fa fa-file-video-o"></i><span>Post Back Integration</span><i class="fa fa-angle-left pull-right"></i></a></li>
			
			<li class="treeview <?php if(isset($activeaction)){if($activeaction=='mailer') {echo 'active';}}?>"><a href="<?php echo base_url().'users/mailer';?>"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Mailer</span><i class="fa fa-angle-left pull-right"></i></a></li>
			-->
            <li class="treeview <?php if(isset($activeaction)){if($activeaction=='notification') {echo 'active';}}?>"><a
                    href="<?php echo base_url().'notification/get_all_notifications';?>"><i class="fa fa-bell"
                        aria-hidden="true"></i><span>Notification</span></a>
            </li>
            <?php }if($this->session->userdata('role')=='admin'){ ?>

            <?php } ?>
        </ul>







        <ul class="sidebar-menu" id="inventoryyy_sidebar" style="display:<?php if(isset($cat)){ if($cat	== 'home'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
            <?php if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){  ?>
            <?php	if(isset($activeaction)){if($cat=='home'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='advertisement' || $activeaction == 'viewadvertiser') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-buysellads"></i><span>Advertisers</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'advertisement'){ echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/advertisement"><i class="fa fa-plus"
                                aria-hidden="true"></i>Add Advertiser</a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewadvertiser'){echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/viewadvertiser"><i class="fa fa-eye"
                                aria-hidden="true"></i>View Advertiser</a></li>
                </ul>
            </li>
            <?php } } ?>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='compaign' ||  $activeaction == 'targeting'||$activeaction == 'viewcompaign'|| $activeaction == 'linked_zone'|| $activeaction == 'linked_trackers') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-gamepad"></i><span>Campaigns</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'compaign'){echo 'active';}}?>>
                        <?php if(isset($_GET['clientid'])){$client=$_GET['clientid'];}else{$client=2;}?> <a
                            href="<?php echo base_url();?>users/compaign?clientid=<?php echo $client;?>"><i
                                class="fa fa-plus" aria-hidden="true"></i>Add campaign</a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewcompaign'){echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/viewcompaign"><i class="fa fa-eye"
                                aria-hidden="true"></i>View campaign</a></li>
                </ul>
            </li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction=='banner' || $activeaction == 'viewbanner'|| $activeaction == 'banner_acl' || $activeaction == 'invocation' || $activeaction == 'generatevasttags') {echo 'active';}}?>">
                <a href="#"><i class="fa fa-book"></i><span>Banners</span><i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'banner'){ echo 'active';}}?>>
                        <?php if(isset($_GET['clientid'])){$client=$_GET['clientid'];}else{$client=2;$campaignid=1;} if(isset($_GET['campaignid'])){$campaignid=$_GET['campaignid'];}else{$campaignid=1;}echo anchor('users/banner?clientid='.$client."&campaignid=".$campaignid, 'Add banner');?></a></li>
                    <li class=<?php if(isset($activeaction)){if($activeaction == 'viewbanner'){echo 'active';}}?>><a
                            href="<?php echo base_url();?>users/viewbanner"><i class="fa fa-eye" aria-hidden="true"></i>
                            View banner</a></li>
                </ul>
            </li>

            <?php } ?>
        </ul>
















        <!-- /.sidebar-menu -->
        <!-- home section left sidebar -->
        <!-- Statistics section left sidebar -->
        <ul class="sidebar-menu" id="stats_sidebar" style="display:<?php if(isset($cat)){ if($cat	== 'statistics'){ echo 'block'; }else{echo 'none';} }else{
				echo 'none';
			} ?>">
            <?php if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview  <?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active';}}?>">
                <a class="<?php if(isset($activeaction)){if($activeaction=='adcampstats' || $activeaction =='videoadreport' ) {echo 'active-sidebar';}}?>"
                    href="<?php echo base_url().'users/adcampstats';?>"><i
                        class="fa fa-buysellads"></i><span>Advertisers & Campaigns</span></a></li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <!--<li class="treeview <?php if(isset($activeaction)){if($activeaction=='history') {echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='history' || $activeaction =='history' ) {echo 'active-sidebar';}}?>" href="<?php echo base_url().'users/history';?>"><i class="fa fa-history"></i><span>Global History</span><i class="fa fa-angle-left pull-right"></i></a></li>
				-->
            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <li
                class="treeview <?php if(isset($activeaction)){if($activeaction == 'webzonestats' || $activeaction=='webzonevideostats'){echo 'active';}}?>">
                <a class="<?php if(isset($activeaction)){if($activeaction=='webzonestats' || $activeaction =='webzonestats' ) {echo 'active-sidebar';}}?>"
                    href="<?php echo base_url().'users/webzonestats';?>"><i class="fa fa-home"></i><span>Websites &
                        Zones</span></a></li>

            <?php }if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <!--<li class="treeview <?php if(isset($activeaction)){if($activeaction=='report' || $activeaction=='adreport' || $activeaction=='campanalysis' || $activeaction=='campdelivery') {echo 'active';}}?>"><a class="<?php if(isset($activeaction)){if($activeaction=='report' || $activeaction =='report' ) {echo 'active-sidebar';}}?>" href="<?php echo base_url().'users/report';?>"><i class="fa fa-bar-chart"></i><span>Advanced Reports</span><i class="fa fa-angle-left pull-right"></i></a></li>
				-->


            <?php } ?>

        </ul>

        <!-- Preferences section left sidebar -->
        <ul class="sidebar-menu" id="preferences_sidebar" style="display:<?php //echo $cat;die;
			if(isset($cat)){
				if($cat == 'preferences'){ 
					echo 'block';
				}else{
					echo 'none';
				}
			}else{
				echo 'none';
			} ?>">
            <?php if($this->session->userdata('role')=='admin' || $this->session->userdata('role')=='advertiser'){ ?>
            <!--<li class="treeview <?php if(isset($activeaction)){if($activeaction=='setting') {echo 'active';}}?>"><a href="<?php echo base_url().'users/updateprofile';?>"><i class="fa fa-user"></i><span>User Preferences</span><i class="fa fa-angle-left pull-right"></i></a>
					
				</li>
				<?php }if($this->session->userdata('role')=='admin'){ ?>
				<li class="treeview <?php if(isset($activeaction)){if($activeaction=='banner_preferences' || $activeaction == 'campaign' || $activeaction == 'campaign_email' || $activeaction == 'timezone' || $activeaction == 'interfaces') {echo 'active';}}?>"><a href="<?php echo base_url().'users/banner_preferences';?>"><i class="fa fa-cog"></i><span> Account Preferences </span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li class =<?php if(isset($activeaction)){if($activeaction == 'banner_preferences'){ echo 'active';}}?>><?php echo anchor('users/banner_preferences', 'Banner Preferences');?></a></li>
						<li class =<?php if(isset($activeaction)){if($activeaction == 'campaign'){echo 'active';}}?>><?php echo anchor('users/campaign', 'Campaigns Preferences');?></li>
						<li class =<?php if(isset($activeaction)){if($activeaction == 'campaign_email'){ echo 'active';}}?>><?php echo anchor('users/campaign_email', 'Campaigns email report <br> Preferences');?></a></li>
						<li class =<?php if(isset($activeaction)){if($activeaction == 'timezone'){echo 'active';}}?>><?php echo anchor('users/timezone', 'Timezone Preferences');?></li>
						<li class =<?php if(isset($activeaction)){if($activeaction == 'interfaces'){ echo 'active';}}?>><?php echo anchor('users/interfaces', 'User Interface Preferences');?></a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if($this->session->userdata('role')=='admin'){ ?>
				<li class="treeview <?php if(isset($activeaction)){if($activeaction=='userlog') {echo 'active';}}?>"><a href="<?php echo base_url().'users/userlog';?>"><i class="fa fa-history"></i><span>User Log</span><i class="fa fa-angle-left pull-right"></i></a>
					
				</li>
				
				<?php }if($this->session->userdata('role')=='admin'){ ?>
				<li class="treeview <?php if(isset($activeaction)){if($activeaction=='targetchannelmgt' || $activeaction== 'addchannel') {echo 'active';}}?>"><a href="<?php echo base_url().'users/targetchannelmgt';?>"><i class="fa fa-twitch"></i><span>Targeting Channel Management</span><i class="fa fa-angle-left pull-right"></i></a>
				
				</li>-->
            <?php } ?>
        </ul>
    </section>
</aside>