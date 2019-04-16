<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/banner','Add new banner');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header"><img src="<?php echo base_url()?>assets/upimages/icon-banner-large.png"/><span>Banners</span>
						<a href="#" id="delete-advertiser"><img class="delete-text" src="<?php echo base_url()?>assets/img/1011.png"/>Delete</a>
					</div>
				
					<div class="box-body">
						<div>
						<?php if(isset($banner) && !empty($banner)){ ?>
							<table id="example" class="table table-striped">
								<thead>
									<tr class="header-row" class="center-align">
										<th width="2%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
										<th width="60%">Name</th>
										<th width="10%" class="center-align">Option</th>
										<th width="25%" class="center-align">Details</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($banner as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td width="2%"><input type="checkbox" class="advertiser" id="<?php echo $value->bannerid;?>"></td>
										<td width="60%"><img src="<?php echo base_url();?>/assets/upimages/
										<?php 
										if($value->contenttype=='html'){
											echo 'icon-banner-html.png';
										}else if($value->contenttype=='html5'){
											echo 'html5.png';
										}else{
											?>icon-banner.png<?php } 
										?>">&nbsp;&nbsp;<a href="<?php echo base_url();?>executive/banner?bannerid=<?php echo $value->bannerid;?>&campaignid=<?php echo $value->campaignid;?>&clientid=<?php echo $value->clientid;?>"><?php echo $value->description;?></td>
										<td width="10%"><ul class="rowActions" style="list-style-type:none;">
                                              <li style="padding-top: 10px;">
											  <span class="bannerstatus" id="banner_<?php echo $value->bannerid;?>" style="cursor: pointer;color:
												<?php if($value->banner_status == 0){echo '#eb7e23';}else{echo 'green';}?>">
												<?php if($value->banner_status == 0){echo 'deactivate';}else{echo 'activate';}?></span>
											  </li>
                                            </ul>
										</td>
										<td width="25%">
											<style> .panel table td{padding-left: 5px;}.panel table th{padding-left: 32px;}</style>
											<div class="panel" style="font-size: 11px; background-color:#dddddd;">
											<table  cellpadding=0 cellspacing=0>
												<tbody>
												<tr >
													<th width="30%">Size </th>
													<td width="60%"><?php echo $value->width.'*'.$value->height;?></td>
												</tr>
												<tr >
													<th width="30%">Url</th>
													<td width="60%"><?php echo $value->url;?></td>
												</tr>
												<tr >
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
							<?php }else{ ?>
							<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">No Banner Exist</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>


      
 