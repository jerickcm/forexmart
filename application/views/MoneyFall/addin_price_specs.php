<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-addin-pricespecs.css' type='text/css'  />"));
    });
</script>
<div class="row">
    <div class="col-lg-12">


        <div class="row">
            <h1 class="license-title col-sm-6 ext-arabic-license-title ext-arabic-contest-title">
                <?= lang('cmf_h1_0');?>
            </h1>
            <div class="contest-btn-holder col-sm-6 ext-arabic-contest-btn-holder">
                <a href="<?=FXPP::loc_url('contest/ratings')?>" class="btn-contest">
                    <?= lang('cmf_ranking');?>
                </a>
                <a href="<?=FXPP::loc_url('contest/winners')?>" class="btn-contest">
                    <?= lang('cmf_winners');?>
                </a>
                <a href="<?=FXPP::loc_url('contest/contestrules')?>" class="ccr btn-contest">
                    <?= lang('cmf_contestrules');?>
                </a>
            </div>
        </div>


        <div class="contest-img-holder">
            <div class="contest-img">
                <img src="<?= $this->template->Images()?><?= (FXPP::html_url()=='sa')? "money-contest-sa.png":"money-contest.png";?>" class="img-responsive" alt="" />
            </div>
            <div class="prizes-holder row">
                <div class="col-sm-12 wide-screen">
                    <div class="col-sm-3 div1 clmn1">
                        <ul class="prizes">
                            <li><?=lang('cmf_1');?> - <span>650 <?=$default_currency ?></span> </li>
                            <li><?=lang('cmf_2');?>- <span>500 <?=$default_currency ?></span></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 div2 clmn2">
                        <ul class="prizes"><li><?=lang('cmf_3');?> - <span>300 <?=$default_currency ?></span></li>
                            <li><?= lang('cmf_4');?>- <span>200 <?=$default_currency ?></span></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 div3 clmn3">
                        <ul class="prizes">
                            <li><?= lang('cmf_5');?>- <span>100 <?=$default_currency ?></span></li>
                            <li><?= lang('cmf_6');?>- <span>50 <?=$default_currency ?></span> </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 mob-screen">
                    <div class="col-sm-3 div1 clmn1">
                        <ul class="prizes">
                            <li><?=lang('cmf_1');?> - <span>650 <?=$default_currency ?></span> </li>
                            <li><?=lang('cmf_2');?>- <span>500 <?=$default_currency ?></span></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 div3 clmn2">
                        <ul class="prizes">
                            <li><?= lang('cmf_5');?>- <span>100 <?=$default_currency ?></span></li>
                            <li><?= lang('cmf_6');?>- <span>50 <?=$default_currency ?></span> </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 div2 clmn3">
                        <ul class="prizes">
                            <li><?=lang('cmf_3');?> - <span>300 <?=$default_currency ?></span></li>
                            <li class="my6th"><?= lang('cmf_4');?>- <span>200 <?=$default_currency ?></span></li>
                        </ul>
                    </div>

                </div>

                <div class="col-sm-12 main-specs-content">
                    <h1 class="spec-title">
                        <?= lang('cmf_h1_1');?>
                    </h1>
                    <ul class="specs">
                        <li>
                            <i>
                                <?= lang('cmf_li_00');?>:
                            </i>
                                    <span>
                                        <?= lang('cmf_li_01');?>
                                    </span>
                        </li>
                        <li><i>
                                <?= lang('cmf_li_10');?>:
                            </i> <span>
                                        <?=str_replace('USD', $default_currency, lang('cmf_li_11'));?>
                                    </span></li>
                        <li><i>
                                <?= lang('cmf_li_20');?>:
                            </i> <span>
                                        <?= lang('cmf_li_21');?>
                                    </span></li>
                        <li><i>
                                <?= lang('cmf_li_30');?>:
                            </i> <span>
                                        <?= lang('cmf_li_31');?>
                                    </span></li>
                        <li><i>
                                <?= lang('cmf_li_40');?>:
                            </i> <span>
                                        <?=str_replace('USD', $default_currency, lang('cmf_li_41'));?>
                                    </span></li>
                    </ul>
                     <button class="btn-contest-reg ab" onclick="gotolink()">
                            <?= lang('cmf_a_0');?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function gotolink(){
        window.location.href='<?=FXPP::loc_url('money-fall-registration')?>';
    }
</script>