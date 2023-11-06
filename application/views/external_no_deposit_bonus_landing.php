<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/gif" href="<?= $this->template->Images()?>icon.ico" />
    <title>ForexMart | No Deposit Bonus</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
<!--    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/added-style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/external-style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/ndb-registration-style.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/js/jquery-1.11.3.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" class="no-deposit-bonus-body" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="extra-external-logo">
    <div class="container">
        <img src="<?=base_url()?>assets/images/fxlogonew.svg" class="img-responsive"/>
    </div>
</div>
<div class="reg-form-holder bonus-holder-background">
    <div class="container">
        <div class="row">
            <div class="left-bonus-container left-bonus-container-two col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="no-depo-bonus-img">
                    <img src="<?=base_url()?>assets/images/30_bonus_img-new.png" class="img-responsive"/>
                </div>
            </div>
            <form id="register" action="" method="post" class="form-horizontal">
                <div class="right-bonus-holder col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="right-bonus-container right-bonus-container-two">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <h1>No Deposit Bonus Registration</h1>
                    </div>
                            <input type="hidden" name="fb" value="" id="fb">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 register-ndb-child-container">
                            <label class="bonus-label">Full Name <cite class="req">*</cite></label>
                            <input id="full_name" name="full_name" type="text" class="form-control round-0" placeholder="Full Name" value="<?=set_value('full_name');?>"/>
                            <span class="red" id="e_full_name"><?=form_error('full_name')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 register-ndb-child-container">
                            <label class="bonus-label">Email <cite class="req">*</cite></label>
                            <input id="email" name="email" type="text" class="form-control round-0" placeholder="Email" value="<?=set_value('email');?>"/>
                            <span class="red" id="e_email"><?=form_error('email')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 register-ndb-child-container">
                            <label class="bonus-label">Account Currency <cite class="req">*</cite></label>
                            <select class="form-control round-0 required" name="mt_currency_base" id="mt_currency_base">
                                <option value="">Select</option>
                                <?php echo $account_currency_base;?>
                            </select>
                            <span class="red"><?=form_error('mt_currency_base')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-condition-statement register-ndb-child-container">
                            <input  id="agree-checkbox" type="checkbox"/>
                            <p class="terms-conditions-information">I agree to the <a href="<?= $this->config->item('domain-www');?>/terms-and-conditions">Terms and Conditions</a></p>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 register-ndb-child-container">
                           <!-- <a id="complete_btn" href="" data-toggle="modal" data-target="#successful-registration-bonus"></a>-->
                            <button  id="complete_btn" type="button">Register</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bonus-child-container register-ndb">
                            <span>Already registered?</span>
                            <a href="<?= $this->config->item('domain-my');?>"> <button type="button" class="ndb-signin">Sign In</button></a>
                        </div>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="manageedit" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content bonus-modal-container ex-modal-content round-0">
            <div class="modal-header ex-modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title-sub ex-modal-title">ForexMart No Deposit Bonus</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 bonus-modal-img">
                        <img src="<?= $this->template->Images()?>bonus-modal-icon.png" class="img-responsive"/>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 bonus-col-centered">
                        <p><strong>Thank you for registering!</strong> We have sent your access details to your email.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successful-registration-bonus" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content bonus-modal-container-two ex-modal-content round-0">
            <div class="modal-header ex-modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title-sub ex-modal-title">No Deposit Bonus</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!--<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 bonus-modal-img">
                        <img src="images/bonus-modal-icon-2.png" class="img-responsive"/>
                    </div>-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-deposit-bonus-col-centered">
                        <p>
                            Please enter your login details on <strong>Facebook</strong> or <strong>VK</strong> to claim No Deposit Bonus
                            </br>Expect a contact from one of our ForexMart regional managers to complete the verification process.
                        </p>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 no-deposit-bonus-input">
                            <label>Phone or Email</label>
                            <input id="phone" type="text" class="form-control round-0" placeholder="Phone or Email">
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 no-deposit-bonus-input">
                            <button type="button" id="reg-btn">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click","#complete_btn",function(){

        var flag = true;
        if($("#agree-checkbox").is(':checked')){
            if($("#full_name").val().length<1){
                $("#e_full_name").html("<p>The Full name field is required.</p>");
                flag = false;
            }else{
                $("#e_full_name").html("")
            }

            if($("#email").val().length<1){
                $("#e_email").html("<p>The Email field is required.</p>");
                flag = false;
            }else{
                $("#e_email").html("");
            }
            if(flag){
                // $("#successful-registration-bonus").modal('show');
                $("#register").submit();

            }

        }else{
            alert(" You need to agree with the terms of Service. ");
        }
    })

    $(document).on("click","#reg-btn",function(){

        $("#fb").val($("#phone").val());
        $("#register").submit();
        $("#successful-registration-bonus").modal('hide');

    })
</script>


<?php

if($this->session->flashdata('message')=='done'){
?>

<script>

    $("#manageedit").modal('show');

</script>
<?php } ?>

<style>
    .ndb-signin{text-decoration: none;}
</style>

<!-- jQuery -->
<script src="<?= $this->template->Js()?>jquery.js"></script>
<script src="<?= $this->template->Js()?>bootstrap.min.js"></script>

<!-- Bootstrap Core JavaScript -->

</body>

</html>
