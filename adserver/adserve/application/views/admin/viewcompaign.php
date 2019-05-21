<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/home.css">
<?php 
if(isset($_GET['pglmt'])){
$limt_value = $_GET['pglmt'];}else{$limt_value = "";} ?>
<div class="content-wrapper">
    <section class="content-header">
        <label><input name="campaigns" id="campaigns" class="search form-control" style="width:295px;"
                placeholder="Search" value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
        <input type="submit" class="btn btn-primary" name="submit" id="submit" value="search">
        <div class="dropdown-content">
        </div>
        </label><small class="btn btn-large btn-primary"
            style=" float:right;"><?php echo anchor('users/compaign','Add new campaign');?></small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <img src="<?php echo base_url()?>assets/upimages/icon-campaign-large.png" /><span>Campaings
                            <?php if(!(empty($campaign))){echo 'of '.$campaign[0]->clientname;}?></span>
                        <a href="#" id="delete-campaign"><img src="<?php echo base_url()?>assets/img/1011.png"
                                style="margin-left:54px;margin-right: 10px;" />Delete</a>
                        <input type="hidden" name="campaign_ids" id="campaign_ids" value="">
                    </div>
                    <!-- <?php if(isset($advertiserlist)){?>

					<select  name="advertiserlist" id="advertiserlist"  class="right-corner-select"/>
						<option value="">--select advertiser--</option>
						<?php foreach($advertiserlist as $key => $value){?>
						<option value="<?php echo $value->clientid;?>" <?php if(isset($_GET['clientid']) && $_GET['clientid']==$value->clientid){echo 'selected';} ?>><?php echo $value->clientname;?></option>
						<?php } ?>
					</select>

					<?php } ?> -->
                    <div class="box-body">
                        <!---------------------------- Filter Section Starts ---------------------------------------------------------------->
                        <?php if(isset($new)) 
					{ 	$sortBy = $new['sortBy']; $AdvId = $new['AdvId']; } 
					?>
                        <form action="<?php echo base_url()?>users/viewcompaign" method="post" name="filter_form"
                            id="filter_form" autocomplete="off">
                            <div class="row ">
                                <div class="col-md-2 form-group">
                                    <select class="view-banner-filter" name="campaign_sort_type" id="campaign_sort_type"
                                        style="margin-left: 625px;">
                                        <option value="name"
                                            <?php if(isset($sortBy) && $sortBy=='name'){echo 'selected';} ?>>Name
                                        </option>
                                        <option value="date"
                                            <?php if(isset($sortBy) && $sortBy== 'date'){echo 'selected';} ?>>Date
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <?php if(isset($advertiserlist))
								{ ?>
                                    <select name="advertiserlist" id="advertiserlist" class="view-banner-filter"
                                        style="width:190px;margin-left: 612px;" />
                                    <option value="">- - - - - - FILTER - - - - - -</option>
                                    <?php foreach($advertiserlist as $key => $value){?>
                                    <option value="<?php echo $value->clientid;?>"
                                        <?php if(isset($AdvId) && $AdvId==$value->clientid){echo 'selected';} ?>>
                                        <?php echo $value->clientname;?></option>
                                    <?php } ?>
                                    </select>
                                    <?php } ?>
                                </div>
                                <div class="col-md-2 form-group">
                                    <input class="btn btn-sm btn-info" type="submit" value="Submit" name="submit"
                                        id="submit" style="margin-left: 637px;">
                                </div>
                            </div>
                        </form>
                        <!---------------------------- Filter Section Ends ---------------------------------------------------------------->

                        <div>
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="header-row center-align">
                                        <th width="2%"><input type="checkbox" class="campaign" id="main_00"
                                                value="adchk"></th>
                                        <th width="20%">Name</th>
                                        <th width="20%">Date</th>
                                        <th width="10%" class="center-align">Status</th>
                                        <th width="20%" class="center-align">Action</th>
                                        <th width="20%" class="center-align">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($campaign)){  ?>
                                    <?php foreach($campaign as $key => $value){ ?>
                                    <tr
                                        style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
                                        <td width="2%"><input type="checkbox" class="campaign"
                                                id="<?php echo $value->campaignid;?>"></td>
                                        <td><img
                                                src="<?php echo base_url();?>/assets/upimages/icon-campaign-disabled.png">&nbsp;&nbsp;<a
                                                href="<?php echo base_url();?>users/compaign?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"><?php echo $value->campaignname;?></a>
                                        </td>
                                        <td><?php echo $value->activate_time;?></td>
                                        <td class="center-align">
                                            <select name="camstatus" id="campaign_<?php echo $value->campaignid;?>"
                                                class="camstatus view-banner-filter">
                                                <option value="1"
                                                    <?php if(isset($value->camp_stat) && '1'==$value->camp_stat){echo 'selected';} ?>>
                                                    Activate</option>
                                                <option value="0"
                                                    <?php if(isset($value->camp_stat) && '0'==$value->camp_stat){echo 'selected';} ?>>
                                                    Deactivate</option>
                                            </select>
                                        </td>

                                        <td class="center-align">
                                            <a
                                                href="<?php echo base_url();?>users/banner?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>">
                                                <div class="btn bg-blue btn-xs">Add new banner</div>
                                            </a>
                                            <a href="<?php echo base_url();?>users/viewbanner?clientid=<?php echo $value->clientid;?>&campaignid=<?php echo $value->campaignid;?>"
                                                style="padding: 0px 20px;">
                                                <div class="btn bg-purple btn-xs">Banners</div>
                                            </a>

                                        </td>
                                        <td>
                                            <style>
                                            .panel table td {
                                                padding-left: 5px;
                                            }

                                            .panel table th {
                                                padding-left: 32px;
                                            }
                                            </style>
                                            <div class="panel" style="font-size: 11px;">
                                                <table cellpadding=0 cellspacing=0>
                                                    <tbody>
                                                        <tr>
                                                            <th>Total Impressions Booked(per day) </th>
                                                            <td><?php echo $value->views;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Impressions Booked(per day) </th>
                                                            <td><?php echo $value->target_impression;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Clicks Booked</th>
                                                            <td><?php echo $value->target_click;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Conversions Booked</th>
                                                            <td><?php echo $value->target_conversion;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Start date</th>
                                                            <td><?php echo $value->activate_time;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>End date</th>
                                                            <td><?php echo $value->expire_time;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Priority</th>
                                                            <td><?php echo $value->priority;?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="corner top-left"></div>
                                                <div class="corner top-right"></div>
                                                <div class="corner bottom-left"></div>
                                                <div class="corner bottom-right"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php }else{ ?>
                                    <tr style="outline: thin solid #e6e6e6;">
                                        <td class="center-align"><b>No campaigns available</b></td>
                                        <td class="center-align"></td>
                                        <td></td>
                                        <td></td>


                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                <?php echo $this->pagination->create_links(); ?>


                                <select id="page_limit" onChange="pageLimits(this.value);" class="page-limit">
                                    <option value="10" <?php if($limt_value == '10'): ?> selected="selected"
                                        <?php endif; ?>>10</option>
                                    <option value="20" <?php if($limt_value == '20'): ?> selected="selected"
                                        <?php endif; ?>>20</option>
                                    <option value="30" <?php if($limt_value == '30'): ?> selected="selected"
                                        <?php endif; ?>>30</option>
                                </select>
                            </div>
                            <!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
								<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
							-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<script type="text/javascript">
function pageLimits(limit_value) {
    window.location = '<?php echo base_url(); ?>users/viewcompaign?pglmt=' + limit_value;


};
</script>