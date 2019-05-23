<?php
error_reporting(0);
$this->load->view('login/header');?>







<div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg"></p>
        <?php if(isset($msg)){echo $msg;}?>
        <form action="<?php echo base_url();?>login/forgotPassword" method="post">

            <div class="form-group has-feedback">
                <input type="email" required placeholder="Email" name="email" autofocus="autofocus"
                    class="form-control">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8"> <button type="submit" class="btn btn-primary btn-block btn-flat">
                        <!----> Submit </button></div>
                <div class="col-xs-2"></div>
            </div>

        </form>
    </div>
</div>

</body>

</html>