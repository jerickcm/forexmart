

<div class="reg-form-holder">
    <div class="container">
        <div class="row customrow">
                <div id=registerform" class="col-md-8 col-centered "">
                    <?= form_open('confirm/forexmart_landing',array('id' => 'confirmForm','class'=> ''),''); ?>
                            <div class="form-group">
                                <div class="validation-result" id="validation-result">
                                    <?php
                                    if(validation_errors()){
                                        echo '<div class="alert alert-danger">';
                                        echo validation_errors();
                                        echo '</div>';
                                    }
                                    if (!empty($custom_validation)){
                                        echo '<div class="alert alert-danger">';
                                        echo $custom_validation;
                                        echo '</div>';
                                    }
                                    if (!is_null($custom_validation_web)){
                                        echo '<div class="alert alert-danger">';
                                        echo $custom_validation_web;
                                        echo '</div>';
                                    }
                                    if(!empty($custom_validation_success)){
                                        echo '<div class="alert alert-success">';
                                        echo $custom_validation_success;
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php if(!is_null($custom_validation_success)){ ?>

                                <div class="form-group">
                                    <div class="col-md-8 col-centered "">
                                        <p ><h3 class="header"><b>ForexMart Demo Account</b></h3></p>
                                        <p>Your demo account is opened.</p>
                                        <br/>
                                        <p><b>Account number:</b> <?=$AccountNumber;?></p>
                                        <p><b>Trader password:</b> <?=$trader_password;?></p>
                                        <p><b>Investor password:</b> <?=$investor_password;?></p>
                                        <p>Your login and password have also been sent to your email address.Note that your password and login will work with MetaTrader 4 only.</p>
                                    </div>
                                </div>

                            <?php }else{?>

                                <div class="form-group">
                                        <h3>
                                            Confirm Email Address
                                        </h3>
                                        <p>
                                            To complete the registration, please enter the confirmation code below
                                        </p>
                                </div>

                                <div class="form-group">
                                    <?php $attributes = array('class' => 'col-sm-3 control-label contest-label ccode'); ?>
                                    <?= form_label('Confirmation Code:', 'Confirmation Code', $attributes); ?>
                                    <div class="col-sm-5">
                                        <?php $data = array(
                                            'name' => 'ConfirmationCode',
                                            'id' => 'ConfirmationCode',
                                            'type' => 'text',
                                            'maxlength' => '100',
                                            'class' => 'form-control round-0',
                                            'placeholder' => '',
                                        ); ?>
                                        <?= form_input($data); ?>
                                     </div>
                                    <div class="col-sm-4 Code">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-8 custombtnh">
                                        <?php
                                            $data = array(
                                                'name'          => 'button',
                                                'id'            => 'button',
                                                'value'         => 'true',
                                                'type'          => 'Submit',
                                                'content'       => 'Submit',
                                                'class'=>'btn-holder custombtn achievecenter'
                                            );
                                        ?>
                                        <?= form_button($data); ?>
                                    </div>

                                </div>

                            <?php }?>
                    <?= form_close()?>
                 </div>

        </div>
    </div>
</div>
<style type="text/css">
    .btn-holder{
        color: #FFF;
        font-family: Open Sans;
        font-size: 17px;
        font-weight: 600;
        background: #2988CA none repeat scroll 0% 0%;
        padding: 10px 25px;
        transition: all 0.3s ease 0s;
    }
    .customrow{
        margin: 50px auto;
    }
    .ccode{
        padding-top: 5px;
    }
    .error {
        color: #F00;
        font-weight: normal !important;
    }
    .custombtnh{
        padding: 0px;
        text-align: right;
        padding-right: 13px;
    }
    .custombtn{
        width: 200px;
    }
    #ConfirmationCode-error{
        padding-top: 5px;
    }
    .achievecenter{
        text-align: center!important;
    }
</style>
<script type='text/javascript'>
    var pblc = [];
    var site_url="<?=FXPP::loc_url('')?>";

    $().ready(function() {

            pblc['confirmForm'] = $('#confirmForm').validate({
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "ConfirmationCode" )
                        error.insertAfter(".Code");
                },
                rules:{
                    ConfirmationCode:{required : true, number: true,minlength: 6}
                },
                messages: {
                }, submitHandler: function(form) {
                    form.submit();
                }
        });

    });

</script>
