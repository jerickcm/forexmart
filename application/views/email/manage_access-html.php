<?php $this->load->view('email/_email_header');?>
<?php $this->lang->load('manageaccess_email');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h1 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">
            <?=lang('mae_00')?></h1>
        <div class="content-grid"
             style="">
            <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">
                <?=lang('mae_01')?> <?= $full_name; ?>,</p>

            <p class="letter-body" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">

                <?php echo $title ?></p>
            <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">
                <table style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: justify;line-height: 19px;">
                    <tr>
                        <th ><?=lang('mae_02')?>:</th>
                        <td > <?php echo $full_name; //$email; ?></td>
                    </tr>
                    <tr>
                        <th ><?=lang('mae_03')?>:</th>
                        <td > <?php echo $email ?></td>
                    </tr>
                    <tr>
                        <th ><?=lang('mae_04')?>:</th>
                        <td > <?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <th ><?=lang('mae_05')?>:</th>
                        <td > <?php echo $password; ?></td>
                    </tr>


                </table>
            </div>
            <br>
            <a href="https://m7.forexmart.com/" target="_blank" style="margin-left:52px;width: 300px; background: green none repeat scroll 0% 0%; color: white; border: 1px solid green; text-decoration: none; padding: 9px 50px;"><?=lang('mae_06')?></a>
            <br>
            <p style=" margin-top: 30px !important;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;"><?=lang('mae_07')?> <a>https://m7.forexmart.com</a></p>


            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;"><?=lang('mae_08')?>.</p>
            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;"><?=lang('mae_09')?>.</p>


            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
                <?=lang('mae_10')?> <a target="_blank" href="<?php echo FXPP::loc_url('faq') ?>"> <?=lang('mae_11')?></a>
                <?=lang('mae_12')?>. </p>

            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
                <?=lang('mae_13')?> <a href="#" style="margin: 0 auto;color: #2988ca;text-decoration: none;"><?=lang('mae_14')?></a>.
            </p>

            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;line-height: 19px;">
                <?=lang('mae_15')?><br style="margin: 0 auto;">
                <?=lang('mae_16')?>,<br style="margin: 0 auto;">
                <span style="margin: 0 auto;font-weight: 600;color: #2988ca;"><?=lang('mae_17')?></span>
            </p>
        </div>
    </div>
<?php $this->load->view('email/_email_footer');?>