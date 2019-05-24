<style>
.bg-img {
    background-image: url(../adserve/assets/img/admin/bg-admin.png);
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.login-box {
    margin: 4% 0% 0% 12% !important;
}

.login-box-body {
    box-shadow: 2px 2px 4px 2px #e6e6e6, -2px -2px 4px 2px #e6e6e6, -2px -2px 4px 2px #e6e6e6, 2px 2px 4px 2px #e6e6e6;
}
</style>



<div class="bg-img">
    <?php $this->load->view('login/header');?>

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b> Login</a>
        </div>
        <div class="login-box-body">


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
	  echo '<span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>';
	  echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'password',
          'class'       => 'form-control',
          'value'       => '',
		  'placeholder' => 'Password'
        );
      echo form_password($data);
      echo '<span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>';
      
      
      echo '<div class="row"><div class="col-xs-8"> </div>
        <div class="col-xs-4" style="padding-left: 32px;">';
            echo form_submit('submit', 'Sign In', 'class="btn btn-large btn-primary"');
            echo '</div>
    </div>';
    echo form_close();
    ?>
            <!-- /.login-box-body -->
            <a style="color:#00a9e8" href="<?php echo base_url();?>publisher/forgotpassword">I forgot my password </a>
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