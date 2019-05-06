<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form action="stats.php" name="period_form" id="period_form">
							<input type="hidden" value="day" name="statsBreakdown"/>
							<input type="hidden" value="" name="listorder"/>
							<input type="hidden" value="up" name="orderdirection"/>
							<input type="hidden" value="" name="day"/>
							<input type="hidden" value="15" name="setPerPage"/>
							<input type="hidden" value="global" name="entity"/>
							<input type="hidden" value="advertiser" name="breakdown"/>
							<select tabindex="1" onchange="periodFormChange(1)" id="period_preset" name="period_preset">
								<option selected="selected" value="today">Today</option>
								<option value="yesterday">Yesterday</option>
								<option value="this_week">This week</option>
								<option value="last_week">Last week</option>
								<option value="last_7_days">Last 7 days</option>
								<option value="this_month">This month</option>
								<option value="last_month">Last month</option>
								<option value="all_stats">All statistics</option>
								<option value="specific">Specific dates</option>
							</select>
							<label style="margin-left: 1em" for="period_start"></label>
							<input type="text" tabindex="0" value="10 March 2016 " id="period_start" name="period_start" class="date" readonly="" style="background-color: rgb(204, 204, 204);">
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_start_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
							<label style="margin-left: 1em" for="period_end"> </label>
							<input type="text" tabindex="0" value="10 March 2016" id="period_end" name="period_end" class="date" readonly="" style="background-color: rgb(204, 204, 204);">
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_end_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
										
							<a onclick="return periodFormSubmit()" href="#">
								<img border="0" tabindex="6" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif"></a>
						</form></br></br></br></br></br>
						<a accesskey="e" href="stats.php?statsBreakdown=day&amp;period_preset=today&amp;period_start=2016-04-18&amp;period_end=2016-04-18&amp;listorder=name&amp;orderdirection=up&amp;day=&amp;setPerPage=15&amp;entity=global&amp;breakdown=history&amp;plugin=advertiser:statshistory">
						<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel                </a>
						<img width="100%" style="height:1px;" src="http://localhost/adserver/assets/upimages/break.gif">
						<table id="example" style="margin-top: 10px;" class="table table-striped" >
							<thead>
								<tr>
									<th width="52%">Day</th>
									<th width="12%">Impr.</th>
									<th width="12%">Clicks</th>
									<th width="12%">CTR</th>
									<th width="12%">Rev.</th>
									<th width="12%">ECPM</th>
								</tr>
							</thead>
							<tbody>
							<?php if(isset($users)){?>
							<?php foreach($users as $key => $value){ ?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
									<td>
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif"><a href="">
										<?php if($value->date_created == '') { echo '0000-00-00 00:00:00'; } else { echo $value->date_created; }?></a>
									</td>
									<td>36000<?php //echo $value->firstname.' '.$value->lastname;?></td>
									<td>1990<?php //echo $value->username;?></td>
									<td>12.29</td>
									<td>112222</td>
									<td class="last">123121</td>
								</tr>                 
							<?php }} ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



													