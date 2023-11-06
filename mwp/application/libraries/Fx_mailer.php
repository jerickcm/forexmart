<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fx_mailer {

    function __construct(){

    }

    private static function CI(){
        $CI =& get_instance();
        return $CI;
    }

    public static function partners_registration($partnership_login, $partnership_affiliate){

        $subject = "ForexMart Partnership Program";

        $from = "partners@mail.forexmart.com";
        $returnpath = "partners@mail.forexmart.com";
        $body = self::head();

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">'.$subject.'</h2>';
        $body .= '<label style="color: #5A5A5A;font-size: 14px;float: left;">Dear '.$partnership_login['fullname'].',</label>';
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;">';
            $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>Welcome to ForexMart, the world's most trusted trading partner! We express our profound gratitude for jump-starting your business with us.</p>";
            $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>Please take note of your account details below. Keep your account details safe and secure at all times.</p>";
            $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>Username: ".$partnership_login['email']."</p>";
            $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>Password: ".$partnership_login['password']."</p>";
            $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>Phone Password: ".$partnership_login['phone_password']."</p>";
            $body .= "<div style='margin: 22px 20px;'><a href='".self::CI()->config->item('PartnerSignIn')."' style='background: #29a643; color: #fff;border: none;padding: 7px 50px;transition: all ease 0.3s;text-decoration: none;font-size: 14px;'> Login to your account </a></div>";
            $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>You may start referring clients by using the following affiliate link.</p>";
            $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'><a href='https://www.forexmart.com?id=".$partnership_affiliate['affiliate_code']."'>https://www.forexmart.com?id=".$partnership_affiliate['affiliate_code']."</a>";
            $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>Should you have any issues or questions, please let us know by reaching us at partnership@forexmart.com</p>";
            $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>Do not forget to verify your account. Click <a href=".self::CI()->config->item('VerifyAccount').">here</a> to begin the verification process. Provide a scanned copy of your valid ID or passport, along with proof of residence. Accepted image file formats include .jpeg, .gif, .pdf, and .png</p>";

        $body .= '</p>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;">All the best,</label>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;display: block;">ForexMart Team</label>';
        $body .= self::foot();
        self::fx_sender_partner($partnership_login['email'], $subject, $body, $from, $returnpath);
    }

    public static function partnersdetails($email, $details, $user_profile){
        $strWeb ="";
        if(empty($details['websites'])){
            $strWeb = 'N/A';
        }else{
            foreach(json_decode($details['websites'],true) as $test){
                $strWeb .= "<a href='".urldecode($test)."'>".urldecode($test)."</a> ";
            }
        }

        $message = empty($details['message']) ? 'N/A' : $details['message'];
        $subject = "Partners request [ref#:".$details['reference_num']."]";
        $to = "partners@mail.forexmart.com";
        $from = "notification@mail.forexmart.com";
        $returnpath = "notification@mail.forexmart.com";
        $body = self::head();
//        $body .= "<div>";
//            $body .= "Full Name: ".$user_profile['full_name']."<br/>";
//            $body .= "Email: ".$email."<br/>";
//            $body .= "Phone number: ".$details['phone_number']."<br/>";
//            $body .= "Country of Residence: ".$user_profile['country']."<br/>";
//            $body .= "Target Country of Business: ".$details['target_country']."<br/>";
//            $body .= "Website: ".$strWeb."<br/>";
//            $body .= "Message: ".$message."<br/>";
//        $body .= "</div>";

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">'.$subject.'</h2>';
        $body .= '<p style="padding-top: 20px; line-height: 20px; clear: left;font-size: 14px;color: #5A5A5A;text-align: justify;">';
            $body .= "Full Name: ".$user_profile['full_name']."<br/>";
            $body .= "Email: ".$email."<br/>";
            $body .= "Phone number: ".$details['phone_number']."<br/>";
            $body .= "Country of Residence: ".$user_profile['country']."<br/>";
            $body .= "Target Country of Business: ".$details['target_country']."<br/>";
            $body .= "Website: ".$strWeb."<br/>";
            $body .= "Message: ".$message."<br/>";
        $body .= '</p>';
        $body .= '<label style="color: #000;font-size: 14px;">All the best,</label>';
        $body .= '<label style="color: #000;font-size: 14px;display: block;">ForexMart Team</label>';

        $body .= self::foot();
        self::fx_notification_partner($to, $subject, $body, $from, $returnpath);
    }

    public static function fx_sender_partner($to, $subject, $message, $from, $returnpath){
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.mail.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = "partners@mail.forexmart.com";
        $mail->Password = "TBGYWmHwt7";
        $mail->DKIM_domain = "forexmart.com";
        $mail->DKIM_selector = 'mail';
        $mail->AddReplyTo($returnpath, $name);
        $mail->SetFrom($from, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);

        if(!$mail->Send()){
            return false;
        }else{
            return true;
        }
    }

    public static function fx_notification_partner($to, $subject, $message, $from, $returnpath){
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.mail.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = "notification@mail.forexmart.com";
        $mail->Password = "t9EE+gV2;g~=|z";
        $mail->AddReplyTo($returnpath, $name);
        $mail->SetFrom($from, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);

        if(!$mail->Send()){
            return false;
        }else{
            return true;
        }
    }

    public static function sender($to, $subject, $message, $from, $returnpath){
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.mail.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = "noreply@mail.forexmart.com";
        $mail->Password = "6!1PN%xpyJOE0i";
        $mail->AddReplyTo($returnpath, $name);
        $mail->SetFrom($from, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);

        if(!$mail->Send()){
            return false;
        }else{
            return true;
        }

    }

    public static function MoneyFallRegistrationCode($data){

        $data['insert'] = array(
            'Title' =>$data['Title'],
            'FullName' =>$data['FullName'],
            'Code' =>$data['Code'],
            'Email' =>$data['Email']
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MoneyFall Confirmation ';
        $body .='
                        <h2 style="text-align: center;color: #2988CA;"> '.$data['insert']['Title'].'</h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        '.lang("hi").' '.$data['insert']['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            '.lang("p1-0").'
                        </p>
                        <br/>'.lang("p1-1-0").'
                        <br/>'.lang("p1-1-1").'  <span style="font-weight:bold">'.$data['Code'].'</span>
                        <br/>
                        <br/>
                        <br/><a style="text-decoration: none;color: #FFF;font-family: Open Sans;font-size: 17px;font-weight: 600;background: #29A643 none repeat scroll 0% 0%;padding: 10px 20px;transition: all 0.3s ease 0s;" href="'.site_url("confirm/code").'" >Confirm Now</a>
                        <br/>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                            '.lang("forcode").' <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">  '.lang("supportmail").'</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            '.lang("thankyou").'<br style="margin: 0 auto">
                             '.lang("closing").'<br style="margin: 0 auto">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($data['Email'],$subject,$body,$from,$returnPath);

    }
    public static function MoneyFallRegistrationAccess($data){
        $data['space']='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MT4 Demo account details ';
        $body .='
                        <h2 style="text-align: center;color: #2988CA;"> '.$data['Title'].'</h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        '.lang("hi").' '.$data['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            '.lang("code").'
                        </p>
                        <br/>
                          <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">
                             <table style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: justify;line-height: 19px;">
                                    <tr>
                                        <th >'.lang("AccountNumber").'</th>
                                        <td > '.$data['AccountNumber'].'</td>
                                    </tr>
                                    <tr>
                                        <th >Trader password:</th>
                                        <td > '.$data['Password'].'</td>
                                    </tr>
                                    <tr>
                                        <th >Investor password:</th>
                                        <td >'.$data['InvestorPassword'].'</td>
                                    </tr>
                                    <tr>
                                        <th >MT4 Demo Server:</th>
                                        <td >' . MONEYFALL_SERVER_DEMO . '</td>
                                    </tr>


                                </table>
                          </div>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
        '.$data['space'].'
        Please store your login details safe and secure at all times.
        </p>

        <p style="font-size: 14px;font-family: Arial sans-serif;font-weight: 400;color: #555;margin: 25px 0px 30px 0px;text-align: justify;">
        '.$data['space'].'
        <a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe" style="background: none repeat scroll 0 0 #2988ca; border: 1px solid #2988ca; color: #fff; font-family: Arial; font-size: 15px; font-weight: 500; padding: 8px 25px; transition: all 0.3s ease 0s; text-decoration: none;">
            Download MT4 desktop platform
        </a>
        </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
            You may visit our <a target="_blank" href="https://www.forexmart.com/faq"> Frequently Asked Questions</a>
            for more technical information. We wish you a successful trading!</p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
            For more information please do not hesitate to contact us at <a href="#" style="margin: 0 auto;color: #2988ca;text-decoration: none;">support@forexmart.com</a>.
        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          '.lang("thankyou").'<br style="margin: 0 auto">
                          '.lang("closing").'<br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($data['Email'],$subject,$body,$from,$returnPath);
    }

    public static function myhead($title,$type=0){
        //$type = 0 - client , 1 - partner
        $type = $type ? 'partner' : 'client';
        $CI =& get_instance();
        $CI->lang->load('FxMailer');

        $body = '<html>
                      <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>'.lang("FMtitle").'</title>

                     </head>
                     <body style="font-size: 14px; font-family: Arial; font-weight: 400; color: #555">';

        $body .='<div class="main-wrapper" style="margin: 0 auto; width: 615px">';

        $body .=' <div class="header-grid" style="margin: 0 auto; width: 100%; min-height: 10px; background: #2988ca; display: block; padding: 7px 15px; box-sizing: border-box">
                        <div class="logo-holder" style="margin: 0 auto">
                            <a style="margin: 0 auto;text-decoration: none;" href="https://www.forexmart.com/"><span style="font-size: 30px;color: #FFF">ForexMart</span></a>
                            <cite class="slogan" style="margin: 0 auto; font-family: Arial; font-size: 14px; font-weight: 400; color: #fff; font-style: normal; margin-left: 7px">'.lang("think").'<span style="margin: 0 auto; font-weight: 600"> '.lang("big").'</span>.'.lang("tradeforex").'</cite>
                            <a target="_blank" href="https://my.forexmart.com/partner/'.$type.'/signin" class="btn-sign" style="margin: 0 auto; float: right; background: none; border: 1px solid #fff; color: #fff; padding: 7px 15px; font-family: Open Sans; transition: all ease 0.3s">'.lang("signin").'</a>
                        </div><div class="clear" style="margin: 0 auto; clear: both"></div>
                    </div>

                    <h1 class="h1" style="margin: 0 auto; font-family: Georgia; font-weight: 400; font-size: 25px; color: #2988ca; margin-top: 30px; margin-bottom: 30px; border-bottom: 1px solid #2988ca; padding-bottom: 10px; padding-left: 15px">'.$title.'</h1>';

        $body .="<div  id='container' style='height:auto;margin:-1px auto 0px auto; border-top:none;'>";

        return $body;

    }
    public static function myfoot(){

        $CI =& get_instance();
        $CI->lang->load('FxMailer');

        $body ='<div class="risk-grid" style="margin: 0 auto; padding: 15px">
                    <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify; line-height: 19px">
                        <cite style="margin: 0 auto; font-style: normal; color: #ff0000; font-weight: 600">'.lang("RW").'</cite>'.lang("RWmsg-0").'
                        <span style="margin: 0 auto; color: #2988ca; font-weight: 600">'.lang("ForexMart").'</span>'.lang("RWmsg-1").'
                        <br style="margin: 0 auto"><br style="margin: 0 auto">
                        '.lang("RWmsg-2").'
                    </p>
                </div>

                    <div class="copy-grid" style="margin: 0 auto; padding: 15px; border-top: 3px solid #2988ca">
                        <div class="copy" style="margin: 0 auto; float: left">
                            <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify">'.lang("cpyright").'</p>
                        </div>
                    </div>

                <div class="clear" style="margin: 0 auto; clear: both"></div>';
        $body .='</div></body></html>';
        return $body;

    }
    public static function head1(){
        $full='
              <div class="main-wrapper" style="margin: 0 auto; width: 615px">
                    <div class="header-grid" style="margin: 0 auto; width: 100%; min-height: 10px; background: #2988ca; display: block; padding: 7px 15px; box-sizing: border-box">
                        <div class="logo-holder" style="margin: 0 auto">
                            <a style="margin: 0 auto" href="https://www.forexmart.com/" onclick="return false" rel="noreferrer">
                            <img src="https://doc-00-48-docs.googleusercontent.com/docs/securesc/ha0ro937gcuc7l7deffksulhg5h7mbp1/s7va2bhli5pq113n03vndom1n8u6nt54/1438927200000/14982723203090231498/*/0B-HO8-A8uEj6d0hZR3hDZmt6Q3M" class="logo" style="margin: 0 auto; width: 150px"></a>
                            <cite class="slogan" style="margin: 0 auto; font-family: Arial; font-size: 14px; font-weight: 400; color: #fff; font-style: normal; margin-left: 7px">Think <span style="margin: 0 auto; font-weight: 600">BIG</span>. Trade Forex</cite>
                            <button class="btn-sign" style="margin: 0 auto; float: right; background: none; border: 1px solid #fff; color: #fff; padding: 7px 15px; font-family: Open Sans; transition: all ease 0.3s">Sign in</button>
                        </div><div class="clear" style="margin: 0 auto; clear: both"></div>
                    </div>

                    <h1 class="h1" style="margin: 0 auto; font-family: Georgia; font-weight: 400; font-size: 25px; color: #2988ca; margin-top: 30px; margin-bottom: 30px; border-bottom: 1px solid #2988ca; padding-bottom: 10px; padding-left: 15px">Lorem Ipsum</h1>

                    <div class="content-grid" style="margin: 0 auto; padding: 15px; box-sizing: border-box; border-bottom: 1px solid #2988ca; padding-bottom: 60px">
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">Hi tester,</p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum. Souvlaki ignitus carborundum e pluribus unum. Defacto lingo est igpay atinlay.
                        </p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                            For more information please do not hesitate to contact us at <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">support@forexmart.com</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            Thank you<br style="margin: 0 auto">
                            With best regards,<br style="margin: 0 auto">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">ForexMart</span> Team
                        </p>
                    </div>

                <div class="risk-grid" style="margin: 0 auto; padding: 15px">
                    <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify; line-height: 19px">
                        <cite style="margin: 0 auto; font-style: normal; color: #ff0000; font-weight: 600">Risk Warning:</cite> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by <span style="margin: 0 auto; color: #2988ca; font-weight: 600">ForexMart</span>, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.<br style="margin: 0 auto"><br style="margin: 0 auto">
                        Tradomart Ltd is regulated by Cyprus Securities and Exchange Commission(CySEC) under licence no. 266/15.
                    </p>
                </div>

                    <div class="copy-grid" style="margin: 0 auto; padding: 15px; border-top: 3px solid #2988ca">
                        <div class="copy" style="margin: 0 auto; float: left">
                            <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify">&copy; 2015 Tradomart</p>
                        </div>
                        <div class="social-links" style="margin: 0 auto; float: right">
                            <ul style="margin: 0 auto; list-style: none">
                                <li style="margin: 0 auto; display: inline-block; padding: 0 7px"><a style="margin: 0 auto; color: #2988ca; font-size: 20px" href="./#NOP" onclick="return false" rel="noreferrer">
                                        <img src="https://doc-0o-48-docs.googleusercontent.com/docs/securesc/ha0ro937gcuc7l7deffksulhg5h7mbp1/4a82nljmfpeth5kssrhgeicjs02u2i27/1439172000000/14982723203090231498/*/0B-HO8-A8uEj6QlpfaEltU0dzN3c"></a></li>
                                <li style="margin: 0 auto; display: inline-block; padding: 0 7px"><a style="margin: 0 auto; color: #2988ca; font-size: 20px" href="./#NOP" onclick="return false" rel="noreferrer">
                                        <img src="https://doc-0c-48-docs.googleusercontent.com/docs/securesc/ha0ro937gcuc7l7deffksulhg5h7mbp1/he6dnf0ki9626cmtciai4am3sn3mqphb/1439179200000/14982723203090231498/*/0B-HO8-A8uEj6X3AzMVROaWJwTW8"></a></li>
                                <li style="margin: 0 auto; display: inline-block; padding: 0 7px"><a style="margin: 0 auto; color: #2988ca; font-size: 20px" href="./#NOP" onclick="return false" rel="noreferrer">
                                        <img src="https://doc-0o-48-docs.googleusercontent.com/docs/securesc/ha0ro937gcuc7l7deffksulhg5h7mbp1/mqiirabnhlt97819h1kcck418m18kosg/1439179200000/14982723203090231498/*/0B-HO8-A8uEj6aGQ2T091aEFLeWM"></a></li>
                                <li style="margin: 0 auto; display: inline-block; padding: 0 7px"><a style="margin: 0 auto; color: #2988ca; font-size: 20px" href="./#NOP" onclick="return false" rel="noreferrer">
                                        <img src="https://doc-0c-48-docs.googleusercontent.com/docs/securesc/ha0ro937gcuc7l7deffksulhg5h7mbp1/he6dnf0ki9626cmtciai4am3sn3mqphb/1439179200000/14982723203090231498/*/0B-HO8-A8uEj6X3AzMVROaWJwTW8"></a></li>
                            </ul>
                        </div>
                    </div>

                <div class="clear" style="margin: 0 auto; clear: both"></div>
            </div>
        ';
    }

    public function mass_mailer_scheduler($to, $replyto, $from, $pass, $message){
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $subject = "ForexMart";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.contact.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = $from;
        $mail->Password = $pass;
        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom($from, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);

        if(!$mail->Send()){
            return false;
        }else{
            return true;
        }
    }

    public static function testlayoutsender($to, $replyto, $from, $pass, $body, $subject){
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.contact.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = $from;
        $mail->Password = $pass;
        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom($from, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if(!$mail->Send()){
            return false;
        }else{
            return true;
        }
    }

    public static function head_scheduler(){
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = '<html>
                    <head></head>
                    <body style="font-family: Helvetica Neue,Arial,sans-serif;">';
                $body .= '<div style="position: relative;width: 800px;margin: 0px auto;">';
                    $body .= '<div style="background:#2988ca;padding:10px 0;width: 100%;">';
                        $body .= '<img style="margin-left: 10px;" src="https://www.forexmart.com/assets/images/logo2.png">';
                    $body .= '</div>';
        return $body;
    }

    public static function head(){
        $body = '<html>
                    <head></head>
                    <body style="font-family: Helvetica Neue,Arial,sans-serif;">';
        $body .= '<div style="position: relative;width: 800px;margin: 0px auto;">';
        $body .= '<div style="background:#2988ca;padding:10px 0;width: 100%;">';
        $body .= '<img style="margin-left: 10px;" src="https://www.forexmart.com/assets/images/logo2.png">';
        $body .= '</div>';
        $body .= '<div style="margin: 0 auto; padding: 15px; box-sizing: border-box; border-bottom: 1px solid #2988ca; padding-bottom: 60px;border-bottom: 1px solid #2988CA;padding-bottom: 20px;margin-top: 3px;border-top: 1px solid #2988CA;">';


        return $body;
    }

    public static function foot(){
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
        $body .= '<div style="width: 620px; float: left;">';
        $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;"> Risk Warning: </span>Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.</span></p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is a trading name of <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p></div>';
        $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>ForexMart</span> doesn't offer its services to residents of certain jurisdictions such as the USA, North Korea, Myanmar, Sudan and Syria.</p></div>";
        $body .= '<p>&copy; 2015 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>';
        $body .= '</div>';
        $body .= '<div style="width: 180px;float: right;">';
        $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/cysec.png" style="width: auto;margin: 20px auto;display: block;">';
        $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/mifid.png" style="width: auto;margin: 20px auto;display: block;">';
        $body .= '</div>';
        $body .= '</div>';
        $body .= '</div></body></div>';
        return $body;
    }

    public static function footer_scheduler(){
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
            $body .= '<div style="width: 620px; float: left;">';
                $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;"> Risk Warning: </span>Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.</span></p></div>';
                    $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is a trading name of <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p></div>';
                    $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>ForexMart</span> doesn't offer its services to residents of certain jurisdictions such as the USA, North Korea, Myanmar, Sudan and Syria.</p></div>";
                $body .= '<p>&copy; 2015 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>';
            $body .= '</div>';
            $body .= '<div style="width: 180px;float: right;">';
                $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/cysec.png" style="width: auto;margin: 20px auto;display: block;">';
                $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/mifid.png" style="width: auto;margin: 20px auto;display: block;">';
            $body .= '</div>';
        $body .= '</div>';
        $body .= '</div></body></div>';
        return $body;
    }

    public static function footer_russia_scheduler(){
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
        $body .= '<div style="width: 620px; float: left;">';
        $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;"> Предупреждение о рисках: </span>Торговля на Форекс имеет спекулятивный и сложный характер, и может подойти не всем инветорам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорексМарт, пожалуйста, оцените и примите риски, связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.</span></p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ФорексМарт (ForexMart)</span> является торговой маркой компании <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, Кипрской Инвестиционной Компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № 266/15.</p></div>';
        $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>Компания ФорексМарт</span> не оказывает услуги резидентам некоторых стран, таких как США, Северная Корея, Мьянма, Судан и Сирия.</p></div>";
        $body .= '<p>&copy; 2015 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>';
        $body .= '</div>';
        $body .= '<div style="width: 180px;float: right;">';
        $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/cysec.png" style="width: auto;margin: 20px auto;display: block;">';
        $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/mifid.png" style="width: auto;margin: 20px auto;display: block;">';
        $body .= '</div>';
        $body .= '</div>';
        $body .= '</div></body></div>';
        return $body;
    }

    public static function testlayout($to, $replyto, $from, $pass, $message, $subject, $lang){
        $body = self::head_scheduler();
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<p style="line-height: 20px; clear: left;">';
            $body .= $message;
        $body .= '</p>';
        $body .= '</div>';

        switch($lang){
            case 'Russian':
                $footer = self::footer_russia_scheduler();
                break;
            default:
                $footer = self::footer_scheduler();
                break;
        }

        $body .= $footer;
        self::testlayoutsender($to, $replyto, $from, $pass, $body, $subject);
    }

    public function forgot_password($forgot_details){
        $body = self::head_scheduler();
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<h2 style="font-family: Georgia, Times New Roman,serif;font-size: 22px;text-align: center;color: #2988CA;">ForexMart Password Reset</h2>';
        $body .= '<label style="color: #000;font-size: 14px;float: left;margin-top: 30px;">Dear User,</label>';
        $body .= '<p style="padding-top: 20px; line-height: 20px; font-size: 14px; clear: left;">';
        $body .= 'You have sent a request to reset your password for your ForexMart Account.<br/><br/>';
        $body .= 'Please click on the following link to set-up the new password.<br/><br/>';
        $body .= 'https://my.forexmart.com/reset-password/'.$forgot_details['Hash'].'<br/><br/>';
        $body .= '<br/>';
        $body .= '</p>';
        $body .= '<label style="color: #000;font-size: 14px;">All the best,</label>';
        $body .= '<label style="color: #000;font-size: 14px;display: block;">ForexMart Team</label>';
        $body .= '</div>';
        $body .= self::footer_scheduler();
        self::testlayoutsender($forgot_details['Email'], 'support@forexmart.com', 'noreply@contact.forexmart.com', 'XR5u9zD6uR', $body, 'ForexMart Password Reset');
    }

    /**Admin Account Verification Declining of Documents*/
    public static function AccountVerificationDeclinedBothDocuments($data){
        //FXPP-868
        $sentdata = array(
            'SelectedReason' => $data['SelectedReason'] ,
            'ReasonExplanation' => $data['ReasonExplanation'],
            'Email' => $data['Email'],
            'AccountNumber' => $data['AccountNumber'],
            'FullName' => $data['FullName'],

            'ClientName0' => $data['ClientName0'],
            'FileName0' => $data['FileName0'],
            'DocIdx0' => $data['DocIdx0'],

            'ClientName1' => $data['ClientName1'],
            'FileName1' => $data['FileName1'],
            'DocIdx1' => $data['DocIdx1'],

            'ClientName2' => $data['ClientName2'],
            'FileName2' => $data['FileName2'],
            'DocIdx2' => $data['DocIdx2'],
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $date = date("F j, Y h:i:s A");
        $subject = 'ForexMart Verification - Declined '.$sentdata['AccountNumber'].' ';
        $body .='
                       <h2 style="text-align: center;color: #2988CA;"> ForexMart Verification - Declined </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        Dear '.$data['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> You have submitted the following documents<br/>
                        <br/> 1.First Document : <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName0'].'"><strong> '.$sentdata['ClientName0'].' </strong></a>

                        <br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName1'].'"><strong> '.$sentdata['ClientName1'].' </strong></a>
<br/>
                        <br/> 2. Second Document :

                        <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName2'].'"><strong> '.$sentdata['ClientName2'].' </strong></a>

                        <br/>
                        <br/>
                        <br/> Please be informed that after careful verification, both documents have not passed the verification process due to the following reasons.
                        <br/>
                        <br/> Reason for decline : '.$sentdata['SelectedReason'].'
                        <br/> Explained Reason : '.$sentdata['ReasonExplanation'].'
                        <br/>
                        <br/> Reference Number: '.$sentdata['AccountNumber'].'
                        <br/>
                        <br/> For you to be able to start trading, please check the following requirements
                        <br/>
                        <br/> Documents must be clear, colored, and complete.
                        <br/> Scan both sides of the document.
                        <br/> No erasures, additions, or other unauthorized manipulations.
                        <br/> Upload a high quality scanned copy.
                        <br/> The names on the account and the document must be the same.
                        <br/> Documents must indicate the client&#39;s complete address.
                        <br/> Documents must be no later than six months past.
                        <br/> If a legal entity, provide the company&#39;s registration and shareholder certificate, as well as a document of the individual owning the account.
                        <br/> Documents in local language must be translated into English and have it notarized. Submit the scanned copy of the original document.
                        <br/> Accepted image file formats are .jpeg, .gif, .pdf, and .png. It should not exceed 2 MB.
                        <br/>

                        </p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           '.lang("forcode").'  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">'.lang("supportmail").'</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          All the best,
                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'],$subject,$body,$from,$returnPath);
    }

    public static function AccountVerificationDeclined2ndDocuments($data){
        // FXPP-866
        $sentdata = array(
            'SelectedReason' => $data['SelectedReason'] ,
            'ReasonExplanation' => $data['ReasonExplanation'],
            'Email' => $data['Email'],
            'AccountNumber' => $data['AccountNumber'],
            'FullName' => $data['FullName'],

            'ClientName0' => $data['ClientName0'],
            'FileName0' => $data['FileName0'],
            'DocIdx0' => $data['DocIdx0'],

            'ClientName1' => $data['ClientName1'],
            'FileName1' => $data['FileName1'],
            'DocIdx1' => $data['DocIdx1'],

            'ClientName2' => $data['ClientName2'],
            'FileName2' => $data['FileName2'],
            'DocIdx2' => $data['DocIdx2']
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $date = date("F j, Y h:i:s A");
        $subject = 'ForexMart Verification - Declined '.$sentdata['AccountNumber'].' ';
        $body .='
                       <h2 style="text-align: center;color: #2988CA;"> ForexMart Verification - Declined </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        Dear '.$data['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> You have submitted the following document<br/>
                        <br/> 1.  First Document : <br/><br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName2'].'"><strong> '.$sentdata['ClientName0'].' </strong></a>
                        <br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName1'].'"><strong> '.$sentdata['ClientName1'].' </strong></a> <br/>
                        <br/> 2. Second Document :
                        <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName2'].'"><strong> '.$sentdata['ClientName2'].' </strong></a>
                        <br/>
                        <br/>
                        <br/> Please be informed that after careful verification, the second document[<a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName1'].'"><strong> '.$sentdata['ClientName1'].' </strong></a>] needs to be re-uploaded due to the following reasons:

                        <br/>
                        <br/> Reason for decline : '.$sentdata['SelectedReason'].'
                        <br/> Additional Comments : '.$sentdata['ReasonExplanation'].'
                        <br/>
                        <br/> Reference Number: '.$sentdata['AccountNumber'].'
                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           '.lang("forcode").'  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">'.lang("supportmail").'</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          All the best,
                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'],$subject,$body,$from,$returnPath);
    }

    public static function AccountVerificationDeclined1stDocuments($data){
        //FXPP-867
        $sentdata = array(
            'SelectedReason' => $data['SelectedReason'] ,
            'ReasonExplanation' => $data['ReasonExplanation'],
            'Email' => $data['Email'],
            'AccountNumber' => $data['AccountNumber'],
            'FullName' => $data['FullName'],

            'ClientName0' => $data['ClientName0'],
            'FileName0' => $data['FileName0'],
            'DocIdx0' => $data['DocIdx0'],

            'ClientName1' => $data['ClientName1'],
            'FileName1' => $data['FileName1'],
            'DocIdx1' => $data['DocIdx1'],

            'ClientName2' => $data['ClientName2'],
            'FileName2' => $data['FileName2'],
            'DocIdx2' => $data['DocIdx2'],
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $date = date("F j, Y h:i:s A");
        $subject = 'ForexMart Verification - Declined [ '.$sentdata['AccountNumber'].' ] ';
        $body .='
                       <h2 style="text-align: center;color: #2988CA;"> ForexMart Verification - Declined </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        Dear '.$data['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> You have submitted the following document<br/>
                        <br/> 1. First Document :
                        <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName0'].'"><strong> '.$sentdata['ClientName0'].' </strong></a> <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName1'].'"><strong> '.$sentdata['ClientName1'].' </strong></a>
                        <br/>
                        <br/> 2. Second Document :
                        <br/><br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName2'].'"><strong> '.$sentdata['ClientName2'].' </strong></a>
                        <br/>
                        <br/>
                        <br/>
                        <br/> Please be informed that after careful verification, the first document needs to be re-uploaded due to the following reasons:
                        <br/>
                        <br/> Reason for decline : '.$sentdata['SelectedReason'].'
                        <br/> Additional Comments : '.$sentdata['ReasonExplanation'].'
                        <br/>
                        <br/> Reference Number: '.$sentdata['AccountNumber'].'
                        <br/>
                        </p>

                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           '.lang("forcode").'  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">'.lang("supportmail").'</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          All the best,
                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'],$subject,$body,$from,$returnPath);
    }
    /**Admin Account Verification Declining of Documents*/
    /**Admin Account Verification Approval of Documents*/
    public static function AccountVerificationVerifiedUser($data){
        //FXPP865
        $sentdata = array(
            'Email' => $data['Email'],
            'AccountNumber' => $data['AccountNumber'],
            'FullName' => $data['FullName'],

            'ClientName0' => $data['ClientName0'],
            'FileName0' => $data['FileName0'],
            'DocIdx0' => $data['DocIdx0'],

            'ClientName1' => $data['ClientName1'],
            'FileName1' => $data['FileName1'],
            'DocIdx1' => $data['DocIdx1'],

            'ClientName2' => $data['ClientName2'],
            'FileName2' => $data['FileName2'],
            'DocIdx2' => $data['DocIdx2'],
        );

        $CI =& get_instance();
        $body = self::head();
        $date = date("F j, Y h:i:s A");
        $subject = 'ForexMart Verification - Approved [ '.$sentdata['AccountNumber'].' ] ';
        $body .='
                       <h2 style="text-align: center;color: #2988CA;"> ForexMart Verification - Approved </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        Dear '.$data['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> You have submitted the following documents<br/>
                        <br/> 1.  First Document -  <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName0'].'"><strong> '.$sentdata['ClientName0'].' </strong></a>

                        <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName1'].'"><strong> '.$sentdata['ClientName1'].' </strong></a>

                        <br/>

                        <br/> 2. Second Document -

                         <br/><br/>

                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['FileName2'].'"><strong> '.$sentdata['ClientName2'].' </strong></a>

                        <br/>
                        <br/> Please be informed that after careful verification, both documents are deemed valid.
Thus, your account has passed the verification process and you may now start trading.
                        <br/>
                         <br/> Note : Both documents should be approved to get a Verified Status to start trading.
                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           '.lang("forcode").'  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">'.lang("supportmail").'</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          All the best,
                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'],$subject,$body,$from,$returnPath);
    }

    public static function AccountVerificationDocumentApproved($data){

        $sentdata = array(
            'Email' => $data['Email'],
            'DocumentFilename' => $data['DocumentFilename'],
            'HashFilename' => $data['HashFilename'],
            'FullName' => $data['FullName'],
            'AccountNumber' => $data['AccountNumber'],
            'DocIdx' => $data['DocIdx']
        );

        if ($sentdata['DocIdx']==2){
             $document='Second';
        }else if($sentdata['DocIdx']==0){
            $document='the front copy of the first';
        }else if($sentdata['DocIdx']==1){
            $document='the back copy of the first';
        }

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart Verification Document Approved [ '.$sentdata['AccountNumber'].' ] ';
        $body .='
                       <h2 style="text-align: center;color: #2988CA;"> ForexMart Verification </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        Dear '.$data['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> You have submitted the following document - <a href="'.$CI->config->item('domain-my').'/assets/user_docs/'.$sentdata['HashFilename'].'"> <strong> '.$sentdata['DocumentFilename'].' </strong></a>
                        <br/>
                        <br/> Please be informed that after careful verification, '.$document.' document you have submitted is deemed valid and is approved.

                        <br/>
                        <br/>Note : Both documents should be approved to get a Verified Status. If the other document has already been approved, then you can go ahead and start trading.
For more information please do not hesitate to contact us at support@forexmart.com.
                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           '.lang("forcode").'  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">'.lang("supportmail").'</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          All the best,
                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">'.lang("ForexMart").'</span> '.lang("team").'
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'],$subject,$body,$from,$returnPath);
    }
    /**Admin Account Verification Approval of Documents*/


    public static function validateEmail($from, $email)
    {
        require_once dirname(__FILE__) . '/PHPMailer/smtp-validate-email.php';

        $validator = new SMTP_Validate_Email($email, $from);
        $smtp_results = $validator->validate();
        // var_dump($smtp_results);exit;
        return $smtp_results;
    }
    public static function forgot_password_v2($forgot_details){
        $body = self::head_scheduler();
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<h2 style="font-family: Georgia, Times New Roman,serif;font-size: 22px;text-align: center;color: #2988CA;">ForexMart Password Reset</h2>';
        $body .= '<label style="color: #000;font-size: 14px;float: left;margin-top: 30px;">Dear '.$forgot_details['full_name'].',</label>';
        $body .= '<p style="padding-top: 20px; line-height: 20px; font-size: 14px; clear: left;">';
        $body .= 'You have sent a request to reset your password for your ForexMart Account.<br/><br/>';
        $body .= 'Please click on the following link to set-up the new password.<br/><br/>';

        $body .= '<strong>Email:</strong> '.$forgot_details['Email'].'<br/>';
        $body .= '<strong>Account Number:</strong>'.$forgot_details['Account_number'].'<br/><br/>';

        $body .= FXPP::my_url('reset-password/') .$forgot_details['Hash'].'<br/><br/>';
        $body .= '<br/>';
        $body .= '</p>';
        $body .= '<label style="color: #000;font-size: 14px;">All the best,</label>';
        $body .= '<label style="color: #000;font-size: 14px;display: block;">ForexMart Team</label>';
        $body .= '</div>';
        $body .= self::footer_scheduler();
        $config = array(
            'mailtype'=> 'html'
        );

        $CI =& get_instance();

        $CI->load->library('email');
        if($config != null){
            $CI->email->initialize($config);
        }
        $CI->SMTPDebug =1;
        $CI->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $CI->email->to($forgot_details['Email']);
        $CI->email->subject('ForexMart Password Reset');
        $CI->email->message($body);
        if($CI->email->send()){
            //echo
        }else{
            echo $CI->email->print_debugger();
        }
    }
    public static function mailer_corporate($data){
        $subject = 'Your Request for Corporate Account with ForexMart is approved';
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        $body .= self::AdminHeader();
        $body .= '<h2 style="text-align:center;color:#2988ca"> ForexMart Corporate Account - Approved </h2>';
        $body .= '<div style="margin-bottom: 30px;">';
        $body .= '<label style="margin-top:20px; color: rgb(29,29,29);font-size: 14px;float: left;">Dear '.$data['full_name'].',</label>';
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: rgb(29,29,29);text-align: justify;">';
        $body .= "<p style='font-size: 14px; clear: left;color: rgb(29,29,29);text-align: justify;line-height: 1.5;'>Greetings!<br><br>";
        $body .= "You received this email because your request to switch your existing account into a Corporate account has been approved. To continue, your account has to be verified to activate the Corporate account. Please submit the requirements under the “Corporate Account Verification” tab that is newly added to your cabinet.<br><br>";

        $body .= "For corporate account verification, we require the following documents:<br>";
        $body .= "<span style='padding-left:5em'>1. PROOF OF IDENTITY (for all directors and shareholders)<br></span>";
        $body .= "<span style='padding-left:5em'>2. PROOF OF RESIDENCE (for all directors and shareholders)<br></span>";
        $body .= "<span style='padding-left:5em'>3. DOCUMENTATION <br></span>";
        $body .= "<span style='padding-left:7em'>a. Certificate of Incorporation<br></span>";
        $body .= "<span style='padding-left:7em'>b. Certificate of Good Standing<br></span>";
        $body .= "<span style='padding-left:7em'>c. Certificate of Incumbency, or an official document, listing the director(s) in charge<br></span>";
        $body .= "<span style='padding-left:7em'>d. Certificate of Incumbency, or an official document, listing the shareholder(s) in charge<br></span>";
        $body .= "<span style='padding-left:7em'>e. Last audited financial statements<br></span>";
        $body .= "<span style='padding-left:7em'>f. Articles of Association & Memorandum<br><br></span>";

        $body .= "Once received, our Compliance team will check the documents. You will receive an email from us if we need further documents from you or if account is verified successfully. Should you have more concerns and inquiries regarding ForexMart’s Corporate account, you can contact our customer support here <a href='mailto:support@forexmart.com'><link><a/>.<br><br>";

        $body .= "Thank you for trusting ForexMart to be your trading partner!";
        $body .= "</p>";

        $body .= '<label style="line-height: 20px; clear: left;color: rgb(29,29,29);text-align: justify; font-size: 14px;">Truly yours,</label>';
        $body .= '<label style="line-height: 20px; clear: left;color: rgb(29,29,29);text-align: justify; font-size: 14px;display: block;">ForexMart Team</label>';
        $body .= '</div>';
        $body .= self::NewAdminFooter();
        self::sender($data['email'], $subject, $body, $from, $returnPath);
    }
    public static function AdminHeader()
    {
        $body = '<html>
                <head>
                   
                </head>
                <body style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px;line-height: 1.42857143; color: #333;background-color: #fff;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;height: auto;">';
        $body .= '<div style="margin: 0 auto; width:100%;padding: 0!important">';
        $body .= '<div style="background:url(https://www.forexmart.com/assets/images/header-bg.png); width:100%!important; margin-top:2px; ;border-top: 3px solid #EAEAEA;">';
        $body .= '<img style="width:100%!important;" src="https://www.forexmart.com/assets/images/logo-mailing_v2.png">';
        $body .= '</div>';
        return $body;
    }

    public static function NewAdminFooter(){
        //No unsubscribe button

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
        $body .= "</div>";
        return $body;
    }
}