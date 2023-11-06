<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php $permission=explode(",",$access['permission']);
            foreach($permission as $key){
            if($key=="qjum") {?>
            <li class="treeview <?=$active=='quick-jump'?'active':''?>">
                <a href="javascript:;"><i class="fa fa-paper-plane"></i> <span>Quick Jump</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu <?=$active=='quick-jump'?'menu-open':''?>">
                    <?php foreach($permission as $key){?>
                    <?php if($key=="openacc") {?><li class="<?=$li_active=='li_openacct'?'active':''?>"><a href="<?=site_url('accounts/open_account')?>"><i class="fa fa-dot-circle-o"></i> Register</a></li><?php } ?>
                    <?php if($key=="qjper") {?><li class="<?=$li_active=='li_personal'?'active':''?>"><a href="<?=site_url('quick-jump')?>"><i class="fa fa-dot-circle-o"></i> Personal</a></li><?php } ?>
                    <?php if($key=="qjgot") {?><li><a href="<?=site_url('quick_jump/go_to_cabinet')?>"><i class="fa fa-dot-circle-o"></i> Cabinet</a></li><?php } ?>
                    <?php }?>
                </ul>
            </li>
            <?php } }?>
            <?php foreach($permission as $key){ if($key=="bal") {?>
            <li class="treeview <?=$active=='balance'?'active':''?>">
                <a href="#">
                    <i class="fa fa-balance-scale"></i>
                    <span>Balance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu <?=$active=='balance'?'menu-open':''?>">
                    <?php foreach($permission as $key){ if($key=="balchart ") { ?><li><a href="javascript:;"><i class="fa fa-dot-circle-o"></i> Chart</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="balrecords") { ?><li style="display: none;"><a href="<?=site_url('balance/records')?>"><i class="fa fa-dot-circle-o"></i> Records</a></li><?php } }?>
                    <?php foreach($permission as $key){ if($key=="baltran") { ?><li class="<?=$li_active=='li_baltran'?'active':''?>"><a href="<?=site_url('balance/balance_transaction')?>"><i class="fa fa-dot-circle-o"></i> Transactions</a></li><?php } }?>
                    <?php foreach($permission as $key){ if($key=="balops") { ?><li class="<?=$li_active=='li_balops'?'active':''?>"><a href="<?=site_url('balance/balance-operations')?>"><i class="fa fa-dot-circle-o"></i> Operations</a></li><?php } }?>
                </ul>
            </li>
            <?php } } ?>
            <?php foreach($permission as $key){ if($key=="trades") {?>
            <li class="treeview <?=$active=='trades'?'active':''?>">
                <a href="<?=site_url('trades')?>">
                    <i class="fa fa-briefcase"></i>
                    <span>Trades</span>
                </a>
            </li>
            <?php } }?>
            <?php foreach($permission as $key){ if($key=="fin") {?>
            <li class="treeview <?=$active=='finance'?'active':''?>">
                <a href="#"> 
                    <i class="fa fa-area-chart"></i>
                    <span>Finance</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu <?=$active=='finance'?'menu-open':''?>">
                    <?php foreach($permission as $key){ if($key=="findeposit") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Deposit</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="finwithdrawal") {?><li class="<?=$li_active=='withdrawal'?'active':''?>"><a href="<?=site_url('withdrawal-queue')?>"><i class="fa fa-dot-circle-o"></i> Withdrawal</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="finequity") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Equity</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="fincredit") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Credit</a></li><?php } } ?>
                </ul>
            </li>
            <?php } }?>
            <?php foreach($permission as $key){ if($key=="ver") {?>
            <li id="verify">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Verify</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu <?=$active=='incomplete_accounts'?'menu-open':''?>">
                    <?php foreach($permission as $key){ if($key=="vercheck") {?><li><a href="javascript:;"><i class="fa fa-dot-circle-o"></i> Check Query</a></li><?php } }?>
                    <?php foreach($permission as $key){ if($key=="verincomplete") {?><li><a href="<?=site_url('verify/incomplete_accounts')?>"><i class="fa fa-dot-circle-o"></i> Incomplete Registration</a></li> <?php } }?>
                </ul>
            </li>
            <?php } }?>
            <?php foreach($permission as $key){ if($key=="fin") {?>
            <li class="treeview <?=$active=='info'?'active':''?>">
                <a href="#">
                    <i class="fa fa-info-circle"></i>
                    <span>Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <?php foreach($permission as $key){ if($key=="infoaccounts") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Total Accounts</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="infosaldo") {?><li><a href="<?=site_url('total-information/saldo')?>"><i class="fa fa-dot-circle-o"></i> Total Saldo</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="infodeposit") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Total Deposit</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="infotrades") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Total Trade Results</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="infocalcu") {?><li><a href="<?=site_url('agent-commission-calculator')?>"><i class="fa fa-dot-circle-o"></i> Calculator</a></li><?php } } ?>
                </ul>
            </li>
            <?php } }?>
            <?php foreach($permission as $key){ if($key=="part") {?>
            <li class="treeview <?=$active=='partners'?'active':''?>">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Partners</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu <?=$active=='partners'?'menu-open':''?>">
                    <li><a href="<?=site_url('referrals')?>"><i class="fa fa-dot-circle-o"></i> Referrals</a></li>
                </ul>
            </li>
            <?php } } ?>
            <?php foreach($permission as $key){ if($key=="ord") {?>
            <li class="treeview">
                <a href="pages/calendar.html">
                    <i class="fa fa-ticket"></i>
                    <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <?php foreach($permission as $key){ if($key=="ordticket") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Ticket</a></li><?php } } ?>
                    <?php foreach($permission as $key){ if($key=="ordmodify") {?><li><a href="#"><i class="fa fa-dot-circle-o"></i> Modify</a></li><?php } } ?>
                </ul>
            </li>
            <?php } } ?>
            <?php foreach($permission as $key){ if($key=="anti") {?>
            <li class="treeview <?=$active=='antifraud'?'active':''?>">
                <a href="<?=site_url('antifraud')?>">
                    <i class="fa fa-shield"></i>
                    <span>Anti Fraud</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu <?=$active=='antifraud'?'menu-open':''?>">
                <?php foreach($permission as $key){ ?>
                    <?php if($key=="antilanding") { ?><li class="<?=$li_active=='li_fraud'?'active':''?>"><a href="<?=site_url('antifraud')?>"><i class="fa fa-dot-circle-o"></i> Account Information</a></li><?php }?>
                    <?php if($key=="anticommission") { ?><li class="<?=$li_active=='co_fraud'?'active':''?>"><a href="#"><i class="fa fa-dot-circle-o"></i> Commission</a></li><?php }?>
                    <?php if($key=="antiswap") { ?><li class="<?=$li_active=='sw_fraud'?'active':''?>"><a href="#"><i class="fa fa-dot-circle-o"></i> Swaps</a></li><?php }?>
                <?php  } ?>
                </ul>
            </li>
            <?php } } ?>
            <?php foreach($permission as $key){ if($key=='mana'){?>
            <li>
                <a href="<?=site_url('manage-access')?>"><i class="fa fa-lock"></i><span>Manage Access</span></a>
            </li>
            <?php } }?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
