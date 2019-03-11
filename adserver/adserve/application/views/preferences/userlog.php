<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
					<h3 style="font-size: 18px;font-weight: bold;">User Log</h3>
						<form method="POST" name="auditForm" id="auditForm">
							<input type="hidden" value="updated" name="listorder"/>
							<input type="hidden" value="up" name="orderdirection"/>
							<input type="hidden" value="0" name="origAdvertiserId"/>
							<input type="hidden" value="0" name="origPublisherId"/>

					<fieldset id="auditFilter" style="margin-top:30px;margin-bottom:30px;">
						<b>Filters</b>

						<div class="filterWrapper">
							<label for="advertiserId" class="filterLabel">Advertiser</label>
							<span>
								<select onchange="submitForm();" name="advertiserId" id="advertiserId" style="width:25%">
									<option selected="selected" value="0">Select Advertiser</option>
									<option value="1">prince</option>
									<option value="2">bablu</option>
									<option value="4">Rohit</option>

								</select>
							</span>
						</div>

						<div class="filterWrapper">
							<label for="publisherId" class="filterLabel">Website</label>
							<span>
								<select onchange="submitForm();" name="publisherId" id="publisherId" style="width:25%">
									<option selected="selected" value="0">Select Website</option>
									<option value="4">www.mediaconversion.com</option>
									<option value="3">www.cricmagic.com</option>

								</select>
							</span>
						</div>

						<div class="filterWrapper">
							<span class="filterLabel">Date</span>

							<select tabindex="" onchange="periodFormChange(1)" id="period_preset" name="period_preset" style="margin-left: 97px;">
								<option selected="selected" value="all_events">All events</option>
								<option value="today">Today</option>
								<option value="yesterday">Yesterday</option>
								<option value="this_week">This week</option>
								<option value="last_week">Last week</option>
								<option value="last_7_days">Last 7 days</option>
								<option value="this_month">This month</option>
								<option value="last_month">Last month</option>
								<option value="specific">Specific dates</option>
							</select>
							<label style="margin-left: 1em" for="period_start"> From</label>
							<input type="text" tabindex="0" value="-00-00" id="period_start" name="period_start" class="date" readonly="" style="background-color: rgb(204, 204, 204);">
							<input border="0" align="absmiddle" type="image" tabindex="0" id="period_start_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" readonly="" style="cursor: default;">
							<label style="margin-left: 1em" for="period_end"> to</label>
							<input type="text" tabindex="0" value="-00-00" id="period_end" name="period_end" class="date" readonly="" style="background-color: rgb(204, 204, 204);">
							<input border="0" align="absmiddle" type="image" tabindex="0" id="period_end_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" readonly="" style="cursor: default;">
											
							<a onclick="return periodFormSubmit()" href="#">
								<img border="0" tabindex="6" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif">
							</a>
						</div>
					<div>
					<input type="submit" class="" value="Clear" name="submit" id="submit">    </div>
				</fieldset>
			<div>
				<table class="table table-bordered table-striped" style="margin-top:20px;">
				<tbody>
				<tr class="header">
				<th width="15%"><a href="userlog-index.php?listorder=updated&amp;orderdirection=down">Timestamp</a>
				<a href="userlog-index.php?listorder=updated&amp;orderdirection=down">
				<img src="<?php echo base_url();?>assets/upimages/caret-u.gif">
				</a>
				</th>
				<th>Event</th>
				<th width="10%">&nbsp;</th>
				</tr>

				<tr class="odd">
				<td>19-04-2016, 10:30:31</td>
				<td>
				admin inserted Channel "www.cricmagic.com" (#2)                                            in Website (#0)
				</td>
				<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=369">View</a></td>
				</tr>

				<tr class="even">
				<td>12-04-2016, 14:17:49</td>
				<td>
					admin updated Banner "Cric_300*250" (#3)                                            in Campaign (#4)
				</td>
				<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=354">View</a></td>
				</tr>

<tr class="odd">
	<td>12-04-2016, 14:17:49</td>
	<td>
		admin inserted Ad Zone Association "Ad #3 -&gt; Zone #5" (#4)                                                        </td>
	<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=355">View</a></td>
	</tr>

	<tr class="even">
		<td>12-04-2016, 13:50:45</td>
		<td>
			admin inserted Zone "Media" (#5)                                            in Website (#4)
		</td>
		<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=353">View</a></td>
		</tr>

		<tr class="odd">
			<td>12-04-2016, 13:50:22</td>
			<td>
				admin inserted Affiliate "www.mediaconversion.com" (#4)                                                        </td>
			<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=352">View</a></td>
			</tr>

			<tr class="even">
				<td>12-04-2016, 13:49:44</td>
				<td>
					admin deleted Affiliate "www.mediaconverison.com" (#2)                                                                and additional items
				</td>
				<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=348">View</a></td>
				</tr>

				<tr class="odd">
					<td>12-04-2016, 13:49:24</td>
					<td>
						admin inserted Banner "Cric_300*250" (#3)                                            in Campaign (#4)
					</td>
					<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=346">View</a></td>
					</tr>

					<tr class="even">
						<td>12-04-2016, 13:49:24</td>
						<td>
							admin inserted Ad Zone Association "Ad #3 -&gt; Zone #0" (#3)                                                        </td>
						<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=347">View</a></td>
						</tr>

						<tr class="odd">
							<td>12-04-2016, 13:48:49</td>
							<td>
								admin inserted Campaign "Rohit - Default Campaign" (#4)                                            in Advertiser (#4)
							</td>
							<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=345">View</a></td>
							</tr>

							<tr class="even">
								<td>12-04-2016, 13:47:28</td>
								<td>
									admin inserted Client "Rohit" (#4)                                                        </td>
								<td><img src="<?php echo base_url();?>assets/upimages/icon-zoom.gif">&nbsp;<a href="userlog-audit-detailed.php?auditId=344">View</a></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="filters" style="text-align:right;">
						Items per page: <select id="setPerPage" onchange="submitForm()" name="setPerPage"><option selected="selected" value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="60">60</option><option value="70">70</option><option value="80">80</option><option value="90">90</option><option value="100">100</option></select>&nbsp;1&nbsp;<a title="page 2" href="/reviveadserver/www/admin/userlog-index.php?pageID=2">2</a>&nbsp;<a title="page 3" href="/reviveadserver/www/admin/userlog-index.php?pageID=3">3</a>&nbsp;<a title="page 4" href="/reviveadserver/www/admin/userlog-index.php?pageID=4">4</a>&nbsp;<a title="page 5" href="/reviveadserver/www/admin/userlog-index.php?pageID=5">5</a>&nbsp;<a title="page 6" href="/reviveadserver/www/admin/userlog-index.php?pageID=6">6</a>&nbsp;<a title="next page" href="/reviveadserver/www/admin/userlog-index.php?pageID=2">Next &gt;&gt;</a>&nbsp;</div>
				</form>
				</div>
				</div>
			</div>
		</div>
	</section>
</div>
			<?php $this->load->view('admin_includes/footer');?>
			<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



																												