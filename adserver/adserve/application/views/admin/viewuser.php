<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header"><img src="<?php echo base_url()?>assets/upimages/icon-advertisers-large.png"/><span style="padding-left: 8px;">Users</span>
					</div>
					<div class="box-body"><div>
						<table id="example" class="table table-hover" >
							<thead>
								<tr class="header-row">
									
									<th width="35%">Username</th>
									<th width="20%">Date Linked</th>
									<th width="10%">Role</th>
									<th width="10%">Status</th>
									<th width="10%"  style="text-align: right;padding-right: 30px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($users as $key => $value){?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#fff';}else{echo '#fff';}?>">
									<td><a href="<?php echo base_url();?>admin/users/create?id=<?php echo $value->user_id;?>" class="table-first"><?php echo ucfirst($value->username);?></a></td>
									<td><?php echo $value->date_created;?></td>
									<td>
										<?php if($value->role == 'advertiser'){$color	= 'maroon';}if($value->role == 'publisher'){$color = 'orange';}?>
										<?php echo ucfirst($value->role);?>
									</td>
									<td>
									<?php if($value->status == 1){ ?>
										<div  class="active" id="<?php echo $value->user_id.'_'.$value->status;?>"><?php echo 'Inactive';?></div>
									<?php }else{ ?>
										<div  class="deactive" id="<?php echo $value->user_id.'_'.$value->status;?>"><?php echo 'Active'?></div>
									<?php } ?>
									</td>
									<td class="last" style="text-align: right;padding-right:25px;"><a href="<?php echo base_url();?>admin/users/create?id=<?php echo $value->user_id;?>" class="fa fa-edit"></a><a href="#" style="padding-left: 10px;" id="<?php echo $value->user_id;?>"><small id="4" class="fa fa-trash-o" style="color:red;padding-left:10px;"></small></a></td>
								</tr>                 
								<?php } ?>
							</tbody>
						</table>
						<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
						<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
					--></div>
				</div>
			</div>
        </div>
    </div>
</section>
</div>
<?php $this->load->view('admin_includes/footer');?>

      
 