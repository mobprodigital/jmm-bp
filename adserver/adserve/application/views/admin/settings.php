     
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
          </h1><br/><br/>
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
                <h3><?php echo ucfirst($this->session->userdata('username')).' - ' ?>Change Password</h3>
                  <?php  echo $this->session->flashdata('error_msg'); ?>
                 <?php if(isset($_REQUEST['udone'])){echo 'Password has been changed.';}?>
                </div><!-- /.box-header -->
                <!-- form start -->
               <?php //echo validation_errors('<p class="form_error">','</p>'); ?>
				 <form  ng-submit="submitForm()" ng-controller="settingsuserController" method="post" name="groupForm">
                 <input type="hidden" class="form-control" id="uid" ng-model="uid"  value="<?php echo $this->session->userdata('uid');?>">
                  <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Old Password<font style="color:#900;">*</font></label>
                      <input type="text" class="form-control" id="oldpwd" ng-model="oldpwd"  value="" placeholder="Enter Old Password">
					
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">New Password<font style="color:#900;">*</font></label>
                      <input type="password" class="form-control" id="newpwd" ng-model="newpwd"  value="" placeholder="Enter New Password">
					
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