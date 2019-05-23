<div class="content-wrapper">
    <section class="content-header">
        <label> <input class="form-control" style="width:295px;" placeholder="Search"></label><small
            class="btn btn-large btn-primary"
            style=" float:right;"><?php echo anchor('users/banner','Add new banner');?></small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <img src="<?php echo base_url()?>assets/upimages/icon-websites-large.png"
                            style="float:left" /><span>Notification Listing</span>

                    </div>
                    <div class="box-body">
                        <div>
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr class="header-row" class="center-align">
                                        <th>Sr.No</th>
                                        <th>Campaign Name</th>
                                        <th>Status</th>
                                        <th>Total-Impressions</th>
                                        <th>Delivered-Impressions</th>
                                        <th>Delivery %</th>
                                        <th>Activate Date</th>
                                        <th>Expiry Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($my_array as $CampData){?>
                                    <tr style="background-color:#ffffff;">
                                        <td><?php echo $i;?></td>
                                        <td><a
                                                href="<?php echo base_url();?>users/compaign?clientid=<?php echo $CampData['clientId'];?>&campaignid=<?php echo $CampData['campaignId'];?>"><?php echo $CampData['campaignname'];?></a>
                                        </td>

                                        <td>
                                            <?php if($CampData['type'] == 'under_delivered')
										{ ?>
                                            <div style="width: 97%;" class="btn bg-green btn-xs">Under Delivered</div>
                                            <?php } elseif($CampData['type'] == 'active') { ?>
                                            <div style="width: 97%;" class="btn bg-purple btn-xs">Activated</div>
                                            <?php } elseif($CampData['type'] == 'expired') { ?>
                                            <div style="width: 97%;" class="btn bg-maroon btn-xs">Expired</div>
                                            <?php }  elseif($CampData['type'] == 'upcoming') {  ?>
                                            <div style="width: 97%;" class="btn bg-orange btn-xs">Upcoming</div>
                                            <?php } elseif($CampData['type'] == 'pause') { ?>
                                            <div style="width: 97%;" class="btn bg-blue btn-xs">Paused</div>
                                            <?php } ?>
                                        </td>

                                        <!-- <td><div><?php echo $CampData['views'];?></div></td> -->
                                        <td>
                                            <div>
                                                <?php if(!empty($CampData['views']) && ($CampData['views'] != '-1')) { echo $CampData['views']; } elseif(!empty($CampData['views']) && ($CampData['views'] == '-1')) { echo "Unlimiited"; } else { echo "0";} ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php if(!empty($CampData['impressions'])) { echo $CampData['impressions']; } else { echo "0";} ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div><?php echo $CampData['per'];?></div>
                                        </td>
                                        <td><?php echo $CampData['activate_time'];?></td>
                                        <td><?php echo $CampData['expire_time'];?></td>



                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<script src="<?php echo base_url();?>assets/js/adserver.js"></script>