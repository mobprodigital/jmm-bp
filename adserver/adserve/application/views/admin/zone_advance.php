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
								<h2 class="formfieldheading">Chain settings</h2></br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">If no banners from this zone can be delivered, try to... </label>
									<input type="radio" value="1" name="delivery"   style="margin-left: 38px;" id="delivery-i">&nbsp;&nbsp;<label for="delivery-i">&nbsp;Stop delivery and don't show a banner</label><br>
									<input type="radio" value="2" name="delivery"   style="margin-left: 223px;" id="delivery-t">&nbsp;&nbsp;<label for="delivery-t">&nbsp;Display the selected zone instead</label><br>
								</div>
							</div>
					
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Limit zone views to</label>
									<input type="text"  class="formfield" style="width:8%" name="target_value" id="target_value" placeholder="0"/>&nbsp;&nbsp;in total
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Limit zone views to</label>
									<input type="text"  class="formfield" style="width:8%" name="target_value" id="target_value" placeholder="0"/>&nbsp;&nbsp;per session
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Reset view counters after: </label>
									<input type="text"  class="formfield" style="width:8%" name="target_value" id="target_value" placeholder="-"/>&nbsp;&nbsp;hours
									&nbsp;&nbsp;-Limit		
								<input type="text"  class="formfield" style="width:8%" name="target_value" id="target_value" placeholder="-"/>&nbsp;&nbsp;mintues
								<input type="text"  style="width:8%" name="target_value" id="target_value" placeholder="-"/>&nbsp;&nbsp;seconds
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Cookies</label>
									<input type="checkbox" value="1" name="delivery"   style="margin-left: 38px;" id="delivery-i">&nbsp;&nbsp;<label for="delivery-i">&nbsp;Show capped ads if cookies are disabled</label><br>
								</div>
							</div>
							<div class="col-md-7">
								<h2 class="formfieldheading">Append and prepend settings</h2></br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">

							</div>
								<div class="col-md-7">
								<div class="form-group">
									<input type="checkbox" value="1" name="delivery"   style="margin-left: 38px;" id="delivery-i">&nbsp;&nbsp;<label for="delivery-i">&nbsp;Prepend/Append even if no banner delivered</label><br>
									
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Always prepend the following HTML code to banners displayed by this zone </label>
									<textarea name="comment" id="comment" class="formfield" style="width: 394px; height: 88px;"></textarea>
									<span style="color:red"></span>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Always append the following HTML code to banners displayed by this zone </label>
									<textarea name="comment" id="comment" class="formfield" style="width: 394px; height: 88px;"></textarea>
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







