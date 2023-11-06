<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>sponsorship.css">
<div class="sponsorship-wrapper">
    <div class="container sponsorship-container">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="sponsorship-title">
                <h1><?=lang('s_h1_0');?></h1>
                <p><?=lang('s_p_0').' '.lang('s_p_1');?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="sponsorship-content">
                    <img src="<?= $this->template->Images()?>sponsorship-image-hkm.png" class="img-responsive sponsorship-hkm"/>
                    <p><?=lang('s_p_hkm');?></p>
                    <a href="<?=FXPP::www_url('HKM_Zvolen')?>"><?=lang('s_btnreadmore');?></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="sponsorship-content">
                    <img src="<?= $this->template->Images()?>sponsorship-image-rpj.png" class="img-responsive"/>
                    <p><?=lang('s_p_rpj');?></p>
                    <a href="<?=FXPP::loc_url('rpj-racing')?>"><?=lang('s_btnreadmore');?></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="sponsorship-content">
                    <img src="<?= $this->template->Images()?>sponsorship-image-laspalmas.png" class="img-responsive"/>
                    <p><?=lang('s_p_lp');?></p>
                    <a href="<?=FXPP::loc_url('las-palmas')?>"><?=lang('s_btnreadmore');?></a>
                </div>
            </div>
        </div>
    </div>
</div>
