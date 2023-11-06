<style>
    .red{ color: red; text-align: left!important;}
</style>
<div class="reg-form-holder">
    <div class="container">
        <div class="row col-centered">
            <h1 class="info-text">Sign in to my FX Account</h1>
            <div class="col-lg-3 col-md-3 ">  </div>

            <div class="col-lg-8 col-md-8">

                <div class="form-holder" >

                    <?= form_open('Signin',array('id' => 'form_login','class'=> 'form-horizontal'),$output_key); ?>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email<cite class="req">*</cite></label>
                            <div class="col-sm-6">
                                <?php echo form_input($username);?>
                            </div>
                            <span class="col-sm-4 red">  <?php echo  form_error('username')?> <?php echo  isset($errors['username'])?$this->lang->line($errors['username']):"";?> </span>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password<cite class="req">*</cite></label>
                            <div class="col-sm-6">
                                <?php echo form_input($password);?>
                            </div>
                            <span class="col-sm-4 red">  <?php echo  form_error('password')?> <?php echo  isset($errors['password'])?$this->lang->line($errors['password']):"";?></span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <a href="#" class="forgot">Forgot password?</a>
                                <button type="submit" class="btn-sign">Sign In</button>
                                <div class="clearfix"></div>
                                <div class="blue-line"></div>
                            </div>
                        </div>

                    <?php echo form_close()?>

                        <div class="form-group">
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-6" style="padding: 0;">
                                <label class="control-label" style="float: left; font-size: 25px; font-family: Open Sans; font-weight: 400; margin-left: 14px; margin-bottom: 15px;">New to FX?</label>
                                <div class="clearfix"></div>
                                <a href="<?php echo base_url()?>register" class="col-sm-6">
                                    <button class="btn-real">Open a Real Account</button>
                                </a>

                                    <a href="<?php echo base_url()?>register/demo" class="col-sm-6">
                                    <button class="btn-demo">Open a Demo Account</button>
                                        </a>

                            </div>

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
