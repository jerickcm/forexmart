<style>
    .avtop{
        margin-top:10px ;
    }

    .valign{
        padding-top: 10px;
    }
    .acct-ver-title{
        margin-bottom: 0px!important;
        margin-top: 5px;
    }
    .rght{
        text-align: right;
    }
    .btn-force{
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        border: medium none;
        transition: all 0.3s ease 0s;
        margin: 2px;
        padding: 8px 26px;
    }

</style>

<div class="row avtop">
    <div class="col-md-9">
        <p class="acct-ver-title"><?= lang('acct-v');?></p>
    </div>

    <div class="col-md-3 valign">

    </div>
</div>

<div class="settings-tab">
    <ul role="tablist" class="queue-tab-list">
        <ul role="tablist" class="queue-tab-list">
            <li role="presentation">
                <a   href="<?=site_url('account-verification/av-pending')?>"  aria-controls="tab1" role="tab"  id="t1">
                    <?= lang('acct-p');?>
                </a>
            </li>
            <li role="presentation">
                <a  href="<?=site_url('account-verification/av-declined')?>" aria-controls="tab2" role="tab"  id="t2">
                    Declined
                </a>
            </li>
            <li role="presentation">
                <a href="<?=site_url('account-verification/av-verified')?>" aria-controls="tab3" role="tab"  id="t3">
                    <?= lang('acct-vv');?>
                </a>
            </li>
            <li role="presentation">
                <a href="<?=site_url('account-verification/upload')?>" aria-controls="tab4" role="tab"  id="t4">
                    Document sent via email
                </a>
            </li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
    </ul>
</div>
