<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
			<img src="<?php echo base_url()?>assets/upimages/icon-zone-add-large.png" class="header-image"/>
		<h3 class="header"><span style="color:#333333;">Add new zone</span></h3>
    
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12"> 
				<div class="box box-default">
				<?php //$this->load->view("admin_includes/zoneheader");?>
				<?php if (!is_null($affiliateid)){ ?>
					<form method="post" name="zoneform" id = "zoneform">
						<div class="box-body">
						<div class="errormessage" id="warning_change_zone_size" style="display: none;"> <img class="errormessage" src="http://localhost/revive/www/admin/assets/images/warning.gif" align="absmiddle">
							<span class="tab-s"> Notice:</span><br>
							Changing the zone size will unlink any banners that are not the new size, and will add any banners from linked campaigns which are the new size
						</div>
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
							<div class="col-md-7">
								<h2 class="formfieldheading">Basic information</h2></br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">

							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Name<font style="color:#F44336;">*</font></label>
									<input type="text" 	style="margin-left:5px;" class="formfield"  name="zonename" id="zonename" value="<?php if(isset($default[0]->zonename)){echo $default[0]->zonename;?>-Default <?php }elseif(isset($zones[0]->zonename)){ echo $zones[0]->zonename;} ?>"/>
									<span style="color:red" id="span_zonename" class="errorspan"></span>
									<input type="hidden" style="margin-left:5px;" class="formfield"  name="default" id="default" value="<?php if(isset($default[0]->zonename)){echo $default[0]->affiliateid;}?>"/>

								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Description</label>
									<input type="text"  style="margin-left:5px;" class="formfield"  name="description" id="description" value="<?php if(isset($zones[0]->description)){ echo $zones[0]->description;} ?>"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Zone type</label>
									<input type="radio" value="web" name="delivery" class="zone" id="delivery-b" <?php if(isset($zones[0]->delivery) && $zones[0]->delivery =='web'){echo 'checked'; } ?> style="margin-left:5px;">&nbsp; <label for="delivery-b"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-zone.gif">&nbsp;Standerd Banner</label><br>
									<input type="radio" value="html5" name="delivery" class="zonetype zone"   id="delivery-h"  <?php if(isset($zones[0]->delivery) && $zones[0]->delivery=='html5'){echo 'checked';} ?>>&nbsp;&nbsp;<label for="delivery-i"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-interstitial.gif">&nbsp;HTML5</label><br>
									<input type="radio" value="html" name="delivery" class="zonetype zone"   id="delivery-vi" <?php if(isset($zones[0]->delivery) && $zones[0]->delivery=='html'){echo 'checked';} ?>>&nbsp;&nbsp;<label for="delivery-vi"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-zone-video-instream.png">&nbsp;Inline Video ad</label><br>
									<!--
									<input type="radio" value="2" name="delivery" class="zonetype zone"   id="delivery-t"  <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype==2){echo 'checked';} ?>>&nbsp;&nbsp;<label for="delivery-t"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-textzone.gif">&nbsp;Text ad</label><br>
									<input type="radio" value="3" name="delivery" class="zonetype zone"   id="delivery-e"  <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype==3){echo 'checked';} ?>>&nbsp;&nbsp;<label for="delivery-e"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-zone-email.gif">&nbsp;Email/Newsletter zone</label><br>
									<input type="radio" value="4" name="delivery" class="zonetype zone"   id="delivery-vi" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype==4){echo 'checked';} ?>>&nbsp;&nbsp;<label for="delivery-vi"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-zone-video-instream.png">&nbsp;Inline Video ad</label><br>
									<input type="radio" value="5" name="delivery" class="zonetype zone"   id="delivery-vo" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype==5){echo 'checked';} ?>>&nbsp;&nbsp;<label for="delivery-vo"><img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-zone-video-overlay.png">&nbsp;Overlay Video ad</label><br>
									-->
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Size</label>
										<td width="100%">
										
											<input type="radio" value="default" name="sizetype" id="size-d" style="margin-left:5px;" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype == 'default'){echo 'checked';} ?>>
											<select onchange="phpAds_formSelectSize(this); oa_sizeChangeUpdateMessage(&quot;warning_change_zone_size&quot;);"    id="size" name="size" class="medium">
											<?php if(isset($zones[0]->size)){ ?>
											<option value="<?php $zones[0]->size;?>"><?php $zones[0]->size;?></option>
											<?php } ?>
													
													<option value="468x60" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '468' && $zones[0]->height == '60'){echo 'selected';} ?>>IAB Full Banner (468 x 60)</option>
													<option value="120x600" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '120' && $zones[0]->height == '600'){echo 'selected';} ?>>IAB Skyscraper (120 x 600)</option>
													<option value="728x90" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '728' && $zones[0]->height == '90'){echo 'selected';} ?>>IAB Leaderboard (728 x 90)</option>
													<option value="120x90" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '120' && $zones[0]->height == '90'){echo 'selected';} ?>>IAB Button 1 (120 x 90)</option>
													<option value="120x60" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '120' && $zones[0]->height == '60'){echo 'selected';} ?>>IAB Button 2 (120 x 60)</option>
													<option value="234x60" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '234' && $zones[0]->height == '60'){echo 'selected';} ?>>IAB Half Banner (234 x 60)</option>
													<option value="88x31" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '88' && $zones[0]->height == '31'){echo 'selected';} ?>>IAB Micro Bar (88 x 31)</option>
													<option value="125x125" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '125' && $zones[0]->height == '125'){echo 'selected';} ?>>IAB Square Button (125 x 125)</option>
													<option value="120x240" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '120' && $zones[0]->height == '240'){echo 'selected';} ?>>IAB Vertical Banner (120 x 240)</option>
													<option value="180x150" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '180' && $zones[0]->height == '150'){echo 'selected';} ?>>IAB Rectangle (180 x 150)</option>
													<option value="300x250" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '300' && $zones[0]->height == '250'){echo 'selected';} ?>>IAB Medium Rectangle (300 x 250)</option>
													<option value="336x280" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '336' && $zones[0]->height == '280'){echo 'selected';} ?>>IAB Large Rectangle (336 x 280)</option>
													<option value="240x400" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '240' && $zones[0]->height == '400'){echo 'selected';} ?>>IAB Vertical Rectangle (240 x 400)</option>
													<option value="250x250" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '250' && $zones[0]->height == '250'){echo 'selected';} ?>>IAB Square Pop-up (250 x 250)</option>
													<option value="160x600" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '160' && $zones[0]->height == '600'){echo 'selected';} ?>>IAB Wide Skyscraper (160 x 600)</option>
													<option value="720x300" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '720' && $zones[0]->height == '300'){echo 'selected';} ?>>IAB Pop-Under (720 x 300)</option>
													<option value="300x100" <?php if(isset($zones[0]->zonetype) && $zones[0]->width == '300' && $zones[0]->height == '100'){echo 'selected';} ?>>IAB 3:1 Rectangle (300 x 100)</option>
													<option value="-" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype == 'custom'){echo 'selected';} ?>>Custom</option>
													
											</select>
										<br>
										<input type="radio" value="custom" name="sizetype" id="size-c" class="zonetype" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype == 'custom'){echo 'checked';} ?> <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype=='html'){echo 'disabled';}?>>&nbsp;&nbsp;&nbsp;Width: &nbsp;&nbsp;&nbsp;
										<input type="text" class="x-small" id="width"  value="<?php if(isset($zones[0]->width)){ echo $zones[0]->width;} ?>"  name="width" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype=='html'){echo 'disabled';}?>>&nbsp;&nbsp;&nbsp;Height: &nbsp;&nbsp;&nbsp;
										<input type="text" class="x-small" id="height" value="<?php if(isset($zones[0]->height)){ echo $zones[0]->height;} ?>"  name="height" <?php if(isset($zones[0]->zonetype) && $zones[0]->zonetype=='html'){echo 'disabled';}?>>
										<br>
									</td>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Comment</label>
									<textarea name="comment" id="comment" class="formfield" style="width: 413px; height: 100px;margin-left:7px;"><?php if(isset($zones[0]->comments) ){echo $zones[0]->comments; }?></textarea>
									<span style="color:red"></span>
								</div>
							</div>
						</div>
						</div>
						<div class="box-footer">
							<input class="btn btn-primary"  name="submit" id="submit" type="submit" value="Submit">
						</div>
					</div>
					</form>
				<?php }else{ ?>
				<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no sites available add it first</div>

				<?php } ?>
				</div>
			</div>
		</div>
	</section>
</div>

<script language='JavaScript'>
<!--
    document.zoneHeight ='250';
    document.zoneWidth ='300';


    function phpAds_formSelectSize(o)
    {
        // Get size from select
        size   = o.options[o.selectedIndex].value;

        if (size != '-')
        {
            // Get width and height
            sarray = size.split('x');
            height = sarray.pop();
            width  = sarray.pop();

            // Set width and height
            document.zoneform.width.value = width;
            document.zoneform.height.value = height;

            // Set radio
            document.zoneform.sizetype[0].checked = true;
            document.zoneform.sizetype[1].checked = false;
        }
        else
        {
            document.zoneform.sizetype[0].checked = false;
            document.zoneform.sizetype[1].checked = true;
        }
    }

    function phpAds_formEditSize()
    {
        document.zoneform.sizetype[0].checked = false;
        document.zoneform.sizetype[1].checked = true;
        document.zoneform.size.selectedIndex = document.zoneform.size.options.length - 1;
    }

    function phpAds_formDisableSize()
    {
        document.zoneform.sizetype[0].disabled = true;
        document.zoneform.sizetype[1].disabled = true;
        document.zoneform.width.disabled = true;
        document.zoneform.height.disabled = true;
        document.zoneform.size.disabled = true;
    }

    function phpAds_formEnableSize()
    {
        document.zoneform.sizetype[0].disabled = false;
        document.zoneform.sizetype[1].disabled = false;
        document.zoneform.width.disabled = false;
        document.zoneform.height.disabled = false;
        document.zoneform.size.disabled = false;
    }

    function oa_sizeChangeUpdateMessage(id)
    {
        if (document.zoneWidth != document.zoneform.width.value ||
            document.zoneHeight !=  document.zoneform.height.value) {
                oa_show(id);

        } else if (document.zoneWidth == document.zoneform.width.value &&
                   document.zoneHeight ==  document.zoneform.height.value) {
            oa_hide(id);
        }
    }

    function oa_show(id)
    {
        var obj = findObj(id);
        if (obj) { obj.style.display = 'block'; }
    }
    function oa_hide(id)
    {
        var obj = findObj(id);
        if (obj) { obj.style.display = 'none'; }
    }

//-->
</script>

<?php $this->load->view('admin_includes/footer');?>







