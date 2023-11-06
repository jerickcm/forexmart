<?php  $this->lang->load('AdminInternalNav'); ?>
<div class="internal-nav-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 int-col-12">
                <div class="internal-nav">
                    <ul>
                        <li><a id="accounts"  href="<?=site_url('accounts')?>">Account</a></li>
                        <li><a id="finance"  href="<?=site_url('finance')?>">Finance</a></li>
                        <li><a id="orders"  href="<?=site_url('orders')?>">Orders</a></li>
                        <li><a id="partners"  href="<?=site_url('partners')?>">Partners</a></li>
                        <li><a id="verify"  href="<?=site_url('verify')?>">verify</a></li>
                        <li><a id="marketing"  href="<?=site_url('marketing')?>">Marketing</a></li>
                        <li><a id="total"  href="<?=site_url('total')?>">Total Information</a></li>
                        
                        <?php /*
                        
                        
                        $permission=$access['permission'];
                                $permission=explode(",",$access['permission']);
                                foreach($permission as $key)
                                    {
                                    if($key=="mailer") {*/?><!--<li><a id="mailer"  href="<?/*=site_url('administration/mailer')*/?>"><?/*= lang('admn-mnu1');*/?></a></li><?php /*}
                                    if($key=="acveri") {*/?><li><a id="accountverification" href="<?/*=site_url('administration/accountverification')*/?>"><?/*= lang('admn-mnu3');*/?></a></li><?php /*}
                                   if($key=="manacces") {*/?><li><a id="manageaccess" href="<?/*=site_url('administration/manage-access')*/?>"><?/*= lang('admn-mnu4');*/?></a></li><?php /*}
                                   if($key=="withdqueue") {*/?><li><a id="withdrawalqueue" href="<?/*=site_url('administration/withdrawal-queue')*/?>"><?/*= lang('admn-mnu5');*/?></a></li><?php /*}
                                   if($key=="manaccounts") {*/?><li><a id="manageaccounts" href="<?/*=site_url('administration/manage-accounts')*/?>"><?/*= lang('admn-mnu6');*/?></a></li><?php /*}
                                   if($key=="mannews") {*/?><li><a id="managenews" href="<?/*=site_url('administration/manage-news')*/?>"><?/*= lang('admn-mnu7');*/?></a></li>--><?php /*}
                                    
                                     
                                }
                           */?>
                        
                        <!-- <li><a id="managebonus" href="<?php //echo site_url('administration/managebonus')?>"><?php // lang('admn-mnu2');?></a></li> -->





                        <div class="clearfix"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

 