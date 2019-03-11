<style>
    td, th {
    padding: 10px;
}
</style>
<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
					<b  style="padding-left: 12px;">Standard Reports</b>
					<img src="http://localhost/reviveadserver/revive-adserver-3.2.2/www/admin/assets/images/break.gif" height="1" width="100%">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
							<tbody>
								<tr>
									<td width="20%"><a href="<?php echo base_url();?>users/adreport">Advertising Analysis Report</a></td>
									<td width="50%">This report shows a breakdown of advertising for a particular advertiser or website, by day, campaign, and zone.</td>
								  </tr>
								  <tr>
									<td width="20%"><a href="<?php echo base_url();?>users/adreport">Campaign Analysis Report</a></td>
									<td width="50%">This report shows a breakdown of advertising for a particular campaign, by day, banner, and zone.</td>
								  </tr>
								  <tr>
									<td width="20%"><a href="<?php echo base_url();?>users/adreport">Conversion Tracking Report</a></td>
									<td width="50%">A detailed breakdown of all conversion activity by advertiser or website.</td>
								  </tr>
								  <tr>
									<td width="20%"><a href="<?php echo base_url();?>users/adreport">Campaign Delivery Report</a></td>
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



													