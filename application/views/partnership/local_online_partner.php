
<div class="reg-form-holder">
    <div class="container">
        <div class="row">

            <?php echo $this->load->view('partnership/partner_nav', NULL, TRUE); ?>
            <div class="col-md-9 b-left">
                <div class="partner-tab-holder">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 partner-img-holder">
                            <img src="<?= $this->template->Images()?>partner-img.png" alt="" class="img-responsive"/>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="hidden-title-partnership"><h1>
                                    <?= lang('pt_n_3');?>
                                </h1></div>
                            <p class="partner-text-ru">
                                <?=lang('x_lop_p0-0')?>
                            </p>
                            <h2 class="partner-sub">
                                <?=lang('x_lop_st1')?>
                            </h2>
                            <ul class="demo-feats">
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="li_span sa-li_span90"><?=lang('x_lop_li1-0')?></span>
                                    <span class="clearfix "></span>
                                </li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="li_span sa-li_span90"><?=lang('x_lop_li1-1')?></span>
                                    <span class="clearfix"></span>
                                </li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="li_span sa-li_span90"><?=lang('x_lop_li1-2')?></span>
                                    <span class="clearfix"></span>
                                </li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="li_span sa-li_span90"><?=lang('x_lop_li1-3')?></span>
                                    <span class="clearfix"></span>
                                </li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="li_span sa-li_span90"><?=lang('x_lop_li1-4')?></span>
                                    <span class="clearfix"></span>
                                </li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="li_span sa-li_span90"><?=lang('pw_li_6')?></span>
                                    <span class="clearfix"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-lg-12">

                <div class="partner-tab-holder ext-arabic-license-title">
                    <?php
                    $flash = $this->session->flashdata("successlop");
                    if(!isset($flash)) {
                        ?>
                        <div class="ref-reg-holder ext-arabic-ref-reg-holder partnership-reg-holder">
                            <h1>
                                <?=lang('x_lop_p1-h')?>
                            </h1>
                            <p>
                                <?=lang('x_p_p1-0')?>
                                <span class="company">
                                <?=lang('x_p_p1-1')?>
                                    </span>
                                <?=lang('x_p_p1-2')?>
                            </p>
                            <?= $this->load->ext_view('modal', 'reglimitprompt_p', '', TRUE); ?>
                            <form action="<?= FXPP::www_url('Partnership/local_online_partner');?>" id="local_online_partner_reg" method="post">
                                <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 <?= (FXPP::html_url()=='sa')? 'col-sm-12 col-xs-12' :''; ?> ext-arabic-column-partners">
                                        <div class="input-group ig">
                                            <?php
                                            $error_s = (form_error('status_type') == "") ? "" : "red-border";
                                            $attr = 'id="status_type" class="inp-first-val form-control round-0 margin-ref '.$error_s.'"';
                                            $stats_typ = array_merge(array('' => '* ' . lang('x_cpa_li1-7')), FXPP::getPartnersStatusType());
                                            $selectedStatus = $this->input->post('status_type');
                                            $set_value = isset($selectedStatus)?$selectedStatus:false;
                                            ?>
                                            <?php echo form_dropdown('status_type',$stats_typ,$selectedStatus,$attr);?>
                                            <div class="error_p" id="error_status_type"><?php echo form_error('status_type'); ?></div>
                                        </div>
                                        <div class="input-group ig company-field">
                                            <input type="text" name="company_name" id="company_name" value="<?php echo set_value('company_name');?>" class="latin inp-company-field form-control round-0 margin-ref <?=(form_error('company_name') == '') ? '' : 'red-border';?> ext-arabic-form-control-placeholder" placeholder="* Company Name"/>
                                            <div class="error_p" id="error_company_name"><?php echo form_error('company_name'); ?></div>
                                        </div>
                                        <div class="input-group ig company-field">
                                            <input type="text" name="registration_number" id="registration_number" value="<?php echo set_value('registration_number');?>" class="latin inp-company-field form-control round-0 margin-ref <?=(form_error('registration_number') == '') ? '' : 'red-border';?>" placeholder="* Registration Number"/>
                                            <div class="error_p" id="error_registration_number"><?php echo form_error('registration_number'); ?></div>
                                        </div>
                                        <div class="input-group ig company-field">
                                            <input type="text" name="date_of_inc" id="date_of_inc" value="<?php echo set_value('date_of_inc');?>" class="latin inp-company-field datepicker form-control round-0 margin-ref <?=(form_error('date_of_inc') == '') ? '' : 'red-border';?>" placeholder="* Date of Incorporation"/>
                                            <div class="error_p" id="error_date_of_inc"><?php echo form_error('date_of_inc'); ?></div>
                                        </div>
                                        <div class="input-group ig">
                                            <input type="text" name="fullname" value="<?php echo set_value('fullname');?>" id="fullname" class="inp-first-val form-control round-0 margin-ref <?=(form_error('fullname') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_04')?>" />
                                            <div class="error_p" id="error_fullname"><?php echo form_error('fullname'); ?></div>
                                        </div>
                                        <div class="input-group ig">
                                            <input type="email" name="email" value="<?php echo set_value('email');?>" id="email" class="latin_email inp-first-val form-control round-0 margin-ref <?=(form_error('email') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_05')?>"/>
                                            <div class="error_p" id="error_email"><?php echo form_error('email'); ?></div>
                                        </div>
                                        <div class="input-group ig">
                                            <input type="hidden" name="phone_code" value="<?php echo $calling_code ?>" />
                                            <input type="text" name="phone_number" value="<?php echo $calling_code;?>" id="phone_number" class="latin_phone inp-first-val form-control round-0 margin-ref <?=(form_error('phone_number') == '') ? '' : 'red-border';?>" placeholder="* Phone Number"/>
                                            <div class="error_p" id="error_phone_number"><?php echo form_error('phone_number'); ?></div>
                                        </div>
                                        <div class="input-group ig">
                                            <input type="text" name="skype" id="skype" class="latin_skype form-control round-0 margin-ref" placeholder="Skype"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 <?= (FXPP::html_url()=='sa')? 'col-sm-12 col-xs-12' :''; ?> ext-arabic-column-partners">
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
                                            $attr = 'id="target_country" class="inp-first-val form-control round-0 margin-ref '.$error_tc.'"';
                                            if(IPLoc::Office()){
                                                $countries = array_merge(array('' => '* ' . lang('target')), FXPP::getAllCountries_localize());
                                            }else{
                                                $countries = array_merge(array('' => '* ' . lang('target')), FXPP::getAllCountries());
                                                //$countries = array_merge(array('' => '* Target Country for business'), FXPP::getCountries());
                                            }
                                            $target_country = $this->input->post('target_country');
                                            $set_value = isset($target_country)?$target_country:false;
                                            ?>
                                            <?php echo form_dropdown('target_country',$countries,$set_value,$attr);?>
                                            <div class="error_p" id="error_target_country"><?php echo form_error('target_country'); ?></div>
                                        </div>
                                        <div class="input-group ig margin-ref">
                                            <input type="text" class="latin_website websites form-control round-0 <?=(form_error('websites[]') == '') ? '' : 'red-border';?>" name="websites[]" value="<?php echo set_value('websites[]');?>" placeholder="<?=lang('x_pr_07');?>">
                                            <div class="input-group-addon round-0"><a id="addWebsite"><i class="fa fa-plus"></i></a></div>
                                        </div>
                                        <ul id="ulwebname"></ul>
                                        <i style="font-size: 13px;"><?=lang('x_pr_08')?> (http://, https://, ftp://).</i>
                                        <!--                                        <div class="error_p" id="error_websites">--><?php //echo form_error('websites[]'); ?><!--</div>-->
                                    </div>
                                    <div class="col-md-4 col-sm-4 <?= (FXPP::html_url()=='sa')? 'col-sm-12 col-xs-12' :''; ?> ext-arabic-column-partners">
                                        <div class="input-group ig">
                                            <textarea id="message" name="message" class="latin form-control round-0 margin-ref <?=(form_error('message') == '') ? '' : 'red-border';?>" rows="6" placeholder="<?=lang('x_pr_09')?>"><?php echo set_value('message');?></textarea>
                                        </div>
                                        <div class="input-group ig">
                                            <label class="agreement" style="font-weight: normal;">
                                                <input id="agree-checkbox" type="checkbox"> <?=lang('agreeterms')?>  
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
                                    <div class="col-md-4 col-sm-4 <?= (FXPP::html_url()=='sa')? 'col-sm-12 col-xs-12' :''; ?> ext-arabic-column-partners" style="float: right;">
                                        <div class="input-group ig">

                                                <?php if(IPLoc::isChinaIP()){ ?>
                                                    <button type="button" class="btn-ref-complete" id="btn-complete-reg"><?=lang('complete')?></button>
                                                <?php }else{ ?>
                                                    <button type="button" class="btn-ref-complete" id="btn-complete-reg" onclick="goog_report_conversion(); ga('send', 'event', 'button', 'click', 'complete'); return true;"><?=lang('complete')?></button>
                                                <?php } //do not remove onclick goog_report_conversion FXPP-1258  ?>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php }else{ ?>
                        <div class="ref-reg-holder">
                            <h1><?=lang('x_pr_10')?></h1>
                            <p><?=lang('x_pr_11')?> </p>
                            <p><?=lang('x_pr_12')?></p>
                            <p class="add-msg"> <?=lang('x_pr_13')?></p>
                            <p class="add-msg"> <?=lang('x_pr_14')?></p>
                            <p> <?=lang('x_pr_15')?>.</p>
                            <div class="input-group" style="width: 100%;">
<!--                                <button type="button" id="homeRedirect" class="btn-ref-complete" style="float: left; width: 49%;margin-right:1%;">--><?//=lang('x_pr_16')?><!--</button>-->
                                <?php //if(IPLoc::Office()){ ?>
                                    <!--FXPP-5267-->
                                    <form action="<?=FXPP::my_url('partner/signin');?>" id="form_login" style="display: none;" method="POST" >
                                        <input name="username" id="inputEmail3" type="text" value="<?php echo $this->session->flashdata("userdet1");?>"/>
                                        <input name="password" id="pass" type="password" value="<?php echo $this->session->flashdata("userdet2");?>"/>
                                    </form>
                                <button type="button" id="acctRedirect" class="btn-ref-complete" style="margin-left:40%; width: 20%;">Go to Cabinet</button>
                                <?php// } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>

        </div>
        <?= $DemoAndLiveLinks; ?>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-partnership-gen.css' type='text/css'  />"));
    });
</script>
<script src="<?= $this->template->Js()?>jquery.ui.widget.js"></script>
<script src="<?= $this->template->Js()?>jquery.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">

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

    var countryAbbr = "<?=strtolower($calling_code);?>";

    jQuery(document).ready(function(){

//        $('#phone_number').intlTelInput({
//            defaultCountry: countryAbbr,
//            utilsScript: URL + "data/js/utils.js"
//        });

        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            yearRange: "-95:+0"
            //  defaultDate: '1920-01-01'

        });

        jQuery('#addWebsite').click(function(){
            var website_html = '<li><div class="input-group ig margin-ref"><input type="text" placeholder="Website" class="form-control round-0" name="websites[]"/><div class="input-group-addon round-0"><a id="removeWebsite"><i class="fa fa-minus"></i></a></div></div></li>';
            jQuery("#ulwebname").append(website_html);
        });

        jQuery(document).on("change","#status_type",function(){
            var statustype = jQuery(this).val();
            if(statustype > 0){
                jQuery('.company-field').show();
            }else{
                jQuery('.company-field').hide();
            }
        });

        jQuery(document).on("change","#status_type",function(){
            var statustype = jQuery(this).val();
            if(statustype > 0){
                jQuery('.company-field').show();
            }else{
                jQuery('.company-field').hide();
            }
        });

        jQuery('div#local_online_partner_cont').on("focus",'input, select, textarea',function(){
            jQuery(this).parent('div').find('div.error_p').html('');
            jQuery(this).removeClass('red-border');
            var name = jQuery(this).attr('name');
            if(name == "websites[]"){
                jQuery('div#error_websites').html('');
            }
        });

        jQuery('#ulwebname').on('click', 'a#removeWebsite', function(){
            jQuery(this).closest("li").remove();
        });
        jQuery('#homeRedirect').click(function() {
            document.location.href="<?php echo FXPP::my_url('partner/signin');?>";
        });
        jQuery('#acctRedirect').click(function() {
            document.getElementById("form_login").submit();// Form submission
        });

        jQuery('form#local_online_partner_reg').on('click', '#btn-complete-reg', function(){
            var submit = true;
            var errors = new Array();
            var pattern = /^[\w.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/;
            jQuery("input.inp-first-val, select.inp-first-val").each(function(){
                if(jQuery(this).attr('name') == "websites[]"){
                    if('' != jQuery(this).val()){
                        if(validateURL(jQuery(this).val())){
                            jQuery(this).addClass('red-border');
                            errors.push('invalid-website');
                            submit = false;
                        }
                    }
                }

                if( "email" == this.id ) {
                    if( !this.value.match( pattern ) ) {
                        submit = false;
                        errors.push( "invalid-email" );
                    }
                }

                if('' == jQuery(this).val()){
                    if(jQuery(this).attr('name') != "websites[]"){
                        submit = false;
                        errors.push(this.name);
                    }
                }

            });

            jQuery("input.inp-company-field").each(function(){
                if(jQuery('#status_type').val() > 0){
                    if('' == jQuery(this).val()){
                        submit = false;
                        errors.push(this.name);
                    }
                }
            });

            if(submit){
                if($("#agree-checkbox").is(':checked')){
                    $('#local_online_partner_reg').submit();
                }else{
                    alert(" You need to agree with the terms of Service. ");
                }
            }else{
                for(error in errors){
                    switch (errors[error]){
                        case 'invalid-email':
                            jQuery( "#error_email").html( "" );
                            jQuery("input#email").addClass('red-border');
                            break;
                        case 'fullname':
                            jQuery( "#error_"+errors[error]).html( "<p>Please enter full name.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'email':
                            jQuery( "#error_"+errors[error]).html( "<p>Please enter valid e-mail address.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'phone_number':
                            jQuery( "#error_"+errors[error]).html( "<p>The Phone number field is required.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'country':
                            jQuery( "#error_"+errors[error]).html( "<p>The Country field is required.</p>" );
                            jQuery("select#"+errors[error]).addClass('red-border');
                            break;
                        case 'target_country':
                            jQuery( "#error_"+errors[error]).html( "<p>Please select target country.</p>" );
                            jQuery("select#"+errors[error]).addClass('red-border');
                            break;
                        case 'status_type':
                            jQuery( "#error_"+errors[error]).html( "<p>Please select status.</p>" );
                            jQuery("select#"+errors[error]).addClass('red-border');
                            break;
                        case 'company_name':
                            jQuery( "#error_"+errors[error]).html( "<p>Please enter company name.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'registration_number':
                            jQuery( "#error_"+errors[error]).html( "<p>Please enter registration number.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'date_of_inc':
                            jQuery( "#error_"+errors[error]).html( "<p>Please enter incorporation date.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                    }
                }
            }
        });

        var baseurl = '<?php echo base_url();?>';

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
    });

    function validateURL( website ){
        if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(website)) {
//            var website_html = '<li><a href="' + website + '">' + website + '</a><a  style="cursor: pointer; margin-left: 10px;" title="Remove Website"><i class="remove-website glyphicon glyphicon-remove"></i></a><input type="hidden" name="websites[]" value="' + website + '" /></li>';
            return false;
        } else {
            return true;
        }
    }

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


            $('#local_online_partner_reg').validate({ // initialize the plugin
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
                        regex: "<?=lang('validate_engrus1'); ?>"+" Registration Number " + "<?=lang('validate_engrus2'); ?>"
                    },
                    date_of_inc:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Date of Incorporation " + "<?=lang('validate_engrus2'); ?>"

                    },
                    fullname:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Full Name " + "<?=lang('validate_engrus2'); ?>"

                    },
                    phone_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Phone Number " + "<?=lang('validate_engrus2'); ?>"

                    },
                    skype:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Skype " + "<?=lang('validate_engrus2'); ?>"

                    },
                    message:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Message " + "<?=lang('validate_engrus2'); ?>"

                    }

                },
                submitHandler: function (form) {
                    return true;
                }
            });

        });
    </script>
