<div class="bannertype" id="localbanner">
    <div class="col-md-12">
        <h2 class="formfieldheading">Upload a local banner to the webserver - banner creative</h2>
        <img width="100%" style="height:1px;margin-bottom:20px;"
            src="<?php echo base_url()?>assets/upimages/break.gif" />
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="">Select the image you want to use for this banner</label>
            <input type="file" class="form-control" name="upload" id="upload" style="display: inline;">
            <?php if(isset($banner[0]->storagetype) && $banner[0]->storagetype == 'web'){ ?>
            <img width="50" height="50"
                src="<?php echo base_url();?>../delivery/banners/images/<?php echo $banner[0]->filename;?>">
            <?php } ?>
            <input type="hidden" name="imagefilename" id="imagefilename"
                value="<?php if(isset($banner[0]->filename)){echo $banner[0]->filename;}?>" />

        </div>
    </div>
</div>
<!--<div class="bannertype" id="externalbanner" style="display:<?php 
if(isset($banner[0]->bannerid)){ 
	if($banner[0]->storagetype =='web'){
		echo 'block';
	}else{
		echo'none';
	}
}else{echo 'block';}?>">
<div class="col-md-7">
	<div class="form-group">
		<label for="name" class="fieldlabel">Link an external banner</label>
		<input type="text" class="formfield"  placeholder="http://" class="formfield"  name="url" id="url" value="<?php if(isset($banner[0]->imageurl)){echo $banner[0]->imageurl;}?>"/>
	</div>
</div>
</div>-->
<div class="col-md-12">
    <h2 class="formfieldheading">Banner link</h2>
    <img width="100%" style="height:1px;margin-bottom:20px;" src="<?php echo base_url()?>assets/upimages/break.gif" />
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="">Destination Url (incl. http://) </label>
        <input type="text" placeholder="http://" class="form-control" name="url" id="url"
            value="<?php if(isset($banner[0]->url)){echo $banner[0]->url;}?>" />
    </div>

    <div class="form-group">
        <label for="name" class="">Target</label>
        <input type="text" class="form-control" name="target" id="target"
            value="<?php if(isset($banner[0]->target)){echo $banner[0]->target;}?>" />
    </div>

    <div class="form-group">
        <label for="name" class="">Tracking Pixel</label>
        <input type="text" class="form-control" name="tracking_pixel" id="tracking_pixel"
            value="<?php if(isset($banner[0]->tracking_pixel)){echo $banner[0]->tracking_pixel;}?>" />
    </div>
</div>

<div class="col-md-12">
    <h2 class="formfieldheading">Banner display</h2>
    <img width="100%" style="height:1px;margin-bottom:20px;" src="<?php echo base_url()?>assets/upimages/break.gif" />
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="">All text</label>
        <input type="text" class="form-control" name="alt" id="alt"
            value="<?php if(isset($banner[0]->alt)){echo $banner[0]->alt;}?>" />
    </div>

    <div class="form-group">
        <label for="name" class="">Status text </label>
        <input type="text" class="form-control" name="statustext" id="statustext"
            value="<?php if(isset($banner[0]->statustext)){echo $banner[0]->statustext;}?>" />
    </div>
    <div class="form-group">
        <label for="name" class="">Text below image </label>
        <input type="text" class="form-control" name="bannertext" id="bannertext"
            value="<?php if(isset($banner[0]->bannertext)){echo $banner[0]->bannertext;}?>" />
    </div>
</div>
<div class="col-md-6"
    style="display:<?php if(isset($banner[0]->storagetype) && $banner[0]->storagetype == 'web'){echo 'block';}else{echo 'none';}?>">
    <div class="form-group">
        <label for="name" class="">Size<font color="red">*</font></label>
        <input type="text" name="width" id="width" class="smalltextbox"
            value="<?php if(isset($banner[0]->width)){echo $banner[0]->width;}?>" />&nbsp;&nbsp;Width<font color="red">*
        </font>
        <input type="text" name="height" id="height" class="smalltextbox"
            value="<?php if(isset($banner[0]->height)){echo $banner[0]->height;}?>">&nbsp;&nbsp;Height<font color="red">
            *</font>
    </div>
</div>