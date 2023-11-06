<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ForexMart Mail</title>
</head>
<body
    style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;background-color: #fff;">
<div class="wrapper-container"
     style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0 auto;max-width: 800px;height: auto;">
    <div class="col-lg-12 col-md-12"
         style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;width: 100%;">
        <div class="wrapper-header-two"
             style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box; background: #2988ca; background-image: url(<?=base_url()?>assets/images/header-bg.png); width: 1090px">
            <a href="<?= FXPP::loc_url() ?>">
                <img src="<?= base_url() ?>assets/images/logo-mailing_v2.png" class="img-responsive"
                     style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 0;vertical-align: middle;page-break-inside: avoid;display: block; width: 1025px;">
            </a>
        </div>

<div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">

    <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,'Times New Roman',serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 22px;text-align: center;">
        <?=$subject?>
    </h2>

    <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,'Times New Roman',serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 16px;text-align: left;">
        Total number of clients : <?=$no = count($moneyFall)?>
    </h2>

    <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,'Times New Roman',serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 16px;text-align: left;">
          <?="For contest week ".date('Y-m-d', strtotime('last week monday', strtotime('tomorrow')))." - ". date('Y-m-d', strtotime('last friday', strtotime('yesterday')))?>
    </h2>

    <table border="1" cellspacing="0" cellpadding="0"  style="font-size: 13px;font-family: Arial;font-weight: 400;color: #555;text-align: center;line-height: 19px; width: 100%">
        <tr>
            <!-- <th style="width: 6%"> No.</th>-->
            <th style="width: 6%"> No.</th>
            <th>Nick name</th>
            <th>Account Number</th>
            <th >Email</th>
            <th >Balance</th>
            <th >% of EURUSD P&L out of the Total P&L </th>
            <th >% of USDJPY P&L out of the Total P&L </th>
            <th >Orders < 2 minutes </th>
            <th >Duplicate accounts </th>
            <th>5% Rule Fulfilled</th>
            <th>Joined past contests</th>
            <th>P&L % of additional instruments</th>
            <th># of < 2 minutes orders and % of Total P&L</th>

        </tr>
        <?php
        if(sizeof($moneyFall)>0){
            foreach( $moneyFall as $key => $value ){ ?>
                <tr>
                    <td><?=$no--;?></td>
                    <td style="text-align: left;padding-left: 4px;"><?=$value['name']?></td>
                    <td><?php echo $value['login'] ?></td>
                    <td><?=$value['email']?></td>
                    <td><?=number_format($value['balance'],2)?></td>
                    <td><?=number_format($value['EURUSD'],2)."%"?></td>
                    <td><?=number_format($value['USDJPY'],2)."%"?></td>
                    <td><?=$value['LessThen2MinutesOrdersCount']>0?"Yes":"No"?></td>
                    <td><?=$value['dup']>1?"Yes":"No";  ?></td>
                    <!--IF(AND(EURUSD P&L percentage>=5%,USDJPY P&L percentage>=5%,BALANCE>5000),"YES","NO")-->
                    <td><?=$value['EURUSD']>=5 && $value['USDJPY'] >=5 && $value['balance']>500 ?"Yes":"No"?></td>
                    <td><?=is_object($value['duplicate'])?$value['duplicate']->start_date." ".$value['duplicate']->end_date:"No"?></td>
                    <td><?=number_format($value['instruments'],2) ."%"?></td>
                    <td><?php
                            echo $value['LessThen2MinutesOrdersCount']."<br>";
                            echo number_format($value['profitlosspercentage'],2)."%";
                        ?></td>


                </tr>
            <?php }}else{
            echo "<tr><td style='text-align: center' colspan='5'> No records found  </td></tr>";
        } ?>
    </table>


</div>
<?php //$this->load->view('email/_email_footer');?>
</div>
</div>

</body>
</html>
