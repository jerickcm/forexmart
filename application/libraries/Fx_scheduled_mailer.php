<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fx_scheduled_mailer {

    function __construct(){
        FXPP::CI()->lang->load('FxMailer');
    }

    private static function CI(){
        $CI =& get_instance();
        return $CI;
    }

    // this is for scheduled emails


    // sender

       public static function massMailer($to, $replyto, $body, $subject)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.notify.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = 'marketing@notify.forexmart.com';
        $mail->Password = 'Yd99dE7fR3';
        $mail->DKIM_domain = "notify.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom('marketing@notify.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }


  public static function NewestMailerSchedulerSender($to, $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.notify.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = 'marketing@notify.forexmart.com';
        $mail->Password = 'Yd99dE7fR3';
        $mail->DKIM_domain = "notify.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        // $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom('marketing@notify.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

// sender end



    // official header and footer 
    public static function NewestHeader()
    {
        $body = '<html>
                <head>
                    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
                </head>
                <body style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px;line-height: 1.42857143; color: #333;background-color: #fff;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;height: auto;">';
        $body .= '<div style="margin: 0 auto; width:100%;padding: 0!important">';
        $body .= '<div style="background:url(https://www.forexmart.com/assets/images/header-bg.png); width:100%!important; margin-top:2px; ;border-top: 3px solid #EAEAEA;">';
        $body .= '<img alt="header-image" style="width:100%!important;" src="https://www.forexmart.com/assets/images/logo-mailing_v2.png">';
        $body .= '</div>';
        return $body;
    }



    public static function NewestFoooterForMassMailer($unsubscribe_key)
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;"><span style="font-weight: bold;color: #ff0000;">Risk Warning:</span> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> is official partner of Las Palmas.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> is the trading name of <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, a Cyprus based Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">license number 266/15</a>.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> was awarded by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.';
        $body .= '<br><br>International Finance Magazine (IFM) awarded ForexMart as "Best New Broker Europe 2016"';
        $body .= '<br><br>© 2015 - 2016 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">';
        $body .= '</p>';
        $body .= '</div>';
        $body .= '<div  style="margin: 0;text-align: center;">';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/cysec.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/mifid.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/bafin.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/autorite.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/fca.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/consob.png"></a>';
        $body .= '</div>';
        $body .= '</div></div>';
        $body .= '<div style="width: 100%;padding: 7px 0px;background: #e7e7e7;text-align: center;">';
        $body .= '<a href="https://www.forexmart.com/unsubscribe/ref2/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Unsubscribe this email</a>';
        $body .= "</div>";
        return $body;
    }


    public static function NewestFoooterForMassMailerRussian($unsubscribe_key)
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;"><span style="font-weight: bold;color: #ff0000;">Предупреждение о рисках:</span> Торговля на Форекс имеет спекулятивный и сложный характер и может подойти не всем инвесторам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорекМарт, пожалуйста, оцените и примите <a href="www.forexmart.com/ru/risk-disclosure">риски</a>, связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.';
       
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> официальный Форекс Трейдинг партнер ФК Лас-Пальмас.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> является торговой маркой компании <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, кипрской инвестиционной компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">266/15</a>.';

        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> признан лучшим брокером Европы по итогам 2015 года и самым перспективным брокером Азии по итогам 2015 года по версии ShowFx World.';

        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> признан лучшим новым брокером Европы в 2016 году по версии Международного Финансового Журнала (International Finance Magazine).';
        $body .= '</p>';
        $body .= '</div>';

        $body .= '<div  style="margin: 0;text-align: center;">';
        $body .= '<a href="https://www.forexmart.com/cysec" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/cysec.png" alt="cysec"></a>';
        $body .= '<a href="http://ec.europa.eu/finance/securities/isd/mifid/index_en.htm" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/mifid.png" alt="mifid"></a>';
        $body .= '<a href="https://www.forexmart.com/bafin" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/bafin.png" alt="bafin"></a>';
        $body .= '<a href="https://www.forexmart.com/amf" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/autorite.png" alt="autorite"></a>';
        $body .= '<a href="https://www.forexmart.com/fca" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/fca.png" alt="fca"></a>';
        $body .= '<a href="https://www.forexmart.com/consob" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mailer/consob.png" alt="consob"></a>';
        $body .= '</div>';
        $body .= '</div></div>';
        $body .= '<div style="width: 100%;padding: 7px 0px;background: #e7e7e7;text-align: center;">';
        $body .= '<a href="https://www.forexmart.com/ru/unsubscribe/ref2/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Отписаться от рассылки</a>';
        $body .= "</div>";
        return $body;
    }


    public static function NewestFoooterForMassMailer2($unsubscribe_key)
    {
        $body = '';
        $body .= '            <table class="outer" align="center" style="border-spacing:0;font-family:"Open Sans";color:#333333;Margin:0 auto;width:100%;max-width:800px;" >      ';
        $body .= '                <tr>';
        $body .= '                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >';
        $body .= '                        <ul class="three-column-list" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                            <li style="margin:0;width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >OUR PARTNER</p>';
        $body .= '                                <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;" ><a href="https://www.forexmart.com/las-palmas" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/partner-laspalmas-logo.png" alt="" style="border-width:0;" ></a></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;" ><a href="https://www.forexmart.com/rpj-racing" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/partner-rpj-logo.png" alt="" style="border-width:0;" ></a></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;" ><a href="https://www.forexmart.com/HKM_Zvolen" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/partner-hkm-logo.png" alt="" style="border-width:0;" ></a></li>';
        $body .= '                                </ul>';
        $body .= '                            </li>';
        $body .= '                            <li style="margin:0; width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >FOLLOW US</p>';
        $body .= '                                <div style="   padding-top: 31px;   padding-bottom: 32px; padding-right:27.5px;padding-left:27.5px;" ><b>Get all the latest news</b>';
        $body .= '                                <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://www.facebook.com/ForexMart"><img alt="icon-facebook" src="https://www.forexmart.com/assets/images/massmail/icon-facebook.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://twitter.com/ForexMartPage"><img alt="icon-twitter" src="https://www.forexmart.com/assets/images/massmail/icon-twitter.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://plus.google.com/+Forexmartpage"><img alt="icon-googleplus" src="https://www.forexmart.com/assets/images/massmail/icon-googleplus.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                </ul class="sub-list"></div>';
        $body .= '                            </li>';
        $body .= '                            <li style="margin:0; width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >TRADE ANYWHERE</p>';
        $body .= '                                <div style="padding-top:8px;padding-bottom:8px;padding-right:0;padding-left:0;" >';
        $body .= '                                <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                    <li style="margin:0; display:inline-block;" ><a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img alt="google-play-footer" src="https://www.forexmart.com/assets/images/massmail/google-play-footer.png" style="border-width:0;" ></a></li>';
        $body .= '                                    <li style="margin:0; display:inline-block;" ><a href="https://appsto.re/ru/HB57gb.i" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img alt="app-store-footer" src="https://www.forexmart.com/assets/images/massmail/app-store-footer.png" style="border-width:0;" ></a></li>';
        $body .= '                                </ul>';
        $body .= '                                </div>';
        $body .= '                            </li>';
        $body .= '                        </ul>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '                <tr>';
        $body .= '                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >';
        $body .= '                        <table width="100%" style="border-spacing:0;font-family:"Open Sans";color:#333333;" >';
        $body .= '                        <tr>';
        $body .= '                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >';
        $body .= '                                <ul style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;background-color:transparent;background-image:url(https://www.forexmart.com/assets/images/massmail/header-bg.png);background-repeat:repeat;background-position:top left;background-attachment:scroll;border-top-width:1px;border-top-style:solid;border-top-color:#0f639d;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img alt="img_bafin" src="https://www.forexmart.com/assets/images/massmail/img_bafin.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img alt="img_cysec" src="https://www.forexmart.com/assets/images/massmail/img_cysec.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img alt="img_mifid" src="https://www.forexmart.com/assets/images/massmail/img_mifid.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img alt="img_autorite" src="https://www.forexmart.com/assets/images/massmail/img_autorite.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img alt="img_consob" src="https://www.forexmart.com/assets/images/massmail/img_consob.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img alt="img_fca" src="https://www.forexmart.com/assets/images/massmail/img_fca.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                </ul>';
        $body .= '                            </td>';
        $body .= '                        </tr>';
        $body .= '                        </table>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '                <tr>';
        $body .= '                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >';
        $body .= '                        <table width="100%" style="border-spacing:0;font-family:"Open Sans";color:#333333;" >';
        $body .= '                        <tr>';
        $body .= '                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b>ForexMart</b> was named by ShowFx World as the <b>"Best Broker in Europe 2015"</b> and <b>"Most Perspective Broker in Asia 2015"</b>.International Finance Magazine (IFM) awarded ForexMart <b>"Best New Broker Europe 2016"</b>.Global Business Outlook recognized ForexMart as the <b>"Best Forex Newcomer in 2016"</b></p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b>ForexMart</b> a trading name of <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" alt="ltd-small-black" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p>';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b>Risk Warning:</b> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.</p>';
        $body .= '                                <ul class="border-top" style="border-top-width:1px;border-top-style:solid;border-top-color:#bbb;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" >© 2015 - 2017 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" alt="ltd-small-black2" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10"></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" ><a href="https://www.forexmart.com/unsubscribe/ref2/' . $unsubscribe_key . '" style="color:#ee6a56;text-decoration:underline;" >Unsubscribe this email</a></li>';
        $body .= '                                </ul>';
        $body .= '                            </td>';
        $body .= '                        </tr>';
        $body .= '                        </table>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '            </table>';
        return $body;
    }

    public static function NewestFoooterForMassMailerRussian2($unsubscribe_key)
    {
        $body = '';
        $body .= '            <table class="outer" align="center" style="border-spacing:0;font-family:"Open Sans";color:#333333;Margin:0 auto;width:100%;max-width:800px;" >      ';
        $body .= '                <tr>';
        $body .= '                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >';
        $body .= '                        <ul class="three-column-list" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                            <li style="margin:0;width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >НАШИ ПАРТНЕРЫ</p>';
        $body .= '                                <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;" ><a href="https://www.forexmart.com/las-palmas" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/partner-laspalmas-logo.png" alt="" style="border-width:0;" ></a></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;" ><a href="https://www.forexmart.com/rpj-racing" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/partner-rpj-logo.png" alt="" style="border-width:0;" ></a></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;" ><a href="https://www.forexmart.com/HKM_Zvolen" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/partner-hkm-logo.png" alt="" style="border-width:0;" ></a></li>';
        $body .= '                                </ul>';
        $body .= '                            </li>';
        $body .= '                            <li style="margin:0; width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >ПОДПИСЫВАЙТЕСЬ НА НАС</p>';
        $body .= '                                <div style="   padding-top: 25px;   padding-bottom:25px; padding-right:27.5px;padding-left:27.5px;" ><b>Следите за последними новостями</b>';
        $body .= '                                <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://www.facebook.com/ForexMart"><img src="https://www.forexmart.com/assets/images/massmail/icon-facebook.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://twitter.com/ForexMartPage"><img src="https://www.forexmart.com/assets/images/massmail/icon-twitter.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://plus.google.com/+Forexmartpage"><img src="https://www.forexmart.com/assets/images/massmail/icon-googleplus.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                </ul class="sub-list"></div>';
        $body .= '                            </li>';
        $body .= '                            <li style="margin:0; width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >ТОРГУЙТЕ ГДЕ УДОБНО</p>';
        $body .= '                                <div style="padding-top:8px;padding-bottom:8px;padding-right:0;padding-left:0;" >';
        $body .= '                                <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                    <li style="margin:0; display:inline-block;" ><a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/google-play-footer.png" style="border-width:0;" ></a></li>';
        $body .= '                                    <li style="margin:0; display:inline-block;" ><a href="https://appsto.re/ru/HB57gb.i" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;" ><img src="https://www.forexmart.com/assets/images/massmail/app-store-footer.png" style="border-width:0;" ></a></li>';
        $body .= '                                </ul>';
        $body .= '                                </div>';
        $body .= '                            </li>';
        $body .= '                        </ul>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '                <tr>';
        $body .= '                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >';
        $body .= '                        <table width="100%" style="border-spacing:0;font-family:"Open Sans";color:#333333;" >';
        $body .= '                        <tr>';
        $body .= '                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >';
        $body .= '                                <ul style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;background-color:transparent;background-image:url(https://www.forexmart.com/assets/images/massmail/header-bg.png);background-repeat:repeat;background-position:top left;background-attachment:scroll;border-top-width:1px;border-top-style:solid;border-top-color:#0f639d;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img  src="https://www.forexmart.com/assets/images/massmail/img_bafin.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img  src="https://www.forexmart.com/assets/images/massmail/img_cysec.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img  src="https://www.forexmart.com/assets/images/massmail/img_mifid.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img  src="https://www.forexmart.com/assets/images/massmail/img_autorite.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img  src="https://www.forexmart.com/assets/images/massmail/img_consob.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;" ><img  src="https://www.forexmart.com/assets/images/massmail/img_fca.png" style="height:auto;width:96px;border-width:0;" ></li>';
        $body .= '                                </ul>';
        $body .= '                            </td>';
        $body .= '                        </tr>';
        $body .= '                        </table>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '                <tr>';
        $body .= '                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >';
        $body .= '                        <table width="100%" style="border-spacing:0;font-family:"Open Sans";color:#333333;" >';
        $body .= '                        <tr>';
        $body .= '                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >';

        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b> признан лучшим брокером Европы по итогам 2015 года и самым перспективным брокером Азии по итогам 2015 года по версии ShowFx World.</p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b>  признан лучшим новым брокером Европы в 2016 году по версии Международного Финансового Журнала (International Finance Magazine).</p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b> победил в номинации Лучший Начинающий Брокер 2016 ("Best Forex Newcomer in 2016") по версии Global Business Outlook.</p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b> является торговой маркой компании <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, кипрской инвестиционной компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">266/15</a>.';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #ff0000;">Предупреждение о рисках: </span></b>  Торговля на Форекс имеет спекулятивный и сложный характер и может подойти не всем инвесторам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорекМарт, пожалуйста, оцените и примите <a href="www.forexmart.com/ru/risk-disclosure">риски</a>, связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.</p>';
        $body .= '                                <ul class="border-top" style="border-top-width:1px;border-top-style:solid;border-top-color:#bbb;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" >© 2015 - 2017 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10"></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" ><a href="https://www.forexmart.com/unsubscribe/ref2/' . $unsubscribe_key . '" style="color:#ee6a56;text-decoration:underline;" >Отписаться от рассылки</a></li>';
        $body .= '                                </ul>';
        $body .= '                            </td>';
        $body .= '                        </tr>';
        $body .= '                        </table>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '            </table>';
        return $body;
    }


public static function buttons_russian()
{
    return 'ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.<br> <div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Внести депозит</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div>';
}
public static function buttons()
{
    return 'ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering. <br> <br> <div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;text-align:center;">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Fund my account</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> ';
}
    // official header and footer end 




    public static function kievReminder($to, $unsubscribe){
            $body = self::NewestHeader();
            $body .= '<div style="position: relative;">';
            $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/hyatthotel_event.png">';
            $body .= '</div><br>';
            $body .= '<div class="main-bg-body" style="line-height: 1.4;">Dear Client,<br><p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">We would like to remind you of the upcoming ShowFx World Expo this coming December 17-18, 2016 at the Hyatt Regency in Kiev, Ukraine. Get to learn from top trading experts in CIS through various workshops and seminars, get tips from leading trading figureheads in the international scene, and win prizes from raffle contests and giveaways while enjoying the sights and sounds of Ukraine.&nbsp;<br><br>ForexMart representatives will also be more than happy to personally invite and meet up with interested clients, and possibly discuss information regarding the latest developments in ForexMart.&nbsp;<br><br>Admission to the ShowFx World Expo is absolutely free! See you in Ukraine!<br><br>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p><br>        <div class="las-palmas-buttons" style="display:block;width:100%;text-align:center">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> <span style="color: rgb(29, 29, 29);"><br></span><span style="color: rgb(29, 29, 29);">Warmest regards,</span><span style="color: rgb(29, 29, 29);"><br></span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span><br></div>';
            $footer = self::NewestFoooterForMassMailer($unsubscribe);
            $body .= $footer;
            self::massMailer($to, 'support@forexmart.com', $body, 'ForexMart Takes Part in the ShowFx World Expo in Kiev');
            echo $body;
    }

    public static function kievReminderPartner($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/hyatthotel_event.png">';
        $body .= '</div><br>';
        $body .= '<div class="main-bg-body" style="line-height: 1.4;">Dear Partner,<br><p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">ForexMart would like to remind you to take part in the ShowFx World Expo at the Hyatt Regency in Kiev, Ukraine this December 17-18, 2016. ShowFx World Expo attendees can enjoy and experience Ukraine while learning personal finance management from one of the best financial experts, attend and learn from trading workshops headed by some of the world&#39;s top-notch trading experts, and win prizes from raffle contests and giveaways from the expo.&nbsp;<br><br>Our representatives will also be happy to invite our partners personally and discuss the most recent updates and developments inside ForexMart.&nbsp;<br><br>The admission to the ShowFx World Expo is free. We hope to see you in Ukraine!</span><br><br>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p><br>        <div class="las-palmas-buttons" style="display:block;width:100%;text-align:center">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> <span style="color: rgb(29, 29, 29);"><br></span><span style="color: rgb(29, 29, 29);">Warmest regards,</span><span style="color: rgb(29, 29, 29);"><br></span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span><br></div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ForexMart Takes Part in the ShowFx World Expo in Kiev');
        echo $body;
    }

    public static function kievReminder_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/hyatthotel_event.png">';
        $body .= '</div><br>';
        $body .= '<span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Уважаемый Клиент!</span>,<br><p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">С радостью напоминаем Вам о предстоящей выставке ShowFx World Expo, которая пройдет с 17 по 18 декабря 2016 года в отеле Hyatt Regency в Киеве, Украина. У Вас будет возможность пройти обучение на различных мастер-классах и семинарах у главных экспертов СНГ, узнать секреты ведущих профессионалов международного уровня и выиграть призы в конкурсах и викторинах, а так же получить удовольствие от осмотра достопримечательностей Украины.&nbsp;</span><br style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;"><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Представители Компании ФорексМарт будут рады личному общению с заинтересованными клиентами и возможности обсудить последние достижения Компании.&nbsp;</span><br><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Вход на выставку свободный! Ждем Вас в Украине!</span><br><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</span><br></p><div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">C наилучшими пожеланиями,</span><br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда Форексмарт<br></span></label><br>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ФорексМарт примет участие в выставке ShowFx World в Киеве');
        echo $body;
    }



    public static function kievReminderPartner_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/hyatthotel_event.png">';
        $body .= '</div><br>';
        $body .= 'Уважаемый Партнер,<br><p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">Компания ФорексМарт с радостью напоминает Вам о возможности принять участие в выставке ShowFx World Expo, которая пройдет 17-18 декабря этого года в отеле Hyatt Regency в Киеве, Украина. Участники ShowFx World Expo смогут совместить осмотр достопримечательностей с обучением управлению личными финансовыми средствами у одних из лучших финансовых экспертов, получить навыки торговли, приняв участие в семинарах, проводимых высококлассными специалистами мирового уровня, и, кроме того, выиграть на выставке призы в конкурсах и викторинах.&nbsp;<br><br>Представители компании с удовольствием проведут личные встречи с Партнерами, на которых можно будет обсудить самые последние новинки и достижения ФорексМарт.&nbsp;<br><br>Вход на выставку ShowFx World Expo свободный. Будем рады видеть Вас в Украине!<br><br>ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.<div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">C наилучшими пожеланиями,<br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда Форексмарт<br></span></label><br>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ФорексМарт примет участие в выставке ShowFx World в Киеве');
        echo $body;
    }



    public static function kievReminderTrader_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/hyatthotel_event.png">';
        $body .= '</div><br>';
        $body .= '<span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Уважаемый трейдер!</span><br><p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">С радостью напоминаем Вам о предстоящей выставке ShowFx World Expo, которая пройдет с 17 по 18 декабря 2016 года в отеле Hyatt Regency в Киеве, Украина. У Вас будет возможность пройти обучение на различных мастер-классах и семинарах у главных экспертов СНГ, узнать секреты ведущих профессионалов международного уровня и выиграть призы в конкурсах и викторинах, а так же получить удовольствие от осмотра достопримечательностей Украины.&nbsp;</span><br style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;"><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Представители Компании ФорексМарт будут рады личному общению с заинтересованными клиентами и возможности обсудить последние достижения Компании.&nbsp;</span><br><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Вход на выставку свободный! Ждем Вас в Украине!</span><br><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</span><br></p><div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">C наилучшими пожеланиями,</span><br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда Форексмарт<br></span></label><br>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ФорексМарт примет участие в выставке ShowFx World в Киеве');
        echo $body;
    }

      public static function kievReminderTrader($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/hyatthotel_event.png">';
        $body .= '</div><br>';
        $body .= '<div class="main-bg-body" style="line-height: 1.4;">Dear Trader,<br><p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">We would like to remind you of the upcoming ShowFx World Expo this coming December 17-18, 2016 at the Hyatt Regency in Kiev, Ukraine. Get to learn from top trading experts in CIS through various workshops and seminars, get tips from leading trading figureheads in the international scene, and win prizes from raffle contests and giveaways while enjoying the sights and sounds of Ukraine.&nbsp;<br><br>ForexMart representatives will also be more than happy to personally invite and meet up with interested clients, and possibly discuss information regarding the latest developments in ForexMart.&nbsp;<br><br>Admission to the ShowFx World Expo is absolutely free! See you in Ukraine!<br><br>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p><br>        <div class="las-palmas-buttons" style="display:block;width:100%;text-align:center">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> <span style="color: rgb(29, 29, 29);"><br></span><span style="color: rgb(29, 29, 29);">Warmest regards,</span><span style="color: rgb(29, 29, 29);"><br></span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span><br></div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ForexMart Takes Part in the ShowFx World Expo in Kiev');
        echo $body;
    }

    public static function webTerminal($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/web-terminal2.png">';
        $body .= '</div><br>';
        $body .= '<div class="main-bg-body" style="line-height: 1.4;">Dear Trader,<br>';

        $body .= '<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">Greetings!<br><br>';

        $body .= 'We would like to announce that we will be launching a Web Terminal! With the ForexMart web terminal, you can now track your charts, manage your trades, and place multiple trades directly on the ForexMart website without having to install any software. With our Web Terminal, you can also customize your trading instruments according to your wish.<br><br>';

        $body .= 'Get to enjoy hassle-free trading transactions by signing up to our web terminal now. You can view the features of the web terminal by clicking <a href="https://webtrader.forexmart.com/login" style="color: #2988ca;">here</a>.<br><br> ';

        $body .= 'We wish you the best of luck on your trading!<br><br>';

        $body .= 'ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p><br>        <div class="las-palmas-buttons" style="display:block;width:100%;text-align:center">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> <span style="color: rgb(29, 29, 29);"><br></span><span style="color: rgb(29, 29, 29);">Kind regards,</span><span style="color: rgb(29, 29, 29);"><br></span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span><br></div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'Comfortable trading with ForexMart Web Terminal');
    }

    public static function webTerminal_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/web-terminal2-russian.png">';
        $body .= '</div><br>';
        $body .= '<span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Здравствуйте!</span><br>';

        $body .= '<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Уважаемый трейдер!<br><br>';

        $body .= 'Рады вам сообщить, что теперь, в ФорексМарт вы можете совершать торговые операции при помощи веб-терминала. Используйте любой браузер и практически любое устройство. Попробуйте, это безопасно, легко и удобно!&nbsp;</span><br>';

        $body .= '<style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;"><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">В веб-терминале можно открывать любые типы ордеров, выбирать любой из девяти доступных таймфреймов, совершать торговые операции с популярными валютными и сырьевыми торговыми инструментами, отслеживать котировки валют в реальном времени.&nbsp;</span><br><br>';

        $body .= '<span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Если у вас нет реального торгового счета, это отличный повод его создать. Выбирайте удобный способ торговли на рынке Форекс и оставайтесь на рынке 24 часа в сутки.<br><br>';

        $body .= 'В случае возникновения вопросов, обращайтесь в нашу службу поддержки, а также по электронному адресу <a href="mailto:support@forexmart.com">support@forexmart.com</a>. Наши специалисты всегда рады помочь вам в любой возникшей ситуации и ответить на все интересующие вопросы.</span><br><br>';

        $body .= '<span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</span><br></p><div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">C наилучшими пожеланиями,</span><br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда Форексмарт<br></span></label><br>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'Удобная торговля с веб-терминалом ФорексМарт');
    }

    public static function christmasMailer($to, $unsubscribe,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/christmas_text2.png">';
        $body .= '</div>';
        $body .= '<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">Dear '.$name.'!</p>
<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">ForexMart wishes you Merry Christmas and Happy New Year!&nbsp;<br><br>This past year our profitable work has brought great results. Many innovations have been launched: new services, upgraded products such as the Bitcoin and Ruble offering, the ForexMart Web Terminal, Welcome Bonuses and much more. We have always tried to do everything possible to create the most comfortable and efficient conditions of trading.&nbsp;<br><br>However, our growth and development does not end there. This year was very significant for us with the establishing of important partnerships in the fields beyond forex. Our new collaborations with the legendary hockey team HKM «Zvolen» and the celebrated rocker and racer, RPJ Racing became a constitutive stage in achievement of many goals.&nbsp;<br><br>Moreover, ForexMart’s efforts have been recognized in the Global Business Outlook Awards as «The Best Forex Newcomer 2016» and in the International Finance Magazine Awards as the «Best New Broker in Europe 2016» proving that we are a company to look out for.&nbsp;<br><br>The year 2016 has been prosperous and eventful mostly because of you. So here’s a big thank you, from ForexMart. It’s a great honor to be your partner in our mutual goal of achieving financial success. We wish you good luck, financial stability and prosperity in New Year!</p><br>
ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.<br>     <br>   <div class="las-palmas-buttons" style="display:block;width:100%;text-align:center">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> <span style="color: rgb(29, 29, 29);"></span>
<label style="display: block; font-weight: normal; color: rgb(29, 29, 29); "><br>Best wishes in the coming 2017,<span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span></label>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ForexMart Wishes You Happy Holidays!');
        echo $body;
    }
    
        public static function christmasMailer_ru($to, $unsubscribe,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/christmas_russians.png">';
        $body .= '</div>';
        $body .= '<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">Уважаемые '.$name.'!</p>
<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;"></p>
<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">Желаем вам счастливого Нового Года и Рождества!&nbsp;<br><br>Уходящий год нашего эффективного взаимодействия и плодотворной работы принес отличные результаты. О развитии и совершенствовании наших сервисов говорит само за себя получение международных наград «Best New Broker Europe 2016» и «Best Forex Newcomer 2016». Наши новые партнерские связи с ХК «Зволен» и RPJ Racing стали серьезной ступенью для достижения многих поставленных целей. ФорексМарт благодарит вас за оказанное доверие и с радостью ждет дальнейшего сотрудничества!&nbsp;<br><br>В новом году Огненного Петуха мы желаем вам успехов и удачи в торговле, больших перспектив развития в Форекс сфере и легких решений при выполнении любых задач! Пусть новый год пройдет под девизом стабильности и процветания и принесет вам максимальную прибыль! <br><br>А мы, компания ФорексМарт, с удовольствие поможем вам в этом, делая все возможное для создания наиболее комфортных и выгодных условий торговли!<br><br>
<span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</span><br></p><div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29);"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">
<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;"><label style="display: block; font-weight: normal; padding-top: 20px; text-align: start;">С наилучшими пожеланиями в новом 2017 году,<span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">Команда ФорексМарт</span></label></p>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::massMailer($to, 'support@forexmart.com', $body, 'ФорексМарт поздравляет вас с наступающими праздниками!');
        echo $body;
    }


    public static function mobile_platform($to,$unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mobile-platform3.png">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear Client,</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "As part of ForexMart goals to look for ways of improvement regarding our services, we provide easier methods for you to be updated with latest trends and technologies. We are glad to inform you that ForexMart Application is now available to download for both iOS and Android platforms. <br><br>";

        $body .= "We are now launching an application for mobile platform. It works just like any other application you can get from App store for iOS or Play store for Android. This way you can now trade anytime and anywhere with just a click from your fingertips through your smart phones. <br><br>";

        $body .= "ForexMart platform is still accessible through your PC. For further inquiries regarding this application, you may contact our customer support here <a href='mailto:support@forexmart.com'>support@forexmart.com</a> <br><br>";



        $body .= '<div style="display:block; width:100%; text-align:center;"><a href="https://appsto.re/ru/HB57gb.i"><img src="https://www.forexmart.com/assets/images/app-store.png" style="height:50px; width:177px; display:imline-block; margin:0 10px; vertical-align:middle;"></a> <a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader"><img src="https://www.forexmart.com/assets/images/google-play.png" style="height:50px; width:177px; display:inline-block; margin:5px 10px;vertical-align:middle;"></a></div>';

        $body .= '<p>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p>';

        $body .= '<div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;text-align:center;">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div>';

        $body .= '</p>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Sincerely,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::NewestMailerSchedulerSender($to, 'ForexMart Mobile Platform for your comfortable trading', $body);
        // echo $body;
        return $sender;
    }

    public static function mobile_platform_russian($to,$unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mobile-platform_russian.png">';
        $body .= '</div>';
        $body .= '<div style="min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый Клиент,</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Компания ФорексМарт выпустила приложение для мобильных устройств iOs и Android. Теперь вы можете совершать торговые операции со своих телефонов и планшетных компьютеров в любом удобном для вас месте. <br><br>";

        $body .= "В мобильном приложении доступны привычные типы ордеров, сигналы индикаторов и девять различных таймфреймов. Интуитивный интерфейс и быстрая скорость работы позволят вам отслеживать изменения котировок в реальном времени. Вы не упустите ни одного важного или непредвиденного события на валютном рынке. <br><br>";

        $body .= "Откройте реальный торговый счет, чтобы воспользоваться всеми возможностями торговли на рынке форекс 24 часа в сутки. Скачайте бесплатно мобильное приложение.<br><br>";

        $body .= "В случае возникновения вопросов, обращайтесь в службу поддержки, а также по электронному адресу <a href='mailto:support@forexmart.com'>support@forexmart.com</a>. Наши специалисты всегда рады помочь вам в любой возникшей ситуации и ответить на все интересующие вопросы.<br><br>";

        $body .= '<div style="display:block; width:100%; text-align:center;"><a href="https://appsto.re/ru/HB57gb.i"><img src="https://www.forexmart.com/assets/images/app-store-russian.png" style="height:50px; width:177px; display:imline-block; margin:0 10px; vertical-align:middle;"></a> <a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader"><img src="https://www.forexmart.com/assets/images/google-play-russian.png" style="height:50px; width:177px; display:inline-block; margin:5px 10px;vertical-align:middle;"></a></div>';

        $body .= '</p>';

        $body .= '<div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.<br><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С Уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        // echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'Мобильная платформа ФорексМарт для удобства вашей торговли', $body);
        return $sender;
    }
    

    public static function new_comer($to,$unsubscribe_key,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_bestnewcomer_img.png">';
        $body .= '</div>';
        $body .= '<div style="min-height: 312px;">';
        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый Клиент,</label>';
        $body .= '<p class="reset-p" style="color: rgb(29, 29, 29); text-align: justify;">Dear '.$name.',&nbsp;<br><br>We are pleased to announce that ForexMart has been recognized as the&nbsp;<span style="font-weight: 700;">Best Forex Newcomer 2016</span>&nbsp;in the latest Global Business Outlook awards ceremony.&nbsp;<br><br>Global Business Outlook is an award-giving body based in the United Kingdom that recognizes and rewards businesses for their excellence across all sectors. ForexMart is the chosen business among hundreds of new and upcoming brokerages to receive this prestigious award.&nbsp;<br><br>The award that we have received is dedicated to you, our esteemed clients, as a promise to continue providing outstanding services as we continue to expand our business to more countries in Europe and Asia.&nbsp;<br><br>We will keep using only the best trading tools including MetaTrader 4 platform for secure and transparent transactions. After all, your financial success is our top priority. We are honored to be your brokerage. Thank you for your patronage!</p>';
        $body .= self::buttons();
        $footer = self::NewestFoooterForMassMailer($unsubscribe_key);
        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'ForexMart - Best Forex Newcomer 2016', $body);
        return $sender;
    }

    public static function new_comer_russian($to,$unsubscribe_key,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/periodic-mailing_bestnewcomer_img_russian.png">';
        $body .= '</div>';
        $body .= '<div style="min-height: 312px;">';
        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый Клиент,</label>';
        $body .= '<p class="reset-p" style="color: rgb(29, 29, 29); text-align: justify;">Уважаемые '.$name.',&nbsp;<br><br>Мы рады сообщить вам, что компания ФорексМарт была признана победителем в номинации «Best Forex Newcomer 2016» по версии Global Business Outlook на последней церемонии вручения наград.<br><br> Global Business Outlook – это всемирно известное британское деловое издание, отмечающее успехи и достижения различных компаний во всех областях экономики, бизнеса и финансов. Получение награды «Best Forex Newcomer 2016» выгодно выделяет ФорексМарт из сотен других новых и развивающихся брокерских компаний. &nbsp;<br><br> Мы считаем, что компания ФорексМарт получила эту знаменательную награду, в первую очередь, благодаря вам, нашим клиентам. Мы рассматриваем ее как стимул к дальнейшему развитию предоставляемых услуг и сервисов и расширению нашего бизнеса на большее количество стран Европы и Азии. Ваш финансовый успех – это наша приоритетная цель. &nbsp;<br><br> Оставайтесь с нами, впереди только лучшее!</p>';
        $body .= self::buttons_russian();
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe_key);
        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to,  'ФорексМарт - Лучший Молодой Брокер 2016', $body);
        return $sender;
    }


    public static function analytical_reviews_partner($to,$unsubscribe_key,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img.png">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ForexMart '.$name.',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Greetings! <br><br>";

        $body .= "ForexMart now features an Analytical Reviews Page! It contains important analytical tools, such as Forex market reviews, forecast articles, and Forex analysis articles which are sourced by our professional analysts from significant economic events happening in the financial market. Using ForexMart’s analytical reviews, clients can improve the effectiveness of trading decisions and make more successful deals. <br><br>";

        $body .= "If you want to explore ForexMart’s Analytical Reviews Page, kindly click on this link: <a href='https://www.forexmart.com/analytical-reviews'>https://www.forexmart.com/analytical-reviews </a> <br><br>";

        $body .= 'Thank you so much, and we wish you a successful trading!<br><br>';
        $body .= self::buttons();

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Kind Regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer($unsubscribe_key);

        $body .= $footer;
        $sender = self::NewestMailerSchedulerSender($to, "Have a successful trading experience through ForexMart's Analytical Reviews Page", $body);
        echo $body;
        return $sender;
    }


    public static function analytical_reviews_client($to,$unsubscribe_key,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img.png">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ForexMart '.$name.',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Greetings! <br><br>";

        $body .= "ForexMart now features an Analytical Reviews Page! It contains important analytical tools, such as Forex market reviews, forecast articles, and Forex analysis articles which are sourced by our professional analysts from significant economic events happening in the financial market. Using ForexMart’s analytical reviews, clients can improve the effectiveness of trading decisions and make more successful deals. <br><br>";

        $body .= "For more details on the Analytical Reviews Page, kindly click on this link here: <a href='https://www.forexmart.com/analytical-reviews'>https://www.forexmart.com/analytical-reviews </a> <br><br>";

        $body .= 'Thank you so much, and may you have a successful trading experience! <br><br>';
        $body .= self::buttons();

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Kind Regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer($unsubscribe_key);

        $body .= $footer;
        $sender = self::NewestMailerSchedulerSender($to, "Have a successful trading experience through ForexMart's Analytical Reviews Page", $body);
        echo $body;
        return $sender;
    }

    public static function analytical_reviews_client_russian($to,$unsubscribe_key,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img-russian.png">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый '.$name.',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Здравствуйте! <br><br>";

        $body .= "Мы рады сообщить, что на сайте ФорексМарт запущен новый раздел «Аналитические обзоры». В данном разделе будут представлены основные аналитические инструменты технического и фундаментального анализа, обзоры рынка Форекс и прогнозы, основанные на важных экономических событиях в финансовой сфере. Эта информация поможет Вам улучшить принимаемые торговые решения и поспособствует повышению эффективности торговли. <br><br>";

        $body .= "Если Вы хотите ознакомиться с разделом Аналитических обзоров от ФорексМарт, пожалуйста, пройдите по данной ссылке: <a href='https://www.forexmart.com/ru/analytical-reviews'>https://www.forexmart.com/ru/analytical-reviews </a> <br><br>";

        $body .= 'Спасибо, желаем Вам успешной торговли! <br><br>';
        $body .= self::buttons_russian();

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe_key);

        $body .= $footer;
        $sender = self::NewestMailerSchedulerSender($to, "Добейтесь успехов в торговле с аналитикой от ФорексМарт", $body);
        echo $body;
        return $sender;
    }


    public static function analytical_reviews_partner_russian($to,$unsubscribe_key,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img-russian.png">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый '.$name.',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Здравствуйте! <br><br>";

        $body .= "Мы рады сообщить, что на сайте ФорексМарт запущен новый раздел «Аналитические обзоры». В данном разделе будут представлены основные аналитические инструменты технического и фундаментального анализа, обзоры рынка Форекс и прогнозы, основанные на важных экономических событиях в финансовой сфере. Эта информация поможет Вам улучшить принимаемые торговые решения и поспособствует повышению эффективности торговли. <br><br>";

        $body .= "Если Вы хотите ознакомиться с разделом Аналитических обзоров от ФорексМарт, пожалуйста, пройдите по данной ссылке: <a href='https://www.forexmart.com/ru/analytical-reviews'>https://www.forexmart.com/ru/analytical-reviews </a> <br><br>";

        $body .= 'Спасибо, желаем Вам успешной торговли! <br><br>';
        $body .= self::buttons_russian();

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe_key);

        $body .= $footer;
        $sender = self::NewestMailerSchedulerSender($to, "Добейтесь успехов в торговле с аналитикой от ФорексМарт", $body);
        echo $body;
        return $sender;
    }



    public static function partnerHKM($to,$unsubscribe_key, $name){
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/hkm-layout_eng.gif" alt="hkm_Zvolen"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        $body .= "ForexMart would like to introduce our our newest partner, HKM Zvolen.<br><br>";

        $body .= "HKM Zvolen, also known as Hokejový Klub mesta Zvolen, is one of the most successful hockey teams of Slovakia with a rich history that began in 1927. The Slovak legends have two national league championship under its belt and it has won the IIHF Continental Cup in 2005. The professional hockey club, famous for their exceptional performance and ardent fans, is our newest partner in the growing family of ForexMart. <br><br>";

        $body .= "Going into a partnership with such a legendary team opens opportunities for us to expand our reach and ideals beyond the financial industry. We have chosen HKM Zvolen as a partner because they are a strong sports team that reflects the passion and drive of ForexMart. Rest assured, clients will get to enjoy future collaborations, sponsorships, and promotions with hockey games this season. <br><br>";

        $body .= "Get to know more about HKM Zvolen by following us on social media so you can get the latest updates on us and our activities. We will continue to create new connections so that we can keep on delivering the service that you deserve. Expect great things ahead.<br><br>";

        $body .= self::buttons();
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'Like hockey with ForexMart', $body);
        return $sender;
    }

    public static function partnerHKMRussian($to, $unsubscribe_key, $name){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/hkm-layout_rus.gif" alt="hkm_Zvolen"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';


        $body .= "Рады вам сообщить о нашем новом партнерстве со словацким хоккейным клубом “Зволен”. <br><br>";

        $body .= "“Зволен”- один из известнейших хоккейных клубов Европы, с конца девяностых является постоянным участником словацкой экстралиги. В состав команды всегда входили легендарные хоккеисты, а также молодые и перспективные игроки, благодаря чему клуб смог стать чемпионом Словакии по хоккею в 2000 и 2016 году. <br><br>";

        $body .= "ФорексМарт надеется, что новое сотрудничество будет взаимовыгодным и принесет нам интересный опыт, а хоккейный клуб сможет и дальше завоевывать титулы.<br><br>";

        $body .= "Мы обеспечиваем профессиональную работу с партнерами на всех уровнях.<br><br>";


        $body .= self::buttons_russian();
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'Любите хоккей с ФорексМарт', $body);
        return $sender;
    }



    public static function fiftyPercentBonus_russian($to,$unsubscribe_key, $name){
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img-russian.png" alt="mailing_fiftypercentbonus_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';

        $body .= "<br>Вы можете получить максимальную отдачу от вашего капитала и еще больше прибыли, используя 50% бонус от ФорексМарт. В рамках акции на Ваш счет будет зачислено дополнительно 50% от общей суммы депозита. Так, всего в один клик, Вы сможете получить дополнительные $50, пополняя счет на $100. Бонус 50% от ФорексМарт доступен для депозитов любого размера. Чтобы узнать более подробную информацию о бонусе, нажмите на кнопку ниже.";
        $body .= '<div  style="background: rgb(41, 136, 202); display: table; margin: 24.5px auto; cursor: pointer; transition: all 0.2s linear; color: rgb(51, 51, 51);">
                <a href="https://www.forexmart.com/fifty-percent-bonus" style="padding: 15px;    text-decoration: none;    border-bottom: 5px solid #067acc; color: rgb(255, 255, 255); font-size: 16px; text-transform: uppercase; display: block;">ПОЛУЧИТЬ БОНУС!</a></div>';
        $body .= self::buttons_russian();
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailerRussian2($unsubscribe_key);
        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'Получай 50% бонус на каждый депозит!', $body);
        return $sender;
    }


    public static function fiftyPercentBonus($to,$unsubscribe_key, $name){
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img.png" alt="mailing_fiftypercentbonus_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        $body .= "<br>With ForexMart, you can get the most out of your capital and gain more profit by availing of ForexMart’s 50% Bonus offer. You can get as much as 50% of the total money you deposited if you do it in our system. With just one click, you can instantly get an additional $50 once you deposit $100 in your account. A 50% bonus is automatically available for every deposit made. To know more about our bonus offer, 
                <a href='https://www.forexmart.com/fifty-percent-bonus'>click here.<br>";
        $body .= '<div  style="background: rgb(41, 136, 202); display: table; margin: 24.5px auto; cursor: pointer; transition: all 0.2s linear; color: rgb(51, 51, 51);">
                <a href="https://www.forexmart.com/fifty-percent-bonus" style="color: rgb(255, 255, 255);     padding: 15px;    text-decoration: none;    border-bottom: 5px solid #067acc; font-size: 16px; text-transform: uppercase; display: block;">GET BONUS HERE!</a></div>';
        $body .= self::buttons();
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer2($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'Get 50% Bonus in every deposit!', $body);
        return $sender;
    }







 public function tradeOfferMail($to, $unsubscribe,$res){
        $body = '<html> <head><style></style><body style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px;line-height: 1.42857143; color: #333;background-color: #fff;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;height: auto;">';
        $body .= '<div style="margin: 0 auto; width:100%;padding: 0!important">';
        $body .= '<div style="background:url(https://www.forexmart.com/assets/images/header-bg.png); width:100%!important; margin-top:2px; ;border-top: 3px solid #EAEAEA;">';
        $body .= '<img alt="logo-mailing_v2" style="width:100%!important;" alt="header" src="https://www.forexmart.com/assets/images/logo-mailing_v2.png">';
        $body .= '</div>';
        $body .= '<div class="wrapper-container" style="max-width:800px; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;height: auto;">';
        $body .= '<div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;padding: 0!important;width: 100%;float: left;position: relative;min-height: 1px;">';
        $body .= '<div class="wrapper-header-two" style="background: url(images/header-bg.png);font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;">';
        $body .= '</div>';
        $body .= '<div class="wrapper-body trade-offer-bg" style="background-size: cover; background: url(https://www.forexmart.com/assets/images/trade-offer-bg.png) no-repeat top / auto auto;  padding: 20px 0;">';
        $body .= '<div class="initial-trade-span" style="    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;">';
        $body .= '<span style="    color: #2988ca;    font-size: 18px;    text-align: center;    display: block;    box-sizing: border-box;    line-height: 1.42857143;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;">';
        $body .= 'Most Popular Symbol this Week';
        $body .= '</span>';
        $body .= '</div>';
        $body .= '<div class="first-trade-span" style="    font-size: 40px;    font-weight: bold;    text-align: center;    margin: 0 auto;    display: table;">';
        $body .= '' . $res['MostIncreasingPopularSymbol'] . '';
        $body .= '<a style="display: inline-block;    width: 32px;    height: 32px;    text-decoration: underline;    color: #2988ca;    font-family: " helvetica="" font-size:="" line-height:="" box-sizing:=""><img alt="arrow" src="https://www.forexmart.com/assets/images/arrow.png"></a>';
        $body .= '' . $res['MostIncreasingPopularSymbolPercentage'] . '%';
        $body .= '</div>';
        $body .= '<div class="second-trade-span" style="text-align: center;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;box-sizing: border-box;">';
        $body .= '<span style="box-sizing: border-box;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;text-align: center;box-sizing: border-box;">';
        $body .= '' . $res['FromDate'] . '';
        $body .= '</span>';
        $body .= '</div>';
        $body .= '<div class="hidden-trade-span" style="text-align: center;margin: 0 auto;display: none;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;box-sizing: border-box;-webkit-tap-highlight-color: rgba(0,0,0,0);">';
        $body .= '<span style="margin-top: 30px;color: #2988caleft: 0;font-size: 18px;z-index: 1000;right: 0;display: block;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height: 1.42857143;box-sizing: border-box;">';
        $body .= '<q style="    margin-top: 30px;    color: #2988ca;     left: 0;    font-size: 18px;    z-index: 1000;    right: 0;    display: block;    text-align: center;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    line-height: 1.42857143;    box-sizing: border-box;">';
        $body .= 'Exceptional movements are great <br>trading opportunities! ';
        $body .= '</q>';
        $body .= '</span>';
        $body .= '</div>';
        $body .= '<div class="third-trade-span" style="    display: table;    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;    box-sizing: border-box;">';
        $body .= '<span style="    color: #2988ca;     left: 0;    right: 0;    font-size: 18px;    display: block;">';
        $body .= '<q style="    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 18px;    line-height: 1.42857143;    color: #2988ca;">Catch the market tone and stay in trend</q>';
        $body .= '</span>';
        $body .= '</div>';
        $body .= '<div class="fourth-trade-span" style="margin-top: 396px;text-align: center;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;/* margin: 0 auto; */color: #333;">';
        $body .= '<div style="display:table; margin:0 auto;">';
        $body .= '<div class="buy-trade-button-parent" style="margin: 2px;display: table;     display: inline-block; border: 1px solid #29a643;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">';
        $body .= '<a href=" https://webtrader.forexmart.com/login" class="buy-trade-button" style="      display: inline-block;  margin: 2px;    color: #fff;    padding: 10px 34px;    background: #29a643;    border: 0;    transition: all 0.2s linear;    font-family: inherit;    font-size: inherit;    line-height: inherit;     text-decoration: none;">';
        $body .= '<span style="    display: block;    font-size: 25px;">';
        $body .= 'Buy';
        $body .= '</span>';
        $body .= '<label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">';
        $body .= 'If you believe ' . $res['MostIncreasingPopularSymbol'] . ' price will climb up.';
        $body .= '</label>';
        $body .= '</a>';
        $body .= '</div>';
        $body .= '<div class="sell-trade-button-parent" style="border: 1px solid #cf2323;margin: 2px;display: table;     display: inline-block; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">';
        $body .= '<a href=" https://webtrader.forexmart.com/login" class="sell-trade-button" style="     display: inline-block;   margin: 2px;    color: #fff;    padding: 10px 37px;    background: #cf2323;    border: 0;    transition: all 0.2s linear;      text-decoration: none;">';
        $body .= '<span style="    font-size: 25px;    display: block;    color: #fff;">';
        $body .= 'Sell';
        $body .= '</span>';
        $body .= '<label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">';
        $body .= 'If you believe ' . $res['MostIncreasingPopularSymbol'] . ' price will decline.';
        $body .= '</label>';
        $body .= '      </a>              </div>';
        $body .= '    </div></div></div></div></div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image_to?email=".$to."&key=". $unsubscribe ."&email_id=". $res['id'] ."&ip_address=".$_SERVER['REMOTE_ADDR']."'>";
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;"><span style="font-weight: bold;color: #ff0000;">Risk Warning:</span> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> is official partner of Las Palmas.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> is the trading name of <img alt="ltd-small-black" style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, a Cyprus based Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">license number 266/15</a>.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> was awarded by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.';
        $body .= '<br><br>International Finance Magazine (IFM) awarded ForexMart as "Best New Broker Europe 2016"';
        $body .= '<br><br>© 2015 - 2016 <img alt="small-black" style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">';
        $body .= '</p>';
        $body .= '</div>';
        $body .= '<div  style="margin: 0;text-align: center;">';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img alt="cysec" height="56" src="https://www.forexmart.com/assets/images/mailer/cysec.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img alt="mifid" height="56" src="https://www.forexmart.com/assets/images/mailer/mifid.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img alt="bafin" height="56" src="https://www.forexmart.com/assets/images/mailer/bafin.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img alt="autorite" height="56" src="https://www.forexmart.com/assets/images/mailer/autorite.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img alt="fca" height="56" src="https://www.forexmart.com/assets/images/mailer/fca.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img alt="consob" height="56" src="https://www.forexmart.com/assets/images/mailer/consob.png"></a>';
        $body .= '</div>';
        $body .= '</div></div>';
        $body .= '<div style="width: 100%;padding: 7px 0px;background: #e7e7e7;text-align: center;">';
        $body .= '<a href="https://www.forexmart.com/unsubscribe/ref4/' . $unsubscribe . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Unsubscribe this email</a>';
        $body .= "</div>";
        echo $body;
        $sender = self::newsletter_noreply($to,  'This week most popular deal' , $body);        
    }


    public function showfx_the_park($to,$unsubscribe_key, $name){

        $body = self::NewestHeader();
        // $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        // $body .= '<div style="position: relative;">';
        // $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img.png" alt="mailing_fiftypercentbonus_img">';
        // $body .= '</div>';
        // $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        // $body .= 'Greetings!<br><br>';

        // $body .= "ForexMart would like to invite you to take part in the ShowFx World Expo at the Congress and Exhibition Complex, “The Park” in Kiev, Ukraine on May 20-21, 2017. Participants to the conference will get the chance to learn personal finance management from some of the world’s top financial experts, take part in workshops and seminars, which covers several aspects of trading from leading trading professionals. Guests will also be able to join raffles and win giveaways from event organizers<br><br>";

        // $body .= "In addition, ForexMart representatives will also be more than happy to inform attending clients to the ShowFx World Expo with regards to the latest developments within our company.<br><br>";

        // $body .="Admission to the ShowFx World Expo in Kiev is free. See you at the Expo! <br><br>";

        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Warmest regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';

        $body .= '<table class="outer" align="center" style="border-spacing:0;color:#333333;Margin:0 auto;width:100%;max-width:800px;font-family:Open Sans;" >
                <tr>
                    <td class="full-width-image" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <img src="https://www.forexmart.com/assets/images/massmail/the-park-ukraine-03.png" width="600" alt="" style="border-width:0;width:100%;max-width:800px;height:auto;" >
                    </td>
                </tr>
                <tr>
                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <table width="100%" style="border-spacing:0;color:#333333;" >
                        <tr>
                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Dear '.$name.',</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Greetings!</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px; line-height:25px;">ForexMart would like to invite you to take part in the ShowFx World Expo at the Congress and Exhibition Complex, “The Park” in Kiev, Ukraine on May 20-21, 2017.<br>
                                Participants to the conference will get the chance to learn personal finance management from some of the world’s top financial experts, take part in workshops and seminars, which covers several aspects of trading from leading trading professionals. Guests will also be able to join raffles and win giveaways from event organizers</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">In addition, ForexMart representatives will also be more than happy to inform attending clients to the ShowFx World Expo with regards to the latest developments within our company.</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Admission to the ShowFx World Expo in Kiev is free.<br> See you at the Expo!</p>';

                        $body .= self::buttons();

                        $body.= '<br><p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Warmest regards,</p>                               
                                <p class="company-label" style="Margin:0;font-weight:600;color:#003a62;font-size:14px;Margin-bottom:10px;text-align:justify; line-height:25px;">ForexMart Team</p>
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>';


        // $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer2($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'ForexMart invitation for ShowFx World Conference in Kiev', $body);
        return $sender;
    }


    public function showfx_the_parkPartner($to,$unsubscribe_key, $name){

        $body = self::NewestHeader();
        // $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        // $body .= '<div style="position: relative;">';
        // $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img.png" alt="mailing_fiftypercentbonus_img">';
        // $body .= '</div>';
        // $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        // $body .= 'Greetings!<br><br>';

        // $body .= "ForexMart would like to invite you to take part in the ShowFx World Expo at the Congress and Exhibition Complex, “The Park” in Kiev, Ukraine on May 20-21, 2017. Participants to the conference will get the chance to learn personal finance management from some of the world’s top financial experts, take part in workshops and seminars, which covers several aspects of trading from leading trading professionals. Guests will also be able to join raffles and win giveaways from event organizers<br><br>";

        // $body .= "In addition, ForexMart representatives will also be more than happy to inform attending clients to the ShowFx World Expo with regards to the latest developments within our company.<br><br>";

        // $body .="Admission to the ShowFx World Expo in Kiev is free. See you at the Expo! <br><br>";

        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Warmest regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';

        $body .= '<table class="outer" align="center" style="border-spacing:0;color:#333333;Margin:0 auto;width:100%;max-width:800px;font-family:Open Sans" >
                <tr>
                    <td class="full-width-image" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <img src="https://www.forexmart.com/assets/images/massmail/the-park-ukraine-03.png" width="600" alt="" style="border-width:0;width:100%;max-width:800px;height:auto;" >
                    </td>
                </tr>
                <tr>
                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <table width="100%" style="border-spacing:0;color:#333333;" >
                        <tr>
                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Dear '.$name.',</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Greetings!</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px; line-height:25px;">ForexMart would like to invite you to take part in the ShowFx World Expo at the Congress and Exhibition Complex, “The Park” in Kiev, Ukraine on May 20-21, 2017.<br>
                                Participants to the conference will get the chance to learn personal finance management from some of the world’s top financial experts, take part in workshops and seminars, which covers several aspects of trading from leading trading professionals. Guests will also be able to join raffles and win giveaways from event organizers.</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">In addition, ForexMart representatives will also be more than happy to inform attending clients to the ShowFx World Expo with regards to the latest developments within our company.</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Admission to the ShowFx World Expo in Kiev is free.<br>
                                    See you at the Expo!
                                </p>';

                        $body .= self::buttons();

                        $body.= '<br><p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Warmest regards,</p>                               
                                <p class="company-label" style="Margin:0;font-weight:600;color:#003a62;font-size:14px;Margin-bottom:10px;text-align:justify; line-height:25px;">ForexMart Team</p>
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>';


        // $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer2($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'ForexMart invitation for ShowFx World Conference in Kiev', $body);
        return $sender;
    }


    public function showfx_the_parkRussian($to,$unsubscribe_key, $name){

        $body = self::NewestHeader();
        // $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        // $body .= '<div style="position: relative;">';
        // $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img.png" alt="mailing_fiftypercentbonus_img">';
        // $body .= '</div>';
        // $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        // $body .= 'Greetings!<br><br>';

        // $body .= "ForexMart would like to invite you to take part in the ShowFx World Expo at the Congress and Exhibition Complex, “The Park” in Kiev, Ukraine on May 20-21, 2017. Participants to the conference will get the chance to learn personal finance management from some of the world’s top financial experts, take part in workshops and seminars, which covers several aspects of trading from leading trading professionals. Guests will also be able to join raffles and win giveaways from event organizers<br><br>";

        // $body .= "In addition, ForexMart representatives will also be more than happy to inform attending clients to the ShowFx World Expo with regards to the latest developments within our company.<br><br>";

        // $body .="Admission to the ShowFx World Expo in Kiev is free. See you at the Expo! <br><br>";

        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Warmest regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';

        $body .= '<table class="outer" align="center" style="border-spacing:0;color:#333333;Margin:0 auto;width:100%;max-width:800px;font-family:Open Sans" >
                <tr>
                    <td class="full-width-image" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <img src="https://www.forexmart.com/assets/images/massmail/the-park-ukraine-03.png" width="600" alt="" style="border-width:0;width:100%;max-width:800px;height:auto;" >
                    </td>
                </tr>
                <tr>
                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <table width="100%" style="border-spacing:0;color:#333333;" >
                        <tr>
                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Уважаемые '.$name.'!</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px; line-height:25px;">Компания ФорексМарт участвует в международной выставке <b>ShowFx World</b>, которая пройдет <b>20-21 мая в Киеве</b>. Приглашаем вас посетить это значимое событие в области инвестирования и трейдинга.</p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Мероприятие направлено на обучение и развитие торговых навыков. В выставке участвуют брокерские и дилинговые компании, опытные трейдеры, аналитики, коучи и другие эксперты финансового мира.</p>

                                 <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Профессионалы финансовой сферы проведут бесплатные семинары и мастер-классы. Специальные гости выставки из Великобритании: Кэтрин Стотт – коуч по работе с трейдерами, и Клайв Ламберт – основатель и ведущий технический аналитик FutureTechs.</p>

                                 <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Посетители выставки:</p>

                                 <ul>
                                    <li>узнают свежие экономические прогнозы;</li>
                                    <li>обсудят актуальные вопросы биржевой и валютной торговли, новости и новинки финансового мира;</li>
                                    <li>посетят образовательные тренинги и семинары экспертов финансового рынка;</li>
                                    <li>рассмотрят методы управления капиталом;</li>
                                    <li>получат приятные бонусы, призы и подарки.</li>
                                 </ul>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Выставка ShowFx World в Киеве – это прекрасная возможность познакомиться с профессионалами в сфере Форекс, обменяться опытом с другими трейдерами.<br></p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Вход на выставку ShowFx World в Киеве – свободный.<br></p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;"><b>Дата мероприятия:</b> 20.05.2017 - 21.05.2017.<br></p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;"><b>Место проведения:</b> Киев, Парковая дорога 16-а, Конгрессно-выставочный центр "Парковый", Большой выставочный зал.<br></p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Присоединяйтесь к Форекс-сообществу в Украине.<br></p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Приходите, обучайтесь, выигрывайте!<br></p>';

                                $body .= self::buttons_russian();

                                $body .= '<br><p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >С уважением,</p>                               
                                <p class="company-label" style="Margin:0;font-weight:600;color:#003a62;Margin-bottom:10px;text-align:justify; line-height:25px;"> каманда ФорексМарт</p>
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>';


        // $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer2($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'ФорексМарт приглашает на выставку ShowFx World в Киеве', $body);
        return $sender;
    }

    public function showfx_the_parkRussian_partner($to,$unsubscribe_key, $name){

        $body = self::NewestHeader();
        // $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        // $body .= '<div style="position: relative;">';
        // $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img.png" alt="mailing_fiftypercentbonus_img">';
        // $body .= '</div>';
        // $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        // $body .= 'Greetings!<br><br>';

        // $body .= "ForexMart would like to invite you to take part in the ShowFx World Expo at the Congress and Exhibition Complex, “The Park” in Kiev, Ukraine on May 20-21, 2017. Participants to the conference will get the chance to learn personal finance management from some of the world’s top financial experts, take part in workshops and seminars, which covers several aspects of trading from leading trading professionals. Guests will also be able to join raffles and win giveaways from event organizers<br><br>";

        // $body .= "In addition, ForexMart representatives will also be more than happy to inform attending clients to the ShowFx World Expo with regards to the latest developments within our company.<br><br>";

        // $body .="Admission to the ShowFx World Expo in Kiev is free. See you at the Expo! <br><br>";

        // $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Warmest regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';

        $body .= '<table class="outer" align="center" style="border-spacing:0;color:#333333;Margin:0 auto;width:100%;max-width:800px;font-family:Open Sans" >
                <tr>
                    <td class="full-width-image" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <img src="https://www.forexmart.com/assets/images/massmail/the-park-ukraine-03.png" width="600" alt="" style="border-width:0;width:100%;max-width:800px;height:auto;" >
                    </td>
                </tr>
                <tr>
                    <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <table width="100%" style="border-spacing:0;color:#333333;" >
                        <tr>
                            <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;" >
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >Уважаемые '.$name.'!</p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px; line-height:25px;">Компания ФорексМарт участвует в международной выставке <b>ShowFx World</b>, которая пройдет <b>20-21 мая в Киеве</b>. Приглашаем вас посетить это значимое событие в области инвестирования и трейдинга.</p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Мероприятие направлено на обучение и развитие торговых навыков. В выставке участвуют брокерские и дилинговые компании, опытные трейдеры, аналитики, коучи и другие эксперты финансового мира.</p>

                                 <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Профессионалы финансовой сферы проведут бесплатные семинары и мастер-классы.<br>

                                Специальные гости выставки из Великобритании: Кэтрин Стотт – коуч по работе с трейдерами, и Клайв Ламберт – основатель и ведущий технический аналитик FutureTechs.
                                 </p>

                                 <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Посетители выставки:</p>

                                 <ul>
                                    <li>узнают свежие экономические прогнозы;</li>
                                    <li>обсудят актуальные вопросы биржевой и валютной  торговли, новости и новинки финансового мира;</li>
                                    <li>посетят образовательные тренинги и семинары экспертов финансового рынка;</li>
                                    <li>рассмотрят методы управления капиталом;</li>
                                    <li>получат приятные бонусы, призы и подарки .</li>
                                 </ul>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Выставка ShowFx World в Киеве – это прекрасная возможность познакомиться с профессионалами в сфере Форекс, обменяться опытом с другими трейдерами.<br></p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Вход на выставку ShowFx World в Киеве – свободный.<br></p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;"><b>Дата мероприятия:</b> 20.05.2017 - 21.05.2017.<br></p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;"><b>Место проведения:</b> Киев, Парковая дорога 16-а, Конгрессно-выставочный центр "Парковый", Большой выставочный зал.<br></p>

                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Присоединяйтесь к Форекс-сообществу в Украине.<br></p>
                                <p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;">Приходите, обучайтесь, выигрывайте!<br></p>';

                            $body .= self::buttons_russian();

                            $body .= '<br><p style="Margin:0;Margin-bottom:10px;text-align:justify; line-height:25px;" >С уважением,</p>                               
                                <p class="company-label" style="Margin:0;font-weight:600;color:#003a62;Margin-bottom:10px;text-align:justify; line-height:25px;"> каманда ФорексМарт</p>
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>';


        // $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer2($unsubscribe_key);

        $body .= $footer;
        echo $body;
        $sender = self::NewestMailerSchedulerSender($to, 'ФорексМарт приглашает на выставку ShowFx World в Киеве', $body);
        return $sender;
    }





                                        





// this section is for testing

    public static function tester_mail($to,$unsubscribe_key, $name){
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/massmail/mailing_fiftypercentbonus_img.png" alt="mailing_fiftypercentbonus_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';

        $body .= "<br>With ForexMart, you can get the most out of your capital and gain more profit by availing of ForexMart’s 50% Bonus offer. You can get as much as 50% of the total money you deposited if you do it in our system. With just one click, you can instantly get an additional $50 once you deposit $100 in your account. A 50% bonus is automatically available for every deposit made. To know more about our bonus offer, 
                <a href='https://www.forexmart.com/fifty-percent-bonus'>click here.<br>";
        $body .= '<div  style="background: rgb(41, 136, 202); display: table; margin: 24.5px auto; cursor: pointer; transition: all 0.2s linear; color: rgb(51, 51, 51);">
                <a href="https://www.forexmart.com/fifty-percent-bonus" style="color: rgb(255, 255, 255);     padding: 15px;    text-decoration: none;    border-bottom: 5px solid #067acc; font-size: 16px; text-transform: uppercase; display: block;">GET BONUS HERE!</a></div>';
        $body .= self::buttons();
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';

        $footer = self::NewestFoooterForMassMailer2($unsubscribe_key);

        $body .= $footer;
        echo $body;
        self::newsletter_postmaster($to, 'Get 50% Bonus in every deposit!', $body);
        // self::newsletter_noreply($to, 'Get 50% Bonus in every deposit!', $body);
        // self::newsletter_support($to, 'Get 50% Bonus in every deposit!', $body);
        // self::newsletter_partners($to, 'Get 50% Bonus in every deposit!', $body);
        // self::newsletter_marketing($to, 'Get 50% Bonus in every deposit!', $body);
        // $sender = self::newsletter_abuse($to, 'Get 50% Bonus in every deposit!', $body);


        return $sender;
    }

    public static function newsletter_postmaster($to,  $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.newsletter.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 3;
        $mail->Username = 'postmaster@newsletter.forexmart.com';
        $mail->Password = 'baeutTmQFE6WJd';
        $mail->DKIM_domain = "newsletter.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo('postmaster@newsletter.forexmart.com', $name);
        $mail->SetFrom('postmaster@newsletter.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return $mail;
        } else {
            return true;
        }
    }


    public static function newsletter_noreply($to,  $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.newsletter.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 3;
        $mail->Username = 'no-reply@newsletter.forexmart.com';
        $mail->Password = 'wX8s2FkwtZ';
        $mail->DKIM_domain = "newsletter.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo('no-reply@newsletter.forexmart.com', $name);
        $mail->SetFrom('no-reply@newsletter.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return $mail;
        } else {
            return true;
        }
    }


    public static function newsletter_support($to,  $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.newsletter.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 3;
        $mail->Username = 'support@newsletter.forexmart.com';
        $mail->Password = '24MWzd3J8n';
        $mail->DKIM_domain = "newsletter.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo('support@newsletter.forexmart.com', $name);
        $mail->SetFrom('support@newsletter.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return $mail;
        } else {
            return true;
        }
    }



    public static function newsletter_partners($to,  $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.newsletter.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 3;
        $mail->Username = 'partners@newsletter.forexmart.com';
        $mail->Password = 'EACQfr3sHp';
        $mail->DKIM_domain = "newsletter.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo('partners@newsletter.forexmart.com', $name);
        $mail->SetFrom('partners@newsletter.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return $mail;
        } else {
            return true;
        }
    }

    public static function newsletter_marketing($to,  $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.newsletter.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 3;
        $mail->Username = 'marketing@newsletter.forexmart.com';
        $mail->Password = '6mLDb8e787';
        $mail->DKIM_domain = "newsletter.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo('marketing@newsletter.forexmart.com', $name);
        $mail->SetFrom('marketing@newsletter.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return $mail;
        } else {
            return true;
        }
    }

    public static function newsletter_abuse($to,  $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.newsletter.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 3;
        $mail->Username = 'abuse@newsletter.forexmart.com';
        $mail->Password = 'gPeM8AQpwc';
        $mail->DKIM_domain = "newsletter.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo('abuse@newsletter.forexmart.com', $name);
        $mail->SetFrom('abuse@newsletter.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        // $mail->AddBCC("mottakaquezo68@gmail.com");
        if (!$mail->Send()) {
            return $mail;
        } else {
            return true;
        }
    }



// end
}