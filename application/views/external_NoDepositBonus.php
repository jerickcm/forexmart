
<link href="<?= $this->template->Css()?>custome-external-no-deposit.css" rel="stylesheet">
   <div>
        <img src="<?= $this->template->Images()?>bgnodeposit.jpg" class="img-responsive" alt="No deposit" style="margin:auto">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 nobonus">
                <h4><?=lang('ndb_h1_0');?></h4>
                 <p><?=lang('ndb_p_0');?></p>
            </div>
        </div> 
        <div class="steps-holder row">
            <div class="col-sm-4 col-md-4 col-lg-4 steps">
                <h4 class="step-num"><?=lang('ndb_h4_0');?></h4>
                <p class="step-title"><?=lang('ndb_ddp_0');?></p>
                <img src="<?= $this->template->Images()?>/step1.png" width="150" alt="">
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 steps">
                <h4 class="step-num"><?=lang('ndb_h4_1');?></h4>
                <p class="step-title"><?=lang('ndb_ddp_1');?></p>
                <img src="<?= $this->template->Images()?>/step2.png" width="150" alt="">
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 steps">
                <h4 class="step-num"><?=lang('ndb_h4_2');?></h4>
                <p class="step-title"><?=lang('ndb_ddp_2');?></p>
                 <img src="<?= $this->template->Images()?>/step3.png" alt="" width="150">
            </div>
        </div> 


    </div>

        <div class="container">
            <div class="button-holder">
                <form class="form-inline">
                    <div class="form-group ">
                        <a href="<?=FXPP::loc_url('no-deposit-bonus-agreement')?>" class="btn-real1" target="_blank">
                            <?=lang('ndb_fda_0');?>
                        </a>
                    </div>
                    <div class="form-group ">
                        <a href="<?= $this->config->item('domain-my');?>/client/signin" class="btn-demo1">
                            <?=lang('ndb_fda_1');?>
                        </a>
                    </div>
                </form>
            </div>
        </div>
<?=$check?>