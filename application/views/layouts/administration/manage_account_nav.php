<style type="text/css">
    .side-nav-holder .side-nav li a i {
        width: 20px !important;
    }

    .side-nav-holder .side-nav li a{
        padding-right: 0px !important;
    }
</style>
<div class="col-lg-2 col-md-2 col-sm-2">
    <div class="dl-holder">
        <div class="side-nav-holder">
            <ul class="side-nav">
                <li><a id="adm_demo_accounts"  href="<?=FXPP::loc_url('administration/manage-accounts/demo')?>" class="<?php echo $type ? '' : 'active-sidenav' ?>"><i class="fa fa-user"></i><cite>Demo Accounts</cite></a></li>
                <li><a id="adm_live_accounts" href="<?=FXPP::loc_url('administration/manage-accounts/live')?>" class="<?php echo $type == 1 ? 'active-sidenav' : '' ?>"><i class="fa fa-user"></i><cite>Live Accounts</cite></a>
                <li><a id="adm_live_accounts" href="<?=FXPP::loc_url('administration/manage-accounts/affiliates')?>" class="<?php echo $type == 2 ? 'active-sidenav' : '' ?>"><i class="fa fa-user"></i><cite>Affiliate Accounts</cite></a>
            </ul><div class="clearfix"></div>
        </div>
    </div>
</div>