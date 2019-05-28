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
                        <h3 style="padding-left: 10px;margin-top:12px;"><?php echo $zoneData[0]->name;?></h3>
                    </section>

                    <form method="post" name="addbanner" id="addbanner">
                        <div class="box-body">
                            <?php $this->load->view("admin_includes/zoneheader");?>
                            <?php if(isset($this->session->userdata['zonedata'])){ ?>
                            <?php $msg	= $this->session->userdata['zonedata']['msg'];?>
                            <div class="errormessage" id="warning_change_zone_size"
                                style="display:<?php if($msg['msgType']=='warning'){ echo 'block'; }else{ echo 'none';} ?>;">
                                <img class="errormessage" src="<?php echo base_url();?>assets/upimages/warning.gif"
                                    align="absmiddle">
                                <span class="tab-s"> Notice:</span><?php echo $msg['msg']; ?>

                            </div>
                            <div class="message localMessage"
                                style="display:<?php if($msg['msgType']=='success'){ echo 'block'; }else{ echo 'none';} ?>; ">
                                <div class="panelMessage confirm">
                                    <div class="icon"></div>
                                    <p class="message_p"><b><?php echo $msg['msg']; ?></b></p>
                                    <div class="topleft"></div>
                                    <div class="topright"></div>
                                    <div class="bottomleft"></div>
                                    <div class="bottomright"></div>
                                    <div class="close">x</div>
                                </div>
                            </div>
                            <?php $this->session->unset_userdata('zonedata');?>
                            <?php //	 echo '<pre>';print_r($this->session->userdata());die;?>

                            <?php }?>
                            <div class="col-md-12">
                                <h2 class="formfieldheading">Please choose what to link to this zone</h2>
                                <img width="100%" style="height:1px;margin-bottom:20px;"
                                    src="<?php echo base_url()?>/assets/upimages/break.gif">
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="view" id="view" class="form-control">
                                        <option value="ad">Link individual banners</option>
                                        <!--<option selected="" value="placement">Link banners by parent campaign</option>
										<option value='category'>Link banners by category</option>
										-->
                                    </select>
                                </div>
                            </div>
                    </form>
                    <div class="col-md-12">
                        <img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="">
                            Select the campaign you would like to link to this zone</br>
                            <img align="absmiddle" src="<?php echo base_url()?>/assets/upimages/icon-advertiser.gif">
                            <input type="hidden" name="affiliateid" class="form-control"
                                value="<?php if(isset($_GET['affiliateid'])){echo $_GET['affiliateid'];} ?>">
                            <input type="hidden" name="zoneid" class="form-control"
                                value="<?php if(isset($_GET['zoneid'])){ echo $_GET['zoneid'];}?>">
                            <select tabindex="1" name="clientid" id="clientid" class="form-control">

                                <!--<?php if(isset($clientszone[0]->clientid)){ ?>
										<option  value="<?php echo $clientszone[0]->clientid;?>"><?php echo $clientszone[0]->clientname;?></option>
										<?php } ?>
										-->
                                <?php if(!(isset($_GET['clientid']))){ ?>
                                <option>-- Select Advertiser --</option>
                                <?php } ?>

                                <?php if(!empty($advertiser)){ ?>
                                <?php foreach($advertiser as $key => $value){ ?>
                                <option value="<?php echo $value->clientid;?>"
                                    <?php if (isset($_GET['clientid']) && $_GET['clientid'] == $value->clientid) echo 'selected="selected"'; ?>>
                                    <?php echo $value->clientname;?> </option>
                                <?php }} ?>
                            </select>
                        </div>
                        <div class="form-group"
                            style="margin-top: 20px;display:<?php if(!(isset($_GET['clientid']))){ ?> none;<?php }else{?> block<?php } ?>">

                            <form name='zonetypeselection' method='get' action=''>
                                <input type="hidden" name="affiliateid"
                                    value="<?php if(isset($_GET['affiliateid'])){echo $_GET['affiliateid'];} ?>">
                                <input type="hidden" name="zoneid"
                                    value="<?php if(isset($_GET['zoneid'])){ echo $_GET['zoneid'];}?>">
                                <input type="hidden" name="clientid"
                                    value="<?php if(isset($_GET['clientid'])){ echo $_GET['clientid'];}?>">

                                <img align="absmiddle" src="<?php echo base_url()?>/assets/upimages/icon-campaign.gif">
                                <select tabindex="1" name="campaignid" id="campaignid">
                                    <!--<?php if(isset($campaignzone[0]->campaignid)){ ?>
											<option  value="<?php echo $campaignzone[0]->clientid;?>"><?php echo $campaignzone[0]->campaignname;?></option>
										<?php } ?>
										-->

                                    <?php if (!(isset($_GET['campaignid']))){ ?>
                                    <option value="">-- Select Campaign --</option>
                                    <?php } ?>

                                    <?php foreach($campaign as $key => $value){?>
                                    <option value="<?php echo $value->campaignid;?>"
                                        <?php if (isset($_GET['campaignid']) && $_GET['campaignid'] == $value->campaignid) echo 'selected="selected"'; ?>>
                                        <?php echo $value->campaignname;?> </option>
                                    <?php } ?>
                                </select>
                                <!--
									<input id="link_submit" name="submitimage" type="image" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif" border="0" tabindex="2">									
									-->
                            </form>

                        </div>


                        <div class="form-group"
                            style="margin-top: 20px;display:<?php if(!(isset($_GET['campaignid']))){ ?> none;<?php }else{?> block<?php } ?>">
                            <form name='zonetypeselection' method='get' action=''>
                                <input type="hidden" name="affiliateid"
                                    value="<?php if(isset($_GET['affiliateid'])){echo $_GET['affiliateid'];} ?>">
                                <input type="hidden" name="zoneid"
                                    value="<?php if(isset($_GET['zoneid'])){ echo $_GET['zoneid'];}?>">
                                <input type="hidden" name="clientid"
                                    value="<?php if(isset($_GET['clientid'])){ echo $_GET['clientid'];}?>">
                                <input type="hidden" name="campaignid"
                                    value="<?php if(isset($_GET['campaignid'])){ echo $_GET['campaignid'];}?>">

                                <img align="absmiddle"
                                    src="<?php echo base_url()?>/assets/upimages/icon-banner-stored.gif">
                                <select tabindex="1" name="bannerid" id="bannerid">

                                    <?php if (!(isset($banner))){ ?>
                                    <option value="">-- Select Banner --</option>
                                    <?php } ?>

                                    <?php foreach($banner as $key => $value){?>
                                    <option value="<?php echo $value->bannerid;?>"><?php echo $value->description;?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <input id="link_submit" name="submitimage" type="image"
                                    src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif" border="0"
                                    tabindex="2">
                            </form>
                        </div>


                    </div>

                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="60%">Name</th>
                                <th width="20%">ID</th>
                                <th width="15%">Invocation Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($linkedBanner)){ ?>
                            <?php foreach($linkedBanner as $key => $value){ ?>
                            <tr>
                                <td><img
                                        src="<?php echo base_url();?>/assets/upimages/<?php if($value->storagetype=='html'){echo 'icon-banner-html.png';}else{?>icon-banner.png<?php } ?>">
                                    <a
                                        href="<?php echo base_url();?>users/banner?bannerid=<?php echo $value->bannerid;?>&campaignid=<?php echo $value->campaignid;?>&clientid=<?php echo $value->clientid;?>"><?php echo $value->description;?></a>
                                </td>
                                <td><?php echo $value->bannerid;?></td>
                                <td><a
                                        href="<?php echo base_url();?>users/invocation?bannerid=<?php echo $value->bannerid;?>&campaignid=<?php echo $value->campaignid;?>&clientid=<?php echo $value->clientid;?>">
                                        <div class="btn bg-green btn-xs">Invocation Code</div>
                                    </a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <?php }else{ ?>
                        <tr>
                            <th></th>
                            <th>There are currently no trackers available which can be linked to this campaign</th>
                            <th></th>
                        </tr>
                        <?php } ?>
                    </table>

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
<script>
$("#clientid").change(function() {
    var clientid = $(this).val();
    window.location.href = siteurl +
        "users/zone_include?affiliateid=<?php echo $_GET['affiliateid'];?>&zoneid=<?php echo $_GET['zoneid'];?>&clientid=" +
        clientid;
});
</script>
<script>
$("#campaignid").change(function() {
    var campaignid = $(this).val();
    window.location.href = siteurl +
        "users/zone_include?affiliateid=<?php echo $_GET['affiliateid'];?>&zoneid=<?php echo $_GET['zoneid'];?>&clientid=<?php if(isset($_GET['clientid'])){echo $_GET['clientid'];}?>&campaignid=" +
        campaignid;

});
</script>