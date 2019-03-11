<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php $role	= $this->session->userdata('role');if($role !='admin'){ ?>
						<form  action="<?php echo base_url();?>users/updateprofile" method="post" enctype="multipart/form-data" name="settingsform" id="settingsform">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="4	">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>Change Password</b>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_username"  width="30%"></td>
									<td width="100%" valign="top" style="color:green;">	
										<?php if(isset($msg)){ echo $msg;}?>
									</td>
									<td></td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td>&nbsp;</td>
									<td valign="top" id="cell_username"  width="30%"><span style="color: #c00;">*</span>Current Password</td>
									<td width="100%" valign="top" >	
										<input type="password" tabindex="1" style="margin-left: 3px;"  size="35" required id="curr_pass" name="curr_pass" class="formfield">
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
									<td valign="top" id="cell_email_address" class="fieldlabel" width="30%"><span style="color: #c00;">*</span>New Password</td>
									<td width="100%" valign="top" class="formfield" >
										<input type="password" tabindex="1" style="margin-left: 3px;"  size="35" required id="new_pass" name="new_pass" class="formfield">
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
									<td valign="top" id="cell_email_address" class="fieldlabel" width="30%"><span style="color: #c00;">*</span>Confirm Password</td>
									<td width="100%" valign="top" class="formfield" >
										<input type="password" tabindex="1" style="margin-left: 3px;"  size="35" required id="confirm_pass" name="confirm_pass" class="formfield">
										<div class='validation' style='display:none;color:red;margin-bottom: 20px;'>passwords don't match</div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td style="width: 30px; height: 1px;">&nbsp;</td>
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
									<td>&nbsp;</td>
									<td style="width: 30px; height: 1px;"></td>
								</tr>
								<tr class="break">
									<td colspan="4">
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>

							</tbody>
						</table>
						
						
						<input type="hidden" value="15237771589c4ab7dab0d9e7e9cd7e83" id="token" name="token">    
						<input type="submit" class="btn btn-primary" tabindex="4" value="Save" id="submitsettings" name="submitsettings">
						<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
			



																												