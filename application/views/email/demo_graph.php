<script src="<?= $this->template->Js()?>Moment.js"></script>
<script src="<?= $this->template->Js()?>html2canvas.js"></script>
<script src="<?= $this->template->Js()?>jquery.plugin.html2canvas.js"></script>
<script type="text/javascript" src="https://gabelerner.github.io/canvg/rgbcolor.js"></script>
<script type="text/javascript" src="https://gabelerner.github.io/canvg/StackBlur.js"></script>
<script type="text/javascript" src="https://gabelerner.github.io/canvg/canvg.js"></script>
<?php
$color="'#a349a4','#3f48cc','#00a2e8','#22b14c','#fff200','#ff7f27','#ed1c24','#880015','#7f7f7f','#000000'";
$colorAraay=explode(",",$color);
?>
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
<div class="container">
<div class="row">
<div class="main-dashboard-holder">
    <div class="row">
        <div class="col-md-6" id="real-target">
            <div class="main-chart-holder">
                <div class="chart-header">
                    <div class="chart-title">
                        <h1><i class="fa fa-sign-in"></i>Real Accounts from Top 10 Countries </h1>

                    </div>
                    <div class="chart-action-holder">
                        <a class="cursord" id="dr10_graph"  title="Expand widget" ><i class="fa fa-expand"></i></a>
                        <input type="hidden" class="expend dr10_graph" name="dr10_graph" value="0"/>
                    </div><div class="clearfix"></div>
                </div>

                <div class="chart-holder" id="containerReal">



                </div>
                <?php
                //FXPP-1374  Implement logic of putting the total number of users in the countries displayed in the charts of Demo and Real Accounts in FXPP
                $tuser = 0;
                $data['count']= 0;
                $data['count_users']= '';
                $data['count_perc']= '';

                foreach($dataReal as $key) {
                    $tuser += $key->totalId;
                    $data['count_users'][$data['count']] = $key->totalId;
                    $data['count_perc'][$data['count']] = $key->persen;
                    $data['count']=$data['count']+1;
                }


                ?>


                <div class="chart-footer">
                    <h1>Opened account in the last <?=$seleDrp[2]?> days</h1>
                    <div class="chart-legend" style=" width: 100%;">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width:10px;"> 1.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #a349a4" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?= $realArrayCountry[0]." (".$data['count_users'][0].") ". $data['count_perc'][0]; ?>
                                </td>
                                <td style="width:10px;"> 6.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #3f48cc" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[5]." (".$data['count_users'][5].") ". $data['count_perc'][5];?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10px;"> 2.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #00a2e8" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[1] ." (".$data['count_users'][1].") ". $data['count_perc'][1];?>
                                </td>
                                <td style="width:10px;"> 7.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #22b14c" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[6] ." (".$data['count_users'][6].") ". $data['count_perc'][6];?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10px;"> 3.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #fff200" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[2]." (".$data['count_users'][2].") ". $data['count_perc'][2];?>
                                </td>
                                <td style="width:10px;"> 8.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #ff7f27" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[7]." (".$data['count_users'][7].") ". $data['count_perc'][7];?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10px;"> 4.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #ed1c24" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[3] ." (".$data['count_users'][3].") ". $data['count_perc'][3];?>
                                </td>
                                <td style="width:10px;"> 9.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #880015" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[8]." (".$data['count_users'][8].") ". $data['count_perc'][8];?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10px;"> 5.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #7f7f7f" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[4]." (".$data['count_users'][4].") ". $data['count_perc'][4];?>
                                </td>
                                <td style="width:10px;"> 10.</td>
                                <td class="boxl"><div class="boxborder"><div style="background: #000000" class="countryColor"></div></div></td>
                                <td class="boxname">
                                    <?=$realArrayCountry[9]." (".$data['count_users'][9].") ". $data['count_perc'][9];?>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="adjust1374  chart-period">

                        <div class="form-group chart-fg">
                            <label for="" class="chart-lbl">Period</label>
                            <select class="chart-option" name="rd10limit" onchange="dyaChange()">
                                <option value="180" <?=($seleDrp[2]==180)?'selected':''?>>180 days</option>
                                <option value="360" <?=($seleDrp[2]==360)?'selected':''?>>360 days</option>
                                <option value="540" <?=($seleDrp[2]==540)?'selected':''?>>540 days</option>
                            </select>
                            Total Account: <span><?=$tuser;?></span>
                        </div>
                    </div><div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="demo-target">
        <div class="main-chart-holder">
            <div class="chart-header">
                <div class="chart-title">
                    <h1><i class="fa fa-sign-in"></i>Demo Accounts from Top 10 Countries </h1>

                </div>
                <div class="chart-action-holder">
                    <a class="cursord" id="dr10d_graph"  title="Expand widget" ><i class="fa fa-expand"></i></a>
                    <input type="hidden" class="expend dr10d_graph" name="dr10d_graph" value="<?=($dr10d_graph)==1?$dr10d_graph:'0';?>"/>
                </div><div class="clearfix"></div>
            </div>

            <div class="chart-holder" id="containerDemoPart">



            </div>

            <?php

            $tuser = 0;
            $data['count']= 0;
            $data['count_users']= '';
            $data['count_perc']= '';

            foreach($dataDemo as $key) {
                $tuser += $key->totalId;
                $data['count_users'][$data['count']] = $key->totalId;
                $data['count_perc'][$data['count']] = $key->persen;
                $data['count']=$data['count']+1;
            }

            ?>


            <div class="chart-footer">
                <h1>Opened account in the last <?=$seleDrp[3]?> days</h1>
                <div class="chart-legend" style=" width: 100%;">
                    <table>
                        <tbody>
                        <tr>
                            <td style="width:10px;"> 1.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #a349a4" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[0]." (".$data['count_users'][0].") ". $data['count_perc'][0]; ?>
                            </td>
                            <td style="width:10px;"> 6.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #3f48cc" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[5]." (".$data['count_users'][5].") ". $data['count_perc'][5]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10px;"> 2.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #00a2e8" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[1]." (".$data['count_users'][1].") ". $data['count_perc'][2]; ?>
                            </td>
                            <td style="width:10px;"> 7.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #22b14c" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[6]." (".$data['count_users'][6].") ". $data['count_perc'][6]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10px;"> 3.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #fff200" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[2]." (".$data['count_users'][2].") ". $data['count_perc'][2]; ?>
                            </td>
                            <td style="width:10px;"> 8.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #ff7f27" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[7]." (".$data['count_users'][7].") ". $data['count_perc'][7]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10px;"> 4.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #ed1c24" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[3]." (".$data['count_users'][3].") ". $data['count_perc'][3]; ?>
                            </td>
                            <td style="width:10px;"> 9.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #880015" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[8]." (".$data['count_users'][8].") ". $data['count_perc'][8]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10px;"> 5.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #7f7f7f" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[4]." (".$data['count_users'][4].") ". $data['count_perc'][4]; ?>
                            </td>
                            <td style="width:10px;"> 10.</td>
                            <td class="boxl"><div class="boxborder"><div style="background: #000000" class="countryColor"></div></div></td>
                            <td class="boxname">
                                <?=$demoArrayCountry[9]." (".$data['count_users'][9].") ". $data['count_perc'][9]; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="adjust1374 chart-period">

                    <div class="form-group chart-fg">
                        <label for="" class="chart-lbl">Period</label>
                        <select class="chart-option" name="rd10dlimit" onchange="dyaChange()">
                            <option value="180" <?=($seleDrp[3]==180)?'selected':''?>>180 days</option>
                            <option value="360" <?=($seleDrp[3]==360)?'selected':''?>>360 days</option>
                            <option value="540" <?=($seleDrp[3]==540)?'selected':''?>>540 days</option>
                        </select>
                        Total Account: <span><?=$tuser;?></span>
                    </div>

                </div><div class="clearfix"></div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
<form method="POST" enctype="multipart/form-data" action="<?php echo FXPP::custom_url('cron/saveGraphImage') ?>" id="demoGraphForm">
    <input type="hidden" name="img_val" id="img_demo_val" value="" />
    <input type="hidden" name="type" value="0" />
</form>
<form method="POST" enctype="multipart/form-data" action="<?php echo FXPP::custom_url('cron/saveGraphImage') ?>" id="realGraphForm">
    <input type="hidden" name="img_val" id="img_real_val" value="" />
    <input type="hidden" name="type" value="1" />
</form>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
    $(function () {

        $('#containerReal').highcharts({
            chart: {
                type: 'spline',
                events: {
                    load: function(event) {
                        var nodesToRecover = [];
                        var nodesToRemove = [];

                        var svgElem = $('#containerReal').find('svg');

                        svgElem.each(function(index, node) {
                            var parentNode = node.parentNode;
                            var svg = parentNode.innerHTML;

                            var canvas = document.createElement('canvas');

                            canvg(canvas, svg);

                            nodesToRecover.push({
                                parent: parentNode,
                                child: node
                            });
                            parentNode.removeChild(node);

                            nodesToRemove.push({
                                parent: parentNode,
                                child: canvas
                            });

                            parentNode.appendChild(canvas);
                        });
//                        console.log('test')

                        $('#real-target').html2canvas({
                            onrendered: function (canvas) {
                                //Set hidden field's value to image data (base-64 string)
                                var base_url = '<?= FXPP::custom_url() ?>';
                                $('#img_real_val').val(canvas.toDataURL("image/png"));
                                //Submit the form manually
//                                document.getElementById("myForm").submit();
                                jQuery.ajax({
                                    type: "POST",
                                    url: base_url + "cron/saveGraphImage",
                                    data: jQuery('#realGraphForm').serialize()
                                });
                            }
                        });
                    }
                }
            },
            title: {
                text: 'Top 10 Countries Graph'
            } ,
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
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f} '
//            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },

            series: [
                <?php $f=0;$j=1;$max=sizeof($realArray10); foreach($realArray10 as $index=>$val){?>
                {
                    animation: false,
                    name: <?="'.$index.'"?>,
                    color:<?=$colorAraay[$f]?>,
                    data: [
                        <?php $i=0; foreach($val as $key){ $i+=$key->val;?>
                        [moment(<?="'".$key->dates."'"?>).valueOf(), <?=$i;?>],
                        <?php } ?>
                    ]

                }
                <?php if($max!=$j){echo ",";} $f++; $j++; }  ?>



            ]
        });

        $('#containerDemoPart').highcharts({
            chart: {
                type: 'spline',
                events: {
                    load: function(event) {
                        var nodesToRecover = [];
                        var nodesToRemove = [];

                        var svgElem = $('#containerDemoPart').find('svg');

                        svgElem.each(function(index, node) {
                            var parentNode = node.parentNode;
                            var svg = parentNode.innerHTML;

                            var canvas = document.createElement('canvas');

                            canvg(canvas, svg);

                            nodesToRecover.push({
                                parent: parentNode,
                                child: node
                            });
                            parentNode.removeChild(node);

                            nodesToRemove.push({
                                parent: parentNode,
                                child: canvas
                            });

                            parentNode.appendChild(canvas);
                        });
//                        console.log('test')

                        $('#demo-target').html2canvas({
                            onrendered: function (canvas) {
                                //Set hidden field's value to image data (base-64 string)
                                var base_url = '<?= FXPP::custom_url() ?>';
                                $('#img_demo_val').val(canvas.toDataURL("image/png"));
                                //Submit the form manually
//                                document.getElementById("myForm").submit();
                                jQuery.ajax({
                                    type: "POST",
                                    url: base_url + "cron/saveGraphImage",
                                    data: jQuery('#demoGraphForm').serialize()
                                });
                            }
                        });
                    }
                }
            },
            title: {
                text: 'Top 10 Countries Graph'
            } ,
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
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f} '
//            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },

            series: [
                <?php $f=0;$j=1;$max=sizeof($demoArray10); foreach($demoArray10 as $index=>$val){?>
                {
                    animation: false,
                    name: <?="'.$index.'"?>,
                    color:<?=$colorAraay[$f]?>,
                    data: [
                        <?php $i=0; foreach($val as $key){ $i+=$key->val;?>

//                console.log(<?php //echo $key->dates; ?>//);
                        [moment(<?="'".$key->dates."'"?>).valueOf(), <?=$i;?>],
                        <?php } ?>
                    ]

                }
                <?php if($max!=$j){echo ",";} $f++; $j++; }  ?>



            ]
        });
    });


//    $('#demo-target').html2canvas({
//        onrendered: function (canvas) {
//            //Set hidden field's value to image data (base-64 string)
//            $('#img_val').val(canvas.toDataURL("image/png"));
//            //Submit the form manually
//            document.getElementById("myForm").submit();
//        }
//    });
</script>