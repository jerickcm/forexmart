<?php error_reporting(E_ALL) ?>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link href="<?= $this->template->Fonts()?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>style.css" rel="stylesheet">

    <link href="<?= $this->template->Css()?>custom.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>flags32.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>flags16.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>carousel.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>custom-external.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>external-style.css" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="<?= $this->template->Css()?>owl.carousel.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>owl.theme.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>owl.transitions.css" rel="stylesheet">
    <!--<script src="<?/*= $this->template->Js()*/?>jquery-1.11.3.min.js"></script>-->
    <!-- Custom CSS -->
    <link href="<?= $this->template->Css()?>scrolling-nav.css" rel="stylesheet">
    <script  src="<?= $this->template->Js()?>jquery.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?= $this->template->Js()?>html2canvas.js"></script>
    <script src="<?= $this->template->Js()?>jquery.plugin.html2canvas.js"></script>
    <script type="text/javascript" src="https://gabelerner.github.io/canvg/rgbcolor.js"></script>
    <script type="text/javascript" src="https://gabelerner.github.io/canvg/StackBlur.js"></script>
    <script type="text/javascript" src="https://gabelerner.github.io/canvg/canvg.js"></script>
</head>
<body>
<style type="text/css">
    .boxborder{border: 1px solid appworkspace; height: 24px; width: 24px; margin: 5px; float: right}
    .countryColor{height: 20px; width: 20px; margin: 1px;}
    .boxl{ width:0px; }
    .boxname{ width:250px; }

    .adjust1374{
        width: 100%!important;
        text-align: center!important;
    }

    .admin-nav-collapse
    {
        border-color: transparent!important;
    }
    .admin-collapse
    {
        background: #0c5c93!important;
        border: none;
        margin-top: 12px;
        transition: all ease 0.3s;
    }
    .admin-collapse:hover
    {
        background: #1a73b2!important;
        transition: all ease 0.3s;
    }
    .admin-collapse .icon-bar
    {
        background: #2988ca!important;
    }
    .main-dashboard-holder
    {
        width: 100%;
        margin-bottom: 50px;
    }
    .main-chart-holder
    {
        width: 100%;
        border: 1px solid #ddd;
        margin-top: 20px;
    }
    .chart-header
    {
        width: 100%;
        padding: 5px 10px;
        box-sizing: border-box;
        background: #2988ca;
    }
    .chart-title
    {
        width: 66.66666%;
        float: left;
    }
    .chart-title h1
    {
        font-family: Open Sans;
        font-weight: 400;
        font-size: 14px;
        margin: 0!important;
        color: #fff;
        margin-top: 3px!important;
        /*text-transform: uppercase;*/
    }
    .chart-title h1 i
    {
        margin-right: 7px;
    }
    .chart-action-holder
    {
        width: 33.3333%;
        float: right;
        text-align: right;
        padding-bottom: 3px;
    }
    .chart-action-holder a
    {
        font-size: 10px;
        margin-left: 2px;
        color: #fff;
        border: 1px solid #fff;
        padding: 1px 4px;
        transition: all ease 0.3s;
    }
    .chart-action-holder a:hover
    {
        background: #fff;
        color: #2988ca;
        transition: all ease 0.3s;
    }
    .chart-holder
    {
        min-height: 350px;
        /*border: 1px solid #ddd;*/
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }
    .table-chart-holder
    {
        /*border: 1px solid #ddd;*/
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }
    .chart-footer
    {
        width: 100%;
        background: #d4edfe;
        /*border: 1px solid #ddd;*/
        box-sizing: border-box;
        padding: 10px;
    }
    .chart-footer h1
    {
        font-size: 13px;
        font-family: Open Sans;
        margin: 0;
        color: #6a6a6a;
        text-align: center;
        width: 100%;
        border-bottom: 1px solid #c0e5fe;
        padding-bottom: 10px;
    }
    .chart-legend
    {
        width: calc(100% / 2);
        float: left;
    }
    .chart-legend ul
    {
        list-style: none;
        padding: 0;
        margin-left: 30px;
        margin-bottom: 0;
    }
    .chart-legend ul li
    {
        padding: 3px 0;
        font-family: Open Sans;
        font-size: 13px;
    }
    .chart-legend ul li i
    {
        margin-right: 10px;
    }
    .circle-green
    {
        color: #8EB021;
    }
    .circle-red
    {
        color: #D04437;
    }
    .circle-blue
    {
        color: #2988ca;
    }
    .chart-period
    {
        width: calc(100% / 2);
        float: left;
        text-align: right;
    }
    .chart-option
    {
        border: 1px solid #ddd;
        font-size: 13px;
        padding: 5px 10px;
    }
    .chart-lbl
    {
        color: #6a6a6a;
        font-family: Open Sans;
        font-size: 13px;
        font-weight: 600;
    }
    .chart-fg
    {
        margin-top: 15px;
        margin-bottom: 0;
    }
    .table-chart-holder
    {
        width: 100%;
    }
    .table-chart
    {
        width: 100%;
        margin-bottom: 5px;
        margin-top: 5px;
        /*border: 1px solid #ddd;*/
    }
    .chart-user, .chart-percent
    {
        width: 10%;
    }
    .chart-percent-bar
    {
        width: 40%;
    }
    .table-chart thead tr
    {

    }
    .table-chart thead tr th
    {
        font-size: 13px;
        font-family: Open Sans;
        font-weight: 600;
        color: #333;
        padding: 3px 5px;
        background: #d4edfe;
        border: 1px solid #ddd;
        border-bottom: none;
    }
    .table-chart tbody
    {
        border: 1px solid #ddd;
    }
    .table-chart tbody tr
    {
        transition: all ease 0.3s;
    }
    .table-chart tbody tr:hover
    {
        background: #d4edfe!important;
        transition: all ease 0.3s;
    }
    .table-chart tbody tr:nth-child(odd)
    {
        background: #f1f8fd;
    }
    .table-chart tbody tr td
    {
        font-size: 13px;
        font-family: Open Sans;
        font-weight: 400;
        color: #6a6a6a;
        padding: 5px;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }
    .percent-bar
    {
        width: 100%;
        display: inline-block;
        background: #2988ca;
        min-height: 13px;
    }
    .total-account
    {
        background: #d4edfe;
        text-align: center;
    }
    .total-account span
    {
        font-weight: 600;
        color: #333;
    }
    .chart-pagination-holder
    {
        text-align: right;
        margin-bottom: -5px!important;
    }
    .chart-pagination
    {
        margin: 0;
    }
</style>

<style type="text/css">
    .queue-tab-list {
        display: table;
        width: 100%;
    }

    .settings-tab ul li {
        display: table-cell;
        float: none !important;
    }

    .section{
        min-height:inherit!important;
    }

    #dwspagination_wrapper .row:last-child {
        background: #d4edfe;
        box-sizing: border-box;
        margin-left: -10px;
        margin-right: -10px;
        margin-bottom: -10px;
        padding-top: 10px;
    }

    .countryColor {
        height: 20px;
        width: 20px;
        margin: 0 auto;
    }

    .box-num {
        width: 4%;
        text-align: right;
    }

    .box-color {
        width: 6%;
    }

    .filter-top-countries, .chart-fg {
        width: 100%!important;
        text-align: center!important;
    }

    .main-dashboard-holder {
        display: inline-block;
    }

    .table-chart {
        width: 100%;
    }

</style>
<div class="container">
    <div class="row">
        <div class="main-dashboard-holder">
            <row>
                <div class="col-md-12 col-dashboard" id="dws_accounts_graph_<?php echo $days ?>">
                    <div class="main-chart-holder">
                        <div class="chart-header">
                            <div class="chart-title">
                                <h1><i class="fa fa-sign-in"></i>Deposit, Withdrawal and Saldo</h1>
                            </div>
                            <div class="chart-action-holder">
                                <a href="#" class="cursord" id="dws_expand" title="Expand Widget" ><i class="fa fa-expand"></i></a>
                                <input type="hidden" class="expend dr_graph" name="dws_graph" id="dws_accounts_expand" value="0"/>
                            </div><div class="clearfix"></div>
                        </div>
                        <div class="chart-holder" id="dws_account_graph">
                        </div>
                        <div class="chart-footer">
                            <h1>Opened account in the last <span id="lbl_dws_period"><?php echo $days ?></span> days</h1>
                            <div class="center">
                                &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-circle-o circle-red"></i> Deposits
                                &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-circle-o circle-green"></i> Withdrawals
                                &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-circle-o circle-blue"></i> Saldo (Deposits - Withdrawals)
                                &nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="center" >
                                <div class="form-group chart-fg">
                                    <label for="" class="chart-lbl">Cumulative</label>
                                    <select class="chart-option" name="dws_accounts" id="dws_cumulative_<?php echo $days ?>">
                                        <option value="1">YES</option>
                                        <option selected value="0">NO</option>
                                    </select>
                                    &nbsp;&nbsp;&nbsp;
                                    <label for="" class="chart-lbl">Period</label>
                                    <select class="chart-option" name="dwslimit" id="dws_period_<?php echo $days ?>">
                                        <option <?php echo ($days == 30) ? 'selected' : '' ?> value="30">30 days</option>
                                        <option <?php echo ($days == 60) ? 'selected' : '' ?> value="60">60 days</option>
                                        <option <?php echo ($days == 180) ? 'selected' : '' ?> value="180">180 days</option>
                                        <option <?php echo ($days == 360) ? 'selected' : '' ?> value="360">360 days</option>
                                        <option <?php echo ($days == 540) ? 'selected' : '' ?> value="540">540 days</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </row>
        </div>
    </div>
</div>
<script src="<?= $this->template->Js()?>Moment.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        var dws_option = {
            chart: {
                type: 'spline',
                width: 900,
                height: 500
            },
            title: {
                text: 'Deposit, Withdrawal and Saldo Graph'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f} '
            },

            plotOptions: {
                series: {
                    animation: false
                },
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            series: [
                {
                    name: 'Deposits',
                    color: '#d04437'
                },{
                    name: 'Withdrawals',
                    color: '#8eb04d'
                },{
                    name: 'Saldo (Deposits - Withdrawals)' ,
                    color: '#2988ca'
                }
            ]
        };

        dws_option.chart.renderTo = 'dws_account_graph';
        dws_option.series[0].data = [<?php echo implode(",", $dws_chart['deposit']) ?>];
        dws_option.series[1].data = [<?php echo implode(",", $dws_chart['withdraw']) ?>];
        dws_option.series[2].data = [<?php echo implode(",", $dws_chart['saldo']) ?>];
        var dws_chart = new Highcharts.Chart(dws_option);
        dws_chart.setTitle({text: 'Deposit, Withdrawal and Saldo Graph'});
    });
</script>
</body>
</html>