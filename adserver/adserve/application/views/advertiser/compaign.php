<style>
hr {
    margin-bottom: 9px;
}

.border-img{margin-bottom: 28px;}
</style>
<div class="content-wrapper">
	<?php if(isset($_GET['clientid'])){ ?>
    <section class="content-header">
		<img src="<?php echo base_url()?>assets/upimages/icon-campaign-add-large.png" class="header-image"/>
		<h3 class="header"><span style="color:#333333;">Add new campaign</span></h3>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
				<?php if(isset($_GET['campaignid'])){ ?>
				<?php $this->load->view('advertiser/campaign_header');?>
				<?php } ?>
						<form method="post"   name="addcampaign"	id="addcampaign">
						<div class="box-body">
							<div class="message localMessage" style="display:<?php if(isset($msg)){echo 'block';}else{echo 'none';}?>">
							<div class="panelMessage confirm">
								<div class="icon"></div>
								<p class="message_p"><b><?php if(isset($msg)){echo $msg;}?></b></p>
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
									<label for="name" class="fieldlabel">Name<font color="red">*</font></label>
									<input type="text" class="formfield" name="campaign" id ="campaign" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->campaignname;}?><?php if(isset($defaultCampaign)){echo $defaultCampaign;?> - Default Campaign<?php } ?>"/></br>
									<label for="name" class="fieldlabel"></label
									<span style="color:red;margin-left:40px;" id ="span_campaign"></span>
								</div>
							</div>
							<!--<div class="col-md-6">
								<div class="form-group">
									<label for="type" class="fieldlabel">Type</label>
									<input type="radio" 	class="campaign-radio" name="campaign_type" id="remnant" value="1" <?php if(isset($campaign[0]->campaign_type) && $campaign[0]->campaign_type=='1'){echo 'checked';}?>/>&nbsp;&nbsp;<b>Remnant</b>
									<div style="display:<?php if(isset($campaign[0]->campaign_type)){if( $campaign[0]->campaign_type=='1'){echo 'block';}else{echo 'none';}}else{echo 'block';}?>" class="campaign-type" id="campaign_remnant"><?php echo $remnant;?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel"></label>
									<input type="radio" 	class="campaign-radio"  name="campaign_type" id="contract" value="2" <?php if(isset($campaign[0]->campaign_type) && $campaign[0]->campaign_type=='2'){echo 'checked';}?>/>&nbsp;&nbsp;<b>Contract</b>
									<div style="display:<?php if(isset($campaign[0]->campaign_type)){if( $campaign[0]->campaign_type=='2'){echo 'block';}else{echo 'none';}}else{echo 'block';}?>"class="campaign-type" id="campaign_contract"><?php echo $contract;?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" 		class="fieldlabel"> </label>
									<input type="radio" 	class="campaign-radio" name="campaign_type" id="override" value="3" <?php if(isset($campaign[0]->campaign_type) && $campaign[0]->campaign_type=='3'){echo 'checked';}?>/>&nbsp;&nbsp;<b>Override</b>

									<div style="display:<?php if(isset($campaign[0]->campaign_type)){if( $campaign[0]->campaign_type=='3'){echo 'block';}else{echo 'none';}}else{echo 'block';}?>" class="campaign-type" id="campaign_override"><?php echo $override;?></div>
								</div>										
							</div>
							-->
							<div class="col-md-6">
								<h2 class="formfieldheading">Date</h2>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
								<div class="form-group">
									<label class="fieldlabel">Start Date</label>
									<input style="margin-left:40px;" id="startSet_immediate" name="startSet" value="f" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc !='yes'){echo 'checked="checked"';}}else{echo 'checked="checked"';} ?> type="radio">&nbsp;&nbsp;&nbsp;<span>Start immediately</span>

									<br><input style="margin-left:196px;" id="startSet_specific" name="startSet" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc =='yes'){echo 'checked="checked"';}} ?>value="t" type="radio"><span>&nbsp;&nbsp;&nbsp;Set specific date</span>
									<span id="specificStartDateSpan" style="display: <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc=='yes'){echo 'block';}else{echo 'none';}}else{echo 'none';}?>">
										<div style="width: 22%;margin-left:223px;padding-bottom: 20px;" class='input-group date' id="activate_time1">
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

									<br><input style="margin-left:196px;" id="endSet_specific" name="endSet" value="t" <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc =='yes'){echo 'checked="checked"';}} ?> type="radio"><span>&nbsp;&nbsp;&nbsp;Set specific date</span>
									<span id="specificEndDateSpan" style="display: <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc=='yes'){echo 'block';}else{echo 'none';}}else{echo 'none';}?>">
										<div style="width: 22%;margin-left:223px;" class='input-group date' id="expire_time1">
											<input type='text' class="form-control" name="expire_time" id="expire_time" placeholder="dd-mm-yyyy" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->expire_time;}?>"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</span>
								</div>
							</div>
							<div class="col-md-6">
								<h2 class="formfieldheading">Pricing</h2>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							
								<div class="form-group">
									<label for="name" class="fieldlabel">Pricing Model</label>
									<select  name="revenue_type" id="revenue_type" class="formfield"/>
									<?php if(isset($campaign[0]->revenue_type)){ ?>
									<?php if($campaign[0]->revenue_type == 1){ ?>
									<option value="1">CPM</option>
									<?php } ?>
									<?php if($campaign[0]->revenue_type == 2){ ?>
									<option value="2">CPC</option>
									<?php } ?>
									<?php if($campaign[0]->revenue_type == 3){ ?>
									<option value="3">Tenancy</option>
									<?php }} ?>
									<option value="1">CPM</option>
									<option value="2">CPC</option>
									<option value="3">Tenancy</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Rate / Price</label>
									<input type="text" class="formfield"  name="revenue" id="revenue" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->revenue;}?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Impression</label>
									<input type="text" class="formfield" name="impressions" id="impressions" value="<?php if(isset($campaign[0]->views) && $campaign[0]->views !=-1){echo $campaign[0]->views;}?>" <?php if(isset($campaign[0]->views) && $campaign[0]->views ==-1){echo 'disabled';}?>/>
									<input type="checkbox" value="-1" class="camp-chk" name="views" id="views" <?php if(isset($campaign[0]) && $campaign[0]->views == -1){echo 'checked';}?>/>&nbsp;&nbsp;Unlimited

								</div>
							</div>
							<div class="col-md-6">
								<h2 class="formfieldheading">Priority In relation to other module</h2>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Priority level</label>
									<select   style="width:9%" class	= "multiplefield" name = "high_priority_value" id= "high_priority_value" style= "display:inline;"/>
									<?php if(isset($campaign[0]->priority)){ ?>
										<option value="<?php echo $campaign[0]->priority;?>"><?php echo $campaign[0]->priority;?></option>
										<?php } ?>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
									</select>&nbsp;&nbsp;-Limit		
									<select  style="width:8%" name="target_type"  id="target_type"/>
										<?php if(isset($campaign[0]->tracking_type)){?>
										<option value="<?php if($campaign[0]->tracking_type){ echo $campaign[0]->tracking_type;?>">
										<?php echo substr($campaign[0]->tracking_type, 7);?>
										<?php } ?>
										</option>
										<?php } ?>

										<option value="target_impression">Impression</option>
										<option value="target_click">Clicks</option>
										<option value="target_conversion">Converiosn</option>
									</select>&nbsp;&nbsp;to	
									<input type="text"  style="width:8%" name="target_value" id="target_value" value="<?php if(isset($campaign[0]->target_value)){ echo $campaign[0]->target_value;}else{echo '0';}?>">per day
								</div>
							</div>
							
							<div class="col-md-6">
								<h2 class="formfieldheading">Delivery Capping per Visitor</h2>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
								<div class="form-group">
									<label for="name" class="fieldlabel">Amount</label>
									<input type="text" 	 class="formfield" name="capping_amount" id="capping_amount" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->capping_amount;}?>"/>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Period</label>
									<input type="text" 	 class="formfield" name="capping_period_value" id="capping_period_value" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->capping_period_value;}?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Period Type</label>
									<select style="width:8%;margin-left: 40px;" class= "capping_period_type" name = "capping_period_type" id= "capping_period_type" style= "display:inline;"/>
										<?php if(isset($campaign[0]->priority)){ ?>
										<option value="<?php echo $campaign[0]->capping_period_type;?>"><?php echo $campaign[0]->capping_period_type;?></option>
										<?php } ?>
										
										<option value="hours">Hours</option>
										<option value="days">Days</option>
										<option value="months">Months</option>
										<option value="years">Years</option>
									</select>
								</div>
							</div>
							<!--<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Limit campaign views to</label>
									<input type="text" 	 class="formfield" name="session_capping" id="session_capping" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->session_capping;}?>"/>&nbsp;&nbsp;per session
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Limit campaign views to</label>
									<input type="text" 	 class="formfield" name="session_capping" id="session_capping" value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->session_capping;}?>"/>&nbsp;&nbsp;per session
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" 	class="fieldlabel">Reset view counters after </label>
									<input type="text" 	name	= "hours" 	id	= "hours" 		class="smalltextbox" value="<?php if(isset($campaign[0]->hours)){echo $campaign[0]->hours;}?>">&nbsp;&nbsp;Hours
									<input type="text" 	name	= "mintues" id	= "mintues" 	class="smalltextbox" value="<?php if(isset($campaign[0]->mintues)){echo $campaign[0]->mintues;die;}?>">&nbsp;&nbsp;Mintues
									<input type="text" 	name	= "second" 	id	= "second" 		class="smalltextbox" value="<?php if(isset($campaign[0]->second)){echo $campaign[0]->second;}?>" style="margin-left: 32px;"/>&nbsp;&nbsp;Seconds
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Cookies </label>
									<input type="checkbox" 	value="1" class="camp-chk" name="show_capped_no_cookie" id="show_capped_no_cookie" <?php if(isset($campaign[0]) && $campaign[0]->show_capped_no_cookie == 1){echo 'checked';}?>/>&nbsp;&nbsp;Show capped ads if cookies are disabled
								</div>
							</div>
							-->
							<div class="col-md-6">
								<h2 class="formfieldheading">Miscellaneous</h2></br>
								<img class="border-img" width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							    <div class="form-group">
									<label for="name" class="fieldlabel">Miscellaneous</label>
									<input type="checkbox" 	 name="anonymous" id="anonymous" value="t" class="camp-chk" <?php if(isset($campaign[0]) && $campaign[0]->anonymous == 't'){echo 'checked';}?>/>&nbsp;&nbsp;Hide the advertiser and websites of this campaign.
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Miscellaneous</label>
									<input type="checkbox" 	 name="companion" id="companion" value="1" class="camp-chk" <?php if(isset($campaign[0]) && $campaign[0]->companion == 1){echo 'checked';}?>/>&nbsp;&nbsp;Companion positioning:
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="fieldlabel">Comment</label>
									<textarea  class="textarea-field" name="comments" id="comments"><?php if(isset($campaign[0]->comments)){echo $campaign[0]->comments;}?></textarea>
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
	<?php }else{ ?>
		<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">  There are currently no campaigns defined, because there are no advertisers. To create a campaign, <a href="<?php echo base_url();?>advertiser/advertisement" style="color:green;">add a new advertiser</a> first.
</div>

	<?php } ?>

<?php $this->load->view('advertiser/footer');?>
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







