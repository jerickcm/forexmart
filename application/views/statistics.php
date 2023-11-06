<br/>
<br/>
<br/>

<script src="<?= $this->template->Js()?>Moment.js"></script>
<script src="<?= $this->template->Js()?>datetime-moment.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<label>
    <input type="radio" name="grouping" value="day" checked /> Daily
</label>
<label>
    <input type="radio" name="grouping" value="week" /> Weekly
</label>
<label>
    <input type="radio" name="grouping" value="month" /> Monthly
</label>
<div class="page-wrap">
    <div class="graphic-container myDiv3">
        <div class="container-header-holder">
            <a href="#" class="graph-title"><h4><i class="fa fa-area-chart"></i> Mailing Statistics</h4></a>
            <ul class="header-tools">
                <li><a href="#"><i class="fa fa-expand expand-stat3"></i></a></li>
                <li><a href="#"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul><div class="clearfix"></div>
        </div>
        <div class="graph-holder " >
            <h2>E-mail click statistics</h2>
            <div class="" id="container3"></div>
        </div>
        <div class="container-footer-holder">
            <div class="footer-content">
                <div class="text-group">
                    <label>Mailer:</label>
                    <select id="emailtype" name="emailtype" class="text-form-control">
                        <option value="0" selected="selected">Clicks Buy and Sell</option>
                        <option value="1">Mailer 1</option>
                        <option value="2">Mailer 2</option>
                        <option value="3">Mailer 3</option>
                    </select>
                    <label>Period:</label>
                    <select  id="period" name="period" class="text-form-control">
                        <option value="day" selected="selected">Daily</option>
                        <option value="week">Weekly</option>
                        <option value="month">Monthly</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $('.expand-stat3').click(function(e){
        $('.myDiv3').toggleClass('fullscreen');
        $("#container3").highcharts().reflow();
    });

    var myAjaxChart;

    $(document).ready(function () {

        myAjaxChart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
//                type: 'line'
//                type: 'area'
                type: 'spline'
            },title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
//                tickInterval: 3600 * 1000,
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Clicks'
                },
                min: 0
            },
//            tooltip: {
//                headerFormat: '<b>{series.name}</b><br>',
//                pointFormat: '{point.x:%e. %b}: {point.y:.2f} clicks'
//            },
            credits: {
                enabled: false
            },
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    },
                    dataLabels: {
                        enabled: true
                    }
                }

//                series: {
//                    dataGrouping: {
//                        enabled: true,
//                        units: [ ['day', [1]] ]
//                    }
//                }
            },
//            dataGrouping: {
//
//                units: [ ['week', [1]] ]
//            },
            series: [{
                name: 'Clicks',
                data: [

                ]
            }]

        });

        var site_url = "<?php echo FXPP::loc_url('')?>";
        generatechart();

        $('select#emailtype').on('change', function() {
            generatechart();
        });

        $('select#period').on('change', function() {
            generatechart();

            //http://api.highcharts.com/highstock#plotOptions.series.dataGrouping.units
            var unit = $('#period').val();
            console.log(unit);
            //http://api.highcharts.com/highstock#Series.update
//            myAjaxChart.series.forEach(function(ser) {
//                ser.update({
//                    dataGrouping: {
//                        enabled: true,
//                        forced: true,
//                        units: [ [unit, [1]] ]
//                    }
//                }, false);
//            });
//            var seriesWeek = {
//                dataGrouping: {
//                    units: [ [unit, 1 ] ]
//                }
//            }
//            myAjaxChart.series[0].update(seriesWeek);
//            myAjaxChart.redraw();
        });

        function generatechart(){

            var pblc = [];
            pblc['request'] = null;
            var prvt = [];
            prvt["data"] = {
                emailtype: $('#emailtype').val(),
                period: $('#period').val()
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url+"query/stats",
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                myAjaxChart.series[0].remove(true);
                var dataset=[];
                var clicks=0;
                $.each(data.statdata, function(k, v) {
                    clicks=parseInt(clicks)+parseInt(v.clicks);
//                    console.log(v.date);
//                    var d = new Date(v.date) ;
//                     console.log(d.getDay());
//                     console.log(d.getMonth());
//                     console.log(d.getYear());
//                    var dateObj = new Date(v.date);
//                    var month = dateObj.dayMonth() + 1; //months from 1-12
//                    console.log(month);
//                    var day = dateObj.getUTCDate();
//                    var year = dateObj.getUTCFullYear();
//                    var hr = dateObj.getUTCHours();
//                    var mn = dateObj.getUTCMinutes();

//                    newdate = year + "/" + month + "/" + day ;
//                    console.log(newdate);
                    dataset.push([moment(v.date, "YYYY/M/D H:mm:ss").valueOf(),clicks]);
//                    dataset.push([v.date,clicks]);
//                    dataset.push([Date.UTC(year, month, day,08,00),clicks]);
//                    dataset.push([(v.date).toISOString(),clicks]);
                });

                myAjaxChart.addSeries({
//                    pointInterval:  3600 * 1000,
                    name: 'Clicks',
                    data: dataset
                });
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {

            });

            pblc['request'].always(function( jqXHR, textStatus ) {
            });
        }


        $('input[name=grouping]').change(function() {
            //http://api.highcharts.com/highstock#plotOptions.series.dataGrouping.units
            var unit = $(this).val();
            console.log(unit);
            //http://api.highcharts.com/highstock#Series.update
            myAjaxChart.series.forEach(function(ser) {
                ser.update({
                    dataGrouping: {
                        units: [ [unit, [1]] ]
                    }
                }, false);
            });

            myAjaxChart.redraw();
        });

    });


</script>

<style>
    .graph-holder{
        background-color: white!important;
    }
    .myDiv3.fullscreen{
        z-index: 9999;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
    }

    .myDiv3{
        /*background:#cc0000;*/
        /*width:500px; height:400px;*/
    }
    .main {
        width: 400px;
        margin: 0 auto;
    }

    .chart {
        min-width: 300px;
        max-width: 800px;
        height: 300px;
        margin: 1em auto;
    }

    .modal {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.7);
    }
    .modal .chart {
        height: 90%;
    }
</style>
