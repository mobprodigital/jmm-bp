<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/home.css">
<?php 
//print_r($this->session->userdata('notification_array')); 
if(isset($_GET['pglmt'])){
$limt_value = $_GET['pglmt'];}else{$limt_value = "";} ?>


<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <img
                            src="<?php echo base_url()?>assets/upimages/icon-advertisers-large.png" /><span>Advertiser</span>
                        <a href="#" id="delete-advertiser"><img src="<?php echo base_url()?>assets/img/1011.png"
                                style="margin-left:54px;margin-right: 10px;" />Delete</a>
                    </div>


                    <div class="box-body">
                        <!---------------------------- Filter Section Starts ---------------------------------------------------------------->
                        <?php if(isset($new)) 
				                 	{ 	$sortBy = $new['sortBy']; } 
			                         		?>
                        <section class="text-right">
                            <label><input name="clients" id="clients" class="search form-control" style="width:295px;"
                                    placeholder="Search"
                                    value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
                            <input type="submit" class="btn btn-success" name="submit" id="submit" value="search">
                            <div class="dropdown-content">
                            </div>
                            <small class="btn btn-large btn-primary"
                                style="display:none; float:right;"><?php echo anchor('admin/users/advertisement','Add new advertiser');?></small>
                        </section>
                        <div class="row ">
                            <div class="col-md-2 form-group" style="margin-left: 914px;">
                                <select class="view-banner-filter" name="sort_type" id="sort_type">
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
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="header-row">
                                        <th width="2%"><input type="checkbox" class="advertiser" id="main_0"
                                                value="adchk"></th>
                                        <th width="30%">Name</th>
                                        <th width="30%">Time</th>
                                        <th width="38%" class="center-align">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($advertiser[0])){ ?>
                                    <?php foreach($advertiser as $key => $value){ ?>
                                    <tr
                                        style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
                                        <td width="2%"><input type="checkbox" class="advertiser"
                                                id="<?php echo $value->clientid;?>"></td>
                                        <td><img
                                                src="<?php echo base_url();?>/assets/upimages/icon-advertiser.png">&nbsp;&nbsp;<a
                                                href="<?php echo base_url();?>users/advertisement?id=<?php echo $value->clientid;?>"><?php echo $value->clientname;?></a>
                                        </td>
                                        <td><?php echo $value->updated;?></td>
                                        <td style="float:right;">
                                            <a
                                                href="<?php echo base_url();?>users/compaign?clientid=<?php echo $value->clientid;?>">&nbsp;&nbsp;&nbsp;<img
                                                    src="<?php echo base_url();?>assets/upimages/icon-campaign-add.png"
                                                    style="padding-right: 5px;" />
                                                <div class="btn bg-blue btn-xs">add new compaign</div>
                                            </a>
                                            <a
                                                href="<?php echo base_url();?>users/viewcompaign?clientid=<?php echo $value->clientid;?>">&nbsp;&nbsp;&nbsp;<img
                                                    src="<?php echo base_url();?>assets/upimages/icon-campaigns.png"
                                                    style="padding-right: 5px;" />
                                                <div class="btn bg-purple btn-xs">compaign</div>
                                            </a>

                                        </td>
                                    </tr>
                                    <?php }}else{?>
                                    <tr>

                                        <td class="center-align"><b>No Advertiser Exist</b></td>
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
                            <input type="hidden" name="curr-client" id="curr-client" value="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade in" id="tag_video" tabindex="-1" role="alert" aria-hidden="false" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo base_url();?>assets/img/101.png" class="close" data-dismiss="modal"
                    aria-hidden="true">
                <h4 class="modal-title">Select users for sharing this clients report</h4>
                <p class="success-msg" style="padding-top: 10px;color: green;"></p>
            </div>
            <div class="modal-body">
                <?php if(!empty($users)){ ?>
                <?php foreach($users as $key => $user){ ?>
                <input type="checkbox" class="users" name="device[]"
                    value="<?php echo $user->id;?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user->username;?><br><br>

                <?php }} ?>

            </div>
            <div class="modal-footer">
                <a class="btn bg-green " href="#" id="access">Add Users</a>
            </div>

        </div>

    </div>

</div>

<?php $this->load->view('admin_includes/footer');?>
<script type="text/javascript">
function pageLimits(limit_value) {
    window.location = '<?php echo base_url(); ?>users/viewadvertiser?pglmt=' + limit_value;


};
</script>