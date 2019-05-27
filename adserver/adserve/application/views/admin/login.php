<style>
.bg-img {
    background-image: url(../adserve/assets/img/admin/bg-admin.png);
}

.title {
    color: #007dea;
    
}

.sign-in_btn {
    background-color: #007dea;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/login.css">


<div class="bg-img">
    <?php $this->load->view('login/header');?>

    <div class="login-box">
        <div class="login-box-body">
            <img class="login-box-body-top-img" src="<?php echo base_url();?>assets/img/admin/login-top.png" alt=""
                srcset="">
            <div class="input-container">
                <h3 class="title">Admin Login</h3>
                <?php 
	  if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Username or Password is not valid';
          echo '</div>';             
      }
      $attributes = array('class' => 'form-signin');
      echo form_open('admin/login/validate_credentials', $attributes);
      echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'user_name',
          'class'       => 'form-control',
          'value'       => '',
		  'placeholder' => 'Username'
        );
       echo form_input($data);
	  echo '<img class="form-control-feedback" src='.base_url().'assets/img/admin/user.png alt="" srcset=""></div>';
	  echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'password',
          'class'       => 'form-control',
          'value'       => '',
		  'placeholder' => 'Password'
        );
      echo form_password($data);
      echo '<img class="form-control-feedback" src='.base_url().'assets/img/admin/password.png alt="" srcset="">
          </div>';
      
      
      echo '<div class="row">
        <div class="col-xs-12">';
            echo form_submit('submit', 'Sign In', 'class="btn sign-in_btn"');
            echo '</div>
    </div>';
    echo form_close();
    ?>
                <!-- /.login-box-body -->
                <a class="forgot-password" href="<?php echo base_url();?>publisher/forgotpassword">forgot password
                </a>
            </div>
        </div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    </script>
    </body>

    </html>