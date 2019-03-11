<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<img class="header-image" width="40px" height="40px" style="margin-top: 9px;" src="<?php echo base_url()?>assets/upimages/Video-Icon.jpg"/>
		<h3 class="header"><span style="color:#333333;">Post Back Url Integration</span></h3>
	</section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
					<?php if(isset($banner[0]->bannerid)){$this->load->view('admin_includes/banner_header');}?>
					<form method="post" name= "postbackintegration" 	id ="postbackintegration" enctype="multipart/form-data">
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
							<div class="col-md-7">
								<h2 class="formfieldheading">Agency Post Back Url</h2></br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							</div>
						<div class="col-md-7">
							<div class="form-group">
								<label for = "name" class="fieldlabel">PostbackUrl<font color="red">*</font></label>
								<input type="text" class="formfield" name="PostbackUrl" id="PostbackUrl" >
							</div>
						</div>
						<div class="col-md-7" style="display:<?php if(isset($lp)){echo 'block';}else{echo 'none';}?>">
								<div class="form-group" style="float:left;">
									<img align="absmiddle" src="https://www.mediaconversion.com/report/adserver/assets/upimages/icon-generatecode.gif">
									<label class="fieldlabel"><b>Pixel</b></label>
								</div>
								<div style="margin-left: 275px;">
									<textarea id="bannercode" name="bannercode" class="code-gray" rows="5" cols="80" style="width:75%; border: 1px solid black" readonly=""><?php if(isset($tracking_pixel)){echo $tracking_pixel;}?></textarea>
								</div>
							<div style="clear:both"></div>
							</div>
						
						<div class="col-md-7" style="display:<?php if(isset($lp)){echo 'block';}else{echo 'none';}?>">
								<div class="form-group" style="float:left;">
									<img align="absmiddle" src="https://www.mediaconversion.com/report/adserver/assets/upimages/icon-generatecode.gif">
									<label class="fieldlabel"><b>LP</b></label>
								</div>
								<div style="margin-left: 275px;">
									<textarea id="bannercode" name="bannercode" class="code-gray" rows="5" cols="80" style="width:75%; border: 1px solid black" readonly=""><?php if(isset($lp)){echo $lp;}?></textarea>
								</div>
							<div style="clear:both"></div>
							</div>
								<div class="col-md-7" style="display:<?php if(isset($PostbackUrl)){echo 'block';}else{echo 'none';}?>">
								<div class="form-group" style="float:left;">
									<img align="absmiddle" src="https://www.mediaconversion.com/report/adserver/assets/upimages/icon-generatecode.gif">
									<label class="fieldlabel"><b>PostbackUrl</b></label>
								</div>
								<div style="margin-left: 275px;">
									<textarea id="bannercode" name="bannercode" class="code-gray" rows="5" cols="80" style="width:75%; border: 1px solid black" readonly=""><?php if(isset($PostbackUrl)){echo $PostbackUrl;}?></textarea>
								</div>
							<div style="clear:both"></div>
							</div>
						<div class="box-footer">
							<input class="btn btn-primary"  name="submit" id="submit" type="submit" value="Get Lp">
						</div>
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
