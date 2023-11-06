
<div class="row">
    <div class="col-md-4 col-centered">
        <h1 class="web-login-txt">Forgot Password?</h1>


        <?php if(isset($msg)){
            echo "<p>".$msg."</p>";
        }else{
            echo "<p>Fill in your email address.<br>
We will provide a link by email to reset your password.</p>";


            if(!empty($errorSms)){
                echo '<h5 style="color:red;">'.$errorSms.'</h5>';
            }

        ?>



        <div class="web-login">
            <form action="" method="post">
                <div class="form-group">
                    <label class="weblogin-label">Email Address</label>
                    <!-- <input type="text" class="form-control round-0 weblogin-text" id="" placeholder="Username">-->

                    <input name="username" type="email" class="form-control round-0 weblogin-text">
                    <span class="col-sm-12 red">  <?php echo  form_error('username')?> <?php echo  isset($errors['username'])?$this->lang->line($errors['username']):"";?> </span>
                </div>


                <div class="btn-weblogin-holder">
                    <button type="submit" class="btn-web-login">Submit</button>
                    <a href="<?=FXPP::ajax_url()?>"><button type="button" class="btn-web-cancel">Cancel</button></a>
                </div>
            </form>

        </div>

        <?php }?>

    </div>
</div>




