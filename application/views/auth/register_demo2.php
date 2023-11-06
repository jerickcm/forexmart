<script type="text/javascript">
    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 95) {
            $('#nav').addClass('nav-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
       /* $("#next").click(function(){
            $(".info-text").text("Your Almost Done.");
        });*/
        $("#back").click(function(){
            $(".info-text").text("<?=lang('rede_h')?>");
            $(".tabs-title2").removeClass("color");
            $(".tabs-title1").addClass("color");
            $("#next").attr("href",'');
        });


        $("#amount").keydown(function (e) {
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




    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".personal-next").click(function(){
            $(".tabs-title1").removeClass("color");
            $(".tabs-title2").addClass("color");
        });
        $(".trading-next").click(function(){
            $(".tabs-title2").removeClass("color");
            $(".tabs-title3").addClass("color");
        });
        $(".trading-back").click(function(){
            $(".tabs-title2").removeClass("color");
            $(".tabs-title1").addClass("color");
        });
        $(".acc-back").click(function(){
            $(".tabs-title3").removeClass("color");
            $(".tabs-title2").addClass("color");
        });
    });
</script>
<style>
    .slideThree:after {
        content: '<?=lang('rede_no')?>'!important;;
    }
    .slideThree:before {
        content: '<?=lang('rede_ye')?>'!important;
    }

    @media screen and (min-width: 300px) and (max-width: 479px){
        .task2163{
            width: 100%;
            margin: auto
        }
    }
    @media screen and (min-width: 480px) and (max-width: 1000px){
        .task2163{
            width: 70%;
            margin: auto
        }
    }
    @media screen and (-webkit-min-device-pixel-ratio:0) and (max-width: 991px) {
        .step-tab-holder_custom:lang(ru){
            display: none!important;
        }
        .step-tab-holder_custom:lang(jp){
            display: none!important;
        }
        .step-tab-holder_custom:lang(id){
            display: none!important;
        }
        .step-tab-holder_custom:lang(de){
            display: none!important;
        }
        .step-tab-holder_custom:lang(fr){
            display: none!important;
        }
        .step-tab-holder_custom:lang(it){
            display: none!important;
        }
        .step-tab-holder_custom:lang(sa){
            display: none!important;
        }
        .step-tab-holder_custom:lang(es){
            display: none!important;
        }
        .step-tab-holder_custom:lang(pt){
            display: none!important;
        }
        .step-tab-holder_custom:lang(bg){
            display: none!important;
        }
        .step-tab-holder_custom:lang(my){
            display: none!important;
        }
    }
    @-moz-document url-prefix() {
        @media screen  and (max-width: 991px) {
            .step-tab-holder_custom:lang(ru) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(jp) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(id) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(de) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(fr) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(it) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(sa) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(es) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(pt) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(bg) {
                display: none !important;
            }

            .step-tab-holder_custom:lang(my) {
                display: none !important;
            }
        }
    }
    .nav-fix
    {
        position: fixed;
        top: 0;
        z-index: 9999;
        width: 100%;
        transition: all ease 0.3s;
    }
    .error{ color: #a94442};
</style>


<script>
//var base_url = "<?php //echo base_url();?>//";
var base_url="<?=FXPP::ajax_url(); ?>";

jQuery(document).ready(function () {

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
});

    function checkPassword(pass){


        $.post(base_url+"register/passwordCheck",{pass:pass,status:"demo"},function(data){


            if(data.trim() == "true"){

                $("#error_password").text("This password has already been used by other account under the same email.");
                $("#pass").val("");
                //alert(flg);

            }else{
                console.log("test fail"+ data);
                $("#error_password").text("");
            }
        })


    }

    $(document).on("focus",'input,select',function(){
        $(this).css('border','');
        $(this).removeClass("red-border");
        
    })

var SaveDeom= true;
    $(document).on("click",'.next_step',function(event){


        var  $country =  $("#country").val();
        var flag = true;


        if($country.length>1){
            $("#country").css("border",'');
           // $("#country").css("background-color",'');
        }else{
            $("#country").css("border",' 1px solid red');
           // $("#country").css("background-color",'red');
            flag = false;
        }

         if($('#phone').val() != ''){
            var isNumberic = $.isNumeric($('#phone').val());
            if(!isNumberic){
                $('#err-phone').html('Please enter a number.');
                flag = false;
            }
        }

        if(flag){

            $(".tabs-title1").removeClass("color");
            $(".tabs-title2").addClass("color");
            var langauge= '<?=FXPP::html_url();?>';
            var lang = langauge.replace(/\s/g, '');
            if ( lang =='ru'){
                console.log('ru')
                $(".info-text").text("");
            }else{
                $(".info-text").text("<?=lang('demo_reg_step_3');?>");
            }


            $("#next").attr("href",'#step3');
            $("#next").click();
            if(SaveDeom){
                SaveDeom = saveDemoAccount();
            }
        }else{
            $(".tabs-title2").removeClass("color");
            $(".tabs-title1").addClass("color");
            $(".info-text").text("Thank you, You're half way to completing your demo account.");
        }

    })
    
    $(document).ready(function(){
        $(document).on('keyup', '.amount_err', function () {
            $('#err-amount').hide();
        });
    });
    
    $(document).on("click",'#step_complete',function(event){

        flag = true;
        //alert("test")
        $("#step3 select").each(function(){

            if($(this).val().length>0){

               $(this).removeClass("red-border");
            }else{
                $(this).addClass("red-border");
               // $(this).focus();
                flag = false;
            }
        });

        if($('#amount').val() != ''){
            var isNumberic = $.isNumeric($('#amount').val());
            if(!isNumberic){
                $('#err-amount').show();
                $('#err-amount').html('Please enter numbers.');
                flag = false;
            }
        }else{
            $('#err-amount').html('<?=lang('demo_amount1')?>.');
            flag = false;
        }

        if(flag){
           $("#demo_form").submit();
            $("#next").attr("href",'#step3');
            $("#next").click();
        }
    })

function saveDemoAccount(){



    var country = $("[name=country]").val();
    var phone = $("input:text[name=phone]").val();
    $.post(base_url+"register/saveDemoAccount",{country:country,phone:phone},function(data){
    },'json')
    return false;
}

</script>
<style>

    .red-border{
        border: 1px solid red; 
    }

</style>

<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <h1 class="info-text small-info-text"><?=lang('rede_h');?></h1>
            <div class="step-tab-holder_custom step-tab-holder ">
                <ul>
                    <li class="tabs-title1 color">
                        <img src="<?= $this->template->Images()?>step.png" class="img-reponsive" width="50"/> <?=lang('rede_00');?>
                    </li>
                    <li>
                        <img src="<?= $this->template->Images()?>nxt.png" class="img-reponsive" width="50"/>
                    </li>
                    <li class="tabs-title2">
                        <img src="<?= $this->template->Images()?>step.png" class="img-reponsive" width="50"/> <?=lang('rede_01');?>
                    </li>
                </ul><div class="clearfix"></div>
            </div>
            <form id="demo_form" action="" method="post" class="task2163">
            <div class="tab-content" style="margin-top: 30px;">
                <input type="hidden" id="username" name="username" value="<?php echo $this->session->userdata('email_demo');?>">
                <div role="tabpanel" class="step2 tab-pane active" id="step2">
                    <div class="col-lg-6 col-md-6 col-centered">
                        <div class="form-holder registration-form-holder">
                            <div class="title-registration-form-holder">
                                <img src="<?= $this->template->Images()?>step.png" width="50" height="50"/>
                                <h1><?=lang('rede_00');?></h1>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-horizontal form-max-holder">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('rede_02');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select id="country" name="country" class="form-control round-0 ">
                                         <!--   <option value="">Choose</option>-->
                                            <?php echo $countries; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('rede_03');?></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <input name="phone" type="text" class="form-control round-0" id="phone" placeholder="<?=lang('rede_03');?>" value="<?="+".$calling_code?>">
                                        <span id="err-phone" class="error xssCheck" style="float: left;"><?php //echo  form_error('amount')?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8 no-padding-column">
                                        <a class="next2" href="Javascript:;" role="tab" data-toggle="tab" id="next"><button type="button" id="personal-next" class="btn-submit next_step"><?=lang('rede_ne');?></button></a>
                                    </div><div class="clearfix"></div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="step3 tab-pane" id="step3">
                    <div class="col-lg-6 col-md-6 col-centered">
                        <div class="form-holder registration-form-holder">
                            <div class="title-registration-form-holder">
                                <img src="<?= $this->template->Images()?>step.png" width="50" height="50"/>
                                <h1><?=lang('rede_01');?></h1>
                            </div>
                            <div class="form-horizontal form-max-holder">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label no-padding-column-label"><?=lang('rede_04');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select id="account_type" name="account_type" class="form-control round-0">
                                           <!-- <option value="">Choose</option>-->
                                           <?php echo $account_type; ?>
                                        </select>
                                        <?php //echo  form_error('account_type')?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label no-padding-column-label"><?=lang('rede_05');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select id="currency" name="currency" class="form-control round-0">
                                            <!--<option value="">Choose</option>-->
                                            <?php echo $account_currency_base; ?>
                                        </select>
                                        <?php //echo  form_error('currency')?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label no-padding-column-label"><?=lang('rede_06');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select id="leverage" name="leverage" class="form-control round-0">
                                           <!-- <option value="">Choose</option>-->
                                            <?php echo $leverage; ?>
                                        </select>
                                        <?php //echo  form_error('leverage')?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label no-padding-column-label"><?=lang('rede_07');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <!--<select id="amount" name="amount" class="form-control round-0">
                                            <?php /*echo $amount; */?>
                                        </select>-->
                                        <input id="amount" name="amount" class="form-control round-0 amount_err" type="text">
                                        <span id="err-amount" class="error" style="float: left;"><?php //echo  form_error('amount')?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8 no-padding-column">
                                        <label class="no-padding-column-label"><?=lang('rede_08');?></label>
                                        <div class="slideThree">
                                            <input  type="checkbox" value="1" id="slideThree" name="technical_analysis" onclick="" style="display: none;"/>
                                            <label for="slideThree"></label>
                                        </div>
                                    </div><div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class="offset-buttons-holder">
                                        <div class="anchor-back-button"><a href="#step2" aria-controls="step2" role="tab" data-toggle="tab" id="back"><?=lang('rede_ba');?></a></div>
                                        <div class="anchor-submit-button">
                                            <?php if(!IPLoc::isChinaIP()){ ?>
                                            <button id="step_complete" type="button" class="btn-submit" onclick="goog_report_conversion();"><?=lang('rede_09');?></button>
                                            <?php }else{ ?>
                                            <button id="step_complete" type="button" class="btn-submit"><?=lang('rede_09');?></button>
                                            <?php } ?>
                                        </div>
                                    </div><div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'register_restrict', '', TRUE); ?>
<script type="text/javascript">
    var baseurl = '<?php echo FXPP::ajax_url();?>';

    $(document).on('change', '#country', function(){
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
                    $('#personal-next').attr('disabled', 'disabled');
                    $('#register_restrict').modal('show');
                }else{
                    $('#personal-next').removeAttr('disabled');
                }
                if( response.leverage_list ){
                    $('#leverage').html(response.leverage_list);
                }
                $('#loader-holder').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
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
    /* ]]> */
</script>
<?php } ?>
<script type="text/javascript"  src="//www.googleadservices.com/pagead/conversion_async.js"></script>

    <script type="text/javascript">
        $("input").keyup(function() {
            this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
        });
        $("textarea").keyup(function() {
            this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
        });
    </script>

<style type="text/css">
    .error{
        color:red;
        font-size: 14px;
        font-weight: normal;
        text-align: left;
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

        $('#demo_form').validate({ // initialize the plugin
            rules: {
                phone: {
                    required: true,
                    regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                },
                amount: {
                    required: true,
                    regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"
                },

            },
            messages: {
                phone:{
                    required: "<?=lang('validate_engrus0'); ?>"+" Phone Number.",
                    regex: "<?=lang('validate_engrus1'); ?>"+" Phone Number " + "<?=lang('validate_engrus2'); ?>"
                },
                amount:{
                    required: "<?=lang('validate_engrus0'); ?>"+" Amount.",
                    regex: "<?=lang('validate_engrus1'); ?>"+" Amount " + "<?=lang('validate_engrus2'); ?>"
                },
            },
            submitHandler: function (form) {

                return true;
            }
        });

        $("#phone").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and +
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 107]) !== -1 ||
                // Allow: Shift+= for plus sign
                (e.keyCode === 187 && (e.shiftKey === true || e.metaKey === true)) ||
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
    });
</script>
<!-- for micro accounts -->
<script type="text/javascript">
    $(document).ready(function () {
        var selected = $('#currency').val();
        console.log(selected);
        if (<?php echo "'".$micro."'"; ?> == '1'){//micro
            $('#account_type').val('4');
            var list = ["USD", "EUR"];
            $('#currency option').filter(function () {
                return $.inArray(this.value, list) == -1
            }).hide()
        }
        $('#account_type').on('change', function() {
            var list = ["USD", "EUR"];
            var original = ["EUR", "USD", "GBP", "RUR", "MYR", "IDR", "THB", "CNY"];
            if ($('#account_type').val() == 4) {
                //$('#mt_account_set_id option[value=2]').remove();
                $('#currency option').filter(function () {
                    return $.inArray(this.value, list) == -1
                }).hide()
            } else {
                $('#currency').find('option').remove()
                for (var i = 0; i < original.length; i++) {
                    $('#currency').append("<option>" + original[i] + "</option>");
                }
                $('#currency').val(selected);
            }
        });
    });
</script>
<!-- end of micro accounts -->