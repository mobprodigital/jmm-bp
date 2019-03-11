<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form onsubmit="return max_formValidate(this);" action="/reviveadserver/www/admin/account-user-name-language.php" method="post" enctype="multipart/form-data" name="settingsform" id="settingsform">
						<h3 class="middle-heading">Banner Preferences</h3>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="4	">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>Default Banners</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_username"  width="30%">Default Image URL</td>
									<td width="100%" valign="top" ><input type="text" tabindex="1" style="margin-left: 3px;"  size="35" id="contact_name" name="contact_name" class="formfield" onblur="phpAds_refreshEnabled(); max_formValidateElement(this);"></td>
									<td></td>
								</tr>
								<tr>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
									<td>&nbsp;</td>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
								</tr>
																
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_email_address" class="fieldlabel" width="30%">Default Destination URL         </td>
									<td width="100%" valign="top" class="formfield" >
										<input type="text" tabindex="1" style="margin-left: 3px;"  size="35" id="contact_name" name="contact_name" class="formfield" onblur="phpAds_refreshEnabled(); max_formValidateElement(this);">
									</td>
									<td></td>
								</tr>
								
								<tr class="break">
									<td colspan="4">
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>

							</tbody>
						</table>
						
						<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin: 50px 0px;">
							<tbody>
								<tr>
									<td height="25" colspan="4" >
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>Default Weight</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_username"  width="30%">Default Banner Weight</td>
									<td width="100%" valign="top" ><input type="text" tabindex="1" placeholder="1" style="margin-left: 3px;"  size="35" id="contact_name" name="contact_name" class="formfield" onblur="phpAds_refreshEnabled(); max_formValidateElement(this);"></td>
									<td></td>
								</tr>
								<tr>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
									<td>&nbsp;</td>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
								</tr>
																
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_email_address" class="fieldlabel" width="30%">Default Campaign Weight</td>
									<td width="100%" valign="top" class="formfield" >
										<input type="text" tabindex="1" style="margin-left: 3px;" placeholder="1" size="35" id="contact_name" name="contact_name" class="formfield" onblur="phpAds_refreshEnabled(); max_formValidateElement(this);">
									</td>
									<td></td>
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



																												