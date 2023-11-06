<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 10px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Daily Deposits - <?php echo date('m/d/Y', strtotime($date_stamp)) ?></h2>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Top 5 Countries</td>
                <td style="font-weight: bold">Top 5 Payment Systems</td>
            </tr>
            <?php for($i = 0; $i < 5; $i++){ ?>
                <tr>
                    <?php if( count($top_countries) > $i ){ ?>
                        <td><?php echo $top_countries[$i]['country_name'] ?></td>
                    <?php }else{ ?>
                        <td style="height: 20px;"></td>
                    <?php } ?>
                    <?php if( count($top_payment_systems) > $i ){ ?>
                        <td><?php echo $top_payment_systems[$i]['payment_type'] ?></td>
                    <?php }else{ ?>
                        <td style="height: 20px;"></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
        <span style="margin: 0 auto; display: block; font-family: Georgia; font-size: 17px; color: #2988ca;margin-top: 30px;margin-bottom: 10px; padding-bottom: 10px;padding-left: 15px;">Deposits Summary</span>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">No</td>
                <td style="font-weight: bold">Account Number</td>
                <td style="font-weight: bold">Full Name</td>
                <td style="font-weight: bold">Amount</td>
                <td style="font-weight: bold">Payment System</td>
                <td style="font-weight: bold">MT Ticket</td>
                <td style="font-weight: bold">MT Comment</td>
                <td style="font-weight: bold">MT Stamp</td>
            </tr>
            <?php
                $ctr = count($deposit_data);
            if(count($deposit_data) > 0){
                foreach($deposit_data as $key => $deposit){
            ?>
                <?php if(!empty($deposit['full_name']) && !empty($deposit['payment_type'])){ ?>
                    <tr>
                        <td><?php echo $ctr ?></td>
                        <td><?php echo $deposit['account_number'] ?></td>
                        <td><?php echo $deposit['full_name'] ?></td>
                        <td><?php echo number_format($deposit['amount'], 2) ?><span style="display:none"><?php echo $deposit['status'] ?></span></td>
                        <td><?php echo $deposit['payment_type'] ?></td>
                        <td><?php echo $deposit['ticket'] ?></td>
                        <td><?php echo $deposit['comment'] ?></td>
                        <td><?php echo date('m/d/Y H:i:s A', strtotime($deposit['payment_date'])) ?></td>
                    </tr>
                <?php
                        $ctr--;
                    }
                ?>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="8">There are no records found.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php //$this->load->view('email/_email_footer');?>

