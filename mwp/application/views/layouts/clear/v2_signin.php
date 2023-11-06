<style>
    input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
        background-color:none!important;
    }
    span.red{
        color: red;
        font-size: 12px;
    }
</style>
<div class="style-form-box">
    <div class="style-form-top-img">
        <img src="<?= $this->template->Images()?>v2_images/fx_logo_white.svg"/>
    </div>
    <div class="style-form-mid-content">
        <h1>Login with your account</h1>
        <?= form_open('signin',array('id' => 'form_login','class'=> 'weblogin'),''); ?>
            <fieldset class="uk-fieldset">
                <div class="uk-margin">
                    <div class="uk-1-1 style-form-input-holder">
                        <span class="uk-form-icon style-form-icon"><img src="<?= $this->template->Images()?>v2_images/icons/user.svg"/></span>
                        <?php echo form_input($username);?>
                    </div>
                    <span class="col-sm-12 red">  <?php echo  form_error('username')?> <?php echo  isset($errors['username'])?$this->lang->line($errors['username']):"";?> </span>
                </div>
                <div class="uk-margin">
                    <div class="uk-1-1 style-form-input-holder">
                        <span class="uk-form-icon style-form-icon"><img src="<?= $this->template->Images()?>v2_images/icons/password.svg"/></span>
                        <?php echo form_input($password);?>
                    </div>
                    <span class="col-sm-12 red">  <?php echo  form_error('password')?> <?php echo  isset($errors['password'])?$this->lang->line($errors['password']):"";?></span>
                </div>
                <div class="uk-margin uk-grid-small uk-child-width-auto form-holder-bottom" uk-grid>
                    <label><input class="uk-checkbox" type="checkbox" checked> Keep me login</label>
                    <a href="<?=FXPP::ajax_url('forgot-password');?>" class="password-link">Forgot Password</a>
                </div>
                <div class="uk-margin form-buttons-holder">
                    <button class="uk-button form-login-button" type="submit">Login</button>
                    <button class="uk-button form-cancel-button">Cancel</button>
                </div>
            </fieldset>
        <?php echo form_close()?>
    </div>
</div>