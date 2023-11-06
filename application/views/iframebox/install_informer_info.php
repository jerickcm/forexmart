<?php $this->lang->load('informers_lang');?>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>FX Site</title>

<link href="<?= $this->template->Css() ?>font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap Core CSS -->
<link href="<?= $this->template->Css() ?>bootstrap.min.css" rel="stylesheet">
<link href="<?= $this->template->Css() ?>external-style.css" rel="stylesheet">
<link href="<?= $this->template->Css() ?>dataTables.bootstrap.css" rel="stylesheet">

<link href="<?= $this->template->Css() ?>informer.css" rel="stylesheet">

<script src="<?= $this->template->Js() ?>jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->template->Css() ?>easy-responsive-tabs.css "/>


<script type="text/javascript">
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 95) {
            $('#nav').addClass('nav-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
        }
    });
</script>


<style>

body {
    background: none !important;
}

.informer-converter-holder .converter-drp, .informer-converter-holder .amount-label {
    text-align: left !important;
}

.informer-btn-switch-holder {
    margin-top: 0 !important;
}
.width-text {
    width: 120px!important;
}

.informer-tab-holder .informer-tabs a span {
    position: absolute;
    font-family: Georgia;
    font-size: 17px;
    margin-left: 5px;
    color: #fff;
}

.calendar-table tr th {
    font-size: 11px;
}

.calendar-event {
    width: 40%;
}

.logoLink {
    margin-bottom: 20px;
}

.logoLink a {
    display: inline-block;
    padding: 10px 5px;
    vertical-align: text-bottom;
}

.logoLink a img {
    height: 56px;
}

.formContainer {
    width: 100%;
}

.imgList {
    display: block;
    margin: 17px auto;
}

.listItem-title {
    font-size: 28px;
    font-weight: 500;
    font-family: Georgia;
    text-align: center;
    color: #2988ca;
}

.formTitle {
    font-family: Georgia;
    font-size: 58px;
    display: block;
    text-align: center;
    text-transform: uppercase;
    padding: 15px;
    color: #2988ca;
}

.list-group-item p {
    text-align: justify;
}

.textJustify {
    text-align: justify;
    line-height: 2;
    padding: 15px 20px;
}

#regulation {
    margin: 60px 0;
}

.logoList {
    list-style: none;
    width: 100%;
    padding: 0;
    margin: 0;
}

.logoList li {
    display: block;
    margin: 0 auto 20px auto;
    text-align: center;
}

.linkLogo {
    border: solid 1px #ddd;
    display: inline-block;
    padding: 40px;
    min-width: 300px;
    height: 200px;
    border-radius: 20px;
    margin: 0 10px 20px 10px;
}

.logoListWrapper {
    display: block;
    margin: 0 auto;
}

.one {
    padding: 20px 40px !important;
}

.inputData {
    margin-bottom: 20px;
}

.inputData .input-group-addon .fa {
    width: 30px;
}

.inputData .form-control {
    padding: 30px 12px;
}

.headingTitle {
    font-size: 34px;
    margin-bottom: 20px;
    text-align: center;
    color: #c8d1da;
}

.contentWrapper {
    background: url('../images/registration-background.jpg') no-repeat;
}

.inputFormcontainer {
    width: 60%;
    margin: 10% auto;
    border: solid 2px #ddd;
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 2px 2px 15px #000;
}

.columnStyle1 .panel, .columnStyle1 .panel .panel-body {
    border: none;
    background: transparent;
}

.columnStyle1 .panel .panel-body {
    padding: 5px 15px;
}

.inputGrpContainer {
    padding: 12px 60px 20px 60px;
}

.inputData .form-control, .inputData .input-group-addon {
    border-radius: 0;
    border: 0;
    background: rgba(0, 0, 0, 0.4);
}

.inputData .input-group-addon {
    background: #2988ca;
}

.inputData .input-group-addon .fa {
    background: #2988ca;
    color: #fff;
}

.inputData .form-control {
    border: solid 2px #2988ca;
    box-shadow: none;
    color: #fff;
    background: rgba(0, 0, 0, 0.1);
}

.grpData {
    padding: 60px 20px;
}

.btnSubmit {
    width: 100%;
    padding: 15px 10px;
    font-size: 16px;
    display: block;
    margin: 0 auto 20px auto;
    border-radius: 0;
    font-weight: 600;
}

.btnSubmit:hover, .btnSubmit:focus {
    background: #bbb;
    color: #333;
    box-shadow: none;
    outline: 0;
}

.iconHolder {
    height: 150px;
    width: 150px;
    border-radius: 78px;
    border: solid 3px #ddd;
    display: block;
    margin: 0 auto 20px auto;
    overflow: hidden;
    padding: 10px;
}

.memberIcon {
    width: 100%;
    height: auto;
}

.lightTextCenter {
    text-align: center;
    color: #c8d1da;
}

.btnSignIn {
    margin: 0 auto;
    display: block;
    width: 150px;
    font-size: 16px;
    padding: 15px 10px;
    border-radius: 0;
    background: #29a643;
    color: #fff;
}

.btnSignIn:hover, .btnSignIn:focus {
    background: #1b8330;
    color: #fff;
    box-shadow: none;
    outline: 0;
}

.inputData .fa-exclamation-circle {
    position: absolute;
    right: 0;
    z-index: 1;
    color: #fa5454;
    font-size: 1.5em;
    height: 44px;
    padding: 10px;
    margin: 16px 0;
}

.memberIcon {
    height: 80px !important;
    width: auto !important;
    margin: 22px auto !important;
    display: block !important;
}

.itemAdjustment {
    margin: 22px auto 22px 24px !important;
}

.multipleData-holder {
    padding: 0;
    margin: 0;
}

.multipleData-holder li {
    list-style: none;
    display: inline-block;
    vertical-align: middle;
    /*	margin: 0 8px;*/
}

.multipleData-holder li img {
    height: 24px;
    width: auto;
}

.multipleInfo-holder span {
    display: block;
    line-height: 1.2;
    font-size: 11px;
}

.largeTd {
    padding: 0 40px;
}

.trades-tab-holder table {
    /*	width: 60%;*/
    /*display: block;*/
    margin: 0 auto;
}

.trades-tab-holder table tbody tr {
    min-width: 100%;
}

.trades-tab-holder table thead tr th, .trades-tab-holder table tbody tr td {
    font-size: 12px;
    padding: 0 4px;
    vertical-align: middle;
}

/*.trades-tab-holder table tbody tr td:first-child{
    width: 142px;
}*/
.trades-tab-holder table tbody tr td:nth-child(n+2), .trades-tab-holder table thead tr th:nth-child(n+2) {
    padding: 2px 4px;
    vertical-align: middle;
    text-align: left;
}

.trades-tab-holder table thead tr th select {
    border-radius: 0;
}

#partnersAccount tbody tr td:first-child {
    width: 158px;
}

#clientAccount tbody tr td:first-child {
    width: 158px;
}

#informersTab {
    display: block !important;
    width: 100% !important;
    /* margin: 40px auto 20px auto!important;*/
}

.resp-tabs-list li {
    width: 50%;
    margin-right: 0 !important;
    text-align: center;
    background: #2988ca !important;
    color: #fff !important;
}

.resp-tabs-list li:hover {
    background: #2988ca;
}

.resp-tab-content {
    /*border-color: #2988ca!important;*/
    padding: 0 !important;
    border: none !important;
}

.resp-tabs-list .resp-tab-active {
    background: #257cb8 !important;
    color: #fff;
    border: none !important;
    text-decoration: underline;
}

.fx-monitoring-title {
    display: block;
    color: white;
    padding: 10px 8px;
    margin: 0 auto;

    font-family: Georgia;
    background-color: #2f8bcb;
}

.dataReplace-res a {
    display: block;
    text-align: center;
    outline: none;
}

.dataReplace-res a img {
    border: 1px solid #ddd;
}

.informersForm-tiitle {
    width: 100%;
    margin: 20px auto;
}

.informersChart-modal .modal .modal-dialog {
    min-height: 100%;
}

.informersChart-modal .modal .modal-content {
    width: 28% !important;
    display: block;
    border-radius: 0;
    margin: 70% auto;
}

.informersChart-modal .modal-backdrop.fade {
    opacity: 0;
}

.dataReplace-res img {
    display: block;
    margin: 0 auto;
}

.trades-tab-holder .table-responsive {
    overflow-x: hidden;
    padding-top: 10px;
}

.informersSection {
    width: 100%;
    position: relative;
}

.informersSection .panel-info {
    width: 342px;
    display: block;
    margin: 0 auto;
}

.panel-table-holder {
    padding: 0 !important;
}

.trades-tab-holder .dataTables_wrapper .row .col-sm-6 {
    display: block;
    margin: 0 auto;
    width: 100%;
    float: none;
}

.trades-tab-holder .dataTables_wrapper .dataTables_length label,
.trades-tab-holder .dataTables_wrapper .dataTables_filter label,
.trades-tab-holder .dataTables_wrapper .dataTables_info,
.trades-tab-holder .dataTables_wrapper .dataTables_paginate {
    font-size: 11px;
    text-align: center;
    display: block;
}

.dataTables_wrapper .dataTables_filter .input-sm, .dataTables_wrapper .dataTables_length select {
    font-size: 11px !important;
    height: 25px !important;
}

.new-division-informer .informer-tabs {
    width: calc(100% / 6) !important;
}

@media only screen and (max-width: 1199px) {
    .inputFormcontainer {
        width: 100%;
    }

    .informer-tab-holder .informer-tabs a span {
        font-size: 14px !important;
    }
}

@media only screen and (max-width: 991px) {
    #informersTab {
        width: 100% !important;
    }

    .informersForm-tiitle {
        width: 100%;
    }

    .formTitle {
        font-size: 48px;
    }

    .informer-tab-holder .informer-tabs a span {
        font-size: 11px !important;
    }
}

@media only screen and (max-width: 768px) {
    ul.resp-tabs-list {
        display: block !important;
    }

    h2.resp-accordion {
        display: none !important;
    }

    .trades-tab-holder table thead tr th select {
        padding: 0 4px;
    }
}

@media only screen and (max-width: 767px) {
    .grpData {
        padding: 22px 20px;
    }

    .columnStyle1 {
        border-right: 0;
    }

    .columnStyle1 .panel {
        border-bottom: 0;
    }

    .informersChart-modal .modal .modal-content {
        width: 25% !important;
    }

    div.dataTables_length, div.dataTables_filter {
        text-align: left !important;
        padding-left: 10px;
    }

    .trades-tab-holder .table-responsive {
        overflow-x: auto;
        padding-top: 10px;
    }

    .dataTables_wrapper .dataTables_filter .form-control {
        width: auto;
    }

    .new-division-informer .informer-tabs {
        width: calc(100% /3) !important;
    }

    .informer-tab-holder .informer-tabs a span {
        font-size: 14px !important;
    }
}

@media only screen and (max-width: 716px) {
    .formTitle {
        font-size: 38px;
    }

    .listItem-title {
        font-size: 22px;
    }

    .textJustify {
        padding: 0;
    }
}

@media only screen and (max-width: 635px) {
    .dataReplace-res .imgChart {
        display: none;
    }

    .dataReplace-res a {
        display: block;
    }

    .trades-tab-holder table thead tr th select {
        padding: 0px;
    }

    .informersChart-modal .modal .modal-content {
        width: 27% !important;
    }
}

@media only screen and (max-width: 578px) {
    .formTitle {
        font-size: 32px;
    }
}

@media only screen and (max-width: 556px) {
    .inputGrpContainer {
        padding: 0;
    }

    .btnSubmit {
        margin-bottom: 20px;
    }

    .headingTitle {
        font-size: 28px;
    }

    .informersChart-modal .modal .modal-content {
        width: 32% !important;
    }

    /*.multipleData-holder li{
        margin: 0 2px;
    }*/
    /*.multipleData-holder li img{
        height: 30px;
    }*/
    .listItem-title {
        font-size: 18px;
    }

    .new-division-informer .informer-tabs {
        width: calc(100%/2) !important;
    }

    .informer-tab-holder .informer-tabs a span {
        font-size: 16px !important;
    }
}

@media only screen and (max-width: 482px) {
    .multipleData-holder li {
        padding: 0 !important;
    }

    .resp-tab-content {
        padding: 0 !important;
    }

    .trades-tab-holder table tbody tr td, .trades-tab-holder table thead tr th, .trades-tab-holder table thead tr th select {
        font-size: 11px;
    }

    .informersForm-tiitle {
        font-size: 20px;
        margin: 5px auto;
    }

    .informersChart-modal .modal .modal-content {
        width: 39% !important;
    }

    .formTitle {
        font-size: 22px;
        font-weight: 600;
    }

    .listItem-title {
        font-size: 14px;
        font-weight: 600;
    }
}

@media only screen and (max-width: 412px) {
    .trades-tab-holder table thead tr th, .trades-tab-holder table tbody tr td, .trades-tab-holder table thead tr th select {
        font-size: 9px;
    }

    .trades-tab-holder table tbody tr td:first-child {
        width: auto;
    }

    .trades-tab-holder table thead tr th select {
        height: 22px;
    }

    .trades-tab-holder table thead tr th:nth-child(2) {
        width: 50px;
    }

    .multipleData-holder li {
        margin: 0 2px !important;
    }

    .multipleData-holder li img {
        height: 24px;
    }

    .informersForm-tiitle {
        font-size: 16px;
        margin: 5px auto;
    }

    .informersChart-modal .modal .modal-content {
        width: 43% !important;
    }

    .formTitle {
        font-size: 20px;
    }

    .listItem-title {
        font-size: 12px;
    }
}

@media only screen and (max-width: 370px) {
    .columnStyle1 .panel .panel-body {
        padding: 5px 7px;
    }

    .informersChart-modal .modal .modal-content {
        width: 51% !important;
    }

    .linkLogo {
        min-width: 270px;
    }

    .formTitle {
        font-size: 16px;
    }

    .trades-tab-holder table tbody tr td {
        font-size: 9px;
    }

    .listItem-title {
        font-weight: 500;
    }

    .informer-tab-holder .informer-tabs a span {
        font-size: 12px !important;
    }

    .informersSection .panel-info, .fx-monitoring-title {
        width: 290px;
    }

    .inputData input[type=text]::-webkit-input-placeholder {
        font-size: 11.6px;
    }

    .inputData input[type=text]::-moz-placeholder {
        font-size: 11.6px;
    }

    .inputData input[type=text]:-ms-input-placeholder {
        font-size: 11.6px;
    }
    .dataTables_paginate {
        font-size: 8px!important;
        text-align: center;
        display: block;
    }

}

.inputData input[type=text]:-moz-placeholder {
    font-size: 11.6px;
}

<?php
      if($data['values']){
    $row = $data['values']->row_array();

    $array = array();
   foreach( explode("&",$row['value']) as $d){
              $explode = explode("=",$d);
              $array[$explode[0]] = $explode[1];
   }
   // width=400&hbg=ffff80&bbg=ffffff&fbg=ffffff&fs=14&fa=left&fc=008000&hfont=Open Sans

extract($array);

        if($hbg){echo ".fx-monitoring-title{background-color:".$hbg." }";};
        if($fbg){echo ".quotes-footer{background-color:".$fbg." }";};
        if($bbg){echo ".table-responsive{background-color:".$bbg." }";};

         if($hfont){echo ".fx-monitoring-title{ font-family: ".$hfont."!important;font-size: ".$fs."!important;text-align: ".$fa."!important; color: ".$fc."!important;}";};

    }
?>

<?php

       /*$widthbox = $this->input->get('width',true);
        $hbg = $this->input->get('hbg',true);
        $bbg = $this->input->get('bbg',true);
        $fbg = $this->input->get('fbg',true);
        $fs = $this->input->get('fs',true);
        $fa = $this->input->get('fa',true);
        $fc = $this->input->get('fc',true);
        $hfont = $this->input->get('hfont',true);
        if($hbg){echo ".fx-monitoring-title{background-color:".$hbg." }";};
        if($fbg){echo ".quotes-footer{background-color:".$fbg." }";};
        if($bbg){echo ".table-responsive{background-color:".$bbg." }";};

         if($hfont){echo ".fx-monitoring-title{ font-family: ".$hfont."!important;font-size: ".$fs."!important;text-align: ".$fa."!important; color: ".$fc."!important;}";};*/
         if($width){
?>
.informersSection .panel-info {
    width: <?=$width?>px!important;
    display: block;
    margin: 0 auto;
}
<?php } ?>

.trades-tab-holder table {
    width: 100%!important;

}



</style>

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="padding:0!important;">
<div class="informersSection">

    <div class="panel panel-info">
        <div class="panel-heading quotes-heading">
            <img src="<?= $this->template->Images() ?>table-header-logo.png" class="informer-logo img-responsive">
        </div>
        <h4 class="fx-monitoring-title"><?=lang('inf_1')?></h4>
        <div class="panel-body panel-table-holder">
            <div id="informersTab">
                <ul class="resp-tabs-list informers">
                    <li><?=lang('inf_76')?></li>
                    <li><?=lang('inf_77')?></li>
                </ul>
                <div class="resp-tabs-container informers">
                    <div class="trades-tab-holder">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover one-table" id="clientAccount">
                                <thead>
                                <tr>
                                    <th style="width: 56%"><?=lang('inf_78')?></th>
                                    <th><?=lang('inf_79')?></th>
                                    <th><?=lang('inf_80')?></th>
                                    <th><?=lang('inf_81')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($data['account']) {

                                    foreach ($data['account'] as $d) {
                                        $counry = isset($data['all_client'][$d->Account]) ? $data['all_client'][$d->Account]['country'] : "";
                                        $full_name = isset($data['all_client'][$d->Account]) ? $data['all_client'][$d->Account]['full_name'] : "";

                                        if (!preg_match("/test/i", $full_name) and strlen($full_name) > 0 and strlen($counry) > 0) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <ul class="multipleData-holder">
                                                        <!--  <li><img src="images/trader_avatar.png"></li> -->
                                                        <li><img alt="" src="<?= $this->template->Images() ?>flags/svg/<?= strtolower($counry) . '.svg' ?>">
                                                        </li>
                                                        <li class="multipleInfo-holder"><span><b><?= $d->Account ?></b></span><span><?= $full_name ?></span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="dataReplace-res">
                                                    <!-- <img src="images/chart-01.png" class="imgChart"> --><a href=""
                                                                                                                data-toggle="modal"
                                                                                                                data-target=".chart">
                                                        <svg viewBox="0 0 200 100" class="chart2">

                                                            <polyline
                                                                fill="none"
                                                                stroke="#0074d9"
                                                                stroke-width="2"
                                                                points="
                                                           00,<?= rand(0, 100) ?>
                                                           20,<?= rand(0, 100) ?>
                                                           40,<?= rand(0, 100) ?>
                                                           60,<?= rand(0, 100) ?>
                                                           80,<?= rand(0, 100) ?>
                                                           100,<?= rand(0, 100) ?>
                                                           120,<?= rand(0, 100) ?>
                                                           140,<?= rand(0, 100) ?>
                                                           160,<?= rand(0, 100) ?>
                                                           180,<?= rand(0, 100) ?>
                                                           200,<?= rand(0, 100) ?>
                                                         "
                                                                />

                                                        </svg>
                                                    </a></td>
                                                <td><?= number_format($d->Equity, 2) ?></td>
                                                <td><?= number_format($d->Balance, 2) ?> USD</td>
                                            </tr>



                                        <?php
                                        }
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="trades-tab-holder">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover one-table" id="partnersAccount">
                                <thead>
                                <tr>
                                    <th style="width: 56%"><?=lang('inf_78')?></th>
                                    <th><?=lang('inf_79')?></th>
                                    <th><?=lang('inf_82')?></th>
                                    <th><?=lang('inf_81')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($data['commissions']) {

                                    foreach ($data['commissions'] as $d) {
                                        $counry = isset($data['all_client'][$d->Account]) ? $data['all_client'][$d->Account]['country'] : "";
                                        $full_name = isset($data['all_client'][$d->Account]) ? $data['all_client'][$d->Account]['full_name'] : "";
                                        $balance = isset($data['account'][$d->Account]) ? $data['account'][$d->Account]->Balance : "0.00";
                                        if (!preg_match("/test/i", $full_name) and strlen($full_name) > 0 and strlen($counry) > 0) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <ul class="multipleData-holder">
                                                        <!-- <li><img src="images/trader_avatar.png"></li> -->
                                                        <li><img alt="" src="<?= $this->template->Images() ?>flags/svg/<?= strtolower($counry) . '.svg' ?>">
                                                        </li>
                                                        <li class="multipleInfo-holder"><span><b><?= $d->Account ?></b></span><span><?= $full_name ?></span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="dataReplace-res">
                                                    <!-- <img src="images/chart-01.png" class="imgChart"> --><a href=""
                                                                                                                data-toggle="modal"
                                                                                                                data-target=".chart">
                                                        <svg viewBox="0 0 200 100" class="chart2">

                                                            <polyline
                                                                fill="none"
                                                                stroke="#0074d9"
                                                                stroke-width="2"
                                                                points="
                                                           00,<?= rand(0, 100) ?>
                                                           20,<?= rand(0, 100) ?>
                                                           40,<?= rand(0, 100) ?>
                                                           60,<?= rand(0, 100) ?>
                                                           80,<?= rand(0, 100) ?>
                                                           100,<?= rand(0, 100) ?>
                                                           120,<?= rand(0, 100) ?>
                                                           140,<?= rand(0, 100) ?>
                                                           160,<?= rand(0, 100) ?>
                                                           180,<?= rand(0, 100) ?>
                                                           200,<?= rand(0, 100) ?>
                                                         "
                                                                />

                                                        </svg>
                                                    </a></td>
                                                <td><?= number_format($d->CommissionTotal, 2) ?></td>
                                                <td><?= number_format($balance, 2) ?> USD</td>
                                            </tr>




                                        <?php
                                        }
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer quotes-footer">Powered by ForexMart</div>
    </div>

</div>
</div>

<link type="text/css" href="<?= $this->template->Css() ?>easy-responsive-tabs.css" rel="stylesheet">
<script type="application/javascript" src="<?= $this->template->Js() ?>easyResponsiveTabs.js"></script>
<script src="<?= $this->template->Js() ?>bootstrap.min.js"></script>
<script src="<?= $this->template->Js() ?>jquery.dataTables.min.js"></script>
<script src="<?= $this->template->Js() ?>dataTables.bootstrap.min.js"></script>
<script>
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        console.log(obj.contentWindow.document.body.scrollHeight + 'px');
    }


</script>
<script type="text/javascript">
    $(document).ready(function () {
        //Horizontal Tab
        $('#informersTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'informers', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                // $info.show();
            }
        });

    });

    $('#clientAccount').DataTable({
        "language": {
            'info':'<?=lang("inf_83")?>',
            "paginate": {
                "previous": "<<",
                "next": ">>"
            }
        },
        "pageLength": 10,
        "bLengthChange": false
        

    });
    $('#partnersAccount').DataTable({
        'info':'<?=lang("inf_83")?>',
        "language": {
            "paginate": {
                "previous": "<<",
                "next": ">>"
            }
        },
        "pageLength": 10,
        "bLengthChange": false
    });
</script>
</body>
</html>

