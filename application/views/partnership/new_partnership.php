

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
                            <div class="hidden-title-partnership"><h1>     <?= lang('pt_n_1');?></h1></div>
                            <p class="partner-text-ru">
                                <?= lang('pw_p_0');?>
                            </p>
                            <h2 class="partner-sub">
                                <?= lang('pw_h2_0');?>:
                                <!-- Benefits for Webmasters  -->
                            </h2>
                            <ul class="demo-feats">
                                <li><i class="fa fa-check"></i><?= lang('pw_li_0');?></li>
                                <li><i class="fa fa-check"></i><?= lang('pw_li_1');?></li>
                                <li><i class="fa fa-check"></i><?= lang('pw_li_2');?></li>
                                <li><i class="fa fa-check"></i><?= lang('pw_li_3');?></li>
                                <li><i class="fa fa-check"></i><?= lang('pw_li_4');?></li>
                                <li><i class="fa fa-check"></i><?= lang('pw_li_5');?></li>
                                <li><i class="fa fa-check"></i><?= lang('pw_li_6');?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-lg-12">

                <div class="partner-tab-holder ext-arabic-license-title">
                    <div class="tab-content" id="webmaster_cont">
                        <?php
                        $flash = $this->session->flashdata("successWeb");
                        if(!isset($flash)) {
                            ?>
                            <div class="ref-reg-holder ext-arabic-ref-reg-holder">
                                <h1><?=lang('x_p_p1-3')?></h1>
                                <p>
                                    <?=lang('x_p_p1-0')?>
                                    <span class="company">
                                <?=lang('x_p_p1-1')?>
                                    </span>
                                    <?=lang('x_p_p1-2')?>
                                </p>
                                <form action="<?= FXPP::www_url('Partnership/webmaster');?>" enctype="multipart/form-data" id="webmaster_reg" method="post">
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
                                                <input type="text" name="fullname" value="<?php echo set_value('fullname');?>" id="fullname"  class="inp-first-val form-control round-0 margin-ref <?=(form_error('fullname') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_04')?>"/>
                                                <div class="error_p" id="error_fullname"><?php echo form_error('fullname'); ?></div>
                                            </div>
                                            <div class="input-group ig">
                                                <input type="email" name="email" value="<?php echo set_value('email');?>" id="email" required class="latin_email inp-first-val form-control round-0 margin-ref <?=(form_error('email') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_05')?>"/>
                                                <div class="error_p" id="error_email"><?php echo form_error('email'); ?></div>
                                            </div>
                                            <div class="input-group ig">
                                                <input type="hidden" name="phone_code" value="<?php echo $calling_code ?>" />
                                                <input type="text" name="phone_number" value="<?php echo $calling_code;?>" id="phone_number" class="latin_phone inp-first-val form-control round-0 margin-ref <?=(form_error('phone_number') == '') ? '' : 'red-border';?>" placeholder="* Phone Number"/>
                                                <div class="error_p" id="error_phone_number"><?php echo form_error('phone_number'); ?></div>
                                            </div>
<!--                                            <div class="input-group ig margin-ref">-->
<!--                                                <input type="text" id="phone_number" name="phone_number" class="inp-company-field inp-first-val form-control round-0 margin-ref --><?//=(form_error('phone_number') == '') ? '' : 'red-border';?><!-- ext-arabic-form-control-placeholder"/>-->
<!--                                            </div>-->
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
                                                <?php
                                                $error_c = (form_error('country') == "") ? "" : "red-border";
                                                $attr = 'id="country" class="inp-first-val form-control round-0 margin-ref '.$error_c.'"';
                                                $country = $this->input->post('country');
                                                $set_value = isset($country)?$country:false;
                                                ?>
                                                <?php echo form_dropdown('country',$countries,$set_value,$attr);?>
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
                                                <input type="text" class="latin_website inp-first-val websites form-control round-0 <?=(form_error('websites[]') == '') ? '' : 'red-border';?>" name="websites[]" value="<?php echo set_value('websites[]');?>" placeholder="* <?=lang('x_pr_07');?>">
                                                <div class="input-group-addon round-0"><a id="addWebsite"><i class="fa fa-plus"></i></a></div>
                                            </div>
                                            <ul id="ulwebname"></ul>
                                            <i style="font-size: 13px;"><?=lang('x_pr_08')?> (http://, https://, ftp://).</i>
                                            <!--                                        <div class="error_p" id="error_websites">--><?php //echo form_error('websites[]'); ?><!--</div>-->
                                        </div>
                                        <div class="col-md-4 col-sm-4 <?= (FXPP::html_url()=='sa')? 'col-sm-12 col-xs-12' :''; ?> ext-arabic-column-partners">
                                            <div class="input-group ig">
                                                <textarea type="text" id="message" name="message" class="latin form-control round-0 margin-ref <?=(form_error('message') == '') ? '' : 'red-border';?>" rows="6" placeholder="<?=lang('x_pr_09')?>"><?php echo set_value('message');?></textarea>
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
                                                <?php if(!IPLoc::isChinaIP()){ ?>
                                                <button type="button" class="btn-ref-complete" id="btn-complete-reg" onclick="goog_report_conversion(); ga('send', 'event', 'button', 'click', 'complete'); return true;"><?=lang('complete')?></button>
                                                <?php }else{ ?>
                                                <button type="button" class="btn-ref-complete" id="btn-complete-reg"><?=lang('complete')?></button>
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
<!--                                    <button type="button" id="homeRedirect" class="btn-ref-complete" style="float: left; width: 49%;margin-right:1%;">--><?//=lang('x_pr_16')?><!--</button>-->
                                    <?php if(IPLoc::Office()){ ?>
                                        <!--FXPP-5267-->
                                        <form action="<?=FXPP::my_url('partner/signin');?>" id="form_login" style="display: none;" method="POST" >
                                            <input name="username" id="inputEmail3" type="text" value="<?php echo $this->session->flashdata("userdet1");?>"/>
                                            <input name="password" id="pass" type="password" value="<?php echo $this->session->flashdata("userdet2");?>"/>
                                        </form>
                                        <button type="button" id="acctRedirect" class="btn-ref-complete" style="margin-left:40%; width: 20%;">Go to Cabinet</button>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">


        </div>
        <?= $DemoAndLiveLinks; ?>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'register_restrict', '', TRUE); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style type="text/css">
    .fs-11{
        font-size:11px!important;
    }
    ul#ulwebname {
        list-style: none;
        margin: 0 !important;
        padding: 0 !important;
    }
    i.fa-minus{
        color: red;
    }
    div.error_p p{
        color: red;
    }
    div.company-field{
        display:none;
    }

    p.add-msg{
        width: 460px;
        margin-left: 30px;
    }
    .demo-feats li i {
        float: left;
        width: 20px;
    }
    .li_span sa-li_span {
        float: left;
        width: 80%;
    }
    .partner-tabs-all
    {
        width: 100%;
        padding: 0;
        /*margin-top: 40px;*/
    }
    .partner-tabs-all ul
    {
        list-style: none;
        padding: 0;
    }
    .partner-tabs-all ul li
    {
        /*float: left;*/
        text-align: center;
        border-top: 1px solid #fff;
    }
    .partner-tabs-all ul li a
    {
        text-align: left;
        padding: 8px 15px;
        display: block;
        font-size: 13px;
        background: #f5f5f5;
        font-family: Open Sans;
        font-weight: 600;
        color: #333;
        transition: all ease 0.3s;
    }
    .partner-tabs-all ul li a:hover
    {
        background: #2988ca;
        text-decoration: none;
        color: #fff;
        transition: all ease 0.3s;
    }
    .partner-tabs-all ul li a:focus
    {
        background: #2988ca;
        text-decoration: none;
        color: #fff;
    }
    .partner-active
    {
        background: #2988ca!important;
        text-decoration: none;
        color: #fff!important;
    }
    .b-left
    {
        border-left: 1px solid #ccc;
    }
    .partner-text-ru
    {
        margin-top: 35px;
    }
    .all-holder
    {
        padding-bottom: 0px;
    }
    .ru-btn-holder
    {
        padding-bottom: 25px;
    }
    .partnership-reg-holder
    {
        margin-top: 0!important;
    }
    .btn-comm-table
    {
        border: none;
        padding: 8px 0px;
        width: 278px;
        border-right: 1px solid #ccc;
        font-family: Open Sans;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all ease 0.3s;
        display: block;
        text-align: center;
        background: #f0f0f0
    }
    .btn-comm-table:focus
    {
        text-decoration: none;
        background: #2988ca;
        color: #fff;
    }
    .btn-comm-table:hover
    {
        text-decoration: none;
        transition: all ease 0.3s;
        background: #2988ca;
        color: #fff;
    }
    div.intl-tel-input{
        width: 100% !important;
    }

    ul.country-list{
        z-index: 100 !important;
    }
    ul.country-list .bg{

    /*MEDIA QUERIES*/
    @media screen and (max-width: 1199px) {
        .btn-comm-table
        {
            width: 228px;
        }
    }
    @media screen and (max-width: 991px) {

        .b-left
        {
            border-left: none;
        }
        .btn-comm-table
        {
            margin-top: 20px;
            border-right: none;
        }
    }
    @media screen and (max-width: 767px) {

    }
    @media screen and (max-width: 360px) {
        .btn-comm-table
        {
            margin-top: 20px;
            width: 100%;
        }
    }
            .cd-top{
        z-index: 99;
    }
    @media screen and (min-width: 768px) and (max-width: 991px) {
        #target_country{
            font-size: 12px;
        }
    }
</style>
<script src="<?= $this->template->Js()?>jquery.ui.widget.js"></script>
<script src="<?= $this->template->Js()?>jquery.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

//        $('#phone_number').intlTelInput({
//            defaultCountry: 'ph',
//            utilsScript: URL + "data/js/utils.js"
//        });

        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            yearRange: "-95:+0"

        });

        jQuery('#addWebsite').click(function(){
            var website_html = '<li><div class="input-group ig margin-ref"><input type="text" placeholder="* Website" class="inp-first-val form-control round-0" name="websites[]"/><div class="input-group-addon round-0"><a id="removeWebsite"><i class="fa fa-minus"></i></a></div></div></li>';
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

        jQuery('div#webmaster_cont').on("focus",'input, select, textarea',function(){
            jQuery(this).parent('div').find('div.error_p').html('');
            jQuery(this).removeClass('red-border');
            var name = jQuery(this).attr('name');
            if(name == "websites[]"){
                jQuery('div#error_websites').html('');
            }
        });

        jQuery('#ulwebname').on('click', 'a#removeWebsite', function(){
            $(this).closest("li").remove();
        });

        jQuery('#homeRedirect').click(function() {
            document.location.href="<?php echo FXPP::my_url('partner/signin');?>";
        });
        jQuery('#acctRedirect').click(function() {
            document.getElementById("form_login").submit();// Form submission
        });

        jQuery('form#webmaster_reg').on('click', '#btn-complete-reg', function(){
            var submit = true;
            var errors = new Array();
            jQuery("input.inp-first-val, select.inp-first-val").each(function(){

                if('' == jQuery(this).val()){
                    submit = false;
                    errors.push(this.name);
                }
                if(this.name == 'websites[]'){
                    if(jQuery(this).val() == ""){
                        jQuery(this).addClass('red-border');
                        errors.push('empty-website');
                        submit = false;
                    }else{
                        if(validateURL(jQuery(this).val())){
                            jQuery(this).addClass('red-border');
                            errors.push('invalid-website');
                            submit = false;
                        }
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
                    $('#webmaster_reg').submit();
                }else{
                    alert(" You need to agree with the terms of Service. ");
                }
            }else{
                for(error in errors){
                    switch (errors[error]){
                        case 'fullname':
                            jQuery( "#error_"+errors[error]).html( "<p>The Full name field is required.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'email':
                            jQuery( "#error_"+errors[error]).html( "<p>Please provide your email.</p>" );
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
                            jQuery( "#error_"+errors[error]).html( "<p>The Target Country field is required.</p>" );
                            jQuery("select#"+errors[error]).addClass('red-border');
                            break;
                        case 'status_type':
                            jQuery( "#error_"+errors[error]).html( "<p>The Status field is required.</p>" );
                            jQuery("select#"+errors[error]).addClass('red-border');
                            break;
                        case 'company_name':
                            jQuery( "#error_"+errors[error]).html( "<p>The Company name field is required.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'registration_number':
                            jQuery( "#error_"+errors[error]).html( "<p>The Registration number field is required.</p>" );
                            jQuery("input#"+errors[error]).addClass('red-border');
                            break;
                        case 'date_of_inc':
                            jQuery( "#error_"+errors[error]).html( "<p>The Date of Incorporation field is required.</p>" );
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