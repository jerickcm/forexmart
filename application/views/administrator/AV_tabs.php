<style>
    .avtop{
      margin-top:50px ;
    }
</style>

<div class="row avtop">
    <div class="col-md-9">
        <p class="acct-ver-title"><?= lang('acct-v');?></p>
    </div>

    <div class="col-md-3">

    </div>
</div>
<div class="settings-tab">
    <ul role="tablist" class="queue-tab-list">
        <ul role="tablist" class="queue-tab-list">
            <li role="presentation">
                <a   href="<?=FXPP::loc_url('administration/accountverification-request')?>"  aria-controls="tab1" role="tab"  id="t1">
                    <?= lang('acct-p');?>
                </a>
            </li>
            <li role="presentation">
                <a  href="<?=FXPP::loc_url('administration/accountverification-unverified-documents')?>" aria-controls="tab2" role="tab"  id="t2">
                    <?= lang('acct-uv');?>
                </a>
            </li>
            <li role="presentation">
                <a href="<?=FXPP::loc_url('administration/accountverification-verified-documents')?>" aria-controls="tab3" role="tab"  id="t3">
                    <?= lang('acct-vv');?>
                </a>
            </li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
    </ul>
</div>
