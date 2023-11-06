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
    .active-int-nav{
        text-decoration: none;
        background: #2988CA;
        color: #fff;
        transition: all ease 0.3s;
    }
    .tb{height: 50px!important;}
    #table{float: left}
</style>



<div class="settings-tab">
    <ul role="tablist" class="queue-tab-list">
        <ul role="tablist" class="queue-tab-list">
            <li role="presentation" class="<?=$av_tabs=='pending'?'active-set-tab':''?>">
                <a   href="<?=site_url('verify/pending')?>"  aria-controls="tab1" role="tab"  id="t1">
                    <?= lang('acct-p');?>
                </a>
            </li>
            <li role="presentation" class="<?=$av_tabs=='doseviem'?'active-set-tab':''?>">
                <a   href="<?=site_url('verify/upload')?>"  aria-controls="tab1" role="tab"  id="t4">
                    Document sent by Email
                </a>
            </li>
            <li role="presentation" class="<?=$av_tabs=='declined'?'active-set-tab':''?>">
                <a  href="<?=site_url('verify/declined')?>" aria-controls="tab2" role="tab"  id="t2">
                    Declined
                </a>
            </li>
            <li role="presentation" class="<?=$av_tabs=='verified'?'active-set-tab':''?>">
                <a href="<?=site_url('verify/verified')?>" aria-controls="tab3" role="tab"  id="t3">
                    <?= lang('acct-vv');?>
                </a>
            </li>

        </ul>

    </ul>
</div>
