
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-fiftypercentbonus.css' type='text/css'  />"));
    });
</script>

<div>
    <img src="<?= $this->template->Images()?>bgbonus50.jpg" class="img-responsive" alt="" style="margin:auto" />
</div>
<div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 bonus-50">
                <h4><?= lang('fpdbp_header');?></h4>
                 <p><?= lang('fpdbp_p');?></p>
            </div>
        </div>

        <div class="steps-holder row">
            <div class="col-sm-4 col-md-4 col-lg-4 steps">
                <h4 class="step-num"><?= lang('fpdbp_h-1');?></h4>
                <p class="step-title"><?= lang('fpdbp_p-1');?></p>
                <img src="<?= $this->template->Images()?>step1.png" width="150" alt="" />
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 steps">
                <h4 class="step-num"><?= lang('fpdbp_h-2');?></h4>
                <p class="step-title"><?= lang('fpdbp_p-2');?></p>
                 <img src="<?= $this->template->Images()?>step2.png" width="150" alt="" />
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 steps">
                <h4 class="step-num"><?= lang('fpdbp_h-3');?></h4>
                <p class="step-title"><?= lang('fpdbp_p-3');?></p>
                <img src="<?= $this->template->Images()?>step3.png" width="150" alt="" />
            </div>
        </div>                
</div>
<div class="container">
    <div class="button-holder">
        <form class="form-inline">
            <div class="form-group">
                <input type="button" class="btn-real1" value="<?= lang('fpdbp_a-1');?>" onclick="fpba()">
            </div>
            <div class="form-group">
                <input type="button" class="btn-demo1" value="<?= lang('fpdbp_a-2');?>" onclick="signin()">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function signin() {
        window.location="<?=FXPP::loc_url('fifty-percent-bonus-agreement')?>";
    }
    function fpba() {
        window.open('<?=FXPP::loc_url('fifty-percent-bonus-agreement')?>','_blank');
    }
</script>

