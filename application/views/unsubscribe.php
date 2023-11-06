<style type="text/css">
    div.unsubscribe-mail p{
        color: red;
    }
    .license-text .modify-spacing:lang(pl){
        word-spacing: 7px;
    }
</style>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <h1 class="license-title">
                    <!-- Unsubscribe from Mailing -->
                      <?=lang('unsubs1');?>
                </h1>
                <p class="license-text modify-spacing">
                    <!-- To unsubscribe from Mailing list, please verify if the email is correct and click on unsubscribe. -->
                      <?=lang('unsubs2');?>
                </p>
                <?php
                $flash = $this->session->flashdata("success");
                if(!isset($flash))
                {  ?>
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-10 unsubscribe-mail">
                                <input value="<?php echo $unsubscribe_email;?>" name="email" class="form-control round-0 <?php echo form_error('email')?"red-border":""?> " readonly>
                                <?php echo form_error('email');?>
                            </div>
                        </div>
                      
                        <button type="submit" class="btn-login">
                        <?=lang('unsubs3');?>
                        <!-- Unsubscribe -->
                        </button>
                    </form>
                <?php }else{ ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check-circle"></i> <?=lang('unsubs4');?>
                        <!-- You successfully unsubscribed from the newsletter. Thank you. -->
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


