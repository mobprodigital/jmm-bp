<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <img src="<?php echo base_url()?>assets/upimages/icon-banner-add-large.png"
                            class="header-image" />
                        <h3 class="header"><span
                                style="color:#333333;"><?php if(isset($banner[0]->bannerid)){ echo $banner[0]->description;}else{?>Add
                                new banner<?php } ?></span></h3>
                    </div>
                    <div class="box-body">
                        <div>
                            <div class="">
                                <div class="message localMessage"
                                    style="display:<?php if(isset($msg)){echo 'block';}else{echo 'none';}?>">
                                    <div class="panelMessage confirm">
                                        <div class="icon"></div>
                                        <p class="message_p"><b><?php if(isset($msg)){echo $msg;}?></b></p>
                                        <div class="topleft"></div>
                                        <div class="topright"></div>
                                        <div class="bottomleft"></div>
                                        <div class="bottomright"></div>
                                        <div class="close">x</div>
                                    </div>
                                </div>
                                <?php if(isset($banner[0]->bannerid)){$this->load->view('admin_includes/banner_header');}?>
                                <div class="html5-creative" style="margin-top: 10px;width:100%;height:500px;display:<?php if(isset($banner[0]->htmltemplate) && ($banner[0]->storagetype =='html5')){echo 'block';}else{echo 'none';}?>">
                                 <?php if(isset($banner[0]->htmltemplate) && ($banner[0]->storagetype =='html5')){ 
									header("X-XSS-Protection: 0");
									if(isset($banner[0]->rich_media_type) && (($banner[0]->rich_media_type == 1)||($banner[0]->rich_media_type == 2) || ($banner[0]->rich_media_type == 3)|| ($banner[0]->rich_media_type == 4))){
										$creativeCode 		= $banner[0]->htmltemplate;
										$clickurl			= $banner[0]->url;
										$creativeCode 		= str_replace("{clickurl}", "$clickurl", $creativeCode);
										$banner[0]->htmltemplate = $creativeCode;
									}
									echo $banner[0]->htmltemplate;
								}?>
                                </div>
                                <?php if(isset($banner[0]->extag) && ($banner[0]->storagetype =='exscrpt' || $banner[0]->storagetype =='exiframe')){ header("X-XSS-Protection: 0"); echo $banner[0]->extag;}?>
                                <?php $this->load->view('banner/video-player-demo');?>
                            </div>
                            <div style="clear:both;"></div>
                            <div id="total_ad_time" style="text-align:center;"></div>
                        </div>
                        <form method="post" name="addbanner" id="addbanner" enctype="multipart/form-data"
                            style="margin-top: 37px;">
                            <div class="box-body">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="name" class="fieldlabel" style="font-weight:700">Please choose type
                                            of
                                            banner</label>
                                        <select tabindex="1" name="type" id="type" class="formfield">
                                            <?php if(isset($banner[0]->contenttype)){ ?>
                                            <optgroup label="<?php echo $banner[0]->storagetype;?>">
                                                <option selected="selected"
                                                    value="<?php echo $banner[0]->storagetype;?>">
                                                    <?php  if($banner[0]->storagetype=='web'){echo 'Upload a local banner to the webserver';}elseif($banner[0]->storagetype=='html5'){echo 'HTML5 Creative';}elseif($banner[0]->storagetype=='exscrpt'){echo 'Script Tag';}else{echo 'Video Ad Banner';} ?>
                                                </option>
                                            </optgroup>
                                            <?php } ?>
                                            <optgroup label="web">
                                                <option value="web">Upload a local banner to the webserver</option>
                                            </optgroup>
                                            <optgroup label="sql">
                                                <option value="sql">Upload a local banner to the database</option>
                                            </optgroup>
                                            <optgroup label="url">
                                                <option value="url">Link an external banner</option>
                                            </optgroup>
                                            <optgroup label="html">
                                                <option value="html">Video Ad Banner</option>
                                                <option value="html5">html5 creative</option>

                                                <!--<option value="vast">Inline Video Ad(pre/mid/post-roll)</option>
											<option value="genericHtml">Generic HTML Banner</option>
											<option value="vastOverlayHtml">Overlay Video Ad</option>
											-->
                                            </optgroup>
                                            <optgroup label="text">
                                                <option value="bannerTypeText">Generic Text Banner</option>
                                            </optgroup>
                                            <optgroup label="Miscellaneous">
                                                <option value="exscrpt">Script Tag</option>
                                                <option value="exiframe">Iframe Tag</option>

                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <h2 class="formfieldheading">Basic information</h2>
                                    <img width="100%" style="height:1px;margin-bottom:20px;"
                                        src="<?php echo base_url()?>/assets/upimages/break.gif">

                                    <div class="form-group">
                                        <label for="name" class="fieldlabel">Name<font color="red">*</font></label>
                                        <input type="text" class="formfield" name="description" id="description"
                                            value="<?php if(isset($banner[0]->description)){echo $banner[0]->description;}?>" />
                                        <span style="color:red" id="span_description" class="errorspan"></span>
                                    </div>
                                </div>


                                <!--html5 banner code-->
                                <div id="html5div" style="display:<?php 
							if(isset($banner[0]->bannerid)){ 
								if($banner[0]->storagetype =='html5'){
									echo 'block';
								}else{
									echo'none';
								}
							}else{echo 'none';}?>">
                                    <?php $this->load->view('banner/html5-creative-template');?>
                                </div>


                                <!-- Recognise external tag-->
                                <div id="extagdiv" style="display:<?php 
							if(isset($banner[0]->bannerid)){ 
								if($banner[0]->storagetype =='exscrpt' || $banner[0]->storagetype =='exiframe'){
									echo 'block';
								}else{
									echo'none';
								}
							}else{echo 'none';}?>">
                                    <?php $this->load->view('banner/external-tag-template');?>

                                </div>

                                <!-- banner type image -->
                                <div id="imagebanner" class="bannertype" style="display:<?php 
							if(isset($banner[0]->bannerid)){ 
								if($banner[0]->storagetype =='web'){
									echo 'block';
								}else{
									echo'none';
								}
							}else{echo 'block';}?>" />

                                <?php $this->load->view('banner/standerd-banner-template');?>


                            </div>




                            <!-- ad type video banner -->
                            <div id="videoadbanner" style="display:<?php if(isset($banner[0]->bannerid)&&
								$banner[0]->storagetype =='html'){
									echo 'block';
								}else{
									echo'none';
								}
								?>" class="bannertype">
                                <?php $this->load->view('banner/video-ad-template');?>


                            </div>

                            <div class="col-md-7">
                                <h2 class="formfieldheading">Additional data</h2>
                                <img width="100%" style="height:1px;margin-bottom:20px;"
                                    src="<?php echo base_url()?>assets/upimages/break.gif" />
                                <div class="form-group">
                                    <label class="fieldlabel">Keywords</label>
                                    <input type="text" class="formfield" name="keyword" id="keyword"
                                        value="<?php if(isset($banner[0]->keyword)){echo $banner[0]->keyword;}?>" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="name" class="fieldlabel">Weight</label>
                                    <input type="text" class="formfield" name="weight" id="weight"
                                        value="<?php if(isset($banner[0]->weight)){echo $banner[0]->weight;}else{echo '1';}?>" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="name" class="fieldlabel">Comments</label>
                                    <textarea style="width:483px;height:144px;" class="textarea-field" name="comments"
                                        id="comments"><?php if(isset($banner[0]->comments)){echo $banner[0]->comments;}?></textarea>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="box-footer" style="text-align:center">
                    <input class="btn btn-primary" name="submit" id="submit" type="submit" value="Submit">
                </div>
            </div>
        </div>
        <?php if(isset($_GET['bannerid'])){ ?>
        <input type="hidden" id="bannerid" value="<?php echo $_GET['bannerid'];?>">
        <input type="hidden" id="campaignid" value="<?php echo $_GET['campaignid'];?>">
        <input type="hidden" id="clientid" value="<?php echo $_GET['clientid'];?>">
        <?php } ?>

        </form>
</div>
</div>
</div>
</div>
</section>
</div>

<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
	<script src="<?php echo base_url();?>assets/common/user-app.js"></script> 
-->
<?php $this->load->view('admin_includes/footer');?>