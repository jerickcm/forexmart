<?php  $this->lang->load('AdminInternalNav'); ?>
<div class="internal-nav-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 int-col-12">
                <div class="internal-nav">
                    <ul>

                        <?php
                        $permission=$access['permission'];
                                $permission=explode(",",$access['permission']);
                                foreach($permission as $key)
                                    {
                                    if($key=="mailer") {?><li><a id="mailer"  href="<?=FXPP::loc_url('administration/mailer')?>"><?= lang('admn-mnu1');?></a></li><?php }    
                                    if($key=="acveri") {?><li><a id="accountverification" href="<?=FXPP::loc_url('administration/accountverification')?>"><?= lang('admn-mnu3');?></a></li><?php }    
                                   if($key=="manacces") {?><li><a id="manageaccess" href="<?=FXPP::loc_url('administration/manage-access')?>"><?= lang('admn-mnu4');?></a></li><?php }    
                                   if($key=="withdqueue") {?><li><a id="withdrawalqueue" href="<?=FXPP::loc_url('administration/withdrawal-queue')?>"><?= lang('admn-mnu5');?></a></li><?php }    
                                   if($key=="manaccounts") {?><li><a id="manageaccounts" href="<?=FXPP::loc_url('administration/manage-accounts')?>"><?= lang('admn-mnu6');?></a></li><?php }    
                                   if($key=="mannews") {?><li><a id="managenews" href="<?=FXPP::loc_url('administration/manage-news')?>"><?= lang('admn-mnu7');?></a></li><?php }
                                     
                                }
                           ?>
                        
                         <li><a id="managebonus" href="<?php echo FXPP::loc_url('administration/manage_bonus')?>">Manage Bonus</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

 