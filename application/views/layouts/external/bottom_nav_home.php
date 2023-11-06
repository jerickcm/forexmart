<link href="<?= $this->template->Css();?>footer/mobileappfooter.css" rel="stylesheet">

<div class="mobileapp-footer">
    <div class="container">
        <div class="mobileapp-holder">
            <div class="col-sm-5 mobileapp-line">
                <div class="mobileapp-left-side">
                    <img src="<?= $this->template->Images()?>footer/bankpayment.png" class="img-responsive">
                </div>
            </div>
            <div class="col-sm-3 mobileapp-line">
                <?php if(FXPP::html_url() == 'zh') { ?>
                    <h4 class="mobileapp-icon01"><?= lang('quickLinks')?></h4>
                <?php } else { ?>
                    <h4 class="mobileapp-icon01">Quick Links</h4>
                <?php } ?>
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
                    <li class="mg-t">
                        <a href="<?=FXPP::loc_url('privacy-policy')?>">
                            <?= trim(lang('bn_li_pp'));?>
                        </a>
                    </li>
                    <li class="mg-t">
                        <a href="<?=FXPP::loc_url('terms-and-conditions')?>">
                            <?= trim(lang('bn_li_tnc'));?>
                        </a>
                    </li>           
                </ul>
                <h5 class="mobileapp-icon02">+44 207 1933 236</h5>
                <ul class="mobileapp-inline">
                    <li>
                        <a href="<?=FXPP::loc_url('contact-us')?>">
                            <p class="mobileapp-icon03"><?= lang('bn_li_cu');?></p>
                        </a>
                    </li>
                    <li>
                        <a href="#popfeedback" data-toggle="modal" data-target="#popfeedback">
                            <p class="mobileapp-icon04 customfeedback4190 img-4190"><?= lang('bn_li_f');?></p>
                        </a>
                    </li>          
                </ul>
            </div>

            <div class="col-sm-4">
                <?php if(FXPP::html_url() == 'zh') { ?>
                    <h4 class="mobileapp-icon05"><?=lang('dMobileApp');?></h4>
                <?php } else { ?>
                    <h4 class="mobileapp-icon05">Download Our Mobile App</h4>
                <?php } ?>
                <div class="col-xs-12 mobileapp-platform">
                    <div class="col-xs-4 mobileapp-platform">
                        <div class="mobileapp-platform">
                            <a href="https://itunes.apple.com/app/metatrader-4/id496212596?l=en&mt=8">
                                <img src="<?= $this->template->Images()?>footer/ios.png" class="img-responsive">
                            </a>
                        </div>
                        <div class="mobileapp-platform">
                            <a href="https://play.google.com/store/apps/details?id=net.metaquotes.metatrader4">
                                <img src="<?= $this->template->Images()?>footer/android.png" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-8 mobileapp-platform">
                        <div class="mobileapp-platform">
                            <img src="<?= $this->template->Images()?>footer/smartphones.png" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
