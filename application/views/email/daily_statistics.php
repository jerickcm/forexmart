<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 0px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;"><?php echo $title ?></h2>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold"></td>
                <td style="font-weight: bold">Registrations Total</td>
                <td style="font-weight: bold">MT4 Downloads</td>
                <td style="font-weight: bold">Real Accounts</td>
                <td style="font-weight: bold">Demo Accounts</td>
                <td style="font-weight: bold">Number of Deposits</td>
                <td style="font-weight: bold">Total Deposit Sum</td>
                <td style="font-weight: bold">Number of WD Request</td>
                <td style="font-weight: bold">Total WD Sum</td>
                <td style="font-weight: bold">Total Saldo</td>
            </tr>
            <?php
            /*
            <?php foreach($daily_statistic as $d_key => $d_value){ ?>
            <tr>
                <td>Daily <?php echo $d_value['date'] ?></td>
                <td><?php echo $d_value['registration_total'] ?></td>
                <td><?php echo $d_value['mt4_download_count'] ?></td>
                <td><?php echo $d_value['real_registration_total'] ?></td>
                <td><?php echo $d_value['demo_registration_total'] ?></td>
                <td><?php echo $d_value['deposit_count'] ?></td>
                <td><?php echo number_format($d_value['deposit_total'], 2) ?></td>
                <td><?php echo $d_value['withdraw_count'] ?></td>
                <td><?php echo number_format($d_value['withdraw_total'], 2) ?></td>
                <td><?php echo number_format($d_value['deposit_total'] - $d_value['withdraw_total'], 2) ?></td>
            </tr>
            <?php } ?>
            */ ?>
            <tr>
                <td>Daily (<?php echo $daily_statistic['date'] ?>)</td>
                <td><?php echo $daily_statistic['registration_total'] ?></td>
                <td><?php echo $daily_statistic['mt4_download_count'] ?></td>
                <td><?php echo $daily_statistic['real_registration_total'] ?></td>
                <td><?php echo $daily_statistic['demo_registration_total'] ?></td>
                <td><?php echo $daily_statistic['deposit_count'] ?></td>
                <td><?php echo number_format($daily_statistic['deposit_total'], 2) ?></td>
                <td><?php echo $daily_statistic['withdraw_count'] ?></td>
                <td><?php echo number_format($daily_statistic['withdraw_total'], 2) ?></td>
                <td><?php echo number_format($daily_statistic['deposit_total'] - $daily_statistic['withdraw_total'], 2) ?></td>
            </tr>
            <tr>
                <td>Monthly (<?php echo $monthly_statistic['date'] ?>)</td>
                <td><?php echo $monthly_statistic['registration_total'] ?></td>
                <td><?php echo $monthly_statistic['mt4_download_count'] ?></td>
                <td><?php echo $monthly_statistic['real_registration_total'] ?></td>
                <td><?php echo $monthly_statistic['demo_registration_total'] ?></td>
                <td><?php echo $monthly_statistic['deposit_count'] ?></td>
                <td><?php echo number_format($monthly_statistic['deposit_total'], 2) ?></td>
                <td><?php echo $monthly_statistic['withdraw_count'] ?></td>
                <td><?php echo number_format($monthly_statistic['withdraw_total'], 2) ?></td>
                <td><?php echo number_format($monthly_statistic['deposit_total'] - $monthly_statistic['withdraw_total'], 2) ?></td>
            </tr>
        </table>
    </div>
<?php //$this->load->view('email/_email_footer');?>