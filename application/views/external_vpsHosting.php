<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-vpshosting.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title">
                   <?=lang('vps_h1_0');?>
                </h1>
                        <div class="row vps-holder">
                            <div class="col-sm-5 ext-arabic-vps-content">
                               <img src="<?= $this->template->Images()?>/vps.png" class="img-responsive" alt="" />
                            </div>
                            <div class="col-sm-7 ext-arabic-vps-content">
                                <h2 class="vps-title-sub ext-arabic-vps-title-sub">
                                    <?=lang('vps_h2_0');?>
                                </h2>
                                <ul class="vps-list ext-arabic-vps-list">
                                    <li>
                                        <i class="fa fa-check vps-check"></i>
                                        <p class="bul_lst">
                                            <?=lang('vps_li0_0');?>
                                        </p>
                                        <span class="clearfix"></span>
                                    </li>
                                    <li><i class="fa fa-check vps-check"></i>
                                        <p class="bul_lst">
                                            <?=lang('vps_li0_1');?>
                                        </p>
                                        <span class="clearfix"></span>
                                    </li>
                                    <li><i class="fa fa-check vps-check"></i>
                                        <p class="bul_lst">
                                            <?=lang('vps_li0_2');?>
                                        </p>
                                        <span class="clearfix"></span>
                                    </li>
                                    <li><i class="fa fa-check vps-check"></i>
                                        <p class="bul_lst">
                                            <?=lang('vps_li0_3');?>
                                        </p>
                                        <span class="clearfix"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-7 ext-arabic-license-text" style="margin-top:25px"><?=lang('vps_d0_0');?><b><?=lang('vps_d0_1');?> </b><?=lang('vps_d0_2');?><a href="#"><?=lang('vps_d0_3');?>
                                </a>

                                <br>
                            </div>
                           <div class="col-sm-7 ext-arabic-license-text" style="margin-top:10px; text-align: justify;">
                               <?=lang('vps_d0_4');?>
                            </div>
                        </div>
                        <div class="row icon-feats ext-arabic-icon-feats">
                            <div class="col-sm-4 ext-arabic-vps-feats <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                <img src="<?= $this->template->Images()?>free.png" class="img-responsive feats-icon ext-arabic-feats-icon" alt="" />
                                 <span class="icon-feats-text ext-arabic-feats-text">
                                    <?=lang('vps_ico_0');?>
                                </span>
                            </div>
                            <div class="col-sm-4 ext-arabic-vps-feats <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                <img src="<?= $this->template->Images()?>247.png" class="img-responsive feats-icon ext-arabic-feats-icon" alt="" />
                                 <span class="icon-feats-text ext-arabic-feats-text">
                                    <?=lang('vps_ico_1');?>
                                </span>
                            </div>
                            <div class="col-sm-4 ext-arabic-vps-feats <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                <img src="<?= $this->template->Images()?>high-speed.png" class="img-responsive feats-icon ext-arabic-feats-icon" alt="" />
                                 <span class="icon-feats-text ext-arabic-feats-text">
                                    <?=lang('vps_ico_2');?>
                                </span>
                            </div>
                        </div><div class="clearfix"></div>
                        <div class="row icon-feats ext-arabic-icon-feats">
                            <div class="col-sm-4 ext-arabic-vps-feats <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                <img src="<?= $this->template->Images()?>server.png" class="img-responsive feats-icon ext-arabic-feats-icon" alt="" />
                                 <span class="icon-feats-text ext-arabic-feats-text">
                                    <?=lang('vps_ico_3');?>
                                </span>
                            </div>
                            <div class="col-sm-4 ext-arabic-vps-feats <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                <img src="<?= $this->template->Images()?>reboot.png" class="img-responsive feats-icon ext-arabic-feats-icon" alt="" />
                                 <span class="icon-feats-text ext-arabic-feats-text">
                                    <?=lang('vps_ico_4');?>
                                </span>
                            </div>
                            <div class="col-sm-4 ext-arabic-vps-feats <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                <img src="<?= $this->template->Images()?>high-speed.png" class="img-responsive feats-icon ext-arabic-feats-icon" alt="" />
                                 <span class="icon-feats-text ext-arabic-feats-text sa-vps-list">
                                    <?=lang('vps_ico_5');?>
                                </span>
                            </div>
                        </div><div class="clearfix"></div>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>
