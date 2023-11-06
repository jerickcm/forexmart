<?php  $this->load->view('email/_email_header');?>
<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">

    <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,'Times New Roman',serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 22px;text-align: left;">
        <?=$subject?>
    </h2>

    <table border="1" cellspacing="0" cellpadding="0"  style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: center;line-height: 19px; width: 100%">
        <tr>
            <th >Country name</th>
            <th >Number of users</th>
            <!--<th >Email</th>-->
        </tr>
        <?php
        if($referrals){
            foreach( $referrals as $key => $value ){ ?>
                <tr>
                    <td><?= isset($country[$value->country])?$country[$value->country]:"" ?></td>
                    <td><?= $value->num ?></td>
                    <!--<td><?php /*echo $value->email */?></td>-->
                </tr>
            <?php }}else{
            echo "<tr><td style='text-align: center' colspan='2'> No records found  </td></tr>";
        } ?>
    </table>


</div>
<?php $this->load->view('email/_email_footer');?>
