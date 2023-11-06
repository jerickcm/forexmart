
<?php $this->load->view('email/_email_header');?>
<?php $this->lang->load('demo-account-html');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
    <h1 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">
        <?=lang('dem_acc_htm_01');?>
<!--        ForexMart MT4 Demo account details-->
    </h1>

    <div class="content-grid"
         style="">
        <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">
            <?=lang('dem_acc_htm_02');?>
<!--            Hi-->
            <?= $full_name; ?>,</p>

        <p class="letter-body" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
            <?=lang('dem_acc_htm_03');?>
<!--        Thank you for opening an MT4 demo account with ForexMart! Below are your account details:-->
        </p>
        <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">
            <table style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: justify;line-height: 19px;">
                <tr>
                    <th >
                        <?=lang('dem_acc_htm_04');?>
<!--                        Account number:-->
                    </th>
                    <td > <?php echo $account_number; //$email; ?></td>
                </tr>
                <tr>
                    <th >
                        <?=lang('dem_acc_htm_05');?>
<!--                        Trader password:-->
                    </th>
                    <td > <?php echo strlen($trader_password)>0?$trader_password: "[Trader password]";//$password; ?></td>
                </tr>
                <tr>
                    <th >
                        <?=lang('dem_acc_htm_06');?>
<!--                        Investor password:-->
                    </th>
                    <td > <?php echo strlen($investor_password)>0?$investor_password:"[Investor password]";//$password; ?></td>
                </tr>
                <tr>
                    <th >
                        <?=lang('dem_acc_htm_07');?>
<!--                        MT4 Demo Server:-->
                    </th>
                    <td ><?php echo MT4_SERVER_DEMO ?></td>
                </tr>


            </table>
        </div>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
            <?=lang('dem_acc_htm_08');?>
<!--            Please store your login details safe and secure at all times.-->
        </p>
        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
            <?=lang('dem_acc_htm_09');?>
<!--            Note that your login and password will work Meta Trader 4 only.-->
        </p>
        <p style="font-size: 14px;font-family: Arial sans-serif;font-weight: 400;color: #555;margin: 25px 0px 30px 0px;text-align: justify;"><a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe" style="cursor:pointer;background: none repeat scroll 0 0 #2988ca; border: 1px solid #2988ca; color: #fff; font-family: Arial; font-size: 15px; font-weight: 500; padding: 8px 25px; transition: all 0.3s ease 0s; text-decoration: none;">
                <?=lang('dem_acc_htm_10');?>
<!--                Download MT4 desktop platform-->
            </a></p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
            <?=lang('dem_acc_htm_11');?>
<!--            You may visit our-->
            <a target="_blank" href="<?php echo FXPP::loc_url('faq') ?>">
                <?=lang('dem_acc_htm_12');?>
<!--                Frequently Asked Questions-->
            </a>
            <?=lang('dem_acc_htm_13');?>
<!--            for more technical information. We wish you a successful trading!-->
        </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
            <?=lang('dem_acc_htm_14');?>
<!--            For more information please do not hesitate to contact us at-->
            <a href="#"  style="margin: 0 auto;color: #2988ca;text-decoration: none;">
                support@forexmart.com
            </a>.
        </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;line-height: 19px;">
            <?=lang('dem_acc_htm_15');?>
<!--            Thank you-->
            <br style="margin: 0 auto;">
            <?=lang('dem_acc_htm_16');?>
<!--            With best regards,-->
            <br style="margin: 0 auto;">
            <span style="margin: 0 auto;font-weight: 600;color: #2988ca;">
                <?=lang('dem_acc_htm_17');?>
<!--                ForexMart-->
            </span>
            <?=lang('dem_acc_htm_18');?>
<!--            Team-->
        </p>
    </div>
  </div>


<?php

//if(IPLoc::Office()){
//    $this->load->view('email/_email_footer_2');
//}else{
//    $this->load->view('email/_email_footer');
//}

$this->load->view('email/_email_footer_2');
?>


