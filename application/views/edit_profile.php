
<?php include_once('profile_nav.php') ?>
<style type="text/css">
    form.prof-form{
        margin-top: 20px !important;
    }
    a.close{
        opacity: 0.8;
        color: red;
        font-size: 30px;
        line-height: 0.6;
    }
    div.alert-danger{
        color: red;
        background-color: #F0CFCF;
    }
</style>
<input type="hidden" id="base_url" value="<?php echo base_url() ?>" />
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="editprof">
        <div class="row">

            <div class="col-md-6 col-centered col-alert">
                <?php if(!$mt_accounts_type){ ?>
                    <div class="alert alert-danger" style="opacity: 1;font-size: 12px; padding: 10px;margin: 20px 0px;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Changes can be made only after creating a real account.
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-12 col-centered">
                <form class="form-horizontal prof-form" id="frmProfile">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <div class="dp-holder" style="float: right;">
                                <input type="hidden" id="profileAvatar" name="profile_avatar" value="<?php echo $user_data['image'] ?>" />
                                <input type="hidden" id="no-image" value="<?= $this->template->Images()?>avatar.png" />
                                <img src="<?php echo $user_data['image'] ? base_url('assets/user_images/' . $user_data['image']) : $this->template->Images() . 'avatar.png' ?>" id="avatar" width="100px" style="border: 1px solid #ccc;display: block;">
                                <button id="remove_avatar" class="btn-remove-avatar"  style="display: block;float: right !important;" <?php echo $mt_accounts_type ? '' : 'Disabled' ?>>Remove Avatar</button>
                            </div>
                        </div>
                        <div class="col-sm-7" style="margin-top: 32px;">
                            <button class="btn btn-success fileinput-button fileup" <?php echo $mt_accounts_type ? '' : 'Disabled' ?>><i class="fa fa-video-camera"></i> Capture From Webcam</button>
                                                    <span class="btn btn-success fileinput-button fileup" <?php echo $mt_accounts_type ? '' : 'Disabled' ?>>
                                                        <span><i class="fa fa-download"></i> Browse...</span>
                                                        <!-- The file input field used as target for the file upload widget -->
                                                        <input id="fileupload" type="file" name="avatar" multiple>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Name<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="text" name="name" class="form-control round-0" placeholder="Name" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['name'] ?>">
                        </div>
                        <span class="col-sm-3 name-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Address<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="text" name="address" class="form-control round-0" placeholder="Address" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['address'] ?>">
                        </div>
                        <span class="col-sm-3 address-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">City<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="text" name="city" class="form-control round-0" placeholder="City" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['city'] ?>">
                        </div>
                        <span class="col-sm-3 city-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">State/Province<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="text" name="state" class="form-control round-0" placeholder="State/Province" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['state'] ?>">
                        </div>
                        <span class="col-sm-3 state-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Postal/Zip Code<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="text" name="zip_code" class="form-control round-0" placeholder="Postal/Zip Code" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['zip_code'] ?>">
                        </div>
                        <span class="col-sm-3 zip-code-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Telephone Number(1)<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="text" name="telephone_1" class="form-control round-0" placeholder="First phone number" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['telephone'][0] ?>">
                        </div>
                        <span class="col-sm-3 telephone-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Telephone Number(2)</label>
                        <div class="col-sm-4">
                            <input type="text" name="telephone_2" class="form-control round-0" placeholder="Second phone number" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['telephone'][1] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Email(1)<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <input type="email" name="email_1" class="form-control round-0" placeholder="First email" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['email'][0] ?>">
                        </div>
                        <span class="col-sm-3 email-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Email(2)</label>
                        <div class="col-sm-4">
                            <input type="email" name="email_2" class="form-control round-0" placeholder="Second email" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['email'][1] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Email(3)</label>
                        <div class="col-sm-4">
                            <input type="email" name="email_3" class="form-control round-0" placeholder="Third email" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="<?php echo $user_data['email'][2] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Preferred time of contact</label>
                        <div class="col-sm-4">
                            <input type="text" name="preferred_time" class="form-control round-0" placeholder="Preferred time" <?php echo $mt_accounts_type ? '' : 'Disabled' ?> Value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Country<cite class="req">*</cite></label>
                        <div class="col-sm-4">
                            <select name="country" class="form-control round-0" <?php echo $mt_accounts_type ? '' : 'Disabled' ?>>
                                <?php
                                    foreach( $countries as $key => $country ){
                                        if( $key == $user_data['country'] ){
                                            echo '<option value="' . $key . '" selected="selected">' . $country . '</option>';
                                        }else{
                                            echo '<option value="' . $key . '">' . $country . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <span class="col-sm-3 country-error error" style="display: none"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <button type="submit" class="btn-submit" <?php echo $mt_accounts_type ? '' : 'Disabled' ?>>Submit</button>
                        </div><div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>