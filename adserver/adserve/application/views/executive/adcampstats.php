<?php $this->load->view('executive/header');?>
<?php $this->load->view('executive/leftsidebar');?>


<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<div class="hasIcon iconTargetingChannelsLarge" style="margin-bottom:20px;">
						<div id="thirdLevelHeader" class="hasTabs">
							<div class=" hasIcon iconTargetingChannelsLarge">
								<h3>
									<span>Advertisers & Campaigns</span>            
								</h3>
								<span class="entityLinks">
									<span class="ent inlineIcon webs"><?php if(isset($advertiser[0])){ ?>
										<img   src="<?php echo base_url();?>assets/upimages/icon-advertiser.png">
										<?php echo 'Advertiser : '.$advertiser[0]->clientname;?>
									<?php } ?>
									</span>
								</span>
								<?php if(isset($campaign)){ ?>
										<img   src="<?php echo base_url();?>assets/upimages/icon-campaign.gif">
										<?php echo ' Campaign : '.$campaign[0]->campaignname;?>
								<?php } ?>
								<?php if(isset($banner)){ ?>
										&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
									<?php if($banner[0]->storagetype=="web"){?>
									<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-stored-d.gif">&nbsp;&nbsp;&nbsp;&nbsp;
									<?php }elseif($banner[0]->storagetype=="html5"){?>
									<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/html5.png">&nbsp;&nbsp;&nbsp;&nbsp;
									<?php }else{ ?>
									<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-html.png">&nbsp;&nbsp;&nbsp;&nbsp;
									<?php } ?>
									<?php echo ' Banner : '.$banner[0]->description;?>
								<?php } ?>
								<?php if(isset($affiliate)){ ?>
										&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
										<img   src="<?php echo base_url();?>assets/upimages/icon-website.png">
										<?php echo ' Website : '.$affiliate[0]->name;?>
								<?php } ?>
							</div>
				  
							<div class="corner left"></div>
							<div class="corner right"></div>
						</div>
                        </div>
						<?php $this->load->view('executive/report_header');?>
							<form action="<?php echo base_url()?>executive/adcampstats" name="period_form" id="period_form" autocomplete="off">
							
							<?php if(isset($_GET['clientid']) && $_GET['clientid']){ ?>
							<input type='hidden' name='clientid' value='<?php echo $_GET['clientid']; ?>'>
							<?php } ?>
							
							<?php if(isset($_GET['campaignid']) && $_GET['campaignid']){ ?>
							<input type='hidden' name='campaignid' value='<?php echo $_GET['campaignid']; ?>'>
							<?php } ?>
							
							<?php if(isset($_GET['bannerid']) && $_GET['bannerid']){ ?>
							<input type='hidden' name='bannerid' value='<?php echo $_GET['bannerid']; ?>'>
							<?php } ?>
							
							<?php if(isset($_GET['affiliateid']) && $_GET['affiliateid']){ ?>
							<input type='hidden' name='affiliateid' value='<?php echo $_GET['affiliateid']; ?>'>
							<?php } ?>
							
							
							<?php if(isset($_GET['breakthrough']) && $_GET['breakthrough']){ ?>
								<input type="hidden" value="<?php echo $_GET['breakthrough']; ?>" name="breakthrough"/>
							<?php } ?>
							
							<select tabindex="1" onchange="periodFormChange(1)" id="period_preset" name="period_preset">
								<option  value="today" <?php if(isset($period_preset) && $period_preset=='today'){echo 'selected';} ?>>Today</option>
								<option value="yesterday" <?php if(isset($period_preset) && $period_preset=='yesterday'){echo 'selected';} ?>>Yesterday</option>
								<option value="this_month" <?php if(isset($period_preset) && $period_preset=='this_month'){echo 'selected';} ?>>This month</option>
								<option value="all_stats" <?php if(isset($period_preset) && $period_preset=='all_stats'){echo 'selected';} ?>>All statistics</option>
								<option value="specific" <?php if(isset($period_preset) && $period_preset=='specific'){echo 'selected';} ?>>Specific dates</option>
							</select>
							<label style="margin-left: 1em" for="period_start"></label>
							<input type="text" tabindex="0" value="<?php if(isset($period_start)){echo $period_start;} ?>"  id="period_start" name="period_start" class="date" readonly="" style="background-color: rgb(204, 204, 204);"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_start_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
							<label style="margin-left: 1em" for="period_end"> </label>
							<input type="text" tabindex="0" value="<?php if(isset($period_end)){echo $period_end;} ?>"  id="period_end" name="period_end" class="date" readonly="" style="background-color: rgb(204, 204, 204);"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_end_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
											
							<a onclick="return periodFormSubmit()" href="#">
								<img border="0" tabindex="6" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif"></a>
							
							</form></br></br>
							<a accesskey="e"  style="float:right;" href="stats.php?statsBreakdown=day&amp;period_preset=today&amp;period_start=2016-04-18&amp;period_end=2016-04-18&amp;listorder=name&amp;orderdirection=up&amp;day=&amp;setPerPage=15&amp;entity=global&amp;breakdown=history&amp;plugin=advertiser:statshistory">
							<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel                </a>
							<img width="100%" style="height:1px;" src="<?php echo 'base_url';?>assets/upimages/break.gif">
							
							<?php if(isset($advertiserStats) && !empty($advertiserStats)){ ?>
							<table id="example" style="margin-top: 10px;" class="table table-bordered table-striped" >
							<thead>
								<tr>
									<th width="52%">Name<img align="absmiddle" width="10" height="10" src="<?php echo base_url();?>assets/upimages/caret-u.gif"></th>
									<th width="12%">Impr.</th>
									<th width="12%">Clicks</th>
									<th width="12%">CTR</th>
									<th width="12%">ECPM</th>
								</tr>
							</thead>
							<tbody>
								
								<?php $advertiserStats	= array_reverse($advertiserStats); 
								$totalImpr=0; 	$totalClk=0;	 $totalCTR=0; 	$totalECP=0;

								foreach($advertiserStats as $key => $value){ ?>
								<tr style="outline: thin solid <?php if($key % 2 == 0){echo '#e6e6e6';}else{echo '#ffffff';}?>">
									<td><img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/ltr/triangle-l.gif">
										
										<?php if(isset($_GET['breakthrough']) && $_GET['breakthrough'] == 'affiliate'){ ?>
											<?php if (isset($_GET['affiliateid'])){ ?>	
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">
												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=zone&affiliateid='.$_GET['affiliateid'].'&breakthrough=daily'.$affiliateQueryString;?>"><?php echo $value->day;?></a>
											<?php }else{ ?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-website.png"><a href="">
												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=affiliate&affiliateid='.$value->publisherID."&clientid=".$_GET['clientid'].$affiliateQueryString;?>"><?php echo $value->publisherName;?></a>
											<?php } ?>
										
										
										<?php }else if(isset($_GET['breakthrough']) && $_GET['breakthrough'] == 'banner'){  ?>
											<?php if (isset($_GET['bannerid'])){ ?>	
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif"><a href="">
												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=banner&clientid='.$_GET['clientid'].'&campaignid='.$value->campaignID;?>"><?php echo $value->day;?></a>
											<?php }else{ ?>
											
												<?php if($value->storagetype=="web" || $value->storagetype=="exscrpt"){?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-stored-d.gif">&nbsp;&nbsp;&nbsp;&nbsp;
												<?php }elseif($value->storagetype=="html5"){?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/html5.png">&nbsp;&nbsp;&nbsp;&nbsp;
												<?php }else{ ?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-banner-html.png">&nbsp;&nbsp;&nbsp;&nbsp;
												<?php } ?>
												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=banner&clientid='.$_GET['clientid'].'&campaignid='.$value->campaignID.'&bannerid='.$value->bannerID;?>"><?php echo $value->bannerName;?></a>
											<?php } ?>
										
										
										
										<?php }else if(isset($_GET['breakthrough']) && $_GET['breakthrough'] == 'campaign'){  ?>
											
											<?php if (isset($_GET['campaignid'])){ ?>	
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif"><a href="">
												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=campaign&clientid='.$_GET['clientid'].'&campaignid='.$value->campaignid;?>"><?php echo $value->day;?></a>
											<?php }else{ ?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-campaign.gif"><a href="">
												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=campaign&clientid='.$_GET['clientid'].'&campaignid='.$value->campaignid?>"><?php echo $value->campaignname;?></a>
											
											<?php } ?>
										
										
										<?php }else{ ?>
											<?php if(isset($_GET['clientid'])){ ?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">

												<a href="<?php echo base_url().'executive/adcampstats?breakthrough=day';?>"><?php echo $value->day;?></a>

											<?php }else{ ?>
												<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-advertiser.png"><a href="">

												<a href="<?php echo base_url().'executive/adcampstats?clientid='.$value->clientid;?>"><?php echo $value->clientname;?></a>
											<?php } ?>
										<?php } ?>
									
									</td>
									<td><?php echo $value->impressions;?></td>
									<td><?php echo $value->clicks;?></td>
									<td><?php echo floor(($value->clicks/$value->impressions)*100);?>%</td>
									
									<td class="last"><?php echo (($value->impressions / 10000)*2);?></td>
								</tr>                 
								<?php 
								
								$totalImpr	= $totalImpr + $value->impressions;
								$totalClk	= $totalClk + $value->clicks;
								$totalCTR	= $totalCTR + floor(($value->clicks/$value->impressions)*100);
								$totalECP	= $totalECP + (($value->impressions / 10000)*2);
								
								} ?>
								<tr style="font-weight: 700;">
								<td class="last"><b>Total</b></td>
								<td class="aright last"><?php echo $totalImpr;?></td>
								<td class="aright last"><?php echo $totalClk;?></td>
								<td class="aright last"><?php echo round((($totalClk / $totalImpr)*100),2).'%';?></td>
								<td class="aright last"><?php echo $totalECP;?></td>
							</tr>
							</tbody>
						</table>
					<?php }else{ ?>
					<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no statistics available from <?php if(isset($period_start)){echo date("d M Y", strtotime($period_start));} ?> to <?php if(isset($period_end)){echo date("d M Y", strtotime($period_end));} ?></div>
					<?php } ?>

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php if(!empty($date)){ ?>
	  <script type='text/javascript'>
        <!--
		
        var field = document.getElementById('period_start');
        var oldOnSubmit = field.form.onsubmit;

        field.form.onsubmit = function() {
          if(oldOnSubmit) {
            oldOnSubmit();
          }

          return checkDates(this);
        }

        function checkDates(form)
        {
          var startField = form.period_start;
          var endField = form.period_end;

          if (!startField.disabled && startField.value != '') {
            var start = parseDate(startField.value, '%d %B %Y');
          }
          if (!startField.disabled && endField.value != '') {
            var end = parseDate(endField.value, '%d %B %Y');
          }

          if ((start != undefined && end != undefined) && (start.getTime() > end.getTime())) {
            alert('\'From\' date must be earlier then \'To\' date');
            return false;
          }
          return true;
        }

        // Tabindex handling
        periodTabIndex = 2;
        // Functions
        function periodReset()
        {
            document.getElementById('period_start').value = '04 February 2019 ';
            document.getElementById('period_start').value = '10 February 2019';
            document.getElementById('period_preset').value = 'last_week';
        }

        function periodFormSubmit() {
            var form = document.getElementById('period_preset').form;
            if (checkDates(form)) {
              form.submit();
            }
            return false;
        }

        function periodFormChange(bAutoSubmit)
        {
            var o = document.getElementById('period_preset');
            var periodSelectName = o.options[o.selectedIndex].value;
            var specific = periodSelectName == 'specific';
            if (periodSelectName == 'today') {
                document.getElementById('period_start').value = "<?php echo $date['today']['start'];?>"	;
                document.getElementById('period_end').value = "<?php echo $date['today']['end'];?>";
            }
                
            if (periodSelectName == 'yesterday') {
                document.getElementById('period_start').value = "<?php echo $date['yesterday']['start'];?>";
                document.getElementById('period_end').value = "<?php echo $date['yesterday']['end'];?>";
            }
			
            if (periodSelectName == 'this_month') {
                document.getElementById('period_start').value = "<?php echo $date['this_month']['start'];?>";
                document.getElementById('period_end').value = "<?php echo $date['this_month']['end'];?>";
            }
                
            
                
            if (periodSelectName == 'all_stats') {
                document.getElementById('period_start').value = '';
                document.getElementById('period_end').value = '';
            }
			
            document.getElementById('period_start').readOnly = !specific;
            document.getElementById('period_start_button').disabled = !specific;
            document.getElementById('period_end').readOnly = !specific;
            document.getElementById('period_end_button').disabled = !specific;

            if (!specific) {
				console.log("not specific");
                document.getElementById('period_start').style.backgroundColor = '#CCCCCC';
                document.getElementById('period_end').style.backgroundColor = '#CCCCCC';
                document.getElementById('period_start').tabIndex = null;
                document.getElementById('period_start_button').tabIndex = null;
                document.getElementById('period_end').tabIndex = null;
                document.getElementById('period_end_button').tabIndex = null;
            } else {
				$('#period_start').datepicker({
			
			format: 'yyyy-mm-dd',
			autoclose:true

		});
		$('#period_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		});

                document.getElementById('period_start').style.backgroundColor = '#FFFFFF';
                document.getElementById('period_end').style.backgroundColor = '#FFFFFF';
                document.getElementById('period_start').tabIndex = periodTabIndex;
                document.getElementById('period_start_button').tabIndex = periodTabIndex + 1;
                document.getElementById('period_end').tabIndex = periodTabIndex + 2;
                document.getElementById('period_end_button').tabIndex = periodTabIndex + 3;
            }

            document.getElementById('period_start_button').readOnly = !specific;
            document.getElementById('period_end_button').readOnly = !specific;
            document.getElementById('period_start_button').src = specific ? 'http://localhost/revive/www/admin/assets/images/icon-calendar.gif' : 'http://localhost/revive/www/admin/assets/images/icon-calendar-d.gif';
            document.getElementById('period_end_button').src = specific ? 'http://localhost/revive/www/admin/assets/images/icon-calendar.gif' : 'http://localhost/revive/www/admin/assets/images/icon-calendar-d.gif';
            document.getElementById('period_start_button').style.cursor = specific ? 'auto' : 'default';
            document.getElementById('period_end_button').style.cursor = specific ? 'auto' : 'default';

            if (!specific && bAutoSubmit) {
                o.form.submit();
            }
        }
        periodFormChange(0);
        //-->
		
		function parseDate(input) {
			var parts = input.match(/(\d+)/g);
			return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
		}
        </script>
	<?php } ?>
	<?php $this->load->view('admin_includes/footer');?>
	<script src="<?php echo base_url();?>assets/js/adserver.js"></script>
	<script type="text/javascript">
	///if(document.getElementById('period_preset') == 'specific'){           

		/* $('#period_start').datepicker({
			
			format: 'yyyy-mm-dd',
			autoclose:true

		});
		$('#period_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		}); */
	//}
		/* function customDateSubmission(){
			var start_date				= document.getElementById('period_start').value;
			var end_date				= document.getElementById('period_end').value;
			window.location.href		= "adcampstats?bannerid=99&period=specific&start_date="+start_date+"&end_date="+end_date;
		} */
    </script>

<?php $this->load->view('executive/footer');?>

													