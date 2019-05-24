<?php $this->load->view('admin_includes/header');
 //sprint_r($profile); die;
?>
<style>
.content-wrapper,
.main-footer {
    margin-left: 0px;
}

#top-header {
    background: none repeat scroll 0 0 #093145;
    padding: 0;
    line-height: 45px;
}

.form-control {
    width: 100%; 
}

.login-select {
    float: right;
    width: 4%;

}

.signup {
    float: right;
    width: 15%;
}

.login-link,
.signup-link {
    color: #fff;
    font-size: 14px;
    font-weight: 500;
}

.login-item a {
    color: black;
    font-size: 14px;
    font-weight: 500;
}

.login-item li {
    list-style: none;
    line-height: 24px;
}

.login-select {
    position: relative;

}

.login-select:hover .login-item {
    display: block;
}

.login-item {
    display: none;
    position: absolute;
    z-index: 12;
    background: #ddd;
    width: 222px;
    right: 0px;
    top: 45px;
    text-align: center;
}

.col-md-6 {
    width: 50%;
}

.register-box-body {

    border: none;
}

.head-title {
    margin-left: 3.5%;
    padding: 0px;
}

.login-page,
.register-page {
    background: #fff;
}

.a {
    color: #fff;


}
</style>
<div class="content-wrapper" style="min-height: 368px;">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 login-box-body">

                                <form action="<?php echo base_url();?>users/adminProfile?uid=<?php echo $_GET['uid'];?>" method="post"
                                    accept-charset="utf-8" class="form-signin">
                                    <div class="col-md-10 col-md-offset-1">
                                        <h2>Account Info</h2>
                                        <div class="form-group has-feedback">
                                            <label>First Name</label>
                                            <font style="color:#900;">*</font>
                                            <input type="text" name="firstname" value="<?php echo $profile->firstname; ?>" class="form-control">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label>Last Name</label>
                                            <font style="color:#900;">*</font>
                                            <input type="text" name="lastname" value="<?php echo $profile->lastname; ?>" class="form-control">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label>Email</label>
                                            <font style="color:#900;">*</font>(This is your username that you
                                            will use to login.)
                                            <input type="text" name="email" value="<?php echo $profile->username; ?>"
                                                class="form-control">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label>Skype Id</label>
                                            <input type="text" name="skype" value="<?php echo $profile->skype; ?>" class="form-control">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="<?php echo $profile->phone; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Update"
                                                class="btn btn-large btn-primary">
                                            <a href="<?php echo base_url(); ?>users/changePassword?uid=<?php echo $_GET['uid'];?>" style="color: #00a9e8;right: 0;position: absolute;margin-top: 10px;"> Change
                                                Password ?</a>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('admin_includes/footer');?>