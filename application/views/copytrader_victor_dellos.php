<?php echo $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

<section>
    <div class="container">
        <div class="traderprofile">
            <div class="trader-bg-header">
                <div class="bottom-overlay-bg">Viktor Dellos</div>
            </div>
            <div class="trader-profile-picture">
                <img src="<?= $this->template->Images();?>trading-user-img.png" alt="" />
            </div>
        </div>
        <div class="trader-short-desc">
            <h3>
<!--                Lorem ipsum dolor sit amet-->
            </h3>
            <p>
<!--                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.-->
            </p>
        </div>
    </div>
</section>
<section id="copytrader">
    <div class="container">
        <div>

            <div class="trader-accounts">
                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a data-toggle="pill" href="#accnt-01">Account-01</a></li>
                    <li><a data-toggle="pill" href="#accnt_02">Account-02</a></li>
                    <li><a data-toggle="pill" href="#accnt_03">Account-03</a></li>
                </ul>
                <div class="tab-content">
                    <div id="accnt-01" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="fm-data-overlay">
                                    <div id="accnt-graph-01" class="trader-account-graph"></div>
                                    <a href="<?= FXPP::www_url('copytrader_viktor_dellos/special-account/' . $acc1); ?>" class="btnlink-graph-zoom" target="_blank"> <?=lang('cpy_mon_box_but5')?> <i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="table-trader-info-wrapper">
                                    <table class="table table-trader-info">
                                        <tbody>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_accnum')?> </td>
                                            <td><?= $acc1; ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_bal')?></td>
                                            <td><span class="bal1">0</span> USD</td>
                                        </tr>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_reg')?></td>
                                            <td>Berlin</td>
                                        </tr>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_eqty')?></td>
                                            <td><span class="eqt1">0</span> USD</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row multi-button-wrapper">
                                        <div class="col-md-6 col-sm-6">
                                             <?php if ($this->session->userdata('logged')) { ?>
                                                    <button class="btn btn-s1-success sub-unsub" data-ma="<?php echo $acc1; ?>" data-btn="1">
                                                       <span id="copy1">
                                                            <?php echo $btn1; ?>
                                                        </span>
                                                    </button>
                                            <?php  } else {
                                                $msg = '<p>'.lang('cpy_mon_msg1').'<a href="' . FXPP::my_url('client/signin') . '" target="_blank">'.lang('cpy_mon_lnk').'</a></p>';
                                            ?>
                                                <button class="btn btn-s1-success" data-toggle="modal" data-target="#myModal"><?php echo $btn1; ?></button>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <button class="btn btn-s1-primary" onClick="javascript:window.location.href='<?php echo FXPP::loc_url('register'); ?>'"><?=lang('cpy_mon_box_but2')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accnt_02" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="fm-data-overlay">
                                    <div id="accnt-graph-02" class="trader-account-graph"></div>
                                    <a href="<?= FXPP::www_url('copytrader_viktor_dellos/special-account/' . $acc2); ?>" class="btnlink-graph-zoom" target="_blank"> <?=lang('cpy_mon_box_but5')?> <i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="table-trader-info-wrapper">
                                    <table class="table table-trader-info">
                                        <tbody>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_accnum')?> </td>
                                            <td><?= $acc2; ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_bal')?></td>
                                            <td><span class="bal2">0</span> USD</td>
                                        </tr>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_reg')?></td>
                                            <td>Berlin</td>
                                        </tr>
                                        <tr>
                                            <td> <?=lang('cpy_mon_box_eqty')?></td>
                                            <td><span class="eqt2">0</span> USD</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row multi-button-wrapper">
                                        <div class="col-md-6 col-sm-6">
                                            <?php if ($this->session->userdata('logged')) { ?>
                                            <button class="btn btn-s1-success sub-unsub" data-ma="<?php echo $acc2; ?>" data-btn="2">
                                                       <span id="copy2">
                                                            <?php echo $btn2; ?>
                                                        </span>
                                            </button>
                                            <?php  } else {
                                                $msg = '<p>'.lang('cpy_mon_msg1').'<a href="' . FXPP::my_url('client/signin') . '" target="_blank">'.lang('cpy_mon_lnk').'</a></p>';
                                            ?>
                                            <button class="btn btn-s1-success" data-toggle="modal" data-target="#myModal"><?php echo $btn2; ?></button>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <button class="btn btn-s1-primary" onClick="javascript:window.location.href='<?php echo FXPP::loc_url('register'); ?>'"><?=lang('cpy_mon_box_but2')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accnt_03" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="fm-data-overlay">
                                    <div id="accnt-graph-03" class="trader-account-graph"></div>
                                    <a href="<?= FXPP::www_url('copytrader_viktor_dellos/special-account/' . $acc3); ?>" class="btnlink-graph-zoom" target="_blank"> <?=lang('cpy_mon_box_but5')?> <i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="table-trader-info-wrapper">
                                    <table class="table table-trader-info">
                                        <tbody>
                                        <tr>
                                            <td><?=lang('cpy_mon_box_accnum')?> </td>
                                            <td><?= $acc3; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?=lang('cpy_mon_box_bal')?></td>
                                            <td><span class="bal3">0</span> USD</td>
                                        </tr>
                                        <tr>
                                            <td><?=lang('cpy_mon_box_reg')?></td>
                                            <td>Berlin</td>
                                        </tr>
                                        <tr>
                                            <td><?=lang('cpy_mon_box_eqty')?></td>
                                            <td><span class="eqt3">0</span> USD</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row multi-button-wrapper">
                                        <div class="col-md-6 col-sm-6">
                                            <?php if ($this->session->userdata('logged')) { ?>
                                                <button class="btn btn-s1-success sub-unsub" data-ma="<?php echo $acc3; ?>" data-btn="3">
                                                   <span id="copy3">
                                                        <?php echo $btn3; ?>
                                                   </span>
                                                </button>
                                            <?php  } else {
                                                $msg = '<p>'.lang('cpy_mon_msg1').'<a href="' . FXPP::my_url('client/signin') . '" target="_blank">'.lang('cpy_mon_lnk').'</a></p>';
                                            ?>
                                                <button class="btn btn-s1-success" data-toggle="modal" data-target="#myModal"><?php echo $btn3; ?></button>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <button class="btn btn-s1-primary" onClick="javascript:window.location.href='<?php echo FXPP::loc_url('register'); ?>'" ><?=lang('cpy_mon_box_but2')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<script>
    $(document).ready(function(){
        $("#link-copytrade").click(function(e){
            $("#list-copytrade").slideToggle();
            e.preventDefault();
        });
    });

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
            url: site_url + 'query/sub_unsubaccount_viktor',
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function (data) {
            if (data.err == true) {
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
                    $('#m_message').html('<?=lang('cpy_mon_accnum')?> <strong>' + data.account_number + '</strong> is subscribed to  <strong>' + data.masteraccount + '</strong>');
                }else if(data.is_copy == 2){
                    $('#m_message').html('You may only subscribe to one account.');

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
            renderTo: 'accnt-graph-01',
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
            renderTo: 'accnt-graph-02',
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
            renderTo: 'accnt-graph-03',
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
        prvt["data"] = {};
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + "query/live_accountmonitoring_viktor",
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
                name: 'Balance',
                data: dataset
            });

            var dataset2 = [];
            $.each(data.Balance2, function (k, v) {
                dataset2.push([moment(v.x).valueOf(), v.y]);
            });
            Chart2.addSeries({
                name: 'Balance',
                data: dataset2
            });

            var dataset3 = [];
            $.each(data.Balance3, function (k, v) {
                dataset3.push([moment(v.x).valueOf(), v.y]);
            });
            Chart3.addSeries({
                name: 'Balance',
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
