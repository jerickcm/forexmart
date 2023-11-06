<div class="col-md-12 col-dashboard" id="real_accounts_graph_<?php echo $days ?>">
    <div class="main-chart-holder">
        <div class="chart-header">
            <div class="chart-title">
                <h1><i class="fa fa-sign-in"></i>NDB Clients Statistics</h1>
            </div>
            <div class="chart-action-holder">
                <a href="#" class="cursord" id="real_expand" title="Expand Widget" ><i class="fa fa-expand"></i></a>
                <input type="hidden" class="expend dr_graph" name="real_graph" id="real_accounts_expand" value="0"/>
            </div><div class="clearfix"></div>
        </div>
        <div class="chart-holder" id="real_account_graph_<?php echo $days ?>">
        </div>
        <div class="chart-footer">
            <!--<h1>Opened account in the last <span id="lbl_real_period"><?php /*echo $days */?></span> days</h1>-->
            <h1>Registered from NDB advertising code</h1>
            <div >

                <div class="form-group chart-fg">
                    &nbsp;&nbsp;&nbsp;
                    <i class="fa fa-circle-o circle-green"></i> NDB Accounts
                    &nbsp;&nbsp;&nbsp;
                    <label for="" class="chart-lbl">Cumulative</label>
                    <select class="chart-option" name="real_accounts" id="real_cumulative_<?php echo $days ?>">
                        <option value="1">YES</option>
                        <option selected value="0">NO</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;
                   <!-- <label for="" class="chart-lbl">Period</label>
                    <select class="chart-option" name="reallimit" id="real_period_<?php /*echo $days */?>">
                        <option <?php /*echo ($days == 30) ? 'selected' : '' */?> value="30">30 days</option>
                        <option <?php /*echo ($days == 60) ? 'selected' : '' */?> value="60">60 days</option>
                        <option <?php /*echo ($days == 180) ? 'selected' : '' */?> value="180">180 days</option>
                        <option <?php /*echo ($days == 360) ? 'selected' : '' */?> value="360">360 days</option>
                        <option <?php /*echo ($days == 540) ? 'selected' : '' */?> value="540">540 days</option>
                    </select>-->
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>