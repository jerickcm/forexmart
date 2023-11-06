
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FX Site</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
<!--    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>added-style.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>external-style.css" rel="stylesheet">
    <script src="<?= $this->template->Js()?>jquery-1.11.3.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" class="percent-bonus" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="extra-external-logo">
    <div class="container">
        <img src="<?= $this->template->Images()?>fxlogonew.svg" class="img-responsive"/>
    </div>
</div>
<div class="reg-form-holder bonus-holder-background">
    <div class="container">
        <div class="row">
            <div class="left-bonus-container col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="bonus-img">
                    <img src="<?= $this->template->Images()?>30_bonus_img.png" class="img-responsive"/>
                </div>
            </div>
            <div class="right-bonus-holder col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="right-bonus-container">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <h1>ForexMart 30% Bonus</h1>
                    </div>
                    <form id="register" action="" method="post" class="form-horizontal">

                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container">
                            <label class="bonus-label">Full Name <cite class="req">*</cite></label>
                            <input name="full_name" type="text" class="form-control round-0" placeholder="Full Name" value="<?=set_value('full_name');?>"/>
                            <span class="red"><?=form_error('full_name')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container">
                            <label class="bonus-label">Email <cite class="req">*</cite></label>
                            <input name="email" type="text" class="form-control round-0" placeholder="Email" value="<?=set_value('email');?>"/>
                            <span class="red"><?=form_error('email')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container">
                            <label class="bonus-label">Account Currency <cite class="req">*</cite></label>
                            <select class="form-control round-0 required" name="mt_currency_base" id="mt_currency_base">
                                <option value="">Select</option>
                                <?php echo $account_currency_base;?>
                            </select>
                            <span class="red"><?=form_error('mt_currency_base')?></span>
                        </div>

                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container bonus-condition-statement">
                            <input id="agree-checkbox" type="checkbox"/>
                            <p class="terms-conditions-information">I agree to the <a href="<?= $this->config->item('domain-www');?>/terms-and-conditions">Terms and Conditions</a></p>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bonus-child-container">
                            <button class="btn-submit" id="complete_btn" type="button" >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="manageedit" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content bonus-modal-container ex-modal-content round-0">
            <div class="modal-header ex-modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title-sub ex-modal-title">ForexMart 30% Bonus</h4>
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

<?= //$this->load->ext_view('modal', 'landing_register_restrict', '', TRUE); ?>

<!-- jQuery -->


<!-- Bootstrap Core JavaScript -->
<script src="<?= $this->template->Js()?>bootstrap.min.js"></script>


<?php

 if($this->session->flashdata('message')=='done'){
     ?>

     <script>

             $("#manageedit").modal('show');

     </script>


<?php
 }

?>

<style type="text/css">
    .red p{font-size: 14px}
</style>

<script type="text/javascript">
    $(document).on("click","#complete_btn",function(){
        <?php if(!$allowed_country) { ?>
            $('#btnRestrictOk').click( checkForm );
            $('#register_restrict').modal('show');
        <?php }else{ ?>
            checkForm();
        <?php } ?>
    });

    function checkForm(){
        if($("#agree-checkbox").is(':checked')){
            $("#register").submit();
        }else{
            alert(" You need to agree with the terms of Service. ");
            <?php if(!$allowed_country) { ?>
            $('#register_restrict').modal('hide');
            <?php } ?>
        }
    }
</script>

</body>

</html>
