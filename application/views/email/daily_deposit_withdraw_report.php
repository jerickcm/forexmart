<?php $this->load->view('email/_email_header');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
    <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 10px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Daily Deposits and Withdrawals - <?php echo date('m/d/Y', strtotime($date_stamp)) ?></h2>
    <h3>Deposits</h3>
    <table cellspacing="0" border="1">
        <thead>
            <tr>
                <col width="40">
                <col width="90">
                <col width="130">
                <col width="150">
                <col width="130">
                <col width="100">
                <col width="130">
                <th>#</th>
                <th>Time</th>
                <th>Account Number</th>
                <th>Name</th>
                <th>Country</th>
                <th>Amount</th>
                <th>Payment System</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($deposits) {
            $count = 0;
            foreach ($deposits as $key => $value) {
                $count++; ?>
                <tr>
                    <td style="padding: 10px 5px;"><?= $count; ?></td>
                    <td style="padding: 10px 4px;"><?= $value['payment_time'] ?></td>
                    <td style="padding: 10px 4px;"><?= $value['account_number'] ? $value['account_number'] : $value['reference_num'] ?></td>
                    <td style="padding: 10px 4px;"><?= strtoupper($value['full_name']) ?></td>
                    <td style="padding: 10px 4px;"><?= strtoupper($value['country']) ?></td>
                    <td style="text-align: right;padding: 10px;"><?= $value['amount'] ?></td>
                    <td style="padding: 10px 4px;;"><?= $value['transaction_type'] == 'N/A' ? strtoupper($value['note']) : strtoupper($value['transaction_type']) ?></td>
                </tr>
        <?php }
        } else {
            echo '<tr><td colspan="7" style="text-align: center;">No Available Data</td></tr>';
        } ?>
        </tbody>
    </table>

    <h3>Withdrawals</h3>
    <table cellspacing="0" border="1">
        <thead>
            <tr>
                <col width="40">
                <col width="90">
                <col width="130">
                <col width="150">
                <col width="130">
                <col width="100">
                <col width="130">
                <th>#</th>
                <th>Time</th>
                <th>Account Number</th>
                <th>Name</th>
                <th>Country</th>
                <th>Amount</th>
                <th>Payment System</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($withdrawals) {
            $count1 = 0;
            foreach ($withdrawals as $key => $value) {
                $count1++; ?>
                <tr>
                    <td style="padding: 10px 5px;"><?= $count1; ?></td>
                    <td style="padding: 10px 4px;"><?= $value['withdraw_time'] ?></td>
                    <td style="padding: 10px 4px;"><?= $value['account_number'] ? $value['account_number'] : $value['reference_num'] ?></td>
                    <td style="padding: 10px 4px;"><?= strtoupper($value['full_name']) ?></td>
                    <td style="padding: 10px 4px;"><?= strtoupper($value['country']) ?></td>
                    <td style="text-align: right;padding: 10px;"><?= $value['amount'] ?></td>
                    <td style="padding: 10px 4px;;"><?= strtoupper($value['transaction_type']) ?></td>
                </tr>
        <?php }
        } else {
            echo '<tr><td colspan="7" style="text-align: center;">No Available Data</td></tr>';
        } ?>
        </tbody>
    </table>
</div>