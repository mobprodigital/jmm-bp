<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<img class="header-image" width="40px" height="40px" style="margin-top: 9px;" src="<?php echo base_url()?>assets/upimages/Video-Icon.jpg"/>
		<h3 class="header"><span style="color:#333333;">Upload new video</span></h3>
	</section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
					<?php if(isset($banner[0]->bannerid)){$this->load->view('admin_includes/banner_header');}?>
					<form method="post" name= "addbanner" 	id ="addbanner" enctype="multipart/form-data">
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
								<h2 class="formfieldheading">Basic information</h2></br>
								<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							</div>
						<div class="col-md-7">
							<div class="form-group">
								<label for = "name" class="fieldlabel">Title<font color="red">*</font></label>
								<input type="text" class="formfield" name="title" id="title"  value="<?php if(isset($videos[0]->title)){echo $videos[0]->title;}?>"/>
							</div>
						</div>
						<div class="col-md-7">
							<div class="form-group">
								<label for = "name" class="fieldlabel">Source</label>
								<input type="text" class="formfield" name="source" id="source"  value="<?php if(isset($videos[0]->source)&& $videos[0]->source !=""){echo $videos[0]->source;}?>"/>
							</div>
						</div>
						<div class="col-md-7">
							<div class="form-group">
								<label for = "name" class="fieldlabel">Upload Video<font color="red">*</font></label>
								<input type="file"   name="file" id="file" class="formfield" style="display:inline;"/>
								<?php if(isset($videos[0]->name)){ ?>
									<span><?php echo $videos[0]->name;?></span>
								<?php } ?>
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
<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
	<script src="<?php echo base_url();?>assets/common/user-app.js"></script> 
-->
<?php $this->load->view('admin_includes/footer');?>
