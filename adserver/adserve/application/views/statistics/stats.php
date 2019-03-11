<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php $this->load->view('admin_includes/report_header');?>
						<?php //echo '<pre>';print_r($banners);die;?>	
										
						<form action="stats.php" name="period_form" id="period_form">
							<input type="hidden" value="day" name="statsBreakdown"/>
							<input type="hidden" value="" name="listorder"/>
							<input type="hidden" value="up" name="orderdirection"/>
							<input type="hidden" value="" name="day"/>
							<input type="hidden" value="15" name="setPerPage"/>
							<input type="hidden" value="global" name="entity"/>
							<input type="hidden" value="advertiser" name="breakdown"/>
							
							<select  class="report-period" id="affiliate_period_preset" name="affiliate_period_preset">
								<?php if(isset($_GET['bannerid']) && isset($_GET['period'])){ ?>
									<option value="<?php echo $value;?>"><?php echo $label;?></option>

								<?php }elseif(isset($_GET['bannerid'])){ ?>
									<option value="all_stats">All statistics</option>

								<?php } ?>
								<option value="today">Today</option>
								<option value="yesterday">Yesterday</option>
								<option value="this_month">This month</option>
								<option value="all_stats">All statistics</option>
								<option value="specific">Specific dates</option>
							</select>
							<label style="margin-left: 1em" for="period_start"></label>
							<input type="text"  tabindex="0" value="<?php if(isset($start_date))echo $start_date;?>" id="period_start" name="period_start" class="date" readonly="" style="background-color: rgb(204, 204, 204);"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_start_button" src="<?php echo base_url()?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
							
							
							<label style="margin-left: 1em" for="period_end"> </label>
							<input type="text"  tabindex="0" value="<?php if(isset($end_date))echo $end_date;?>" id="period_end" name="period_end" class="date" readonly="" style="background-color: rgb(204, 204, 204);"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_end_button" src="<?php echo base_url()?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
											
							<a  onclick="return customDateSubmissionVideo();" href="JavaScript:void(0);">
								<img border="0" tabindex="6" src="<?php echo base_url()?>assets/upimages/ltr/go_blue.gif">
							</a>
							
							</form>
							
							
							</br></br>
							<a  style="float:right;margin-bottom: 10px;" href="">
								<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel
							</a>
							
							<!-- start of campaign breakthrough -->
							<?php if($breakthrough == 'campaigns'){ ?>
								<?php if(isset($completeSet)){ ?>
								<table id="example" style="margin-top: 10px;" class="table table-striped" >
							<thead>
								<tr>
									<th width="25%">Name</th>
									<th width="12%" style="text-align:center;">Impressions</th>
									<th width="12%" style="text-align:center;">Clicks</th>
									
									
								
								</tr>
							</thead>
							<tbody>
								<?php foreach($completeSet as $key => $values){ //echo '<pre>';print_r($values['campaigns']);die;
									  if(!empty($values['campaigns'])){
										  $campaigns	= $values['campaigns'];//echo '<pre>';print_r($campaigns);die;
										  foreach($campaigns as $campkey => $campvalue){ ?>
											<tr style="background-color: <?php if($campkey % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
												<td>
													<?php if("sadfas"){ ?>
													<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-campaign.gif">&nbsp;&nbsp;&nbsp;&nbsp;
													<?php }else{ ?>
													<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-campaign.gif">&nbsp;&nbsp;&nbsp;&nbsp;
													<?php } ?><a href="<?php echo base_url().'users/adcampstats?campaignid='.$campvalue['campaignid'];?>"><?php echo $campvalue['campaignname'];?></a>
												</td>
												<td style="text-align:center;"><?php  if($campvalue['view_sum'] =='0'){echo '-';}else{echo $campvalue['view_sum'];}?></td>
												<td style="text-align:center;"><?php if($campvalue['click_sum'] == '0'){echo '-';}else{echo $campvalue['click_sum'];}?></td>
												
												
											</tr>
											  
										  <?php }} ?>
								                 
								<?php }} ?>
									</table>
							<?php } ?>
							<!-- end of campaign breakthrough -->
							
								
							<!-- start of advertiser breakthrough -->
							<?php if($breakthrough == 'advertiser'){ ?>
								<?php if(isset($completeSet)){ ?>
								<table id="example" style="margin-top: 10px;" class="table table-striped" >
							<thead>
								<tr>
									<th width="25%">Name</th>
									<th width="12%" style="text-align:center;">Impressions</th>
									<th width="12%" style="text-align:center;">Clicks</th>
								</tr>
							</thead>
							
						
							<tbody>
								<?php foreach($completeSet as $key => $values){ ?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
									<td>
										<?php if("sadfas"){ ?>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-advertiser.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }else{ ?>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-advertiser.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php } ?><a href="<?php echo base_url().'users/stats?breakthrough=advertiser&clientid='.$values['clientid'];?>"><?php echo $values['clientname'];?></a>
									</td>
									<td style="text-align:center;"><?php  if($values['view_sum'] =='0'){echo '-';}else{echo $values['view_sum'];}?></td>
									<td style="text-align:center;"><?php if($values['click_sum'] == '0'){echo '-';}else{echo $values['click_sum'];}?></td>
								</tr>
							</tbody>								
							<?php }} ?>
							
							</table>
							<?php } ?>
							<!-- end of campaign breakthrough -->
							
							
							<!-- start of placements breakthrough -->
							<?php if($breakthrough == 'placements' && isset($_GET['affiliateid'])){ ?>						
							<?php if(isset($detailsData)){ ?>						
						<div class="stat-name">
							<div class="stat-camp"><img src="<?php echo base_url();?>assets/upimages/icon-campaign.png" class="header-image"><div class="ad-name">Campaign : <?php  echo ucfirst($campaignName);?></div></div>
							<div class="stat-affiliate"><img src="<?php echo base_url();?>assets/upimages/icon-affiliate.gif" class="header-image"><div class="ad-name"> Website : <?php  echo $_GET['affiliateid'];?></div></div>
						</div>
						<table id="example" style="margin-top:15px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="25%">Days</th>
										<th width="12%" style="text-align:center;">Requests</th>
										<th width="12%" style="text-align:center;">Impressions</th>
										<th width="12%" style="text-align:center;">Clicks</th>
										<th width="12%" style="text-align:center;">25%  Completion</th>
										<th width="12%" style="text-align:center;">50%  Completion</th>
										<th width="12%" style="text-align:center;">75%  Completion</th>
										<th width="12%" style="text-align:center;">100% Completion</th>
									</tr>
								</thead>
							<tbody>
								
								<?php foreach($detailsData as $key=>$value){ ?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#fff';}else{echo '#f1f1f1';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $value['cdate'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['reqst'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['impr'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['clk'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['firstQuad'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['secondQuad'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['thirdQuad'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $value['fourthQuad'];?>
									</td>
								</tr>                 
								<?php } ?>
							</tbody>
						</table>
						<?php } ?>
						<?php } ?>
							
							
							<?php if($breakthrough == 'placements' && (isset($_GET['bannerid']) && !(isset($_GET['affiliateid'])))){ ?>						
							<?php if(($creativetype == 'html5') || ($creativetype == 'web')){ ?>
							<table id="example" style="margin-top: 10px;" class="table table-striped" >
								<thead>
									<tr>
										<th width="25%">Site</th>
										<th width="12%" style="text-align:center;">Requests</th>
										<th width="12%" style="text-align:center;">Impressions</th>
										<th width="12%" style="text-align:center;">Clicks</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($placement)){ ?>
								<?php foreach($placement as $key => $value){ ?>
								<tr style="background-color: <?php $key =0;if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-affiliate.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="<?php echo base_url().'users/stats?breakthrough=placements&bannerid='.$_GET['bannerid'].'&affiliateid='.$value['domain'];?>"><?php echo $value['domain'];?></a>
									</td>
									<td style="text-align:center;"><?php  echo $value['requests']; ?></td>
									<td style="text-align:center;"><?php  echo $value['impressions']; ?></td>
									<td style="text-align:center;"><?php  echo $value['clicks']; ?></td>
								</tr>
								<?php }} ?>
								</tbody>
							</table>
							
							
							<?php }else{ ?>
							<table id="example" style="margin-top: 10px;" class="table table-striped" >
							<thead>
								<tr>
									<th width="25%">Site</th>
									<th width="12%" style="text-align:center;">Impressions</th>
									<th width="12%" style="text-align:center;">Clicks</th>
									<th width="12%" style="text-align:center;">25%  Completion</th>
									<th width="12%" style="text-align:center;">50%  Completion</th>
									<th width="12%" style="text-align:center;">75%  Completion</th>
									<th width="12%" style="text-align:center;">100% Completion</th>
								</tr>
							</thead>
							<tbody>
							
								<?php if($breakthrough == 'advertiser'){ ?>
								<?php if(isset($completeSet)){ ?>
								<?php foreach($completeSet as $key => $values){ ?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
									<td>
										<?php if("sadfas"){?>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-advertiser.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php }else{ ?>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-advertiser.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php } ?><a href="<?php echo base_url().'users/adcampstats?clientid='.$values['clientid'];?>"><?php echo $values['clientname'];?></a>
									</td>
									<td style="text-align:center;"><?php  if($values['view_sum'] =='0'){echo '-';}else{echo $values['view_sum'];}?></td>
									<td style="text-align:center;"><?php if($values['click_sum'] == '0'){echo '-';}else{echo $values['click_sum'];}?></td>
									
								
								
								
								</tr>                 
								<?php }} ?>
								<?php } ?>
								
								
								
								
								<?php if($breakthrough == 'placements'){  ?>
								<?php if(isset($affiliate)){ ?>
								<?php $key=1; ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td>
											<?php if("sadfas"){ ?>
											<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-affiliate.gif">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php }else{ ?>
											<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-affiliate.gif">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php } ?><a href="<?php echo base_url().'users/stats?breakthrough=placements&bannerid='.$_GET['bannerid'].'&affiliateid='.$affiliate['zone_id'];?>"><?php echo $affiliate['zone_id'];?></a>
										</td>
										<td style="text-align:center;"><?php  if($affiliate['impressions'] =='0'){echo '-';}else{echo $affiliate['impressions'] ;}?></td>
										<td style="text-align:center;"><?php  if($affiliate['vclicks'] =='0'){echo '-';}else{echo $affiliate['vclicks'] ;}?></td>
										<td style="text-align:center;"><?php  if($affiliate['firstquartile'] =='0'){echo '-';}else{echo $affiliate['firstquartile'] ;}?></td>
										<td style="text-align:center;"><?php  if($affiliate['midpoint'] =='0'){echo '-';}else{echo $affiliate['midpoint'] ;}?></td>
										<td style="text-align:center;"><?php  if($affiliate['thirdquartile'] =='0'){echo '-';}else{echo $affiliate['thirdquartile'] ;}?></td>
										<td style="text-align:center;"><?php  if($affiliate['complete'] =='0'){echo '-';}else{echo $affiliate['complete'] ;}?></td>
									</tr>
								<?php }} ?>
							</tbody>
						</table>
							<?php }} ?>
							<!-- end of placements breakthrough -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $this->load->view('admin_includes/footer');?>
	<!-- Page script -->
	<script type="text/javascript">
		$('#period_start').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		});
		$('#period_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		});
		
		function customDateSubmissionVideo(){
			
			var start_date				= document.getElementById('period_start').value;
			var end_date				= document.getElementById('period_end').value;
			window.location.href		= 			"stats?breakthrough=placements&affiliateid=<?php  if(isset($_GET['affiliateid'])){echo $_GET['affiliateid'];}?>&bannerid="+<?php  if(isset($_GET['bannerid'])){echo $_GET['bannerid'];}?>+"&period=specific&start_date="+start_date+"&end_date="+end_date;
}
</script>


													