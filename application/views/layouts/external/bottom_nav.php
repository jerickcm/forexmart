
<link href="<?= $this->template->Css()?>bottom_nav.css" rel="stylesheet">
    <div class="bot-nav-holder">
        <div class="container">
            <div class="row no_padding_it">
                <div id="botnav_left" class="rpj-cz-width-left col-lg-5 col-md-6 col-sm-6 footer-menu-holder ext-arabic-footer-menu-holder bot-nav-left-wide">
                    <div class="mar0pad0 footer-toggle-holder ext-arabic-footer-toggle-holder ext-arabic-footer-toggle pad-l pad_l_for_it">
                        <button type="button" class="mar50 footer-toggle z_index">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <ul class="bot-nav">
                        <li><a href="<?=FXPP::loc_url('legal-documentation')?>">
                                <?= lang('bn_li_ld');?>
                            </a>
                        </li>
                        <li class="ver-line">|</li>
                        <li><a href="<?=FXPP::loc_url('risk-disclosure')?>">
                                <?= lang('bn_li_rd');?>
                            </a></li>
                        <li class="ver-line">|</li>
                        <li class="mg-t"><a href="<?=FXPP::loc_url('privacy-policy')?>">
                                <?= trim(lang('bn_li_pp'));?>
                            </a></li>
                        <li class="ver-line mg-t">|</li>
                        <li class="mg-t"><a href="<?=FXPP::loc_url('terms-and-conditions')?>"><?= trim(lang('bn_li_tnc'));?></a></li>

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div id="botnav_right" class="rpj-cz-width-right mar0pad0 col-lg-7 col-md-6 col-sm-6 CUFB ext-arabic-connect-container mar-r bot-nav-right-wide" >
                    <ul class="connect nav-conn arabic-connect margin_top_for_arabic">

                        <li class="mar0 custome-min-width custom-min">
                            <a style="padding-top: 5px;" class="a1 con-num">
                                <p class="bul_lst2 pw bul_lst2_p">
                                    <img src="<?php echo base_url();?>assets/images/UK-icon.png" alt="UK flag" class="uk-flag-img img-uk bottom-nav-sa">
                                    +44 207 1933 236
                                </p>
                            </a>
                        </li>

                        <li class="mar0 custome-min-width-2 custom-min">
                            <a id="con_us" href="<?=FXPP::loc_url('contact-us')?>" class="a2">
                                <i class="fa fa-phone phone foot-bullet icon_position" style="margin-right: 0px;"></i>
                                <p class="bottom-nav-sa-p bul_lst2 pw pp ru-russia-list2">
                                    <?= lang('bn_li_cu');?>
                                </p>
                            </a>
                        </li>
                        <li class="custome-min-width-3 custom-min">
                            <?php if(FXPP::lang_dir()=='rtl'){?>
                                <style type="text/css">
                                    .spn-4190{float:left;margin: 5px;}
                                    .customfeedback4190{float:left;}
                                </style>
                            <?php }?>
                            <a id="fee_ba" href="#popfeedback" class="mar0500 opt a3" data-toggle="modal" data-target="#popfeedback">
                                <span class="customfeedback4190 img-4190" ><img src="<?= $this->template->Images()?>feedback-icon4.svg" alt="" class="customfeedback4190-2 img-4190">
                                </span>
                                <span class="spn-4190" style="display: inline-block;padding-top: 2px;vertical-align: middle;padding-right:1px;">
                                    <?= lang('bn_li_f');?>
                               </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-hide-menu ext-arabic-hide-menu mar-t">
                    <ul>
                        <li>
                            <a href="<?=FXPP::loc_url('legal-documentation')?>">
                                <?= lang('bn_li_ld');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?=FXPP::loc_url('risk-disclosure')?>">
                                <?= lang('bn_li_rd');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?=FXPP::loc_url('privacy-policy')?>">
                                <?= lang('bn_li_pp');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?=FXPP::loc_url('terms-and-conditions')?>">
                                <?= lang('bn_li_tnc');?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

<!--</div>-->

<script type="text/javascript">
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 5,
            lazyLoad : true,
            navigation : false
        });
        $('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        });
        $('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        })
    });
</script>
<script type="text/javascript">
    $(".footer-toggle").click(function() {
//        $(".footer-hide-menu").toggle( 300, function() {
//        });
//        $(".footer-hide-menu").toggle();
 //  $(".mar-t").toggle();
    });
</script>

<script>
    var language = '<?=FXPP::html_url()?>';
    $(document).ready(function(){
        str = language.replace(/\s/g, '');
        if (str === 'it' ){

            $("#botnav_right").removeClass("col-sm-4");
            $("#botnav_right").addClass("col-sm-5");

            $("#botnav_left").removeClass("col-lg-8");
            $("#botnav_left").removeClass("col-md-8");
            $("#botnav_left").removeClass("col-sm-8");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
        }
        if (str === 'id' ){

            $("#botnav_right").removeClass("col-sm-4");
            $("#botnav_right").addClass("col-sm-5");

            $("#botnav_left").removeClass("col-lg-8");
            $("#botnav_left").removeClass("col-md-8");
            $("#botnav_left").removeClass("col-sm-8");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
        }
        if (str === 'de' ){

            $("#botnav_right").removeClass("col-sm-4");
            $("#botnav_right").addClass("col-sm-5");

            $("#botnav_left").removeClass("col-lg-8");
            $("#botnav_left").removeClass("col-md-8");
            $("#botnav_left").removeClass("col-sm-8");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
        }
        if (str === 'es' ){

            $("#botnav_right").removeClass("col-sm-4");
            $("#botnav_right").addClass("col-sm-5");

            $("#botnav_left").removeClass("col-lg-8");
            $("#botnav_left").removeClass("col-md-8");
            $("#botnav_left").removeClass("col-sm-8");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
        }
        if (str === 'pt' ){

            $("#botnav_right").removeClass("col-sm-4");
            $("#botnav_right").addClass("col-sm-5");

            $("#botnav_left").removeClass("col-lg-8");
            $("#botnav_left").removeClass("col-md-8");
            $("#botnav_left").removeClass("col-sm-8");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
            $("#botnav_left").addClass("col-sm-7");
        }
    });

</script>