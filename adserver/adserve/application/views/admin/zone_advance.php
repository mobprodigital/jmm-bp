<style>
hr {
    margin-bottom: 9px;
}

.nowarp {
    white-space: nowrap;
}

.font-weight-500 {
    font-weight: 500;
}
</style>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <section class="box-header with-border">
                        <img style="float: left;" src="<?php echo base_url()?>assets/upimages/icon-zones-large.png" />
                        <h3 style="padding-left: 10px;margin-top:12px;">Zone for cricmagic.com</h3>
                    </section>

                    <form method="post" name="addbanner" id="addbanner">
                        <div class="box-body">
                            <?php $this->load->view("admin_includes/zoneheader");?>
                            <?php if(isset($msg)){?>
                            <p id="msg2" style="color:green"><?php echo $msg;?></p>
                            <?php }?>
                            <div class="col-md-12">
                                <h2 class="formfieldheading">Chain settings</h2>
                                <img width="100%" style="height:1px;margin-bottom:20px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">If no banners from this zone can be delivered, try to... </label>
                                    <br>
                                    <label class="cursor-pointer font-weight-500"> <input type="radio" value="1"
                                            name="delivery" id="">
                                        &nbsp;Stop
                                        delivery and
                                        don't show a banner</label><br>
                                    <label class="cursor-pointer font-weight-500"><input type="radio" value="2"
                                            name="delivery" id="delivery-t">&nbsp;Display
                                        the selected
                                        zone instead</label><br>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Limit zone views to</label>
                                    <div class="flex">
                                        <input type="text" class="form-control" name="target_value" id="target_value"
                                            placeholder="0" />&nbsp;&nbsp;
                                        <div class="nowarp">in total</div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Limit zone views to</label>
                                    <div class="flex">
                                        <input type="text" class="form-control" name="target_value" id="target_value"
                                            placeholder="0" />&nbsp;&nbsp;
                                        <div class="nowarp">per session</div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="name" class="">Reset view counters after: </label>
                                    <input placeholder="Hours" type="text" class="form-control" name="target_value"
                                        id="target_value" placeholder="-" />
                                    <br>
                                    <input placeholder="mintues" type="text" class="form-control" name="target_value"
                                        id="target_value" placeholder="-" />
                                    <br>
                                    <input placeholder="seconds" type="text" class="form-control" name="target_value"
                                        id="target_value" placeholder="-" />
                                </div>
                                <div class="form-group">
                                    <label for="name" class="display-block">Cookies</label>
                                    <label class="font-weight-500">
                                        <input type="checkbox" value="1" name="delivery" class="" id="">&nbsp;Show
                                        capped ads if
                                        cookies are disabled</label><br>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h2 class="formfieldheading">Append and prepend settings</h2>
                                <img width="100%" style="height:1px;margin-bottom:20px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-500"><input type="checkbox" value="1" name="delivery"
                                            id="">&nbsp;&nbsp;&nbsp;Prepend/Append even if
                                        no banner delivered</label><br>
                                </div>

                                <div class="form-group">
                                    <label class="">Always prepend the following HTML code to banners
                                        displayed by this zone </label>
                                    <textarea name="comment" rows="6" id="comment" class="form-control"></textarea>
                                    <span style="color:red"></span>
                                </div>

                                <div class="form-group">
                                    <label class="">Always append the following HTML code to banners displayed
                                        by this zone </label>
                                    <textarea name="comment" rows="6" id="comment" class="form-control"></textarea>
                                    <span style="color:red"></span>
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