<div class="content-wrapper">
	<section class="content-header">
		<label><input  name="clients"  id="clients" class="search form-control" style="width:295px;" placeholder="Search" value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
		<input type="submit" class="btn btn-primary" name="submit" id="submit" value="search" >
		<div class="dropdown-content">
		</div>
		<small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('admin/users/advertisement','Add new advertiser');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<img src="<?php echo base_url()?>assets/upimages/icon-advertisers-large.png"/><span>Advertiser</span>
					<a href="#" id="delete-advertiser"><img src="<?php echo base_url()?>assets/img/1011.png" style="margin-left:54px;margin-right: 10px;"/>Delete</a>
					</div>
					<div class="box-body">
						<div>
							<table id="example" class="table table-bordered table-striped" >
								<thead>
									<tr class="header-row">
										<th width="75%">Name</th>
										<th width="25%" class="center-align">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($advertiser[0])){ ?>
									<?php foreach($advertiser as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><img src="<?php echo base_url();?>/assets/upimages/icon-advertiser.png">&nbsp;&nbsp;<a href="<?php echo base_url();?>users/advertisement?id=<?php echo $value->clientid;?>"><?php echo $value->clientname;?></a></td>
										<td>
											<a href="<?php echo base_url();?>users/compaign?clientid=<?php echo $value->clientid;?>">&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/upimages/icon-campaign-add.png" style="padding-right: 5px;"/><div  class="btn bg-blue btn-xs">add new compaign</div></a>
											<a href="<?php echo base_url();?>users/viewcompaign?clientid=<?php echo $value->clientid;?>" style="padding-left: 20px;">&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/upimages/icon-campaigns.png" style="padding-right: 5px;"/><div  class="btn bg-purple btn-xs">compaign</div></a>
										</td>
									</tr>                 
									<?php }}else{?>
									<tr>

										<td></td>
										<td class="center-align"><b>No Advertiser Exist</b></td>
										<td></td>
									</tr> 
									<?php } ?>
								</tbody>
							</table>
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
<script src="<?php echo base_url();?>assets/js/adserver.js"></script>


      
 