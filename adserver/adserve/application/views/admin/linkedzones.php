<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<img style="float: left;"src="<?php echo base_url()?>assets/upimages/icon-zones-large.png"/>
		<h1 style="padding-left: 10px;margin-top:12px;">Zone for cricmagic.com</h1>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12"> 
				<div class="box box-default">
				<?php $this->load->view("admin_includes/zoneheader");?>
					<form method="post" 	name = "addbanner" 		id = "addbanner">
						<div class="box-body">
						<?php if(isset($msg)){?>
							<p id="msg2" style="color:green"><?php echo $msg;?></p>
						<?php }?>
						
							<div class="col-md-7">
								<hr class="formline">
								<h2 class="formfieldheading">Basic information</h2>
								<hr class="formline">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Name<font style="color:#F44336;">*</font></label>
									<input type="text" 		style="margin-left:5px;" class="formfield"  name="zonename" id="zonename" placeholder="cricmagic.com - Default"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Description</label>
									<input type="text" 		style="margin-left:5px;" class="formfield"  name="description" id="description"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Zone type</label>
									<input type="radio" value="0" name="delivery" class="zone"   		  id="delivery-b"  checked="checked" style="margin-left:5px;">&nbsp; <label for="delivery-b"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/icon-zone.gif">&nbsp;Banner, Button or Rectangle</label><br>
									<input type="radio" value="1" name="delivery" class="zonetype zone"   id="delivery-i">&nbsp;&nbsp;<label for="delivery-i"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/icon-interstitial.gif">&nbsp;Interstitial or Floating DHTML</label><br>
									<input type="radio" value="2" name="delivery" class="zonetype zone"   id="delivery-t">&nbsp;&nbsp;<label for="delivery-t"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/icon-textzone.gif">&nbsp;Text ad</label><br>
									<input type="radio" value="3" name="delivery" class="zonetype zone"   id="delivery-e">&nbsp;&nbsp;<label for="delivery-e"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/icon-zone-email.gif">&nbsp;Email/Newsletter zone</label><br>
									<input type="radio" value="4" name="delivery" class="zonetype zone"   id="delivery-vi">&nbsp;&nbsp;<label for="delivery-vi"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/icon-zone-video-instream.png">&nbsp;Inline Video ad</label><br>
									<input type="radio" value="5" name="delivery" class="zonetype zone"   id="delivery-vo">&nbsp;&nbsp;<label for="delivery-vo"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/icon-zone-video-overlay.png">&nbsp;Overlay Video ad</label><br>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Size</label>
										<td width="100%">
											<input    type="radio"  	value="default" name="sizetype" id="size-d" style="margin-left:5px;">
											<select   id="size" name="size" class="medium">
												<option selected="selected" value="468x60">IAB Full Banner (468 x 60)</option>
												<option value="120x600">IAB Skyscraper (120 x 600)</option>
												<option value="728x90">IAB Leaderboard (728 x 90)</option>
												<option value="120x90">IAB Button 1 (120 x 90)</option>
												<option value="120x60">IAB Button 2 (120 x 60)</option>
												<option value="234x60">IAB Half Banner (234 x 60)</option>
												<option value="88x31"> IAB Micro Bar (88 x 31)</option>
												<option value="125x125">IAB Square Button (125 x 125)</option>
												<option value="120x240">IAB Vertical Banner (120 x 240)</option>
												<option value="180x150">IAB Rectangle (180 x 150)</option>
												<option value="300x250">IAB Medium Rectangle (300 x 250)</option>
												<option value="336x280">IAB Large Rectangle (336 x 280)</option>
												<option value="240x400">IAB Vertical Rectangle (240 x 400)</option>
												<option value="250x250">IAB Square Pop-up (250 x 250)</option>
												<option value="160x600">IAB Wide Skyscraper (160 x 600)</option>
												<option value="720x300">IAB Pop-Under (720 x 300)</option>
												<option value="300x100">IAB 3:1 Rectangle (300 x 100)</option>
												<option value="-">Custom</option>
											</select>
										<br>
										<input   type="radio" value="custom" name="sizetype" id="size-c" style="margin-left:235px;">&nbsp;&nbsp;&nbsp;Width: &nbsp;&nbsp;&nbsp;
										<input   type="text" class="x-small" id="width" value="468" size="5" name="width" onchange="oa_sizeChangeUpdateMessage(&quot;warning_change_zone_size&quot;);" onkeydown="phpAds_formEditSize();">&nbsp;&nbsp;&nbsp;Height: &nbsp;&nbsp;&nbsp;
										<input   type="text" class="x-small" id="height" value="60" size="5" name="height" onchange="oa_sizeChangeUpdateMessage(&quot;warning_change_zone_size&quot;);" onkeydown="phpAds_formEditSize();">
										<br>
									</td>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Comment</label>
									<textarea name="comment" id="comment" class="formfield" style="width: 394px; height: 88px;margin-left:7px;"></textarea>
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
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>







