<?php 
//$this->load->library('IPLoc'); 
// if(IPLoc::Office() && isset($deactivated)){ 
//     print_r($deactivated); exit;
// }
?>
<div class="row">
    <div class="col-md-5 col-centered bottom-space">
        <h1 class="web-login-txt">Login to your Account</h1>
        <span class="triangle-right"></span>
        <span class="triangle-left"></span>
        <?= form_open('signin',array('id' => 'form_login','class'=> 'weblogin'),''); ?>
        <div class="web-login">
            <img src="<?= $this->template->Images()?>web-login-avatar.png" class="img-responsive web-login-avatar">
            <div class="weblogin">
                <div class="form-group">
                    <!-- <input type="text" class="form-control round-0 weblogin-text" id="" placeholder="Username">-->
                    <?php echo form_input($username);?>
                    <span class="col-sm-12 red">  <?php echo  form_error('username')?> <?php echo  isset($errors['username'])?$this->lang->line($errors['username']):"";?> </span>
                </div>
                <div class="form-group">
                    <?php echo form_input($password);?>
                    <span class="col-sm-12 red">  <?php echo  form_error('password')?> <?php echo  isset($errors['password'])?$this->lang->line($errors['password']):"";?></span>
                    <!-- <input type="password" class="form-control round-0 weblogin-text" id="" placeholder="Password">-->
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Keep me logged in
                    </label>
                    <a href="<?=FXPP::ajax_url('forgot-password');?>" class="password-link">Forgot Password?</a>
                </div>
            </div>
        </div>
        <div class="weblogin-footer">
            <button type="submit" class="btn-web-login login-style1">Login <i class="fa fa-arrow-right"></i></button>
        </div>
        <?php echo form_close()?>

        <!-- STAR MODAL DISABLED/DEACTIVATED ACCOUNT-->

            <div id="modal" style="display: none">
                <div id="heading">
                    Deactivated Account
                </div>
                <div id="content">
                    <p>Please contact your system administrator to reactivate your account.</p>
                </div>
            </div>

        <!-- END MODAL DISABLED/DEACTIVATED ACCOUNT -->

    </div>
</div>

<!-- JS AND CSS OF MODAL DISABLED/DEACTIVATED ACCOUNT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="<?= $this->template->Js()?>jquery.reveal.js"></script>
<link href="<?= $this->template->Css()?>modal-style.css" rel="stylesheet">

<script type="text/javascript">
    <?php if (isset($deactivated) && ($deactivated=='deactivated') ): ?>
        //console.log("deactivated");
        $(document).ready(function(){
            //console.log("aw21");
            $('#modal').css('display','block');
            $('#modal').reveal({ // The item which will be opened with reveal
               animation: 'fade',                   // fade, fadeAndPop, none
               animationspeed: 600,                       // how fast animtions are
               closeonbackgroundclick: true,              // if you click background will modal close?
               dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
           });
        });
    <?php endif; ?>
</script>