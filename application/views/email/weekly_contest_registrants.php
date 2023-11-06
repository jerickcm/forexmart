<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box; width: 100%; padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px; display: inline-block">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;"><?php echo $title ?></h2>
        <table cellspacing="0" border="1" style="margin: 0 auto;">
            <tr>
                <td style="font-weight: bold">Account Number</td>
                <?php /*
                <td style="font-weight: bold">Uploaded Documents</td>
                <td style="font-weight: bold">Approved</td>
                <td style="font-weight: bold">Declined</td>
                */ ?>
                <td style="font-weight: bold">Name</td>
                <td style="font-weight: bold">Date Registered</td>
            </tr>
            <?php
            foreach( $contest_participants as $key => $participant ) {
                ?>
                <tr>
                    <td><?php echo $participant['account_number'] ?></td>
                    <?php /*
                        <td><?php echo $country['country_documents_count'] ?></td>
                        <td><?php echo $country['country_verified_count'] ?></td>
                        <td><?php echo $country['country_declined_count'] ?></td>
                    */ ?>
                    <td><?php echo $participant['FullName'] ?></td>
                    <td><?php echo date('Y-m-d H:i:s', strtotime($participant['registration_time'])) ?></td>
                </tr>
            <?php } ?>
        </table>

    </div>
<?php //$this->load->view('email/_email_footer');?>

