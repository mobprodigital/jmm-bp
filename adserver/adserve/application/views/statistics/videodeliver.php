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
							<select class="report-period" id="period_preset" name="period_preset">
								<option value="today" <?php if(!isset($_GET['period'])){echo 'selected';}?> <?php if(isset($_GET['period']) && $value=='today'){echo 'selected';} ?>>Today</option>
								<option value="yesterday" <?php if(isset($_GET['period']) && $value=='yesterday'){echo 'selected';} ?>>Yesterday</option>
								<option value="this_month" <?php if(isset($_GET['period']) && $value=='this_month'){echo 'selected';} ?>>This month</option>
								<option value="all_stats" <?php if(isset($_GET['period']) && $value=='all_stats'){echo 'selected';} ?>>All statistics</option>
								<option value="specific" <?php if(isset($_GET['period']) && $value=='specific'){echo 'selected';} ?>>Specific dates</option>
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
										<a class="table-first" href="<?php echo base_url().'users/videoadreportnew?bannerid='.$values->bannerid;?>"><?php echo $values->description;?></a>
									</td>
									<td style="text-align:center;">
										<a class="table-first" href="<?php echo base_url().'users/videoadreportnew?bannerid='.$values->bannerid;?>">View Report</a>

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
						<?php if(!empty($vastEventData) ){
							$breakThrough	= 'Hours';
						}else{
							$breakThrough	= 'Days';
							
						}
						?>
						<?php if(!empty($vastEventData) || !empty($vastEventStartData)){ ?>
						<table id="example" style="margin-top:15px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="20%"><?php echo $breakThrough;?></th>
										<th width="10%" style="text-align:center;">Start</th>
										<th width="10%" style="text-align:center;">25%  Completion</th>
										<th width="10%" style="text-align:center;">50%  Completion</th>
										<th width="10%" style="text-align:center;">75%  Completion</th>
										<th width="14%" style="text-align:center;">100% Completion</th>
									</tr>
								</thead>
							<tbody>
								
								<?php if($label == 'Today' || $label=='Yesterday'){ ?>

								<?php $dateHour	= $start_date." 00:59:00";
									for($i=0;$i<=23;$i++){
										
									$vastEventDescription 	= array();
									foreach($vastEventData as $key=>$value){ 
										if($dateHour == $value->interval_start){ //echo '<pre>';print_r($value);die;
											$vastEventDescription['start'] = $value->count;
											
											if(($dateHour == $value->interval_start) && isset($vastEventData[$key+1]) && $vastEventData[$key+1]->vast_event_id == 2){ 
												$vastEventDescription['firstQuad'] = $vastEventData[$key+1]->count;
											}else{
												$vastEventDescription['firstQuad'] = 0;
											}
											
											if(($dateHour == $value->interval_start) && isset($vastEventData[$key+2]) && $vastEventData[$key+2]->vast_event_id == 3){ 
												$vastEventDescription['midPoint'] = $vastEventData[$key+2]->count;
											}else{
												$vastEventDescription['midPoint'] = 0;
											}
											
											if(($dateHour == $value->interval_start) && isset($vastEventData[$key+3]) && $vastEventData[$key+3]->vast_event_id == 4){ 
												$vastEventDescription['thirdQuad'] = $vastEventData[$key+3]->count;
											}else{
												$vastEventDescription['thirdQuad'] = 0;
											}
											
											if(($dateHour == $value->interval_start) && isset($vastEventData[$key+4]) && $vastEventData[$key+4]->vast_event_id == 5){ 
												$vastEventDescription['complete'] = $vastEventData[$key+4]->count;
											}else{
												$vastEventDescription['complete'] = 0;
											}
											//echo $dateHour;
											//echo '<pre>';print_r($vastEventDescription);

											break;
										
										
										}else{
											$vastEventDescription['start'] 			= 0;
											$vastEventDescription['firstQuad'] 		= 0;
											$vastEventDescription['midPoint'] 		= 0;
											$vastEventDescription['thirdQuad'] 		= 0;
											$vastEventDescription['complete'] 		= 0;
										}
										
										}
									 ?>
									
									
									
								<tr style="background-color: <?php if($i % 2 == 0){echo '#fff';}else{echo '#f1f1f1';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-time.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $dateHour;?>
									</td>
									
									
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['start'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['firstQuad'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['midPoint'];?>
									
									</td>
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['thirdQuad'];?>
									
									</td>
									
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['complete'];?>
									</td>
								</tr>                 
								<?php $dateHour = date('Y-m-d H:00:00',strtotime('+1 hour',strtotime($dateHour)));?>
								<?php } ?>
								
								
								<!-- start of all_stats and date report -->
								<?php }else{ ?>
								
								<?php $vastEventDescription 	= array();
									foreach($vastEventStartData as $key=>$value){
										$vastEventDescription['start'] = $value->total;

										$firstQuadOffset	= false;
										foreach($vastEventFirstData as $key1=>$value1){ //echo '<pre>';print_r($value1->day);
											 if($value->day == $value1->day){
												$vastEventDescription['firstQuad'] = $value1->total;
												$firstQuadOffset	= true;
												break;
											} 
										}
										
										if(!$firstQuadOffset){
											$vastEventDescription['firstQuad'] = 0;
										}
										
										
										$midPointOffset	= false;
										foreach($vastEventMidData as $key2=>$value2){ //echo '<pre>';print_r($value2);die;
											if($value->day == $value2->day){ 
												$vastEventDescription['midPoint'] = $value2->total;
												$midPointOffset	= true;
												break;
											}
										}
										if(!$midPointOffset){
											$vastEventDescription['midPoint'] = 0;
										}
										
										$thirdQuadOffset	= false;
										foreach($vastEventThirdData as $key3=>$value3){
											if($value->day == $value3->day){ //echo '<pre>';print_r($value);die;
												$vastEventDescription['thirdQuad'] = $value3->total;
												$thirdQuadOffset	= true;
												break;
											}
										}
										if(!$thirdQuadOffset){
											$vastEventDescription['thirdQuad'] = 0;
										}
										
										$completeOffset	= false;
										foreach($vastEventCompleteData as $key4=>$value4){
											if($value->day == $value4->day){ //echo '<pre>';print_r($value);die;
												$vastEventDescription['complete'] = $value4->total;
												$completeOffset	= true;
												break;
											}
										}
										if(!$completeOffset){
											$vastEventDescription['complete'] = 0;
										} ?>
										
										<tr style="background-color: <?php if($key % 2 == 0){echo '#fff';}else{echo '#f1f1f1';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $value->day;?>
									</td>
									
									
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['start'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['firstQuad'];?>
									</td>
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['midPoint'];?>
									
									</td>
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['thirdQuad'];?>
									
									</td>
									
									<td style="text-align:center;">
										<?php  echo $vastEventDescription['complete'];?>
									</td>
								</tr> 
										
										

								<?php 	} ?>
								
								<?php if(isset($totalEventData)){ ?>
								<tr class="footer-row">
									<td>Total</td>
									
									<td style="text-align:center;">
										<?php  echo $totalEventData['vastEventStartData']->total;?>
									</td>
									<td style="text-align:center;">
										<?php  echo $totalEventData['vastEventFirstData']->total;?>
									</td>
									<td style="text-align:center;">
										<?php  echo $totalEventData['vastEventMidData']->total;?>
									</td>
									<td style="text-align:center;">
										<?php  echo $totalEventData['vastEventThirdData']->total;?>
									</td>
									<td style="text-align:center;">
										<?php  echo $totalEventData['vastEventCompleteData']->total;?>
									</td>
								</tr> 
								
								<?php } ?>
								 <!-- end of total row report -->
						
								<?php } ?>
								<!-- end of all_stats and date report -->

						
						<?php }else{ ?>
							<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="http://www.crickbooks.com/revadserver/www/admin/assets/images/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no statistics available for the given period</div>
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
			window.location.href		= "videoadreportnew?bannerid=<?php  if($_GET['bannerid']){echo $_GET['bannerid'];}?>&period=specific&start_date="+start_date+"&end_date="+end_date;
		}

    </script>

	
	
	
	



													