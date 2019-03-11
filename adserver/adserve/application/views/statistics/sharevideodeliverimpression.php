<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php $this->load->view('admin_includes/report_header');?>
						
						<form  name="period_form" id="period_form" method="post" style="padding-bottom: 20px; display:block;">
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
									<option value="today">Today</option>
									
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
							
							
						
						<div class="stat-name">
							<div class="stat-camp"><img src="<?php echo base_url();?>assets/upimages/icon-campaign.png" class="header-image"><div class="ad-name">Campaign : <?php  echo ucfirst($campaignName);?></div></div>
						</div>
						<?php if(!empty($vastimpressionData) || !empty($vastimpressionStartData)){ ?>
						<table id="example" style="margin-top:15px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="20%">Hours</th>
										<th width="10%" style="text-align:center;">Impressions</th>
										<th width="10%" style="text-align:center;">Clicks</th>
								
										
									</tr>
								</thead>
							<tbody>
								
								<?php if($label == 'Today11' || $label=='Yesterday11'){ ?>

								<?php //$dateHour	= '2018-05-06 15:00:00';
									  $dateHour	= $start_date." 00:59:00";
									for($i=0;$i<=23;$i++){ 
										$bannerCount	= count($vastEventData);
										$vastEventDescription['start'] 			= 0;
										$vastEventDescription['firstQuad'] 		= 0;
										$vastEventDescription['midPoint'] 		= 0;
										$vastEventDescription['thirdQuad'] 		= 0;
										$vastEventDescription['complete'] 		= 0;
										
										for($j=0;$j<=$bannerCount-1;$j++){
											foreach($vastEventData[$j] as $key=>$value){ //echo '<pre>';print_r($value);die;
												if($dateHour == $value->interval_start){ 
													$vastEventDescription['start'] += $value->count;
													
													if(($dateHour == $value->interval_start) && isset($vastEventData[$j][$key+1]) && $vastEventData[$j][$key+1]->vast_event_id == 2){ 
														$vastEventDescription['firstQuad'] += $vastEventData[$j][$key+1]->count;
													}else{
														$vastEventDescription['firstQuad'] += 0;
													}
													
													if(($dateHour == $value->interval_start) && isset($vastEventData[$j][$key+2]) && $vastEventData[$j][$key+2]->vast_event_id == 3){ 
														$vastEventDescription['midPoint'] += $vastEventData[$j][$key+2]->count;
													}else{
														$vastEventDescription['midPoint'] += 0;
													}
													
													if(($dateHour == $value->interval_start) && isset($vastEventData[$j][$key+3]) && $vastEventData[$j][$key+3]->vast_event_id == 4){ 
														$vastEventDescription['thirdQuad'] += $vastEventData[$j][$key+3]->count;
													}else{
														$vastEventDescription['thirdQuad'] += 0;
													}
													
													if(($dateHour == $value->interval_start) && isset($vastEventData[$j][$key+4]) && $vastEventData[$j][$key+4]->vast_event_id == 5){ 
														$vastEventDescription['complete'] += $vastEventData[$j][$key+4]->count;
													}else{
														$vastEventDescription['complete'] += 0;
													}
													//echo $dateHour;
													//echo '<pre>';print_r($vastEventDescription);
													break;
												}else{
													$vastEventDescription['start'] 			+= 0;
													$vastEventDescription['firstQuad'] 		+= 0;
													$vastEventDescription['midPoint'] 		+= 0;
													$vastEventDescription['thirdQuad'] 		+= 0;
													$vastEventDescription['complete'] 		+= 0;
												}
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
								
								<?php 
								//echo $start_date.'<br>'.$end_date;
								/* $diffDays 		                = $endTime-$startTime;
								$totalDays			            = floor($diffDays / (60 * 60 * 24)); */
								$startDate 		= strtotime($start_date); // or your date as well
								$endDate 		= strtotime($end_date);
								$datediff 		= $endDate - $startDate;
								$totolDays 		= round($datediff / (60 * 60 * 24));
								
								
								$reportDate		= date('Y-m-d',$endDate);
								$bannerCount	= count($vastimpressionStartData);
								
								for($k=0;$k<=$totolDays;$k++){ $reportDate = date('Y-m-d', strtotime($reportDate .' -1 day'));  if($reportDate >  '2018-05-16' ){ continue;}
									$vastimpressionDescription['impressions'] 		= 0;
									$vastimpressionDescription['clicks'] 	= 0;
									
									
									for($i=0;$i<=$bannerCount-1;$i++){
										if(!empty($vastimpressionStartData[$i])){
											foreach($vastimpressionStartData[$i] as $key=>$value){
												if($reportDate == $value->day){
													$vastimpressionDescription['impressions'] += $value->impressions;
													$vastimpressionDescription['clicks'] += $value->clicks;
													break;
												}
											}
										}
									}
										
									?>
										
										<tr style="background-color: <?php if($k % 2 == 0){echo '#fff';}else{echo '#f1f1f1';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $reportDate;?>
									</td>
									
									<?php $n=floor(8.1);?>
									
									<td style="text-align:center;">
										<?php  echo $vastimpressionDescription['impressions']*$n;?>
									</td>
									<td style="text-align:center;">
										<?php  echo $vastimpressionDescription['clicks']*$n;?>
									</td>
									
								</tr> 
										
									<!-- end of date loop-->
									
								<?php } ?>
								<?php } ?>
								<!-- end of all_stats and date report -->

						
						<?php }else{ ?>
							<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="http://www.crickbooks.com/revadserver/www/admin/assets/images/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no statistics available for the given period</div>
						<?php } ?>
						</tbody>
						</table>
						
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

	
	
	
	



													