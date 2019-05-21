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
		<label for="name"  class="fieldlabel">Rich Media Type</label>
		<select tabindex="1" name="rich_media_type" id="rich_media_type" class="formfield" onchange="checkType();">
			<option value="">select</option>
			<option value="1" <?php if(isset($banner[0]->rich_media_type) && ($banner[0]->rich_media_type) && ($banner[0]->rich_media_type == 1) ){ echo 'selected';}?>>Expando (Right to Left)</option>
			<option value="2" <?php if(isset($banner[0]->rich_media_type) &&  ($banner[0]->rich_media_type) && ($banner[0]->rich_media_type == 2)){ echo 'selected';}?>>Expando (Top to Bottom)</option>
			<option value="3" <?php if(isset($banner[0]->rich_media_type) && ($banner[0]->rich_media_type) && ($banner[0]->rich_media_type == 3)){ echo 'selected';}?>>PagePusher</option>
			<option value="4"<?php if(isset($banner[0]->rich_media_type) &&  ($banner[0]->rich_media_type) && ($banner[0]->rich_media_type == 4)){ echo 'selected';}?>>Interstatial</option>
			<!--<option value="5"<?php if(isset($banner[0]->rich_media_type) &&  ($banner[0]->rich_media_type) && ($banner[0]->rich_media_type == 5)){ echo 'selected';}?>>In Artilcle</option>
			<option value="6"<?php if(isset($banner[0]->rich_media_type) &&  ($banner[0]->rich_media_type) && ($banner[0]->rich_media_type == 6)){ echo 'selected';}?>>Native Ad</option>
			-->
		</select>
	</div>
</div>

<div class="col-md-7">
	<div class="form-group">
		<label for="name" class="fieldlabel">Size<font color="red">*</font></label>
		<input type="text" name="hwidth" id="hwidth" class="smalltextbox" value="<?php if(isset($banner[0]->width)){echo $banner[0]->width;}?>">&nbsp;&nbsp;Width<font color="red">*</font>
		<input type="text" name="hheight" id="hheight" class="smalltextbox" value="<?php if(isset($banner[0]->height)){echo $banner[0]->height;}?>">&nbsp;&nbsp;Height<font color="red">*</font>
	</div>
</div>
<div class="col-md-7" id="creative-code-block" style="display:<?php if(isset($banner[0]->rich_media_type) && (($banner[0]->rich_media_type == 1)||($banner[0]->rich_media_type == 2) || ($banner[0]->rich_media_type == 3)|| ($banner[0]->rich_media_type == 4))){echo 'none';}else{echo 'block';}?>">
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

<div id="creative-image" style="display:<?php if(isset($banner[0]->rich_media_type) && (($banner[0]->rich_media_type == 1)||($banner[0]->rich_media_type == 2) || ($banner[0]->rich_media_type == 3)|| ($banner[0]->rich_media_type == 4))){echo 'block';}else{echo 'none';}?>">
	<div class="col-md-7" id="first-creative-image">
		<div class="form-group">
			<label for="name" class="fieldlabel">Creative Image First</label>
			<input type="file" class="formfield" name="richmediaimg1" id="richmediaimg1" style="display: inline;">
			<?php if(isset($banner[0]->filename)){ ?>
			<img width="50"  height="50" src="<?php echo base_url();?>../delivery/banners/images/<?php echo $banner[0]->filename;?>">
			<?php } ?>
			<input type="hidden"   name="creativeimage" id="creativeimage"  value="<?php if(isset($banner[0]->filename)){echo $banner[0]->filename;}?>"/>
		</div>
	</div>
	
	<div class="col-md-7" id="second-creative-image" style="display:<?php if(isset($banner[0]->rich_media_type) && (($banner[0]->rich_media_type == 1)||($banner[0]->rich_media_type == 2) || ($banner[0]->rich_media_type == 3))){echo 'block';}else{echo 'none';}?>">
		<div class="form-group">
			<label for="name" class="fieldlabel">Creative Image Second</label>
			<input type="file" class="formfield" name="richmediaimg2" id="richmediaimg2" style="display: inline;">
			<?php if(isset($banner[0]->filename)){ ?>

			<img width="50"  height="50" src="<?php echo base_url();?>../delivery/banners/images/<?php echo $banner[0]->filename2;?>">
			<?php } ?>
			<input type="hidden"   name="creativeimage2" id="creativeimage2"  value="<?php if(isset($banner[0]->filename2)){echo $banner[0]->filename2;}?>"/>
		</div>
	</div>
	
	
</div>
<script>
function checkType(){
	
	var x = document.getElementById("rich_media_type").value;
	//alert(x);
	if(x == 1  || x == 2 || x==3){
		document.getElementById("creative-image").style.display='block';
		document.getElementById("second-creative-image").style.display='block';
		document.getElementById("creative-code-block").style.display='none';
	}else{
		document.getElementById("creative-image").style.display='none';
		document.getElementById("creative-code-block").style.display='block';
	}
	
	if(x == 4){
		document.getElementById("creative-image").style.display='block';
		document.getElementById("first-creative-image").style.display='block';
		document.getElementById("creative-code-block").style.display='none';

	}
	
	
}
</script>