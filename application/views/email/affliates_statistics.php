<p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify; border-top:1px solid #2988ca ; padding-top: 20px;">
    <b>Affiliates code : <?=$code1;?>
</p>
<table border="1" cellspacing="0" cellpadding="0"  style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: center;line-height: 19px; width: 100%">
    <tr>
        <th style="width: 50%" >Account Number</th>
        <th style="width: 50%" >Full Name</th>
        <!--<th >Email</th>-->
    </tr>
    <?php
    if($referrals){
        foreach( $referrals as $key => $value ){ ?>
            <tr>
                <td><?php echo $value->account_number ?></td>
                <td><?php echo $value->full_name ?></td>
                <!--<td><?php /*echo $value->email */?></td>-->
            </tr>
        <?php }}else{
        echo "<tr><td style='text-align: center' colspan='2'> No records found  </td></tr>";
    } ?>
</table>