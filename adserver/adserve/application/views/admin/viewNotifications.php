


<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/banner','Add new banner');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<!-- <div class="box-header"><img src="<?php echo base_url()?>assets/upimages/icon-campaign-large.png"/><span>Banners</span>
						<a href="#" id="delete-advertiser"><img class="delete-text" src="<?php echo base_url()?>assets/img/1011.png"/>Delete</a>
					</div> -->
					<!-- <select  name="revenue_type" id="revenue_type"  class="search-box">
						<option>All banners</option>		
						<option>Active banners</option>
					</select> -->
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
										<td><a href=""><?php echo $CampData['campaignname'];?></a></td>
										<td>
										<?php if($CampData['type'] == 'under_delivered')
										{ ?>
										<div  class="btn bg-maroon btn-xs">Under Delivered</div>
										<?php } elseif($CampData['type'] == 'active') { ?>
										<div  style="width: 70%;" class="btn bg-green btn-xs">Activated</div>
										<?php } elseif($CampData['type'] == 'expired') { ?>
										<div  style="width: 70%;" class="btn bg-purple btn-xs">Expired</div>
										<?php } ?>
										</td>

										<td><div><?php echo $CampData['views'];?></div></td>
										<td><div><?php if(!empty($CampData['impressions'])) { echo $CampData['impressions']; } else { echo "0";} ?>
										</div></td>
										<td><div><?php echo $CampData['per'];?></div></td>
										<td><?php echo date("d M Y",strtotime($CampData['activate_time']));?></td>
										<td><?php echo date("d M Y",strtotime($CampData['expire_time']));?></td>

										

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


      
 