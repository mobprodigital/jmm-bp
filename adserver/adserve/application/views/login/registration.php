<style>
.bg-img {
    background-image: url(../adserve/assets/img/admin/bg-reg.png);
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: repeat;
    background-size: cover;
}

.reg-text {
    color: #fff;
}

/* 
.login-box {
    margin: 7% 0% 0% 12% !important;
} */
</style>
<div class="bg-img">
    <?php $this->load->view('login/header');?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 ">
            <h2 class="reg-text">Please choose your Account Type:</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="login-box">
                        <div class="login-box-body" style="height:135px;">
                            <p class="login-box-msg">I am publisher</h2>
                                <div class="col-xs-4" style="padding-left: 37%;">
                                    <a href="<?php echo base_url();?>publisher/signup"
                                        class="btn btn-large btn-primary">Sign Up</a>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-box">
                        <div class="login-box-body" style="height:135px;">
                            <p class="login-box-msg">I am advertiser</p>
                            <div class="col-xs-4" style="padding-left: 37%;">
                                <a href="<?php echo base_url();?>advertiser/signup"
                                    class="btn btn-large btn-primary">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</script>
</body>

</html>