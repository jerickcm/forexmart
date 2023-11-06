<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 10px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Weekly Statistics - <?php echo date('m/d/Y', strtotime('now')) ?></h2>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Affiliate Code</td>
                <td style="font-weight: bold">Last week opened accounts</td>
                <td style="font-weight: bold">Total accounts opened</td>
                <td style="font-weight: bold">Total Commission</td>
            </tr>
            <?php foreach($accounts as $key => $account){ ?>
                <tr>
                    <td><?php echo $account['affiliate_code'] ?></td>
                    <td><?php echo $account['total_date_count'] ?></td>
                    <td><?php echo $account['total_count'] ?></td>
                    <td><?php echo $account['commission_amount']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php //$this->load->view('email/_email_footer');?>

