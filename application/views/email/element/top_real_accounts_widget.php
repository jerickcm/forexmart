<div class="col-md-12 col-dashboard" id="top_real_accounts_graph_<?php echo $days ?>">
    <div class="main-chart-holder">
        <div class="chart-header">
            <div class="chart-title">
                <h1><i class="fa fa-sign-in"></i>Real Accounts from Top 10 Countries</h1>
            </div>
            <div class="chart-action-holder">
                <a href="#" class="cursord" id="top_real_expand" title="Expand Widget" ><i class="fa fa-expand"></i></a>
                <input type="hidden" class="expend dr_graph" name="top_real_graph" id="top_real_accounts_expand" value="0"/>
            </div><div class="clearfix"></div>
        </div>
        <div class="chart-holder" id="top_real_account_graph">
        </div>
        <div class="chart-footer">
            <h1>Opened account in the last <span id="lbl_top_real_period"><?php echo $days ?></span> days</h1>
            <div class="chart-legendX" style=" width: 100%;">
                <table class="table-chart">
                    <tbody id="top_demo_legend">
                    <?php if(count($top_country) > 0){ ?>
                        <tr>
                            <td class="box-num"> 1.</td>
                            <td class="box-color"><div class="boxborder"><div style="background: #a349a4" class="countryColor"></div></div></td>
                            <td class="boxname"><?php echo $top_country[0]['name'] . ' (' . $top_country[0]['count'] . ') ' . number_format(($top_country[0]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php if(count($top_country) > 5){ ?>
                                <td class="box-num"> 6.</td>
                                <td class="box-color"><div class="boxborder"><div style="background: #3f48cc" class="countryColor"></div></div></td>
                                <td class="boxname"><?php echo $top_country[5]['name'] . ' (' . $top_country[5]['count'] . ') ' . number_format(($top_country[5]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php }else{ ?>
                                <td></td><td></td><td></td>
                            <?php } ?>
                        </tr>
                    <?php }else{ ?>
                        <tr><td></td><td></td><td></td></tr>
                    <?php } ?>
                    <?php if(count($top_country) > 1){ ?>
                        <tr>
                            <td class="box-num"> 2.</td>
                            <td class="box-color"><div class="boxborder"><div style="background: #00a2e8" class="countryColor"></div></div></td>
                            <td class="boxname"><?php echo $top_country[1]['name'] . ' (' . $top_country[1]['count'] . ') ' . number_format(($top_country[1]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php if(count($top_country) > 6){ ?>
                                <td class="box-num"> 7.</td>
                                <td class="box-color"><div class="boxborder"><div style="background: #22b14c" class="countryColor"></div></div></td>
                                <td class="boxname"><?php echo $top_country[6]['name'] . ' (' . $top_country[6]['count'] . ') ' . number_format(($top_country[6]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php }else{ ?>
                                <td></td><td></td><td></td>
                            <?php } ?>
                        </tr>
                    <?php }else{ ?>
                        <tr><td></td><td></td><td></td></tr>
                    <?php } ?>
                    <?php if(count($top_country) > 2){ ?>
                        <tr>
                            <td class="box-num"> 3.</td>
                            <td class="box-color"><div class="boxborder"><div style="background: #fff200" class="countryColor"></div></div></td>
                            <td class="boxname"><?php echo $top_country[2]['name'] . ' (' . $top_country[2]['count'] . ') ' . number_format(($top_country[2]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php if(count($top_country) > 7){ ?>
                                <td class="box-num"> 8.</td>
                                <td class="box-color"><div class="boxborder"><div style="background: #ff7f27" class="countryColor"></div></div></td>
                                <td class="boxname"><?php echo $top_country[7]['name'] . ' (' . $top_country[7]['count'] . ') ' . number_format(($top_country[7]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php }else{ ?>
                                <td></td><td></td><td></td>
                            <?php } ?>
                        </tr>
                    <?php }else{ ?>
                        <tr><td></td><td></td><td></td></tr>
                    <?php } ?>
                    <?php if(count($top_country) > 3){ ?>
                        <tr>
                            <td class="box-num"> 4.</td>
                            <td class="box-color"><div class="boxborder"><div style="background: #ed1c24" class="countryColor"></div></div></td>
                            <td class="boxname"><?php echo $top_country[3]['name'] . ' (' . $top_country[3]['count'] . ') ' . number_format(($top_country[3]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php if(count($top_country) > 8){ ?>
                                <td class="box-num"> 9.</td>
                                <td class="box-color"><div class="boxborder"><div style="background: #880015" class="countryColor"></div></div></td>
                                <td class="boxname"><?php echo $top_country[8]['name'] . ' (' . $top_country[8]['count'] . ') ' . number_format(($top_country[8]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php }else{ ?>
                                <td></td><td></td><td></td>
                            <?php } ?>
                        </tr>
                    <?php }else{ ?>
                        <tr><td></td><td></td><td></td></tr>
                    <?php } ?>
                    <?php if(count($top_country) > 4){ ?>
                        <tr>
                            <td class="box-num"> 5.</td>
                            <td class="box-color"><div class="boxborder"><div style="background: #7f7f7f" class="countryColor"></div></div></td>
                            <td class="boxname"><?php echo $top_country[4]['name'] . ' (' . $top_country[4]['count'] . ') ' . number_format(($top_country[4]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php if(count($top_country) > 9){ ?>
                                <td class="box-num"> 10.</td>
                                <td class="box-color"><div class="boxborder"><div style="background: #000000" class="countryColor"></div></div></td>
                                <td class="boxname"><?php echo $top_country[9]['name'] . ' (' . $top_country[9]['count'] . ') ' . number_format(($top_country[9]['count'] / $total_country_count) * 100, 2) . '%' ?></td>
                            <?php }else{ ?>
                                <td></td><td></td><td></td>
                            <?php } ?>
                        </tr>
                    <?php }else{ ?>
                        <tr><td></td><td></td><td></td></tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
            <div class="filter-top-countries">
                <div class="form-group chart-fg">
                    <label for="" class="chart-lbl">Cumulative</label>
                    <select class="chart-option" name="top_real_accounts" id="top_real_cumulative_<?php echo $days ?>">
                        <option value="1">YES</option>
                        <option selected value="0">NO</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <label for="" class="chart-lbl">Period</label>
                    <select class="chart-option" name="top_reallimit" id="top_real_period_<?php echo $days ?>">
                        <option <?php echo ($days == 30) ? 'selected' : '' ?> value="30">30 days</option>
                        <option <?php echo ($days == 60) ? 'selected' : '' ?> value="60">60 days</option>
                        <option <?php echo ($days == 180) ? 'selected' : '' ?> value="180">180 days</option>
                        <option <?php echo ($days == 360) ? 'selected' : '' ?> value="360">360 days</option>
                        <option <?php echo ($days == 540) ? 'selected' : '' ?> value="540">540 days</option>
                    </select>
                    Total Account: <span id="lbl_total_real_country"><?php echo $total_country_count ?></span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>