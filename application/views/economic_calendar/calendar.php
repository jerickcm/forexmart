<style>
    .select2-container .select2-choice{
        border-radius: 0px!important;
        height: 32px!important;
    }
    .select2-container ,.select2-choice  ,.select2-arrow{
        border-radius: 0px!important;
    }
    .select2-drop-active{
        border-width: medium 2px 2px!important;
    }
</style>

<link href="<?= $this->template->Css()?>flags16.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>flags32.css" rel="stylesheet">


<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">Economic Calendar</h1>
                <div class="calendar-holder">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="calendar-nav">
                                <ul role="tablist" class="queue-tab-list">
                                    <li role="presentation"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" id="t1">
                                            Yesterday
                                        </a></li>
                                    <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" id="t2">
                                            Today
                                        </a></li>
                                    <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" id="t3">
                                            Tomorrow
                                        </a></li>
                                    <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab" id="t4">
                                            This Week
                                        </a></li>
                                    <li role="presentation"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab" id="t5">
                                            Next Week
                                        </a></li>
                                    <li role="presentation"><a href="#"><i class="fa fa-calendar"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="dropdown calendar-drp">
                                <?= form_dropdown('GMT', $GMT, '', 'class=""'); ?>

                                <a class="drp-cur-time" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-clock-o"></i> Current Time: 01:32 (GMT - 5:00)
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li><a href="#">Sample</a></li>
                                    <li><a href="#">Sample</a></li>
                                    <li><a href="#">Sample</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="calendar-filter-holder">
                                <a class="calendar-filter" href="#" data-toggle="modal" data-target="#esFilter"><i class="fa fa-filter"></i> Filter</a>
                                <p>
                                    All data are streaming and updated automatically.
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="table-responsive">
                                <table id="t_yestesday" class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $yesterday ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!--
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Industrial Production</a> <a href="#"><img src="<?= $this->template->Images()?>/prelim-release.png" class="prelim-release"></a></td>
                                                <td>5%</td>
                                                <td>5.2</td>
                                                <td>4.8%</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/revised-release.png" class="revised-release"></a></td>
                                                <td>	0.00%	</td>	<td>	0.00%	</td>	<td>	0.10%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/speech.png" class="speech"></a></td>
                                               <td>	-2.40%	</td>	<td>	-2.30%	</td>	<td>	-1.20%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag us"></i> <span class="country-cur">USD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	1.10%	</td>	<td>	0.90%	</td>	<td>	1.00%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag gb"></i> <span class="country-cur">GBP</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	1.00%	</td>	<td>	1.00%	</td>	<td>	1.20%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag hk"></i> <span class="country-cur">HKD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	5.20%	</td>	<td>	6.20%	</td>	<td>	5.70%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ru"></i> <span class="country-cur">RUB</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	-0.40%	</td>	<td>	-0.20%	</td>	<td>	-0.10%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ca"></i> <span class="country-cur">CAD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	12.1	</td>	<td>	18.3	</td>	<td>	25	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag br"></i> <span class="country-cur">BRL</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                               <td>	33.3	</td>	<td>	42.1	</td>	<td>	47.6	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag nz"></i> <span class="country-cur">NZD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	0.30%	</td>	<td>	0.10%	</td>	<td>	0.20%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag cn"></i> <span class="country-cur">CNY</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	0.10%	</td>	<td>	0.20%	</td>	<td>	0.60%	</td>
                                            </tr>
-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <div class="table-responsive">
                                <table id="t_today" class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $today ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($yahoo as $item) { ?>
                                        <tr>
                                            <td><?= $item['value_1']?></td>
                                            <td><?= $item['content']?></td>
                                            <td><?= $item['value_4']?></td>
                                            <td><?= $item['value_5']?></td>
                                            <td><?= $item['value_6']?></td>
                                            <td><?= $item['value_7']?></td>
                                            <td><?= $item['value_8']?></td>

                                        </tr>
                                    <?php } ?>
                                    <!--
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/prelim-release.png" class="prelim-release"></a></td>
                                               <td>	-14.7	</td>	<td>	-0.5	</td>	<td>	-14.9	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/revised-release.png" class="revised-release"></a></td>
                                                <td>	77.60%	</td>	<td>	77.90%	</td>	<td>	78.00%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/speech.png" class="speech"></a></td>
                                                <td>	-0.40%	</td>	<td>	-0.10%	</td>	<td>	0.90%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag us"></i> <span class="country-cur">USD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	-0.30%	</td>	<td>		</td>	<td>	-0.30%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag gb"></i> <span class="country-cur">GBP</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                               <td>	0.10%	</td>	<td>	-0.20%	</td>	<td>	0.70%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag hk"></i> <span class="country-cur">HKD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td>	16.50%	</td>	<td>		</td>	<td>	10.90%	</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ru"></i> <span class="country-cur">RUB</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ca"></i> <span class="country-cur">CAD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <div class="table-responsive">
                                <table id="t_tomorrow" class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $tomorrow ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>

                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td colspan="7">No Records.</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            <div class="table-responsive">
                                <table id="t_thisweek" class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_week ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!--
                                            <tr>
                                                <td colspan="7">No Records.</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="ec-date">Thursday, August 27, 2015</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">No Records.</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="ec-date">Wednesday, August 26, 2015</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">No Records.</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="ec-date">Tuesday, August 25, 2015</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag us"></i> <span class="country-cur">USD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag gb"></i> <span class="country-cur">GBP</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag hk"></i> <span class="country-cur">HKD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ru"></i> <span class="country-cur">RUB</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ca"></i> <span class="country-cur">CAD</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/prelim-release.png" class="prelim-release"></a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/revised-release.png" class="revised-release"></a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/speech.png" class="speech"></a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="ec-date">Monday, August 24, 2015</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/prelim-release.png" class="prelim-release"></a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/revised-release.png" class="revised-release"></a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
                                            <tr>
                                                <td>01: 00</td>
                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                <td>
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>/speech.png" class="speech"></a></td>
                                                <td></td>
                                                <td>107.2</td>
                                                <td>107.2</td>
                                            </tr>
-->
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_tue ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_wed ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_thu ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_fri ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_sat ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $this_sun ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>




                        <div role="tabpanel" class="tab-pane" id="tab5">
                            <div class="table-responsive">
                                <table id="t_nextweek" class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_week ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_tue ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_wed ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_thu ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_fri ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_sat ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <table class="table table-stripped calendar-tab table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="ec-date">
                                            <?= $next_sun ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                        <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                        <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                        <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                        <th class="ec-actual"><?=lang('cal_14');?></th>
                                        <th class="ec-forecast"><?=lang('cal_15');?></th>
                                        <th class="ec-prev"><?=lang('cal_16');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="row" style="display:none;">
                        <div class="col-md-6">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="" class="number">Number of records shown per page</label>
                                    <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-default round-0">Go</button>
                            </form>
                        </div>
                        <div class="col-md-6 calendar-pagination">
                            <nav>
                                <ul class="pagination calendar-pagination">
                                    <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li class=""><a href="#">2</a></li>
                                    <li class=""><a href="#">3</a></li>
                                    <li class=""><a href="#">4</a></li>
                                    <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-legend-holder">
                                <h1 class="legend-title">Legend</h1>
                                <div class="legend1-holder">
                                    <ul>
                                        <li><span class="span"><img src="<?= $this->template->Images()?>/speech.png" class="speech-size"></span> Speech</li>
                                        <li><span class="span"><img src="<?= $this->template->Images()?>/prelim-release.png"></span> Preliminary Release</li>
                                        <li><span class="span"><img src="<?= $this->template->Images()?>/revised-release.png"></span> Revised Release</li>
                                    </ul>
                                </div>
                                <div class="legend1-holder legend2">
                                    <ul>
                                        <li>
                                                <span class="span1">
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                                        </div>
                                                    </div>
                                                </span>
                                            Low Volatility Expected
                                        </li>
                                        <li>
                                                <span class="span1">
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                                        </div>
                                                    </div>
                                                </span>
                                            Moderate Volatility Expected
                                        </li>
                                        <li>
                                                <span class="span1">
                                                    <div class="progress calendar-progress">
                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                                        </div>
                                                    </div>
                                                </span>
                                            High Volatility Expected
                                        </li>
                                    </ul>
                                </div><div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="event" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0 modal-lg">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">Sample Event</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="btnsocial-holder">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        <li class="social-right"><a href="#"><i class="fa fa-print"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="modal-event-content">
                        <div class="col-sm-3">
                            <div class="form-group latest-release-holder">
                                <label for="">Latest Release</label>
                                <p class="latest-release">Aug 25, 2015</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Actual</label>
                                <p class="actual">3.741B</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Forecast</label>
                                <p class="forecast">2.600B</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Previous</label>
                                <p class="previous">3.509B</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="modal-event-content">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <p class="event-modal-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-3 line-left">
                            <div class="form-group row">
                                <label class="col-sm-6" for="">Importance:</label>
                                <div class="col-sm-6">
                                    <div class="progress calendar-progress">
                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" for="">Country:</label>
                                <div class="col-sm-6">
                                    <p class="f16"><i class="flag ch"></i></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" for="">Currency:</label>
                                <div class="col-sm-6">
                                    <p class="">CHF</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" for="">Source:</label>
                                <div class="col-sm-6">
                                    <a href="#">Sample</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>Release Date</th>
                                    <th>Time</th>
                                    <th>Actual</th>
                                    <th>Forecast</th>
                                    <th>Previous</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aug, 24, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 23, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 22, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 21, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 20, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-5 calendar-pagination">
                        <nav>
                            <ul class="pagination calendar-pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer round-0">
                <button type="button" class="btn btn-primary round-0">Update</button>
            </div> -->
        </div>
    </div>
</div>
<div class="modal fade" id="esFilter" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0 modal-lg">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">Filter</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="row">
                    <div class="col-sm-2">
                        <label class="control-label">Country:</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox country-chk select-all">
                            <label class="">
                                <input type="checkbox"> Select All
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag al"></i> Albania
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag af"></i> Afghanistan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ar"></i> Argentina
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag aw"></i> Aruba
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag au"></i> Australia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag az"></i> Azerbaijan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bs"></i> Bahamas
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bb"></i> Barbados
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag by"></i> Belarus
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bz"></i> Belize
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bm"></i> Bermuda
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bo"></i> Bolivia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ba"></i> Bosnia and Herzegovina
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bw"></i> Botswana
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bg"></i> Bulgaria
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag br"></i> Brazil
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bn"></i> Brunei
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag kh"></i> Cambodia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ca"></i> Canada
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ky"></i> Cayman
                            </label>
                        </div>

                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag cl"></i> Chile
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag cn"></i> China
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag co"></i> Colombia
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag cr"></i> Costa Rica
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag hr"></i> Croatia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag cu"></i> Cuba
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag cs"></i> Czech Republic
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag dk"></i> Denmark
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag do"></i> Dominican Republic
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag none"></i> East Caribbean
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag eg"></i> Egypt
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sv"></i> El Salvador
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ee"></i> Estonia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag eu"></i> Euro Member
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag fk"></i> Falkland Islands
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag fj"></i> Fiji
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag gh"></i> Ghana
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag gi"></i> Gibraltar
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag gt"></i> Guatemala
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag gg"></i> Guernsey
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag gy"></i> Guyana
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag hn"></i> Honduras
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag hk"></i> Hong Kong
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag hu"></i> Hungary
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag is"></i> Iceland
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag in"></i> India
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag id"></i> Indonesia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ir"></i> Iran
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag im"></i> Isle of Man
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag il"></i> Israel
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag jm"></i> Jamaica
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag jp"></i> Japan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag je"></i> Jersey
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag kz"></i> Kazakhstan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag kp"></i> North Korea
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag kr"></i> South Korea
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag kg"></i> Kyrgyzstan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag la"></i> Laos
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag lv"></i> Latvia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag lb"></i> Lebanon
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag lr"></i> Liberia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag lt"></i> Lithuania
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag mk"></i> Macedonia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag my"></i> Malaysia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag mu"></i> Mauritius
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag mx"></i> Mexico
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag mn"></i> Mongolia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag mz"></i> Mozambique
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag na"></i> Namibia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag np"></i> Nepal
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag bq"></i> Netherlands
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag nz"></i> New Zealand
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ni"></i> Nicaragua
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ng"></i> Nigeria
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag no"></i> Norway
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag om"></i> Oman
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag pk"></i> Pakistan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag pa"></i> Panama
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag py"></i> Paraguay
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag pe"></i> Peru
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ph"></i> Philippines
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag pl"></i> Poland
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag qa"></i> Qatar
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ro"></i> Romania
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ru"></i> Russia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sh"></i> Saint Helena
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sa"></i> Saudi Arabia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag rs"></i> Serbia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sc"></i> Seychelles
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sg"></i> Singapore
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sb"></i> Solomon Islands
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag so"></i> Somalia
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag za"></i> South Africa
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2" >
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag lk"></i> Sri Lanka
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag se"></i> Sweden
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ch"></i> Switzerland
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sr"></i> Suriname
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag sy"></i> Syria
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag tw"></i> Taiwan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag th"></i> Thailand
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag tt"></i> Trinidad and Tobago
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag tr"></i> Turkey
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag tv"></i> Tuvalu
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ua"></i> Ukraine
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag gb"></i> United Kingdom
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag us"></i> United States
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag uy"></i> Uruguay
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag uz"></i> Uzbekistan
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ve"></i> Venezuela
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag vn"></i> Vietnam
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag ye"></i> Yemen
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="f16">
                                <input type="checkbox"> <i class="flag zw"></i> Zimbabwe
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row bordertop">
                    <div class="col-sm-2">
                        <label class="control-label">Time:</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="radio rbt-time">
                            <label>
                                <input type="radio" name="optionsRadios" id="" value="option1">
                                Display time remaining until announcement
                            </label>
                        </div>
                        <div class="radio rbt-time">
                            <label>
                                <input type="radio" name="optionsRadios" id="" value="option2">
                                Display time only
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row bordertop">
                    <div class="col-sm-2">
                        <label class="control-label">Category:</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox country-chk select-all">
                            <label class="">
                                <input type="checkbox"> Select All
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Employment
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Credit
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Balance
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Economic Activity
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Central Banks
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Bonds
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Inflation
                            </label>
                        </div>
                        <div class="checkbox country-chk">
                            <label class="">
                                <input type="checkbox"> Confidence Index
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row bordertop">
                    <div class="col-sm-2">
                        <label class="control-label">Importance:</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="imp">
                            <div class="checkbox country-chk">
                                <input type="checkbox">
                                <div class="progress calendar-progress">
                                    <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="imp">
                            <div class="checkbox country-chk">
                                <input type="checkbox">
                                <div class="progress calendar-progress">
                                    <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="imp">
                            <div class="checkbox country-chk">
                                <input type="checkbox">
                                <div class="progress calendar-progress">
                                    <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0">
                <button type="button" class="btn btn-primary round-0">Filter</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $('#t_yestesday').DataTable({responsive: true});
    $('#t_today').DataTable({responsive: true});
    $('#t_tomorrow').DataTable({responsive: true});
    $('#t_thisweek').DataTable({responsive: true});
    $('#t_nextweek').DataTable({responsive: true});


    $(window).load(function(){
        $("#t1").addClass("ec-active");
    });

    $( document ).ready(function() {
        $('select[name=GMT]').select2();
        var $t1 = $('#t1');
        var $t2 = $('#t2');
        var $t3 = $('#t3');
        var $t4 = $('#t4');
        var $t5 = $('#t5');

        var tabActive1 = [$t2, $t3, $t4, $t5];
        var tabActive2 = [$t1, $t3, $t4, $t5];
        var tabActive3 = [$t1, $t2, $t4, $t5];
        var tabActive4 = [$t1, $t2, $t3, $t5];
        var tabActive5 = [$t1, $t2, $t3, $t4];

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
    });
</script>