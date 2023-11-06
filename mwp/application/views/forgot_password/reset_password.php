
<div class="row">
    <div class="col-md-4 col-centered">
        <h1 class="web-login-txt">Reset password</h1>
        <?php
            if(isset($msg)){
                echo "<p>".$msg."</p>";
                echo "<a class='btn-web-login' href='".FXPP::ajax_url()."'> login</a>";
            }else{
        ?>
        <div class="web-login">
            <form action="" method="post">

                <div class="form-group">
                    <label class="weblogin-label">Username</label>


                    <input readonly  type="text" class="form-control round-0 weblogin-text" value="<?=$username?>">

                </div>
                <div class="form-group">
                    <label class="weblogin-label">New Password</label>
                    <!-- <input type="text" class="form-control round-0 weblogin-text" id="" placeholder="Username">-->

                    <input name="password" type="password" class="form-control round-0 weblogin-text">
                    <span class="col-sm-12 red">  <?php echo  form_error('password')?> </span>
                </div>
                <div class="form-group">
                    <label class="weblogin-label">Confirm Password</label>
                    <!-- <input type="text" class="form-control round-0 weblogin-text" id="" placeholder="Username">-->

                    <input name="re_password" type="password" class="form-control round-0 weblogin-text">
                    <span class="col-sm-12 red">  <?php echo  form_error('re_password')?> </span>
                </div>


                <div class="btn-weblogin-holder">
                    <button class="btn-web-cancel">Cancel</button>
                    <button type="submit" class="btn-web-login">Reset password</button>
                </div>
            </form>

        </div>
        <?php }?>

    </div>
</div>




