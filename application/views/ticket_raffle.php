<?php if(IPLoc::Office()){?>
    <link rel="stylesheet" href="<?= $this->template->Css()?>tiket-raffle-office.css">
    <!--CONTENT-->
    <div class="vip-main-holder">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="vip-msg">
                        <?=lang('xtr_1');?>
                    </p>
                    <img src="<?= $this->template->Images()?>vip-logos.png" class="img-responsive winner-img vip-logos" alt="" />
                    <div class="clearfix"></div>
                    <!-- <a href="#" class="btn-vip-trading">Start Trading Now</a> -->
                </div>
                <div class="col-md-4">
                    <img src="<?= $this->template->Images()?>jvaleron.png" class="img-responsive valeron-img" alt="" />
                </div>
            </div>
        </div>
    </div>
    <div class="vip-content-holder">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="vip-title"><?=lang('xtr_2');?></h1>
                </div>
                <div class="col-md-3">
                    <div class="winner-img-holder">
                        <img src="<?= $this->template->Images()?>vip-winner-img.png" class="img-responsive winner-img" alt="" />
                    </div>
                </div>
                <div class="col-md-9 vip-col-9">
                    <div class="vip-winner-text">
                        <p>
                            <?=lang('xtr_3');?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <a href="<?=FXPP::www_url('register')?>" class="btn-vip-trading"><?=lang('xtr_4');?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

<?php }else{?>


<div class="raffle-banner-holder">
    <div class="container">
        <div class="row banner-content-holder">
            <div class="col-md-12">
                <h1 class="raffle-title ext-arabic-raffle-title">
                    <?=lang('x_tr_0');?>

                </h1>
            </div>
            <div class="col-lg-4 col-sm-6 raf">
                <p class="raffle-text fs font-light">
                    <?=lang('x_tr_1');?>

                    <span>
                        <?=lang('x_tr_2');?>
                    </span>
                    <?=lang('x_tr_3');?>
                </p>
                <p class="raffle-text font-bold">
                    <?=lang('x_tr_4');?>
                </p>
                <a href="#" class="raffle-reg ext-arabic-raffle-button">
                    <?=lang('x_tr_5');?>
                </a>
                <p class="raffle-text font-bold ext-arabic-raffle-text-clear">
                    <?=lang('x_tr_6');?>
                </p>
                <a href="#" class="raffle-plogin-reg ext-arabic-raffle-button" data-toggle="modal" data-target="#raffle-login">
                    <?=lang('x_tr_7');?>
                </a>
            </div>
            <div class="col-lg-8 col-sm-6 banner-img-holder rafimg">
                <img src="<?= $this->template->Images()?>raffle-img.png" class="img-responsive" alt="" />
            </div>
            <div class="col-md-12">
                <p class="raffle-text ext-arabic-raffle-text-content">
                    <?=lang('x_tr_8');?>
                </p>
                <h2 class="raffle-title-sub ext-arabic-raffle-title-sub">
                    <?=lang('x_tr_9');?>
                </h2>
                <ol class="mechanics-list">
                    <li><span>
                            <?=lang('x_tr_10');?>
                        </span></li>
                    <li><span>
                            <?=lang('x_tr_11');?>
                        </span></li>
                    <li><span>
                            <?=lang('x_tr_12');?>
                        </span></li>
                    <li><span>
                            <?=lang('x_tr_13');?>
                        </span></li>
                    <li><span>
                            <?=lang('x_tr_14');?>
                        </span></li>
                    <li><span>
                            <?=lang('x_tr_15');?>
                        </span></li>
                    <li><span>
                            <?=lang('x_tr_16');?>
                        </span></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php }?>

<!-- modal -->
<div class="modal fade" id="raffle-login" tabindex="-1" data-backdrop="static" role="dialog"  style="display: none !important;">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">
                    Ticket Raffle
                </h4>
            </div>
            <div class="modal-body modal-show-body raffle-bg">
                <div class="row">


                    <?php
                    $success = $this->session->flashdata("success");
                    $alreadyRegistered= $this->session->flashdata("already-registered");

                    if(!isset($alreadyRegistered)){
                        if(!isset($success))
                        {
                            ?>
                            <div class="col-md-7 col-centered">
                                <form method="post" id="ticket-raffle-form">
                                    <?php
                                    if(validation_errors()){
                                        echo '<div class="bg-danger">';
                                        echo validation_errors();
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label">Username:</label>
                                        <input type="text" value="<?php echo set_value('username');?>" class="form-control round-0 <?php echo isset($errors['username']) ? "border-color-red" : "";?>" name="username" placeholder="Username">
                                        <span class="signin-red"><p><?php echo  form_error('username')?> <?php echo  isset($errors['username']) ? $errors['username'] : "";?> </p> </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password:</label>
                                        <input type="password" value="<?php echo set_value('password');?>" class="form-control round-0 <?php echo isset($errors['password']) ? "border-color-red" : "";?>" name="password" placeholder="Password">
                                        <span class="signin-red"><p><?php echo  form_error('password')?> <?php echo isset($errors['password']) ? $errors['password'] : "";?> </p> </span>
                                    </div>
                                    <div class="form-group align-right">
                                        <button type="submit" class="btn btn-primary round-0">Submit</button>
                                    </div>
                                </form>
                            </div>
                        <?php }else{ ?>
                            <div class="col-md-7 col-centered">
                                <div class="form-group" style="margin: 80px 0px !important;">
                                    <h1 style="text-align: center;">Thank you</h1>
                                </div>
                            </div>
                        <?php } ?>
                    <?php }else{ ?>
                        <div class="col-md-8 col-centered">
                            <div class="form-group" style="margin: 80px 0px !important;">
                                <h1 style="text-align: center;">Sorry! Only 1 Raffle Entry for each client.</h1>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="modal-footer round-0">
                <p class="login-footer">Don't have an account? <a href="#">Register here</a></p>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style type="text/css">.signin-red {color:red;}.border-color-red{border-color: red;}</style>');
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        if(showModal){
            $('#raffle-login').modal();
        }
    });
</script>