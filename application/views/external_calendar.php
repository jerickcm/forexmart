<?php if(IPLoc::Office()){?>
    <style>
        #tbl_calendarEvents tbody tr {
            height: 35px;
            border-bottom:1px solid #cecece;
        }
        #tbl_calendarEvents tbody tr th{
            text-align: center;
            border-bottom: 2px solid #cecece;
        }
        th, td{
            text-align: center!important;
        }
    </style>
<?php }?>

<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>calendar-view.css' type='text/css'  />"));
    });
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script type="text/javascript">
    $( document ).ready(function() {
        $("#filter_close").click(function(){
            $("#filter-alert").hide();
        });
    });

    $(window).load(function(){
        $("#t1").addClass("ec-active");
    });

    $( document ).ready(function() {

        var $t1 = $('#t1');
        var $t2 = $('#t2');
        var $t3 = $('#t3');
        var $t4 = $('#t4');
        var $t5 = $('#t5');
        var $t6 = $('#t6');

        var tabActive1 = [$t2, $t3, $t4, $t5, $t6];
        var tabActive2 = [$t1, $t3, $t4, $t5, $t6];
        var tabActive3 = [$t1, $t2, $t4, $t5, $t6];
        var tabActive4 = [$t1, $t2, $t3, $t5, $t6];
        var tabActive5 = [$t1, $t2, $t3, $t4, $t6];
        var tabActive6 = [$t1, $t2, $t3, $t4, $t5];

        $("#t1").click(function(){
            $("#t1").addClass("ec-active");
            $.each(tabActive1, function(){
                $(this).removeClass("ec-active");
            });
        });
        $("#t2").click(function(){
            $("#t2").addClass("ec-active");
            $.each(tabActive2, function(){
                $(this).removeClass("ec-active");
            });
        });
        $("#t3").click(function(){
            $("#t3").addClass("ec-active");
            $.each(tabActive3, function(){
                $(this).removeClass("ec-active");
            });
        });
        $("#t4").click(function(){
            $("#t4").addClass("ec-active");
            $.each(tabActive4, function(){
                $(this).removeClass("ec-active");
            });
        });
        $("#t5").click(function(){
            $("#t5").addClass("ec-active");
            $.each(tabActive5, function(){
                $(this).removeClass("ec-active");
            });
        });
        $("#t6").click(function(){
            $("#t6").addClass("ec-active");
            $.each(tabActive6, function(){
                $(this).removeClass("ec-active");
            });
        });


        // $( "#datetimepicker" ).datepicker({
        //     changeMonth: true,
        //     changeYear: true,
        //     dateFormat:'yy-mm-dd',
        //     yearRange: "-95:-18",
        //     minDate: '-95Y',
        //     maxDate: '-18Y'
        // });
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row no-margin-cls">
            <div class="cute">
                <h1 class="license-title"><?= lang('cal_00'); ?></h1>
                <div class="cal-desc">
                    <?= lang('cal_01'); ?>
                </div>
                <div class="calendar-holder">
                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                            <div class="calendar-nav">
                                <ul role="tablist" class="queue-tab-list">
                                    <li role="presentation" class="active" id="yesterday"><a  class="test" href="#tab1"  role="tab" data-toggle="tab" id="t1"><?= lang('cal_02'); ?></a></li>
                                    <li role="presentation" id="today"><a href="#tab2" class="test"  role="tab" data-toggle="tab" id="t2"><?= lang('cal_03'); ?></a></li>
                                    <li role="presentation" id="tomorrow"><a href="#tab3" class="test"  role="tab" data-toggle="tab" id="t3"><?= lang('cal_04'); ?></a></li>
                                    <li role="presentation" id="this_week"><a href="#tab4"  class="test"  role="tab" data-toggle="tab" id="t4"><?= lang('cal_05'); ?></a></li>
                                    <li role="presentation" id="next_week"><a href="#tab5" class="test"  role="tab" data-toggle="tab" id="t5"><?= lang('cal_06'); ?></a></li>
                                    <li role="presentation" id="datetimepicker"><a  role="tab" data-toggle="tab" id="t6" data-date-format="YYYY-MM-DD" href="#" class="datepicker"><i class="fa fa-calendar"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="dropdown calendar-drp">
                                <input type="hidden" value="" id="gmt-time"/>
                                <a class="drp-cur-time" id="dLabel"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: 800;">
                                    <i class="fa fa-clock-o"></i> <span id="gmt-timezone"> GMT: +<?php echo $currentGMTFilter; ?></span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu drp-zone mg-l" aria-labelledby="dLabel">
                                    <li id="-12" <?php echo ( isset( $currentGMTFilter ) && -12 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-12</li>
                                    <li id="-11" <?php echo ( isset( $currentGMTFilter ) && -11 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-11</li>
                                    <li id="-10" <?php echo ( isset( $currentGMTFilter ) && -10 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-10</li>
                                    <li id="-9" <?php echo ( isset( $currentGMTFilter ) && -9 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-9</li>
                                    <li id="-8" <?php echo ( isset( $currentGMTFilter ) && -8 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-8</li>
                                    <li id="-7" <?php echo ( isset( $currentGMTFilter ) && -7 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-7</li>
                                    <li id="-6" <?php echo ( isset( $currentGMTFilter ) && -6 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-6</li>
                                    <li id="-5" <?php echo ( isset( $currentGMTFilter ) && -5 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-5</li>
                                    <li id="-4" <?php echo ( isset( $currentGMTFilter ) && -4 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-4</li>
                                    <li id="-3" <?php echo ( isset( $currentGMTFilter ) && -3 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-3</li>
                                    <li id="-2" <?php echo ( isset( $currentGMTFilter ) && -2 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-2</li>
                                    <li id="-1" <?php echo ( isset( $currentGMTFilter ) && -1 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:-1</li>
                                    <li id="0" <?php echo ( isset( $currentGMTFilter ) && 0 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:0</li>
                                    <li id="1" <?php echo ( isset( $currentGMTFilter ) && 1 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+1</li>
                                    <li id="2" <?php echo ( isset( $currentGMTFilter ) && 2 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+2</li>
                                    <li id="3" <?php echo ( isset( $currentGMTFilter ) && 3 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+3</li>
                                    <li id="4" <?php echo ( isset( $currentGMTFilter ) && 4 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+4</li>
                                    <li id="5" <?php echo ( isset( $currentGMTFilter ) && 5 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+5</li>
                                    <li id="6" <?php echo ( isset( $currentGMTFilter ) && 6 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+6</li>
                                    <li id="7" <?php echo ( isset( $currentGMTFilter ) && 7 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+7</li>
                                    <li id="8" <?php echo ( isset( $currentGMTFilter ) && 8 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+8</li>
                                    <li id="9" <?php echo ( isset( $currentGMTFilter ) && 9 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+9</li>
                                    <li id="10" <?php echo ( isset( $currentGMTFilter ) && 10 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+10</li>
                                    <li id="11" <?php echo ( isset( $currentGMTFilter ) && 11 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+11</li>
                                    <li id="12" <?php echo ( isset( $currentGMTFilter ) && 12 == $currentGMTFilter ? "class='selected'" : "" ); ?>>GMT:+12</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-5 calendar-mobile-width">
                            <div class="calendar-filter-holder">
                                <a class="calendar-filter" href="#" data-toggle="modal" data-target="#esFilter"><i class="fa fa-filter"></i> <?= lang('cal_07'); ?></a>
                                <p>
                                    <?= lang('cal_08'); ?>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="table-responsive" id="calendarList-holder">
                                <?php echo $calendarData;?>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 cal-no-pad">
                            <div class="main-legend-holder">
                                <div class="legend1-holder">
                                    <h1 class="legend-title"><?= lang('cal_09'); ?></h1>
                                    <ul>
                                        <li><span class="span"><img src="<?= $this->template->Images()?>speech.png" class="speech-size" alt="" /></span> <?= lang('cal_leg1'); ?></li>
                                        <li><span class="span"><img src="<?= $this->template->Images()?>prelim-release.png" alt="" /></span> <?= lang('cal_leg2'); ?></li>
                                        <li><span class="span"><img src="<?= $this->template->Images()?>revised-release.png" alt="" /></span> <?= lang('cal_leg3'); ?></li>
                                    </ul>
                                </div>
                                <div class="legend1-holder legend2">
                                    <ul>
                                        <li>
                                                <div class="span1">
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            <span class="span2"><?= lang('cal_imp1'); ?></span>
                                        </li>
                                        <li>
                                                <div class="span1">
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            <span class="span2"><?= lang('cal_imp2'); ?></span>
                                        </li>
                                        <li>
                                                <div class="span1">
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            <span class="span2"><?= lang('cal_imp3'); ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="event" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="0">
    <div class="modal-dialog round-0 modal-lg">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title" id="event-title">Event title</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="row">
                    <div class="modal-event-content">
                        <div class="col-sm-3">
                            <div class="form-group latest-release-holder">
                                <label ><?= lang('cal_13'); ?></label>
                                <p class="latest-release" id="event-latest-release"></p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label ><?= lang('cal_14'); ?></label>
                                <p class="" id="event-actual"></p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label ><?= lang('cal_15'); ?></label>
                                <p class="forecast" id="event-forecast"></p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label ><?= lang('cal_16'); ?></label>
                                <p class="previous" id="event-previous"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="modal-event-content">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <p class="event-modal-text" id="event-description">
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-3 line-left">
                            <div class="form-group row">
                                <label class="col-sm-6" ><?= lang('cal_imp0'); ?></label>
                                <div class="col-sm-6">
                                    <div class="progress calendar-progress">
                                        <div class="progress-bar " id="event-importance" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" ><?= lang('cal_cnt_00'); ?></label>
                                <div class="col-sm-6">
                                    <p class="f32"><i id="event-flag"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="esFilter" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="0">
    <div class="modal-dialog round-0 modal-lg">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="filter_close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title"><?= lang('cal_07'); ?></h4>
            </div>
            <div class="modal-body modal-show-body" id="modal_body">
                <div class="row no-margin-cls">
                    <div class="col-sm-2">
                        <label class="control-label"><?= lang('cal_cnt_00'); ?></label>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="au"> <span class="flag-label"><i class="flag au"></i><?= lang('cal_cnt_01'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="be"> <span class="flag-label"><i class="flag be"></i><?= lang('cal_cnt_02'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="ca"> <span class="flag-label"><i class="flag ca"></i><?= lang('cal_cnt_03'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="cn"> <span class="flag-label"><i class="flag cn"></i><?= lang('cal_cnt_04'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="eu"> <span class="flag-label"><i class="flag eu"></i><?= lang('cal_cnt_05'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="fr"> <span class="flag-label"><i class="flag fr"></i><?= lang('cal_cnt_06'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="ge"> <span class="flag-label"><i class="flag ge"></i><?= lang('cal_cnt_07'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="gr"> <span class="flag-label"><i class="flag gr"></i><?= lang('cal_cnt_08'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2" id="div-flag-3">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="it"> <span class="flag-label"><i class="flag it"></i><?= lang('cal_cnt_09'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="jp"> <span class="flag-label"><i class="flag jp"></i><?= lang('cal_cnt_10'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="mx"> <span class="flag-label"><i class="flag mx"></i><?= lang('cal_cnt_11'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="nz"> <span class="flag-label"><i class="flag nz"></i><?= lang('cal_cnt_12'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-offset-2 col-sm-3 col-md-2 col-md-offset-0 col-lg-2" id="div-flag-4">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="ru"> <span class="flag-label"><i class="flag ru"></i><?= lang('cal_cnt_13'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="es"> <span class="flag-label"><i class="flag es"></i><?= lang('cal_cnt_14'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="se"> <span class="flag-label"><i class="flag se"></i><?= lang('cal_cnt_15'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="ch"> <span class="flag-label"><i class="flag ch"></i><?= lang('cal_cnt_16'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2" id="div-flag-5">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="uk"> <span class="flag-label ru-lang-cal"><i class="flag gb"></i><?= lang('cal_cnt_17'); ?></span>
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox" name="country" value="us"> <span class="flag-label"><i class="flag us"></i><?= lang('cal_cnt_18'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row bordertop no-margin-cls">
                    <div class="col-sm-2">
                        <label class="control-label"><?= lang('cal_imp0'); ?></label>
                    </div>
                    <div class="col-sm-10">
                        <div class="col-xs-12 col-sm-12">
                            <div class="imp" style="float: left;">
                                <div class="checkbox country-chk">
                                    <input type="checkbox" name="importance" value="Low">
                                    <div class="progress calendar-progress">
                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <span class="span2t"><?= lang('cal_imp1'); ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="imp" style="float: left;">
                                <div class="checkbox country-chk">
                                    <input type="checkbox" name="importance" value="Medium">
                                    <div class="progress calendar-progress">
                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="span2t"> <?= lang('cal_imp2'); ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="imp" style="float: left;">
                                <div class="checkbox country-chk">
                                    <input type="checkbox" name="importance" value="High">
                                    <div class="progress calendar-progress">
                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="span2t"><?= lang('cal_imp3'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0">
                <div class="alert alert-danger" role="alert" id="filter-alert" style="display: none; width: 100%; text-align: center;">
                    <?= lang('cal_17'); ?>
                </div>
                <button type="button" id="filter-calendar" class="btn btn-primary round-0"><?= lang('cal_07'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php /** Preloader Modal Start */ ?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<?php
$data['log']=array(
    'ip'=>$_SERVER['REMOTE_ADDR'],
    'referrer'=>$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
    'date' => date("Y-m-d H:i:s")
);
$this->general_model->insertmy($table="team_page_logs",$data['log']);
?>