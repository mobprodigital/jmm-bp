<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<img style="float: left;"src="<?php echo base_url()?>assets/upimages/icon-targeting-channel-large.png"/>
		<h1 style="padding-left: 10px;margin-top:12px;">Add new Targeting Channel</h1>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
					<form method="post" 	name = "addbanner" 		id = "addbanner">
						<div class="box-body">
							<?php if(isset($msg)){?>
									<p id="msg2" style="color:green"><?php echo $msg;?></p>
							<?php } ?>
							<div class="col-md-7">
								<hr class="formline">
								<h2 class="formfieldheading">Basic information</h2>
								<hr class="formline">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Name<font style="color:#F44336;">*</font></label>
									<input type="text" 		class="formfield"  name="statustext" id="statustext"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Description</label>
									<input type="text" 		class="formfield"  name="statustext" id="statustext"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label class="fieldlabel">Comment</label>
									<textarea name="comment" id="comment" class="formfield" style="width: 410px; height: 96px;"></textarea>
									<span style="color:red"></span>
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
<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
	<script src="<?php echo base_url();?>assets/common/user-app.js"></script> 
-->
<?php $this->load->view('admin_includes/footer');?>







