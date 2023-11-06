<link href="<?= $this->template->Css() ?>custome-contest-monitoring.css" rel="stylesheet">
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if (!empty($error)) { ?>
                    <br/>
                    <br/>
                    <div class="alert alert-danger center">
                        <?= $error; ?>
                    </div>
                <?php } else { ?>
                    <input type="hidden" name="trader" id="trader" value="<?= isset($trader) ? $trader : ''; ?>" >
                    <h1 class="license-title">Account Monitoring <?= isset($trader) ? $trader : ''; ?></h1>
                    <!--                    --><?php //if(IPLoc::Office()){  ?>
                    <?php
                    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
                    if (($Arank % 100) >= 11 && ($Arank % 100) <= 13) {
                        $rankvalue = $Arank . 'th';
                    } else {
                        $rankvalue = $Arank . $ends[$Arank % 10];
                    }
                    ?>

                    <p> Account <?= isset($trader) ? $trader : ''; ?>  is a contestant of MoneyFall stage #<?php echo $weekno; ?>, dated from  <?php echo $Sdate; ?> to <?php echo $Edate; ?>. Currently Account <?= isset($trader) ? $trader : ''; ?> is <?php echo $rankvalue; ?> and pretended on prize fund $<?php echo $pricefund; ?> from ForexMart company. The contest is held on demo-account is risk free sphere. The contest is held each week, you can register <a href="<?php echo FXPP::loc_url('forex-contests/money-fall/registration') ?>" >here</a>. Next stage will start on <?= DateTime::createFromFormat('Y/d/m', date('Y/d/m', strtotime("monday next week ")))->format(' F j, Y'); ?>. </p>

                    <!--                    --><?php //} ?>

                    <div class="broker-info-holder">
                        <div class="broker-info">
                            <div class="broker-info-text">
                                <p>Broker: <span>ForexMart</span></p>
                                <p>Account: <span><?= isset($trader) ? $trader : ''; ?></span></p>
                                <p>Contest: <span> Money Fall</span></p>
                            </div>
                        </div>
                        <div class="acct-monitoring-links">
                            <div class="monitoring-links-holder">
                                <ul>
                                    <li><a href="<?= $this->config->item('domain-www'); ?>/forex-contests/money-fall">Contest home page</a></li>
                                    <li><a href="<?= $this->config->item('domain-www'); ?>/contest/contest-rules">Contest rules</a></li>
                                    <li><a href="<?= $this->config->item('domain-www'); ?>/money-fall-registration">Registration for contest</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div><div class="clearfix"></div>
                    </div>
                    <div class="monitoring-chart-holder">
                        <div class="chart-control-holder">
                            <div class="chart-control">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group fg">
                                            <label>From Date</label>
                                            <input id="date_start" name="date_start" type="text" class="datepick form-control round-0"  placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group fg">
                                            <label>To Date</label>
                                            <input id="date_end" name="date_end" type="text" class="datepick form-control round-0"  placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-control">
                                <div class="row">
                                    <div class="col-sm-4 pull-right">
                                        <button class="Reset chart-reset">Reset</button>
                                    </div>
                                    <div class="col-sm-4 pull-right">
                                        <button class="Apply chart-apply">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="monitoring-chart ">

                            <div id="chartContainer" style="height: 700px; width: 1090px;margin: 25px 20px;"></div>

                            <br/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4 class="fm-accnt-tbl-title">Open Trades</h4>
                        <div class="fm-accnt-table table-responsive">
                            <table id="OpenTrades" name="OpenTrades" class="table table-bordered trades-table">
                                <thead>
                                <tr>
                                    <th>Ticket</th>
                                    <th>Type</th>
                                    <th>Volume</th>
                                    <th>Symbol</th>
                                    <th>Open Price</th>
                                    <th>SL</th>
                                    <th>TP</th>
                                    <th>Close Price</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if($service){ ?>
                                    <?= $Opened; ?>
                                <tr class="total">
                                    <td colspan="8">Summary profit/loss : </td>
                                    <td><?= $OpenTotal ?></td>
                                </tr>
                                    <?php }else{ ?>
                                <tr >
                                    <td  colspan="9" align="right">
                                        Service is temporarily unvailable.
                                    </td>
                                </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4 class="fm-accnt-tbl-title">Closed Trades</h4>
                        <div class="fm-accnt-table table-responsive">
                            <table id="ClosedTrades" name="ClosedTrades"  class="table table-bordered trades-table">
                                <thead>
                                <tr>
                                    <th>Ticket</th>
                                    <th>Type</th>
                                    <th>Volume</th>
                                    <th>Symbol</th>
                                    <th>Open Price</th>
                                    <th>SL</th>
                                    <th>TP</th>
                                    <th>Close Price</th>
                                    <th>Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if($service){ ?>
                                    <?= $Closed; ?>
                                <tr class="total">
                                    <td colspan="8" align="right">Summary profit/loss : </td>
                                    <td id="closedtotal"><?= $ClosedTotal ?></td>
                                </tr>
                                    <?php }else{ ?>
                                <tr >
                                    <td  colspan="9" align="right">
                                        Service is temporarily unvailable.
                                    </td>
                                </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<script type='text/javascript'>
    $(document).ready(function () {

        var margin = '<?php echo $Margin; ?>';
        var equity = '<?php echo $Equity; ?>';
        var balance = '<?php echo $Balance; ?>';

        if (margin != '') {
            var JsonMargin = JSON.parse(margin);
            $.each(JsonMargin, function (key, value) {
//                JsonMargin[key].x = new Date((JsonMargin[key].x));
                JsonMargin[key].x = ((JsonMargin[key].x));
            });
        }
        if (equity != '') {
            var JsonEquity = JSON.parse(equity);
            $.each(JsonEquity, function (key, value) {
//                JsonEquity[key].x= new Date ((JsonEquity[key].x));
                JsonEquity[key].x = ((JsonEquity[key].x));
            });

        }
        if (balance != '') {
            var JsonBalance = JSON.parse(balance);
            $.each(JsonBalance, function (key, value) {
//                JsonBalance[key].x= new Date ( (JsonBalance[key].x));
                JsonBalance[key].x = ((JsonBalance[key].x));
            });
        }

        if (margin != '') {
            chartcanvas(JsonBalance, JsonEquity, JsonMargin);
        } else {
            chartcanvas(
                    [
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0}
                    ]
                    ,
                    [
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0}
                    ]
                    , [
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0},
                        {x: dfltdate, y: 0}
                    ]
                    );
        }

    });
</script>

<script type='text/javascript'>
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();

    var output = d.getFullYear() + '/' +
            (day < 10 ? '0' : '') + day + '/' +
            (month < 10 ? '0' : '') + month;

    var frmtdt = output.split("/");
    var dfltdate = new Date(frmtdt[0] + '-' + frmtdt[2] + '-' + frmtdt[1]);

    var d = new Date();
    var yesterday = new Date(d.getTime());
    yesterday.setDate(d.getDate() - 1);
    var month2 = yesterday.getMonth() + 1;
    var day2 = yesterday.getDate();

    var output2 = yesterday.getFullYear() + '/' +
            (day2 < 10 ? '0' : '') + day2 + '/' +
            (month2 < 10 ? '0' : '') + month2;

    $("#date_start").val(output2);
    $("#date_end").val(output);
    var pblc = [];
    var prvt = [];
    var site_url = "<?= FXPP::ajax_url() ?>";
    pblc['request'] = null;
    $(document).on("click", ".Apply", function () {
        $('#loader-holder').show();
        prvt["data"] = {
            from: $('input[name=date_start]').val(),
            to: $('input[name=date_end]').val(),
            trader: $('input[name=trader]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'Contest-monitoring/getTradeHistory',
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function (data) {
            $('#loader-holder').hide();
            $('#ClosedTrades').DataTable().destroy();
            $('tbody#closed').html('');

            $('#ClosedTrades tbody').html(data.Closed);
            $('#ClosedTrades tbody tr:last').after(data.ClosedTotal);
            if (data.Closed) {
            } else {
                $('#ClosedTrades tbody').html(data.ClosedTotal);
            }
            $('#ClosedTrades').DataTable({
                responsive: true,
                "dom": 'tp'
            });

            if (data.Margin != 'null') {
                var JsonMargin = JSON.parse(data.Margin);
                $.each(JsonMargin, function (key, value) {
//                    JsonMargin[key].x= new Date (JsonMargin[key].x);
                    JsonMargin[key].x = (JsonMargin[key].x);
                });
            }
            if (data.Equity != 'null') {
                var JsonEquity = JSON.parse(data.Equity);
                $.each(JsonEquity, function (key, value) {
//                    JsonEquity[key].x= new Date (JsonEquity[key].x);
                    JsonEquity[key].x = (JsonEquity[key].x);
                });
            }
            if (data.Balance != 'null') {
                var JsonBalance = JSON.parse(data.Balance);
                $.each(JsonBalance, function (key, value) {
//                    JsonBalance[key].x= new Date (JsonBalance[key].x);
                    JsonBalance[key].x = (JsonBalance[key].x);
                });
            }

            if (data.Margin != 'null') {
                chartcanvas(JsonBalance, JsonEquity, JsonMargin);
            } else {
                chartcanvas(
                        [
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0}
                        ]
                        ,
                        [
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0}
                        ]
                        , [
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0},
                            {x: dfltdate, y: 0}
                        ]
                        );
            }
        });

        pblc['request'].fail(function (jqXHR, textStatus) {
            $('#loader-holder').hide();
        });
        pblc['request'].always(function (jqXHR, textStatus) {
            $('#loader-holder').hide();
        });
    });

    $(document).on("click", ".Reset", function () {
        chartcanvas(
                [
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0}
                ]
                ,
                [
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0}
                ]
                , [
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0},
                    {x: dfltdate, y: 0}
                ]
                );

    });


    $(document).ready(function () {
        $("#date_start").datetimepicker({
            format: "YYYY/DD/MM",
            daysOfWeekDisabled: [0, 6],
            disabledDates: []
        });
        $("#date_end").datetimepicker({
            format: "YYYY/DD/MM",
            daysOfWeekDisabled: [0, 6],
            disabledDates: []
        });
    });


    $('.table').DataTable({
        responsive: true,
        "dom": 'tp'
    });


    function chartcanvas(balance, equity, margin) {
        var chart = new CanvasJS.Chart("chartContainer", {
            exportEnabled: true,
            zoomEnabled: true,
            zoomType: "xy",
            title: {
                text: ''
            },
            animationEnabled: true,
            animationDuration: 2000,
            axisY: {
                labelFontSize: 16,
                includeZero: false,

                tickColor: "DarkSlateBlue",
                tickThickness: 2,

                gridColor: "lightblue",
                gridThickness: 2
            },
            axisX: {
                labelFontSize: 16,
//                    interval:25,
                interval: 9,
                intervalType: "hour",
//                    valueFormatString: "hh MMM",
                valueFormatString: "hh TT D MMM YYYY",
                labelAngle: -70,

//                    gridThickness: 2,
//                    interval:1,
//                    intervalType:  "hour",
//                    valueFormatString: "hh TT K",
//                    labelAngle: -70,

                tickColor: "red",
                tickThickness: 2,

                gridColor: "lightblue",
                gridThickness: 2,

                interlacedColor: "#F0F8FF",
                labelAutoFit: false,
                tickLength: 2

            },
            data: [
                {
                    xValueType: "dateTime",
                    name: "Balance",
                    type: "line",
                    lineThickness: 3,
                    showInLegend: true,
                    dataPoints: balance,
                    markerType: "square",
                    legendText: "Balance"

                },
                {
                    xValueType: "dateTime",
                    name: "Equity",
                    lineThickness: 3,
                    showInLegend: true,
                    type: "line",
                    dataPoints: equity,
                    legendText: "Equity",
                    markerType: "cross"

                },
                {
                    xValueType: "dateTime",
                    name: "Margin",
                    lineThickness: 3,
                    showInLegend: true,
                    type: "line",
                    dataPoints: margin,
                    markerType: "circle",
                    legendText: "Margin"

                }
            ],
            legend: {
                cursor: "pointer",
                itemclick: function (e) {
                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else {
                        e.dataSeries.visible = true;
                    }
                    chart.render();
                }
            }
        });
        chart.render();
    }


</script>
