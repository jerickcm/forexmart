<?php $this->load->view('email/_email_header');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
    <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,'Times New Roman',serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 22px;text-align: center;">ForexMart MT4 Live Trading Account Details</h2>
    <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
        <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">Hi <?=$full_name; ?>,</label> <br>

        Thank you for opening an MT4 account with ForexMart! Your login details are as follows:
    </p>

    <div class="cabinet-login-details" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 30px 20px;width: 300px;">
        <h1 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: .67em 0;font-size: 15px;font-family: inherit;font-weight: 500;line-height: 1.1;color: #5a5a5a;margin-top: 20px;margin-bottom: 10px;">Cabinet login details.</h1>
        <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            <span style="white-space:nowrap;">
                <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">Username:</label>
                <?php echo $account_number." or "?><a href="javascript:;" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;"><?=$email; ?></a>
            </span>
        </div>
            <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">Password:</label>
                <label> <?=$trader_password; ?> </label>
            </div>
        <br/>
        <div class="login-button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"><a href="https://my.forexmart.com/client/signin"><button type="button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;font: inherit;color: #fff;overflow: visible;text-transform: none;-webkit-appearance: button;cursor: pointer;font-family: inherit;font-size: inherit;line-height: inherit;width: 100%;border: none;padding: 10px 30px;background: #29a643;">Login to cabinet</button></a></div>
    </div>
    <div class="cabinet-login-details" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 30px 20px;width: 300px;">
        <h1 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: .67em 0;font-size: 15px;font-family: inherit;font-weight: 500;line-height: 1.1;color: #5a5a5a;margin-top: 20px;margin-bottom: 10px;">MT4 login details.</h1>
        <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">Account Number:</label>
            <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;"><?=$account_number; ?></span>
        </div>
        <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">Trader Password:</label>
            <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;"><?=$trader_password; ?></span>
        </div>
        <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">Investor Password:</label>
            <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;"><?=$investor_password; ?></span>
        </div>
        <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">Phone Password:</label>
            <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;"><?=$phone_password; ?></span>
        </div>
        <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">MT4 Live Server:</label>
            <a href="javascript:;" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;"><?=MT4_SERVER_LIVE ?></a>
        </div>
        <div class="download-button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"><a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe"> <button type="button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;font: inherit;color: #fff;overflow: visible;text-transform: none;-webkit-appearance: button;cursor: pointer;font-family: inherit;font-size: inherit;line-height: inherit;width: 100%;border: none;padding: 10px 30px;background: #2988ca;">Download MT4 desktop platform</button></a></div>
    </div>
    <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">Keep your account details safe and secure at all times. <br><br>

        To express our gratitude for jump-starting your trading with us, you can avail of the 30% <a href="<?=site_url()?>bonuses" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">Bonus</a> offer, Open a real account make a deposit, and have the opportunity to get 30% of the total amount of this and every subsequent deposit.
        <br><br>
        We also offer several was to deposit money into your account. You can quickly and securely make deposits via credit/debit card, from your bank account via a Bank Transfer or through online money transfer services such as Skrill, Paypal, Webmoney, Neteller,
        Payco and many more. Please click here to know more about our different <a href="<?=site_url()?>deposit-withdraw-page" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">Deposit Methods</a>.
        <br><br>
        You are categorized as a Retail Client. If you desire to be reclassified, kindly send a request to us and follow the steps outlined in the Client Categorization. You can start trading once your request is approved.
        <br><br>
        For more information, please do not hesitate to contact us at <a href="javascript:;" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">support@forexmart.com</a>.
        <br><br>
        May you have a successful trading!
        <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">All the best,
            <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;">ForexMart Team</span>
        </label>
    </p>
</div>
<?php $this->load->view('email/_email_footer');?>
