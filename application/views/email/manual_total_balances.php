<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 0px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Total Balance from <?php echo date('m/d/Y', strtotime($from)) ?> to <?php echo date('m/d/Y', strtotime($to)) ?></h2>

        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <?php /*
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 10px;">Total number of clients : <?php echo count($accounts) ?></label>

        */ ?>
        </p>
        <table cellspacing="0" border="1" style="width: 50%;">
            <tr>
                <td style="font-weight: bold">Date</td>
                <td style="font-weight: bold">Bonus Funds</td>
                <td style="font-weight: bold">Clients Deposits</td>
            </tr>
            <?php
            $total_bonus_fund = 0;
            $total_clients_deposit = 0;
            foreach($balances as $key => $balance){
                $total_bonus_fund += $balance['bonus_fund'];
                $total_clients_deposit += $balance['clients_deposit'];
                ?>
                <tr>
                    <td><?php echo date('m/d/Y', strtotime($balance['stamp'])) ?></td>
                    <td><?php echo number_format($balance['bonus_fund'],2) ?></td>
                    <td><?php echo number_format($balance['clients_deposit'],2) ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td>Total Balance</td>
                <td><?php echo number_format($total_bonus_fund,2) ?></td>
                <td><?php echo number_format($total_clients_deposit,2) ?></td>
            </tr>
        </table>
    </div>
<?php //$this->load->view('email/_email_footer');?>