<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px; display: inline-block">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;"><?php echo $title ?></h2>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Old Documents (from previous days)</td>
                <td><?php echo $old_uploaded_documents_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Uploaded Documents</td>
                <td><?php echo $uploaded_documents_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Approved Applications</td>
                <td><?php echo $accounts_verified_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Declined Applications</td>
                <td><?php echo $accounts_declined_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Pending Applications</td>
                <td><?php echo $accounts_pending_day ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of verified accounts</td>
                <td>
                    <?php
                    $percentage_verified = $accounts_verified_day > 0 ? ($accounts_verified_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0;
                    echo number_format($percentage_verified, 2) . '%'
                    ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of declined accounts</td>
                <td>
                    <?php
                    $percentage_declined = $accounts_declined_day > 0 ? ($accounts_declined_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0;
                    echo ($percentage_declined > 100 ? 100 : number_format($percentage_declined, 2)) . '%'
                    ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">Percentage of pending accounts</td>
                <td>
                    <?php
                    $percentage_pending = $accounts_pending_day > 0 ? ($accounts_pending_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0;
                    echo ($percentage_pending > 100 ? 100 : number_format($percentage_pending, 2)) . '%'
                    ?>
                </td>
            </tr>
        </table>
        <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
            <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #000;padding-top: 30px;">Top 10 Countries Uploaded Documents</label>
        </p>
        <table cellspacing="0" border="1">
            <tr>
                <td style="font-weight: bold">Country</td>
                <?php /*
                <td style="font-weight: bold">Uploaded Documents</td>
                */ ?>
                <td style="font-weight: bold">Approved</td>
                <td style="font-weight: bold">Declined</td>
                <td style="font-weight: bold">Percentage of Approved</td>
                <td style="font-weight: bold">Percentage of Declined</td>
                <td style="font-weight: bold">Uploaded Documents</td>
                <td style="font-weight: bold">Old Documents (from previous days)</td>
            </tr>
            <?php
            foreach( $top_countries as $key => $country ) {
            ?>
                <tr>
                    <td><?php echo $country['country_name'] ?></td>
                    <?php /*
                        <td><?php echo $country['country_documents_count'] ?></td>
                    */ ?>
                    <td><?php echo $country['country_verified_count'] ?></td>
                    <td><?php echo $country['country_declined_count'] ?></td>
                    <td><?php echo $country['percentage_verified'] ?></td>
                    <td><?php echo $country['percentage_declined'] ?></td>
                    <td><?php echo $country['country_documents_count'] ?></td>
                    <td><?php echo $country['country_old_documents_count'] ?></td>
                </tr>
            <?php } ?>
        </table>

    </div>
<?php //$this->load->view('email/_email_footer');?>

