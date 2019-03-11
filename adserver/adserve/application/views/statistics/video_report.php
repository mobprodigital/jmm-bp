<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php $this->load->view('admin_includes/report_header');?>
						<form  name="period_form" id="period_form" method="post" style="padding-bottom: 20px; display:<?php if(isset($_GET['bannerid'])){echo 'block';}else{echo 'none';}?>">
							<input type="hidden" value="day" name="statsBreakdown"/>
							<input type="hidden" value="" name="listorder"/>
							<input type="hidden" value="up" name="orderdirection"/>
							<input type="hidden" value="" name="day"/>
							<input type="hidden" value="15" name="setPerPage"/>
							<input type="hidden" value="global" name="entity"/>
							<input type="hidden" value="advertiser"  name="breakdown"/>
							<select   class="report-period" id="period_preset" name="period_preset">
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
							<input type="text" <?php if((!$enableDateBox)){echo 'disabled';}?>  tabindex="0" value="<?php echo $start_date;?>" id="period_start" name="period_start" style="<?php if((!$enableDateBox)){echo 'background-color: rgb(204, 204, 204)';}?>"/>
							
							<label style="margin-left: 1em" for="period_end"> </label>
							<input type="text" <?php if((!$enableDateBox)){echo 'disabled';}?>  tabindex="0" value="<?php echo $end_date;?>" id="period_end" name="period_end" class="date" style="<?php if((!$enableDateBox)){echo 'background-color: rgb(204, 204, 204)';}?>"/>
							<a  id="period-form-submit" href="#" onclick="customDateSubmissionVideo();"   id="specific_date_sel">
								<img border="0" tabindex="6" src="<?php echo base_url()?>assets/upimages/ltr/go_blue.gif"></a>
							</form>
							</br>
							
							<?php if(isset($banners) && !empty($banners)){ ?>
							<a  style="float:right;margin-bottom: 10px;" href="#">
								<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel</a>
							
							<table id="example" style="margin-top: 10px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="75%">Video Banner</th>
										<th width="25%" style="text-align: center;">Action</th>
								</tr>
								</thead>
							<tbody>
								<?php foreach($banners as $key => $values){ ?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#ffffff';}else{echo '#e6e6e6';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-html.png">&nbsp;&nbsp;&nbsp;&nbsp;
										<a class="table-first" href="<?php echo base_url().'users/videoadreport?bannerid='.$values->bannerid;?>"><?php echo $values->description;?></a>
									</td>
									<td style="text-align:center;">
										<a class="table-first" href="<?php echo base_url().'users/videoadreport?bannerid='.$values->bannerid;?>">View Report</a>

									</td>
									
								</tr>                 
								<?php } ?>
							</tbody>
						</table>
						<?php } ?>
						
						<?php if(isset($_GET['bannerid'])){ ?>
						<div class="stat-name">
							<div class="stat-camp"><img src="<?php echo base_url();?>assets/upimages/icon-campaign.png" class="header-image"><div class="ad-name">Campaign : <?php  echo ucfirst($campaignName);?></div></div>
							<div class="stat-banner"><img src="<?php echo base_url();?>assets/upimages/icon-banner.png" class="header-image"><div class="ad-name"> Banner : <?php  echo ucfirst($bannerName);?></div></div>
						</div>
						<table id="example" style="margin-top:15px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="20%">Days</th>
										<!--<th width="10%" style="text-align:center;">Requests</th>
										--><th width="10%" style="text-align:center;">Impressions</th>
										<th width="10%" style="text-align:center;">Clicks</th>
										<th width="10%" style="text-align:center;">25%  Completion</th>
										<th width="10%" style="text-align:center;">50%  Completion</th>
										<th width="10%" style="text-align:center;">75%  Completion</th>
										<th width="14%" style="text-align:center;">100% Completion</th>
									</tr>
								</thead>
							<tbody>
								
								<?php foreach($detailsData as $key=>$value){ 
								
								if(($_GET['bannerid']==15) || ($_GET['bannerid']==31)){
									$n=4.1;$c=4.1;
								}elseif($_GET['bannerid']==33){
									$n=1.1;$c=1.1;
								
								}else{
									$n=1;$c=1;
								}
								
								?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#fff';}else{echo '#f1f1f1';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php 
										$date = DateTime::createFromFormat("Y-m-d", $value['cdate']);
										echo date("F", strtotime($value['cdate']))." ".$date->format("d");echo ", ".date("Y", strtotime($value['cdate']));
										?>
									</td>
									<!--<td style="text-align:center;">
										<?php  echo floor($value['reqst']*$n);?>
									</td>-->
									<td style="text-align:center;">
										<?php echo $newval=floor($value['impr']*$n);?>
									</td>
									<td style="text-align:center;">
										<?php  echo floor($value['clk']*$c);?>
									</td>
									<td style="text-align:center;">
										<?php  echo floor($value['firstQuad']*$n);?>
									</td>
									<td style="text-align:center;">
										<?php  echo floor($value['secondQuad']*$n);?>
									</td>
									<td style="text-align:center;">
										<?php  echo floor($value['thirdQuad']*$n);?>
									</td>
									<td style="text-align:center;">
										<?php  echo floor($value['fourthQuad']*$n);?>
									</td>
								</tr>                 
								<?php } ?>
							</tbody>
						</table>
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
		
		function customDateSubmissionVideo(){
			var start_date				= document.getElementById('period_start').value;
			var end_date				= document.getElementById('period_end').value;
			window.location.href		= "videoadreport?bannerid=<?php  if($_GET['bannerid']){echo $_GET['bannerid'];}?>&period=specific&start_date="+start_date+"&end_date="+end_date;
		}

    </script>

	
	
	
	



													