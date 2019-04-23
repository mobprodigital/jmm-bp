<style>
.country-img-icon {
    width: 25px;
    position: absolute;
    top: 30px;
    left: 24px;
}
</style>
<?php $this->load->view('publisher/header');?>
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
                        <div class="">
                            <div class="register-box-body">
                                <?php if(isset($profile) && !empty($profile)){ ?>

                                <div class="head-title">
                                    <h2>Account Info</h2>
                                </div>
                                <form action="<?php echo base_url();?>publisher/profile?uid=<?php echo $_GET['uid'];?>" method="post"
                                    class="form-signin" id="vForm" name="vform">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                        <input type="hidden" name="uid" value="<?php if(isset($_GET['uid'])){ echo $_GET['uid']; }?>">
                                            <label>Email</label>
                                            <font style="color:#900;">*</font>(This is your username that you will use
                                            to login.)
                                            <input type="text" id="email" class="form-control" name="email"
                                                data-validate data-required="Please enter your email"
                                                data-type="email;Please enter a valid email" data-err-id="email-err"
                                                value="<?php echo $profile->username;?>" class="form-control">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            <div id="email-err" style="color:red"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label>First Name</label>
                                            <font style="color:#900;">*</font>
                                            <input type="text" name="firstname" id="firstname" class="form-control"
                                                type="text" class="form-control" name="firstname" data-validate
                                                data-required="Please enter your First name"
                                                data-type="alphabets;Only alphabets are allowed"
                                                data-err-id="email-fname" value="<?php echo $profile->firstname;?>"
                                                class="form-control">
                                            <div id="email-fname" style="color:red"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group has-feedback">
                                            <label>Last Name</label>
                                            <font style="color:#900;">*</font>
                                            <input type="text" name="lastname" class="form-control" type="text"
                                                data-validate data-required="Please enter your Last name"
                                                data-type="alphabets;Only alphabets are allowed"
                                                data-err-id="last-fname" value="<?php echo $profile->lastname;?>"
                                                class="form-control">
                                            <div id="last-fname" style="color:red"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Password</label>
                                            <font style="color:#900;">*</font>
                                            <input type="password" name="password" value="<?php echo $profile->password;?>"
                                                class="form-control" disabled>
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            <div id="password_error" style="color:red"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Company Name</label>
                                            <font style="color:#900;">*</font>
                                            <input type="text" name="company"  id="companyname" class="form-control"
                                                type="text" id="email" class="form-control" data-validate
                                                data-required="Please enter company Name"
                                                data-err-id="companyname_error" value="<?php echo $profile->company;?>"
                                                class="form-control">
                                            <div id="companyname_error" style="color:red"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label>Skype Id</label>
                                            <input type="text" name="company" value="<?php echo $profile->skype;?>"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group has-feedback" style="position: relative;">
                                                <label>Phone</label>
                                                <?php if(empty(!$country)){ ?>
                                                <select style="width:60px;"  name="phone"  id="country"
                                                    class="form-control" onchange="displayRecords(this.value);">

                                                    <?php foreach ($country as $rs) { ?>
                                                    <option value="<?php echo trim($rs["countries_iso_code"]); ?>"
                                                        <?php if(trim($rs["countries_iso_code"]) == trim($country_code["countries_iso_code"])): ?>
                                                        selected="selected" <?php endif; ?>>
                                                        <?php echo trim($rs["countries_name"]); ?></option>
                                                    <?php } ?>

                                                </select>

                                                <img class="country-img-icon" id="cflag"
                                                    src="<?= base_url();?>assets/flags/<?= $country_code['countries_iso_code'] ?>.png"
                                                    alt="" />
                                                <?php } ?>

                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label> No</label>
                                            <div class="inline">
                                                <input type="text" class="form-control" type="text" id="isd_code"
                                                    data-min-length="8;Phone no should be minimum of 8 digits"
                                                    data-max-length="16;Phone no should be maximum of 16 digits"
                                                    name="phone" data-validate data-required="Please enter Phone Number"
                                                    data-type="tel;Enter only number" data-err-id="phone_no_error"
                                                    value="<?php echo $profile->phone;?>" />
                                            </div>
                                            <div id="phone_no_error" style="color:red"></div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="submit" name="submit" value="Sign In"
                                                    class="btn btn-large btn-primary">
                                            </div>
                                        </div>
                                </form>
                                <?php }else{ ?>
                                <div class="errormessage" style="margin-top: 2em"><img class="errormessage"
                                        src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16"
                                        border="0" align="absmiddle">Account Info not exist</div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('admin_includes/footer');?>
<script src="<?php echo base_url();?>assets/js/validation.js"></script>
<script>
var regForm = document.querySelector('#vForm');
regForm = validationSetup(regForm);
regForm.addEventListener('onValidationFaild', function() {
    //alert('invalid');
});
regForm.addEventListener('onValidationSuccess', function() {
    //alert('valid');
    regForm.submit();
});
</script>
<script type="text/javascript">
// fetching records
function displayRecords(country_iso_code) {

    var country_iso_code = $.trim(country_iso_code);
    if (country_iso_code.length > 0) {
        $.ajax({
            type: "GET",
            //dataType: 'json',
            url: "<?php echo base_url();?>login/getFlag",
            data: "isocode=" + country_iso_code,
            success: function(html) {
                //alert(html);
                //console.log(html.c_id);return false;
                // $("#results").html(html);
                // parsing the json 2
                var parsedData = jQuery.parseJSON(html);
                // resetting the values
                //alert(parsedData);
                $('#isd_code').val('');
                $('#cflag').attr("src", "");
                $('#cname').html('');
                // checking if there are results or not
                if (Object.keys(parsedData).length > 0) {
                    $('#isd_code').val($.trim('+' + parsedData.c_isd) + " ");
                    $('#cflag').attr("src", "<?= base_url();?>assets/flags/" + $.trim(parsedData
                        .c_iso) + ".png");
                    $('#cname').html($.trim(parsedData.c_name));
                }
                $('.loader').html('');

            }
        });
    } else {
        // setting the default values
        $('#isd_code').val('');
        $('#cflag').attr("src", "");
        $('#cname').html('');
    }
}
</script>