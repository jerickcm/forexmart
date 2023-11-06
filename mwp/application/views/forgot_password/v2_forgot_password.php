<div class="style-form-box">
    <div class="style-form-top-img-pass">
        <img src="<?= $this->template->Images()?>v2_images/fx_logo_white.svg"/>
    </div>
    <?php
//    if(isset($msg)){
//    echo "<p>".$msg."</p>";
//    }else{
//    echo "<p>Fill in your email address.<br>
//        We will provide a link by email to reset your password.</p>";
//
//    if(!empty($errorSms)){
//    echo '<h5 style="color:red;">'.$errorSms.'</h5>';
//    }

    ?>

    <div class="style-form-mid-content">
        <h1>Forgot Password?</h1>
        <?php
        if(isset($msg)){
            echo "<p class='forgot-pass-desc'>".$msg."</p>";
        }else{
        echo '<p class="forgot-pass-desc">Fill in your email address.<br> We will provide a link by email to reset your password.</p>';


        if(!empty($errorSms)){
            echo '<h5 style="color:red;">'.$errorSms.'</h5>';
        } ?>

        <form action="" method="post">
            <fieldset class="uk-fieldset">
                <div class="uk-margin">
                    <div class="uk-1-1 style-form-input-holder">
                                        <span class="uk-form-icon style-form-icon">
                                            <img src="<?= $this->template->Images()?>v2_images/icons/mail.svg"/>
                                        </span>
<!--                        <input class="uk-input style-form-input" type="text" placeholder="Email Address">-->
                        <input name="username" type="email" class="uk-input style-form-input">
                        <span class="col-sm-12 red">  <?php echo  form_error('username')?> <?php echo  isset($errors['username'])?$this->lang->line($errors['username']):"";?> </span>
                    </div>
                </div>
                <div class="uk-margin form-buttons-holder">
                    <button class="uk-button form-login-button" type="submit">Submit</button>
                    <a class="uk-button form-cancel-button" href="<?=FXPP::ajax_url()?>">Cancel</a>
                </div>
            </fieldset>
        </form>
        <?php }?>
    </div>
</div>