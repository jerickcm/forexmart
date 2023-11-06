<?php $this->load->view('email/_email_header');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
    <h1 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">
     User Feedback </h1>

    <div class="content-grid"
         style="">
        <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">
            Hi <span style="margin: 0 auto;font-weight: 600;color: #2988ca;">ForexMart</span> Team,</p>

        <p class="letter-body" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">

          <?php echo $title ?></p>
        <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">
            <table style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: justify;line-height: 19px;">
                <tr>
                    <th>Rating :</th>
                    <td><?=$rating?></td>
                </tr>
                <tr>
                    <th>Category :</th>
                    <td ><?=$category?></td>
                </tr>
                <tr>
                    <th>Comment :</th>
                    <td colspan="3"><?=$message?></td>
                </tr>
            </table>
        </div>
        <br>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;line-height: 19px;">
            Thank you<br style="margin: 0 auto;">
           <?=$belowThansk?><br style="margin: 0 auto;">
            <span style="margin: 0 auto;font-weight: 600;color: #2988ca;"><?php echo $name; ?></span> 
        </p>
    </div>
  </div>
<?php $this->load->view('email/_email_footer');?>