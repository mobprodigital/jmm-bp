<div class="col-md-7">
	<div class="form-group" style="float:left;">
		<img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-generatecode.gif">
		<label class="fieldlabel"><b>Tag</b></label>
	</div>
	<div>
		<textarea id="extag" name="extag" class="code-gray" rows="10" cols="80" style="margin-left:185px;width:75%; border: 1px solid black"><?php if(isset($banner[0]->extag) && ($banner[0]->storagetype =='exscrpt' || $banner[0]->storagetype =='exiframe')){echo $banner[0]->extag;}?></textarea>
	</div>
	<div style="clear:both"></div>
</div>