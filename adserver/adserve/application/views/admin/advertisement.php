<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<img src="<?php echo base_url()?>assets/upimages/icon-advertiser-add-large.png" class="header-image"/>
		<h3 class="header"><span style="color:#333333;">Add new advertiser</span></h3>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
					<?php if(isset($advertiser[0]->clientname)){$this->load->view('admin_includes/advertiser_header');}?>
					<form method="post" name="addadvertiser" id="addadvertiser" >
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
							<h2 style="font-size:14px;margin-bottom: -18px;font-weight: 700">Basic Information</h2>
							</br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Name<font style="color:#900;">*</font></label>
									<input class="formfield" type="text" name="name" id="name" value="<?php if(isset($advertiser[0]->clientname)){echo $advertiser[0]->clientname;}?>"/>
									<span style="color:red" id="span_name"></span>

								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Contact<font style="color:#900;">*</font></label>
									<input type="text" class="formfield"  id="contact" name="contact" value="<?php if(isset($advertiser[0]->contact)){echo $advertiser[0]->contact;}?>"/>
									<span style="color:red" id="span_contact"></span>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Email<font style="color:#900;">*</font></label>
									<input type="text" class="formfield" id="email" name="email" value="<?php if(isset($advertiser[0]->email)){echo $advertiser[0]->email;}?>">
									<span style="color:red" id="span_email"></span>
								</div>
							</div>
							<div class="col-md-7">
								<h2 style="font-size:14px;margin-bottom:-18px;font-weight: 700">Advertiser report</h2>
								</br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							
								<div class="form-group">
									<input type="checkbox" id="activeemail" name="activeemail" value="t" <?php if(isset($advertiser[0]->reportdeactivate)){echo 'checked';}?>>
									<label for="activeemail">Email when a campaign is automatically activated/deactivated</label>
									<span style="color:red"></span>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="checkbox" id="report" name="report" value="t" <?php if(isset($advertiser[0]->report)){echo 'checked';}?>>
									<label for="deliveryemail">Email campaign delivery reports</label>
									<span style="color:red"></span>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Number of days between campaign delivery reports</label>
									<input type="text"  class="formfield" id="report_interval" name="report_interval" value="<?php if(isset($advertiser[0]->reportinterval)){echo $advertiser[0]->reportinterval;}?>">
									<span style="color:red"></span>
								</div>
							</div>
							<div class="col-md-7">
								<h2 style="font-size:14px;margin-bottom:-18px;font-weight: 700">Miscellaneous</h2>
								</br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							

								<div class="form-group">
									<input type="checkbox"  id="adlimitation" name="adlimitation" value="1" <?php if(isset($advertiser[0]->advertiser_limitation)){echo "checked";}?>>
									<label> Display only one banner from this advertiser on a web page </label>
									<span style="color:red"></span>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Comment</label>
									<textarea name="comment" id="comment" class="formfield" style="width: 394px; height: 138px;"><?php if(isset($advertiser[0]->comments)){echo $advertiser[0]->comments;}?></textarea>
									<span style="color:red"></span>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<input type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
<script src="<?php echo base_url();?>assets/common/user-app.js"></script> 
-->
<?php $this->load->view('admin_includes/footer');?>







