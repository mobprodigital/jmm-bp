<div class="content-wrapper">
	<section class="content-header">
	<label><input  name="campaigns"  id="campaigns" class="search form-control" style="width:295px;" placeholder="Search" value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
		<input type="submit" class="btn btn-primary" name="submit" id="submit" value="search" >
		<div class="dropdown-content">
		</div>
		</label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/compaign','Add new campaign');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<img src="<?php echo base_url()?>assets/upimages/icon-campaign-large.png"/><span>Campaings <?php if(!(empty($campaign))){echo 'of '.$campaign[0]->clientname;}?></span>
						<a href="#" id="delete-advertiser"><img src="<?php echo base_url()?>assets/img/1011.png" style="margin-left:54px;margin-right: 10px;"/>Delete</a>
					</div>
					<?php if(isset($advertiserlist)){?>
					<select  name="advertiserlist" id="advertiserlist"  class="right-corner-select"/>
						<?php if(isset($nocampaign)){ ?>
						<option value="<?php echo $nocampaign[0]->clientid;?>"><?php echo $nocampaign[0]->clientname;?></option>
						<?php } ?>
						<option value="">--select advertiser--</option>
						<?php foreach($advertiserlist as $key => $value){?>
						<option value="<?php echo $value->clientid;?>"><?php echo $value->clientname;?></option>
						<?php } ?>
					</select>
					<?php } ?>
					<div class="box-body">
						<div>
							<table id="example" class="table table-bordered table-striped" >
								<thead>
									<tr class="header-row center-align">
										<th width="40%">Name</th>
										<th width="10%" class="center-align">Status</th>
										<th width="20%" class="center-align">Action</th>
										<th width="20%" class="center-align">Details</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($campaign)){ ?>
									<?php foreach($campaign as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><img src="<?php echo base_url();?>/assets/upimages/icon-campaign-disabled.png">&nbsp;&nbsp;<a href="<?php echo base_url();?>users/compaign?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"><?php echo $value->campaignname;?></a></td>
										<td class="center-align">
<span class="camstatus" id="<?php echo $value->campaignid;?>" style="cursor: pointer;color:
	<?php if($value->camp_stat==1){echo 'green';}else{echo '#eb7e23';}?>">
	<?php if($value->camp_stat==1){echo 'active';}else{echo 'inactive';}?>
</span></td>
										<td class="center-align">
											<a href="<?php echo base_url();?>users/banner?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"><div  class="btn bg-blue btn-xs">Add new banner</div></a>
											<a href="<?php echo base_url();?>users/viewbanner?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"   style="padding: 0px 20px;"><div  class="btn bg-purple btn-xs">Banners</div></a>
						
										</td>
										<td>
						<style> .panel table td{padding-left: 5px;}.panel table th{padding-left: 32px;}</style>
						<div class="panel" style="font-size: 11px;">
                        <table  cellpadding=0 cellspacing=0>
                            <tbody><tr >
                                <th>Impressions Booked</th>
                                <td><?php echo $value->target_impression;?></td>
                            </tr>
                            <tr >
                                <th>Clicks Booked</th>
                                <td><?php echo $value->target_click;?></td>
                            </tr>
                            <tr >
                                <th>Conversions Booked</th>
                                <td><?php echo $value->target_conversion;?></td>
                            </tr>
                            <tr>
                                <th>Start date</th>
                                <td><?php echo $value->activate_time;?></td>
                            </tr>
                            <tr >
                                <th>End date</th>
                                <td><?php echo $value->expire_time;?></td>
                            </tr>
                            <tr>
                                <th>Priority</th>
                                <td><?php echo $value->priority;?></td>
                            </tr>
                        </tbody>
						</table>

                        <div class="corner top-left"></div>
                        <div class="corner top-right"></div>
                        <div class="corner bottom-left"></div>
                        <div class="corner bottom-right"></div>
                    </div></td>
									</tr>                 
									<?php } ?>
									<?php }else{ ?>
									<tr style="outline: thin solid <?php if($key % 2 == 0){echo '#e6e6e6';}else{echo '#ffffff';}?>">
										<td></td>
										<td class="center-align"><b>No campaigns available</b></td>
										<td></td>
										<td></td>
										<td>
										</td>
										<td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
								<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>


      
 