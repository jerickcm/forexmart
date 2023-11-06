<html>
<body>

<div class="main-wrapper" style="margin: 0 auto;width: 615px;">
    <?php $this->load->view('email/_email_header')?>
    <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">  <img style="width: 100%" src="<?=base_url() ?>assets/images/ndb_20.png"></p>


    <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: bold;color: #555; text-align: center">Bonus Mail</p>
    <div class="content-grid" style="margin: 0 auto;padding: 15px;box-sizing: border-box; padding-bottom: 0px;">

        <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">Dear Client,</p>


        <p class="letter-body" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
            We have a Special Offer for you!
        </p>

        <p style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;"> </p>
        <p style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
            Maximize your capital with this personal offer. Grab the chance to DOUBLE your deposit with 100% bonus.
            This offer is only available for 48 hours starting today.
            Deposit any sum up to $2000 and get it twice with this limited time offer!
        </p>
        <p style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;"> <a href="<?=FXPP::www_url('limited-bonus')?>">Click here</a>  to visit the official page and learn more about the Terms & Conditions.
        </p>

        <p style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;"> Hurry and don’t miss this opportunity to get better deals!  Happy Trading!
        </p>

        <p class="closing" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;line-height: 19px;padding-bottom: 15px;">
            Truly yours,<br style="margin: 0 auto;">
            ForexMart Team<br style="margin: 0 auto;">
        </p>
    </div>

    <?php $this->load->view('email/_email_footer_2')?>

</div>

</body>
</html>