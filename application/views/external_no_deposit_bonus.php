<div class="reg-form-holder">
    <div class="container">
        <div class="row">
               <div class="col-md-7 col-centered ndb-bg1">
                   <h1 class="info-text ndb-title">No Deposit Bonus Registration</h1>

                    <div class="form-holder ndb-holder1">
                    <form id="register" action="" method="post" class="form-horizontal">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-4 col-sm-4 col-xs-12 control-label">Full Name</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">

                                <input name="full_name" type="text" class="form-control round-0" placeholder="Full Name" value="<?=set_value('full_name');?>"/>
                                <span class="red"><?=form_error('full_name')?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-4 col-sm-4 col-xs-12 control-label">Email</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">

                                <input name="email" type="text" class="form-control round-0" placeholder="Email" value="<?=set_value('email');?>"/>
                                <span class="red"><?=form_error('email')?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-4 col-sm-4 col-xs-12 control-label">Account Currency</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">

                                <select class="form-control round-0 required" name="mt_currency_base" id="mt_currency_base">
                                    <option value="">Select</option>
                                    <?php echo $account_currency_base;?>
                                </select>
                                <span class="red"><?=form_error('mt_currency_base')?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-offset-4 col-sm-8">
                                <div class="checkbox float-left">
                                    <label>
                                        <input id="agree-checkbox" type="checkbox"> Accept <a href="<?= $this->config->item('domain-www');?>/terms-and-conditions">Terms and Conditions</a>
                                    </label>
                                </div>
                                <button type="button" class="btn-sign" id="complete_btn">Register</button>
                                <div class="clearfix"></div>
                                <div class="blue-line"></div>
                                <div class="nbd-signin-holder">
                                    <p>Already registered?</p>
                                   <a href="<?= $this->config->item('domain-my');?>"> <button type="button" class="ndb-signin">Sign In</button></a>
                                </div>
                            </div>
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


<?php  $this->load->view('layouts/external/feats_holder.php');?>

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

<style>
    .left-bonus-container, .right-bonus-container {
        height: auto;
        margin: 70px 0;
    }
    .bonus-child-container {
        margin: 10px auto;
        display: table;
    }
    .terms-conditions-information {
        margin-left: 5px;
    }
    .bonus-child-container input[type=checkbox], .terms-conditions-information {
        float: left;
    }
    .red p{font-size: 14px}

    .ndb-bg1
    {
        padding-top: 30px;
        background: url(assets/images/ndb-bg.jpg) no-repeat;
        height: 500px;
    }
    .nbd-signin-holder1
    {
        margin-top: 20px;
    }
    .nbd-signin-holder1 p
    {
        font-size: 14px;
        font-family: Open Sans;
        font-weight: 600;
        color: #333;
    }
    .ndb-signin
    {
        border: 1px solid #29a643;
        color: #29A643;
        font-size: 14px;
        font-family: Open Sans;
        font-weight: 400;
        padding: 7px 32px;
        background: none;
        transition: all ease 0.3s;
    }
    .ndb-signin:hover
    {
        background: #29a643;
        color: #fff;
        transition: all ease 0.3s;
    }

    .info-text {
        font-size: 25px;
        text-align: center;
        margin-top: 40px!important;
    }
    .form-holder {
         text-align: left!important;
    }

</style>

<script>
    $(document).on("click","#complete_btn",function(){

        if($("#agree-checkbox").is(':checked')){
            $("#register").submit();
        }else{
            alert("You need to agree with the terms of Service.");
        }
    })
</script>