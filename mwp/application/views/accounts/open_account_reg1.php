<script type="text/javascript"  src="//www.googleadservices.com/pagead/conversion_async.js"></script>

<link href="<?= $this->template->Css()?>jquery.fileupload.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>jquery.switchButton.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>style2.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.validate.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.easing.min.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery-input-file-text.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.switchButton.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.fileupload.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>pwstrength.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>bootbox.min.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<?php $this->lang->load('countries_lang');?>
<?php  $this->lang->load('register_lang'); ?>

<!-- <?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?> -->
<?= $this->load->ext_view('modal', 'register_restrict', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'register_alert', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'client-scoring', '', TRUE); ?>

<style type="text/css">
    .tooltip-inner p{color: white!important;}
    .upload-file:hover {color: white;text-shadow: 1px 1px 3px #000;}
    .nav > li > a {font-size: 14px; font-family: 'open sans', 'helvetica', 'sans-serif';}
    .datepicker {border-radius: 0;}
    .tooltip.right {width: 100%;}
    .alert{text-align: center;}
    #upbtn{margin-top: 8px;}
    #p1{background: #2fb24a; color: white;}
    .content-header ol li:before {
    content: "";
    right: 0;
    margin-right: 0;
    position: relative;
    }
</style>
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

            $('#register-live').validate({ // initialize the plugin
                rules: {
                    street: {
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                    },
                    city:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                    },
                    state:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                    },
                    zip:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                    },
                    phone:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                    },
                    dob:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\_\:\/]*$"
                    }
                },
                messages: {
                    street:{

                        required: "<?=lang('validate_engrus0'); ?>"+" Street Address.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" Street Address " + "<?=lang('validate_engrus2'); ?>"
                    },
                    city:{
                        required: "<?=lang('validate_engrus0'); ?>"+" City.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" City " + "<?=lang('validate_engrus2'); ?>"
                    },
                    state:{
                        required: "<?=lang('validate_engrus0'); ?>"+" State.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" State " + "<?=lang('validate_engrus2'); ?>"
                    },
                    zip:{
                        required: "<?=lang('validate_engrus0'); ?>"+" Postal/Zip Code.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" Postal/Zip Code " + "<?=lang('validate_engrus2'); ?>"
                    },
                    phone:{
                        required: "<?=lang('validate_engrus0'); ?>"+" Phone Number.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" Phone Number " + "<?=lang('validate_engrus2'); ?>"
                    },
                    dob:{
                        required: "<?=lang('validate_engrus0'); ?>"+" Date of Birth.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" Date of Birth " + "<?=lang('validate_engrus2'); ?>"
                    }
                },
                submitHandler: function (form) {

                    return true;
                }
            });
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
    </script>
<?php } ?>

<script type="text/javascript">
    $("input").keyup(function() {
        this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
    });
    $("textarea").keyup(function() {
        this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
    });
</script>

<?php if(IPLoc::Office()){?>
    <script>
        jQuery(document).ready(function(){
            $('#s-f0').inputFileText({
                text: '<?=lang('choosefile_button');?>'
            });
            $('#s-f1').inputFileText({
                text: '<?=lang('choosefile_button');?>'
            });
            $('#s-f2').inputFileText({
                text: '<?=lang('choosefile_button');?>'
            });
        });
    </script>
<?php }?>

<script type="text/javascript">
    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 95) {
            $('#nav').addClass('nav-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
        }
    });

    $(document).ready(function(){
        $("#next").click(function(){
            $(".info-text").text("Your Almost Done.");
        });
        $("#back").click(function(){
            $(".info-text").text("Thank you, You're half way to completing your demo account.");
        });
    });

    $(document).ready(function(){
        "use strict";
        var options = {};

        options.ui = {
            container: "#pwd-container",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pw-meter"
            }
        };

        options.common = {
            onKeyUp: function (evt, data) {
                if( data.score < 20 ){
                    jQuery('.progress-bar').css('width', '20%');
                }

                if( jQuery('#pass').val() == '' ){
                    jQuery('.progress-bar').css('width', '0%');
                }
            }
        };
        $('#pass').pwstrength(options);

        // $(".employment-back").click(function(){
        //     $(".tabs-employment").removeClass("color");
        //     $(".tabs-title2").addClass("color");
        // })
        // $(".trading-back").click(function(){
        //     $(".tabs-title2").removeClass("color");
        //     $(".tabs-title1").addClass("color");
        // });

        // $(document).on("click", ".back-employment", function(){
        //     $(".tabs-title3").removeClass("color");
        //     $(".tabs-employment").addClass("color");
        // });
    });

    $(document).on("click",'input,select',function(){
        jQuery(this).removeClass("red-border");
        jQuery(this).closest('div').next('div.error_p').html("");
    });
</script>

<script>
    $(function() {
        $('#basic.demo input').switchButton();
        $('#basic2.demo input').switchButton();
        $("#auto_generate input").switchButton({
            on_label: 'ON',
            off_label: 'OFF',
            labels_placement: "right",
            width: 50,
            height: 25,
            button_width: 25
        });

        $("#default.demo input").switchButton({
            checked: false
        });

        $("#labels2-1.demo input").switchButton({
            show_labels: false
        });

        $("#labels2-2.demo input").switchButton({
            labels_placement: "right"
        });

        $("#labels2-3.demo input").switchButton({
            labels_placement: "left"
        });

        $("#slider-1.demo input").switchButton({
            width: 100,
            height: 40,
            button_width: 50
        });

        $("#slider-2.demo input").switchButton({
            width: 100,
            height: 40,
            button_width: 70
        });
    });
</script>

<script>
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = window.location.hostname === 'blueimp.github.io' ?
            '//jquery-file-upload.appspot.com/' : 'server/php/';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });

    $(document).ready(function(){
        $('.tooltip-affiliate').tooltip({title: "<p align='left'><?=lang('tooltip_affiliate1');?></p>", html: true, placement: "right"});
    });
    $(document).ready(function(){
        $('.tooltip-upload-docs').tooltip({title: "<p align='left' style='padding: 5px !important;'><?=lang('upload_image_error');?></p>", html: true, placement: "right"});
    });
    $(document).on("change","[name=auto_generate]",function(){
        $(".pass-hide").toggle();
    })
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Register Account</h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-paper-plane"></i> Quick Jump</li>
        <li class="active">Register Account</li>
      </ol>
    </section> 
     
     <section class="content">
      <div class="box style-box">
        <div class="box-body">
          <div class="nav-tabs-custom style-customized-navigation-tab registration-customized-navigation-tab">
            <ul class="nav nav-tabs">
              <li><a href="#personal" id="p1">Personal Details</a></li>
              <li><a href="#trading" id="p2">Trading Account Details</a></li>
              <li><a href="#employment" id="p3">Employment Details</a></li>
              <li><a href="#account" id="p4">Account Confirmation</a></li>
            </ul>

            <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
                <div class="modal-dialog ">
                    <div class="modal-content ">
                        <div class="modal-header ">
                          <span style="color: green; font-size:14px;font-weight: bold;">Account was created successfully and details is sent on the email you provided.
                            <?php echo $this->session->flashdata('success');?>
                                </span>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <div class="modal-body modal-show-body">
                            <div class="text-center manage-credit-prize-alert-message">
                                <form action="<?=FXPP::my_url('client/signin');?>" id="form_login" style="display: none;" method="POST" >
                                <input name="username" id="inputEmail3" type="text" value=""/>
                                <input name="password" id="pass" type="password" value=""/>
                                </form>
                                <button type="button" id="clientcab" class="upload-file btn-up-file">Go to Cabinet <?php echo $this->session->flashdata("userdet1");?> <?php echo $this->session->flashdata("userdet2");?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-alert1" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
                <div class="modal-dialog ">
                    <div class="modal-content ">
                        <div class="modal-body modal-show-body">
                            <div class="text-center manage-credit-prize-alert-message">
                                <span style="color: red;font-size:18px;font-weight: bold;" id="error-msg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" id="register-live" enctype="multipart/form-data" class="uploadimage task2163">
              <div class="tab-content">
                <div class="tab-pane active" id="personal">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 register-new-account-group">
                        <div class="form-group">
                            <label>Street Address <span>*</span></label>
                            <span class="information-note">(Address field should be up to 128 characters.)</span>
                            <input type="text" class="form-control  required" maxlength="128" placeholder="Full street address including number of house or/and flat" name="street2" value="<?php echo isset($user_details['street']) ? $user_details['street'] : '' ?>">
                            <span class="red"><?php echo  form_error('street')?></span>
                        </div>
                        <div class="form-group">
                            <label>City <span>*</span></label>
                            <span class="information-note">(City field should be up to 32 characters.)</span>
                            <input type="text" class="form-control  required" maxlength="32" placeholder="City" name="city2" value="<?php echo isset($user_details['city']) ? $user_details['city'] : '' ?>">
                            <span class="red"><?php echo  form_error('city')?></span>
                        </div>
                        <div class="form-group">
                            <label>State/Province <span>*</span></label>
                            <span class="information-note">(State/Province field should be up to 32 characters.)</span>
                            <input type="text" class="form-control  required" maxlength="32" placeholder="State/Province" name="state2" value="<?php echo isset($user_details['state']) ? $user_details['state'] : '' ?>">
                            <span class="red"><?php echo  form_error('state')?></span>
                        </div>
                        <div class="form-group">
                            <label>Country of Residence <span>*</span></label>
                            <select class="form-control  required" id="country" name="country2">
                                <?php echo  $countries;?>
                            </select>
                            <span class="red"><?php echo  form_error('country')?></span>
                        </div>
                        <div class="form-group">
                            <label>Postal/Zip Code <span>*</span></label>
                            <span class="information-note">(Postal/Zip Code field should be up to 16 characters.)</span>
                            <input type="text" class="form-control  required" maxlength="16" placeholder="Postal/Zip Code" name="zip2" value="<?php echo isset($user_details['zip']) ? $user_details['zip'] : '' ?>">
                            <span class="red"><?php echo  form_error('zip')?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone Number <span>*</span></label>
                            <span class="information-note">(Phone Number field should be up to 16 characters.)</span>
                            <input type="text" class="form-control  required" maxlength="32" placeholder="Phone Number" name="phone2" value="<?php echo isset($user_details['phone1']) ? $user_details['phone1'] : '+'.$calling_code ?>" >
                            <input type="hidden" name="phone_code" value="<?php echo '+'.$calling_code ?>" />
                            <span class="red"><?php echo  form_error('phone')?></span>
                        </div>
                        <div class="form-group date">
                            <label>Date of Birth <span>*</span></label>
                            <input type="text" class="form-control required datepicker" placeholder="Date of Birth" name="dob2" value="<?php echo isset($user_details['dob']) ? date('Y-m-d', strtotime($user_details['dob'])) : '' ?>">
                            <span class="red"><?php echo  form_error('dob')?></span>
                        </div>
                        <?php if(true){ echo '<input style="display: none" type="checkbox" value="1" checked  name="auto_generate2">'; }else{?>
                        <div class="pass-hide" style="display: none">
                            <div class="form-group">
                                <label>Password <span>*</span></label>
                                    <input type="text" style="display: none" id="username" name="username" value="<?php echo $this->session->userdata('email_live');?>">
                                    <input fv="pass" onblur="checkPassword(this.value)" id="pass" type="password" class="form-control" placeholder="Password" name="password2">
                                    <!--  <div class="pw-meter"></div>-->
                                    <span id="error_password" class="red"><?php echo  form_error('password')?></span>
                            </div>
                            <div class="form-group">
                                <label>Re-enter Password <span>*</span></label>
                                    <input fv="pass" id="repass" type="password" class="form-control" placeholder="Re-enter Password" name="re_password2">
                                    <span class="red"><?php echo  form_error('re_password')?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label></label>
                                <div class="" id="auto_generate" style="display:inline-block; float: left;">
                                    <div class="switch-wrapper" >
                                        <input type="checkbox" value="1"  name="auto_generate2">

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="clearfix"></div>
                            <div class="col-sm-5">
                                <p class="auto-generate">Auto-generate password.</p>
                            </div>
                        </div>
                        <?php }?>

                        <div class="form-registration-btn-holder">
                                <a href="javascript:void(0)" aria-controls="trading" role="tab" data-toggle="tab" class="offset-submit-button personal-next">
                                    <button id="personal-next" type="button" class="btn-submit">Next</button>
                                </a>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="trading">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 register-new-account-group"> 
                    <div class="form-group">
                        <label for="inputEmail3"><?=lang('reli_12');?><span>*</span></label>
                        <select class="form-control required" name="mt_account_set_id2" id="mt_account_set_id">
                            <?php echo $account_type;?>
                        </select>
                        <span class="error_p" id="error_mt_account_set_id"><?php echo form_error('mt_account_set_id'); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3"><?=lang('reli_13');?><span>*</span></label>
                        <select class="form-control required" name="mt_currency_base2" id="mt_currency_base">
                            <?php echo $account_currency_base;?>
                        </select>
                        <span class="error_p" id="error_mt_currency_base"><?php echo form_error('mt_currency_base'); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3"><?=lang('reli_14');?><span>*</span></label>
                        <select class="form-control required" name="leverage2" id="xleverage">
                            <?php echo $leverage;?>
                        </select>
                        <span class="error_p" id="error_leverage"><?php echo form_error('leverage'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input name="swap_free" id="swap_free"<?php echo isset($user_details['swap_free']) ? $user_details['swap_free'] ? ' checked' : '' : '' ?> value="1" type="checkbox"/>
                        <span><?=lang('reli_15');?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_16');?><span>*</span></label>
                        <p><?=lang('reli_17');?></p>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input id="agree-11" type="checkbox" name="experience" <?php echo isset($user_details['trading_experience_value'][0]) ? $user_details['trading_experience_value'][0] ? ' checked' : '' : '' ?> value="1"/>
                        <span><?=lang('reli_18');?></span>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input id="agree-21" type="checkbox" name="experience" <?php echo isset($user_details['trading_experience_value'][0]) ? $user_details['trading_experience_value'][1] ? ' checked' : '' : '' ?> value="2"/>
                        <span><?=lang('reli_19');?></span>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input id="agree-31" type="checkbox" name="experience"<?php echo isset($user_details['trading_experience_value'][0]) ? $user_details['trading_experience_value'][2] ? ' checked' : '' : '' ?> value="3"/>
                        <span><?=lang('reli_20');?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_21');?><span>*</span></label>
                        <p><?=lang('reli_22');?>?</p>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <select class="form-control required" name="investment_knowledge2" id="investment_knowledge">
                            <?php echo $investment_knowledge;?>
                        </select>
                        <span class="error_p" id="error_investment_knowledge"><?php echo form_error('investment_knowledge'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_23');?>?<span>*</span></label>
                        <select class="form-control required" name="trade_duration2" id="trade_duration">
                            <?php echo $trade_duration;?>
                        </select>
                        <span class="error_p" id="error_trade_duration"><?php echo form_error('trade_duration'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_24');?><span>*</span></label>
                        <ul>
                          <li>
                            <input value="1"<?php echo isset($user_details['politically_exposed_person']) ? $user_details['politically_exposed_person'] ? ' checked' : '' : '' ?> id="politically_exposed_person1" type="radio" class="rdo-btn-required" name="politically_exposed_person" />
                            <label class="normal-font-label"><?=lang('reli_ye');?></label>
                          </li>
                          <li>
                            <input value="0"<?php echo isset($user_details['politically_exposed_person']) ? $user_details['politically_exposed_person'] ? '' : ' checked' : ' checked' ?> id="politically_exposed_person" type="radio" class="rdo-btn-required" name="politically_exposed_person" />
                            <label class="normal-font-label"><?=lang('reli_no');?></label>
                          </li>
                        </ul>
                        <span class="error_p" id="error_politically_exposed_person"><?php echo form_error('politically_exposed_person'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_25');?><span>*</span></label>
                        <ul>
                          <li>
                            <input value="1"<?php echo isset($user_details['risk']) ? $user_details['risk'] ? ' checked' : '' : ' checked' ?> id="risk1" type="radio" class="rdo-btn-required" name="risk" />
                            <label class="normal-font-label"><?=lang('reli_ye');?></label>
                          </li>
                          <li>
                            <input value="0"<?php echo isset($user_details['risk']) ? $user_details['risk'] ? '' : ' checked' : '' ?> id="risk" type="radio" class="rdo-btn-required" name="risk" />
                            <label class="normal-font-label"><?=lang('reli_no');?></label>
                          </li>
                        </ul>
                        <span class="error_p" id="error_risk"><?php echo form_error('risk'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_34');?></label>
                        <input type="text" class="form-control" placeholder="<?=lang('reli_34');?>" name="affiliateCodeStr">
                        <input type="hidden" name="affiliate_code" id="affiliate_code" value="<?php echo $referral_code;?>">
                        <span class="error_p" id="error_affiliate_code"></span>
                        <div><i style="margin-top:-23px!important; color: red; float:right; margin-right: 5px!important;" class="tooltip-affiliate glyphicon glyphicon-question-sign" data-original-title="" title=""></i></div>
                    </div>
                    <div class="form-registration-btn-holder">
                        <a href="javascript:void(0)" class="trading-back" aria-controls="personal" role="tab" data-toggle="tab" id="back1">
                        <button type="button"><?=lang('reli_ba');?></button>
                        </a>

                        <a href="javascript:void(0)"  aria-controls="account" role="tab" data-toggle="tab" class="trading-next">
                        <button id="trading-next" type="button" class="btn-submit"><?=lang('reli_ne');?></button>
                        </a>
                    </div>
                  </div>    
                </div>

                <div class="tab-pane" id="employment">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 register-new-account-group">            
                    <div class="form-group">
                        <label><?=lang('reli_27');?><span>*</span></label>
                        <select id="employment_status" class="form-control required" name="employment_status2">
                            <?php echo $employment_status;?>
                        </select>
                        <span class="error_p" id="error_employment_status"><?php echo form_error('employment_status'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_28');?><span>*</span></label>
                        <select id="industry" class="form-control" name="industry2">
                            <?php echo $industry;?>
                        </select>
                        <span class="error_p" id="error_industry"><?php echo form_error('industry'); ?></span>
                    </div>

                    <div class="form-group">
                        <label><?=lang('reli_29');?><span>*</span></label>
                        <select class="form-control required" name="estimated_annual_income2" id="estimated_annual_income">
                            <?php echo $estimated_annual_income;?>
                        </select>
                        <span class="error_p" id="error_estimated_annual_income"><?php echo form_error('estimated_annual_income'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_30');?><span>*</span></label>
                        <select class="form-control required" name="estimated_net_worth2" id="estimated_net_worth">
                            <?php echo $estimated_net_worth;?>
                        </select>
                        <span class="error_p" id="error_estimated_net_worth"><?php echo form_error('estimated_net_worth'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_31');?><span>*</span></label>
                        <select class="form-control required" name="education_level2" id="education_level">
                            <?php echo $education_level;?>
                        </select>
                        <span class="error_p" id="error_education_level"><?php echo form_error('education_level'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_32');?>?<span>*</span></label>
                        <ul>
                          <li>
                            <input value="1"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : '' ?> id="us_resident" type="radio" class="rdo-btn-required" name="us_resident2" />
                            <label class="normal-font-label"><?=lang('reli_ye');?></label>
                          </li>
                          <li>
                            <input value="0"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : ' checked' ?> id="us_resident" type="radio" class="rdo-btn-required" name="us_resident2" />
                            <label class="normal-font-label"><?=lang('reli_no');?></label>
                          </li>
                        </ul>
                        <span class="error_p" id="error_us_resident"><?php echo form_error('us_resident'); ?></span>
                    </div>
                    <div class="form-group">
                        <label><?=lang('reli_33');?>?<span>*</span></label>
                        <ul>
                          <li>
                            <input value="1"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : '' ?> id="us_citizen" type="radio" name="us_citizen2" class="rdo-btn-required" />
                            <label class="normal-font-label"><?=lang('reli_ye');?></label>
                          </li>
                          <li>
                            <input value="0"<?php echo isset($user_details['us_citizen']) ? $user_details['us_citizen'] ? '' : ' checked' : ' checked' ?> id="us_citizen" type="radio" name="us_citizen2" class="rdo-btn-required" />
                            <label class="normal-font-label"><?=lang('reli_no');?></label>
                          </li>
                        </ul>
                        <span class="error_p" id="error_us_citizen"><?php echo form_error('us_citizen'); ?></span>
                    </div>
                    <div class="form-registration-btn-holder">
                        <a href="#trading" class="employment-back" aria-controls="personal" role="tab" data-toggle="tab" id="back2">
                            <button type="button"><?=lang('reli_ba');?></button>
                        </a>
                        <a href="javascript:void(0)"  aria-controls="account" role="tab" data-toggle="tab" class="trading-next">
                            <button id="employment-next" type="button" class="btn-submit"><?=lang('reli_ne');?></button>
                        </a>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="account">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 register-new-account-group">
                    <div class="form-group">
                        <label">&nbsp;</label>
                        <p class="optional"><i class="fa fa-info-circle"></i> (<?=lang('reli_35');?>.)</p>
                    </div>

                    <div class="form-group register-information-group">
                        <label><?=lang('reli_36');?><span>*</span>
                            <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i>
                        </label><br/>
                        <div id="s-front-id" class="docs-id" style="display:none"></div>

                        <?php if(IPLoc::Office()){?>
                            <input type="file" name="filename[0]" class="flt-l chbt" id="s-f0" />
                        <?php }else{?>
                            <input type="file" name="filename[0]" class="flt-l" id="s-f0"/>
                        <?php }?>
                        <div id="upbtn">
                            <a class="upload-file btn-up-file flt-l" name="s-front-id"  onclick="return false;">
                                <i class="fa fa-upload"></i>
                                <?=lang('upload_button');?>
                            </a>
                        </div>
                        <p style="float: left"><?=lang('reli_37');?></p>
                    </div>
                    <div class="form-group register-information-group">
                        <label><?=lang('reli_38');?><span>*</span> 
                            <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i>
                        </label><br/>
                        <div id="s-back-id" class="docs-id" style="display:none"></div>
                        <?php if(IPLoc::Office()){?>
                            <input type="file" name="filename[1]" class="flt-l chbt" id="s-f1"/>
                        <?php }else{?>
                            <input type="file" name="filename[1]" class="flt-l" id="s-f1"/>
                        <?php }?>
                        <div id="upbtn">
                            <a class="upload-file btn-up-file flt-l" name="s-back-id"  onclick="return false;">
                                <i class="fa fa-upload"></i>
                                <?=lang('upload_button');?>
                            </a>
                        </div>
                    </div>
                    <div class="form-group register-information-group">
                        <label><?=lang('reli_39');?><span>*</span>
                            <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i>
                        </label><br/>
                        <div id="s-proof-residence" class="docs-id" style="display:none"></div>
                        <?php if(IPLoc::Office()){?>
                            <input type="file" name="filename[2]" class="flt-l chbt" id="s-f2">
                        <?php }else{?>
                            <input type="file" name="filename[2]" class="flt-l" id="s-f2">
                        <?php }?>
                        <div id="upbtn">
                            <a class="upload-file btn-up-file flt-l" name="s-proof-residence"  onclick="return false;">
                                <i class="fa fa-upload"></i>
                                <?=lang('upload_button');?>
                            </a>
                            <p style="float: left"><?=lang('reli_40');?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="register-account-label"><?=lang('reli_41');?></label>
                        <input  type="checkbox" value="1" checked name="technical_analysis" />
                        <label class="normal-font-label sub-label">&nbsp; <?=lang('reli_42');?></label>
                    </div>
                    <div class="form-group">
                        <label class="register-account-label"><?=lang('reli_43');?></label>
                        <input id="agree-checkbox" type="checkbox" />
                        <label class="normal-font-label sub-label">
                        &nbsp; <?=lang('reli_44');?>
                            <a href="<?= $this->config->item('domain-www');?>/Terms-and-conditions" class="company"><?=lang('reli_45');?></a>
                            <?=lang('reli_50')?>
                            <a href="<?= $this->config->item('domain-www');?>/privacy-policy" class="company"><?=lang('reli_46');?></a>
                            , <?=lang('reli_47');?>
                        </label>
                    </div>
                    <div class="form-registration-btn-holder">
                        <a href="#employment" aria-controls="trading" role="tab" data-toggle="tab" class='back-employment' id="back3">
                            <button type="button"><?=lang('reli_ba');?></button>
                        </a>
                        <?php if(!IPLoc::isChinaIP()){ ?>
                            <button id="complete_btn" type="button" class="btn-submit" onclick="goog_report_conversion(); ga('send', 'event', 'button', 'click', 'complete'); return true;"><?=lang('reli_48');?></button>
                        <?php }else{ ?>
                            <button id="complete_btn" type="button" class="btn-submit"><?=lang('reli_48');?></button>
                        <?php } ?>
                    </div>
                  </div>
                </div> 
              </div> <!--end of tab-content-->
            </form>
          </div> 
        </div> 
       </div>
     </section>

<script type="text/javascript">
 var base_url="<?= FXPP::ajax_url() ?>";
    function checkPassword(pass){
        $.post(base_url+"open_account/passwordCheck",{pass:pass,status:"live"},function(data){
            if(data.trim() == "true"){
                $("#error_password").text("This password has already been used by other account under the same email.");
                $("#pass").val("");
            }else{
                $("#error_password").text("");
            }
        })
    }
    $(document).on("change","#employment_status",function(){
        if($(this).val() == "0"){
            $('.source_of_funds').hide();
            $(".industry").show();
            $('#source_of_funds').val("");
            $("#industry").addClass('required');
            $('#source_of_funds').removeClass('required');
        }else{
            $(".industry").hide();
            $("#industry").val("");
            $('.source_of_funds').show();
            $('#source_of_funds').addClass('required');
            $("#industry").removeClass('required');
        }
    });

function saveLiveAccount(){
    var street = $("input:text[name=street2]").val();
    var city = $("input:text[name=city2]").val();
    var state = $("input:text[name=state2]").val();
    var zip = $("input:text[name=zip2]").val();
    var country = $("[name=country2]").val();
    var phone = $("input:text[name=phone2]").val();
    var dob = $("input:text[name=dob2]").val();
    var skype = $("input:text[name=skype]").val();
    var password = $("input:password[name=password2]").val();
    var re_password = $("input:password[name=re_password2]").val();

    var mt_account_set_id = $("[name=mt_account_set_id2]").val();
    var swap_free = $("[name=swap_free]").is(':checked')?1:0;
    var mt_currency_base = $("[name=mt_currency_base2]").val();
    var leverage = $("[name=leverage2]").val();
    var experience1 = $("#agree-11").is(':checked')?1:0;
    var experience2 = $("#agree-21").is(':checked')?1:0;
    var experience3 = $("#agree-31").is(':checked')?1:0;
    var experience = experience1+','+experience2+','+experience3;
    var investment_knowledge = $("[name=investment_knowledge2]").val();
    var trade_duration = $("[name=trade_duration2]").val();
    var politically_exposed_person = $("#politically_exposed_person1").is(':checked')?1:0;
    var risk = $("#risk1").is(':checked')?1:0;
    var auto_generate  = $("[name=auto_generate2]").is(':checked')?1:0;
    var affiliate_code = $("[name=affiliateCodeStr]").val();

    var pblc = [];
    var prvt = [];
    prvt["data"] = {
        street:street,
        city:city,
        state:state,
        zip:zip,
        country:country,
        phone:phone,
        dob:dob,
        password:password,
        re_password:re_password,
        mt_account_set_id:mt_account_set_id,
        swap_free:swap_free,
        mt_currency_base:mt_currency_base,
        leverage:leverage,
        experience:experience,
        investment_knowledge:investment_knowledge,
        trade_duration:trade_duration,
        politically_exposed_person:politically_exposed_person,
        risk:risk,
        auto_generate:auto_generate,
        affiliate_code:affiliate_code
    };

    pblc['request'] = null;
    var site_url="<?= FXPP::ajax_url(); ?>";

    pblc['request'] = $.ajax({
        async: true,
        url: site_url + 'open_account/saveLiveAccount',
        method: 'POST',
        data: prvt["data"]
    });

    pblc['request'].done(function( result ) {
        hideloader();
       if(result.success){
           SaveFlag = false;
       }else{
           SaveFlag = true;
           $('.register-alert-message').html(result.error);
           $('#modal-register-alert').modal('show');
           $('#employment-next').attr('disabled',true);
           $('#employment-next').css('background','gray');
       }
       if (result.registration_limit){
           $('.prompt_reg').removeClass('togglealert');
       }
    });
   pblc['request'].fail(function( jqXHR, textStatus ) {
       $('.register-alert-message').html('Request: [' + jqXHR.status + '] ' + textStatus);
       $('#modal-register-alert').modal('show');
       hideloader();
       SaveFlag = true;
   });
}

</script>
<script type="text/javascript"> 
    var SaveFlag = true;
    $(document).on("click","#personal-next",function(){
        var flag =true;
        var x=0;
        $("#personal input.required,#personal select").each(function(){
            if($("[name=auto_generate2]").is(':checked')){
                if($(this).attr('fv')!='pass'){
                    if($(this).val().length>0)
                    {
                        $(this).closest('div').next('span.red').html("");
                        $(this).removeClass("red-border");
                    }else{
                        $(this).closest('div').next('span.red').html("<p>This is a required field.</p>");
                        $(this).addClass("red-border");
                        $(this).focus();
                        flag= false;
                        $("#modal-alert1").modal('show');
                        $("#error-msg").html('Please complete all the fields.');
                    }
                }else{
                    $(this).closest('div').next('span.red').html("");
                    $(this).removeClass("red-border");
                }

            }else{
                if($(this).val().length>0)
                {
                    if($(this).attr("name") == 'phone'){
                        if($(this).val().length < $('[name=phone_code]').val().length + 5){
                            $(this).closest('div').next('span.red').html("<p>This is a required field.</p>");
                            $(this).addClass("red-border");
                            $(this).focus();
                            flag = false;
                        }
                    }else{
                        $(this).closest('div').next('span.red').html("");
                        $(this).removeClass("red-border");
                    }

                }else{
                    $(this).closest('div').next('span.red').html("<p>This is a required field.</p>");
                    $(this).addClass("red-border");
                    $(this).focus();

                    flag= false;
                }
            }
            x=x+1;
        });

        if(!$("[name=auto_generate2]").is(':checked'))
        {
            var  $pass =  $("#pass").val();
            var  $repass =  $("#repass").val();


            if($pass.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)){

                $("#pass").next('span.red').text("");
                $("#pass").removeClass("red-border");

            }else{

                $("#pass").next('span.red').text("Minimum of 8 characters, combination of a-z, A-Z and at least one digit,0-9.");
                $("#pass").addClass("red-border");
                flag = false;
            }

            if($repass.length>1){
                if($pass == $repass){
                    $("#repass").next('span.red').text("");
                    $("#repass").removeClass("red-border");
                }else{

                    $("#repass").next('span.red').text("Your passwords don't match.");
                    $("#repass").addClass("red-border");
                    flag = false;
                }
            }else{

                $("#repass").next('span.red').text("Re-enter password.");
                $("#repass").addClass("red-border");

                flag = false;
            }
        }

        if(flag){
            $('#personal').removeClass('active');
            $('#p1').css('background', '#fff');
            $('#p1').css('color', '#000');
            $('#trading').addClass('active');
            $('#p2').css('background', '#2fb24a');
            $('#p2').css('color', '#fff');

        }else{
            $(".tabs-title1").addClass("color");
            $(".personal-next").attr("href",'');
        }
    });

    $('#back1').click(function(){
        $('#trading').removeClass('active');
        $('#p2').css('background', '#fff');
        $('#p2').css('color', '#000');
        $('#personal').addClass('active');
        $('#p1').css('background', '#2fb24a');
        $('#p1').css('color', '#fff');
    });

    $(document).on("click","#trading-next",function(){

        var flag = true;
        var errors = new Array();

        $('#loader-holder').show(0);
        $("#trading .required").each(function(){
            if('' == jQuery(this).val()){
                flag = false;
                errors.push(this.name);
            }
        });

        if ($("input[name=risk]:checked").length<=0){
            errors.push( "risk" );
            flag = false;
        }

        if(flag){
            if(SaveFlag){
                SaveFlag = saveLiveAccount();
                hideloader();
            }
        }else{
            for(error in errors){
                switch (errors[error]){
                    case 'mt_account_set_id':
                        jQuery("#error_"+errors[error]).html( "<p>The Account Type field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'mt_currency_base':
                        jQuery("#error_"+errors[error]).html( "<p>The Account Currency Base field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'leverage':
                        jQuery("#error_"+errors[error]).html( "<p>The Leverage field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'investment_knowledge':
                        jQuery("#error_"+errors[error]).html( "<p>The Investment Knowledge Net Worth field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'trade_duration':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'risk':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        break;
                    case 'politically_exposed_person':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        break;
                        hideloader();
                }
            }
        }

    if(flag){
        $('#trading').removeClass('active');
        $('#p2').css('background', '#fff');
        $('#p2').css('color', '#000');
        $('#employment').addClass('active');
        $('#p3').css('background', '#2fb24a');
        $('#p3').css('color', '#fff');
        hideloader();
       }else{
           hideloader();
       }
    });

    $('#back2').click(function(){
        $('#employment').removeClass('active');
        $('#p3').css('background', '#fff');
        $('#p3').css('color', '#000');
        $('#trading').addClass('active');
        $('#p2').css('background', '#2fb24a');
        $('#p2').css('color', '#fff');
    });

     $(document).on("click","#employment-next",function(){
        var flag = true;
        var errors = new Array();

        $("#employment .required").each(function(){
            if('' == jQuery(this).val()){
                flag = false;
                errors.push(this.name);
            }
        });

        if($('#employment_status').val() != ''){
            if($('#employment_status').val() == 0){
                if($('#industry').val() == ''){
                    errors.push( "industry" );
                    flag = false;
                }
            }else{
                if($('#source_of_funds').val() == ''){
                    errors.push( "source_of_funds" );
                    flag = false;
                }
            }
        }
        if ($("input[name=us_citizen2]:checked").length<=0){
            errors.push( "us_citizen" );
            flag = false;

        }
        if ($("input[name=us_resident2]:checked").length<=0){
            errors.push( "us_resident" );
            flag = false;
        }

        if(flag){
            var url="<?= FXPP::ajax_url('') ?>";
            if($('input[name=affiliateCodeStr]').val() != ''){
                $('#loader-holder').show();
                jQuery.ajax({
                    type: 'POST',
                    url: url+'open_account/checkAffiliateCode',
                    dataType: 'json',
                    data: {affiliate_code:$('input[name=affiliateCodeStr]').val()},
                    success: function(response){
                        hideloader();
                        if(response.error){
                            bootbox.alert({
                                title: 'Affiliate Code Error',
                                message: response.message,
                                show: true
                            });
                        }else{
                            $('input#affiliate_code').val($('input[name=affiliateCodeStr]').val());
                        }
                    }
                });
            }else{}

                var employment_status = $("[name=employment_status2]").val();
                var industry = $("[name=industry2]").val();
                var estimated_annual_income = $("[name=estimated_annual_income2]").val();
                var estimated_net_worth = $("[name=estimated_net_worth2]").val();
                var education_level = $("[name=education_level2]").val();
                var us_resident = $("#us_resident2").is(':checked')?1:0;
                var us_citizen = $("#us_citizen2").is(':checked')?1:0;
                var politically_exposed_person = $("#politically_exposed_person1").is(':checked')?1:0;

                var pblc = [];
                var prvt = [];
                prvt["data"] = {
                    employment_status:employment_status,
                    industry:industry,
                    estimated_annual_income:estimated_annual_income,
                    estimated_net_worth:estimated_net_worth,
                    education_level:education_level,
                    us_resident:us_resident,
                    us_citizen:us_citizen,
                    politically_exposed_person:politically_exposed_person,
                };

            if(flag){
            $.ajax({
                    type: 'POST',
                    url: url+'open_account/insertEmploymentDetails',
                    dataType: 'json',
                    data: prvt["data"],
                    success: function(response){
                        hideloader();
                        if(response.success){
                            $('#employment').removeClass('active');
                            $('#p3').css('background', '#fff');
                            $('#p3').css('color', '#000');
                            $('#account').addClass('active');
                            $('#p4').css('background', '#2fb24a');
                            $('#p4').css('color', '#fff');
                        }else{
                            flag = false;
                            //show error
                        }
                    }
            });
        }
        else{
            alert('Error');
        }
        }
        else{
            for(error in errors){
                switch (errors[error]){

                    case 'employment_status':
                        jQuery("#error_"+errors[error]).html( "<p>The Employment Status field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'industry':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'source_of_funds':
                        jQuery("#error_"+errors[error]).html( "<p>The Source of Funds Status field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'estimated_annual_income':
                        jQuery("#error_"+errors[error]).html( "<p>The Estimated Annual Income field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'estimated_net_worth':
                        jQuery("#error_"+errors[error]).html( "<p>The Estimated Net Worth field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'education_level':
                        jQuery("#error_"+errors[error]).html( "<p>The Education Level field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;

                    case 'us_citizen':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        break;
                    case 'us_resident':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        break;

                }
            }
        }

    $('#back3').click(function(){
    $('#account').removeClass('active');
    $('#p4').css('background', '#fff');
    $('#p4').css('color', '#000');
    $('#employment').addClass('active');
    $('#p3').css('background', '#2fb24a');
    $('#p3').css('color', '#fff');
     });
     });
</script>


<?php if(IPLoc::Office()){?>
    <script>
        jQuery('#clientcab').click(function() {
        document.getElementById("form_login").submit();// Form submission
        });

        function scoreCalculate(item_name, previus_score){
            var score_return=parseInt(previus_score);
            var opti_item=0;
            switch (item_name){
                case 'trading_experience':
                    if($("#agree-1").is(':checked')){
                        score_return=score_return+4;
                        opti_item=1;
                    }
                    if($("#agree-2").is(':checked')){
                        score_return=score_return+2;
                        opti_item=2;
                    }

                    if($("#agree-3").is(':checked')){
                        score_return=score_return+4;
                        opti_item=3;
                    }

                    break;

                case 'investment_knowledge':
                    var knowlege_lavel=$("#investment_knowledge").val();
                    switch(knowlege_lavel){
                        case '0':
                            score_return=score_return;
                            opti_item=knowlege_lavel;
                            break;

                        case '1':
                            score_return=score_return+2;
                            opti_item=knowlege_lavel;
                            break;
                        case '2':
                            score_return=score_return+1;
                            opti_item=knowlege_lavel;
                            break;
                        case '3':
                            score_return=score_return+1;
                            opti_item=knowlege_lavel;
                            break;
                    }

                    break;

                case 'investment_risk':
                    if($("#risk1").is(':checked')){
                        score_return=score_return+4;
                        opti_item='first';
                    }
                    if($("#risk").is(':checked')){
                        score_return=score_return;
                        opti_item='second';
                    }

                    break;

                case 'trade_duration':
                    var trade_duration_level=$("#trade_duration").val();
                    switch(trade_duration_level){
                        case '0':
                            score_return=score_return+4;
                            opti_item=trade_duration_level;
                            break;

                        case '1':
                            score_return=score_return+3;
                            opti_item=trade_duration_level;
                            break;
                        case '2':
                            score_return=score_return+1;
                            opti_item=trade_duration_level;
                            break;
                        default :
                            score_return=score_return;
                            opti_item='default';
                    }

                    break;

                case 'employment_status':
                    // var employment_status_level=$("#employment_status").val();
                    score_return=score_return+1;
                    opti_item='1';
                    break;
                case 'industry':
                    var industry_level=$("#industry").val();
                    switch (industry_level){
                        case '0':
                            score_return=score_return+3;
                            opti_item=industry_level;
                            break;
                        case '3':
                            score_return=score_return+4;
                            opti_item=industry_level;
                            break;
                        case '9':
                            score_return=score_return+3;
                            opti_item=industry_level;
                            break;
                        case '13':
                            score_return=score_return+3;
                            opti_item=industry_level;
                            break;
                        default :
                            score_return=score_return+1;
                            opti_item='default';

                    }
                    break;
                case 'education_level':
                    var education_level=$("#education_level").val();
                    switch (education_level){
                        case '0':
                            score_return=score_return+1;
                            opti_item=education_level;
                            break;
                        case '1':
                            score_return=score_return+1;
                            opti_item=education_level;
                            break;
                        case '2':
                            score_return=score_return+2;
                            opti_item=education_level;
                            break;
                        case '3':
                            score_return=score_return+2;
                            opti_item=education_level;
                            break;
                        case '4':
                            score_return=score_return+2;
                            opti_item=education_level;
                            break;
                        default :
                            score_return=score_return+4;
                            opti_item='default';

                    }
                    break;

            }
            return score_return;
        }

        $(document).on("click","#low_scoring_submit",function(){
            if($("#low_scoring_allow").is(':checked')){
                $("#register-live").submit();
                $("#myModal").modal('hide');
            }else{
                $("#modal-alert1").modal('show');
                $("#error-msg").html('You need to agree with Risk Disclosure.');
            }
        });

        $(document).on("click","#complete_btn",function(){
            if( $("#agree-checkbox").is(':checked') ){
                var client_score=0;
                client_score= parseInt(scoreCalculate('trading_experience',client_score)); // agree-1
                client_score=parseInt(scoreCalculate('investment_knowledge',client_score)); // investment_knowledge
                client_score=parseInt(scoreCalculate('investment_risk',client_score)); // risk1
                client_score= parseInt(scoreCalculate('trade_duration',client_score));  // trade_duration
                client_score=parseInt(scoreCalculate('employment_status',client_score));
                client_score=parseInt(scoreCalculate('industry',client_score));
                client_score=parseInt(scoreCalculate('education_level',client_score)); // education_level

                if(parseInt(client_score)<15){
                    $("#myModal").modal('show');
                }else{
                    $.ajax({
                        type: 'POST',
                        url: baseurl+'open_account/deleteIncomplete',
                        dataType: 'json',
                        success: function(response){
                            hideloader();
                            if(response.success){
                                $('#inputEmail3').val(response.user);
                                $('#pass').val(response.pass);
                            }else{
                                flag = false;
                            }
                            $('#modal-success').modal('show');
                        }
                    });
                }
            }else{
                $("#modal-alert1").modal('show');
                $("#error-msg").html('You need to agree with the Terms of Service.');
            }
        });


    </script>
<?php }else{ ?>
    <script>
        function scoreCalculate(item_name, previus_score){
            var score_return=parseInt(previus_score);
            var opti_item=0;
            switch (item_name){
                case 'trading_experience':
                    if($("#agree-1").is(':checked')){
                        score_return=score_return+4;
                        opti_item=1;
                    }
                    if($("#agree-2").is(':checked')){
                        score_return=score_return+2;
                        opti_item=2;
                    }

                    if($("#agree-3").is(':checked')){
                        score_return=score_return+4;
                        opti_item=3;
                    }

                    break;

                case 'investment_knowledge':
                    var knowlege_lavel=$("#investment_knowledge").val();
                    switch(knowlege_lavel){
                        case '0':
                            score_return=score_return;
                            opti_item=knowlege_lavel;
                            break;

                        case '1':
                            score_return=score_return+2;
                            opti_item=knowlege_lavel;
                            break;
                        case '2':
                            score_return=score_return+1;
                            opti_item=knowlege_lavel;
                            break;
                        case '3':
                            score_return=score_return+1;
                            opti_item=knowlege_lavel;
                            break;
                    }

                    break;

                case 'investment_risk':
                    if($("#risk1").is(':checked')){
                        score_return=score_return+4;
                        opti_item='first';
                    }
                    if($("#risk").is(':checked')){
                        score_return=score_return;
                        opti_item='second';
                    }

                    break;

                case 'trade_duration':
                    var trade_duration_level=$("#trade_duration").val();
                    switch(trade_duration_level){
                        case '0':
                            score_return=score_return+4;
                            opti_item=trade_duration_level;
                            break;

                        case '1':
                            score_return=score_return+3;
                            opti_item=trade_duration_level;
                            break;
                        case '2':
                            score_return=score_return+1;
                            opti_item=trade_duration_level;
                            break;
                        default :
                            score_return=score_return;
                            opti_item='default';
                    }

                    break;

                case 'employment_status':
                    score_return=score_return+1;
                    opti_item='1';
                    break;
                case 'industry':
                    var industry_level=$("#industry").val();
                    switch (industry_level){
                        case '0':
                            score_return=score_return+3;
                            opti_item=industry_level;
                            break;
                        case '3':
                            score_return=score_return+4;
                            opti_item=industry_level;
                            break;
                        case '9':
                            score_return=score_return+3;
                            opti_item=industry_level;
                            break;
                        case '13':
                            score_return=score_return+3;
                            opti_item=industry_level;
                            break;
                        default :
                            score_return=score_return+1;
                            opti_item='default';

                    }
                    break;
                case 'education_level':
                    var education_level=$("#education_level").val();
                    switch (education_level){
                        case '0':
                            score_return=score_return+1;
                            opti_item=education_level;
                            break;
                        case '1':
                            score_return=score_return+1;
                            opti_item=education_level;
                            break;
                        case '2':
                            score_return=score_return+2;
                            opti_item=education_level;
                            break;
                        case '3':
                            score_return=score_return+2;
                            opti_item=education_level;
                            break;
                        case '4':
                            score_return=score_return+2;
                            opti_item=education_level;
                            break;
                        default :
                            score_return=score_return+4;
                            opti_item='default';

                    }
                    break;

            }
            return score_return;
        }

        $(document).on("click","#low_scoring_submit",function(){
            if($("#low_scoring_allow").is(':checked')){
                $("#register-live").submit();
                $("#myModal").modal('hide');
            }else{
                alert("You need to agree with risk disclosure.");
            }
        });

        $(document).on("click","#complete_btn",function(){

            if( $("#agree-checkbox").is(':checked') ){
                var client_score=0;
                client_score= parseInt(scoreCalculate('trading_experience',client_score)); // agree-1
                client_score=parseInt(scoreCalculate('investment_knowledge',client_score)); // investment_knowledge
                client_score=parseInt(scoreCalculate('investment_risk',client_score)); // risk1
                client_score= parseInt(scoreCalculate('trade_duration',client_score));  // trade_duration
                client_score=parseInt(scoreCalculate('employment_status',client_score));
                client_score=parseInt(scoreCalculate('industry',client_score));
                client_score=parseInt(scoreCalculate('education_level',client_score)); // education_level
                // alert(client_score);
                if(parseInt(client_score)<15){
                    $("#myModal").modal('show');
                }else{
                    $("#register-live").submit();
                    $('#modal-success').modal('show');
                }
            }else{
                alert('You need to agree with the terms of Service.');
            }
        });
    </script>
<?php } ?>

<script type="text/javascript">
    var baseurl = '<?php echo base_url();?>';
    $(document).ready(function(){

        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            yearRange: "-95:-18",
            minDate: '-95Y',
            maxDate: '-18Y',
            orientation: "top"
        });

        $('#tip_address').tooltip({title: "<p align='left' style='padding: 5px !important;'>Address field should be up to 128 characters.</p>", html: true, placement: "right"});
        $('#tip_city').tooltip({title: "<p align='left' style='padding: 5px !important;'>City field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('#tip_state').tooltip({title: "<p align='left' style='padding: 5px !important;'>State/Province field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('#tip_zip').tooltip({title: "<p align='left' style='padding: 5px !important;'>Postal/Zip Code field should be up to 16 characters.</p>", html: true, placement: "right"});
        $('#tip_phone').tooltip({title: "<p align='left' style='padding: 5px !important;'>Telephone field should be up to 32 characters.</p>", html: true, placement: "right"});
    });

    $(document).on('change', '#country', function(){
        $.ajax({
            type: 'POST',
            url: baseurl+'open_account/checkCountryLimit',
            data: {country: $(this).val()},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                if( response.banned ){
                    $('#personal-next').attr('disabled', 'disabled');
                    $('#register_restrict').modal('show');
                }else{
                    $('#personal-next').removeAttr('disabled');
                }
                if( response.leverage_list ){
                    $('#leverage').html(response.leverage_list);
                }
                hideloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                hideloader();
            }
        });
    });

        var forexmart = "<?php echo FXPP::ajax_url();?>";
        var pblc = [];
        pblc['request']=null;
        if(pblc['request'] != null) pblc['request'].abort();
        //Document 1
        $('a[name=s-front-id]').click(function () {
            $('div#s-front-id').show();
            $('div#s-front-id').html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            var file_data = $("#s-f0").prop("files")[0];
            var myFormData = new FormData();
            myFormData.append('file', file_data);
            myFormData.append('doc_type', 0);
            pblc['request'] =  $.ajax({
                url: forexmart+'open_account/upload/'+$.now(),
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                dataType : 'json',
                data: myFormData
            });
            pblc['request'].done(function( response ) {
                if(response.error){
                    if( response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>' && response.msgError_ext===false){
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>, <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    }else{
                        var rtnError = response.msgError;
                    }
                    $('div#s-front-id').html('<div class="alert alert-danger">'+rtnError+'</div>');
                }else{
                    $('div#s-front-id').html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {

            });
        });

        //Document 2
        $('a[name=s-back-id]').click(function () {
            $('div#s-back-id').show();
            $('div#s-back-id').html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            var file_data = $("#s-f1").prop("files")[0];
            var myFormData = new FormData();
            myFormData.append('file', file_data);
            myFormData.append('doc_type', 1);
            pblc['request'] =  $.ajax({
                url: forexmart+'open_account/upload/'+$.now(),
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                dataType : 'json',
                data: myFormData
            });
            pblc['request'].done(function( response ) {
                if(response.error){
                    if(response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>'){
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>, <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    }else{
                        var rtnError = response.msgError;
                    }
                    $('div#s-back-id').html('<div class="alert alert-danger">'+rtnError+'</div>');
                }else{
                    $('div#s-back-id').html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {

            });
        });

        //Document 3
        $('a[name=s-proof-residence]').click(function () {
            $('div#s-proof-residence').show();
            $('div#s-proof-residence').html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            var file_data = $("#s-f2").prop("files")[0];
            var myFormData = new FormData();
            myFormData.append('file', file_data);
            myFormData.append('doc_type', 2);
            pblc['request'] = $.ajax({
                url: forexmart+'open_account/upload/'+$.now(),
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                dataType : 'json',
                data: myFormData
            });
            pblc['request'].done(function( response ) {
                if(response.error){
                    if(response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>'){
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>, <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    }else{
                        var rtnError = response.msgError;
                    }
                    $('div#s-proof-residence').html('<div class="alert alert-danger">'+rtnError+'</div>');
                }else{
                    $('div#s-proof-residence').html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {

            });
        });
</script>