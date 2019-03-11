<div class="col-md-7">
	<div class="form-group">
		<label for="name" class="fieldlabel">Destination Url (incl. http://) </label>
		<input type="text" placeholder="http://" class="formfield"  name="html_url" id="html_url" value="<?php if(isset($banner[0]->url) && $banner[0]->url !=''){echo $banner[0]->url;}?>" />
	</div>
</div>
<div class="col-md-7">
<div class="form-group">
	<label for="name" class="fieldlabel">Tracking Pixel</label>
	<input type="text" 	class="formfield" 	 name="html_tracking_pixel" id="html_tracking_pixel" value="<?php if(isset($banner[0]->tracking_pixel)){echo $banner[0]->tracking_pixel;}?>"/>
</div>
</div>
<div class="col-md-7">
	<div class="form-group">
		<label for="name" class="fieldlabel">Size<font color="red">*</font></label>
		<input type="text" name="hwidth" id="hwidth" class="smalltextbox" value="<?php if(isset($banner[0]->width)){echo $banner[0]->width;}?>">&nbsp;&nbsp;Width<font color="red">*</font>
		<input type="text" name="hheight" id="hheight" class="smalltextbox" value="<?php if(isset($banner[0]->height)){echo $banner[0]->height;}?>">&nbsp;&nbsp;Height<font color="red">*</font>
	</div>
</div>
<div class="col-md-7">
	<div class="form-group" style="float:left;">
		<img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-generatecode.gif">
		<label class="fieldlabel"><b>code</b></label>
	</div>
	<div>
		<?php //echo $banner[0]->storagetype;die;?>
		<textarea id="html5" name="html5" class="code-gray" rows="20" cols="100" style="margin-left:205px;width:75%; border: 1px solid black"><?php if(isset($banner[0]->storagetype) && ($banner[0]->storagetype =='html5')){ echo $banner[0]->htmltemplate;}?></textarea>
	</div>
	<div style="clear:both"></div>
</div>
