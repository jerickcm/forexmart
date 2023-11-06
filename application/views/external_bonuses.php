<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title">
                    <?= lang('xbnss_h');?>
                </h1>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 bonuses-img-holder  ext-arabic-bonuses-container">
                        <img src="<?= $this->template->Images()?>gift-circled.png" alt="" class="img-responsive"/>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ext-arabic-bonuses-container">
                        <h1 class="license-title ext-arabic-license-title">
                            <?= lang('xbnss_t1');?>
                        </h1>
                        <p class="license-text ext-arabic-license-title">
                            <?= lang('xbnss_desc1');?>
                        </p>
                        <a href="<?=FXPP::loc_url('thirty-percent-bonus')?>" class="bonuses-read-more ext-arabic-bonuses-read-more">
                            <?= lang('xbnss_link1');?>
                        </a>
                    </div>
                    <span class="clearfix"></span>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 bonuses-img-holder ext-arabic-bonuses-holder-image ext-arabic-bonuses-container">
                        <img src="<?= $this->template->Images()?>ribbon-circled.png" alt=""  class="img-responsive"/>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ext-arabic-bonuses-holder-text ext-arabic-bonuses-container">
                        <h1 class="license-title ext-arabic-license-title">
                            <?= lang('xbnss_t2');?>
                        </h1>
                        <p class="license-text ext-arabic-license-text">
                            <?= lang('xbnss_desc2');?>
                        </p>
                        <a href="<?=FXPP::loc_url('no-deposit-bonus')?>" class="bonuses-read-more bonuses-read-more ext-arabic-bonuses-read-more">
                            <?= lang('xbnss_link1');?>
                        </a>
                    </div>
                </div>
                <?= $DemoAndLivesLinks; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style type="text/css">.bonuses-img-holder img{width: 140px;}</style>');
    });
</script>
