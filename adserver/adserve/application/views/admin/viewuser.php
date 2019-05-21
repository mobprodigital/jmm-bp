<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<img src="<?php echo base_url()?>assets/upimages/icon-advertisers-large.png"/><span style="padding-left: 8px;">Users</span>
					</div>
					<div class="box-body"><div>
						<table id="example" class="table table-hover">
							<thead>
								<tr class="header-row">
									<th width="35%">Name</th>
									<th width="35%">Email</th>
									<th width="20%">Date Linked</th>
									<th width="10%">Role</th>
									<th width="10%">Status</th>
									<th width="10%"  style="text-align: right;padding-right: 30px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($users as $key => $value){?>
								<tr style="background-color: <?php if($key % 2 == 0){echo '#fff';}else{echo '#f5f5f5';}?>">
									<td>
									
									<?php echo ucfirst($value->firstname);?>
									<?php echo ucfirst($value->lastname);?>
									</td>
									<td>
									
									<?php echo $value->username;?>

									
									</td>
									<td>
									

									<p><?php echo date("d M Y",strtotime($value->date_created));?></br>
									<?php //echo date("H:i",strtotime($value->date_created)).' IST';?></p>

									</td>
									
									
									<td>
										<?php 
										if($value->role == 2){$roleName ='advertiser';$color	= 'maroon';}
										if($value->role == 3){$roleName='publisher';$color = 'orange';}
										if($value->role == 4){$roleName='executive';$color = 'orange';}
										if($value->role == 5){$roleName='pub executive';$color = 'orange';}

										?>
										<?php echo ucfirst($roleName);?>
									</td>
									<td>
									<?php if($value->status == 1){ ?>
										<div  class="active" id="<?php echo $value->user_id.'_'.$value->status;?>"><?php echo 'Active';?></div>
									<?php }else{ ?>
										<div  class="deactive" id="<?php echo $value->user_id.'_'.$value->status;?>"><?php echo 'Inctive'?></div>
									<?php } ?>
									</td>
									<td class="last" style="text-align: right;padding-right:25px;"><a href="<?php echo base_url();?>admin/users/create?id=<?php echo $value->user_id;?>" class="fa fa-edit"></a><a href="#" style="padding-left: 10px;" id="<?php echo $value->user_id;?>"><small id="4" class="fa fa-trash-o" style="color:red;padding-left:10px;"></small></a></td>
								</tr>                 
								<?php } ?>
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

      
 