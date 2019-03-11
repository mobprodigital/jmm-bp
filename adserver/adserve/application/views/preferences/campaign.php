<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form onsubmit="return max_formValidate(this);" action="/reviveadserver/www/admin/account-user-name-language.php" method="post" enctype="multipart/form-data" name="settingsform" id="settingsform">
						<h3 class="middle-heading">Campaign Preferences</h3>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="2">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>eCPM prioritization</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="2"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Use eCPM optimized priorities instead of remnant-weighted priorities<br>&nbsp;&nbsp;&nbsp;&nbsp;(If you enable this feature all your remnant campaigns will be deactivated, you will have to update them manually to reactivate them)
									</td>
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Use eCPM optimized priorities instead of standard contract priorities									</td>
								</tr>
								<tr>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
								</tr>
								<tr class="break">
									<td colspan="4">
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
							</tbody>
						</table>
						<input type="hidden" value="15237771589c4ab7dab0d9e7e9cd7e83" id="token" name="token">    
						<input type="submit" class="btn btn-primary" tabindex="4" value="Save Changes" name="submitsettings"></form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
			<?php $this->load->view('admin_includes/footer');?>
			<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



																												