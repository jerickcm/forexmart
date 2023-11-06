<?php echo $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<div class="fm-grp-section bg-page">
    <section>
        <div class="container">
            <h1 class="fm-page-title"><?=lang('cpy_mon_h1_tit')?></h1>
            <p><?=lang('cpy_mon_par1')?> </p><br>
            <p><?=lang('cpy_mon_par2')?></p>
        </div>
    </section>
    <section class="fm-section-container threechart-acct-01">
        <div class="container">
            <div class="row fm-data-container">
                <div class="col-md-6">
                    <a href="<?= FXPP::www_url('sub-monitoring/special-account/' . $acc1); ?>" class="btn-ribbon"><img src="<?= $this->template->Images() ?>ribbon-for-account-01.png"><span class="ribbon-number">01</span>
                     <span class="ribbon-label">
                            Project
                     </span>
                    </a>
                    <div class="fm-data-overlay">
                        <div class="chart_container" id="chart-acct-01"></div>
                        <a href="<?= FXPP::www_url('sub-monitoring/special-account/' . $acc1); ?>" class="btnlink-graph-zoom" target="_blank"><?=lang('cpy_mon_box_but5')?>  <i class="fa fa-search-plus"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_accnum')?> <strong class="fm-txt-strong"><?= $acc1; ?></strong></p></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_reg')?> <strong class="fm-txt-strong">Lithuania</strong></p></div>
                        <!--Berlin-->
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_bal')?> <strong class="fm-txt-strong"><span class="bal1">0</span> USD</strong></p></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_eqty')?> <strong class="fm-txt-strong"><span class="eqt1">0</span> USD</strong></p></div>
                    </div>
                </div>
                <div class="absolute-grpbtn-container grpbtn-right">
                    <?php if ($this->session->userdata('logged')) { ?>
                        <a href="#" class="btn-link-fm btn-link-copy sub-unsub" data-ma="<?php echo $acc1; ?>" data-btn="1"><i class="fa fa-files-o"></i>
                            <span id="copy1">
                                <?php echo $btn1; ?>
                            </span>
                        </a>
                        <?php
                    } else {
                        $msg = '<p>'.lang('cpy_mon_msg1').'<a href="' . FXPP::my_url('client/signin') . '" target="_blank">'.lang('cpy_mon_lnk').'</a></p>';
                        ?>
                        <a href="#" class="btn-link-fm btn-link-copy"  data-toggle="modal" data-target="#myModal" ><i class="fa fa-files-o"></i> <?php echo $btn1; ?> </a>
                    <?php } ?>

                    <a href="<?php echo FXPP::loc_url('register'); ?>" class="btn-link-fm btn-link-acct-blue"><?=lang('cpy_mon_box_but2')?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="fm-section-container threechart-acct-02">
        <div class="container">
            <div class="row fm-data-container">
                <div class="col-md-offset-6 col-md-6">
                    <a href="<?= FXPP::www_url('sub-monitoring/special-account/' . $acc2); ?>" class="btn-ribbon"><img src="<?= $this->template->Images() ?>ribbon-for-account-02.png"><span class="ribbon-number">02</span>
                        <span class="ribbon-label">
                            Project
                        </span>
                    </a>
                    <div class="fm-data-overlay">
                        <div class="chart_container" id="chart-acct-02"></div>
                        <a href="<?= FXPP::www_url('sub-monitoring/special-account/' . $acc2); ?>" class="btnlink-graph-zoom" target="_blank"><?=lang('cpy_mon_box_but5')?>  <i class="fa fa-search-plus"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_accnum')?> <strong class="fm-txt-strong"><?= $acc2; ?></strong></p></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_reg')?> <strong class="fm-txt-strong">Germany</strong></p></div>
                        <!--Malaysia-->
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_bal')?> <strong class="fm-txt-strong"><span class="bal2">0</span> USD</strong></p></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_eqty')?> <strong class="fm-txt-strong"><span class="eqt2">0</span> USD</strong></p></div>
                    </div>
                </div>
                <div class="absolute-grpbtn-container grpbtn-left">
                    <?php if ($this->session->userdata('logged')) { ?>
                        <a href="#" class="btn-link-fm btn-link-copy sub-unsub" data-ma="<?php echo $acc2; ?>" data-btn="2"><i class="fa fa-files-o"></i>
                            <span id="copy2">
                                <?php echo $btn2; ?>
                            </span>
                        </a>
                        <?php
                    } else {
                        $msg = '<p>'.lang('cpy_mon_msg1').'<a href="' . FXPP::my_url('client/signin') . '" target="_blank">'.lang('cpy_mon_lnk').'</a></p>';
                        ?>
                        <a href="#" class="btn-link-fm btn-link-copy"  data-toggle="modal" data-target="#myModal" ><i class="fa fa-files-o"></i> <?php echo $btn2; ?></a>
                    <?php } ?>
                    <a href="<?php echo FXPP::loc_url('register'); ?>" class="btn-link-fm btn-link-acct-red"><?=lang('cpy_mon_box_but2')?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="fm-section-container threechart-acct-03">
        <div class="container">
            <div class="row fm-data-container">
                <div class="col-md-6">
                    <a href="<?= FXPP::www_url('sub-monitoring/special-account/' . $acc3); ?>" class="btn-ribbon"><img src="<?= $this->template->Images() ?>ribbon-for-account-03.png"><span class="ribbon-number">03</span>
                        <span class="ribbon-label">
                            Project
                        </span>
                    </a>
                    <div class="fm-data-overlay">
                        <div class="chart_container" id="chart-acct-03"></div>
                        <a href="<?= FXPP::www_url('sub-monitoring/special-account/' . $acc3); ?>" class="btnlink-graph-zoom" target="_blank"><?=lang('cpy_mon_box_but5')?> <i class="fa fa-search-plus"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_accnum')?>  <strong class="fm-txt-strong"><?= $acc3; ?></strong></p></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_reg')?>  <strong class="fm-txt-strong">France</strong></p></div>
                        <!-- Germany-->
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_bal')?>  <strong class="fm-txt-strong"><span class="bal3">0</span> EUR</strong></p></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><p><?=lang('cpy_mon_box_eqty')?>  <strong class="fm-txt-strong"><span class="eqt3">0</span> EUR</strong></p></div>
                    </div>
                </div>
                <div class="absolute-grpbtn-container grpbtn-right">
                    <?php if ($this->session->userdata('logged')) { ?>
                        <a href="#" class="btn-link-fm btn-link-copy sub-unsub" data-ma="<?php echo $acc3; ?>" data-btn="3"><i class="fa fa-files-o"></i>
                            <span id="copy3">
                                <?php echo $btn3; ?>
                            </span>
                        </a>
                        <?php
                    } else {
                        $msg = '<p>'.lang('cpy_mon_msg1').'<a href="' . FXPP::my_url('client/signin') . '" target="_blank">'.lang('cpy_mon_lnk').'</a></p>';
                        ?>
                        <a href="#" class="btn-link-fm btn-link-copy"  data-toggle="modal" data-target="#myModal" ><i class="fa fa-files-o"></i> <?php echo $btn3; ?></a>
                    <?php } ?>

                    <a href="<?php echo FXPP::loc_url('register') ?>" class="btn-link-fm btn-link-acct-green"><?=lang('cpy_mon_box_but2')?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="sc-terms-condition">
        <div class="container">
            <h2 class="sc-subtitle"><a href="#" id="link-copytrade"><?=lang('cpy_mon_sc_tit')?></a></h2>
            <ol type="1" class="itemlist-terms" id="list-copytrade">
                <li><?=lang('cpy_mon_sec_li')?></li>
                <li><?=lang('cpy_mon_sec_li1')?></li>
                <li><?=lang('cpy_mon_sec_li2')?></li>
                <li><?=lang('cpy_mon_sec_li3')?></li>
                <li><?=lang('cpy_mon_sec_li4')?></li>
                <li><?=lang('cpy_mon_sec_li5')?></li>

            </ol>
        </div>

    </section>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=lang('cpy_mon_h1_tit')?></h4>
            </div>
            <div class="modal-body">
                <?php echo $msg ?>
                <p id="m_message">
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('cpy_mon_box_but4')?></button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var pblc = [];
    var prvt = [];
    var site_url = "<?= FXPP::ajax_url() ?>";
    var log_url = "<?php echo FXPP::my_url('client/signin'); ?>";
    $(document).on("click", ".sub-unsub", function () {
        $('#loader-holder').show();
        var btn = $(this).attr("data-btn");
        console.log(btn);
        prvt["data"] = {
            masteraccount: $(this).attr("data-ma"),
            request:  $.trim($("#copy" + btn).html()) // pass copy or unsubscribe in language
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'query/sub_unsubaccount',
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function (data) {
            if (data.err == true) {
                console.log('service unavailable');
                $('#m_message').html('<?=lang('cpy_mon_msg2')?>');
            } else if (data.err2 == true) {
                $('#m_message').html('<p><?=lang('cpy_mon_msg1')?> <a href="' + log_url + '" target="_blank"><?=lang('cpy_mon_lnk')?></a></p>');
            } else {
                if (data.is_copy == 0) {
                    console.log('unsubscribed');
                    $("#copy" + btn).html('<?=lang('cpy_mon_box_but1')?>');
                    $('#m_message').html('<?=lang('cpy_mon_accnum')?> <strong>' + data.account_number + '</strong> <?=lang('cpy_mon_msg3')?> <strong>' + data.masteraccount + '</strong>');
                } else if (data.is_copy == 1) {
                    console.log('subscribed');
                    $("#copy" + btn).html('<?=lang('cpy_mon_box_but3')?>');
                    $('#m_message').html('<?=lang('cpy_mon_accnum')?> <strong>' + data.account_number + '</strong> <?=lang('cpy_mon_subs')?> <strong>' + data.masteraccount + '</strong>');
                }else if(data.is_copy == 2){
                    $('#m_message').html('<?=lang('cpy_mon_msg5')?>');

                }
            }
            $('#myModal').modal('show');

            $('#loader-holder').hide();
        });

        pblc['request'].fail(function (jqXHR, textStatus) {
            $('#loader-holder').hide();
        });

        pblc['request'].always(function (jqXHR, textStatus) {
            $('#loader-holder').hide();
        });

    });

    var Chart1;
    var Chart2;
    var Chart3;

    Chart1 = new Highcharts.Chart({
        chart: {
            zoomType: 'x',
            renderTo: 'chart-acct-01',
            type: 'area'
        }, title: {
            text: '<?= lang('cpy_mon_accbal')?>'
        },
        subtitle: {
            text: document.ontouchstart === undefined ? '<?= lang('cpy_mon_chart_subhead1')?>' : '<?= lang('cpy_mon_chart_subhead2')?>'
        },
        xAxis: {
            type: 'datetime',
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
        },
        credits: {
            enabled: false
        },
        exporting:{
            enabled:false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    enabled: false
                },
                dataLabels: {
                    enabled: false
                }
            }
        },
        series: [{
            name: '<?= lang('cpy_mon_bal')?>',
            data: [
            ]
        }]

    });
    Chart2 = new Highcharts.Chart({
        chart: {
            zoomType: 'x',
            renderTo: 'chart-acct-02',
            type: 'area'
        }, title: {
            text: '<?= lang('cpy_mon_accbal')?>'
        },
        subtitle: {
            text: document.ontouchstart === undefined ? '<?= lang('cpy_mon_chart_subhead1')?>' : '<?= lang('cpy_mon_chart_subhead2')?>'
        },
        xAxis: {
            type: 'datetime',
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
        },
        credits: {
            enabled: false
        },
        exporting:{
            enabled:false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    enabled: false
                },
                dataLabels: {
                    enabled: false
                }
            }
        },
        series: [{
            name: '<?= lang('cpy_mon_bal')?>',
            data: [
            ]
        }]

    });
    Chart3 = new Highcharts.Chart({
        chart: {
            zoomType: 'x',
            renderTo: 'chart-acct-03',
            type: 'area'
        }, title: {
            text: '<?= lang('cpy_mon_accbal')?>'
        },
        subtitle: {
            text: document.ontouchstart === undefined ? '<?= lang('cpy_mon_chart_subhead1')?>' : '<?= lang('cpy_mon_chart_subhead2')?>'
        },
        xAxis: {
            type: 'datetime',
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
        },
        credits: {
            enabled: false
        },
        exporting:{
            enabled:false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    enabled: false
                },
                dataLabels: {
                    enabled: false
                }
            }
        },
        series: [{
            name: '<?= lang('cpy_mon_bal')?>',
            data: [
            ]
        }]

    });

    generatechart();
    function generatechart() {
        var pblc = [];
        pblc['request'] = null;
        var prvt = [];
        prvt["data"] = {
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + "query/live_accountmonitoring",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function (data) {
            Chart1.series[0].remove(true);
            Chart2.series[0].remove(true);
            Chart3.series[0].remove(true);
            var dataset = [];

            $.each(data.Balance1, function (k, v) {
                dataset.push([moment(v.x).valueOf(), v.y]);
            });

            Chart1.addSeries({
                name: '<?=lang('cpy_bal')?>',
                data: dataset
            });

            var dataset2 = [];
            $.each(data.Balance2, function (k, v) {
                dataset2.push([moment(v.x).valueOf(), v.y]);
            });
            Chart2.addSeries({
                name: '<?=lang('cpy_bal')?>',
                data: dataset2
            });

            var dataset3 = [];
            $.each(data.Balance3, function (k, v) {
                dataset3.push([moment(v.x).valueOf(), v.y]);
            });
            Chart3.addSeries({
                name: '<?=lang('cpy_bal')?>',
                data: dataset3
            });

            $(".bal1").html(data.Current_Balance1);
            $(".bal2").html(data.Current_Balance2);
            $(".bal3").html(data.Current_Balance3);

            $(".eqt1").html(data.Current_Equity1);
            $(".eqt2").html(data.Current_Equity2);
            $(".eqt3").html(data.Current_Equity3);

        });
        pblc['request'].fail(function (jqXHR, textStatus) {

        });

        pblc['request'].always(function (jqXHR, textStatus) {
        });
    }
    var x = 180; //.15 9sec .1 6sec
    var interval = 1000 * 60 * x; // where X is your every X minutes
    setInterval(generatechart, interval);
</script>
<script>
    $(document).ready(function () {
        $("#link-copytrade").click(function (e) {
            $("#list-copytrade").slideToggle();
            e.preventDefault();
        });
    });
</script>