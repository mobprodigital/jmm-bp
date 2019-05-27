<style>
.bg-img {
    background-image: url(../assets/img/publisher/bg-publisher.png);
}

.title {
    color: #ff5732;
}


.sign-in_btn {
    background-color: #fe6843;
}
</style>


<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/login.css">

<div class="bg-img">
    <?php $this->load->view('login/header');?>

    <div class="login-box">
        <div class="login-box-body">
            <img class="login-box-body-top-img" src="<?php echo base_url();?>assets/img/publisher/login-top.png" alt=""
                srcset="">
            <div class="input-container">
                <h3 class="title">Publisher Login</h3>
                <?php if(isset($msg)){ ?>
                <p id="msg" style="color:red;"><?php echo $msg;?></p>
                <?php } ?>
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
    //  $baseUrl = base_url();
      echo '<img class="form-control-feedback" src='.base_url().'assets/img/publisher/user.png alt="" srcset=""></div>';
	  echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'password',
          'class'       => 'form-control',
          'value'       => '',
		  'placeholder' => 'Password'
        );
      echo form_password($data);
      echo '<img class="form-control-feedback" src='.base_url().'assets/img/publisher/password.png alt="" srcset="">
          </div>';
      
      
      echo '<div class="row"><div class="col-xs-12">';
      echo form_submit('submit', 'Sign In', 'class="btn sign-in_btn"');
	  echo '</div></div>';
      echo form_close();
      ?><a class="forgot-password" href="<?php echo base_url();?>">forgot password </a>

            </div>
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