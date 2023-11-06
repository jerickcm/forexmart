<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 10px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Weekly Deposits, Withdrawals and Saldo - <?php echo date('m/d/Y', strtotime($date_from)) ?> to <?php echo date('m/d/Y', strtotime($date_to)) ?></h2>
        <div style="display: table; margin: 20px auto; width: 100%;">
            <table cellspacing="0" cellpadding="0" border="1" style="border: 1px solid #eaeaea;">
                <tr>
                    <td style="padding: 5px; vertical-align: middle; font-weight: bold; border: 1px solid #eaeaea;">
                        <label style="padding-top: 0; margin-bottom: 0; display: inline-block; font-weight: bold;">
                            Total Deposits
                        </label>
                    </td>
                    <td style="border: 1px solid #eaeaea; padding: 0px 10px;">
                        <label style="padding-top: 0; margin-bottom: 0; display: inline-block;">
                            <?php echo number_format($dws_total_weekly['amount_deposit'],2) ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; vertical-align: middle; font-weight: bold; border: 1px solid #eaeaea;">
                        <label style="padding-top: 0; margin-bottom: 0; display: inline-block; font-weight: bold;">
                            Total Withdrawals
                        </label>
                    </td>
                    <td style="border: 1px solid #eaeaea; padding: 0px 10px;">
                        <label style="padding-top: 0; margin-bottom: 0; display: inline-block;">
                            <?php echo number_format($dws_total_weekly['amount_withdraw'],2) ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; vertical-align: middle; font-weight: bold; border: 1px solid #eaeaea;">Total Saldo</td>
                    <td style="border: 1px solid #eaeaea; padding: 0px 10px;">
                        <label style="padding-top: 0; margin-bottom: 0; display: inline-block;">
                            <?php echo number_format($dws_total_weekly['amount'],2) ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; vertical-align: middle; font-weight: bold; border: 1px solid #eaeaea;">Supporter Withdrawal</td>
                    <td style="border: 1px solid #eaeaea; padding: 0px 10px;">
                        <label style="padding-top: 0; margin-bottom: 0; display: inline-block;">
                            <?php echo number_format($dws_total_supporter_withdraw, 2) ?>
                        </label>
                    </td>
                </tr>
            </table>
        </div>
        <div style="display: table; margin: 20px auto; width: 100%;">
            <h1 style="margin-bottom: 5px; margin-top: 0; font-weight: bold; font-size: 15px; color: #2988ca;">Summary</h1>
            <table cellspacing="0" cellpadding="0" border="1" style="border: 1px solid #eaeaea; width: 100%">
                <thead>
                    <tr>
                        <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                            Date
                        </th>
                        <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                            Deposits
                        </th>
                        <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                            # of Deposits
                        </th>
                        <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                            Withdrawals
                        </th>
                        <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                            # of Withdrawals
                        </th>
                        <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                            Saldo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(count($dws_all) > 0){
                        foreach( $dws_all as $key => $dws ){
                    ?>
                        <tr>
                            <td style="border: 1px solid #eaeaea;"><?php echo date('m/d/Y', strtotime($dws['payment_date'])) ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo number_format($dws['amount_deposit'],2) ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo $dws['deposit_count'] ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo number_format($dws['amount_withdraw'],2) ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo $dws['withdraw_count'] ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo number_format($dws['amount'],2) ?></td>
                        </tr>
                    <?php
                        }
                    }else{
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center">No Records Found</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php //$this->load->view('email/_email_footer');?>
