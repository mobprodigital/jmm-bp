<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<img src="<?php echo base_url()?>assets/upimages/icon-campaign-large.png"/><span>Campaings <?php if(!(empty($campaign))){echo 'of '.$campaign[0]->clientname;}?></span>
						<div style="margin-left: 59px;"><img src="<?php echo base_url()?>assets/upimages/icon-advertiser.png"/>
						Advertiser: <?php if(!(empty($campaign))){echo $campaign[0]->clientname;}?></div>
					
					</div>
					<div class="box-body">
						<div>
						<?php if(!empty($campaign)){ ?>
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
								
									<?php foreach($campaign as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><img src="<?php echo base_url();?>/assets/upimages/icon-campaign-disabled.png">&nbsp;&nbsp;<a href="<?php echo base_url();?>executive/campaign-banners?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"><?php echo $value->campaignname;?></a></td>
										<td class="center-align">
											<span class="camstatus" id="<?php echo $value->campaignid;?>" style="cursor: pointer;color:
												<?php if($value->camp_stat==1){echo 'green';}else{echo '#eb7e23';}?>">
												<?php if($value->camp_stat==1){echo 'active';}else{echo 'inactive';}?>
											</span>
										</td>
										<td class="center-align">
											<a href="<?php echo base_url();?>executive/campaign-banners?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"   style="padding: 0px 20px;"><div  class="btn bg-purple btn-xs">Banners</div></a>
										</td>
										<td>
					    <style> .panel table td{padding-left: 5px;}.panel table th{padding-left: 32px;}</style>
						<div class="panel" style="font-size: 11px;">
                        <table  cellpadding=0 cellspacing=0>
                            <tbody>
							<tr>
							
                                <th>Goal</th>
                                <td><?php echo $value->views;?></td>
                            </tr>
							<tr>
                                <th>Goal(per day) </th>
                                <td><?php echo $value->target_impression;?></td>
                            </tr>
                            <!--<tr >
                                <th>Clicks Booked</th>
                                <td><?php echo $value->target_click;?></td>
                            </tr>
                            <tr>
                                <th>Conversions Booked</th>
                                <td><?php echo $value->target_conversion;?></td>
                            </tr>
							<tr>
                                <th>Priority</th>
                                <td><?php echo $value->priority;?></td>
                            </tr>
                            <tr>-->
                                <th>Start date</th>
                                <td><?php echo $value->activate_time;?></td>
                            </tr>
                            <tr>
                                <th>End date</th>
                                <td><?php echo $value->expire_time;?></td>
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
					</tbody>
				</table>
				<?php }else{ ?>
				<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">No Campaings Exist</div>
				<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>


      
 