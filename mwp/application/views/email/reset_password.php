<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h1 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">
            <?php echo $header;?></h1>

        <div class="content-grid"
             style="">
            <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">
                Hi <?= $full_name; ?>,</p>

            <p class="letter-body" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">

                <?php echo $title ?></p>
            <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">

            </div>
            <br>
            <a href="<?=FXPP::ajax_url('forgot-password/reset-password')?>?key=<?=$new_password_key?>" target="_blank" style="margin-left:52px;width: 300px; background: green none repeat scroll 0% 0%; color: white; border: 1px solid green; text-decoration: none; padding: 9px 50px;">Reset password</a>
            <br>
            <p style=" margin-top: 30px !important;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">Alternatively, you may copy and paste the following link to your browser <a><?=FXPP::ajax_url('forgot-password/reset-password')?>?key=<?=$new_password_key?></a></p>




            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
                You may visit our <a target="_blank" href="<?php echo site_url('faq') ?>"> Frequently Asked Questions</a>
                for more technical information. </p>

            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
                For more information please do not hesitate to contact us at <a href="#"
                                                                                style="margin: 0 auto;color: #2988ca;text-decoration: none;">support@forexmart.com</a>.
            </p>

            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;line-height: 19px;">
                Thank you<br style="margin: 0 auto;">
                With best regards,<br style="margin: 0 auto;">
                <span style="margin: 0 auto;font-weight: 600;color: #2988ca;">ForexMart</span> Team
            </p>
        </div>
    </div>
<?php $this->load->view('email/_email_footer');?>