<style>
.table .last {
    border-bottom: 1px solid #999;
}
</style>
<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
				<h3 class="box-header with-border">
									<span>Video Statistics</span>            
								</h3>
					<div class="box-body">
						<div class="hasIcon iconTargetingChannelsLarge" style="margin-bottom:20px;">
						<div id="thirdLevelHeader" class="hasTabs">
							<div class=" hasIcon iconTargetingChannelsLarge">
								
								<span class="entityLinks">
									<span class="ent inlineIcon webs"><?php if(isset($VideoStats['videoExpansionDetails']) &&(!empty($VideoStats['videoExpansionDetails']))){ ?>
										<img   src="<?php echo base_url();?>assets/upimages/icon-website.png">
										<?php echo 'Website : '.$VideoStats['videoExpansionDetails']['name'];}?>
									</span>
								</span>
								
								<?php if(isset($VideoStats['videoExpansionDetails']) &&(!empty($VideoStats['videoExpansionDetails'])) && $VideoStats['videoExpansionDetails']['type'] == 'zone'){ ?>
										&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
										<img   src="<?php echo base_url();?>assets/upimages/icon-zone.png">
										<?php echo ' Zone : '.$VideoStats['videoExpansionDetails']['zonename'];
								}?>
								
								<?php if(isset($campaign)){ ?>
										&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
										<img   src="<?php echo base_url();?>assets/upimages/icon-campaign.gif">
										<?php echo ' Campaign : '.$campaign;
								}?>
							</div>
				  
							<div class="corner left"></div>
							<div class="corner right"></div>
						</div>
                        </div>
						<?php //$this->load->view('admin_includes/website_video_report_header');?>
							<form action="<?php echo base_url()?>users/webzonevideostats" name="period_form" id="period_form" autocomplete="off">
							
							<?php if(isset($_GET['affiliateid']) && $_GET['affiliateid']){ ?>
							<input type='hidden' name='affiliateid' value='<?php echo $_GET['affiliateid']; ?>'>
							<?php } ?>
							<?php if(isset($_GET['zoneid']) && $_GET['zoneid']){ ?>
							<input type='hidden' name='zoneid' value='<?php echo $_GET['zoneid']; ?>'>
							<?php } ?>
							<?php if(isset($_GET['campaignid']) && $_GET['campaignid']){ ?>
							<input type='hidden' name='campaignid' value='<?php echo $_GET['campaignid']; ?>'>
							<?php } ?>
							
							<?php if(isset($_GET['breakthrough']) && $_GET['breakthrough']){ ?>
								<input type="hidden" value="<?php echo $_GET['breakthrough']; ?>" name="breakthrough"/>
							<?php } ?>
							<!--<input type="hidden" value="day" name="statsBreakdown"/>
							<input type="hidden" value="" name="listorder"/>
							<input type="hidden" value="up" name="orderdirection"/>
							<input type="hidden" value="" name="day"/>
							<input type="hidden" value="15" name="setPerPage"/>
							<input type="hidden" value="global" name="entity"/>
							<input type="hidden" value="advertiser" name="breakdown"/>
							-->
							
							<select tabindex="1" onchange="periodFormChange(1)" id="period_preset" name="period_preset">
								<option  value="today" <?php if(isset($period_preset) && $period_preset=='today'){echo 'selected';} ?>>Today</option>
								<option value="yesterday" <?php if(isset($period_preset) && $period_preset=='yesterday'){echo 'selected';} ?>>Yesterday</option>
								<option value="this_month" <?php if(isset($period_preset) && $period_preset=='this_month'){echo 'selected';} ?>>This month</option>
								<option value="all_stats" <?php if(isset($period_preset) && $period_preset=='all_stats'){echo 'selected';} ?>>All statistics</option>
								<option value="specific" <?php if(isset($period_preset) && $period_preset=='specific'){echo 'selected';} ?>>Specific dates</option>
							</select>
							<label style="margin-left: 1em" for="period_start"></label>
							<input type="text" tabindex="0" value="<?php if(isset($period_start)){echo $period_start;} ?>"  id="period_start" name="period_start" class="date" readonly="" style="background-color: <?php if(isset($period_preset) && $period_preset=='specific'){echo '#fff';}else{ echo 'rgb(204, 204, 204)';};?>"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_start_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
							<label style="margin-left: 1em" for="period_end"> </label>
							<input type="text" tabindex="0" value="<?php if(isset($period_end)){echo $period_end;} ?>"  id="period_end" name="period_end" class="date" readonly="" style="background-color: <?php if(isset($period_preset) && $period_preset=='specific'){echo '#fff';}else{ echo 'rgb(204, 204, 204)';};?>"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_end_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
											
							<a href="#" onclick="return periodFormSubmit()">
								<img border="0" tabindex="6" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif"></a>
							
							</form></br></br>
							<a class="btn btn-default" accesskey="e"  style="float:right;" href="stats.php?statsBreakdown=day&amp;period_preset=today&amp;period_start=2016-04-18&amp;period_end=2016-04-18&amp;listorder=name&amp;orderdirection=up&amp;day=&amp;setPerPage=15&amp;entity=global&amp;breakdown=history&amp;plugin=advertiser:statshistory">
							<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel                </a>
							<img width="100%" style="height:1px;" src="<?php echo 'base_url';?>assets/upimages/break.gif">
							
							<?php //echo '<pre>';print_r($VideoStats);die;
							if(isset($VideoStats['tableData']) && !empty($VideoStats['tableData'])){ ?>
							<table id="example" style="margin-top: 10px;" class="table table-bordered table-striped" >
							<thead>
								<tr>
									<th width="40%">Name<img align="absmiddle" width="10" height="10" src="<?php echo base_url();?>assets/upimages/caret-u.gif"></th>
									<th width="16%">Started</th>
									<th width="16%">Viewed > 25%</th>
									<th width="16%">Viewed > 50%</th>
									<th width="16%">Viewed > 75%</th>
									<th width="16%">Completed</th>
								</tr>
							</thead>
							<tbody>
								<?php $VideoStats['tableData']=array_reverse($VideoStats['tableData']); foreach($VideoStats['tableData'] as $key => $value){ ?>
								<tr style="outline: thin solid #e6e6e6<?php //if($key % 2 == 0){echo '#e6e6e6';}else{echo '#ffffff';}?>">
									<td><img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/ltr/triangle-l.gif">
										<?php echo $value['name'];?>
									</td>
									<td><?php if(isset($value[1])){echo $value[1];}else{echo "-";}?></td>
									<td><?php if(isset($value[2])){echo $value[2];}else{echo "-";}?></td>
									<td><?php if(isset($value[3])){echo $value[3];}else{echo "-";}?></td>
									<td><?php if(isset($value[4])){echo $value[4];}else{echo "-";}?></td>
									<td><?php if(isset($value[5])){echo $value[5];}else{echo "-";}?></td>
								</tr>                 
								<?php } ?>
							</tbody>
							
							<tr>

									<th></th>
									<th width="16%">Started</th>
									<th width="16%">Viewed > 25%</th>
									<th width="16%">Viewed > 50%</th>
									<th width="16%">Viewed > 75%</th>
									<th width="16%">Completed</th>
								</tr>
							<tr>
								<td class="last"><b>Total</b></td>
								<td class="aright last"><?php if(isset($VideoStats['summaryRow'][1])){echo $VideoStats['summaryRow'][1];}else{echo "-";}?></td>
								<td class="aright last"><?php if(isset($VideoStats['summaryRow'][2])){echo $VideoStats['summaryRow'][2];}else{echo "-";}?></td>
								<td class="aright last"><?php if(isset($VideoStats['summaryRow'][3])){echo $VideoStats['summaryRow'][3];}else{echo "-";}?></td>
								<td class="aright last"><?php if(isset($VideoStats['summaryRow'][4])){echo $VideoStats['summaryRow'][4];}else{echo "-";}?></td>
								<td class="aright last"><?php if(isset($VideoStats['summaryRow'][5])){echo $VideoStats['summaryRow'][5];}else{echo "-";}?></td>
							</tr>
						</table>
					<?php }else{ ?>
					<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="http://localhost/adserver/adserve/assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no statistics available for the given period</div>
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
        Calendar.setup({
            inputField : 'period_start',
            ifFormat   : '%d %B %Y',
            button     : 'period_start_button',
            align      : 'Bl',
            weekNumbers: false,
            firstDay   : 1,
            electric   : false
        });
        Calendar.setup({
            inputField : 'period_end',
            ifFormat   : '%d %B %Y',
            button     : 'period_end_button',
            align      : 'Bl',
            weekNumbers: false,
            firstDay   : 1,
            electric   : false
        });

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
			  
            var start = parseDate(startField.value);
			 
			  
			
          }
          if (!startField.disabled && endField.value != '') {
			

            var end = parseDate(endField.value);
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
		/* $('#period_start').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		});
		$('#period_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		}); */
		function customDateSubmission(){
			var start_date				= document.getElementById('period_start').value;
			var end_date				= document.getElementById('period_end').value;
			window.location.href		= "adcampstats?bannerid=99&period=specific&start_date="+start_date+"&end_date="+end_date;
		}
    </script>
	


													