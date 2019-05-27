<style>
div.message div.close {
    position: absolute;
    right: 6px;
    bottom: 5px;
    width: 14px;
    height: 14px;
    line-height: 14px;
    text-indent: -2000em;
    cursor: pointer;
}

div.message div.panel {
    position: relative;
    font-size: 1em;
    line-height: 135%;
    margin: 0;
    padding: 0;
    text-align: left;
    background: transparent;
}

.panel {
    padding: 15px;
    border: 1px solid #ddd;
    position: relative;
    top: 0;
    left: 0;
    background: #fff url(css/../images/panel-background.png) bottom left repeat-x;
    -zoom: 1;
    margin: 10px 0px 15px 0px;
}

div.message div.confirm {
    color: #045222;
    background-color: #a8e9be;
    border: 1px solid #9ad6b2;
}

.bg-img {
    background-image: url(../assets/img/advertiser/bg-advertiser.png);
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
        <?php if(isset($successMsg)){ ?>

        <div class="message localMessage">
            <div class="panel confirm">
                <div class="icon">
                </div>
                <p><?php echo $successMsg;?></p>
                <div class="topleft"></div>
                <div class="topright"></div>
                <div class="bottomleft"></div>
                <div class="bottomright"></div>
                <div class="close">x</div>
            </div>
        </div>
        <?php } ?>
        <div class="login-box-body">

            <img class="login-box-body-top-img" src="<?php echo base_url();?>assets/img/advertiser/login-top.png" alt=""
                srcset="">
            <div class="input-container">
                <h3 class="title">Advertiser Login</h3>
                <?php 
	  if(isset($msg) && $msg){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Username or Password is not valid';
          echo '</div>';             
      }
      $attributes = array('class' => 'form-signin');
      echo form_open('advertiser/validate_credentials', $attributes);
      echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'email',
          'class'       => 'form-control',
          'value'       => '',
		  'placeholder' => 'Username'
        );
      echo form_input($data);
	  echo '<img class="form-control-feedback" src='.base_url().'assets/img/advertiser/user.png alt="" srcset="">
          </div>';
	  echo '<div class="form-group has-feedback">';
	  $data = array(
          'name'        => 'password',
          'class'       => 'form-control',
          'value'       => '',
		  'placeholder' => 'Password'
        );
      echo form_password($data);
      echo '<img class="form-control-feedback" src='.base_url().'assets/img/advertiser/password.png alt="" srcset="">
          </div>';
      
      
      echo '<div class="row"><div class="col-xs-12">';
      echo form_submit('submit', 'Sign In', 'class="btn sign-in_btn"');
	  echo '</div></div>';
      echo form_close();
      ?>
                <a class="forgot-password" href="<?php echo base_url();?>"> forgot password </a>
                <br />
                <!-- /.login-box-body -->
            </div><!-- /.login-box -->
        </div>
    </div>
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
    $(".close").click(function() {
        $(".message").hide();
    });
    $(function() {
        $("#msg").fadeOut(3000);
    });
    </script>
    </body>

    </html>