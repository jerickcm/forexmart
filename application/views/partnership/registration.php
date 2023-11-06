<div class="reg-form-holder">
    <div class="container">
        <div class="aff-reg-holder">
            <h1><?=lang('xnv_Parreg')?></h1>

            <?php
            $flash = $this->session->flashdata("success");
            if(!isset($flash)) {
            ?>

            <p class="license-text"><?=lang('x_p_p1-0')?> <a href="#"><?=lang('x_p_p1-1')?></a> <?=lang('x_p_p1-2')?></p>
            <div class="row">
                <?= $this->load->ext_view('modal', 'reglimitprompt_p', '', TRUE); ?>
                <form method="post" id="partnership_registration">
                    <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                    <div class="col-md-4 col-sm-4">
                        <div class="input-group ig">
                            <select class="inp-first-val form-control round-0 margin-ref select-box <?php echo (form_error('status_type') == "") ? "" : "red-border";?>" name="affiliate_type" id="affiliate_type">
                                <option value="">* <?=lang('x_pr_00')?></option>
                                <option value="friend-referrer"><?=lang('xnv_Frrefe')?></option>
                                <option value="webmaster"><?=lang('xnv_Web')?></option>
                                <option value="online-partner"><?=lang('xnv_Onpar')?></option>
                                <option value="local-online-partner"><?=lang('xnv_Loonpa')?></option>
                                <option value="local-office-partner"><?=lang('xnv_Loofpa')?></option>
                                <option value="cpa"><?=lang('xnv_cpa')?></option>
                            </select>

                            <div class="error_p" id="error_affiliate_type"><p><?php echo form_error('affiliate_type'); ?></div>

                        </div>
                        <div class="input-group ig">
                            <?php
                            $error_s = (form_error('status_type') == "") ? "" : "red-border";
                            $attr = 'id="status_type" class="select-box inp-first-val form-control round-0 margin-ref '.$error_s.'"';
                            //if(IPLoc::Office()){
                                $stats_typ = array_merge(array('' => lang('partnershipstatus_1') ), FXPP::getPartnersStatusType());
                            //}else{
                                //$stats_typ = array_merge(array('' => '* Status'), FXPP::getPartnersStatusType());
                            //}

                            $selectedStatus = $this->input->post('status_type');
                            $set_value = isset($selectedStatus)?$selectedStatus:false;
                            ?>
                            <?php echo form_dropdown('status_type',$stats_typ,$selectedStatus,$attr);?>
                            <?php if(IPLoc::Office()){?>
                                <div class="error_p" id="error_status_type"><?php echo form_error('status_type'); ?></div>
                            <?php }else{ ?>
                                <div class="error_p" id="error_status_type"><?php echo form_error('status_type'); ?></div>
                            <?php }?>

                        </div>
                        <div class="input-group ig company-field">
                            <input type="text" name="company_name" id="company_name" value="<?php echo set_value('company_name');?>" class="latin inp-company-field form-control round-0 margin-ref <?=(form_error('company_name') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_01')?>"/>
                            <div class="error_p" id="error_company_name"><?php echo form_error('company_name'); ?></div>
                        </div>
                        <div class="input-group ig company-field">
                            <input type="text" name="registration_number" id="registration_number" value="<?php echo set_value('registration_number');?>" class="latin inp-company-field form-control round-0 margin-ref <?=(form_error('registration_number') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_02')?>"/>
                            <div class="error_p" id="error_registration_number"><?php echo form_error('registration_number'); ?></div>
                        </div>
                        <div class="input-group ig company-field">
                            <input type="text" name="date_of_inc" id="date_of_inc" value="<?php echo set_value('date_of_inc');?>" class="latin inp-company-field datepicker form-control round-0 margin-ref <?=(form_error('date_of_inc') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_03')?>"/>
                            <div class="error_p" id="error_date_of_inc"><?php echo form_error('date_of_inc'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname');?>" class="inp-first-val form-control round-0 margin-ref <?=(form_error('fullname') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_04')?>" />
                            <div class="error_p" id="error_fullname"><?php echo form_error('fullname'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="email" name="email" id="email" value="<?php echo set_value('email');?>" class="latin_email inp-first-val form-control round-0 margin-ref <?=(form_error('email') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_05')?>"/>
                            <div class="error_p" id="error_email"><?php echo form_error('email'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="hidden" name="phone_code" value="<?php echo $calling_code ?>" />
                            <input type="text" name="phone_number" id="phone_number" value="<?php echo $calling_code;?>" class="latin_phone inp-first-val form-control round-0 margin-ref <?=(form_error('phone_number') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_06')?>"/>
                            <div class="error_p" id="error_phone_number"><?php echo form_error('phone_number'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="text" name="skype" id="skype" class="latin_skype form-control round-0 margin-ref" placeholder="Skype"/>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">

                        <?php if($is_mobile['is_mobile']){ ?>
                            <input type="hidden" name="currency" value="<?php echo $is_mobile['currency']; ?>" />
                        <?php }else{ ?>
                            <div class="input-group ig">
                                <?php
                                $error_c = (form_error('currency') == "") ? "" : "red-border";
                                $attr = 'id="currency" class="select-box inp-first-val form-control round-0 margin-ref '.$error_c.'"';
                                ?>
                                <?= form_dropdown('currency',$currency,$is_mobile['currency'],$attr);?>
                                <div class="error_p" id="error_currency"><?php echo form_error('currency'); ?></div>
                            </div>
                        <?php } ?>
                        <div class="input-group ig">
                            <?php $error_c = (form_error('country') == "") ? "" : "red-border"; ?>
                            <select id="country" name="country" class="inp-first-val form-control round-0 margin-ref ext-arabic-form-control-select-text <?php echo $error_c; ?>" >
                                <?php echo $countries; ?>
                            </select>
                            <div class="error_p" id="error_country"><?php echo form_error('country'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <?php
                            $error_tc = (form_error('country') == "") ? "" : "red-border";
                            $attr = 'id="target_country" class="select-box inp-first-val form-control round-0 margin-ref '.$error_tc.'"';
                            if(IPLoc::Office()){
                                $countries = array_merge(array('' => '* ' . lang('target')), FXPP::getAllCountries_localize());
                            }else{
                                $countries = array_merge(array('' => '* ' . lang('target')), FXPP::getCountries());
                            }
                            $target_country = $this->input->post('target_country');
                            $set_value = isset($target_country)?$target_country:false;
                            ?>
                            <?php echo form_dropdown('target_country',$countries,$set_value,$attr);?>
                            <div class="error_p" id="error_target_country"><?php echo form_error('target_country'); ?></div>
                        </div>
                        <div class="input-group ig margin-ref">
                            <input type="text" class="latin_website websites form-control round-0 <?=(form_error('websites[]') == '') ? '' : 'red-border';?>" name="websites[]" placeholder="<?=lang('x_pr_07')?>">
                            <div class="input-group-addon round-0"><a id="addWebsite"><i class="fa fa-plus"></i></a></div>
                        </div>
                        <ul id="ulwebname"></ul>
                        <i style="font-size: 13px;"><?=lang('x_pr_08')?> (http://, https://, ftp://).</i>

                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="input-group ig">
                            <textarea id="message" name="message" class="latin form-control round-0 margin-ref <?=(form_error('message') == '') ? '' : 'red-border';?>" rows="6" placeholder="<?=lang('x_pr_09')?>"><?php echo set_value('message');?></textarea>
                        </div>
                        <div class="input-group ig">
                            <label class="agreement" style="font-weight: normal;">
                                <input id="agree-checkbox" type="checkbox">  <?=lang('agreeterms')?>
                                    <?php 
                                        switch(FXPP::html_url()){
                                            case 'id':
                                                $pdffile = $this->template->pdf().'PA/ID_ForexMartPartnershipAgreement.pdf';
                                                break;
                                            case 'ru':
                                                $pdffile = $this->template->pdf().'PA/RU_ForexMartPartnershipAgreement.pdf';
                                                break;
                                            default:
                                                $pdffile = $this->template->pdf().'PA/EN_ForexMartPartnershipAgreement.pdf';
                                                break;
                                        }
                                     ?>
                                    <a href="<?php echo $pdffile; ?>"  target="_blank" >
                                    <?=lang('terms_prtnshp')?></a>
                                                 <!-- <?php if(FXPP::html_url()=='ru'){ ?>
                                                    <a href="<?= $this->template->pdf()?>ForexMartPartnershipAgreement_russian.pdf"  target="_blank" ><?=lang('terms_prtnshp')?></a>
                                                <?php } else { ?> 
                                                    <a href="<?= $this->template->pdf()?>ForexMartPartnershipAgreement.pdf"  target="_blank" ><?=lang('terms_prtnshp')?></a>
                                                <?php }   ?> -->
                         
                            </label>
                        </div>
                    </div>
                    <div class="btn-float-none col-md-4 col-sm-4" style="float: right;">
                        <div class="input-group ig">
<!--                            <button type="button" class="btn-ref-complete" id="btn-complete-reg" onclick="goog_report_conversion();">Complete</button>-->

                                <button type="button" class="btn-ref-complete" id="btn-complete-reg"><?=lang('complete')?></button>


                        </div>
                    </div>

                </form>

                <?php }else{ ?>
                    <div class="ref-reg-holder">
                        <h1><?=lang('x_pr_10')?></h1>
                        <p> <?=lang('x_pr_11')?> </p>
                        <p> <?=lang('x_pr_12')?></p>
                        <p class="add-msg"> <?=lang('x_pr_13')?></p>
                        <p class="add-msg"> <?=lang('x_pr_14')?></p>
                        <p> <?=lang('x_pr_15')?></p>
                        <div class="input-group btn-centre-reg" style="width: 50%;">

                            <!--FXPP-5267-->
                            <form action="<?=FXPP::my_url('partner/signin');?>" id="form_login" style="display: none;" method="POST" >
                                <input name="username" id="inputEmail3" type="text" value="<?php echo $this->session->flashdata("userdet1");?>"/>
                                <input name="password" id="pass" type="password" value="<?php echo $this->session->flashdata("userdet2");?>"/>
                            </form>
                            <button type="button" id="acctRedirect" class="btn-ref-complete" style="margin-left:25%; width: 25%;">Go to Cabinet</button>

                        </div>
                    </div>
                <?php } ?>


            </div>
            <?= $DemoAndLiveLinks; ?>
        </div>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-partnership-reg.css' type='text/css'  />"));
    });
</script>
<script src="<?= $this->template->Js()?>jquery.ui.widget.js"></script>
<script src="<?= $this->template->Js()?>jquery.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
    var baseurl = '<?php echo base_url();?>';

    var countryAbbr = "<?=strtolower($calling_code);?>";

    $(document).on('change', '#country, #target_country', function(){
        $.ajax({
            type: 'POST',
            url: baseurl+'register/checkCountryLimit',
            data: {country: $(this).val()},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                if( response.banned ){
                    $('#btn-complete-reg').attr('disabled', 'disabled');
                    $('#register_restrict').modal('show');
                }else{
                    $('#btn-complete-reg').removeAttr('disabled');
                }
                $('#loader-holder').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
            }
        });
    });

    jQuery('#homeRedirect').click(function() {
        document.location.href="<?php echo $this->config->item('domain-my');?>/partner/signin";
    });
    jQuery('#acctRedirect').click(function() {
        document.getElementById("form_login").submit();// Form submission
    });

    jQuery('#open-trading-red').click(function() {
        document.location.href="<?php echo base_url();?>register";
    });
    jQuery('#open-demo-red').click(function() {
        document.location.href="<?php echo base_url('register/demo');?>";
    });
</script>
<?php if(!IPLoc::isChinaIP()){ ?>
<script type="text/javascript">
    /* <![CDATA[ */
    goog_snippet_vars = function() {
        var w = window;
        w.google_conversion_id = 946831952;
        w.google_conversion_label = "eugtCNWBk2EQ0IS-wwM";
        w.google_remarketing_only = false;
    }

    // DO NOT CHANGE THE CODE BELOW.
    goog_report_conversion = function(url) {
        goog_snippet_vars();
        window.google_conversion_format = "3";
        window.google_is_call = true;
        var opt = new Object();
        opt.onload_callback = function() {
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        }
        var conv_handler = window['google_trackConversion'];
        if (typeof(conv_handler) == 'function') {
            conv_handler(opt);
        }
    }
    /* ]]> */
</script>
<script type="text/javascript"  src="//www.googleadservices.com/pagead/conversion_async.js"></script>
<?php } ?>
<?= $this->load->ext_view('modal', 'reglimit', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>


    <script type="text/javascript">
        $( document ).ready( function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
            );


            $('#partnership_registration').validate({ // initialize the plugin
                rules: {
                    company_name: {
                        regex: cyrillic
                    },
                    registration_number:{
                        regex: cyrillic
                    },
                    date_of_inc:{
                        regex: cyrillic
                    },
                    fullname:{
                        regex: cyrillic
                    },
                    phone_number:{
                        regex: cyrillic
                    },
                    skype:{

                        regex: cyrillic
                    },
                    message:{

                        regex: cyrillic
                    }
                },
                messages: {
                    company_name:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Company Name " + "<?=lang('validate_engrus2'); ?>"

                    },
                    registration_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Registration Number " + "<?=lang('validate_engrus2'); ?>",
                    },
                    date_of_inc:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Date of Incorporation " + "<?=lang('validate_engrus2'); ?>",

                    },
                    fullname:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Full Name " + "<?=lang('validate_engrus2'); ?>",

                    },
                    phone_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Phone Number " + "<?=lang('validate_engrus2'); ?>",

                    },
                    skype:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Skype " + "<?=lang('validate_engrus2'); ?>",

                    },
                    message:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Message " + "<?=lang('validate_engrus2'); ?>",

                    },
                },
                submitHandler: function (form) {
                    return true;
                }
            });

        });


        $("#phone_number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        
        
        
        
    $('form#partnership_registration').on('click', '#btn-complete-reg', function(){

        var submit = true;
        var errors = new Array();
        var pattern = /^[\w.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/;

        $("input.inp-first-val, select.inp-first-val").each(function(){

            if( "email" == this.id ) {
                if( !this.value.match( pattern ) ) {
                    submit = false;
                    errors.push( "invalid-email" );
                }
            }

            if( "phone_number" == this.id ){
                if($(this).val().length < $('[name=phone_code]').val().length + 5){
                    submit = false;
                    errors.push(this.name);
                }
            }

            if('' == $(this).val()){
                if($(this).attr('name') != "websites[]"){
                    submit = false;
                    errors.push(this.name);
                }
            }

        });

        $("input.inp-company-field").each(function(){
            if($('#status_type').val() > 0){
                if('' == $(this).val()){
                    submit = false;
                    errors.push(this.name);
                }
            }
        });

        if(submit){
            if($("#agree-checkbox").is(':checked')){
                $('#partnership_registration').submit();
            }else{
                alert(" You need to agree with the terms of Service. ");
            }
        }else{
            for(error in errors){
                switch (errors[error]){
                    case 'invalid-email':
                        jQuery( "#error_email").html( "<p>Invalid email.</p>" );
                        jQuery("input#email").addClass('red-border');
                        break;
                    case 'affiliate_type':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_01')?></p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'fullname':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_02')?></p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'email':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_03')?></p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'phone_number':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_04')?></p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'country':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_05')?></p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'target_country':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_06')?></p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'status_type':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_07')?></p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'company_name':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_08')?></p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'registration_number':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_09')?></p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'date_of_inc':
                        jQuery( "#error_"+errors[error]).html( "<p><?=lang('prt_reg_10')?></p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                }
            }
        }

    });


    </script>
