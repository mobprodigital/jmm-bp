<div class="col-md-7">
	<div class="form-group">
		<label for="name" class="fieldlabel">Create Ad</label>
		<input type="radio"  style="margin-left: 46px;" class="video-chk" name="upload_video"  value="create_video" id="create_video"
		<?php if(isset($banner[0]->ext_bannertype) && $banner[0]->ext_bannertype =='create_video'){echo 'checked';}?>/>
	</div>
</div>
<div class="col-md-7">
	<div class="form-group">
		<label for="name" class="fieldlabel">Video Ad Tags</label>
		<input type="radio" style="margin-left: 46px;" class="video-chk"  name="upload_video" value="upload_video" id="upload_video" 
		<?php if(isset($banner[0]->ext_bannertype) && $banner[0]->ext_bannertype =='upload_video'){echo 'checked';}?>/>
	</div>
</div>
<div id="upload_video_ad" style="display:<?php if(isset($banner[0]->bannerid)&&
$banner[0]->ext_bannertype =='upload_video'){
	echo 'block';
}else{
	echo'none';
}
?>" class="video-banner">
	<div class="col-md-7">
		<div class="form-group" style="float:left;">
			<img align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-generatecode.gif">
			<label class="fieldlabel"><b>InvocationTag</b></label>
		</div>
		<div>
			<textarea id="tag" name="tag" class="code-gray" rows="10" cols="80" style="margin-left:120px;width:75%; border: 1px solid black"><?php if(isset($videos[0]->vast_tag) && $banner[0]->ext_bannertype =='upload_video'){echo $videos[0]->vast_tag;}?></textarea>
		</div>
		<div style="clear:both"></div>
	</div>
</div>
<div id="create_video_ad" style="display:<?php if(isset($banner[0]->bannerid)&&
$banner[0]->ext_bannertype =='create_video'){
	echo 'block';
}else{
	echo'none';
}
?>"" class="video-banner">

	<div class="col-md-7">
	<h2 class="formfieldheading">Create Video Ad</h2>
	<img width="100%" style="height:1px;margin-bottom:20px;" src="<?php echo base_url()?>assets/upimages/break.gif"/>

		<div class="form-group">
			<label for="vast_video_type" class="fieldlabel">Video type</label>
			<select name="vast_video_type" id="vast_video_type" class="formfield" style="width: 18%;">
				<option value="mp4">MP4</option>
				<option value="flv">FLV</option>
				<option value="webm">WEBM</option>
			</select>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for = "name" class="fieldlabel">Upload Video<font color="red">*</font></label>
			<input type="file"   name="video_upload" id="video_upload"  style="display:inline;margin-left:40px;"/>
			<?php if(isset($banner[0]->filename)){ ?>
				<span><?php echo $banner[0]->filename;?></span>
			<?php } ?>
			<input type="hidden"   name="videofilename" id="videofilename"  value="<?php if(isset($banner[0]->filename)){echo $banner[0]->filename;}?>"/>

		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Mute in Ad</label>
			<input type="checkbox"  class="camp-chk" name="mute" id="mute" <?php if(isset($videos[0]->mute) && $videos[0]->mute =='1'){echo 'checked';}?>/>&nbsp;&nbsp;&nbsp;&nbsp;Select if required
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Skip in Ad</label>
			<input type="checkbox" 	class="camp-chk" 	 name="skip" id="skip" <?php if(isset($videos[0]->skip) && $videos[0]->skip=='1'){echo 'checked';}?>/>&nbsp;&nbsp;&nbsp;&nbsp;Select if required
		</div>
	</div>
	
	<div class="col-md-7" id="skip_time" style="display:<?php if(isset($videos[0]->skip_time) && $videos[0]->skip_time !='0'){echo 'block';}else{echo 'none';}?>">
		<div class="form-group">
			<label for="name" class="fieldlabel">Skip duration</label>
			<input type="text" 	class="formfield" 	 name="skiptime" id="skiptime" value="<?php if(isset($videos[0]->skip_time) && $videos[0]->skip_time!='0'){echo $videos[0]->skip_time;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Bitrate</label>
			<input type="text" 	class="formfield" 	 name="vast_video_bitrate" id="vast_video_bitrate" value="<?php if(isset($videos[0]->vast_video_bitrate)){echo $videos[0]->vast_video_bitrate;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Video Delivery method</label>
			<select name="vast_video_delivery" id="vast_video_delivery" class="formfield" style="width: 18%;">
				
		<?php if(isset($videos[0]->vast_video_delivery)){ ?>
		<option value="<?php echo $videos[0]->vast_video_delivery;?>"><?php echo $videos[0]->vast_video_delivery;?></option>
		<?php } ?>
				<option value="Streaming">Streaming</option>
				<option value="Progressive">Progressive</option>
			</select>
		</div>
	</div>
	
	
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Width</label>
			<input type="text" 	class="formfield" 	 name="vast_video_width" id="vast_video_width" value="<?php if(isset($videos[0]->vast_video_width)){echo $videos[0]->vast_video_width;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Height</label>
			<input type="text" 	class="formfield" 	 name="vast_video_height" id="vast_video_height" value="<?php if(isset($videos[0]->vast_video_height)){echo $videos[0]->vast_video_height;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="vast_video_duration" class="fieldlabel">Video Duration(in seconds)</label>
			<input type="text" 	class="formfield" 	 name="vast_video_duration" id="vast_video_duration" value="<?php if(isset($videos[0]->vast_video_duration)){echo $videos[0]->vast_video_duration;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Destination Url(when user click on video)</label>
			<input type="text" 	class="formfield" 	 name="vast_dest_url" id="vast_dest_url" value="<?php if(isset($banner[0]->url)){echo $banner[0]->url;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Select video content</label>
			<select name="content_video" id="content_video" class="formfield">
				<?php if(isset($videos[0]->content_video) && $videos[0]->content_video !=0){ ?>
				<option value="<?php echo $videos[0]->content_video;?>"><?php echo $videotitle;?></option>
				<?php } ?>

				<option value="0">--select content video--</option>
				
				
				<?php foreach($contentVideo as $key => $value){ ?>
				<option value="<?php echo $value->id;?>"><?php echo $value->title;?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	
	<div class="col-md-7">
	<h2 class="formfieldheading">Third Party Tracking</h2>
	<img width="100%" style="height:1px;margin-bottom:20px;" src="<?php echo base_url()?>assets/upimages/break.gif"/>

		<div class="form-group">
			<label for="name" class="fieldlabel">Impression Pixel</label>
			<input type="text"  class="formfield" name="impression_pixel" id="impression_pixel" value="<?php if(isset($videos[0]->impression_pixel)){echo str_replace('"',"'",$videos[0]->impression_pixel);}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Click Pixel</label>
			<input type="text"  class="formfield" name="click_tracking_url" id="click_tracking_url" value="<?php if(isset($videos[0]->third_party_click)){echo $videos[0]->third_party_click;}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">Start Pixel</label>
			<input type="text"  class="formfield" name="start_pixel" id="start_pixel" value="<?php if(isset($videos[0]->start_pixel)){echo str_replace('"',"'",$videos[0]->start_pixel);}?>"/>
		</div>
	</div>
	
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">25% view pixel</label>
			<input type="text"  class="formfield" name="quater_pixel" id="quater_pixel" value="<?php if(isset($videos[0]->quater_pixel)){echo str_replace('"',"'",$videos[0]->quater_pixel);}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">50% view pixel</label>
			<input type="text"  class="formfield" name="mid_pixel" id="mid_pixel" value="<?php if(isset($videos[0]->mid_pixel)){echo str_replace('"',"'",$videos[0]->mid_pixel);}?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">75% view pixel</label>
			<input type="text"  class="formfield" name="third_quater_pixel" id="third_quater_pixel" value="<?php if(isset($videos[0]->third_quater_pixel)){echo str_replace('"',"'",$videos[0]->third_quater_pixel);}?>"/>
		</div>
	</div>
	
	<div class="col-md-7">
		<div class="form-group">
			<label for="name" class="fieldlabel">100% view pixel</label>
			<input type="text"  class="formfield" name="end_pixel" id="end_pixel" value="<?php if(isset($videos[0]->end_pixel)){echo str_replace('"',"'",$videos[0]->end_pixel);}?>"/>
		</div>
	</div>
</div>
