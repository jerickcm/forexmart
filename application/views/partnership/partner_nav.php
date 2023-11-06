<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-partner-nav.css' type='text/css'  />"));
    });
</script>
<?php $method = $this->router->method; ?>
<div class="col-md-3">
    <h1 class="license-title">
        <?=lang('x_fr_t');?>
    </h1>
    <div class="partner-tabs-all">
        <ul role="tablist">
            <li role="presentation" ><a class="<?=($method == 'friend_referrer') ? ' partner-active ' : '';?>" href="<?= FXPP::loc_url('partnership/friend-referrer');?>">
                    <?= lang('pt_n_0');?>
                    <!-- Friend-referrer -->
                </a>
            </li>
            <li role="presentation" ><a class="<?=($method == 'webmaster') ? ' partner-active ' : '';?>" href="<?= FXPP::loc_url('partnership/webmaster');?>">
                    <?= lang('pt_n_1');?>
                    <!-- Webmaster -->
                </a></li>
            <li role="presentation" ><a class="<?=($method == 'online_partner') ? ' partner-active ' : '';?>" href="<?= FXPP::loc_url('partnership/online-partner');?>">
                    <?= lang('pt_n_2');?>
                    <!-- Online Partner -->
                </a></li>
            <li role="presentation" ><a class="<?=($method == 'local_online_partner') ? ' partner-active ' : '';?>" href="<?= FXPP::loc_url('partnership/local-online-partner');?>">
                    <?= lang('pt_n_3');?>
                    <!-- Local Online Partner -->
                </a></li>
            <li role="presentation" ><a class="<?=($method == 'local_office_partner') ? ' partner-active ' : '';?>" href="<?= FXPP::loc_url('partnership/local-office-partner');?>">
                    <?= lang('pt_n_4');?>
                    <!-- Local Office Partner -->
                </a></li>
            <li role="presentation" ><a class="<?=($method == 'cpa') ? ' partner-active ' : '';?>" href="<?= FXPP::loc_url('partnership/cpa');?>" >
                    <?= lang('pt_n_5');?>
                    <!--CPA-->
                </a></li>
        </ul><div class="clearfix"></div>
    </div>
</div>