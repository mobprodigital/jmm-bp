
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" ng-app="myApp">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            
          </h1><label> <input ng-model="searchText.$" class="form-control" style="width:295px;" placeholder="Search" ></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('admin/users/create','Create User');?></small>
          <!--<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content" >
		<div class="row" ng-controller="userController">
        <!--Loading icon-->
         <p class="text-center load-overlay" id="overlay" ng-hide="dataLoaded">
            <i class="fa fa-spinner fa-pulse fa-5x"></i>
		 </p>
         
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
               
			<?php if(isset($_REQUEST['done'])){
				echo '<div class="text-success">User has been inserted succesfully.</div>';
				}
				if(isset($_REQUEST['udone'])){
				echo '<div class="text-success">User has been updated succesfully.</div>';
				}
				if(isset($_REQUEST['rdone'])){
					echo '<div class="text-success">User has been deleted succesfully.</div>';
				}
			?>
             
                </div><!-- /.box-header -->
               
                <div class="box-body">
                
                <div >
                
                  <table id="example" class="table table-bordered table-striped" >
    				<thead>
                    <tr>
      				<th width="6%">Sr. No.</th><th width="15%">Username</th><th width="20%">Fullname</th><th>Password</th><th width="15%">Role</th><th width="10%">Action</th>
    				</tr>
                    </thead>
                   
                    <tbody>
                   
                       <tr ng-show="users.length!=0" ng-repeat="group in users | filter:searchText">
                        <td>{{$index+1}}</td><td >{{group.username}}</td><td >{{group.firstname}} {{group.lastname}}</td><td>{{group.password}}</td><td><div ng-show="group.role == 'Teacher'" class="btn bg-maroon btn-xs">{{group.role}}</div><div ng-show="group.role == 'Parent'" class="btn bg-purple btn-xs">{{group.role}}</div><div ng-show="group.role == 'Student'" class="btn bg-orange btn-xs">{{group.role}}</div></td><td><a href="<?php echo base_url();?>admin/users/edit/{{group.id}}" class="fa fa-edit"></a> | <a href="#" ng-click="deleteUser(group.id)" class="fa fa-remove"></a></td>
                       </tr>                 
                                        
                          <tr >
        				<td ng-show="users.length==0" colspan="7">
            			No Record Found            
        				</td>
    				  </tr>                     
                                        
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>Sr. No.</th>
                       <th>Username</th><th>Fullname</th><th>Password</th><th>Role</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
  				</table>
                 
	   <script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
       <script src="<?php echo base_url();?>assets/common/user-app.js"></script>   

                 </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
 