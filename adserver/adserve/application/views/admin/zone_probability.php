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

                            <div class="col-md-7">
                                <strong>There are no active banners linked to this zone.</strong>
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
<?php $this->load->view('admin_includes/footer');?>