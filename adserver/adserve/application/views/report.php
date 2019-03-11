<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<table cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td height="25" colspan="3"><b>Standard Reports</b></td></tr>
              <tr height="1">
                <td width="30"><img width="30" height="1" src="http://mediaconversion.com/report/reviveadserver/www/admin/assets/images/break.gif"></td>
                <td width="200"><img width="200" height="1" src="http://mediaconversion.com/report/reviveadserver/www/admin/assets/images/break.gif"></td>
                <td width="100%"><img width="100%" height="1" src="http://mediaconversion.com/report/reviveadserver/www/admin/assets/images/break.gif"></td>
              </tr><tr><td height="10" colspan="3">&nbsp;</td></tr>
              <tr>
                <td width="30">&nbsp;</td>
                <td width="200"><a href="report-generation.php?report=reports:oxReportsStandard:advertisingAnalysisReport">Advertising Analysis Report</a></td>
                <td width="100%">This report shows a breakdown of advertising for a particular advertiser or website, by day, campaign, and zone.</td>
              </tr><tr><td height="10" colspan="3">&nbsp;</td></tr>
              <tr>
                <td width="30">&nbsp;</td>
                <td width="200"><a href="report-generation.php?report=reports:oxReportsStandard:campaignAnalysisReport">Campaign Analysis Report</a></td>
                <td width="100%">This report shows a breakdown of advertising for a particular campaign, by day, banner, and zone.</td>
              </tr><tr><td height="10" colspan="3">&nbsp;</td></tr>
              <tr>
                <td width="30">&nbsp;</td>
                <td width="200"><a href="report-generation.php?report=reports:oxReportsStandard:conversionTrackingReport">Conversion Tracking Report</a></td>
                <td width="100%">A detailed breakdown of all conversion activity by advertiser or website.</td>
              </tr><tr><td height="10" colspan="3">&nbsp;</td></tr>
              <tr>
                <td width="30">&nbsp;</td>
                <td width="200"><a href="report-generation.php?report=reports:oxReportsStandard:liveCampaignDeliveryReport">Campaign Delivery Report</a></td>
                <td width="100%">This report shows delivery statistics for all campaigns which were live during the specified period, highlighting campaigns which are underperforming.</td>
              </tr><tr><td colspan="3">&nbsp;</td></tr></tbody></table></br></br></br></br></br>
																		<a accesskey="e" href="stats.php?statsBreakdown=day&amp;period_preset=today&amp;period_start=2016-04-18&amp;period_end=2016-04-18&amp;listorder=name&amp;orderdirection=up&amp;day=&amp;setPerPage=15&amp;entity=global&amp;breakdown=history&amp;plugin=advertiser:statshistory">
																		<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel                </a>
																		<img width="100%" style="height:1px;" src="http://localhost/adserver//assets/upimages/break.gif">
																		<table id="example" style="margin-top: 10px;" class="table table-bordered table-striped" >
							<thead>
								<tr>
									<th width="52%">Name <img align="absmiddle" width="10" height="10" src="<?php echo base_url();?>assets/upimages/caret-u.gif"></th>
									<th width="12%">Impr.</th>
									<th width="12%">Clicks</th>
									<th width="12%">CTR</th>
									<th width="12%">Rev.</th>
									<th width="12%">ECPM</th>
								</tr>
							</thead>
							<tbody>
								
								<?php if(isset($users)){?>
								<?php foreach($users as $key => $value){?>
								<tr style="outline: thin solid <?php if($key % 2 == 0){echo '#e6e6e6';}else{echo '#ffffff';}?>">
									<td><img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/ltr/triangle-l.gif">
										<img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-affiliate.gif"><a href="">
										<a href="">www.cricmagic.com<?php //echo $value->username;?></a>
									</td>
									<td>36000<?php //echo $value->firstname.' '.$value->lastname;?></td>
									<td>1990<?php //echo $value->username;?></td>
									<td>12.29</td>
									<td>
									112222
									</td>
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



													