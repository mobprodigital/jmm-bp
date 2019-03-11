<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form onsubmit="return max_formValidate(this);" action="/reviveadserver/www/admin/account-user-name-language.php" method="post" enctype="multipart/form-data" name="settingsform" id="settingsform">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="4	">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>User Details</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_username"  width="30%">Username</td>
									<td width="100%" valign="top" >&nbsp;admin</td>
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
									<td valign="top" id="cell_email_address" class="fieldlabel" width="30%">Email address</td>
									<td width="100%" valign="top" class="formfield" >
										&nbsp;prince.pandey@fastconverison.com
									</td>
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
									<td valign="top" class="cellenabled" id="cell_contact_name" class="fieldlabel" width="30%">Full Name
									</td>
									<td width="100%" valign="top">
										<input type="text" tabindex="1" style="margin-left: 3px;" value="Administrator" size="35" id="contact_name" name="contact_name" class="formfield" onblur="phpAds_refreshEnabled(); max_formValidateElement(this);">
											<span class="field-hint"></span>
										</td>
										<td>&nbsp;</td>
								</tr>
								<tr>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
									<td>&nbsp;</td>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
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
										<b>Language</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr><td>&nbsp;</td>
									<td class="cellenabled" id="cell_language" width="20%">Language</td>
									<td width="100%"     style="padding-left: 133px;">
										<select tabindex="2" onchange="phpAds_refreshEnabled();" id="language" name="language">
											<option value="ar">العربية</option>
											<option value="bg">Bulgarian</option>
											<option value="ca">Català</option>
											<option value="cs">Český</option>
											<option value="cy">Cymraeg</option>
											<option value="da">Dansk</option>
											<option value="de">Deutsch</option>
											<option value="el">Ελληνικά</option>
											<option selected="selected" value="en">English</option>
											<option value="es">Español</option>
											<option value="fa">فارسی</option>
											<option value="fr">Français</option>
											<option value="he">עברית</option>
											<option value="hu">Magyar</option>
											<option value="id">Bahasa Indonesia</option>
											<option value="it">Italiano</option>
											<option value="ja">日本語</option>
											<option value="ko">한국어</option>
											<option value="lt">Lietuvių</option>
											<option value="ms">Bahasa Melayu</option>
											<option value="nl">Nederlands</option>
											<option value="no">Norsk bokmål</option>
											<option value="pl">Polski</option>
											<option value="pt_BR">Português brasileiro</option>
											<option value="pt_PT">Português</option>
											<option value="ro">Română</option>
											<option value="ru">Русский</option>
											<option value="sk">Slovenčina</option>
											<option value="sl">Slovenščina</option>
											<option value="sv">Svenska</option>
											<option value="tr">Türkçe</option>
											<option value="uk">Українська</option>
											<option value="zh_CN">中文</option>
											<option value="zh_TW">文言</option>

										</select>
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr class="break">
									<td colspan="4">
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>

							</tbody>
						</table>
						<input type="hidden" value="15237771589c4ab7dab0d9e7e9cd7e83" id="token" name="token">    
						<input type="submit" class="btn btn-primary" tabindex="4" value="Save" name="submitsettings"></form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
			<?php $this->load->view('admin_includes/footer');?>
			<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



																												