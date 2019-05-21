<?php $this->load->view('advertiser/header');?>
<?php $this->load->view('advertiser/leftsidebar');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/home.css">
<?php
if(isset($_GET['pglmt'])){
$limt_value = $_GET['pglmt'];}else{$limt_value = "";} ?>

<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <img
                            src="<?php echo base_url()?>assets/upimages/icon-advertisers-large.png" /><span>Advertiser</span>
                        <a href="#" id="delete-adv"><img src="<?php echo base_url()?>assets/img/1011.png"
                                style="margin-left:54px;margin-right: 10px;" />Delete</a>
                    </div>
                    <div class="box-body">

                        <section class="text-right" style="display:none">
                            <label><input name="clients" id="clients" class="search form-control" style="width:295px;"
                                    placeholder="Search"
                                    value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
                            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="search">
                            <div class="dropdown-content">
                            </div>
                            <small class="btn btn-large btn-primary"
                                style=" float:right;"><?php echo anchor('admin/users/advertisement','Add new advertiser');?></small>
                        </section>
                        <!---------------------------- Filter Section Starts ---------------------------------------------------------------->
                        <?php if(isset($new)) 
										{ 	$sortBy = $new['sortBy']; } 
										?>
                        <div class="row ">
                            <div class="col-md-2 form-group" style="margin-left: 914px;">
                                <select class="view-banner-filter" name="sort_type" id="adv_sort_type">
                                    <option value="">
                                        - - - - Filter - - - -
                                    </option>
                                    <option value="name"
                                        <?php if(isset($sortBy) && $sortBy=='name'){echo 'selected';} ?>>Name
                                    </option>
                                    <option value="date"
                                        <?php if(isset($sortBy) && $sortBy== 'date'){echo 'selected';} ?>>Date
                                    </option>
                                </select>
                            </div>
                        </div>




                        <!---------------------------- Filter Section Ends ---------------------------------------------------------------->





                        <div>
                            <?php if(isset($advertiser[0])){ ?>

                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="header-row">
                                        <th width="2%"><input type="checkbox" class="advertiser" id="main_0"
                                                value="adchk"></th>
                                        <th width="60%">Name</th>
                                        <th width="40%" class="center-align">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($advertiser as $key => $value){ ?>
                                    <tr
                                        style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
                                        <td width="2%"><input type="checkbox" class="advertiser"
                                                id="<?php echo $value->clientid;?>"></td>
                                        <td>
                                            <img
                                                src="<?php echo base_url();?>/assets/upimages/icon-advertiser.png">&nbsp;&nbsp;<a
                                                href="<?php echo base_url();?>advertiser/advertisement?id=<?php echo $value->clientid;?>">
                                                <?php echo $value->clientname;?></a></td>
                                        <td style="float:right;">
                                            <a
                                                href="<?php echo base_url();?>advertiser/compaign?clientid=<?php echo $value->clientid;?>">&nbsp;&nbsp;&nbsp;<img
                                                    src="<?php echo base_url();?>assets/upimages/icon-campaign-add.png"
                                                    style="padding-right: 5px;" />
                                                <div class="btn bg-blue btn-xs">Add new campaign</div>
                                            </a>
                                            <a
                                                href="<?php echo base_url();?>advertiser/viewcompaign?clientid=<?php echo $value->clientid;?>">&nbsp;&nbsp;&nbsp;<img
                                                    src="<?php echo base_url();?>assets/upimages/icon-campaigns.png"
                                                    style="padding-right: 5px;" />
                                                <div class="btn bg-purple btn-xs">Campaigns</div>
                                            </a>
                                            <!--<a href="#" data-toggle="modal" class="clientlist" data-target="#tag_video"  id="<?php echo $value->clientid;?>">&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>/assets/upimages/icon-advertiser.png" style="padding-right: 5px;"><div  class="btn bg-green btn-xs">Share report</div></a>
											-->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                <?php echo $this->pagination->create_links(); ?>
                                <select id="page_limit" onChange="pageLimits(this.value);" class="page-limit">
                                    <option value="25" <?php if($limt_value == '25'): ?> selected="selected"
                                        <?php endif; ?>>25</option>
                                    <option value="All" <?php if($limt_value == 'All'): ?> selected="selected"
                                        <?php endif; ?>>All</option>
                                    <!-- <option value="30"<?php if($limt_value == '30'): ?> selected="selected"<?php endif; ?>>30</option> -->
                                </select>
                                <!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
								<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
							-->
                            </div>
                            <?php }else{ ?>
                            <div class="errormessage" style="margin-top: 2em"><img class="errormessage"
                                    src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16"
                                    border="0" align="absmiddle">No Advertiser Exist</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- modal popup showing share user -->
    <!--<div class="modal fade in" id="tag_video" tabindex="-1" role="alert" aria-hidden="false" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		  <img src="<?php echo base_url();?>assets/img/101.png" class="close" data-dismiss="modal" aria-hidden="true">
          <h4 class="modal-title">Select users for sharing this clients report</h4>
		  <p class="success-msg" style="padding-top: 10px;color: green;"></p>
        </div>
        <div class="modal-body">
			<?php if(!empty($users)){ ?>
			<?php foreach($users as $key => $user){ ?>
			<input type="checkbox" class="users" name="device[]" value="<?php echo $user->id;?>" >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user->username;?><br><br>
			
			<?php }} ?>

		</div>
        <div class="modal-footer">
          <a class="btn bg-green " href="#" id="access">Add Users</a>
		</div>
		
	  </div>
	  
	</div>
	</div>
	-->

</div><?php $this->load->view('admin_includes/footer');?>

<script type="text/javascript">
function pageLimits(limit_value) {
    <?php $sort_lit =  $this->uri->segment(3); ?>

    window.location = '<?php echo base_url(); ?>advertiser/viewadvertiser?pglmt=' + limit_value;


};
</script>