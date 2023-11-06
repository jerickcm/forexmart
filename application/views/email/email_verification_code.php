<?php $this->load->view('email/_email_header');?>
<?php $this->lang->load('live-account-html');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
    <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,'Times New Roman',serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 22px;text-align: center;">

        <!--ForexMart MT4 Live Trading Account Details-->
    </h2>
    <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
        <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">
            Dear Client,

        </label> <br>



    </p>

    <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
        Your registration is almost complete. To continue, kindly see the code below.<br><br>

        Your Registration Code: <?php echo $resend_code;?><br><br>

        Simply enter this code into the registration form to finish the application process.<br><br>

        Thank you for joining us. We hope to see more of you soon.<br><br>



        <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">
            <?=lang('liv_acc_htm_23');?>
            <!--                    All the best,-->
                    <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;">
                        <?=lang('liv_acc_htm_24');?>
                        <!--                        ForexMart Team-->
                    </span>
        </label>
    </p>
</div>

<?php $this->load->view('email/_email_footer_2'); ?>
