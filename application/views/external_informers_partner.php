<style>
    .table-responsive{
        overflow-x: hidden!important;
    }
    .nav-fix
    {
        position: fixed;
        top: 0;
        z-index: 9999;
        width: 100%;
        transition: all ease 0.3s;
    }
    [class*="span"] {
        float: left;
        min-height: 1px;
        margin-left: 3px;
        text-align: left;
    }
    .fx-monitoring-title{
        display:block;
        background-color: #2988ca;
        color:#fff;
        padding: 10px 10px;
        border-radius: 4px;
    }
    ul.resp-tabs-list, p {
        margin: 0px;
        padding: 0px;
    }

    .resp-tabs-list li {
        font-weight: 600;
        font-size: 13px;
        display: inline-block;
        padding: 13px 15px;
        margin: 0 4px 0 0;
        list-style: none;
        cursor: pointer;
        float: left;
    }

    .resp-tabs-container {
        padding: 0px;
        background-color: #fff;
        clear: left;
    }

    h2.resp-accordion {
        cursor: pointer;
        padding: 5px;
        display: none;
    }

    .resp-tab-content {
        display: none;
        padding: 15px;
    }

    .resp-tab-active {
        border: 1px solid #2988ca !important;
        border-bottom: none;
        margin-bottom: -1px !important;
        padding: 12px 14px 14px 14px !important;
        border-top: 4px solid #2988ca !important;
        border-bottom: 0px #fff solid !important;
    }

    .resp-tab-active {
        border-bottom: none;
        background-color: #fff;
    }

    .resp-content-active, .resp-accordion-active {
        display: block;
    }

    .resp-tab-content {
        border: 1px solid #c1c1c1;
        border-top-color: #2988ca;
    }

    h2.resp-accordion {
        font-size: 13px;
        border: 1px solid #c1c1c1;
        border-top: 0px solid #c1c1c1;
        margin: 0px;
        padding: 10px 15px;
    }

    h2.resp-tab-active {
        border-bottom: 0px solid #c1c1c1 !important;
        margin-bottom: 0px !important;
        padding: 10px 15px !important;
    }

    h2.resp-tab-title:last-child {
        border-bottom: 12px solid #c1c1c1 !important;
        background: blue;
    }

    .resp-arrow {
        width: 0;
        height: 0;
        float: right;
        margin-top: 3px;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 12px solid #c1c1c1;
    }

    h2.resp-tab-active span.resp-arrow {
        border: none;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 12px solid #9B9797;
    }

    /*-----------Accordion styles-----------*/
    h2.resp-tab-active {
        background: #DBDBDB;/* !important;*/
    }

    .resp-easy-accordion h2.resp-accordion {
        display: block;
    }

    .resp-easy-accordion .resp-tab-content {
        border: 1px solid #c1c1c1;
    }

    .resp-easy-accordion .resp-tab-content:last-child {
        border-bottom: 1px solid #c1c1c1;/* !important;*/
    }

    .resp-jfit {
        width: 100%;
        margin: 0px;
    }

    .resp-tab-content-active {
        display: block;
    }

    h2.resp-accordion:first-child {
        border-top: 1px solid #c1c1c1;/* !important;*/
    }

    /*Here your can change the breakpoint to set the accordion, when screen resolution changed*/
    @media only screen and (max-width: 768px) {
        ul.resp-tabs-list {
            display: none;
        }

        h2.resp-accordion {
            display: block;
        }

        .resp-accordion-closed {
            display: none !important;
        }
    }

    .chart2 {
        background: white;
        width: 100px;
        height: 50px;
        border-left: 1px dotted #555;
        border-bottom: 1px dotted #555;

    }

    /* pagination-responsive */
    @media (min-width:0px) and (max-width:650px) {
        .toggle-pagination {
            display: block
        }
        .toggle-pagination.active i:before {
            content: '\2212'
        }
        .pagination-responsive {
            width: 100%;
            margin-top: 10px;
            display: none;
        }
        .pagination-responsive > li > a,
        .pagination-responsive > li > span {
            width: 100%;
            margin: 0;
            line-height: 40px;
            padding: 0;
            border-radius: 0px!important;
        }
        .pagination-responsive > li {
            float: left;
            width: 20%;
            margin-top: -1px;
            text-align: center;
        }
    }
    @media (max-width:480px) {
        .pagination-responsive > li {
            width: 33%
        }
    }
    @media (max-width:320px) {
        .pagination-responsive > li {
            width: 50%
        }
    }
    @media (min-width:651px) {
        .toggle-pagination {
            display: none
        }
        .pagination-responsive {
            display: inline-block!important
        }
    }

    table.dataTable thead .sorting { background: url('/assets/images/sort_both.png') no-repeat center right !important; }
    table.dataTable thead .sorting_asc { background: url('/assets/images/sort_asc.png') no-repeat center right !important; }
    table.dataTable thead .sorting_desc { background: url('/assets/images/sort_desc.png') no-repeat center right !important; }

    table.dataTable thead .sorting_asc_disabled { background: url('/assets/images/sort_asc_disabled.png') no-repeat center right !important; }
    table.dataTable thead .sorting_desc_disabled { background: url('/assets/images/sort_desc_disabled.png') no-repeat center right !important; }
</style>

<div class="reg-form-holder">

<div class="container">
    <br>

    <h3>Informers for Client and Partners Account</h3>
    <br>
    <h4 class="fx-monitoring-title">Forex Monitoring</h4>
    <!--Horizontal Tab-->
    <div id="informersTab">
    <ul class="resp-tabs-list informers">
        <li>Client Account</li>
        <li>Partners Account</li>
    </ul>
    <div class="resp-tabs-container informers">
    <div>
        <div class="trades-tab-holder">
            <div class="table-responsive">
                <table class="table table-striped table-hover one-table">
                    <thead>
                    <tr>
                        <th>Account</th>
                        <th>Equity Chart</th>

                        <th>Equity</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($data['account']){

                        foreach($data['account'] as $d){
                            $counry = isset($data['all_client'][$d->Account])?$data['all_client'][$d->Account]['country']:"";
                            $full_name = isset($data['all_client'][$d->Account])?$data['all_client'][$d->Account]['full_name']:"";

                            if(!preg_match("/test/i",$full_name) and strlen($full_name)>0 and strlen($counry)>0 ){
                            ?>
                            <tr>
                                <td>
                                    <div class="span1">
                                        <img alt=""  src="<?= $this->template->Images() ?>trader_avatar.png">
                                    </div>
                                    <div class="span2">
                                        <img alt=""  src="<?= $this->template->Images() ?>flags/svg/<?=strtolower($counry).'.svg'?>" style="height:12px; width: 20px">&nbsp;<?=$d->Account?><br>
                                        <?=$full_name?>
                                    </div>
                                </td>
                                <td>
                                    <div class="span2" colspan="">
                                        <div><!--<img alt=""  src="<?/*= $this->template->Images() */?>chart-07.png">-->
                                            <svg viewBox="0 0 200 100" class="chart2">

                                                <polyline
                                                    fill="none"
                                                    stroke="#0074d9"
                                                    stroke-width="2"
                                                    points="
                                                           00,<?=rand(0, 100)?>
                                                           20,<?=rand(0, 100)?>
                                                           40,<?=rand(0, 100)?>
                                                           60,<?=rand(0, 100)?>
                                                           80,<?=rand(0, 100)?>
                                                           100,<?=rand(0, 100)?>
                                                           120,<?=rand(0, 100)?>
                                                           140,<?=rand(0, 100)?>
                                                           160,<?=rand(0, 100)?>
                                                           180,<?=rand(0, 100)?>
                                                           200,<?=rand(0, 100)?>
                                                         "
                                                    />

                                            </svg>
                                        </div>
                                    </div>
                                </td>

                                <td><?=number_format($d->Equity,2)?></td>
                                <td><?=number_format($d->Balance,2)?> USD</td>
                            </tr>

                        <?php  }}
                    }?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div>
        <div class="trades-tab-holder">
            <div class="table-responsive">
                <table class="table table-striped table-hover one-table">
                    <thead>
                    <tr>
                        <th>Account</th>
                        <th>Commission Chart</th>

                        <th>Commission</th>
                        <th> Balance
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($data['commissions']){

                        foreach($data['commissions'] as $d){
                            $counry = isset($data['all_client'][$d->Account])?$data['all_client'][$d->Account]['country']:"";
                            $full_name = isset($data['all_client'][$d->Account])?$data['all_client'][$d->Account]['full_name']:"";
                            $balance = isset($data['account'][$d->Account])?$data['account'][$d->Account]->Balance:"0.00";
                            if(!preg_match("/test/i",$full_name) and strlen($full_name)>0 and strlen($counry)>0){
                            ?>
                            <tr>
                                <td>
                                    <div class="span1">
                                        <img alt=""  src="<?= $this->template->Images() ?>trader_avatar.png">
                                    </div>
                                    <div class="span2">
                                        <img alt=""  src="<?= $this->template->Images() ?>flags/svg/<?=strtolower($counry).'.svg'?>" style="height:12px; width: 20px">&nbsp;<?=$d->Account?><br>
                                        <?=$full_name?>
                                    </div>
                                </td>
                                <td>
                                    <div class="span2" colspan="">
                                        <div><!--<img alt=""  src="<?/*= $this->template->Images() */?>chart-07.png">-->
                                            <svg viewBox="0 0 200 100" class="chart2">

                                                <polyline
                                                    fill="none"
                                                    stroke="#0074d9"
                                                    stroke-width="2"
                                                    points="
                                                           00,<?=rand(0, 100)?>
                                                           20,<?=rand(0, 100)?>
                                                           40,<?=rand(0, 100)?>
                                                           60,<?=rand(0, 100)?>
                                                           80,<?=rand(0, 100)?>
                                                           100,<?=rand(0, 100)?>
                                                           120,<?=rand(0, 100)?>
                                                           140,<?=rand(0, 100)?>
                                                           160,<?=rand(0, 100)?>
                                                           180,<?=rand(0, 100)?>
                                                           200,<?=rand(0, 100)?>
                                                         "
                                                    />

                                            </svg>
                                        </div>
                                    </div>
                                </td>

                                <td><?=number_format($d->CommissionTotal,2)?></td>
                                <td><?=number_format($balance,2)?> USD</td>
                            </tr>

                        <?php  }}
                    }?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?= $DemoAndLiveLinks ?>
</div>

<!-- modal -->
<div class="modal fade" id="popupd" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0" style="   left: 40%; position: fixed; top: 40%;">

        <img alt=""  src="<?= $this->template->Images() ?>/loder.GIF" class="img-responsive" style="margin-left: 114px;">


    </div>
</div>
<!-- end modal -->


<script>

   

    $(document).on("click", ".btn-show-banner", function () {
        $('#popupd').modal('show');
        var pagename = $(this).attr("id");
        var lang = '<?=FXPP::html_url()?>';

        $.post('/banners/BannersShow', {pagename: pagename, lang: lang}, function (view) {

            $("#ShowBannerPage").html(view);
            $('#popupd').modal('hide');
            // scroll position
            var Heigh = $("html").height();
            var scrolled = Heigh + 320//(Heigh-((Heigh/2)/2));
            $("body, html").animate({  scrollTop: scrolled});
        });
    });

    $(document).on("click", "#ShowBannerPage textarea", function () {
        $(this).select();
    });


    $(document).ready(function () {
        // $('.table').DataTable();
    });


</script>
<!-- Scrolling Nav JavaScript -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.page-link').mouseover(function () {
            $($(this).data('target')).fadeIn("fast");

        })
        $('.page-link').mouseleave(function () {
            $($(this).data('target')).fadeOut("fast");
        });

        $(".hidden-menu").hide();
        $(".menu-button").show();

        $('.menu-button').click(function(){
            $(".hidden-menu").slideToggle();
        });

    });
</script>
<script src="<?= $this->template->Js() ?>/easyResponsiveTabs.js"></script>
<script src="<?= $this->template->Js() ?>/jquery.dataTables.min.js"></script>
<script src="<?= $this->template->Js() ?>/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->template->Css() ?>/dataTables.bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->template->Css() ?>/easy-responsive-tabs.css " />
<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#informersTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'informers', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $(".table").DataTable({
            responsive: true,
            "bSort": true
        });
    });
</script>

