<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 0px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">Clients from <?php echo $country ?> as of <?php echo date('m/d/Y H:i:s', strtotime($as_of_date)) ?></h2>
        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 10px;">Total number of clients : <?php echo count($accounts) ?></label>
        </p>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Full Name</td>
                <td style="font-weight: bold">Account Number</td>
                <td style="font-weight: bold">Phone Number</td>
                <td style="font-weight: bold">Address</td>
            </tr>
            <?php foreach($accounts as $key => $account){ ?>
            <tr>
                <td><?php echo $account['full_name'] ?></td>
                <td><?php echo $account['account_number'] ?></td>
                <td><?php echo $account['phone1'] ?></td>
                <td><?php echo $account['city'] . ', ' . $country ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
<?php //$this->load->view('email/_email_footer');?>

</div>
</div>

</body>
</html>

