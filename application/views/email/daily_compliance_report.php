<?php $this->load->view('email/_email_header');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px; display: inline-block">
    <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">ForexMart Compliance Report as of <?php echo date('m/d/Y H:i:s', strtotime($as_of_date)) ?></h2>
    <div style="width: 50%; float: left">
        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 30px;">Last 24 hours</label>
        </p>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Number of opened accounts</td>
                <td><?php echo $opened_accounts_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Old Uploaded documents (from previous days)</td>
                <td><?php echo $old_uploaded_documents_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Uploaded documents</td>
                <td><?php echo $uploaded_documents_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of verified accounts</td>
                <td><?php echo number_format($accounts_verified_day, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of declined accounts</td>
                <td><?php echo $accounts_declined_day > 100 ? 100 : number_format($accounts_declined_day, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of pending accounts</td>
                <td><?php echo number_format($accounts_pending_day, 2) ?>%</td>
            </tr>
        </table>
    </div>
    <div style="width: 50%; float: left">
        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 30px;">Last 1 week</label>
        </p>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Number of opened accounts</td>
                <td><?php echo $opened_accounts_week ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Old Uploaded documents (from previous days)</td>
                <td><?php echo $old_uploaded_documents_week ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Uploaded documents</td>
                <td><?php echo $uploaded_documents_week ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of verified accounts</td>
                <td><?php echo number_format($accounts_verified_week, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of declined accounts</td>
                <td><?php echo $accounts_declined_day > 100 ? 100 : number_format($accounts_declined_week, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of pending accounts</td>
                <td><?php echo number_format($accounts_pending_week, 2) ?>%</td>
            </tr>
        </table>
    </div>
    <div style="width: 50%; float: left">
        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 30px;">Last 1 month</label>
        </p>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Number of opened accounts</td>
                <td><?php echo $opened_accounts_month ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Old Uploaded documents (from previous days)</td>
                <td><?php echo $old_uploaded_documents_month ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Uploaded documents</td>
                <td><?php echo $uploaded_documents_month ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of verified accounts</td>
                <td><?php echo number_format($accounts_verified_month, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of declined accounts</td>
                <td><?php echo $accounts_declined_day > 100 ? 100 : number_format($accounts_declined_month, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of pending accounts</td>
                <td><?php echo number_format($accounts_pending_month, 2) ?>%</td>
            </tr>
        </table>
    </div>
    <div style="width: 50%; float: left">
        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 30px;">Whole Period</label>
        </p>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Number of opened accounts</td>
                <td><?php echo $opened_accounts ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Old Uploaded documents (from previous days)</td>
                <td><?php echo $old_uploaded_documents ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Uploaded documents</td>
                <td><?php echo $uploaded_documents ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of verified accounts</td>
                <td><?php echo number_format($accounts_verified, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of declined accounts</td>
                <td><?php echo $accounts_declined_day > 100 ? 100 : number_format($accounts_declined, 2) ?>%</td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of pending accounts</td>
                <td><?php echo number_format($accounts_pending, 2) ?>%</td>
            </tr>
        </table>
    </div>
</div>
<?php //$this->load->view('email/_email_footer');?>
