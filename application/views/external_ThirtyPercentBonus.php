<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-tpb.css' type='text/css'  />"));
    });
</script>
<div>
    <img src="<?= $this->template->Images()?>bgbonus30.jpg" class="img-responsive" style="margin:auto" alt="" />
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 bonus-30">
            <h4><?= lang('tpdbp_header');?></h4>
             <?= lang('tpdbp_p');?>
        </div>
    </div>
    <div class="steps-holder row">
        <div class="col-sm-4 col-md-4 col-lg-4 steps">
            <h4 class="step-num"><?= lang('tpdbp_h-1');?></h4>
            <p class="step-title"><?= lang('tpdbp_p-1');?></p>
            <img src="<?= $this->template->Images()?>step1.png" width="150" alt="" />
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 steps">
            <h4 class="step-num"><?= lang('tpdbp_h-2');?></h4>
            <p class="step-title"><?= lang('tpdbp_p-2');?></p>
             <img src="<?= $this->template->Images()?>step2.png" width="150" alt="" />
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 steps">
            <h4 class="step-num"><?= lang('tpdbp_h-3');?></h4>
            <p class="step-title"><?= lang('tpdbp_p-3');?></p>
            <img src="<?= $this->template->Images()?>step3.png" width="150" alt="" />
        </div>
    </div>
</div>
<div class="container">
    <div class="button-holder">
        <form class="form-inline">
            <div class="form-group">
                <input type="button"  class="btn-real1 bonus-btn-ru" value="<?= lang('tpdbp_a-1');?>" onclick="goto_tpba()">
            </div>
            <div class="form-group">
                <input type="button" class="btn-demo1" value="<?= lang('tpdbp_a-2');?>" onclick="goto_c_signin()">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function goto_tpba(){
        window.open('<?=FXPP::loc_url('thirty-percent-bonus-agreement')?>', '_blank');
    }
    function goto_c_signin (){
        /*window.location.replace(...) is better than using window.location.href, because replace() does not keep the originating page in the session history, meaning the user won't get stuck in a never-ending back-button fiasco.*/
        window.location.replace('<?= $this->config->item('domain-my');?>/client/signin');
    }
</script>