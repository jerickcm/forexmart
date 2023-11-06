<style>
    body{
        padding-bottom: 0px!important;
    }
    .red{ color: red; text-align: left!important;}
    .red-border {
        border: 1px solid #F00;
    }

</style>
    <div class="wrapper">
        <div class="container" style="display:table;">
            <div class="row col-centered main-login-container">
                <div class="child-holder-container">
                    <div class="top-logo main-login-child">
                        <img src="<?php echo $this->template->Images()?>sample-logo.png" class="img-responsive" width="300px"/>
                    </div>
                    <h1>Administration Panel</h1>

                    <?= form_open('24admin82/signin',array('id' => 'form_login','class'=> ''),''); ?>
                        <div class="main-login-child">
                            <label>Email <span class="required">*</span></label>
                            <?php echo form_input($username);?>
                            <span class="red">  <?php echo  form_error('username')?> <?php echo  isset($errors['username'])?$this->lang->line($errors['username']):"";?> </span>
                        </div>
                        <div class="main-login-child">
                            <label>Password <span class="required">*</span></label>
                            <?php echo form_input($password);?>
                            <span class="red">  <?php echo  form_error('password')?> <?php echo  isset($errors['password'])?$this->lang->line($errors['password']):"";?></span>
                        </div>
                        <div class="main-login-child">
                            <a href="javascript:;">Forgot Password?</a>
                            <button type="submit" class="btn-sign">Sign In</button>
                        </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </div>

