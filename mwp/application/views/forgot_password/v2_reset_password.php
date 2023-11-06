 <style>
     .reset{
         width: 50%;
         margin-left: 25%;
         color: #fff;
     }
     .reset-p{
         text-align: center;
     }
 </style>
        <div class="style-form-box">
            <div class="style-form-top-img">
                <img src="<?= $this->template->Images()?>v2_images/fx_logo_white.svg"/>
            </div>
            <div class="style-form-mid-content">
                <h1>Reset Password</h1>
                <?php
                if(isset($msg)){
                    echo "<p class='reset-p'>".$msg."</p>";
                    echo "<a class='uk-button form-login-button reset' href='".FXPP::ajax_url()."'> login</a>";
                }else{
                ?>
                <form action="" method="post">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin">
                            <div class="uk-1-1 style-form-input-holder">
                                <span class="uk-form-icon style-form-icon"><img src="<?= $this->template->Images()?>v2_images/icons/user.svg"/></span>
                                <input readonly  type="text" class="uk-input style-form-input weblogin-text" value="<?=$username?>" placeholder="Email">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-1-1 style-form-input-holder">
                                <span class="uk-form-icon style-form-icon"><img src="<?= $this->template->Images()?>v2_images/icons/password.svg"/></span>
                                <input name="password" type="password" class="uk-input style-form-input weblogin-text" placeholder="New Password">
                            </div>
                            <span class="col-sm-12 red">  <?php echo  form_error('password')?> </span>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-1-1 style-form-input-holder">
                                <span class="uk-form-icon style-form-icon"><img src="<?= $this->template->Images()?>v2_images/icons/password.svg"/></span>
                                <input name="re_password" type="password" class="uk-input style-form-input weblogin-text" placeholder="Confirm Password">
                            </div>
                            <span class="col-sm-12 red">  <?php echo  form_error('re_password')?> </span>
                        </div>
                        <div class="uk-margin form-buttons-holder forgot-pass-holder">
                            <button class="uk-button form-login-button" type="submit">Reset Password</button>
                            <a class="uk-button form-cancel-button" href="<?=FXPP::ajax_url()?>">Cancel</a>
                        </div>
                    </fieldset>
                </form>
                <?php }?>
            </div>
