<link href="<?= $this->template->Css()?>style-deposit-withdraw-page.css" rel="stylesheet">
<?php if(IPLoc::Office()){ ?>
<link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
<?php } ?>

<div class="reg-form-holder">
<div class="partnership-main-holder">
<div class="container-fluid no-padding-mobile">
<div class="row">
<div class="col-lg-2 col-md-2 col-2-left">
    <?php
    include_once('layouts/external/sidebar-left.php');
    ?>
</div>
<div class="col-lg-8 col-md-8 col-8-center no-padding-mobile">
<div class="">
<div class="row">
<div class="col-lg-12 no-padding-mobile">
<div class="dw-tabs-holder ext-arabic-license-title" role="tabpanel">
<div class="tab-list-holder ext-arabic-license-text padding-mobile">
    <h1 class="license-title"><?= lang('dw_top');?></h1>
    <p style="text-align: justify">
        <?= lang('dw_p');?>
    </p>
</div>
<div class="tab-list-holder ext-arabic-tab-list-holder padding-mobile">
    <ul class="dw-tabs " role="tablist">
        <li class="active" role="presentation">
            <a aria-expanded="false" class="tab-active"  href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab" id="dep">
                <?= lang('dw_a0');?>
            </a>
        </li>
        <li class="" role="presentation">
            <a aria-expanded="true" href="#withdraw" aria-controls="withdraw" role="tab" data-toggle="tab" id="with">
                <?= lang('dw_a1');?>
            </a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="deposit">
<div class="table-responive table-ru">
<table class="table withdrawal-tab ext-arabic-withdrawal-tab">
<thead>
<tr>
    <td>
        <?= lang('dw_td0');?>
    </td>
    <td>
        <?= lang('dw_td1');?>
    </td>
    <td>
        <?= lang('dw_td2');?>
    </td>
</tr>
</thead>
<tbody>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class">
        <a href="#">
            <img src="<?= $this->template->Images()?>DepositWithdraw/withdraw_funds.png" alt="Withdraw funds" class="img-responsive">
        </a>

    </td>
    <td>
        <?= lang('dw_tddesc7');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/bank-transfer' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class">
        <a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/visa.png" alt="Visa" class="img-responsive">
        </a>
        <?= $data['Visa'] = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle0').'"
            ></i>'; ?>

    </td>
    <td>
        <?= lang('dw_tddesc1');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/debit-credit-cards' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMD');?>
        </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class">
        <a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/mastercard.png" alt="Mastercard" class="img-responsive"></a>
        <?= $data['MasterCard'] = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle0').'"></i>'; ?>
    </td>
    <td>
        <?= lang('dw_tddesc1');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/debit-credit-cards' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMD');?>
        </div>
    </a></td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/skrill.png" alt="Skrill" class="img-responsive"></a>
        <?= $data['skrill'] = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle2').'"></i>';?>

    </td>
    <td>
        <?= lang('dw_tddesc3');?>
    </td>
    <td>
        <a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/skrill' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
            <div class="open-dw open-trading"><?= lang('dw_aMD');?></div>
        </a>

    </td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/neteller.png" alt="Neteller" class="img-responsive"></a>
        <?= $data['Neteller'] = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle3').'"></i>';?>

    </td>
    <td>
        <?= lang('dw_tddesc4');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/neteller' : $this->config->item('domain-my').'/client/signin'?> " class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMD');?>
        </div>
    </a></td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/payco.png" alt="Payco" class="img-responsive"></a>

    </td>
    <td>

        <?= lang('dw_tddesc2_inst');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/payco' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/paypal.png" alt="paypal" class="img-responsive"></a>
        <?= $data['PayPal'] =   '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle4').'"></i>';?>

    </td>
    <td>
        <?= lang('dw_tddesc6');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/paypal' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMD');?>
        </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/qiwi.png" alt="qiwi" class="img-responsive"></a>

    </td>
    <td>

        <?= lang('dw_tddesc2_inst');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/qiwi' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/megatransfer.png" alt="Megatransfer" class="img-responsive"></a>

    </td>
    <td>

        <?= lang('dw_no_fees').lang('dw_tddesc2_inst');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/megatransfer' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/paxum.png" alt="paxum" class="img-responsive"></a>
        <?= $data['paxum'] = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle5').'"></i>';?>
    </td>
    <td>

        <?= lang('dw_tddesc15');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/paxum' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<!-- 13-06-2017
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>sofort.png" alt="sofort" class="img-responsive"></a>

    </td>
    <td>

    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/sofort' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>webmoney.png" alt="webmoney" class="img-responsive"></a>

    </td>
    <td>

    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/webmoney' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>bitcoin.png" alt="bitcoin" class="img-responsive"></a>

    </td>
    <td>

    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/bitcoin' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>yandex.png" alt="yandex" class="img-responsive"></a>

    </td>
    <td>

    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/yandex' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>moneta.png" alt="moneta" class="img-responsive"></a>

    </td>
    <td>

    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/moneta' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>fasapay.png" alt="fasapay" class="img-responsive"></a>

    </td>
    <td>

    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/deposit/fasapay' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">  <?= lang('dw_aMD');?> </div>
    </a></td>
</tr>
-->

</tbody>
</table>
</div>
<div class="minimum-dep-holder">

    <div style="margin: 0 auto;">
        <h1 class="minimum-dep-holder-h">
            <?= lang('dw_MID');?>

        </h1>
        <div class="table-responsive minimum-tab-holder" >
            <table class="table minimum-tab">
                <thead>
                <tr>
                    <th>
                        <?= lang('dw_usd');?>
                    </th>
                    <th>
                        <?= lang('dw_eur');?>
                    </th>
                    <th>
                        <?= lang('dw_gbp');?>
                    </th>
                    <th>
                        <?= lang('dw_rub');?>
                    </th>
                </tr>
                </thead>
                <tbody><tr>
                    <td>$1.00</td>
                    <td>€1.00</td>
                    <td>₤1.00</td>
                    <td>
                        <i class="fa fa-ruble"></i>

                        1.00
                    </td>
                </tr>
                </tbody></table>
        </div>
    </div>
</div>
</div>
<div role="tabpanel" class="tab-pane " id="withdraw">
<div class="table-responive">
<table class="table withdrawal-tab">
<thead>
<tr>
    <td>
        <?= lang('dw_td0');?>
    </td>
    <td>
        <?= lang('dw_td3');?>
    </td>
    <td>
        <?= lang('dw_td4');?>
    </td>
</tr>
</thead>
<tbody>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/withdraw_funds.png" alt="withdraw funds" class="img-responsive"></a>
        <?= $data['bank-transfer'] ;?>
    </td>
    <td>

        <?= lang('dw_tddesc7');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading"> <?= lang('dw_aMW');?></div>
    </a></td>
</tr>


<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/visa.png" alt="VISA" class="img-responsive"></a>
        <?= $data['Visa'];?>
    </td>
    <td>
        <?= lang('dw_tddesc8');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMW');?>
        </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/mastercard.png" alt="Mastercard" class="img-responsive"></a>
        <?= $data['MasterCard'];?>
    </td>
    <td>
        <?= lang('dw_tddesc8');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMW');?>
        </div>
    </a></td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/skrill.png" alt="Skrill" class="img-responsive"></a>
        <?= $data['skrill'];?>
    </td>
    <td>
        <?= lang('dw_tddesc10');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMW');?>
        </div>
    </a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/neteller.png" alt="Neteller" class="img-responsive"></a>
        <?= $data['Neteller'];?>
    </td>
    <td>
        <?= lang('dw_tddesc11');?>
    </td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
        <div class="open-dw open-trading">
            <?= lang('dw_aMW');?>
        </div>
    </a></td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/payco.png" alt="payco" class="img-responsive"></a>
        <?= $data['payco'] ;?>
    </td>
    <td><?= lang('dw_tddesc2_48');?></td>
    <td>
        <a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
            <div class="open-dw open-trading"> <?= lang('dw_aMW');?></div>
        </a>
    </td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/paypal.png" alt="paypal" class="img-responsive"></a>
        <?= $data['PayPal'];?>
    </td>
    <td><?= lang('dw_tddesc13');?></td>
    <td>
        <a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
            <div class="open-dw open-trading"><?= lang('dw_aMW');?></div>
        </a>
    </td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/qiwi.png" alt="qiwi" class="img-responsive"></a>
        <?= $data['payco'] ;?>
    </td>
    <td><?= lang('dw_tddesc2_48');?></td>
    <td>
        <a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
            <div class="open-dw open-trading"> <?= lang('dw_aMW');?></div>
        </a>
    </td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/megatransfer.png" alt="Megatransfer" class="img-responsive"></a>
        <?= $data['payco'] ;?>
    </td>
    <td><?= lang('dw_tddesc14');?></td>
    <td>
        <a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
            <div class="open-dw open-trading"> <?= lang('dw_aMW');?></div>
        </a>
    </td>
</tr>

<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-cls"><a href="#"><img src="<?= $this->template->Images()?>DepositWithdraw/paxum.png" alt="Paxum" class="img-responsive"></a>
        <?= $data['paxum'] = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.lang('dw_ttle5').'"></i>';?>
    </td>
    <td><?= lang('dw_tddesc14');?></td>
    <td>
        <a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn">
            <div class="open-dw open-trading"><?= lang('dw_aMW');?></div>
        </a>
    </td>
</tr>

<!-- 13-06-2017
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>sofort.png" alt="sofort" class="img-responsive"></a></td>
    <td></td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn"><div class="open-dw open-trading">  <?= lang('dw_aMW');?> </div></a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>webmoney.png" alt="webmoney" class="img-responsive"></a></td>
    <td></td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn"><div class="open-dw open-trading">  <?= lang('dw_aMW');?> </div></a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>bitcoin.png" alt="bitcoin" class="img-responsive"></a></td>
    <td></td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn"><div class="open-dw open-trading">  <?= lang('dw_aMW');?> </div></a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>yandex.png" alt="yandex" class="img-responsive"></a></td>
    <td></td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn"><div class="open-dw open-trading">  <?= lang('dw_aMW');?> </div></a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>moneta.png" alt="moneta" class="img-responsive"></a></td>
    <td></td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn"><div class="open-dw open-trading">  <?= lang('dw_aMW');?> </div></a></td>
</tr>
<tr>
    <td class="tab-img-holder ext-arabic-img-holder custome-td-class"><a href="#"><img src="<?= $this->template->Images()?>fasapay.png" alt="fasapay" class="img-responsive"></a></td>
    <td></td>
    <td><a href="<?= $this->session->userdata('logged') ? $this->config->item('domain-my').'/withdraw' : $this->config->item('domain-my').'/client/signin'?>" class="cstm_btn"><div class="open-dw open-trading">  <?= lang('dw_aMW');?> </div></a></td>
</tr>
-->

</tbody>
</table>
</div>
</div>

</div>
</div>

<?= $DemoAndLiveLinks; ?>
</div>
</div>
</div>
</div>
<div class="col-lg-2 col-md-2 col-2-right">
    <?php
    include_once('layouts/external/sidebar-right.php');
    ?>
</div>
</div>
</div>
</div>

</div>
<div class="parent-chat-widget-container col-centered fix-chat-widget" style="display:none;" id="support-wrapper">
    <div class="chat-widget-container">
        <div class="chat-widget-header">
            <a href="javascript:;" class="chat-widget-button-close"></a>
        </div>
        <div class="chat-widget-body">
            <div class="chat-widget-img-support">
                <img src="<?= $this->template->Images()?>chat-widget-img.png" alt="Chat">
            </div>
            <div class="chat-widget-statement">
                <div class="arrow-up"></div>
                <div class="arrow-left"></div>
                <div class="widget-content">
                    <p>Questions? </p><p> How can I help you?</p>
                </div>
            </div>
        </div>
        <div class="chat-widget-footer">
            <a href="javascript:void(Tawk_API.toggle())"><button id="start-chat">Start Chat</button></a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('#support-wrapper').toggle('slide');
            var w_width = $(this).width();
            if(w_width < 1551 && w_width > 1340){
                $(".sidebar-left").css('margin-top','10px');
            } else{
                $(".sidebar-left").css('margin-top','400px');
            }
        }, 5000);
        $('[data-toggle="tooltip"]').tooltip();
    });
    /*
    $(document).on("click","#start-chat" ,function () {
       $("#maximizeChat").click();
        console.log('This is TowkTO test');
    });
    */
</script>
<style type="text/css">
    .chat-widget-footer a{text-decoration:none;}
</style>