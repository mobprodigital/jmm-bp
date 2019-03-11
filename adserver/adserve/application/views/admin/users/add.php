     
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New User
          </h1>
          <!--<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content" ng-app="myApp">
		
          <div class="row" >
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <?php  echo $this->session->flashdata('error_msg'); ?>
                 
                </div><!-- /.box-header -->
                <!-- form start -->
               <?php //echo validation_errors('<p class="form_error">','</p>'); ?>
				 <form  ng-submit="submitForm()" ng-controller="adduserController" method="post" name="groupForm">
                  <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username<font style="color:#900;">*</font></label>
                       <span style="color:red" ng-show="groupForm.title.$dirty && groupForm.title.$invalid"></span>
                      <input type="text" class="form-control" id="username" ng-model="username" required  ng-blur="uniqueUser()"  value="" placeholder="Enter Username">
					
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Password<font style="color:#900;">*</font></label>
                       <span style="color:red" ng-show="groupForm.title.$dirty && groupForm.title.$invalid"></span>
                      <input type="password" class="form-control" id="password" ng-model="password" required  value="" placeholder="Enter Password">
					
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Firstname<font style="color:#900;">*</font></label>
                       <span style="color:red" ng-show="groupForm.title.$dirty && groupForm.title.$invalid"></span>
                      <input type="text" class="form-control" id="firstname" ng-model="firstname" required  value="" placeholder="Enter First Name">
					
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Lastname<font style="color:#900;">*</font></label>
                       <span style="color:red" ng-show="groupForm.title.$dirty && groupForm.title.$invalid"></span>
                      <input type="text" class="form-control" id="lastname" ng-model="lastname" required  value="" placeholder="Enter Last Name">
					
                    </div>
                    </div>
                   
                   
                    <div class="col-md-6">
                     <div class="form-group">
                       <label>Role</label>
                      <select class="form-control" ng-model="role">
                      <option value="">--Role--</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                        <option value="parent">Parent</option>
                      </select>
					
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" ng-model="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                    </div>
                   
                  </div><!-- /.box-body -->
                
                  <div class="box-footer">
                    <button type="submit" ng-disabled="groupForm.title.$dirty && groupForm.title.$invalid" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
             </div>
             
           </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
<script src="<?php echo base_url();?>assets/common/user-app.js"></script> 