<style>
.country-img-icon {
    width: 25px;
    position: absolute;
    top: 30px;
    left: 24px;
}
</style>
<?php 
 
$this->load->view('login/header');?>
<div class="">
    <div class="register-box-body">
    <?php if(isset($msg)){ ?>
		<p id="msg" style="color:red;"><?php echo $msg;?></p>
	<?php } ?>
        <div class="head-title">
            <h2>Sign Up for Publisher Account</h2>
        </div>
        <form action="<?php echo base_url();?>publisher/signup" method="post" accept-charset="utf-8" class="form-signin"
            id="vForm" class="form-signin" name="vform">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Email</label>
                        <font style="color:#900;">*</font>(This is your username that you will use to login.)
                        <input type="text" id="email" class="form-control" name="email" data-validate
                            data-required="Please enter your email" data-type="email;Please enter a valid email"
                            data-err-id="email-err" />
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <div id="email-err" style="color:red"></div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label>First Name</label>
                        <font style="color:#900;">*</font>
                        <input type="text" name="firstname" id="firstname" class="form-control" type="text" id="email"
                            class="form-control" name="email" data-validate data-required="Please enter your First name"
                            data-type="alphabets;Only alphabets are allowed" data-err-id="email-fname" />
                        <div id="email-fname" style="color:red"></div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="form-group has-feedback">
                        <label>Last Name</label>
                        <font style="color:#900;">*</font>
                        <input type="text" name="lastname" class="form-control" type="text"  name="email"
                            data-validate data-required="Please enter your Last name"
                            data-type="alphabets;Only alphabets are allowed" data-err-id="last-fname" />
                        <div id="last-fname" style="color:red"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Password</label>
                        <font style="color:#900;">*</font>
                        <input type="password" name="password" id="password" class="form-control" data-validate
                            data-required="Please enter password" data-compare="password_confirm;Password did not match"
                            data-err-id="password_error" />
                        <div id="password_error" style="color:red"></div>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Confirm Password</label>
                        <font style="color:#900;">*</font>
                        <input type="password" name="cnfm-password" id="password_confirm" class="form-control"
                            data-validate data-required="Please enter Confirm password"
                            data-compare="password;Confirm password did not match" data-err-id="confirm_password_error">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <div id="confirm_password_error" style="color:red"></div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Company Name</label>
                        <font style="color:#900;">*</font>
                        <input type="text" name="company" id="companyname" class="form-control" type="text" id="email"
                            class="form-control" data-validate data-required="Please enter company Name"
                            data-err-id="companyname_error">
                        <div id="companyname_error" style="color:red"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Skype Id</label>
                        <input type="text" name="skype" value="" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <div class="form-group has-feedback" style="position: relative;">
                        <label>Phone</label>
                        <?php if(empty($country)){ ?>
                        <select style="width:60px;" name="country" id="country" class="form-control"
                            onchange="displayRecords(this.value);">

                            <?php foreach ($country as $rs) { ?>
                            <option value="<?php echo trim($rs["countries_isd_code"]); ?>">
                                <?php echo trim($rs["countries_name"]); ?></option>
                            <?php } ?>

                        </select>

                        <img class="country-img-icon" id="cflag" src="" alt="" />
                        <?php }else{ ?>

                        <select style="width:60px;" name="country" id="country" class="form-control"
                            onchange="displayRecords(this.value);">
                            <?php foreach ($country as $rs) { ?>
                            <option value="<?php echo trim($rs["countries_iso_code"]); ?>">
                                <?php echo trim($rs["countries_name"]); ?></option>
                            <?php } ?>
                        </select>
                        <img class="country-img-icon" id="cflag" src="<?= base_url();?>assets/flags/in.png" alt="">
                        <?php } ?>

                    </div>
                </div>
                <div class="col-md-5">
                    <label> No</label>
                    <div class="inline">
                        <input type="text" class="form-control" type="text" id="isd_code" class="form-control"
                            name="phone" data-validate data-required="Please enter Phone Number"
                            data-type="tel;Enter only number" data-err-id="phone_no_error" value="+91" />
                    </div>
                    <div id="phone_no_error" style="color:red"></div>
                </div>

                <div class="col-md-6">
                    <input type="submit" name="submit" value="Sign In" class="btn btn-large btn-primary">
                </div>
            </div>
        </form>

    </div>
</div>
<script src="<?php echo base_url();?>assets/js/validation.js"></script>
<!-- <script src="<?php echo base_url();?>assets/js/jquery-1.9.0.min.js"></script> -->
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
<script>
var regForm = document.querySelector('#vForm');
validationSetup(regForm);
regForm.addEventListener('onValidationFaild', function() {
    //alert('invalid');
});
regForm.addEventListener('onValidationSuccess', function() {
    //alert('valid');
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
                    $('#isd_code').val($.trim('+' + parsedData.c_isd));
                    $('#cflag').attr("src", "<?php echo base_url();?>assets/flags/" + $.trim(parsedData
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
</body>

</html>