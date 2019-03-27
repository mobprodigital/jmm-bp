<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/home.css">
<?php
if(isset($_GET['pglmt'])){
$limt_value = $_GET['pglmt'];}else{$limt_value = "";} ?>
<div class="content-wrapper">
   
    <section class="content-header">
		<label> <input class="form-control" style="width:295px;" placeholder="Search"></label>
		<small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/banner','Add new banner');?></small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
						<img src="<?php echo base_url()?>assets/upimages/icon-banner-large.png" /><span>Banners</span>
                        <a href="#" id="delete-banner"><img class="delete-text" src="<?php echo base_url()?>assets/img/1011.png" />Delete</a>
                    </div>
                    <div class="box-body">
                        <!---------------------------- Filter Section Starts ---------------------------------------------------------------->
						<?php if(isset($new)) 
						{ 	$sortBy = $new['sortBy']; $banner_status = $new['banner_status']; } 
						?>
						<form action="<?php echo base_url()?>users/viewbanner" method="post" name="filter_form" id="filter_form" autocomplete="off">
                            <div class="row ">
                                <div class="col-md-2 form-group">
                                    <select class="view-banner-filter" name="sort_type" id="banner_sort_type" style="margin-left: 625px;">
                                        <option value="name"
                                            <?php if(isset($sortBy) && $sortBy=='name'){echo 'selected';} ?>>Name
                                        </option>
                                        <option value="date"
                                            <?php if(isset($sortBy) && $sortBy== 'date'){echo 'selected';} ?>>Date
                                        </option>
                                    </select>
                            	</div>
								<div class="col-md-2 form-group">
									<select class="view-banner-filter" name="banner_status" id="banner_status" style="width:190px;margin-left: 612px;">
										<option value="0"
											<?php if(isset($banner_status) && $banner_status==0){echo 'selected';} ?>>
											All
											banners</option>
										<option value="1"
											<?php if(isset($banner_status) && $banner_status==1){echo 'selected';} ?>>
											Active
											banners</option>
									</select>
								</div>
								<div class="col-md-2 form-group">
									<input class="btn btn-sm btn-info" type="submit" value="Submit" name="submit" id="submit" style="margin-left: 637px;">
								</div>

                            </div>
						</form>
                        <!---------------------------- Filter Section Ends ---------------------------------------------------------------->

                        <div>
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr class="header-row" class="center-align">
                                        <th width="2%"><input type="checkbox" class="banner" id="main_0" value="adchk"></th>
                                        <th width="60%">Name</th>
                                        <th width="10%" class="center-align">Option</th>
                                        <th width="25%">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($banner as $key => $value){ ?>
                                    <tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
                                        <td width="2%" ><input type="checkbox" class="banner" id="<?php echo $value->bannerid;?>"></td>
                                        <td width="60%" ><img src="<?php echo base_url();?>/assets/upimages/
										<?php 
										if($value->contenttype=='html'){
											echo 'icon-banner-html.png';
										}else if($value->contenttype=='html5'){
											echo 'html5.png';
										}else{
											?>icon-banner.png<?php } 
										?>">&nbsp;&nbsp;
										<a href="<?php echo base_url();?>users/banner?bannerid=<?php echo $value->bannerid;?>&campaignid=<?php echo $value->campaignid;?>&clientid=<?php echo $value->clientid;?>">
											<?php echo $value->description;?>
										</a>
                                        </td>
                                        <td >
                                            <ul class="rowActions" style="list-style-type:none;">
                                                <li style="width: 118px;">
													<a href="<?php echo base_url();?>users/banner_acl?bannerid=<?php echo $value->bannerid;?>&campaignid=<?php echo $value->campaignid;?>&clientid=<?php echo $value->clientid;?>">
													Delivery Option</a>
                                                </li>
                                               
                                                <li style="margin-top: 19px;">
                                                    <select name="bannerstatus "
                                                        id="banner_<?php echo $value->bannerid;?>" class="bannerstatus view-banner-filter">
                                                        <option value="1"
                                                            <?php if(isset($value->banner_status) && '1'==$value->banner_status){echo 'selected';} ?>>
                                                            Activate</option>
                                                        <option value="0"
                                                            <?php if(isset($value->banner_status) && '0'==$value->banner_status){echo 'selected';} ?>>
                                                            Deactivate</option>
                                                    </select>
												</li>
											</ul>

										</td>
										

										<td width="25%">
											<style> .panel table td{padding-left: 5px;}.panel table th{padding-left: 32px;}</style>
                                            
                                            <div class="panel" style="font-size: 11px; background-color:#dddddd;">
                                                <table cellpadding=0 cellspacing=0>
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">Size </th>
                                                            <td width="60%">
                                                                <?php echo $value->width.'*'.$value->height;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">Url</th>
                                                            <td width="60%"><?php echo $value->url;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">Weight</th>
                                                            <td width="60%"><?php echo $value->weight;?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>






                                       
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
<div class="pagination-container">
							<?php echo $this->pagination->create_links(); ?>
							<select id="page_limit" onChange="pageLimits(this.value);" class="page-limit">
							<option value="10"<?php if($limt_value == '10'): ?> selected="selected"<?php endif; ?>>10</option>
							<option value="20"<?php if($limt_value == '20'): ?> selected="selected"<?php endif; ?>>20</option>
							<option value="30"<?php if($limt_value == '30'): ?> selected="selected"<?php endif; ?>>30</option>
							</select>
							<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
								<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
							-->
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
		 window.location = '<?php echo base_url(); ?>users/viewbanner?pglmt=' + limit_value;


};
</script>
