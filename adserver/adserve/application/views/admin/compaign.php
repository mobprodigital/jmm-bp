<style>
hr {
    margin-bottom: 9px;
}

.border-img {
    margin-bottom: 28px;
}

.radio-button-label {
    font-weight: 200;
    width: 200px;
    cursor: pointer;
}

.title-label {
    display: block;
    margin-bottom: 20px;
}
</style>



<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <img src="<?php echo base_url()?>assets/upimages/icon-campaign-add-large.png"
                            class="header-image" />
                        <?php if(isset($_GET['campaignid']) && isset($_GET['clientid']))
		{ ?>
                        <h3 class="header"><span style="color:#333333;">Edit campaign</span></h3>
                        <?php } else { ?>
                        <h3 class="header"><span style="color:#333333;">Add new campaign</span></h3>
                        <?php } ?>
                    </div>
                    <?php if(isset($_GET['campaignid'])){ ?>
                    <?php $this->load->view('admin_includes/campaign_header');?>
                    <?php } ?>
                    <!-- <?php print_r($campaign); ?> -->
                    <form method="post" name="addcampaign" id="addcampaign">
                        <div class="box-body">

                            <div class="message localMessage"
                                style="display:<?php if(isset($msg)){echo 'block';}else{echo 'none';}?>">
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

                            <div class="col-md-12">
                                <h2 class="formfieldheading">Basic Information</h2>
                                <img class="border-img" width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="fieldlabel">Name<font color="red">*</font></label>
                                    <input type="text" class="form-control" name="campaign" id="campaign"
                                        value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->campaignname;}?><?php if(isset($defaultCampaign)){echo $defaultCampaign;?> - Default Campaign<?php } ?>"
                                        required /></br>
                                    <span style="color:red" id="span_campaign"></span>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="display-block">Type</label>
                                    <input type="radio" class="campaign-radio cursor-pointer" name="campaign_type"
                                        id="remnant" value="1"
                                        <?php if(isset($campaign[0]->campaign_type) && $campaign[0]->campaign_type=='1'){echo 'checked';}?> />&nbsp;&nbsp;<b>Remnant</b>
                                    <div style="display:<?php if(isset($campaign[0]->campaign_type)){if( $campaign[0]->campaign_type=='1'){echo 'block';}else{echo 'none';}}else{echo 'block';}?>"
                                        class="campaign-type" id="campaign_remnant"><?php echo $remnant;?></div>
                                </div>
                                <div class="form-group">

                                    <input type="radio" class="campaign-radio cursor-pointer" name="campaign_type"
                                        id="contract" value="2"
                                        <?php if(isset($campaign[0]->campaign_type) && $campaign[0]->campaign_type=='2'){echo 'checked';}?> />&nbsp;&nbsp;<b>Contract</b>
                                    <div style="display:<?php if(isset($campaign[0]->campaign_type)){if( $campaign[0]->campaign_type=='2'){echo 'block';}else{echo 'none';}}else{echo 'block';}?>"
                                        class="campaign-type" id="campaign_contract"><?php echo $contract;?></div>
                                </div>
                                <div class="form-group">

                                    <input type="radio" class="campaign-radio cursor-pointer" name="campaign_type"
                                        id="override" value="3"
                                        <?php if(isset($campaign[0]->campaign_type) && $campaign[0]->campaign_type=='3'){echo 'checked';}?> />&nbsp;&nbsp;<b>Override</b>

                                    <div style="display:<?php if(isset($campaign[0]->campaign_type)){if( $campaign[0]->campaign_type=='3'){echo 'block';}else{echo 'none';}}else{echo 'block';}?>"
                                        class="campaign-type" id="campaign_override"><?php echo $override;?></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <h2 class="formfieldheading">Date</h2>
                                <img class="border-img" width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                                <div class="form-group">
                                    <label class="title-label">Start Date</label>

                                    <label class="radio-button-label"><input id="startSet_immediate" name="startSet"
                                            value="f" class="compaign-star-date"
                                            <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc !='yes'){echo 'checked="checked"';}}else{echo 'checked="checked"';} ?>
                                            type="radio"> Start immediately
                                    </label>

                                    <label class="radio-button-label">
                                        <input class="compaign-star-date" id="startSet_specific" name="startSet"
                                            <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc =='yes'){echo 'checked="checked"';}} ?>value="t"
                                            type="radio"> Set specific date
                                    </label>
                                    <span id="specificStartDateSpan"
                                        style="display: <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->activeaction_calc=='yes'){echo 'block';}else{echo 'none';}}else{echo 'none';}?>">

                                        <div style="width: 22%;margin-left:223px;padding-bottom: 20px;"
                                            class='input-group date' id="activate_time1">
                                            <input type='text' class="form-control" name="activate_time"
                                                id="activate_time" placeholder="dd-mm-yyyy"
                                                value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->activate_time;}?>" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>

                                    </span>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="title-label">End Date</label>
                                    <label class="radio-button-label">
                                        <input id="endSet_immediate" name="endSet" value="f" <?php if(isset($campaign[0]->campaignid))
									{
										if($campaign[0]->expirationtion_calc !='yes')
										{
											echo 'checked="checked"';
										}
									}
									else
									{
										echo 'checked="checked"';
									} 
									?> type="radio"> Don't expire
                                    </label>
                                    <label class="radio-button-label">
                                        <input id="endSet_specific" name="endSet" value="t"
                                            <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc =='yes'){echo 'checked="checked"';}} ?>
                                            type="radio"> Set specific date
                                    </label>
                                    <span id="specificEndDateSpan"
                                        style="display: <?php if(isset($campaign[0]->campaignid)){if($campaign[0]->expirationtion_calc=='yes'){echo 'block';}else{echo 'none';}}else{echo 'none';}?>">
                                        <div style="width: 22%;margin-left:223px;" class='input-group date'
                                            id="expire_time1">
                                            <input type='text' class="form-control" name="expire_time" id="expire_time"
                                                placeholder="dd-mm-yyyy" value="<?php if(isset($campaign[0]->campaignid) && (!empty($campaign[0]->expire_time)) && (($campaign[0]->expire_time)!= '0000-00-00'))
											{echo $campaign[0]->expire_time;} else{echo date('d-m-Y');}?>" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </span>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <h2 class="formfieldheading">Pricing</h2>
                                <img class="border-img" width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="name" class="">Pricing Model</label>
                                    <select name="revenue_type" id="revenue_type" class="form-control" />
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
                                <div class="form-group">
                                    <label for="name" class="">Rate / Price<font style="color:red;">*</font>
                                    </label>
                                    <input type="text" class="form-control" name="revenue" id="revenue"
                                        value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->revenue;}?>"
                                        required />
                                    <span style="color:red" id="span_revenue"></span>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Impression</label>
                                    <input type="text" class="form-control" name="impressions" id="impressions"
                                        value="<?php if(isset($campaign[0]->views) && $campaign[0]->views !=-1){echo $campaign[0]->views;}?>"
                                        <?php if(isset($campaign[0]->views) && $campaign[0]->views ==-1){echo 'disabled';}?> />
                                    <label style="margin-top:20px;" class="cursor-pointer">
                                        <input type="checkbox" value="-1" class="" name="views" id="views"
                                            <?php if(isset($campaign[0]) && $campaign[0]->views == -1){echo 'checked';}?> />
                                        Unlimited</label>

                                </div>
                            </div>


                            <div class="col-md-12">
                                <h2 class="formfieldheading">Priority In relation to other module</h2>
                                <img class="border-img" width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="display-block">Priority level</label>
                                    <select class="form-control" name="high_priority_value" id="high_priority_value"
                                        style="display: inline;width: 25%;" />
                                    <?php if(isset($campaign[0]->priority)){ ?>
                                    <option value="<?php echo $campaign[0]->priority;?>">
                                        <?php echo $campaign[0]->priority;?></option>
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
                                    </select>&nbsp;&nbsp;Limit
                                    <select class="form-control" name="target_type" id="target_type"
                                        style="display: inline;width: 25%;" />
                                    <?php if(isset($campaign[0]->tracking_type)){?>
                                    <option
                                        value="<?php if($campaign[0]->tracking_type){ echo $campaign[0]->tracking_type;?>">
                                        <?php echo substr($campaign[0]->tracking_type, 7);?>
                                        <?php } ?>
                                    </option>
                                    <?php } ?>

                                    <option value="target_impression">Impression</option>
                                    <option value="target_click">Clicks</option>
                                    <option value="target_conversion">Converiosn</option>
                                    </select>&nbsp;&nbsp;to
                                    <input type="text" class="form-control" name="target_value" id="target_value"
                                        style="display: inline;width: 25%;"
                                        value="<?php if(isset($campaign[0]->target_value)){ echo $campaign[0]->target_value;}else{echo '0';}?>">&nbsp;&nbsp;per
                                    day
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h2 class="formfieldheading">Delivery Capping per Visitor</h2>
                                <img class="border-img" width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="">Period</label>
                                    <input type="text" class="form-control" name="capping_period_value"
                                        id="capping_period_value"
                                        value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->capping_period_value;}?>" />
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Amount</label>
                                    <input type="text" class="form-control" name="capping_amount" id="capping_amount"
                                        value="<?php if(isset($campaign[0]->campaignid)){echo $campaign[0]->capping_amount;}?>" />
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Period Type</label>
                                    <select class="form-control capping_period_type" name="capping_period_type"
                                        id="capping_period_type" style="display:inline;" />
                                    <?php if(isset($campaign[0]->priority)){ ?>
                                    <option value="<?php echo $campaign[0]->capping_period_type;?>">
                                        <?php echo $campaign[0]->capping_period_type;?></option>
                                    <?php } ?>

                                    <option value="hours">Hours</option>
                                    <option value="days">Days</option>
                                    <option value="months">Months</option>
                                    <option value="years">Years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="formfieldheading">Miscellaneous</h2></br>
                                <img class="border-img" width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="display:none;">
                                    <label for="name" class="fieldlabel">Miscellaneous</label>
                                    <input type="checkbox" name="anonymous" id="anonymous" value="t" class="camp-chk"
                                        <?php if(isset($campaign[0]) && $campaign[0]->anonymous == 't'){echo 'checked';}?> />&nbsp;&nbsp;Hide
                                    the advertiser and websites of this campaign.
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label for="name" class="fieldlabel">Miscellaneous</label>
                                    <input type="checkbox" name="companion" id="companion" value="1" class="camp-chk"
                                        <?php if(isset($campaign[0]) && $campaign[0]->companion == 1){echo 'checked';}?> />&nbsp;&nbsp;Companion
                                    positioning:
                                </div>
                                <div class="form-group">
                                    <label for="name" class="fieldlabel">Comment</label>
                                    <textarea class="form-control" name="comments" rows="6"
                                        id="comments"><?php if(isset($campaign[0]->comments)){echo $campaign[0]->comments;}?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" name="submit" id="submit"
                                        value="submit">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
    </section>
</div>

<?php $this->load->view('admin_includes/footer');?>
<!-- Page script -->
<script type="text/javascript">
$(function() {
    $('#activate_time1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $('#expire_time1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
});
var campaign = '';
<?php if(isset($_GET['campaignid'])){ ?>
campaign = 'exist';
<?php } else{ ?>
campaign = 'new';
<?php } ?>
</script>