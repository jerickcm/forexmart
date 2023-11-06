<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 0px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Total Accounts from <?php echo date('m/d/Y', strtotime($from)) ?> to <?php echo date('m/d/Y', strtotime($to)) ?></h2>

        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <?php /*
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 10px;">Total number of clients : <?php echo count($accounts) ?></label>

        */ ?>
        </p>
        <table cellspacing="0" border="1" style="width: 50%;">
            <tr>
                <td>Total Real Accounts</td>
                <td><?php echo $real_account_count ?></td>
            </tr>
            <tr>
                <td>Total Demo Real Accounts</td>
                <td><?php echo $demo_account_count ?></td>
            </tr>
        </table>
        <br/>
        <img src="<?php echo $img_real ?>" style="width: 100%; margin: 0 auto; display: table;"/>
        <br/>
        <br/>
        <img src="<?php echo $img_demo ?>" style="width: 100%; margin: 0 auto; display: table;"/>
    </div>
<?php $this->load->view('email/_email_footer');?>