<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <img src="<?php echo base_url()?>assets/upimages/icon-website-add-large.png"
                            class="header-image" />
                        <h3 class="header"><span style="color:#333333;">Add new website</span></h3>
                    </div>
										
                    <form method="post" name="addwebsite" id="addwebsite">
                        <div class="box-body">
                            <div class="message localMessage"
                                style="display:<?php if(isset($msg)){echo 'block';}else{echo 'none';}?>">
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
                                <img width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="name" class="fieldlabel">Website URL<font style="color:#F44336;">*
                                        </font></label>
                                    <input type="text" class="formfield" name="website" id="website"
                                        value="<?php if(isset($affiliates[0]->website)){echo $affiliates[0]->website;}else{echo 'http://';}?>" />
                                    <span style="color:red" id="span_website" class="errorspan"></span>

                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="name" class="fieldlabel">Name<font style="color:#F44336;">*</font>
                                    </label>
                                    <input type="text" class="formfield" name="name" id="name"
                                        value="<?php if(isset($affiliates[0]->name)){echo $affiliates[0]->name;}?>" />
                                    <span style="color:red" id="span_name" class="errorspan"></span>

                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="contact" class="fieldlabel">Phone<font style="color:#F44336;">*</font>
                                    </label>
                                    <input type="text" class="formfield" name="contact" id="contact"
                                        value="<?php if(isset($affiliates[0]->contact)){echo $affiliates[0]->contact;}?>" />
                                    <span style="color:red" id="span_contact" class="errorspan"></span>

                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="email" class="fieldlabel">Email<font style="color:#F44336;">*</font>
                                    </label>
                                    <input type="text" class="formfield" name="email" id="email"
                                        value="<?php if(isset($affiliates[0]->email)){echo $affiliates[0]->email;}?>" />
                                    <span style="color:red" id="span_email" class="errorspan"></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input class="btn btn-primary" name="submit" id="submit" type="submit" value="Submit">
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