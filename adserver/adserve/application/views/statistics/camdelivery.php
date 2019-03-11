<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
					<b>Standard Reports</b>
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
							<tbody>
								<tr>
									<td width="20%"><a href="report-generation.php?report=reports:oxReportsStandard:advertisingAnalysisReport">Advertising Analysis Report</a></td>
									<td width="50%">This report shows a breakdown of advertising for a particular advertiser or website, by day, campaign, and zone.</td>
								  </tr>
								  <tr>
									<td width="20%"><a href="report-generation.php?report=reports:oxReportsStandard:campaignAnalysisReport">Campaign Analysis Report</a></td>
									<td width="50%">This report shows a breakdown of advertising for a particular campaign, by day, banner, and zone.</td>
								  </tr>
								  <tr>
									<td width="20%"><a href="report-generation.php?report=reports:oxReportsStandard:conversionTrackingReport">Conversion Tracking Report</a></td>
									<td width="50%">A detailed breakdown of all conversion activity by advertiser or website.</td>
								  </tr>
								  <tr>
									<td width="20%"><a href="report-generation.php?report=reports:oxReportsStandard:liveCampaignDeliveryReport">Campaign Delivery Report</a></td>
									<td width="50%">This report shows delivery statistics for all campaigns which were live during the specified period, highlighting campaigns which are underperforming.</td>
								  </tr>
							</tbody>
						</table></br></br></br></br></br>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



													