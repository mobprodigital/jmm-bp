<div class="content-wrapper">
	<section class="content-header">
		<h1>Users</h1><label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('admin/users/create','Create User');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<p class="text-center load-overlay" style="display:none;">
				<i class="fa fa-spinner fa-pulse fa-5x"></i>
			</p>
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					</div>
					<div class="box-body"><div>
						<table id="example" class="table table-bordered table-striped" >
							<thead>
								<tr>
									<th width="6%">Sr. No.</th><th width="15%">Username</th><th width="20%">Fullname</th><th>Password</th><th width="15%">Role</th><th width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($users as $key => $value){?>
								<tr>
									<td></td><td></td><td></td><td></td><td>
									<div  class="btn bg-maroon btn-xs"></div>
									<div  class="btn bg-purple btn-xs"></div>
									<div  class="btn bg-orange btn-xs"></div>
									</td><td><a href="<?php echo base_url();?>admin/users/edit/{{group.id}}" class="fa fa-edit"></a> | <a href="#" ng-click="deleteUser(group.id)" class="fa fa-remove"></a></td>
								</tr>                 
								<tr >
									<td  colspan="7">No Record Found</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
						<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
					</div>
				</div>
			</div>
        </div>
    </div>
</section>
</div>
      
 