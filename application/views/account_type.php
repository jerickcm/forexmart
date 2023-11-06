<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-account-type.css' type='text/css'  />"));
    });
    $(document).ready(function(){
        $("head").append('<style type="text/css">.comparisonContainer .button a.reg1:lang(fr),.comparisonContainer .button a.zerospreadButton:lang(fr),.comparisonContainer .button a.microButton:lang(fr){ font-size: 14px;} @media screen and(max-width: 360px){.comparisonContainer .button a.microButton:lang(fr){ font-size: 13px;} }</style>');
    });
</script>
<style type="text/css"> 
    .comparisonContainer .button a.reg1:lang(fr),.comparisonContainer .button a.zerospreadButton:lang(fr),.comparisonContainer .button a.microButton:lang(fr){
        line-height: inherit!important;
        min-height: 2.8em;
        height: auto!important;
        padding: 5px 0px;
}
</style>
<link rel='stylesheet' href='<?= $this->template->Css()?>custom_account_type.css' type='text/css'  />
<div class="reg-form-holder">
<div class="partnership-main-holder">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-2-left">
                <?php
                include_once('layouts/external/sidebar-left.php');
                ?>
            </div>
            <div class="col-lg-8 col-md-8 col-8-center">

            <div class="">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="license-title ext-arabic-license-title sa-right">
                            <?=lang('at_h1_0');?>
                        </h1>
                        <p class="license-text ext-arabic-license-text">
                            <?=lang('accntcomp_0');?>
                            <a href="<?php echo base_url()?>financial-instruments"><?=lang('accntcomp_x0');?></a>.<?=lang('accntcomp_1');?>
                        </p>
                        <p class="license-text ext-arabic-license-text">
                            <?=lang('accntcomp_2');?>
                            <a href="<?php echo FXPP::loc_url('register/demo')?>"><?=lang('accntcomp_3');?></a>
                            <?=lang('accntcomp_4');?>
                        </p>


                        <section id="accountComparison">
                            <ul id="comparison">
                                <li class="compare">
                                    <ul class="comparisonContainer">
                                        <li><img src="<?= $this->template->Images()?>standard.jpg" class="img-responsive img-center" alt="" /></li>
                                        <li class="titleComparison"><h3><?=lang('accntcomp_23');?></h3></li>
                                        <li>
                                            <ul class="contentComparison">
                                                <li>
                                                    <?=lang('accntcomp_23_1');?>
                                                    <span class="blurbar">
                                                        <?=lang('accntcomp_23_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_24_1');?>
                                                    <span id="mlots"  class="blurbar">
                                                        <?=lang('accntcomp_24_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_25');?>
                                                    <span  class="blurbar">
                                                        <?=lang('accntcomp_25_1');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_26');?>
                                                    <span  class="blurbar">
                                                        <?=lang('accntcomp_26_1');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_28');?>
                                                    <span  class="blurbar">
                                                        <?=lang('accntcomp_28_2');?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="button">
                                            <a class="reg1" href="<?=FXPP::loc_url('register');?>"><?=lang('Regbtn');?></a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="compare">
                                    <ul class="comparisonContainer">
                                        <li><img src="<?= $this->template->Images()?>zerospread.jpg" class="img-responsive img-center" alt="" /></li>
                                        <li class="titleComparison"><h3 class="zerospread"><?=lang('accntcomp_24');?></h3></li>
                                        <li>
                                            <ul class="contentComparison2">
                                                <li>
                                                    <?=lang('accntcomp_23_1');?>
                                                    <span>
                                                        <?=lang('accntcomp_23_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_24_1');?>
                                                    <span>
                                                        <?=lang('accntcomp_24_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_25');?>
                                                    <span>
                                                        <?=lang('accntcomp_25_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_27');?>
                                                    <span>
                                                        <?=lang('accntcomp_27_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_29');?>
                                                    <span>
                                                        <?=lang('accntcomp_29_2');?>
                                                    </span>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="button"><a class="zerospreadButton" href="<?=FXPP::loc_url('register');?>"><?=lang('Regbtn');?></a></li>
                                    </ul>
                                </li>
                      
                                <li class="compare">
                                    <ul class="comparisonContainer">
                                        <li><img src="<?= $this->template->Images()?>micro.jpg" class="img-responsive img-center" alt="" /></li>
                                        <li class="titleComparison"><h3 class="micro"><?=lang('accntcomp_30');?></h3></li>
                                        <li>
                                            <ul class="contentComparison2">
                                                <li>
                                                    <?=lang('accntcomp_23_1');?>
                                                    <span>
                                                        <?=lang('accntcomp_23_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_30_1');?>
                                                    <span>
                                                        <?=lang('accntcomp_30_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_25');?>
                                                    <span>
                                                        <?=lang('accntcomp_25_2');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_30_3');?>
                                                    <span>
                                                        <?=lang('accntcomp_30_4');?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <?=lang('accntcomp_30_5');?>
                                                    <span>
                                                        <?=lang('accntcomp_29_2');?>
                                                    </span>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="button"><a class="microButton" href="<?=FXPP::loc_url('register/microAccount');?>"><?=lang('Regbtn');?></a></li>
                                    </ul>
                                </li>

                            </ul>
                        </section>
                        <!--<div class="row account-type-holder ">
                            <div class="col-md-6 account-types ext-arabic-account-types sa-null-float">
                                <h1 class="title-sub">
                                    <?/*=lang('accntcomp_5');*/?>
                                </h1>
                                <img src="<?/*= $this->template->Images()*/?>laptop-trading-chart-300x182.png" height="182px" width="300px" class="img-responsive img-chart">
                                <div class="heightfix">
                                    <p class="license-text">
                                        <?/*=lang('accntcomp_6');*/?>
                                    </p>
                                </div>
                                <a href="<?php /*echo FXPP::loc_url('register')*/?>" class="live-account-type ext-arabic-live-account-type">
                                    <?/*=lang('accntcomp_7');*/?>
                                </a>
                            </div>
                            <div class="col-md-6 account-types ext-arabic-account-types sa-null-float">
                                <h1 class="title-sub">
                                    <?/*=lang('accntcomp_8');*/?>
                                </h1>
                                <img src="<?/*= $this->template->Images()*/?>laptop-trading-chart-300x182.png" height="182px" width="300px" class="img-responsive img-chart">
                                <div class="heightfix">
                                    <p class="license-text">
                                        <?/*=lang('accntcomp_9');*/?>
                                    </p>
                                </div>
                                <a href="<?php /*echo FXPP::loc_url('register')*/?>" class="live-account-type ext-arabic-live-account-type">

                                    <?/*=lang('accntcomp_10');*/?>
                                </a>
                            </div>
                        </div>-->
                    </div>
                        <div class="col-lg-12">
                            <p class="ins-tab-text"></p>
                            <!--<div class="table-responsive">
                                <table id="forexTable" class="table table-bordered ins-table">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <?/*=lang('accntcomp_11');*/?>
                                            </td>
                                            <td>
                                                <?/*=lang('accntcomp_12');*/?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?/*=lang('accntcomp_13');*/?>
                                            </td>
                                            <td>
                                                USD, EUR, GBP
                                            </td>
                                            <td>
                                                USD, EUR, GBP
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?/*=lang('accntcomp_14');*/?>
                                            </td>
                                            <td>
                                                1 USD / 1 EUR / 1 GBP
                                            </td>
                                            <td>
                                                1 USD / 1 EUR / 1 GBP
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            Spread [1]
                                        </td>
                                        <td>
                                            2 pips
                                        </td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Fee [2]
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            2 pips
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?/*=lang('accntcomp_15');*/?>
                                        </td>
                                        <td>
                                            0,01 lot
                                        </td>
                                        <td>
                                            0,01 lot
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?/*=lang('accntcomp_16');*/?>
                                        </td>
                                        <td>
                                            1:1 - 1:1000
                                        </td>
                                        <td>
                                            1:1 - 1:1000
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?/*=lang('accntcomp_17');*/?>
                                        </td>
                                        <td>
                                            30%
                                        </td>
                                        <td>
                                            30%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?/*=lang('accntcomp_17');*/?>
                                            Stop Out
                                        </td>
                                        <td>
                                            10%
                                        </td>
                                        <td>
                                            10%
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>-->
                            <p class="ins-text-sub">
                                <span class="legend">[1]</span>
                                - <?=lang('accntcomp_18');?>
                                <a href="<?= FXPP::loc_url('financial-instruments')?>"><?=lang('accntcomp_19');?></a>.
                                <br>
                                <span class="legend">[2]</span>
                                - <?=lang('accntcomp_20');?>
                                <a href="<?= FXPP::loc_url('financial-instruments')?>"><?=lang('accntcomp_19');?></a>.
                                <br>
                                <span class="legend">[3]</span>
                                -  <?=lang('accntcomp_21');?>
                                <br>
                                <span class="legend" style="visibility: hidden">[4]</span>
                                -   <?=lang('accntcomp_21_0');?>
                                <br>
                                <span class="legend"> </span>
                                <?=lang('accntcomp_22');?>
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-2-right">
                <?php
                include_once('layouts/external/sidebar-right.php');
                ?>
            </div>
        </div>
    </div>
</div>
</div>

        <div class="parent-chat-widget-container col-centered fix-chat-widget" style="display:none;" id="support-wrapper">
            <div class="chat-widget-container">
                <div class="chat-widget-header">
                    <a href="javascript:;" class="chat-widget-button-close"></a>
                </div>
                <div class="chat-widget-body">
                    <div class="chat-widget-img-support">
                        <img src="<?= $this->template->Images()?>chat-widget-img.png" alt="Chat">
                    </div>
                    <div class="chat-widget-statement">
                        <div class="arrow-up"></div>
                        <div class="arrow-left"></div>
                        <div class="widget-content">
                            <p>Questions? <br> How can I help you?</p>
                        </div>
                    </div>
                </div>
                <div class="chat-widget-footer">
                    <a href="javascript:void(Tawk_API.toggle())"><button id="start-chat">Start Chat</button></a>
                </div>
            </div>
        </div>
<script>
    $(document).ready(function(){
        setTimeout(function(){  
            $('#support-wrapper').toggle('slide');
            var w_width = $(this).width();
            if(w_width < 1551 && w_width > 1340){
                $(".sidebar-left").css('margin-top','10px');
            } else{
                $(".sidebar-left").css('margin-top','400px');
            }
        }, 5000);
    });
    /*
    $("#start-chat").on("click", function () {
        $("#tawkchat-minified-container").click();
        console.log('This is TowkTO test');
    });
    */
</script>
<style type="text/css">
    .chat-widget-footer a{text-decoration:none;}
</style>
