<style>
hr {
    margin-bottom: 9px;
}

.border-img{margin-bottom: 28px;}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<img src="<?php echo base_url()?>assets/upimages/icon-campaign-add-large.png" class="header-image"/>
		<h3 class="header"><span style="color:#333333;">Add Mailer Campaign</span></h3>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
				<?php if(isset($_GET['campaignid'])){ ?>
				<?php $this->load->view('admin_includes/campaign_header');?>
				<?php } ?>
						<form method="post" enctype="multipart/form-data" name="addmailercampaign"	id="addmailercampaign">
						<div class="box-body">
							<div class="message localMessage" style="display:<?php if(isset($msg)){echo 'block';}else{echo 'none';}?>">
							<div class="panelMessage confirm">
								<div class="icon"></div>
								<p class="message_p"><b><?php echo $msg;?></b></p>
								<div class="topleft"></div>
								<div class="topright"></div>
								<div class="bottomleft"></div>
								<div class="bottomright"></div>
								<div class="close">x</div>
							</div>
						</div>
							<h2 class="formfieldheading">Basic Information</h2>
							<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel"> Campaign Name<font color="red">*</font></label>
									<input type="text" class="formfield" name="campaign" id ="campaign" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->campaignname;}?><?php if(isset($defaultCampaign)){echo $defaultCampaign;?> - Default Campaign<?php } ?>"/></br>
									<label for="name" class="fieldlabel"></label
									<span style="color:red;margin-left:40px;" id ="span_campaign"></span>
								</div>
							</div>
							
							
							<div class="col-md-6">
								<h2 class="formfieldheading">Date</h2>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
								<div class="form-group">
									<label class="fieldlabel">Start Date</label>
									<input style="margin-left:40px;" id="startSet_immediate" name="startSet" value="f" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc !='yes'){echo 'checked="checked"';}}else{echo 'checked="checked"';} ?> type="radio">&nbsp;&nbsp;&nbsp;<span>Start immediately</span>

									<br><input style="margin-left:254px;" id="startSet_specific" name="startSet" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc =='yes'){echo 'checked="checked"';}} ?>value="t" type="radio"><span>&nbsp;&nbsp;&nbsp;Set specific date</span>
									<span id="specificStartDateSpan" style="display: <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc=='yes'){echo 'block';}else{echo 'none';}}else{echo 'none';}?>">
										<div style="width: 22%;margin-left:254px;padding-bottom: 20px;" class='input-group date' id="activate_time1">
											<input type='text' class="form-control" name="activate_time" id="activate_time" placeholder="dd-mm-yyyy" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->activate_time;}?>"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</span>
    							</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">End Date</label>
									<input style="margin-left:40px;" id="endSet_immediate" name="endSet" value="f" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc !='yes'){echo 'checked="checked"';}}else{echo 'checked="checked"';} ?> type="radio"><span for="endSet_immediate">&nbsp;&nbsp;&nbsp;Don't expire</span>

									<br><input style="margin-left:254px;" id="endSet_specific" name="endSet" value="t" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc =='yes'){echo 'checked="checked"';}} ?> type="radio"><span>&nbsp;&nbsp;&nbsp;Set specific date</span>
									<span id="specificEndDateSpan" style="display: <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc=='yes'){echo 'block';}else{echo 'none';}}else{echo 'none';}?>">
										<div style="width: 22%;margin-left:256px;" class='input-group date' id="expire_time1">
											<input type='text' class="form-control" name="expire_time" id="expire_time" placeholder="dd-mm-yyyy" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->expire_time;}?>"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>

										</div>
									</span>
								</div>
							</div>
							<div class="col-md-6">
								<h2 class="formfieldheading">Mail Detail</h2>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
								<div class="form-group">
									<label for="Subject" class="fieldlabel">Subject</label>
									<input type="text" 	 class="formfield" name="subject" id="subject" value="<?php if(isset($campaign[0]->subject)){echo $campaign[0]->subject;}?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="mailinglist" class="fieldlabel">Attach Mailing list</label>
									<input type="file" class="formfield" name="mailinglist" id="mailinglist" style="display: inline;">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="body" class="fieldlabel">Body</label>
									<textarea style="width:483px;height:144px;" class="textarea-field" name="body" id="body"></textarea>
									
								</div>
							</div>
							
							
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="description" class="fieldlabel">Description</label>
									<textarea style="width:483px;height:100px;" class="textarea-field" name="description" id="description"></textarea>
									
								</div>
							</div>
							
							
						</div>
						<div class="box-footer">
							<input type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>

<?php $this->load->view('admin_includes/footer');?>
 <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        $('#activate_time1').datepicker({
			format: 'dd-mm-yyyy',
			autoclose:true
		});
		$('#expire_time1').datepicker({
			format: 'dd-mm-yyyy',
			autoclose:true
	  });
	});
	var campaign = '';
	<?php if(isset($_GET['campaignid'])){ ?>
		campaign = 'exist';
	<?php } else{ ?>
		campaign = 'new';
	<?php } ?>
    </script>







