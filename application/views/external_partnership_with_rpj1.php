<?php
$js = $this->template->Js();
$css = $this->template->Css();
$this->lang->load('rpjracing');
?>
<script src="<?= $js?>jquery-1.11.3.min.js"></script>

<link rel='stylesheet' href='<?= $css?>rpj/jquery.fancybox.css'>
<link rel='stylesheet' href='<?= $css?>owl.carousel.css'>
<link rel='stylesheet' href='<?= $css?>owl.theme.css'>
<link rel='stylesheet' href='<?= $css?>rpj1.css'>
<link rel='stylesheet' href='<?= $css?>rpj/custom_rpj.css'>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src='<?= $js?>rpj/modernizr.custom.79639.js'></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
</script>
<style>
    .thumb img:lang(ru){height:300px}.thumb_overlay:after{content:'<?=lang('rpj_75');?>';position:absolute;left:3rem;bottom:2.75rem;transition:.3s;opacity:1;font-family:Open Sans}.nav-fix{position:fixed;top:0;z-index:9999;width:100%;transition:all ease .3s}.demo-2 .bg-img-1{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-1.png')}.demo-2 .bg-img-2{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-2.png')}.demo-2 .bg-img-3{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-3.png')}.demo-2 .bg-img-4{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-4.png')}.demo-2 .bg-img-5{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-5.png')}.demo-2 .bg-img-6{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-6.png')}.demo-2 .bg-img-7{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-7.png')}#fancybox-loading,.fancybox-close,.fancybox-next span,.fancybox-prev span{background-image:url('<?= $this->template->Images() ?>/fancybox_sprite.png')}@media screen and (max-width:768px){.rpj-btn-holder a{display:block;margin:0 auto}.container:lang(ru){padding-right:15px!important;padding-left:15px!important}.slide-img{width:100%}}@media screen and (max-width:643px){h2.rpj-slider-header span:lang(ru){display:block!important;text-align:center!important}}@media screen and (max-width:380px){.rpj-btn-holder a{width:100%}}@media screen and (max-width:1199px) and (min-width:991px){.thumb img{height:220px!important}.thumb img:lang(ru){height:380px!important}}
    .bg-img-8{background-image:url('<?= $this->template->Images() ?>rpj1/rpj-bg-8.png')}
</style>
<?php if(IPLoc::Office()){?>
    <style>
        #botnav_left:lang(de){width:53%}#botnav_right:lang(de){width:45%}.connect:lang(de){width:100%}.custome-min-width:lang(de){width:30%}.custome-min-width-2:lang(de){width:36%;margin-right:1%}#con_us:lang(de){width:100%}@media only screen and (min-width:1024px){.connect li a:lang(de){padding:10px 0 0!important}}.pp:lang(de){width:100%;padding-left:30px}.custome-min-width-3:lang(de){width:32%}.connect li a:lang(de){margin-left:2px}@media only screen and (max-width:1199px){#botnav_left:lang(de){width:45%}#botnav_right:lang(de){width:55%}}@media only screen and (max-width:1023px) and (min-width:992px){#botnav_left:lang(de){width:38%}#botnav_right:lang(de){width:61%}}@media only screen and (max-width:991px) and (min-width:981px){.custome-min-width:lang(de){width:64%}.custome-min-width-2:lang(de){width:52%;margin-right:1%;margin-top:-32px;margin-left:4px}.custome-min-width-3:lang(de){width:45%;margin-top:-32px}}@media only screen and (max-width:980px){.custome-min-width:lang(de){margin-left:-19px}.custome-min-width-2:lang(de){margin-left:117px}}@media only screen and (max-width:980px) and (min-width:768px){.connect li .a1:lang(de),.connect li .a2:lang(de){min-width:167px!important;float:left!important}.bul_lst2:lang(de){padding-top:4px}.custome-min-width-2:lang(de){margin-left:-14px}.custome-min-width-3:lang(de){margin-left:111px}#con_us:lang(de){width:74%}#fee_ba:lang(de){padding-top:0}}@media only screen and (max-width:767px){#botnav_right:lang(de){width:76%}#botnav_left:lang(de){width:22%}.connect:lang(de){width:100%}.custome-min-width-2:lang(de){margin-left:0;margin-top:0}.custome-min-width{min-height:42px;margin-left:0}}@media only screen and (max-width:766px){.custome-min-width-2:lang(de),.custome-min-width-3:lang(de),.custome-min-width:lang(de){width:100%}}
    </style>
<?php }?>
<link rel='stylesheet' href='<?= $css?>rpj/custom_rpj_ru.css'>
<div class="demo-2">
    <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">
            <div class="container rpj-container">
                <div class="row rpj-row">
                    <div class="rpj-btn-holder col-md-12">
                        <a href="<?=FXPP::loc_url('register')?>"><?=lang('rpj_53');?></a>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-1"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-1.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-2"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-2.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="10" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-3"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-3.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-4"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-4.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-5"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-5.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-6"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-6.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-7"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-7.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="bg-img bg-img-8"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="rpj-slider-header">
                                    <span class="rpj-span1"><?=lang('rpj_23');?></span>
                                    <span><?=lang('rpj_52');?></span>
                                    <span class="rpj-span2"><?=lang('rpj_10');?></span></h2>
                            </div>
                            <div class="col-md-7">
                                <img src="<?= $this->template->Images() ?>/rpj1/rpj-slideimg-8.png" class="img-responsive slide-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rpj-content-holder">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="rpj-content-header"><?=lang('rpj_1');?></h2>
                <div class="partner-logo-holder">
                    <img src="<?= $this->template->Images() ?>/rpj/fx-rpg-logo.png" class="img-responsive main-logo">
                </div>
                <p class="rpj-content-text">
                    <?=lang('rpj_2');?><b><?=lang('rpj_3');?></b><?=lang('rpj_4');?><b><?=lang('rpj_5');?></b><?=lang('rpj_6');?>
                </p>
                <p class="rpj-content-text">
                    <?=lang('rpj_7');?>
                </p>
                <p class="rpj-content-text">
                    <b><?=lang('rpj_8');?></b> <i><?=lang('rpj_9');?><span class="span1"><?=lang('rpj_10');?></span><?=lang('rpj_11');?></i>
                </p>
                <p class="rpj-content-text">
                    <?=lang('rpj_12');?><b><?=lang('rpj_0');?></b><?=lang('rpj_13');?><span class="span1"><?=lang('rpj_10');?></span><?=lang('rpj_14');?>
                </p>
                <p class="rpj-content-text">
                    <?=lang('rpj_15');?><b><?=lang('rpj_16');?></b><?=lang('rpj_17');?>
                </p>
            </div>
            <div class="col-md-12">
                <div class="pres-msg-holder">
                    <p class="pres-msg">
                        <?=lang('rpj_18');?>
                        <span><?=lang('rpj_19');?></span><div class="clearfix"></div>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pres-msg-holder">
                    <p class="pres-msg">
                        <?=lang('rpj_20');?>
                        <span><?=lang('rpj_21');?></span><div class="clearfix"></div>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <p class="rpj-content-text">
                    <span class="span1"><?=lang('rpj_10');?></span><?=lang('rpj_22');?><span class="span2"><?=lang('rpj_23');?></span><?=lang('rpj_24');?>
                </p>

                <p class="rpj-content-text">
                    <?=lang('rpj_25');?><span class="span2"><?=lang('rpj_23');?></span><?=lang('rpj_26');?><b><?=lang('rpj_27');?></b><?=lang('rpj_28');?><span class="span1"><?=lang('rpj_10');?></span><?=lang('rpj_29');?>
                </p>

                <p class="rpj-content-text">
                    <span class="span1"><?=lang('rpj_10');?></span><?=lang('rpj_22');?><span class="span2"><?=lang('rpj_23');?></span><?=lang('rpj_30');?>
                </p>
            </div>
            <div class="col-md-6 race-bio-main-holder">
                <h2 class="rpj-content-header text-left"><?=lang('rpj_31');?></h2>
                <ul class="race-bio-list">
                    <li><span><?=lang('rpj_32');?></span><?=lang('rpj_33');?></li>
                    <li><span><?=lang('rpj_34');?></span><?=lang('rpj_35');?><i><?=lang('rpj_36');?></i></li>
                    <li><span><?=lang('rpj_37');?></span><?=lang('rpj_38');?></li>
                    <li><span><?=lang('rpj_39');?></span><?=lang('rpj_40');?></li>
                    <li><span><?=lang('rpj_41');?></span><?=lang('rpj_42');?><i><?=lang('rpj_43');?></i></li>
                    <li><span><?=lang('rpj_44');?></span><?=lang('rpj_45');?><i><?=lang('rpj_46');?></i></li>
                    <li><span><?=lang('rpj_47');?></span><?=lang('rpj_48');?></li>
                    <li><span><?=lang('rpj_49');?></span><?=lang('rpj_50');?></li>
                </ul>
            </div>
            <div class="col-md-6 gallery-main-holder">
                <h2 class="rpj-content-header text-left"><?=lang('rpj_51');?></h2>
                <ul class="gallery-list">
                    <li>
                        <a class="fancybox thumb" href="<?= $this->template->Images() ?>rpj1/rpj1-slideimg-1.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>rpj1/rpj1-slideimg-2.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>rpj1/rpj1-slideimg-4.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>rpj1/rpj1-slideimg-6.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>rpj1/rpj1-slideimg-7.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-9.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-11.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-12.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-13.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-14.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-15.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-16.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-17.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-18.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>

                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-20.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-21.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-22.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-23.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-24.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-25.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>

                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-27.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>

                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-29.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-30.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-31.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-32.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-33.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-34.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-35.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-0.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>
                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/rpj-slideimg-8.png" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/rpj-slideimg-8.png">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>

                    <li>
                        <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/rpj/helmet-fx.jpg" data-fancybox-group="gallery">
                            <img src="<?= $this->template->Images() ?>rpj/helmet-fx.jpg">
                            <span class="thumb_overlay"></span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Scrolling Nav JavaScript -->
<script src="<?= $js?>/rpj/jquery.easing.min.js"></script>
<script src="<?= $js?>/rpj/scrolling-nav.js"></script>
<script src="<?= $js?>/rpj/owl.carousel.js"></script>
<script src='<?= $js?>/rpj/jquery.fancybox.pack.js'></script>
<script src='<?= $js?>/rpj/jquery.ba-cond.min.js'></script>
<script src='<?= $js?>/rpj/jquery.slitslider.js'></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            autoPlay : false, //Set AutoPlay to 3 seconds
            items : 1,
            lazyLoad : true,
            dots : false,
            navigation : false,
            mouseDrag : false,
            touchDrag : false
        });
        $('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        });
        $('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        });
    });
    $(function() {
        var Page = (function() {
            var $nav = $( '#nav-dots > span' ),
                slitslider = $( '#slider' ).slitslider( {
                    autoplay:false,
//                    onBeforeChange : function( slide, pos ) {
//                        $nav.removeClass( 'nav-dot-current' );
//                        $nav.eq( pos ).addClass( 'nav-dot-current' );
//                    }
                } ),
                init = function() {  initEvents(); },
                initEvents = function() {
                    $nav.each( function( i ) {
                        $( this ).on( 'click', function( event ) {
                            var $dot = $( this );
                            if( !slitslider.isActive() ) {
                                $nav.removeClass( 'nav-dot-current' );
                                $dot.addClass( 'nav-dot-current' );
                            }
                            slitslider.jump( i + 1 );
                            return false;
                        } );
                    } );
                };
            return { init : init };
        })();
        Page.init();
    });

</script>

<?php
$data['log']=array(
    'ip'=>$_SERVER['REMOTE_ADDR'],
    'referrer'=>$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
    'date' => date("Y-m-d H:i:s")
);
$this->general_model->insertmy($table="team_page_logs",$data['log']);
?>

