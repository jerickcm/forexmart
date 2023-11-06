<link href="<?= $this->template->Css()?>view-partnership-advantages.css" rel="stylesheet">
<div class="reg-form-holder">
    <div class="container">
        <div class="row margin-15left-right">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title sa-right">
                    <?= lang('x_ap_a_h1-1');?>
                </h1>
                <div class="mt4-desk-holder">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mt4-img-holder ">
                        <img src="<?= $this->template->Images()?>adv-img.png" style="display: inline-block;" class="img-responsive sa-mar-0" alt="Checklist" />
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ext-arabic-advantage-content">
                        <p class="license-text">
                            <?= lang('x_ap_a_p1-1');?>
                            <span class="company">
                            <?= lang('x_ap_a_p1-2');?>
                            </span>
                            <?= lang('x_ap_a_p1-3');?>
                        </p>
                        <div class="adj-pad col-sm-9 ext-arabic-advantage-content ext-arabic-advantage-no-pad">
                            <h2 class="license-sub ext-arabic-license-sub sa-right">
                                <?= lang('x_ap_a_h2-1');?>
                            </h2>
                            <ul class="demo-feats ext-arabic-demo-feats">
                                <li>
                                    <i class="fa fa-check sa-flt-r "></i>
                                    <span class="sa-flt-r"><?= lang('x_ap_a_li1');?></span>
                                </li>
                                <li class="clearfix"></li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="sa-flt-r"><?= lang('x_ap_a_li2');?></span>
                                </li>
                                <li class="clearfix"></li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="sa-flt-r"><?= lang('x_ap_a_li3');?></span>
                                </li>
                                <li class="clearfix"></li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="sa-flt-r"><?= lang('x_ap_a_li4');?></span>
                                </li>
                                <li class="clearfix"></li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="sa-flt-r"><?= lang('x_ap_a_li5');?></span>
                                </li>
                                <li class="clearfix"></li>
                                <li><i class="fa fa-check sa-flt-r"></i>
                                    <span class="sa-flt-r"><?= lang('x_ap_a_li6');?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3 ext-arabic-advantage-content ext-arabic-advantage-content ext-arabic-advantage-no-pad float_center magin_top part-refe-nopad" id="btnv">
                            <a href="<?=FXPP::loc_url('partnership/friend-referrer');?>" class="cntr btnv btn-explore">
                                <?= lang('x_ap_a_a-1');?>
                            </a>
                        </div>
                    </div>
                </div><div class="clearfix"></div>
                <?= $DemoAndLiveLinks?>
            </div>
        </div>
    </div>
</div>