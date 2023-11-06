
<link href="<?= $this->template->Css()?>addin-demo-live-links.css" rel="stylesheet">
<div class="btn-livedemo sa-mar-top-10 ">
    <form class="form-inline ext-arabic-form-inline">
        <div class="form-group ext-arabic-form-group-right sa-mar-bot-10 btns1">
            <a href="<?php echo FXPP::loc_url('register')?>" class="col-sm-6 btn-real_custom btn-real paddingForBg sa-btn-pad-7-11">
                <?= lang('Ai_da0');?>
            </a>
        </div>
        <div class="form-group ext-arabic-form-group-right sa-mar-bot-10 btns1 addSpaceTop">
            <a href="<?php echo FXPP::loc_url('register/demo')?>" class="col-sm-6 btn-demo_custom btn-demo sa-btn-pad-7-11">
                <?= lang('Ai_da1');?>
            </a>
        </div>

        <div class="form-group ext-arabic-form-group-right sa-mar-bot-10">
            <label class="risk-warning">
                <?= lang('Ai_dl0');?>
            </label>
        </div>
    </form>
</div>
