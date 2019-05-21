<style>
hr {
    margin-bottom: 9px;
}
.fieldlabel {
    width: 27%;
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
				<?php $this->load->view("admin_includes/banner_header");?>
					<form id="generate" name="generate" method="POST" onsubmit="return max_formValidate(this) &amp;&amp; disableTextarea();">						<div class="box-body">
						<?php if(isset($msg)){?>
							<p id="msg2" style="color:green"><?php echo $msg;?></p>
						<?php }?>
							<div class="col-md-7">
								<hr class="formline">
								<h2 class="formfieldheading">Please choose the type of banner invocation</h2>
								<hr class="formline">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<select  name="codetype" id="codetype">
									<?php if(isset($_GET['codetype'])){ ?>
										<option value="<?php echo $_GET['codetype'];?>"><?php if($_GET['codetype'] == 'scrpt'){echo 'Javascript Tag';}else{echo 'iFrame Tag';}?></option>
									<?php } ?>
										<option value="scrpt">Javascript Tag</option>
										<option value="adframe">iFrame Tag</option>
									</select>&nbsp;
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group" style="float:left;">
									<img align="absmiddle" src="<?php echo base_url()?>/assets/upimages/icon-generatecode.gif">
									<label class="fieldlabel"><b>Bannercode</b></label>
								</div>
								<div>
									<textarea id='bannercode' name='bannercode' class='code-gray' rows='15' cols='80' style='width:95%; border: 1px solid black' readonly class="formfield"><?php if(isset($invocationCode)){echo $invocationCode;}?></textarea>
								</div>
							<div style="clear:both"></div>
							</div>
							
							<div class="col-md-7">
								<img align="absmiddle" src="<?php echo base_url()?>/assets/upimages/icon-overview.gif">
								<label class="fieldlabel"><b>Tag settings</b></label>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Don't show the banner again on the same page</label>
									<input type="radio" value="1" name="delivery"   style="margin-left: 38px;" id="delivery-i">&nbsp;&nbsp;<label for="delivery-i">&nbsp;Yes</label><br>
									<label for="name" class="fieldlabel"></label>
									<input type="radio" value="2" name="delivery"   style="margin-left: 38px;" id="delivery-t">&nbsp;&nbsp;<label for="delivery-t">&nbsp;No</label><br>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Don't show a banner from the same campaign again on the same page</label>
									<input type="radio" value="1" name="delivery"   style="margin-left: 38px;" id="delivery-i">&nbsp;&nbsp;<label for="delivery-i">&nbsp;Yes</label><br>
									<label for="name" class="fieldlabel"></label>
									<input type="radio" value="2" name="delivery"   style="margin-left: 38px;" id="delivery-t">&nbsp;&nbsp;<label for="delivery-t">&nbsp;No</label><br>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Target frame</label>
									<select tabindex="6" name="target" style="margin-left: 38px;">
										<option value="">Default</option>
										<option value="_blank">New window</option>
										<option value="_top">Same window</option>
									</select>								
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Source</label>
									<input type="text"  class="formfield" style="width:20%" name="target_value" id="target_value" placeholder="0"/>&nbsp;&nbsp;in total
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Support 3rd Party Server Clicktracking</label>
									<select tabindex="8" name="thirdpartytrack"    style="margin-left: 38px;">
										<option value="0">No</option>
										<option value="generic">Generic</option>
										<option value="adtech">Adtech</option>
										<option value="zedo">Zedo</option>
										<option value="doubleclick">Doubleclick/DFP</option>
										<option value="newdoubleclick">NewDoubleclick</option>
										<option value="revive">OpenX/Reviveadserver</option>
									</select>								
								</div>
							</div>
							<div class="col-md-7">
								<img align="absmiddle" src="<?php echo base_url()?>/assets/upimages/icon-overview.gif">
								<label class="fieldlabel"><b>Tag settings</b></label>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							</div>
						</div>
						</div>
						<div class="box-footer">
							<input class="btn btn-primary"  name="submit" id="submit" type="submit" value="Refresh"/>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>

<script>
$("#codetype").change(function(){
		var codetype	= $(this).val();
		window.location.href="invocation?bannerid=<?php echo $_GET['bannerid'];?>&campaignid=<?php echo $_GET['campaignid'];?>&clientid=<?php echo $_GET['clientid'];?>&codetype="+codetype;});
</script>







