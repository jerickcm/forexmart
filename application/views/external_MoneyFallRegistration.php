<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-moneyfallregistration.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">

            <h1 class="license-title">
                <?= lang('cmf_h1_0')?>
            </h1>
            <div class="col-lg-12">
                <ul class="contest-tab">
                    <li id="PublicRatings">
                        <a id="pr"  href="<?=FXPP::loc_url('contest/ratings')?>" >
                            <?= lang('cmf_ranking')?>
                        </a></li>
                    <li id="PublicWinners">
                        <a  id="pw" href="<?=FXPP::loc_url('contest/winners')?>"  >
                            <?= lang('cmf_winners')?>
                        </a></li>
                    <li id="PublicContestRules"><a id="pcr" href="<?=FXPP::loc_url('contest/contest-rules')?>"  >
                            <?= lang('cmf_contestrules')?>
                        </a></li>

                </ul>
                <div class="clearfix"></div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="tab0">
                        <div class="row">
                            <?php if($insertsuccess==true):?>

                                <div id="registersuccess" class="col-md-4 col-centered margin" >
                                    <h3 class="ty">
                                        <?= lang('mfr_0_0')?>
                                    </h3>
                                    <p class="suc-msg">
                                        <?= lang('mfr_0_1')?>
                                    </p>
                                    <br/>
                                    <a href="<?= FXPP::loc_url('forex-contests/money-fall'); ?>" class="btn-contest-reg" >
                                        <?= lang('mfr_0_2')?>
                                    </a>
                                </div>

                            <?php else: ?>

                                <div id="registerform" class="col-md-8 col-centered newmargin">

                                <?php if(isset($Operations)):?>
                                    <?php if(!$Operations):?>
                                        <div class="alert alert-info">
                                            <strong>
                                                <?= lang('mfr_0_3')?>
                                            </strong>
                                            <?= lang('mfr_0_4')?>
                                        </div>

                                    <?php else: ?>

                                            <?php if(isset($PermitIP)):?>

                                                <?php if($PermitIP):?>

                                                    <?= form_open(FXPP::www_url('Money_fall_registration'),array('id' => 'RegisterForm','class'=> 'form-horizontal reg-frm'),''); ?>
                                                    <div class="form-group">
                                                        <div class="validation-result" id="validation-result">
                                                            <?php
                                                            if(validation_errors()){
                                                                echo '<div class="bg-danger">';
                                                                echo validation_errors();
                                                                echo '</div>';
                                                            }
                                                            if(!empty($custom_validation_success)){
                                                                echo '<div class="bg-success">';
                                                                echo $custom_validation_success;
                                                                echo '</div>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label( lang('mfr_inc_0'), 'FullName', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'FullName',
                                                                'id' => 'FullName',
                                                                'type' => 'text',
                                                                'maxlength' => '100',
                                                                'class' => 'form-control round-0',
                                                                'placeholder' => '',
                                                                'value' => set_value('FullName', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>

                                                        <div class="reqs col-sm-4 FullName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label( lang('mfr_inc_1'), 'Email', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'Email',
                                                                'id' => 'Email',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0',
                                                                'placeholder' => '',
                                                                'value' => set_value('Email', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label( lang('mfr_inc_2'), '', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'NickName',
                                                                'id' => 'NickName',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0',
                                                                'placeholder' => '',
                                                                'value' => set_value('NickName', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 NickName">
                                                            <?php if (!empty($custom_validation)){ echo $custom_validation; } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_3'), '', $attributes); ?>

                                                        <div class="col-sm-5">
                                                            <select name="Country" class="form-control round-0" id="countrylist" >
                                                                <?php echo $countries; ?>
                                                            </select>
                                                        </div>
                                                        <div class="reqs col-sm-4 Country">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_4'), 'City', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'City',
                                                                'id' => 'City',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0',
                                                                'placeholder' => '',
                                                                'value' => set_value('City', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 City">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_5'), 'PhoneNumber', $attributes); ?>

                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'PhoneNumber',
                                                                'id' => 'PhoneNumber',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0',
                                                                'placeholder' => '',
                                                                'value' => set_value('PhoneNumber',$calling_code)
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 PhoneNumber">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_6'), '', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <?php $datac = array(
                                                                        'name'          => 'swapfree',
                                                                        'id'            => 'swapfree',
                                                                        'value'         => set_value('swapfree', 1 ,TRUE),
                                                                    ); ?>
                                                                    <?= form_checkbox($datac);?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label('', '', $attributes); ?>

                                                        <div class="col-sm-5">
                                                            <!--                                    <div class="g-recaptcha" data-sitekey="6LfWygoTAAAAAJCnjP8XzuoYFhXp7QD22QFrMgZb"></div>-->
                                                            <div class="g-recaptcha" data-sitekey="6LeJqQsTAAAAAKiXcxToS7gtj_omu_3IZHca_cwS"></div>
                                                        </div>
                                                        <div class="reqs col-sm-4 recaptcha">
                                                            <?php if (!empty($custom_validation1)){ echo $custom_validation1; } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label('', '', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <?php $datac = array(
                                                                        'name'          => 'cra',
                                                                        'id'            => 'cra',
                                                                        'value'         => set_value('cra', ''),
                                                                    ); ?>
                                                                    <?= form_checkbox($datac);?>
                                                                    <?= lang('mfr_0_5')?>
                                                                    <a href="<?=FXPP::loc_url('contest/contest-rules')?>"  target="_blank" class="agreement">
                                                                        <?= lang('mfr_0_6')?>
                                                                    </a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="reqs col-sm-4 cra">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label contest-label"></label>
                                                        <div class="col-sm-5">
                                                            <?php
                                                            $data = array(
                                                                'name'          => 'button',
                                                                'id'            => 'btnSubmit',
                                                                'value'         => 'true',
                                                                'type'          => 'Submit',
                                                                'content'       => lang('mfr_inc_9'),
                                                                'class'=>'btn-contest-sub'
                                                            );

                                                            if(!IPLoc::isChinaIP()){
                                                                $data['onclick'] = 'goog_report_conversion();';
                                                            }
                                                            ?>
                                                            <?= form_button($data); ?>
                                                        </div>
                                                    </div>
                                                    <?= form_close()?>

                                                <?php else: ?>
                                                    <div class="alert alert-info">
                                                        <strong>
                                                            <?= lang('mfr_0_5')?>
                                                        </strong>
                                                        <?= lang('mfr_0_6')?>
                                                    </div>
                                                <?php endif ?>

                                            <?php else: ?>
                                                <div class="alert alert-info">
                                                    <strong>
                                                        <?= lang('mfr_0_5')?>
                                                    </strong>
                                                    <?= lang('mfr_0_6')?>
                                                </div>
                                            <?php endif?>

                                    <?php endif?>

                                <?php else: ?>

                                <?php endif ?>

                                </div>

                            <?php endif?>
                        </div>
                    </div>
                </div>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>

<?php /** Preloader Modal Start */ ?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<?php /** Preloader Modal End */ ?>
<?= $this->load->ext_view('modal', 'register_restrict', '', TRUE); ?>
<script type='text/javascript'>
    $(document).on('click', '#PublicRatings', function (e) {
        $('#PublicRatings a').addClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicWinners', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').addClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicContestRules', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').addClass('active');
    });


</script>


<script type='text/javascript'>
    var pblc = [];
    var site_url="<?=FXPP::loc_url('').'/'?>";

    $( document ).ready(function() {

        $('#FullName, #Email').blur(function(){
            var email = jQuery('#Email').val();
            var full_name = jQuery('#FullName').val();
            if( $.trim(email) != '' && jQuery.trim(full_name) != '' ){
                $.ajax({
                    type: "POST",
                    url: site_url+'contest/getNickName',
                    data: {
                        email: $('#Email').val(),
                        full_name: $('#FullName').val()
                    },
                    dataType: 'json',
                    success: function(response){
                        if($.trim(response.nickname) != ''){
                            $('#NickName').val(response.nickname)
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });

        pblc['RegisterForm'] = $('#RegisterForm').validate({
           rules:{
               FullName:{required : true},
                Email:{required : true,email: true},
                NickName:{required : true},
                Country:{required : true},
                City:{required : true},
                PhoneNumber:{required : true},
                cra:{required : true}

            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "FullName" )
                    error.insertAfter(".FullName");
                else if  (element.attr("name") == "Email" )
                    error.insertAfter(".Email");
                else if  (element.attr("name") == "NickName" )
                    error.insertAfter(".NickName");
                else if  (element.attr("name") == "Country" )
                    error.insertAfter(".Country");
                else if  (element.attr("name") == "City" )
                    error.insertAfter(".City");
                else if  (element.attr("name") == "PhoneNumber" )
                    error.insertAfter(".PhoneNumber");
                else if  (element.attr("name") == "cra" )
                    alert('Please check the box to confirm your agreement');
            },
            submitHandler: function(form) {
                form.submit();
            }
        })

    });



</script>


<script type="text/javascript">

    var hh=0;
    var pr=0;
    var pw=0;
    var pcr=0;


    $(window).load(function() {

        pr = parseFloat($('#PublicRatings').height());
        pw = parseFloat($('#PublicWinners').height());
        pcr = parseFloat($('#PublicContestRules').height());


        hh=parseFloat(Math.round(Math.max(pr,pw,pcr)));
        $('#PublicRatings').height(hh);
        $('#PublicWinners').height(hh);
        $('#PublicContestRules').height(hh);


    });
    $(window).resize(function() {

        pr = parseFloat($('#PublicRatings').height());
        pw = parseFloat($('#PublicWinners').height());
        pcr = parseFloat($('#PublicContestRules').height());


        hh=parseFloat(Math.round(Math.max(pr,pw,pcr)));
        $('#PublicRatings').height(hh);
        $('#PublicWinners').height(hh);
        $('#PublicContestRules').height(hh);
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

<?php echo $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?php if(IPLoc::Office_and_Vpn()){?>
    <style type="text/css">
        .error{
            color:red;
            font-size: 14px;
            font-weight: normal;
            text-align: left;
        }
    </style>
<?php }?>

