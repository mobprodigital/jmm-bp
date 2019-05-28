<style>
hr {
    margin-bottom: 9px;
}

.font-weight-500 {
    font-weight: 500;
}

.nowarp {
    white-space: nowrap;
}
</style>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <section class="box-header with-border">
                        <img style="float: left;" src="<?php echo base_url()?>assets/upimages/icon-zones-large.png" />
                        <h3 style="padding-left: 10px;margin-top:12px;"> Zone for cricmagic.com</h3>
                    </section>

                    <form method="post" name="addbanner" id="addbanner">
                        <div class="box-body">
                            <?php $this->load->view("admin_includes/zoneheader");?>
                            <?php if(isset($msg)){?>
                            <p id="msg2" style="color:green"><?php echo $msg;?></p>
                            <?php }?>

                            <div class="col-md-12">
                                <h2 class="formfieldheading">Please choose the type of banner invocation</h2>
                                <img width="100%" style="height:1px;margin-bottom:20px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select tabindex="1" class="form-control" accesskey="l"
                                        onchange="disableTextarea();this.form.submit()" name="codetype">
                                        <option selected="" value="invocationTags:oxInvocationTags:async">Asynchronous
                                            JS Tag</option>
                                        <option value="invocationTags:oxInvocationTags:adjs">Javascript Tag</option>
                                        <option value="invocationTags:oxInvocationTags:adframe">iFrame Tag</option>
                                        <option value="invocationTags:oxInvocationTags:local">Local Mode Tag</option>
                                    </select>&nbsp;
                                </div>
                                <div class="form-group">
                                    <img align="absmiddle"
                                        src="<?php echo base_url()?>/assets/upimages/icon-generatecode.gif">
                                    <label class="fieldlabel"><b>Bannercode</b></label>

                                    <textarea name="comment" id="comment" class="form-control"
                                        style="width: 963px; height: 250px; margin: 0px 0px 0px 7px;"><?php if(isset($invocationCode)){echo $invocationCode;}?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <img align="absmiddle" src="<?php echo base_url()?>/assets/upimages/icon-overview.gif">
                                <label class="fieldlabel"><b>Tag settings</b></label>
                                <img width="100%" style="height:1px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="display-block">Don't show the banner again on the same
                                        page</label>
                                    <label for="banner-i" class="font-weight-500"> <input class="display-inline-block"
                                            type="radio" value="1" name="banner" id="banner-i"> Yes</label><br>
                                    <label for="banner-t" class="font-weight-500"> <input class="display-inline-block"
                                            type="radio" value="2" name="banner" id="banner-t"> No</label><br>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Don't show a banner from the same campaign
                                        again on the same page</label>

                                    <label for="delivery-i" class="font-weight-500"> <input type="radio" value="1"
                                            name="delivery" id="delivery-i"> Yes</label><br>
                                    <label for="delivery-t" class="font-weight-500"><input type="radio" value="2"
                                            name="delivery" id="delivery-t"> No</label><br>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Target frame</label>
                                    <select tabindex="6" name="target" class="form-control">
                                        <option value="">Default</option>
                                        <option value="_blank">New window</option>
                                        <option value="_top">Same window</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Source</label>
                                    <div class="flex">
                                        <input type="text" class="form-control" name="target_value" id="target_value"
                                            placeholder="0" />
                                        <div style="margin-top:5px" class="nowarp"> &nbsp;&nbsp; in total</div>
                                       
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Support 3rd Party Server Clicktracking</label>
                                    <select tabindex="8" class="form-control" name="thirdpartytrack">
                                        <option value="0">No</option>
                                        <option value="generic">Generic</option>
                                        <option value="adtech">Adtech</option>
                                        <option value="zedo">Zedo</option>
                                        <option value="doubleclick">Doubleclick/DFP</option>
                                        <option value="revive">OpenX/Reviveadserver</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="btn btn-success" name="submit" id="submit" type="submit"
                                        value="Submit">
                                </div>
                            </div>

                        </div>

                </div>

            </div>
            </form>
        </div>
</div>
</div>
</section>
</div>
<?php $this->load->view('admin_includes/footer');?>