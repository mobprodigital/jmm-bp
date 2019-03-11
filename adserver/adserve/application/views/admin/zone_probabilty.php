<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('admin/users/zone','Add new zones');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header"><img src="<?php echo base_url()?>assets/upimages/icon-zones-large.png"/><span>Zones</span>
						<a href="#" id="delete-advertiser"><img src="<?php echo base_url()?>assets/img/1011.png" style="margin-left:54px;margin-right: 10px;"/>Delete</a>
					</div>
					<div class="box-body">
						<div>
						<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th	width="4%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
										<th width="20%">Name</th>
										<th width="20%">Size</th>
										<th width="20%">Description</th>
										<th width="36%"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($zones as $key => $value){?>
									<tr>
										<td><input type="checkbox" class="advertiser" id="<?php echo $value->affiliateid;?>"></td>
										<td><?php echo $value->zonename;?></td>
										<td><?php echo $value->width."*".$value->width;?></td>
										<td><?php echo $value->description;?></td>

										<td>
											<a href="<?php echo base_url();?>users/zone_include"><div  class="btn bg-maroon btn-xs">Linked Banners</div></a>
											<a href="<?php echo base_url();?>users/zone_probability" style="padding: 0px 30px;"><div  class="btn bg-purple btn-xs">Probability</div></a>
											<a href="<?php echo base_url();?>users/zone_invocation"><div  class="btn bg-green btn-xs">Invocation Code</div></a>
										</td>
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



      
 