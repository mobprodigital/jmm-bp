<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<h1>Add new banner</h1>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
					<form method="post" 	name = "addbanner" 		id = "addbanner">
						<div class="box-body">
							<?php if(isset($msg)){?>
									<p id="msg2" style="color:green"><?php echo $msg;?></p>
							<?php }?>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name"  style="font-weight:700">Please choose type of banner</label></br>
									<select tabindex="1" name="type">
										<optgroup label="web">
											<option selected="selected" value="web">Upload a local banner to the webserver</option>
										</optgroup>
										<optgroup label="sql">
											<option value="sql">Upload a local banner to the database</option>
										</optgroup>
										<optgroup label="url">
											<option value="url">Link an external banner</option>
										</optgroup>
										<optgroup label="html">
											<option value="bannerTypeHtml:oxHtml:genericHtml">Generic HTML Banner</option>
											<option value="bannerTypeHtml:vastInlineBannerTypeHtml:vastInlineHtml">Inline Video Ad (pre/mid/post-roll)</option>
											<option value="bannerTypeHtml:vastOverlayBannerTypeHtml:vastOverlayHtml">Overlay Video Ad</option>
										</optgroup>
										<optgroup label="text">
											<option value="bannerTypeText:oxText:genericText">Generic Text Banner</option>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="col-md-7">
								<hr class="formline">
								<h2 class="formfieldheading">Basic information</h2>
								<hr class="formline">
								<div class="form-group">
									<label for    = "name" 		class	="fieldlabel">Name<font color="red">*</font></label>
									<input type   = "text"  	class	="formfield" name="description" id="description"/></br>
									<label for    = "name" 		class	="fieldlabel"></label>
									<span style	  = "color:red;margin-left:40px;" id ="span_description"></span>
								</div>
							</div>
							<div class="col-md-7">
								<h2 class="formfieldheading">Upload a local banner to the webserver -  banner creative</h2><hr class="formline">
								<div class="form-group">
									<label for="name" class="fieldlabel" style="float:left;margin-right:40px;">Select the image you want to use for this banner</label>
									<input type="file" class="formfield" name="upload" id="upload">
								</div>
							</div>
							<div class="col-md-7">
								<h2 class="formfieldheading">Banner link</h2>
								<hr class="formline">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Destination Url (incl. http://) </label>
									<input type="text" 		placeholder="http://" class="formfield"  name="url" id="url"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Target</label>
									<input type="text" 	class="formfield" 	 name="target" id="target"/>
								</div>
							</div>
							<div class="col-md-7">
								<h2 class="formfieldheading">Banner display</h2>
								<hr  class="formline">
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">All text</label>
									<input type="text" 		 class="formfield"  name="alt" id="alt"/>
								</div>
							</div><div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Status text </label>
									<input type="text" 		class="formfield"  name="statustext" id="statustext"/>
								</div>
							</div><div class="col-md-7">
								<div class="form-group">
									<label for="name" 	class="fieldlabel">Text below image </label>
									<input type="text" 	class="formfield"  name="bannertext" id="bannertext"/>
								</div>
							</div>
							<div class="col-md-7">
								<h2 class="formfieldheading">Additional data</h2>
								<hr class="formline">
								<div class="form-group">
									<label class="fieldlabel">Keywords</label>
									<input type="text" 	class="formfield"  name="keyword" id="keyword"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Weight</label>
									<input type="text" 			 class="formfield"  name="weight" id="weight"/>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" class="fieldlabel">Comments</label>
									<textarea style="width: 394px; height: 100px;" class="formfield" name="comments" id="comments"></textarea>
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







