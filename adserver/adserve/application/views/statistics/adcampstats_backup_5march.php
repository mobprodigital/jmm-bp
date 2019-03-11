<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php $this->load->view('admin_includes/report_header');?>
						<form action="stats.php" name="period_form" id="period_form" style="padding-bottom: 20px; display:<?php if(isset($_GET['bannerid'])){echo 'block';}else{echo 'none';}?>">
							<input type="hidden" value="day" name="statsBreakdown"/>
							<input type="hidden" value="" name="listorder"/>
							<input type="hidden" value="up" name="orderdirection"/>
							<input type="hidden" value="" name="day"/>
							<input type="hidden" value="15" name="setPerPage"/>
							<input type="hidden" value="global" name="entity"/>
							<input type="hidden" value="advertiser" name="breakdown"/>
							<select  class="report-period" id="all_period_preset" name="all_period_preset">
								<option value="today" <?php if(isset($_GET['period']) && $value=='today'){echo 'selected';} ?>>Today</option>
								<option value="yesterday" <?php if(isset($_GET['period']) && $value=='yesterday'){echo 'selected';} ?>>Yesterday</option>
								<option value="this_month" <?php if(isset($_GET['period']) && $value=='this_month'){echo 'selected';} ?>>This month</option>
								<option value="all_stats" <?php if(!isset($_GET['period'])){echo 'selected';}?><?php if(isset($_GET['period']) && $value=='all_stats'){echo 'selected';} ?>>All statistics</option>
								<option value="specific" <?php if(isset($_GET['period']) && $value=='specific'){echo 'selected';} ?>>Specific dates</option>
							
							</select>
							<label style="margin-left: 1em" for="period_start"></label>
							<input readonly="" type="text" <?php if((!$enableDateBox)){echo 'disabled';}?> tabindex="0" value="<?php echo $start_date;?>" id="period_start" name="period_start" class="date" style="<?php if((!$enableDateBox)){echo 'background-color: rgb(204, 204, 204)';}?>"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_start_button" src="<?php echo base_url()?>assets/upimages/icon-calendar-d.gif" disabled style="cursor: default;">
							
							<label style="margin-left: 1em" for="period_end"> </label>
							<input readonly="" type="text" <?php if((!$enableDateBox)){echo 'disabled';}?> tabindex="0" value="<?php echo $end_date;?>" id="period_end" name="period_end" class="date" style="<?php if((!$enableDateBox)){echo 'background-color: rgb(204, 204, 204)';}?>"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_end_button" src="<?php echo base_url()?>assets/upimages/icon-calendar-d.gif" disabled style="cursor: default;">
							
							<a id="period-form-submit" href="#" onclick="customDateSubmission();">
								<img border="0" tabindex="6" src="<?php echo base_url()?>assets/upimages/ltr/go_blue.gif">
							</a>
						</form>
						
						
							
							<a  style="float:right;padding-bottom: 10px;" href="<?php echo base_url().'users/adcampstats';if(isset($_GET['bannerid'])){echo '?bannerid='.$_GET['bannerid'].'&export=true';}?>">
								<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel
							</a>
							
							<?php if(isset($banners)){  ?>
							<table id="example" style="margin-top:10px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="64%">Banner Name</th>
										
										<th width="12%">Action</th>
										<!--
										<th width="12%" style="text-align:center;">Action</th>
										<th width="12%" style="text-align:center;">Clicks</th>
									-->
									</tr>
								</thead>
								<tbody>
									<?php foreach($banners as $key => $values){  if($values->storagetype == 'web' || $values->storagetype == 'html5'){?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#e6e6e6';}else{echo '#ffffff';}?>">
										<td>
											<?php if($values->storagetype=="web" || $values->storagetype=="exscrpt"){?>
											<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-stored-d.gif">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php }elseif($values->storagetype=="html5"){?>
											<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/html5.png">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php }else{ ?>
											<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-html.png">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php } ?><a class="table-first" href="<?php echo base_url().'users/adcampstats?bannerid='.$values->bannerid;?>"><?php echo $values->description;?></a>
										</td>
										<!--<td style="text-align:center;"><?php  if($values->impressions =='0'){echo '-';}else{echo $values->impressions;}?></td>
										<td style="text-align:center;"><?php if($values->clicks == '0'){echo '-';}else{echo $values->clicks;}?></td>
										-->
										<td>
										<a class="table-first" href="<?php echo base_url().'users/adcampstats?bannerid='.$values->bannerid;?>">View Report</a>
										</td>
									</tr>                 
									<?php }} ?>
								</tbody>
							</table>
							<?php } ?>
							
							
							<?php if(isset($detailsData)){ ?>
							<div class="stat-name">
								<div class="stat-camp"><img src="<?php echo base_url();?>assets/upimages/icon-campaign.png" class="header-image"><div class="ad-name">Campaign : <?php  echo ucfirst($campaignName);?></div></div>
								<div class="stat-banner"><img src="<?php echo base_url();?>assets/upimages/icon-banner.png" class="header-image"><div class="ad-name"> Banner : <?php  echo ucfirst($bannerName);?></div></div>
							</div>
							<?php if(!empty($detailsData)){ ?>
							
							
							<table id="example" style="margin-top:10px;" class="table">
								<thead class="header-row">
									<tr>
										<th width="52%">Days</th>
										<th width="12%" style="text-align:center;">Impr.</th>
										<th width="12%" style="text-align:center;">Clicks</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($detailsData as $key => $values){ //echo '<pre>';print_r($values);die;?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#ffffff';}else{echo '#f5f3f3';}?>">
										<td><img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php  echo $values->day;?>
										</td>
										<td style="text-align:center;"><?php  echo $values->total_count;?></td>
										<td style="text-align:center;"><?php  echo $values->clicks;?></td>
									</tr>                 
									<?php } ?>
									
								<!-- start of total row report -->
								<?php if(isset($totalImpressionData)){ ?>
								<tr class="footer-row">
									<td>Total</td>
									<td style="text-align:center;">
										<?php  echo $totalImpressionData->impressions;?>
									</td>
									<td style="text-align:center;">
										<?php  echo $totalImpressionData->clicks;?>
									</td>
								</tr> 
								<?php } ?>
								 <!-- end of total row report -->
									
									
								</tbody>
							</table>
							<?php }else{ ?>
							<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no statistics available for the given period</div>
							<?php } ?>
							<?php } ?>
						
						
						
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
		function customDateSubmission(){
			var start_date				= document.getElementById('period_start').value;
			var end_date				= document.getElementById('period_end').value;
			window.location.href		= "adcampstats?bannerid=<?php echo $_GET['bannerid'];?>&period=specific&start_date="+start_date+"&end_date="+end_date;
		}
    </script>
	
	


													