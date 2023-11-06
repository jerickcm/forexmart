<?php include_once('profile_nav.php') ?>

<div role="tabpanel" class="tab-pane" id="pass" style="min-height: 600px;">
    <div class="row">
        <div class="col-md-12 col-centered">
            <?php echo form_open('profile/change-password', array('role' => 'form', 'class' => 'form-horizontal prof-form', 'id' => 'frmChangePassword')) ?>
            <?php //echo validation_errors('<div class="alert alert-danger change-password-alert">', '</div>') ?>
            <?php if(isset($success)){ ?>
                <?php if( $success ){ ?>
                    <div class="alert alert-success">Password successfully changed</div>
                <?php }else{ ?>
                    <div class="alert alert-danger change-password-alert"><?php echo $tank_error ?></div>
                <?php } ?>
            <?php }else{ ?>
                <div class="alert alert-danger change-password-alert" style="display: none;"></div>
            <?php } ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Current Password<cite class="req">*</cite></label>
                    <div class="col-sm-4">
                        <input type="password" name="old_password" class="form-control round-0" id="old_password" placeholder="Enter Current Password">
                    </div>
                    <?php echo form_error('old_password', '<span class="col-sm-4 error">', '</span>') ?>
                </div>
                <div class="form-group" id="#pwd-container">
                    <label class="col-sm-4 control-label">New Password<cite class="req">*</cite></label>
                    <div class="col-sm-4">
                        <input type="password" name="password" class="form-control round-0" id="password" placeholder="New Password">
                        <div class="pw-meter"></div>
<!--                        <div class="progress pw-meter">-->
<!--                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                    <?php echo form_error('password', '<span class="col-sm-4 error">', '</span>') ?>
                    <span class="col-sm-4 password-error error" style="display: none"></span>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Re-Enter Password<cite class="req">*</cite></label>
                    <div class="col-sm-4">
                        <input type="password" name="re_password" class="form-control round-0" id="re_password" placeholder="Re-Enter Password">
                    </div>
                    <?php echo form_error('re_password', '<span class="col-sm-4 error">', '</span>') ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <button type="submit" class="btn-submit">Send Request</button>
                    </div><div class="clearfix"></div>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        "use strict";
        var options = {};

        options.ui = {
            container: "#pwd-container",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pw-meter"
            }
        };

        options.common = {
            onKeyUp: function (evt, data) {
                console.log("Current length: " + $(evt.target).val().length + " and score: " + data.score);
            }
        };
        $('#password').pwstrength(options);

        jQuery('#frmChangePassword').submit(function(event){
            jQuery('.password-error').hide();
            jQuery('.error').hide();
            var  old_password =  $("#old_password").val();
            var  password =  $("#password").val();
            var  re_password =  $("#re_password").val();
            if(password.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)){
                if( password == re_password ){
                    return;
                }else{
                    jQuery('.password-error').html('Password does not match.');
                    jQuery('.password-error').show();
                    event.preventDefault();
                }
            }else{
                jQuery('.password-error').html('Minimum 6 characters, combination of a-z, A-Z and at least one digit,0-9.');
                jQuery('.password-error').show();
                event.preventDefault();
            }
        });
    });
</script>