<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 10px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;"><?php echo $title ?></h2>
        <img src="<?php echo $img_val ?>" style="width: 100%; margin: 0 auto; display: table;"/>
        <div style="display: table; margin: 20px auto; width: 100%;">
            <table cellspacing="0" cellpadding="0" border="1" style="border: 1px solid #eaeaea; width: 100%">
                <thead>
                <tr>
                    <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                        No.
                    </th>
                    <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                        Payment System
                    </th>
                    <th style="background: #fafafa; padding: 5px; vertical-align: middle; text-align: center; border: 1px solid #eaeaea;">
                        Total Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(count($deposit_data) > 0){
                    $data_ctr = 1;
                    foreach( $deposit_data as $key => $data ){
                        ?>
                        <tr>
                            <td style="border: 1px solid #eaeaea;"><?php echo $data_ctr ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo $data['payment_type'] ?></td>
                            <td style="border: 1px solid #eaeaea;"><?php echo number_format($data['amount'], 2) ?></td>
                        </tr>
                        <?php
                        $data_ctr++;
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