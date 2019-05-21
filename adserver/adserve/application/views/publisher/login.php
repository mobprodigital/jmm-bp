<style>
.bg-img {
    background-image: url(../assets/img/admin/pexels-photo-1308624.jpeg);
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>


<?php $this->load->view('login/header');?>

<div class="bg-img">

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Publisher</b> Login</a>
        </div>
        <div class="login-box-body">
            <?php if(isset($msg)){ ?>
            <p id="msg" style="color:red;"><?php echo $msg;?></p>
            <?php } ?>
            <p class="login-box-msg">Sign in to start your session</p>
            <?php 
	  if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Username or Password is not valid';
          echo '</div>';             
      }
      $attributes = array('class' => 'form-signin');
      echo form_open('publisher/validate_credentials', $attributes);
      echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'email',
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
      
      
      echo '<div class="row"><div class="col-xs-8"></div><div class="col-xs-4" style="padding-left: 32px;">';
      echo form_submit('submit', 'Sign In', 'class="btn btn-large btn-primary"');
	  echo '</div></div>';
      echo form_close();
      ?>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
$(function() {
    $("#msg").fadeOut(3000);
});
</script>
</body>

</html>