<?php $this->load->view('email/_email_header');?>
        <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
            <h2 style="text-align: center;color: #2988CA;">
                We have credited a Bonus to your account!
            </h2>

            <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">
                Dear Client,
            </p>
            <br/>
            <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">
                Congratulations!
            </p>
            <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                We have great news for you! Your account has been credited with $10 Mini bonus. With this you could trade immediately and test our platform.
            </p>

            <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                Login -  <?=$account_number?> or   <?=$Email?>
            </p>
            <br/>
            <br/>
            <a href="https://my.forexmart.com/client/signin"><button type="button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;font: inherit;color: #fff;overflow: visible;text-transform: none;-webkit-appearance: button;cursor: pointer;font-family: inherit;font-size: inherit;line-height: inherit;width: 184px;;border: none;padding: 10px 30px;background: #29a643;">
                    GO TO CABINET
                </button></a>

            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
                This is a wonderful opportunity to test our platform in real time without any investments. Profits can  be withdrawn immediately.
            </p>

            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
                To learn more information about mini-bonus, you could visit <a href="https://www.forexmart.com/no-deposit-bonus-agreement">here</a>. Please do not hesitate to contact us if you have any concerns or inquiries regarding your account or our services.
            </p>
            <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
                Thank you for staying with us. We wish you luck in Trading!
            </p>
            <br/>
            <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">
                                 Truly yours
                            </span>
                <br/>
                ForexMart Team
            </p>
        </div>
<?php


$this->load->view('email/_email_footer_2');
?>