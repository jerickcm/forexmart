<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fx_mailer
{

    function __construct()
    {
        FXPP::CI()->lang->load('FxMailer');
    }


    private static function CI()
    {
        $CI =& get_instance();
        return $CI;
    }

    public static function ticket_raffle($getTicketRaffleRecord)
    {
        $subject = 'ForexMart Ticket Raffle';
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        $body = self::head();
        $body .= '<div style="margin-bottom: 45px;">';
        $body .= '<img src="https://www.forexmart.com/assets/images/image-bg3.png" style="display: block;max-width: 100%;height: auto;"/>';
        $body .= '<label style="margin-top:30px; color: #5A5A5A;font-size: 14px;float: left;">
' . lang('fxm_tic_raf_01') . '
' . $getTicketRaffleRecord['full_name'] . ',</label>';
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;">';
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>

" . lang('fxm_tic_raf_02') . "
</p>";
        //        Dear
        //        Another trading opportunity is about to unfold. ForexMart is much ecstatic to give away VIP tickets to watch Union Deportiva Las Palmas live in action. Witness firsthand how they compete with the best football teams in Europe at Gran Canaria Stadium. This email serves as a confirmation to your automatic participation in the raffle. Each ForexMart is entitled to receive one (1) raffle entry.

        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_tic_raf_03') . "

</p>";
        //        Playing at “The League of the Stars” - Spanish Promera Division, UD Las Palmas is a football team established on 22 August 1949 in Las Palmas de Gran Canaria in the Canary Islands. The club, which has played 31 seasons in La Liga, entertains most popular Teams from strongest league in Europe.
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_tic_raf_04') . "
<a href='https://www.forexmart.com/tiket-raffle'>https://www.forexmart.com/tiket-raffle</a>
" . lang('fxm_tic_raf_05') . "

  <a href='https://www.forexmart.com/tiket-raffle'>https://www.forexmart.com/tiket-raffle</a>
  " . lang('fxm_tic_raf_06') . "

   </p>";
        //        The raffle promo is open to all ForexMart clients. Visit official Raffle-page
        //        for full mechanics or check the information here
        //        to know more about the renowned football team. Please do not hesitate to contact us should you have questions.
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
  " . lang('fxm_tic_raf_07') . "
</p>";
        //        Have a great trading day ahead!
        $body .= '</p>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;">
  ' . lang('fxm_tic_raf_08') . '

</label>';
        //        All the best,
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;display: block;">
  ' . lang('fxm_tic_raf_09') . '

</label>';
        //        ForexMart Team
        $body .= '</div>';
        $body .= self::foot();
        self::sender($getTicketRaffleRecord['email'], $subject, $body, $from, $returnPath);
    }

    public static function partners_registration_recoveraffiliatecode($email, $fullname, $affiliate_code)
    {

        $subject = lang('partnership_program0');

        $from = "partners@mail.forexmart.com";
        $returnpath = "partnership@forexmart.com";
        $body = self::head();

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">' . $subject . '</h2>';
        $body .= '<label style="color: #5A5A5A;font-size: 14px;float: left;">Dear ' . $fullname . ',</label>';
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;">';
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>".lang('partnership_program1')."</p>";
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'><a href='https://www.forexmart.com/register?id=" . $affiliate_code . "'>https://www.forexmart.com/register?id=" . $affiliate_code . "</a>";
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>".lang('partnership_program2')."</p>";
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>".lang('partnership_program3')."<a href=" . self::CI()->config->item('VerifyAccount') . ">".lang('partnership_program4')."</a>".lang('partnership_program5')."</p>";

        $body .= '</p>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;">'.lang('partnership_program6').'</label>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;display: block;">'.lang('partnership_program7').'</label>';
        $body .= self::foot();
        self::fx_sender_partner($email, $subject, $body, $from, $returnpath);
    }

    public static function partners_registration($partnership_login, $partnership_affiliate)
    {

        $subject = lang('partnership_program0');

        $from = "partners@mail.forexmart.com";
        $returnpath = "partnership@forexmart.com";
        $body = self::head();

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">' . $subject . '</h2>';
        $body .= '<label style="color: #5A5A5A;font-size: 14px;float: left;">' . lang('fxm_par_reg_00') . '

' . $partnership_login['fullname'] . ',</label>';
        //        Dear
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;">';
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_01') . "
</p>";
        //Welcome to ForexMart, the world's most trusted trading partner! We express our profound gratitude for jump-starting your business with us.

        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_02') . "

</p>";
        //        Please take note of your account details below. Keep your account details safe and secure at all times.
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; text-align: center;'>
" . lang('fxm_par_reg_03') . "
" . $partnership_login['account_number'] . " or " . $partnership_login['email'] . "</p>";
        //        Username:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; text-align: center;'>
" . lang('fxm_par_reg_04') . "

" . $partnership_login['trader_password'] . "</p>";
        //        Password:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; text-align: center;'>
" . lang('fxm_par_reg_05') . "

" . $partnership_login['phone_password'] . "</p>";
        //        Phone Password:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; text-align: center;'>
" . lang('AccountNumber') . ":

" . $partnership_login['account_number'] . "</p>";

        //        Phone Password:


        $body .= "<div style='margin: 20px auto 30px auto; display: table;'><a href='" . self::CI()->config->item('PartnerSignIn') . "' style='background: #29a643; color: #fff;border: none;padding: 7px 50px;transition: all ease 0.3s;text-decoration: none;font-size: 14px;'>
" . lang('fxm_par_reg_06') . "

             </a></div>";
        //        Login to your account
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: center;'>
" . lang('fxm_par_reg_07') . "

</p>";
        //        You may start referring clients by using the following affiliate link.
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: center;'><a href='https://www.forexmart.com/register?id=" . $partnership_affiliate['affiliate_code'] . "'>https://www.forexmart.com/register?id=" . $partnership_affiliate['affiliate_code'] . "</a>";
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_08') . "

</p>";
        //        Should you have any issues or questions, please let us know by reaching us at partnership@forexmart.com
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_09') . "

<a href=" . self::CI()->config->item('VerifyAccount') . ">
" . lang('fxm_par_reg_10') . "

</a>
" . lang('fxm_par_reg_11') . "

</p>";

        //        Do not forget to verify your account. Click
        //        here
        //        to begin the verification process. Provide a scanned copy of your valid ID or passport, along with proof of residence. Accepted image file formats include .jpeg, .gif, .pdf, and .png
        $body .= '</p>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;">
' . lang('fxm_par_reg_12') . '

</label>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;display: block;">
' . lang('fxm_par_reg_13') . '

</label>';

        //        All the best,
        //        ForexMart Team

        $body .= self::foot();
       return self::fx_sender_partner($partnership_login['email'], $subject, $body, $from, $returnpath);
    }

    public static function partnersdetails($email, $details, $user_profile)
    {
        $CI =& get_instance();
        $CI->load->model('general_model');
        $residence = $CI->general_model->getCountries($user_profile['country']);
        $target_business = $CI->general_model->getCountries($details['target_country']);

        $strWeb = "";
        if (empty($details['websites'])) {
            $strWeb = 'N/A';
        } else {
            foreach (json_decode($details['websites'], true) as $test) {
                $strWeb .= "<a href='" . urldecode($test) . "'>" . urldecode($test) . "</a> ";
            }
        }

        $message = empty($details['message']) ? 'N/A' : $details['message'];
        $subject = lang("partnersdetails0").$details["reference_num"]."]";
        $to = "partnership@forexmart.com";
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

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">' . $subject . '</h2>';
        $body .= '<table border="1" cellspacing="0" cellpadding="0"  style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: center;line-height: 19px; width: 100%">';
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails1")."</th><td style='width:70%;text-align: left;padding-left: 4px;'> " . $details['reference_num'] . "</td></tr>";

        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails2")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $details['status_type'] . "</td></tr>";

        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails3")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $user_profile['full_name'] . "</td></tr>";
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails4")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $email . "</td></tr>";
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails5")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $details['phone_number'] . "</td></tr>";
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails6")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $residence . "</td></tr>";
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails7")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $target_business . "</td></tr>";
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails8")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $strWeb . "</td></tr>";
        $body .= "<tr><th style='width:30%;text-align: left;padding-left: 4px;'>".lang("partnersdetails9")."</th><td style='width:70%;text-align: left;padding-left: 4px;'>  " . $message . "</td></tr>";
        $body .= '</table>';
        $body .= '<label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">'.lang("partnersdetails10").'</label>';
        $body .= '<label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;">'.lang("partnersdetails11").'</label></br>';

        $body .= self::foot();
        return self::fx_notification_partner($to, $subject, $body, $from, $returnpath);
    }

    public static function fx_sender_partner($to, $subject, $message, $from, $returnpath)
    {
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

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function fx_notification_partner($to, $subject, $message, $from, $returnpath)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
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
        $mail->AddBCC("agus@forexmart.com");
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function sender($to, $subject, $message, $from, $returnpath)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
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


        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }

    }

    public static function MoneyFallRegistrationCode($data)
    {

        $data['insert'] = array(
            'Title' => $data['Title'],
            'FullName' => $data['FullName'],
            'Code' => $data['Code'],
            'Email' => $data['Email']
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MoneyFall Confirmation ';
        $body .= '
                        <h2 style="text-align: center;color: #2988CA;"> '.$data['insert']['Title'].'</h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        '.lang("hi").' '.$data['insert']['FullName'].',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            '.lang("p1-0").'
                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            '.lang("p1-1-0").'
                            <br/>'.lang("p1-1-1").'  <span style="font-weight:bold">'.$data['Code'].'</span>
                        </p>
                        <br/>
                        <br/><a style="text-decoration: none;color: #FFF;font-family: Open Sans;font-size: 17px;font-weight: 600;background: #29A643 none repeat scroll 0% 0%;padding: 10px 20px;transition: all 0.3s ease 0s;" href="'.site_url("confirm/code").'" >Confirm Now</a>
                        <br/>
                        <br/>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           '.lang("fxpp-7115-1").' '.DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday next week ")))->format(' F j, Y').'-'.DateTime::createFromFormat('Y/d/m',date('Y/d/m',strtotime("friday next week")))->format(' F j, Y').'. '.lang("fxpp-7115-2").' <a href="'.FXPP::loc_url('contest/registration').'">'.lang("fxpp-7115-3").'</a> '.lang("fxpp-7115-4").'
                        </p>
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
        self::sender($data['Email'], $subject, $body, $from, $returnPath);
        //        self::sender('trowabarton00005@gmail.com',$subject,$body,$from,$returnPath);

    }

    public static function MoneyFallRegistrationAccess($data)
    {
        $data['space'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MT4 Demo account details ';
        $body .= '
                        <h2 style="text-align: center;color: #2988CA;"> ' . $data['Title'] . '</h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        ' . lang("hi") . ' ' . $data['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            ' . lang("code") . '
                        </p>
                        <br/>
                          <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">
                             <table style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: justify;line-height: 19px;">
                                    <tr>
                                        <th >' . lang("AccountNumber") . '</th>
                                        <td > ' . $data['AccountNumber'] . '</td>
                                    </tr>
                                    <tr>
                                        <th >
                                        ' . lang("fxm_mon_fal_reg_acc_01") . '

                                        </th>
                                        <td > ' . $data['Password'] . '</td>
                                    </tr>
                                    <tr>
                                        <th >
                                        ' . lang("fxm_mon_fal_reg_acc_02") . '

                                        </th>
                                        <td >' . $data['InvestorPassword'] . '</td>
                                    </tr>
                                    <tr>
                                        <th >
                                        ' . lang("fxm_mon_fal_reg_acc_03") . '

                                        </th>
                                        <td >' . MONEYFALL_SERVER_DEMO . '</td>
                                    </tr>


                                </table>
                          </div>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
        ' . $data['space'] . '
         ' . lang("fxm_mon_fal_reg_acc_04") . '

        </p>

        <p style="font-size: 14px;font-family: Arial sans-serif;font-weight: 400;color: #555;margin: 25px 0px 30px 0px;text-align: justify;">
        ' . $data['space'] . '
        <a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe" style="background: none repeat scroll 0 0 #2988ca; border: 1px solid #2988ca; color: #fff; font-family: Arial; font-size: 15px; font-weight: 500; padding: 8px 25px; transition: all 0.3s ease 0s; text-decoration: none;">
        ' . lang("fxm_mon_fal_reg_acc_05") . '

        </a>
        </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
        ' . lang("fxm_mon_fal_reg_acc_06") . '

            <a target="_blank" href="https://www.forexmart.com/faq">
            ' . lang("fxm_mon_fal_reg_acc_07") . '

            </a>
             ' . lang("fxm_mon_fal_reg_acc_08") . '

            </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
         ' . lang("fxm_mon_fal_reg_acc_09") . '

            <a href="#" style="margin: 0 auto;color: #2988ca;text-decoration: none;">support@forexmart.com</a>.
        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          ' . lang("thankyou") . '<br style="margin: 0 auto">
                          ' . lang("closing") . '<br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($data['Email'], $subject, $body, $from, $returnPath);
        //        Trader password:
        //        Investor password:
        //      MT4 Demo Server:
        //        Please store your login details safe and secure at all times.
        //        Download MT4 desktop platform
        //        You may visit our
        //        Frequently Asked Questions
        //      for more technical information. We wish you a successful trading!
        //        For more information please do not hesitate to contact us at
    }

    public static function myhead($title, $type = 0)
    {
        //$type = 0 - client , 1 - partner
        $type = $type ? 'partner' : 'client';
        $CI =& get_instance();
        $CI->lang->load('FxMailer');

        $body = '<html>
                      <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . lang("FMtitle") . '</title>
                     </head>
                     <body style="font-size: 14px; font-family: Arial; font-weight: 400; color: #555">';

        $body .= '<div class="main-wrapper" style="margin: 0 auto; width: 615px">';

        $body .= ' <div class="header-grid" style="margin: 0 auto; width: 100%; min-height: 10px; background: #2988ca; display: block; padding: 7px 15px; box-sizing: border-box">
                        <div class="logo-holder" style="margin: 0 auto">
                            <a style="margin: 0 auto;text-decoration: none;" href="https://www.forexmart.com/"><span style="font-size: 30px;color: #FFF">ForexMart</span></a>
                            <cite class="slogan" style="margin: 0 auto; font-family: Arial; font-size: 14px; font-weight: 400; color: #fff; font-style: normal; margin-left: 7px">' . lang("think") . '<span style="margin: 0 auto; font-weight: 600"> ' . lang("big") . '</span>.' . lang("tradeforex") . '</cite>
                            <a target="_blank" href="https://my.forexmart.com/partner/' . $type . '/signin" class="btn-sign" style="margin: 0 auto; float: right; background: none; border: 1px solid #fff; color: #fff; padding: 7px 15px; font-family: Open Sans; transition: all ease 0.3s">' . lang("signin") . '</a>
                        </div><div class="clear" style="margin: 0 auto; clear: both"></div>
                    </div>

                    <h1 class="h1" style="margin: 0 auto; font-family: Georgia; font-weight: 400; font-size: 25px; color: #2988ca; margin-top: 30px; margin-bottom: 30px; border-bottom: 1px solid #2988ca; padding-bottom: 10px; padding-left: 15px">' . $title . '</h1>';

        $body .= "<div  id='container' style='height:auto;margin:-1px auto 0px auto; border-top:none;'>";

        return $body;

    }

    public static function myfoot()
    {

        $CI =& get_instance();
        $CI->lang->load('FxMailer');

        $body = '<div class="risk-grid" style="margin: 0 auto; padding: 15px">
                    <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify; line-height: 19px">
                        <cite style="margin: 0 auto; font-style: normal; color: #ff0000; font-weight: 600">' . lang("RW") . '</cite>' . lang("RWmsg-0") . '
                        <span style="margin: 0 auto; color: #2988ca; font-weight: 600">' . lang("ForexMart") . '</span>' . lang("RWmsg-1") . '
                        <br style="margin: 0 auto"><br style="margin: 0 auto">
                        ' . lang("RWmsg-2") . '
                    </p>
                </div>

                    <div class="copy-grid" style="margin: 0 auto; padding: 15px; border-top: 3px solid #2988ca">
                        <div class="copy" style="margin: 0 auto; float: left">
                            <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify">' . lang("cpyright") . '</p>
                        </div>
                    </div>

                <div class="clear" style="margin: 0 auto; clear: both"></div>';
        $body .= '</div></body></html>';
        return $body;

    }

    public static function head1()
    {
        $full = '
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
                            <p style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; text-align: justify">� 2015 Tradomart</p>
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

    public function mass_mailer_scheduler($to, $replyto, $from, $pass, $message)
    {
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

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public function testlayoutsender($to, $replyto, $from, $pass, $body, $subject)
    {
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

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public function head_scheduler()
    {
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

    public static function head()
    {
        $body = '<html>
                    <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    </head>
                    <body style="font-family: Helvetica Neue,Arial,sans-serif;">';
        $body .= '<div style="position: relative;width: 800px;margin: 0px auto;">';
        $body .= '<div style="background:#2988ca;padding:10px 0;width: 100%;">';
        $body .= '<img style="margin-left: 10px;" src="https://www.forexmart.com/assets/images/fxlogonew2.png">';
        $body .= '</div>';
        $body .= '<div style="margin: 0 auto; padding: 10px 0; box-sizing: border-box; border-bottom: 1px solid #2988ca; padding-bottom: 60px;border-bottom: 1px solid #2988CA;padding-bottom: 20px;margin-top: 3px;border-top: 1px solid #2988CA;">';


        return $body;
    }

    public static function foot()
    {

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $data = array();
        return $CI->load->view('email/_email_footer_2', $data, true);

        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
        $body .= '<div style="width: 620px; float: left;">';
        $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;">
                    ' . lang('fxm_foot_01') . '

                    </span>
                    ' . lang('fxm_foot_02') . '

                    </span></p></div>';

        //        Risk Warning:
        //                           Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">
  ' . lang('fxm_foot_03') . '

</span>
' . lang('fxm_foot_04') . '

<img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">
' . lang('fxm_foot_05') . '

</p></div>';
        //        ForexMart
        //        is a trading name of
        //        , a Cyprus Investment Firm regulated by the Cyprus Securities Exis a trading name ofchange (CySEC) with license number 266/15.
        $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>
" . lang('fxm_foot_06') . "

</span>
" . lang('fxm_foot_07') . "

 </p></div>";
        //        ForexMart
        //         was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.
        $body .= '<p>&copy;
' . lang('fxm_foot_08') . '
<img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>';
        //        2015
        $body .= '</div>';
        $body .= '<div style="width: 180px;float: right;">';
        $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/cysec.png" style="width: auto;margin: 20px auto;display: block;">';
        $body .= '<img width="124" height="76" src="https://www.forexmart.com/assets/images/mifid.png" style="width: auto;margin: 20px auto;display: block;">';
        $body .= '</div>';
        $body .= '</div>';
        $body .= '</div></body></div>';
        return $body;
    }

    public function footer_scheduler()
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
        $body .= '<div style="width: 620px; float: left;">';
        $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;"> Risk Warning: </span>Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.</span></p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is a trading name of <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p></div>';
        $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>ForexMart</span> was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015..</p></div>";
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

    public function footer_russia_scheduler()
    {
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

    public function testlayout($to, $replyto, $from, $pass, $message, $subject, $lang)
    {
        $body = self::head_scheduler();
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<p style="line-height: 20px; clear: left;">';
        $body .= $message;
        $body .= '</p>';
        $body .= '</div>';

        switch ($lang) {
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

    public function forgot_password($forgot_details)
    {
        $body = self::head_scheduler();
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<h2 style="font-family: Georgia, Times New Roman,serif;font-size: 22px;text-align: center;color: #2988CA;">'.lang('newforgot_password0').'</h2>';
        $body .= '<label style="color: #000;font-size: 14px;float: left;margin-top: 30px;">'.lang('newforgot_password1').'</label>';
        $body .= '<p style="padding-top: 20px; line-height: 20px; font-size: 14px; clear: left;">';
        $body .= lang('newforgot_password2').'<br/><br/>';
        $body .= lang('newforgot_password3').'<br/><br/>';
        $body .= 'https://my.forexmart.com/reset-password/' . $forgot_details['Hash'] . '<br/><br/>';
        $body .= '<br/>';
        $body .= '</p>';
        $body .= '<label style="color: #000;font-size: 14px;">'.lang('newforgot_password4').'</label>';
        $body .= '<label style="color: #000;font-size: 14px;display: block;">'.lang('newforgot_password5').'</label>';
        $body .= '</div>';
        $body .= self::footer_scheduler();
        self::testlayoutsender($forgot_details['Email'], 'support@forexmart.com', 'noreply@contact.forexmart.com', 'XR5u9zD6uR', $body, 'ForexMart Password Reset');
    }


    /**Admin Account Verification Declining of Documents*/
    public static function AccountVerificationDeclinedBothDocuments($data)
    {
        //FXPP-868
        $sentdata = array(
            'SelectedReason' => $data['SelectedReason'],
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
        $subject = 'ForexMart Verification - Declined ' . $sentdata['AccountNumber'] . ' ';
        $body .= '
                       <h2 style="text-align: center;color: #2988CA;">
                        ' . lang('fxm_acc_ver_dec_bot_doc_01') . '

                       </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">


                         ' . lang('fxm_acc_ver_dec_bot_doc_02') . '
                        ' . $data['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/>
                        ' . lang('fxm_acc_ver_dec_bot_doc_03') . '

                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_04') . '  <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName0'] . '"><strong> ' . $sentdata['ClientName0'] . ' </strong></a> ' . lang('fxm_acc_ver_dec_bot_doc_05') . '

                        <br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName1'] . '"><strong> ' . $sentdata['ClientName1'] . ' </strong></a> ' . lang('fxm_acc_ver_dec_bot_doc_06') . '
<br/>
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_07') . '

                        <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName2'] . '"><strong> ' . $sentdata['ClientName2'] . ' </strong></a>

                        <br/>
                        <br/>
                        ' . lang('fxm_acc_ver_dec_bot_doc_08') . '

                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_09') . '  : ' . $sentdata['SelectedReason'] . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_10') . '  ' . $sentdata['ReasonExplanation'] . '
                        <br/>
                        <br/>' . lang('fxm_acc_ver_dec_bot_doc_11') . '   ' . $sentdata['AccountNumber'] . '
                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_12') . '
                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_13') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_14') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_15') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_16') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_17') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_18') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_19') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_20') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_21') . '
                        <br/> ' . lang('fxm_acc_ver_dec_bot_doc_22') . '
                        <br/>

                        </p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           ' . lang("forcode") . '  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">' . lang("supportmail") . '</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          ' . lang('fxm_acc_ver_dec_bot_doc_23') . '
                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'], $subject, $body, $from, $returnPath);
    }

    public static function AccountVerificationDeclined2ndDocuments($data)
    {
        // FXPP-866
        $sentdata = array(
            'SelectedReason' => $data['SelectedReason'],
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
        // if(IPLoc::Office()){
        //     $sentdata = array(
        //     'SelectedReason' => '$data[SelectedReason]' ,
        //     'ReasonExplanation' => '$data[ReasonExplanation]',
        //     'Email' => 'acct.testing001294@gmail.com',
        //     'AccountNumber' => '$data[AccountNumber]',
        //     'FullName' => "$dataaasklfasdkas",

        //     'ClientName0' => 'Только что Вы зарегистрировали аккаунт ФорексМарт для конкурса Деньгопад',
        //     'FileName0' => '$data[FileName0]',
        //     'DocIdx0' => '$data[DocIdx0]',

        //     'ClientName1' => '$data[ClientName1]',
        //     'FileName1' => '$data[FileName1]',
        //     'DocIdx1' => '$data[DocIdx1]',

        //     'ClientName2' => '$data[ClientName2]',
        //     'FileName2' => '$data[FileName2]',
        //     'DocIdx2' => "afasfsad"
        // );
        // }

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $date = date("F j, Y h:i:s A");
        $subject = 'ForexMart Verification - Declined ' . $sentdata['AccountNumber'] . ' ';
        $body .= '
                       <h2 style="text-align: center;color: #2988CA;"> ' . lang('fxm_acc_ver_dec_2nd_doc_01') . ' </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        ' . lang('fxm_acc_ver_dec_2nd_doc_02') . '  ' . $data['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> ' . lang('fxm_acc_ver_dec_2nd_doc_03') . '  <br/>
                        <br/>  ' . lang('fxm_acc_ver_dec_2nd_doc_04') . ' <br/><br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName2'] . '"><strong> ' . $sentdata['ClientName0'] . ' </strong></a>
                        <br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName1'] . '"><strong> ' . $sentdata['ClientName1'] . ' </strong></a> ' . lang('fxm_acc_ver_dec_2nd_doc_05') . '<br/>
                        <br/> ' . lang('fxm_acc_ver_dec_2nd_doc_06') . '
                        <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName2'] . '"><strong> ' . $sentdata['ClientName2'] . ' </strong></a>

                        <br/> ' . lang('fxm_acc_ver_dec_2nd_doc_07') . '  [<a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName1'] . '"><strong> ' . $sentdata['ClientName1'] . ' </strong></a>] ' . lang('fxm_acc_ver_dec_2nd_doc_08') . '

                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_2nd_doc_09') . '  ' . $sentdata['SelectedReason'] . '
                        <br/> ' . lang('fxm_acc_ver_dec_2nd_doc_10') . '  ' . $sentdata['ReasonExplanation'] . '
                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_2nd_doc_11') . '  ' . $sentdata['AccountNumber'] . '
                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           ' . lang("forcode") . '  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">' . lang("supportmail") . '</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                           ' . lang('fxm_acc_ver_dec_2nd_doc_12') . '

                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'], $subject, $body, $from, $returnPath);
    }

    public static function AccountVerificationDeclined1stDocuments($data)
    {
        //FXPP-867
        $sentdata = array(
            'SelectedReason' => $data['SelectedReason'],
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
        $subject = 'ForexMart Verification - Declined [ ' . $sentdata['AccountNumber'] . ' ] ';
        $body .= '
                       <h2 style="text-align: center;color: #2988CA;"> ' . lang('fxm_acc_ver_dec_1st_doc_01') . ' </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        ' . lang('fxm_acc_ver_dec_1st_doc_02') . '  ' . $data['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/>  ' . lang('fxm_acc_ver_dec_1st_doc_03') . '  ' . $data['FullName'] . ', <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_1st_doc_04') . '
                        <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName0'] . '"><strong> ' . $sentdata['ClientName0'] . ' </strong></a> (front)<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName1'] . '"><strong> ' . $sentdata['ClientName1'] . ' </strong></a> (back)
                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_1st_doc_05') . '
                        <br/><br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName2'] . '"><strong> ' . $sentdata['ClientName2'] . ' </strong></a>
                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_1st_doc_06') . '
                        <br/>
                        <br/>' . lang('fxm_acc_ver_dec_1st_doc_07') . '  ' . $sentdata['SelectedReason'] . '
                        <br/> ' . lang('fxm_acc_ver_dec_1st_doc_08') . ' ' . $sentdata['ReasonExplanation'] . '
                        <br/>
                        <br/> ' . lang('fxm_acc_ver_dec_1st_doc_09') . ' ' . $sentdata['AccountNumber'] . '
                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           ' . lang("forcode") . '  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">' . lang("supportmail") . '</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto"
                          ' . lang('fxm_acc_ver_dec_1st_doc_10') . '

                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'], $subject, $body, $from, $returnPath);
    }
    /**Admin Account Verification Declining of Documents*/
    /**Admin Account Verification Approval of Documents*/
    public static function AccountVerificationVerifiedUser($data)
    {
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
        $subject = 'ForexMart Verification - Approved [ ' . $sentdata['AccountNumber'] . ' ] ';
        $body .= '
                       <h2 style="text-align: center;color: #2988CA;"> ' . lang('fxm_acc_ver_ver_use_doc_01') . '  </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                       ' . lang('fxm_acc_ver_ver_use_doc_02') . ' ' . $data['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> ' . lang('fxm_acc_ver_ver_use_doc_03') . '  <br/>
                        <br/> ' . lang('fxm_acc_ver_ver_use_doc_04') . '  <br/><br/>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName0'] . '"><strong> ' . $sentdata['ClientName0'] . ' </strong></a>

                        <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName1'] . '"><strong> ' . $sentdata['ClientName1'] . ' </strong></a>

                        <br/>

                        <br/> ' . lang('fxm_acc_ver_ver_use_doc_05') . '

                         <br/><br/>

                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['FileName2'] . '"><strong> ' . $sentdata['ClientName2'] . ' </strong></a>

                        <br/>
                        <br/> ' . lang('fxm_acc_ver_ver_use_doc_06') . '
                        <br/>
                         <br/> ' . lang('fxm_acc_ver_ver_use_doc_07') . '
                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           ' . lang("forcode") . '  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">' . lang("supportmail") . '</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          ' . lang('fxm_acc_ver_ver_use_doc_08') . '

                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'], $subject, $body, $from, $returnPath);
    }

    public static function AccountVerificationDocumentApproved($data)
    {

        $sentdata = array(
            'Email' => $data['Email'],
            'DocumentFilename' => $data['DocumentFilename'],
            'HashFilename' => $data['HashFilename'],
            'FullName' => $data['FullName'],
            'AccountNumber' => $data['AccountNumber'],
            'DocIdx' => $data['DocIdx']
        );

        if ($sentdata['DocIdx'] == 2) {
            $document = 'Second';
        } else if ($sentdata['DocIdx'] == 0) {
            $document = 'the front copy of the first';
        } else if ($sentdata['DocIdx'] == 1) {
            $document = 'the back copy of the first';
        }

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart Verification Document Approved [ ' . $sentdata['AccountNumber'] . ' ] ';
        $body .= '
                       <h2 style="text-align: center;color: #2988CA;"> ' . lang('fxm_acc_ver_doc_app_01') . ' </h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        ' . lang('fxm_acc_ver_doc_app_02') . '  ' . $data['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">

                        <br/> ' . lang('fxm_acc_ver_doc_app_03') . '  <a href="' . $CI->config->item('domain-my') . '/assets/user_docs/' . $sentdata['HashFilename'] . '"> <strong> ' . $sentdata['DocumentFilename'] . ' </strong></a>
                        <br/>
                        <br/>' . lang('fxm_acc_ver_doc_app_04') . '   ' . $document . ' ' . lang('fxm_acc_ver_doc_app_05') . '

                        <br/>
                        <br/> ' . lang('fxm_acc_ver_doc_app_06') . '

                        <br/></p>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                           ' . lang("forcode") . '  <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">' . lang("supportmail") . '</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                          <br style="margin: 0 auto">
                          ' . lang('fxm_acc_ver_doc_app_07') . '

                          <br style="margin: 0 auto">
                          <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($sentdata['Email'], $subject, $body, $from, $returnPath);
    }
    /**Admin Account Verification Approval of Documents*/

    //Mailer Test Mail responsive
    public static function MailerSchedulerTest($to, $replyto, $from, $pass, $message, $subject, $lang, $unsubscribe_key)
    {
        $body = self::MailerSchedulerHeadTest();
        $body .= '<div style="max-width:100%;">';
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<p style="line-height: 20px; clear: left;">';
        $body .= '<p><img src="https://my.forexmart.com/assets/user_docs/bb8b520f36e96f80b47e13959825308ede973229.png" style="width: 100%"><span style="color: rgb(66, 66, 66); line-height: 1.42857; text-align: justify;"></span></p><div style="color: rgb(66, 66, 66); text-align: left;"><span style="text-align: justify; line-height: 1.42857;">Many happy returns of the day from all ForexMart team!</span><span style="text-align: justify; line-height: 1.42857;">&nbsp;</span></div><div style="text-align: justify;"><span style="color: rgb(66, 66, 66);"><br></span></div><span style="color: rgb(66, 66, 66); text-align: justify;"><div style="text-align: justify;"><span style="line-height: 1.42857;">We would like to let you know how honored we are to have an opportunity to guide you in every step of your trading journey. Our company is sincerely grateful for the confidence and trust you have put in ForexMart.</span><span style="line-height: 1.42857;">&nbsp;</span></div></span><div style="text-align: justify;"><br></div><span style="color: rgb(66, 66, 66); text-align: justify;"><div style="text-align: justify;"><span style="line-height: 1.42857;">On this special day, ForexMart wishes you nothing but a rewarding and successful trades in the upcoming days, months, and years. May our business relationship remain as flourishing as ever. May the heavens storm you with boundless trading opportunities.</span><span style="line-height: 1.42857;">&nbsp;</span></div></span><div style="text-align: justify;"><br></div><span style="color: rgb(66, 66, 66); text-align: justify;"><div style="text-align: justify;"><span style="line-height: 1.42857;">Have a wonderful birthday celebration!</span></div></span><label style="display: block; font-weight: normal; padding-top: 30px; text-align: justify;"><div style="text-align: justify;"><span style="color: rgb(66, 66, 66); line-height: 1.42857;">Best regards,</span></div><span style="text-align: justify; display: block;"><span style="color: rgb(66, 66, 66);">ForexMart Team</span></span></label><p></p>';
        $body .= '</div>';

        $footer = self::MailerSchedulerFooter();

        $body .= $footer;
        self::MailerSchedulerSender($to, $replyto, $from, $pass, $body, $subject);
    }


    //Mailer Scheduler Cron
    public static function MailerScheduler($to, $replyto, $from, $pass, $message, $subject, $lang, $unsubscribe_key)
    {
        $body = self::MailerSchedulerHead();
        $body .= '<div style="max-width:100%;">';
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<p style="line-height: 20px; clear: left;">';
        $body .= $message;

        $body .= '</p>';
        $body .= '<div><a style="font-size: 12px; text-decoration: none;" href="https://www.forexmart.com/unsubscribe/ref/' . $unsubscribe_key . '">Unsubscribe from this email</a></div>';
        $body .= '</div>';

        switch ($lang) {
            case 'Russian':
                $footer = self::MailerSchedulerFooterRu();
                break;
            default:
                $footer = self::MailerSchedulerFooter();
                break;
        }

        $body .= $footer;
        self::MailerSchedulerSender($to, $replyto, $from, $pass, $body, $subject);
    }

    //Mailer Scheduler Special Cron
    public static function MailerSchedulerSpecial($to, $replyto, $from, $pass, $message, $subject, $lang, $unsubscribe_key, $name)
    {
        $body = self::MailerSchedulerHead();
        $body .= '<div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">';
        $body .= '<label style="margin-top:20px;margin-bottom:20px; color: #5A5A5A;float: left;">Dear <b> ' . $name . '</b>,</label>';
        $body .= '<p style="line-height: 20px; clear: left;">';
        $body .= $message;

        $body .= '</p>';
        $body .= '<div><a style="text-decoration: none;" href="https://www.forexmart.com/unsubscribe/ref/' . $unsubscribe_key . '">Unsubscribe from this email</a></div>';
        $body .= '</div>';

        switch ($lang) {
            case 'Russian':
                $footer = self::MailerSchedulerFooterRu();
                break;
            default:
                $footer = self::MailerSchedulerFooter();
                break;
        }

        $body .= $footer;
        self::MailerSchedulerSender($to, $replyto, $from, $pass, $body, $subject);
    }

    public static function MailerSchedulerHeadTest()
    {
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = '<html>
                <head></head>
                <body style="font-family: Helvetica Neue,Arial,sans-serif;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;">';
        $body .= '<div style="background:#2988ca; padding:10px; max-width:100%;">';
        $body .= '<div style="max-width:457px;">';
        $body .= '<img style="width:100%; display:block;" src="https://www.forexmart.com/assets/images/logo2.png">';
        $body .= '</div>';
        $body .= '</div>';
        return $body;

    }

    public static function MailerSchedulerHead()
    {
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = '<html>
                <head></head>
                <body style="font-family: Helvetica Neue,Arial,sans-serif;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;">';
        $body .= '<div style="background:#2988ca; padding:10px; max-width:100%;">';
        $body .= '<div style="max-width:457px;">';
        $body .= '<img style="width:100%; display:block;" src="https://www.forexmart.com/assets/images/fxlogonew2.png">';
        $body .= '</div>';
        $body .= '</div>';
        return $body;
    }

    public static function MailerSchedulerFooterRu()
    {
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

    public static function MailerSchedulerFooter()
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:100%; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
        $body .= '<div>';
        $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;"> Risk Warning: </span>Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss.</p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is official partner of UD Las Palmas.</p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is a trading name of <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p></div>';
        $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>ForexMart</span> was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.</p></div>";
        $body .= '<div><p>International Finance Magazine (IFM) awarded <span style="font-weight: 600;color:#2988ca;">ForexMart</span> " Best New Broker Europe 2016 "</p></div>';
        $body .= '<a href="#" style="display: inline-block;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/fxlogonew.png"></a>';
        $body .= '<p>&copy; 2015 - 2016 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>';
        $body .= '</div>';
        $body .= '<div  style="margin: 0;text-align: center;">';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/cysec.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mifid.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/amf.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/bafin.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/fca.png"></a>';
        $body .= '<div style="margin: 0;text-align: center;">';
        //        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/fsp.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/pfsa.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/acpr.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/consob.png"></a>';
        $body .= '</div>';
        $body .= '</div>';
        $body .= '</div></body></div>';
        return $body;
    }

    public static function MailerSchedulerSender($to, $replyto, $from, $pass, $body, $subject)
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
        $mail->Password = 'n342Z2wKV4';
        $mail->DKIM_domain = "notify.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo($replyto, $name);
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

    public static function NewMailerSchedulerSender($to, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.notices.forexmart.com";
        $mail->Port = 25;
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->Username = 'noreply@notices.forexmart.com';
        $mail->Password = '5yqa6RXe5Q';
        $mail->DKIM_domain = "notices.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        //            $mail->AddReplyTo('noreply@notices.forexmart.com', $name);
        $mail->SetFrom('noreply@notices.forexmart.com', $name);
        $mail->Subject = 'This is the Next Big Thing';
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }

    }


    public static function Forexmart_Landing_RCode($data)
    {

        $data['insert'] = array(
            'Title' => $data['Title'],
            'Fullname' => $data['Fullname'],
            'Code' => $data['Code'],
            'Email' => $data['Email']
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart Account Activation ';
        $body .= '
                        <h2 style="text-align: center;color: #2988CA;"> ' . lang('flrc_title') . '</h2>
                            <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">
                            ' . lang("hi") . ' ' . $data['insert']['Fullname'] . ',
                            </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            ' . lang('flrc_01') . '
                         </p>
                             <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                                <a href="' . FXPP::my_url("client/signin?activate=" . $data['insert']['Code']) . '"> ' . lang('flrc_02') . '</a>
                            </p>
                        <br/>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                            ' . lang('flrc_03') . '<a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">   bonuses@forexmart.com </a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            ' . lang("thankyou") . '<br style="margin: 0 auto">
                             ' . lang("closing") . '<br style="margin: 0 auto">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($data['Email'], $subject, $body, $from, $returnPath);

    }


    public static function MoneyFallRegistrationCode_resend($data)
    {
        $data['insert'] = array(
            'Title' => utf8_decode($data['Title']),
            'FullName' => $data['FullName'],
            'Code' => utf8_decode($data['Code']),
            'Email' => utf8_decode($data['Email'])
        );
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MoneyFall Confirmation ';
        $body .= '
                        <h2 style="text-align: center;color: #2988CA;"> ' . $data['insert']['Title'] . '</h2>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">

                        ' . lang("hi") . ' ' . $data['insert']['FullName'] . ',

                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            ' . lang("p1-0") . '
                        </p>
                        <br/>' . lang("p1-1-0") . '
                        <br/>' . lang("p1-1-1") . '  <span style="font-weight:bold">' . $data['Code'] . '</span>
                        <br/>
                        <br/>
                        <br/><a style="text-decoration: none;color: #FFF;font-family: Open Sans;font-size: 17px;font-weight: 600;background: #29A643 none repeat scroll 0% 0%;padding: 10px 20px;transition: all 0.3s ease 0s;" href="' . site_url("confirm/code") . '" >Confirm Now</a>
                        <br/>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                            ' . lang("forcode") . ' <a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">  ' . lang("supportmail") . '</a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            ' . lang("thankyou") . '<br style="margin: 0 auto">
                             ' . lang("closing") . '<br style="margin: 0 auto">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        //        self::sender($data['Email'],$subject,$body,$from,$returnPath);
        self::sender('trowabarton00005@gmail.com', $subject, $body, $from, $returnPath);
        //        self::sender('agus@forexmart.com',$subject,$body,$from,$returnPath);

    }

    public static function Forexmart_Landing_RCode_resend($data)
    {

        $data['insert'] = array(
            'Title' => $data['Title'],
            'Fullname' => $data['Fullname'],
            'Code' => $data['Code'],
            'Email' => $data['Email']
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart Account Activation ';
        $body .= '
                        <h2 style="text-align: center;color: #2988CA;"> ' . lang('flrc_title') . '</h2>
                            <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">
                            ' . lang("hi") . ' ' . $data['insert']['Fullname'] . ',
                            </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            ' . lang('flrc_01') . '
                         </p>
                             <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                                <a href="' . FXPP::my_url("client/signin?activate=" . $data['insert']['Code']) . '"> ' . lang('flrc_02') . '</a>
                            </p>
                        <br/>
                        <p class="last-word" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify">
                            ' . lang('flrc_03') . '<a style="margin: 0 auto; color: #2988ca; text-decoration: none" href="./#NOP" onclick="return false" rel="noreferrer">   bonuses@forexmart.com </a>.
                        </p>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            ' . lang("thankyou") . '<br style="margin: 0 auto">
                             ' . lang("closing") . '<br style="margin: 0 auto">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">' . lang("ForexMart") . '</span> ' . lang("team") . '
                        </p>
                    </div>';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        self::sender($data['Email'], $subject, $body, $from, $returnPath);
        //        self::sender('trowabarton00005@gmail.com',$subject,$body,$from,$returnPath);

    }

    // vic
    public static function header_new()
    {
        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = '<html>
                <head>
                <style>
                .ji {
                        padding-top: 0em!important;
                        color: #000000;
                    }
                </style>
                </head>
                <body style="font-family: Helvetica Neue,Arial,sans-serif;">';
        $body .= '<div style="position: relative; margin: 0px auto; max-width: 800px; overflow:hidden;" display:block;>';
        $body .= '<div style=" background: url(https://www.forexmart.com/assets/images/header-bg.png); padding:10px; width:100%;">';
        $body .= '<div style="width:45%;">';
        $body .= '<img style="width:100%; display:block;" src="https://www.forexmart.com/assets/images/logo2.png">';
        $body .= '</div>';
        $body .= '</div>';
        // echo $body;
        return $body;
    }

    public static function Mailertest_singapore_client($to)
    {
        $body = self::header_new();
        $body .= '<div style="max-width:100%;">';
        $body .= '<img src="https://www.forexmart.com/assets/images/singapore-banner.png" style="display: block;max-width: 100%;height: auto;"/>';
        $body .= '<div style="text-align: justify; line-height: 1;"><p align="justify" style="font-size: medium; line-height: normal; font-family: Arial; margin-top: 15px;"><span style="font-size: 14px; background-color: rgb(255, 255, 255);">Dear Client,</span></p><p align="justify" style="font-size: medium; line-height: normal; font-family: Arial; margin-top: 15px;"><span style="background-color: rgb(255, 255, 255);"><span style="font-family: Arial, sans-serif; text-align: start;"><span style="font-size: 14px;">We would like to invite you to come and</span><span style="font-weight: bold; font-size: 14px;">&nbsp;join us at ShowFx</span><span style="font-size: 14px;">&nbsp;World Asia Annual&nbsp;</span><span style="font-weight: bold; font-size: 14px;">Financial Conference in Singapore</span><span style="font-size: 14px;">&nbsp;on</span><span style="font-weight: bold; font-size: 14px;"> September 17, 2016</span><span style="font-size: 14px;">&nbsp;at</span><span style="font-weight: bold; font-size: 14px;">&nbsp;Marina Bay Sands Expo and Convention Center</span><span style="font-size: 14px;">. The conference will be held in Singapore, one of Asia’s economic tigers. Guests to the conference can get the chance to talk with ForexMart representatives, learn about the most&nbsp;</span><span style="font-weight: bold; font-size: 14px;">recent developments&nbsp;</span><span style="font-size: 14px;">in the foreign exchange market, and learn from the&nbsp;</span><span style="font-weight: bold; font-size: 14px;">most well-known trading experts</span><span style="font-size: 14px;">&nbsp;in the financial industry. Participants can also win prizes in raffle draws and get trading bonuses from ForexMart.</span></span><br></span></p><p align="justify" style="font-size: medium; line-height: normal; font-family: Arial; margin-top: 15px;"><span style="background-color: rgb(255, 255, 255);"><span style="font-size: 14px;">ShowFx World Asia’s Annual Financial Conference’s admission is&nbsp;</span><b><span style="font-size: 14px;">absolutely free</span></b>.</span></p><p align="justify" style="font-size: medium; line-height: normal; font-family: Arial; margin-top: 15px;"><span style="background-color: rgb(255, 255, 255);"><span style="font-size: 14px;">See you on&nbsp;</span><b><span class="aBn" data-term="goog_1859456138" tabindex="0" style="border-bottom: 1px dashed rgb(204, 204, 204); position: relative; top: -2px; z-index: 0;"><span class="aQJ" style="position: relative; top: 2px; z-index: -1; font-size: 14px;">September 17</span></span><span style="font-size: 14px;">!</span></b></span></p><p align="justify" style="font-size: medium; line-height: normal; font-family: Arial; margin-top: 15px;"><span class="im" style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 12.8px; text-align: start; background-color: rgb(255, 255, 255);"></span></p><p align="justify" style="font-size: medium; line-height: normal; font-family: Arial; margin-top: 15px;"><span style="font-size: 14px; background-color: rgb(255, 255, 255);">Warmest regards,</span><br><span style="color: rgb(41, 136, 202); margin: 0px auto; font-weight: 600; font-size: 14px;">ForexMart</span></p></div>';
        $body .= '</div>';
        $footer = self::MailerSchedulerFooter();
        // $footer = self::foot();
        $body .= $footer;
        // echo $body;
        // self::Mailersender_singapore('mailing_test_group@forexmart.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        // self::Mailersender_singapore('newbee4test1@gmail.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
    }

    public static function Mailertest_singapore_partner($to)
    {
        $body = self::header_new();
        $body .= '<div style="max-width:100%;">';
        $body .= '<img src="https://www.forexmart.com/assets/images/singapore-banner.png" style="display: block;max-width: 100%;height: auto;"/>';
        $body .= '<p align="justify" style="font-size: medium; line-height: 1; text-align: justify; font-family: Arial; margin-top: 15px;"><span style="font-size: 14px; background-color: rgb(255, 255, 255);">Dear Partner,</span></p><div style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: medium; line-height: 1; text-align: justify;"><span style="background-color: rgb(255, 255, 255);"><span style="font-size: 14px;">ForexMart invites you this coming</span><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px; font-weight: bold;">September 17, 2016</span><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px;">at the</span><span style="font-size: 14px;">&nbsp;</span><span style="font-family: Arial, sans-serif; line-height: 1.42857; font-weight: bold; font-size: 14px;">Marina Bay Sands Expo and Convention Centre</span><span style="font-family: Arial, sans-serif; line-height: 1.42857;"><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px;">to attend ShowFx World Asia Annual Financial Conference in</span><span style="font-size: 14px;">&nbsp;</span></span><span style="font-family: Arial, sans-serif; line-height: 1.42857; font-weight: bold; font-size: 14px;">Singapore</span><span style="font-family: Arial, sans-serif; line-height: 1.42857;"><span style="font-size: 14px;">. The event aims to unite members of the Forex community, including new traders and</span><span style="font-size: 14px;">&nbsp;</span></span><span style="font-family: Arial, sans-serif; line-height: 1.42857; font-weight: bold; font-size: 14px;">well-known experts</span><span style="font-family: Arial, sans-serif; line-height: 1.42857;"><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px;">in the field. Participants can get the chance to meet and talk with ForexMart representatives, learn about the</span></span><span style="font-family: Arial, sans-serif; line-height: 1.42857; font-weight: bold;"><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px;">latest updates in the market</span></span><span style="font-family: Arial, sans-serif; line-height: 1.42857; font-size: 14px;">, and</span><span style="font-family: Arial, sans-serif; line-height: 1.42857; font-weight: bold;"><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px;">trading tips</span></span><span style="font-family: Arial, sans-serif; line-height: 1.42857;"><span style="font-size: 14px;">&nbsp;</span><span style="font-size: 14px;">from the world’s top finance experts while enjoying the sights and sounds of Singapore. Official ForexMart representatives will also be very happy to talk with partners about company’s plans for Asian development and prospective financial strategies in the region during the conference.</span></span></span></div><p align="justify" style="font-size: medium; line-height: 1; text-align: justify; font-family: Arial; margin-top: 15px;"><span style="background-color: rgb(255, 255, 255);"><span style="font-size: 14px;">Admission to the</span><span style="font-size: 14px;">&nbsp;</span><b><span style="font-size: 14px;">Annual Financial Conference is free. </span></b></span></p><p align="justify" style="font-size: medium; line-height: 1; text-align: justify; font-family: Arial; margin-top: 15px;"><span style="font-size: 14px; background-color: rgb(255, 255, 255);">See you in Singapore!</span></p><p align="justify" style="font-size: medium; line-height: 1; text-align: justify; font-family: Arial; margin-top: 15px;"><span style="font-size: 14px; background-color: rgb(255, 255, 255);">Kind regards,</span></p><p align="justify" style="font-size: medium; line-height: 1; text-align: justify; font-family: Arial; color: rgb(85, 85, 85); margin-top: 15px;"><span style="color: rgb(41, 136, 202); font-size: 14px; font-weight: 600; background-color: rgb(255, 255, 255);">ForexMart</span></p>';
        $body .= '</div>';
        $footer = self::MailerSchedulerFooter();
        // $footer = self::foot();
        $body .= $footer;
        // echo $body;
        // self::Mailersender_singapore('mailing_test_group@forexmart.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        // self::Mailersender_singapore('newbee4test1@gmail.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        // self::Mailersender_singapore('mottakaquezo68@gmail.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
    }

    public static function Mailertest_singapore_client2($to, $replyto, $subject)
    {
        $body = self::header_new();
        $body .= '<div style="width:100%;">';
        $body .= '<img src="https://www.forexmart.com/assets/images/singapore.png" style="display: block;width: 100%;height: auto;"/>';
        $body .= '<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Dear&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif;">ForexMart&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Client,</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Greetings!</span></p>
<p style="text-align: justify; margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">We would like to remind you of ShowFx World Asia Annual Financial Conference this coming September 17, 2016 at the Marina Bay Sands Expo and Convention Centre in Singapore. Get to know the latest developments in the financial industry, meet and talk with ForexMart representatives, and get trading bonuses from ForexMart while enjoying sights at Singapore’s main attractions.</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Admission to the Annual Financial Conference is free.</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">See you in Singapore!</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Best regards,</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">ForexMart</span></p>';
        $body .= '</div>';

        $footer = self::MailerSchedulerFooter2();
        // $footer = self::foot();
        $body .= $footer;
        // self::Mailersender_singapore('mailing_test_group@forexmart.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        // self::Mailersender_singapore('newbee4test1@gmail.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        self::Mailersender_singapore($to, $replyto, $body, $subject);
        echo $body;
    }

    public static function Mailertest_singapore_partner2($to, $replyto, $subject)
    {
        $body = self::header_new();
        $body .= '<div style="width:100%;">';
        $body .= '<img src="https://www.forexmart.com/assets/images/singapore.png" style="display: block;width: 100%;height: auto;"/>';
        $body .= '<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Dear ForexMart Partner,</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">Greetings!</span></p>
<p style="text-align: justify; margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">ForexMart would like to remind you to attend the ShowFx World Asia Annual Financial Conference to be held in Marina Bay Sands Expo and Convention Centre in Singapore this September 17, 2016. Participants can experience Singapore while discussing with their ForexMart brokers and get great trading bonuses from us. Official ForexMart representatives will also be very happy to discuss with partners company’s future plans for Asian financial development, as well as plans for other financial strategies in Asia during the convention.</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">The admission for the Annual Financial Conference is free.</span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif;"><br></span><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; line-height: 1.42857;">See you in Singapore!</span></span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif;"><br></span><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; line-height: 1.42857;">Kindest regards,</span></span></p>
<p style="margin-top: 10px; margin-bottom: 0px; padding: 0px; line-height: 1.4;"><span style="color: rgb(51, 51, 51); font-family: Arial, sans-serif; background-color: rgb(255, 255, 255);">ForexMart</span></p>';
        $body .= '</div>';
        $footer = self::MailerSchedulerFooter2();
        // $footer = self::foot();
        $body .= $footer;
        // echo $body;
        // self::Mailersender_singapore('mailing_test_group@forexmart.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        // self::Mailersender_singapore('newbee4test1@gmail.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        // self::Mailersender_singapore('mottakaquezo68@gmail.com', 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Singapore');
        echo $body;
        self::Mailersender_singapore($to, $replyto, $body, $subject);
    }

    public static function footer_new()
    {
        $body .= '     <div style="position:relative;  border-top:1px solid #002036; background-image:url(https://www.forexmart.com/assets/images/univ-bg-footer.png);  padding:20px; display:table;">';
        $body .= '             <p style="line-height:15px; font-size:13px;  color:#b8e0ff; text-align:justify; padding:10px 0;"> ';
        $body .= '                 <span style="color:#ff0000; font-weight:bold;"> ';
        $body .= '                   Risk Warning: ';
        $body .= '                 </span> ';
        $body .= '                     Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial  gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.';
        $body .= '                     </br> ';
        $body .= '                     </br> ';
        $body .= '                     ForexMart is official partner of Las Palmas. ';
        $body .= '                 </br></br><span style="font-weight:bold; color: #2988ca;">ForexMart</span> is a trading name of <img class="tradomart-ltd" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10"/> , a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15. ';
        $body .= '                 </br></br><span style="font-weight:bold; color: #2988ca;">ForexMart</span> was named by ShowFx World as the Best Broker in Europe 2015 and Most  Perspective Broker in Asia 2015.';
        $body .= '                 <br></br>International Finance Magazine (IFM) awarded ForexMart "Best New Broker Europe 2016" ';
        $body .= '                 </br></br>&copy; 2015 - 2016 <img class="tradomart-ltd" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101"  height="10"/>';
        $body .= '             </p> ';
        $body .= '       <div style="float:none!important; display:table;  margin:0 auto;     max-width: 100%;    height: auto;     vertical-align: middle;    border: 0;     width: 100%; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;"> ';
        $body .= '         <div style="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/cysec3.png" style="    max-width: 100%;    height: auto;    margin: 0 auto;    border: 0;    vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/mifid3.png" style="    max-width: 100%;    height: auto;      margin: 0 auto;    border: 0;    vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/autorite3.png" style="    max-width: 100%; height: auto;       margin: 0 auto;    border: 0;    vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/bafin3.png" style="    max-width: 100%; height: auto; margin: 0 auto; border: 0; vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '       </div> ';
        $body .= '       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="float:none!important; padding-top:10px; display:table;  margin:0 auto;     width: 100%; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;"> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/fca3.png" style="    max-width: 100%; height: auto; margin: 0 auto; border: 0; vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/polish3.png" style="    max-width: 100%; height: auto; margin: 0 auto; border: 0; vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/acpr3.png" style="    max-width: 100%; height: auto; margin: 0 auto; border: 0; vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '         <div class="display: table;    margin: 0 auto;    max-width: 100%;    height: auto;    vertical-align: middle;    border: 0;"> ';
        $body .= '           <img src="https://www.forexmart.com/assets/images/consob3.png" style="    max-width: 100%; height: auto; margin: 0 auto; border: 0; vertical-align: middle; display:table;  margin:0 auto;"/> ';
        $body .= '         </div> ';
        $body .= '       </div> ';
        $body .= '     </div> ';
        return $body;
    }

    public static function footerNew()
    {
        $body = '       <div style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:table;position:relative;border-top-width:1px;border-top-style:solid;border-top-color:#002036;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px; padding: 0!important;    max-width:800px; margin:0 auto;  position: relative;    min-height: 1px;
                position:relative;  border-top:1px solid #002036; background-image:url(https://www.forexmart.com/assets/images/univ-bg-footer.png);  padding:20px; display:table;" >
          <div class="wrapper-footer-left" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:100%;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
            <p style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;margin-top:0;margin-bottom:10px;margin-right:0;margin-left:0;padding-top:10px;padding-bottom:10px;padding-right:0;padding-left:0;text-align:justify;font-size:13px;line-height:15px;color:#b8e0ff;" ><span class="span-label-red" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;color:#ff0000;font-weight:bold;" >Risk Warning:</span> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.
            </br></br>ForexMart is official partner of Las Palmas.
            </br></br><span class="span-label-blue" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;color:#2988ca;font-weight:bold;" >ForexMart</span> is a trading name of <img class="tradomart-ltd" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;margin-bottom:3px;" /> , a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.
            </br></br><span class="span-label-blue" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;color:#2988ca;font-weight:bold;" >ForexMart</span> was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.
            <br style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;" ></br>International Finance Magazine (IFM) awarded ForexMart "Best New Broker Europe 2016"
            </br></br>&copy; 2015 - 2016 <img class="tradomart-ltd" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;margin-bottom:3px;" />
            </p>
          </div>
          <div class="footer-payment-systems col-lg-12 col-md-12 col-sm-12 col-xs-12" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;min-height:1px;padding-right:15px;padding-left:15px;width:100%;float:none!important;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" >
            <div class="first-liner-footer-payment" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;" >
              <div class="footer-payment-sys-child-new" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:16.66%;float:left;display:table;" >
                <img src="https://www.forexmart.com/assets/images/cysec.png" class="img-responsive" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;height:auto;max-width:80%;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" />
              </div>
              <div class="footer-payment-sys-child-new" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:16.66%;float:left;display:table;" >
                <img src="https://www.forexmart.com/assets/images/fcab.png" class="img-responsive" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;height:auto;max-width:80%;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" />
              </div>
              <div class="footer-payment-sys-child-new" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:16.66%;float:left;display:table;" >
                <img src="https://www.forexmart.com/assets/images/autorite.png" class="img-responsive" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;height:auto;max-width:80%;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" />
              </div>
            </div>
            <div class="first-liner-footer-payment" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;" >
              <div class="footer-payment-sys-child-new" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:16.66%;float:left;display:table;" >
                <img src="https://www.forexmart.com/assets/images/mifid.png" class="img-responsive" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;height:auto;max-width:80%;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" />
              </div>
              <div class="footer-payment-sys-child-new" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:16.66%;float:left;display:table;" >
                <img src="https://www.forexmart.com/assets/images/bafinb.png" class="img-responsive" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;height:auto;max-width:80%;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" />
              </div>
              <div class="footer-payment-sys-child-new" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;width:16.66%;float:left;display:table;" >
                <img src="https://www.forexmart.com/assets/images/consobb.png" class="img-responsive" style="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border-width:0;vertical-align:middle;height:auto;max-width:80%;display:table;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" />
              </div>
            </div>
          </div>
        </div></div>';
        return $body;
    }


//
    public static function Rpj($to)
    {
        $body = self::header_new();
        $body .= '<img src="https://lh5.googleusercontent.com/steISVceYOVs404iruHdvjMacH34AAPg-TORSeFIYzf0C_NNAULk182V-tYCsuEyXl4XTEF2K93rjwUTU8kJ4RhL-wCFQz2J_EltzT-hSl3x4IdTWn26uuAEsrBFvQH5qBrzDjpc" style="border-width: initial; border-style: none; transform: rotate(0rad); width: 100%;" alt="banner-rpj4.png"><span style="font-size: 14px;"><br><br>Dear Trader,</span><br><br><span style="font-size: 14px;">ForexMart is pleased to announce the official partnership with RPJ Racing. </span><br><br><span style="font-size: 14px;">RPJ Racing is the company of racing and rock legend Rick Parfitt Jnr. It has a long history of success in racing and in winning. It’s latest undertaking is the British GT Championship, a world-renowned racing competition attended by the elites of the racing industry. Rick Parfitt Jnr himself is in the competition this year aboard the Bentley GT3. As a former 2013 GT4 Champion, expectations are high for him. He joins the Bentley Team Parker.</span><p><b style="font-weight: normal; font-family: Helvetica;"></b></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text</p>-align: justify;"><span style="font-family: Helvetica;"><span style="font-size: 14px; color: rgb(51, 51, 51); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; background-color: rgb(255, 255, 255);">We believe that this partnership will stimulate mutual growth for both companies and</span><span style="font-size: 14px; color: rgb(0, 0, 0); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> expected to bear a fruitful collaboration between the two companies with the aim of mutual growth through joint campaigns and new promotions.</span></span></p><p><b style="font-weight: normal; font-family: Helvetica;"></b></p><span style="font-size: 14px;">Follow us on social media to keep updated with our latest endeavors.</span><p><b style="font-weight: normal; font-family: Helvetica;"></b></p><span style="font-size: 14px;">ForexMart and RPJ Racing looks forward to a great partnership to provide a better service to you, our clients.</span><p><b style="font-weight: normal; font-family: Helvetica;"></b></p><span style="font-size: 14px;">All the best,</span><br><span style="font-size: 14px;">ForexMart</span>';
        $body .= self::MailerSchedulerFooter2();
        echo $body;
        // self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ForexMart - RPJ Racing Partnership');
    }

    public static function newNav()
    {
        $body = '<div style="    padding: 0!important;    max-width:800px; margin:0 auto;  position: relative;    min-height: 1px;">
                <div style="background: url(https://www.forexmart.com/assets/images/header-bg.png) no-repeat; ">
        <img src="https://www.forexmart.com/assets/images/logo-mailing_v2.png" class="img-responsive" style="width: 800px; margin: 0px auto; color: rgb(51, 51, 51);">
        </div>';
        echo $body;
    }

    public static function newFooter()
    {
        $body = '<div style="    padding: 0!important;    max-width:800px; margin:0 auto;  position: relative;    min-height: 1px;"><div  style="display: table; position: relative; border-top: 1px solid rgb(0, 32, 54); padding: 5px 20px 20px; color: rgb(51, 51, 51); background-image: url(https://www.forexmart.com/assets/images/univ-bg-footer.png);"><div class="wrapper-footer-left" style="width: 760px; padding: 0px;"><p style="padding: 10px 0px; color: rgb(184, 224, 255); text-align: justify; font-size: 13px; line-height: 15px;"><span class="span-label-red" style="color: rgb(255, 0, 0); font-weight: bold;">Risk Warning:</span>
        &nbsp;Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.&nbsp;<br><br>ForexMart is official partner of Las Palmas.&nbsp;<br><br><span class="span-label-blue" style="color: rgb(41, 136, 202); font-weight: bold;">ForexMart</span>
        &nbsp;is a trading name of&nbsp;<img class="tradomart-ltd" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10" style="margin-bottom: 3px;">&nbsp;, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.&nbsp;<br><br><span class="span-label-blue" style="color: rgb(41, 136, 202); font-weight: bold;">ForexMart</span>&nbsp;was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.&nbsp;<br><br>International Finance Magazine (IFM) awarded ForexMart "Best New Broker Europe 2016"&nbsp;<br><br>© 2015 - 2016&nbsp;<img class="tradomart-ltd" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10" style="margin-bottom: 3px;"></p>
            </div>
            <div class="footer-payment-systems col-lg-12 col-md-12 col-sm-12 col-xs-12" style="width: 760px; display: table; margin: 0px auto; float: none !important;">
            <div class="first-liner-footer-payment"><div class="footer-payment-sys-child-new" style="width: 121px; float: left; display: table;">

            <img src="https://www.forexmart.com/assets/images/cysec.png" class="img-responsive" style="display: table; max-width: 80%; margin: 0px auto;">

            </div>
            <div class="footer-payment-sys-child-new" style="width: 121px; float: left; display: table;">

            <img src="https://www.forexmart.com/assets/images/fcab.png" class="img-responsive" style="display: table; max-width: 80%; margin: 0px auto;"></div>
            <div class="footer-payment-sys-child-new" style="width: 121px; float: left; display: table;">

            <img src="https://www.forexmart.com/assets/images/autorite.png" class="img-responsive" style="display: table; max-width: 80%; margin: 0px auto;">

            </div>
            </div>
            <div class="first-liner-footer-payment"><div class="footer-payment-sys-child-new" style="width: 121px; float: left; display: table;">
            <img src="https://www.forexmart.com/assets/images/mifid.png" class="img-responsive" style="display: table; max-width: 80%; margin: 0px auto;"></div>
            <div class="footer-payment-sys-child-new" style="width: 121px; float: left; display: table;">
            <img src="https://www.forexmart.com/assets/images/bafinb.png" class="img-responsive" style="display: table; max-width: 80%; margin: 0px auto;"></div>
            <div class="footer-payment-sys-child-new" style="width: 121px; float: left; display: table;">
            <img src="https://www.forexmart.com/assets/images/consobb.png" class="img-responsive" style="display: table; max-width: 80%; margin: 0px auto;"></div>
            </div>
            </div>
            </div>
            <div class="wrapper-unsubscribe-link" style="width: 800px; text-align: center; color: rgb(51, 51, 51); background: rgb(0, 26, 45);">
            <a style="text-decoration: underline;font-size: 17px;background-color: transparent; color: #337ab7;">Unsubscribe this email</a>
            </div>';

        return $body;
    }

    public static function european_license_content($to)
    {
        $body = '<!--  -->
                <div class="main-bg-image"><img src="https://www.forexmart.com/assets/images/banner-1.png" class="img-responsive"/></div>
                <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">Dear [client&#146;s first name],</label><p style="color: rgb(29, 29, 29); text-align: justify;"><br>We exert much effort on adhering to regulations to protect clients and their private data, provide better services, and secure trades. Traders love it when a company places great importance on how to serve them better.&nbsp;<br><br>Aside from abiding to the Cyprus Investment Services and Activities Regulated Markets Law of 2007, ForexMart is subject to the supervision of the following.</p>
                <ul class="listing-container-holder-eu" style="margin-right: auto; margin-bottom: 0px; margin-left: auto; padding: 10px 0px; color: rgb(51, 51, 51);">
                <li style="list-style-type: none; display: table; width: 780px; padding: 7px 0px;"><div class="listing-left-content" style="width: 156px; float: left;"><img src="https://www.forexmart.com/assets/images/cysec.png" class="img-responsive" style="margin: 0px auto;"></div>
                <div class="listing-right-content" style="width: 624px; float: right;"><span style="font-weight: 700; color: rgb(0, 112, 190);">Cyprus Securities and Exchange Commission</span><p style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">ForexMart is supervised by the Cyprus Securities and Exchange Commission, with license number 266/15. The Cypriot investment firm conforms to the rules outlined by the Markets in Financial Instruments Directive, a cornerstone of the European Union. Being one of the world’s most regarded regulatory bodies, CySEC manages the investment services offered in the country to ensure efficiency in the securities market and to protect investors.</p>
                </div></li>
                <li style="list-style-type: none; display: table; width: 780px; padding: 7px 0px;"><div class="listing-left-content" style="width: 156px; float: left;"><img src="https://www.forexmart.com/assets/images/mifid.png" class="img-responsive" style="margin: 0px auto;"></div>
                <div class="listing-right-content" style="width: 624px; float: right;"><span style="font-weight: 700; color: rgb(0, 112, 190);">Markets in Financial Instruments Derivative</span><p style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">a directive responsible for regulating the investment services within the region.</p>
                </div></li></ul>
                <span style="color: rgb(51, 51, 51);">The company also ascribes to the rules set forth by different regulatory bodies worldwide.</span><ul class="listing-container-holder-eu" style="margin-right: auto; margin-bottom: 0px; margin-left: auto; padding: 10px 0px; color: rgb(51, 51, 51);">
                <li style="list-style-type: none; display: table; width: 780px; padding: 7px 0px;"><div class="listing-left-content" style="width: 156px; float: left;"><img src="https://www.forexmart.com/assets/images/autorite-logo.png" class="img-responsive" style="margin: 0px auto;"></div>
                <div class="listing-right-content" style="width: 624px; float: right;"><span style="font-weight: 700; color: rgb(0, 112, 190);">Autorité des marchés financiers</span><p style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">ForexMart ascribes to the regulation of the Autorité des marchés financiers. The Paris-based regulatory body overseeing financial products and services, and financial markets as well to protect clients. The Cypriot investment firm is supervised across all EU member countries. Our license is fully acceptable by the AMF and all activities conform to the existing law in France.</p>
                </div></li>
                <li style="list-style-type: none; display: table; width: 780px; padding: 7px 0px;"><div class="listing-left-content" style="width: 156px; float: left;"><img src="https://www.forexmart.com/assets/images/consob-logo.png" class="img-responsive" style="margin: 0px auto;"></div>
                <div class="listing-right-content" style="width: 624px; float: right;"><span style="font-weight: 700; color: rgb(0, 112, 190);">Commissione Nazionale per le Società e la Borsa</span><p style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">ForexMart observes the rules implemented by the Commissione Nazionale per le Società e la Borsa. The regulator’s primary objectives include ensuring credibility, integrity, and transparency in financial markets. The Cypriot investment firm is regulated across all EU member countries. Our license is fully acceptable by the CONSOB and all activities all activities conform to the existing law in Italy.</p>
                </div></li>
                <li style="list-style-type: none; display: table; width: 780px; padding: 7px 0px;"><div class="listing-left-content" style="width: 156px; float: left;"><img src="https://www.forexmart.com/assets/images/bafin-logo.png" class="img-responsive" style="margin: 0px auto;"></div>
                <div class="listing-right-content" style="width: 624px; float: right;"><span style="font-weight: 700; color: rgb(0, 112, 190);">Federal Financial Supervisory Authority</span><p style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">Germany-based Federal Financial Supervisory Authority oversees banks and financial services providers, securities trading, and insurance undertakings. ForexMart complies with the rules indicated by the autonomous institution. The Cypriot investment firm is regulated across all EU member countries. Our license is fully acceptable by the BaFin and all activities conform to the existing law in the nation.</p>
                </div></li>
                <li style="list-style-type: none; display: table; width: 780px; padding: 7px 0px;"><div class="listing-left-content" style="width: 156px; float: left;"><img src="https://www.forexmart.com/assets/images/fca-logo.png" class="img-responsive" style="margin: 0px auto;"></div>
                <div class="listing-right-content" style="width: 624px; float: right;"><span style="font-weight: 700; color: rgb(0, 112, 190);">Financial Conduct Authority</span><p style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;">ForexMart adheres to the regulations outlined by the Financial Conduct Authority, a regulator responsible for promoting market integrity, safeguarding clients, and upholding competition. The Cypriot investment firm is supervised across all EU member countries. Our license is fully acceptable by the FCA and all activities conform to the existing law in London.</p>
                </div></li></ul>
                <span style="color: rgb(51, 51, 51);">As we put clients above our own interests, ForexMart vows to offer the highest quality of services to our most valuable business partner – you. Trust us to work on this commitment incessantly. For concerns or inquiries, please feel free to send us an email at&nbsp;</span><a class="link-color" style="color: rgb(41, 136, 202); text-decoration: underline; background-color: rgb(255, 255, 255);">support@forexmart.com</a><span style="color: rgb(51, 51, 51);">&nbsp;</span><br style="color: rgb(51, 51, 51);"><br style="color: rgb(51, 51, 51);"><span style="color: rgb(51, 51, 51);">Happy trading!</span><p style="color: rgb(29, 29, 29); text-align: justify;"></p>
                <p class="ready-for-trading" style="margin-bottom: 2px; font-size: 15px; text-align: justify; color: rgb(29, 29, 29);"></p>
                <div class="start-real-trading" style="display: table; margin: 0px auto; cursor: pointer; padding: 15px 20px; transition: all 0.2s linear; color: rgb(51, 51, 51); background: rgb(41, 136, 202);"><a style="color: rgb(255, 255, 255); font-size: 16px; text-transform: uppercase; display: block;">START TRADING TODAY!</a></div>
                <p style="color: rgb(29, 29, 29); text-align: justify;"></p>
                <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">All the best,<span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span></label> </div>
                <!--  -->';
        echo $body;
        // self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ForexMart - RPJ Racing Partnership');
    }

    public static function Mailersender_singapore($to, $replyto, $body, $subject)
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

    public static function bulletin_marketing($to, $replyto, $body, $subject)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.bulletin.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = 'marketing@bulletin.forexmart.com';
        $mail->Password = '35p2EtjsL6';
        $mail->DKIM_domain = "bulletin.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom('marketing@bulletin.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }    
    public static function bulletin_noreply($to, $replyto, $body, $subject)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "bulletin.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = 'noreply@bulletin.forexmart.com';
        $mail->Password = '64QtNhd7nv';
        $mail->DKIM_domain  = "bulletin.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->DKIM_private = 'http://www.forexmart.com/privaate.key';
        $mail->DKIM_passphrase = '';
        $mail->DKIM_identity = $mail->From;
        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom('noreply@bulletin.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }   

    public static function bulletin_admin($to, $replyto, $body, $subject)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.bulletin.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = 'admin@bulletin.forexmart.com';
        $mail->Password = '7VqAF396rb';
        $mail->DKIM_domain  = "bulletin.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom('admin@bulletin.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }   


    public static function MailerSchedulerFooter2()
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:100%; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">';
        $body .= '<div>';
        $body .= '<div><p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                    <span style="font-weight: 600; color: #FF0000;"> Risk Warning: </span>Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss.</p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is official partner of UD Las Palmas.</p></div>';
        $body .= '<div><p><span style="font-weight: 600;color:#2988ca;">ForexMart</span> is a trading name of <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p></div>';
        $body .= "<div><p><span style='font-weight: 600;color:#2988ca;'>ForexMart</span> was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.</p></div>";
        $body .= '<div><p>International Finance Magazine (IFM) awarded <span style="font-weight: 600;color:#2988ca;">ForexMart</span> " Best New Broker Europe 2016 "</p></div>';
        $body .= '<a href="#" style="display: inline-block;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/fxlogonew.png"></a>';
        $body .= '<p>&copy; 2015 - 2016 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>';
        $body .= '</div>';
        $body .= '<div  style="margin: 0;text-align: center;">';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/cysec.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/mifid.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/bafin.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/amf.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/fca.png"></a>';
        $body .= '<a href="#" style="display: inline-block;padding: 10px 8px;vertical-align: text-bottom;"><img height="56" src="https://www.forexmart.com/assets/images/consob.png"></a>';
        $body .= '</div>';
        $body .= '</div></div>';
        // echo $body;
        return $body;
    }

    //Mailer Scheduler Cron

    public static function ThirtyPercentBonus($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();

        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_thirtypercentbonus_img.png" alt="thirtypercentbonus_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>Welcome to ForexMart, your new reliable trading partner!<br><br>';
        $body .= "We all know trading is complicated by nature. Nevertheless, let's make trading a bit mind-blowing. Our company is delighted to present the 30% welcome bonus, which can be claimed by all our clients.<br><br>
                            When you open a trading account and make a deposit, you have the opportunity to receive up to 30% of the total amount of money deposited. The bonus is applicable for each deposit. For example, if you deposit $100 into your account, we will put up to $30 on your account. Hence, the total balance will be up to $130.</p>";
        $body .= '<table width="100%">
                    <tr>
                        <td style="width: 33.3333333%;">
                            <img src="https://www.forexmart.com/assets/images/step-1.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="step-1">
                            <a style="text-decoration: none;width: 100%;color: #fff;border: none;background: #239423;margin: 10px auto;text-align: center; display: block; padding: 10px 0;"><span style="margin: 0 5px;">Open a Live Trading Account</span></a>
                        </td>
                        <td style="width: 33.3333333%;">
                            <img src="https://www.forexmart.com/assets/images/step-2.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="step-2">
                            <a  style="text-decoration: none;width: 100%;color: #fff;border: none;background: #239423;margin: 10px auto;text-align: center; display: block; padding: 10px 0;"><span style="margin: 0 5px;">Make Deposit</span></a>
                        </td>
                        <td style="width: 33.3333333%;">
                            <img src="https://www.forexmart.com/assets/images/step-3.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="step-3">
                            <a style="text-decoration: none;width: 100%;color: #fff;border: none;background: #239423;margin: 10px auto;text-align: center; display: block; padding: 10px 0;"><span style="margin: 0 5px;">Apply for bonus</span></a>
                        </td>
                    </tr>
                </table>';


        $body .= '<p style="color: #1d1d1d;">If you have concerns or queries, please get in touch with us. We are more than glad to assist you. May crunching the numbers find your way to success.</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';


        $body .= '</div></center>';


        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Trading bonus 30% to each deposit from ForexMart', $body);
        return $sender;
    }


    public static function ThirtyPercentBonusRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();

        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_thirtypercentbonus_img-russian.png" alt="thirtypercentbonus_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>Мы все знаем, что торговля на Forex имеет сложный характер. Но компания ФорексМарт делает все возможное, чтобы сделать ее более выгодной и безопасной. Мы рады представить вам 30% приветственный бонус, доступный всем клиентам ФорексМарт.<br><br>';
        $body .= "Открывая и пополняя счет на ФорексМарт, у вас есть возможность получить дополнительно 30% к общей сумме внесенных средств. Бонус 30% вы можете получить при каждом пополнении счета. Например, если вы вносите $100, то получите $30 дополнительно к своему депозиту. Таким образом, ваш общий баланс составит $130.</p>";
        $body .= '<table width="100%">
                    <tr>
                        <td style="width: 33.3333333%;">
                            <img src="https://www.forexmart.com/assets/images/step-1.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="step-1">
                            <a style="text-decoration: none;width: 100%;color: #fff;border: none;background: #239423;margin: 10px auto;text-align: center; display: block; padding: 10px 0;"><span style="margin: 0 5px;">Открыть торговый счет</span></a>
                        </td>
                        <td style="width: 33.3333333%;">
                            <img src="https://www.forexmart.com/assets/images/step-2.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="step-2">
                            <a  style="text-decoration: none;width: 100%;color: #fff;border: none;background: #239423;margin: 10px auto;text-align: center; display: block; padding: 10px 0;"><span style="margin: 0 5px;">Сделать пополнение</span></a>
                        </td>
                        <td style="width: 33.3333333%;">
                            <img src="https://www.forexmart.com/assets/images/step-3.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="step-3">
                            <a style="text-decoration: none;width: 100%;color: #fff;border: none;background: #239423;margin: 10px auto;text-align: center; display: block; padding: 10px 0;"><span style="margin: 0 5px;">Подать заявку на получение бонуса</span></a>
                        </td>
                    </tr>
                </table>';


        $body .= '<p style="color: #1d1d1d;">Если у вас есть вопросы, пожалуйста, свяжитесь с нами. Наши специалисты готовы помочь вам в любое время!</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';


        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего самого наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Приветственный 30%  бонус на каждое пополнение от ФорексМарт', $body);
        return $sender;
    }

    public static function MailerSchedulerSenderPeriodic($to, $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $replyto = 'noreply@bulletin.forexmart.com';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "bulletin.forexmart.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPDebug = 1;
        $mail->Username = 'noreply@bulletin.forexmart.com';
        $mail->Password = '64QtNhd7nv';

        $mail->AddReplyTo($replyto, $name);
        $mail->SetFrom('noreply@bulletin.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);
        $mail->DKIM_domain  = "bulletin.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->DKIM_private = 'https://www.forexmart.com/privaate.key';
        $mail->DKIM_passphrase = '';
        $mail->DKIM_identity = $mail->From;

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function ndbMailer($to, $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/class.phpmailer.php';
        $name = "ForexMart";
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = "base64";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.notices.forexmart.com";
        $mail->Port = 25;
        $mail->SMTPSecure = 'smtp';
        $mail->SMTPDebug = 1;
        $mail->Username = 'noreply@notices.forexmart.com';
        $mail->Password = '5yqa6RXe5Q';
        $mail->DKIM_domain = "notices.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        //            $mail->AddReplyTo('noreply@notices.forexmart.com', $name);
        $mail->AddReplyTo('support@forexmart.com', $name);
        $mail->SetFrom('noreply@notices.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function MailerSchedulerSenderTest($to, $subject, $body)
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
        $mail->Username = 'user100@notify.forexmart.com';
        $mail->Password = 'pK4VphQ43N';
        $mail->DKIM_domain = "notify.forexmart.com";
        $mail->DKIM_selector = 'dkim';
        $mail->SetFrom('user100@notify.forexmart.com', $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function NewestHeader()
    {
        $body = '<html>
                <head>

                </head>
                <body style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px;line-height: 1.42857143; color: #333;background-color: #fff;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;height: auto;">';
        $body .= '<div style="margin: 0 auto; width:100%;padding: 0!important">';
        $body .= '<div style="background:url(https://www.forexmart.com/assets/images/header-bg.png); width:100%!important; margin-top:2px; ;border-top: 3px solid #EAEAEA;">';
        $body .= '<img style="width:100%!important;" alt="mailing_v2-header" src="https://www.forexmart.com/assets/images/logo-mailing_v2.png">';
        $body .= '</div>';
        return $body;
    }

    //Mailer Scheduler Cron
    public static function HowToGetStarted($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_howtogetstarted_img.png" alt="howtogetstarted_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>Welcome to ForexMart, your new reliable trading partner!<br><br>';
        $body .= "As you begin your trading journey with us, let ForexMart guide you in every step of the way. Here's what you need to know to get started.</p>";
        $body .= '<ul style="padding: 10px 5px;margin: 0 auto;">';
        $body .= '<li style="list-style-type: square;color: #2ec6ff;"><strong style="color: #0070be;">Know the Nuts and Bolts of the Market</strong>';
        $body .= '<p style="color: #1d1d1d;margin-top:0px;">Trading starts with gaining an essential knowledge about the market and what makes it tick. To know more about the industry, visit <a href="https://www.forexmart.com/faq" style="text-decoration: underline;">FAQ</a> or <a href="https://www.forexmart.com/forex-glossary" style="text-decoration: underline;">Glossary</a></p></li>';

        $body .= '<li style="list-style-type: square;color: #2ec6ff;"><strong style="color: #0070be;">Open a Demo Account</strong>';
        $body .= '<p style="color: #1d1d1d;margin-top:0px;">Apply what you have learned. Create a <a href="https://www.forexmart.com/demo-account" style="text-decoration: underline;">ForexMart demo account</a>  to practice trading without experiencing any investment risk. You still gain full access to our trading platform and latest market quotes. But the funds used for trading are virtual.</p></li>';

        $body .= '<li style="list-style-type: square;color: #2ec6ff;"><strong style="color: #0070be;">Go Live</strong>';
        $body .= '<p style="color: #1d1d1d;margin-top:0px;">Open a <a href="https://www.forexmart.com/register" style="text-decoration: underline;">live account</a>, trail the market, and generate profit. You can claim for one of our bonus offers upon creating a trading account with us.</p></li>';
        $body .= '</ul>';

        $body .= '<center><p style="color: #1d1d1d;">If you are ready</p>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div  style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #2988ca;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://my.forexmart.com/client/signin" style="color:white;text-decoration:none">Start Real Trading</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">Fund My Account</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';


        $body .= '</div></center>';
        // $body .= '<div style="width: 100%;display: table;margin: 20px auto;">';
        //     $body .= '<h1 style="font-size: 20px; font-family: Georgia,Times New Roman,serif; margin: 0 auto;margin-bottom: 20px;text-align: center;color: #0070be;font-weight:500">All new ForexMart clients can claim this bonus in three easy steps</h1>';
        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/step-1.png" width="75" height="75">';
        //     $body .= '<a href="https://www.forexmart.com/register" style="text-decoration: none;width:100%;padding:10px 0px!important;color:#fff;border:none;background:#239423;margin:10px auto;display:block; box-sizing: border-box; text-align: center;">Open a Live Trading Account</a>';
        // $body .= '</div>';
        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/step-2.png" width="75" height="75">';
        //     $body .= '<a href="https://my.forexmart.com/deposit" style="text-decoration: none;width:100%;padding:10px 0px!important;color:#fff;border:none;background:#239423;margin:10px auto;display:block; box-sizing: border-box; text-align: center;">Make a Deposit</a>';
        // $body .= '</div>';
        //     $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //         $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/step-3.png" width="75" height="75">';
        //         $body .= '<a href="https://my.forexmart.com/bonus/bonuses" style="text-decoration: none;width:100%;padding:10px 0px!important;color:#fff;border:none;background:#239423;margin:10px auto;display:block; box-sizing: border-box; text-align: center;">Apply for bonus</a>';
        //     $body .= '</div>';
        // $body .= '</div>';

        $body .= '<p style="color: #1d1d1d;">Please do not hesitate to <a href="https://www.forexmart.com/contact-us" style="text-decoration: underline;">contact us</a> should you have any concern or inquiry. Wishing you a successful trading!</p>';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'How to Get Started', $body);
        return $body;
    }

    public static function HowToGetStartedRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_howtogetstarted_img-russian.png" alt="howtogetstarted_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемые ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>Добро пожаловать! ФорексМарт - ваш новый надежный торговый партнер!<br><br>';
        $body .= "Поскольку вы только начинаете свой путь с ФорексМарт, позвольте показать вам надежную тропу. Чтобы успешно начать работу на рынке Форекс, нужно пройти три последовательных этапа.</p>";
        $body .= '<ul style="padding: 10px 5px;margin: 0 auto;">';
        $body .= '<li style="list-style-type: square;color: #2ec6ff;"><strong style="color: #0070be;">Изучите рынок.</strong>';
        $body .= '<p style="color: #1d1d1d;margin-top:0px;">Торговля начинается с получения базовых знаний о рынке, о его основных принципах работы и структуре. Чтобы получить основные сведения, зайдите на "Часто задаваемые вопросы" или просмотрите  глоссарий.</p></li>';

        $body .= '<li style="list-style-type: square;color: #2ec6ff;"><strong style="color: #0070be;">Откройте демо-счет.</strong>';
        $body .= '<p style="color: #1d1d1d;margin-top:0px;">Примените то, что вы узнали на практике. Создайте демо-счет ФорексМарт для торговли без инвестиционных рисков. На демо-аккаунте вы получите полный доступ к нашей торговой платформе и последним рыночным котировкам, но будете торговать на виртуальном счете.</p></li>';

        $body .= '<li style="list-style-type: square;color: #2ec6ff;"><strong style="color: #0070be;">Торгуйте реально.</strong>';
        $body .= '<p style="color: #1d1d1d;margin-top:0px;">Откройте реальный счет, следите за рынком и получайте прибыль. Получите один из наших бонусов при создании реального торгового счета.</p></li>';
        $body .= '</ul>';

        $body .= '<center><p style="color: #1d1d1d;">Если вы готовы,</p>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div  style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #2988ca;padding:15px;min-width: calc(75% / 3);width: 233px;display: inline-block;">';
        $body .= '<a href="https://my.forexmart.com/client/signin" style="color:white;text-decoration:none;font-size: 13px;">НАЧИНАЙТЕ ТОРГОВАТЬ РЕАЛЬНО</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(75% / 3);width: 195px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(75% / 3);width: 195px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';


        $body .= '</div></center>';
        // $body .= '<div style="width: 100%;display: table;margin: 20px auto;">';
        //     $body .= '<h1 style="font-size: 20px; font-family: Georgia,Times New Roman,serif; margin: 0 auto;margin-bottom: 20px;text-align: center;color: #0070be;font-weight:500">All new ForexMart clients can claim this bonus in three easy steps</h1>';
        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/step-1.png" width="75" height="75">';
        //     $body .= '<a href="https://www.forexmart.com/register" style="text-decoration: none;width:100%;padding:10px 0px!important;color:#fff;border:none;background:#239423;margin:10px auto;display:block; box-sizing: border-box; text-align: center;">Open a Live Trading Account</a>';
        // $body .= '</div>';
        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/step-2.png" width="75" height="75">';
        //     $body .= '<a href="https://my.forexmart.com/deposit" style="text-decoration: none;width:100%;padding:10px 0px!important;color:#fff;border:none;background:#239423;margin:10px auto;display:block; box-sizing: border-box; text-align: center;">Make a Deposit</a>';
        // $body .= '</div>';
        //     $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //         $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/step-3.png" width="75" height="75">';
        //         $body .= '<a href="https://my.forexmart.com/bonus/bonuses" style="text-decoration: none;width:100%;padding:10px 0px!important;color:#fff;border:none;background:#239423;margin:10px auto;display:block; box-sizing: border-box; text-align: center;">Apply for bonus</a>';
        //     $body .= '</div>';
        // $body .= '</div>';
        $body .= '<p style="color: #1d1d1d;">Пожалуйста, обращайтесь к нам по любым вопросам и предложениям. Удачной торговли!</p>';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'С чего начать', $body);
        return $body;
    }

    public static function NewestFoooter($unsubscribe_key)
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;text-align:justify;"><span style="font-weight: bold;color: #ff0000;">Risk Warning:</span> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.';
        $body .= '<br><br>ForexMart is official partner of Las Palmas.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> is the trading name of <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10" alt="tradomart-ltd-small-black"> , a Cyprus based Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> was awarded by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.';
        $body .= '<br><br>International Finance Magazine (IFM) awarded ForexMart as "Best New Broker Europe 2016"';
        $body .= '<br><br>© 2015 - 2016 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10" alt="tradomart-ltd-small-black">';
        $body .= '</p>';
        $body .= '</div>';
        $body .= '<div style="width: 100%;float: none!important;display: table;margin: 0 auto;">
            <div style="margin: 0 auto;">
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/cysec"><img src="https://www.forexmart.com/assets/images/mailer/cysec.png" alt="cysec" style="max-width: 80%;display: table;margin: 0 auto;"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/fca"><img src="https://www.forexmart.com/assets/images/mailer/fca.png" alt="fca" style="max-width: 80%;display: table;margin: 0 auto;"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/amf"><img src="https://www.forexmart.com/assets/images/mailer/autorite.png" alt="autorite" style="max-width: 80%;display: table;margin: 0 auto;"><a/>
              </div>
            </div>
              <div style="margin: 0 auto;">
              <div style="width: 16.66%;float: left;display: table;">
                <a href="http://ec.europa.eu/finance/securities/isd/mifid/index_en.htm"><img src="https://www.forexmart.com/assets/images/mailer/mifid.png" style="max-width: 80%;display: table;margin: 0 auto;" alt="mifid"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/bafin"><img src="https://www.forexmart.com/assets/images/mailer/bafin.png" style="max-width: 80%;display: table;margin: 0 auto;" alt="bafin"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/consob"><img src="https://www.forexmart.com/assets/images/mailer/consob.png" style="max-width: 80%;display: table;margin: 0 auto;" alt="consob"></a>
              </div>
            </div>
            </div>
          </div>';
        $body .= '<div style="width: 100%;padding: 7px 0px;background: #e7e7e7;;text-align: center;">';
        $body .= '<a href="https://www.forexmart.com/unsubscribe/ref/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px;color: #565656;">Unsubscribe this email</a>';
        $body .= "</div></body></html>";
        return $body;
    }

    public static function NewestFoooterHundredPercent($unsubscribe_key)
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;"><span style="font-weight: bold;color: #ff0000;">Risk Warning:</span> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.';
        $body .= '<br><br>ForexMart is official partner of Las Palmas.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> is the trading name of <img  alt="logo2" style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, a Cyprus based Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ForexMart</span> was awarded by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.';
        $body .= '<br><br>International Finance Magazine (IFM) awarded ForexMart as "Best New Broker Europe 2016"';
        $body .= '<br><br>© 2015 - 2016 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" alt="logo1" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">';
        $body .= '</p>';
        $body .= '</div>';
        $body .= '<div style="width: 100%;float: none!important;display: table;margin: 0 auto;">
            <div style="margin: 0 auto;">
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/cysec"><img alt="cysec"   src="https://www.forexmart.com/assets/images/mailer/cysec.png" style="max-width: 80%;display: table;margin: 0 auto;"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/fca"><img alt="fca"   src="https://www.forexmart.com/assets/images/mailer/fca.png" style="max-width: 80%;display: table;margin: 0 auto;"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/amf"><img alt="autorite"   src="https://www.forexmart.com/assets/images/mailer/autorite.png" style="max-width: 80%;display: table;margin: 0 auto;"><a/>
              </div>
            </div>
              <div style="margin: 0 auto;">
              <div style="width: 16.66%;float: left;display: table;">
                <a href="http://ec.europa.eu/finance/securities/isd/mifid/index_en.htm"><img alt="mifid"src="https://www.forexmart.com/assets/images/mailer/mifid.png" style="max-width: 80%;display: table;margin: 0 auto;"></a?>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/bafin"><img alt="bafin"     src="https://www.forexmart.com/assets/images/mailer/bafin.png" style="max-width: 80%;display: table;margin: 0 auto;"></a>
              </div>
              <div style="width: 16.66%;float: left;display: table;">
                <a href="https://www.forexmart.com/consob"><img alt="consob"  src="https://www.forexmart.com/assets/images/mailer/consob.png" style="max-width: 80%;display: table;margin: 0 auto;"></a>
              </div>
            </div>
            </div>
          </div>';
        $body .= '<div style="width: 100%;padding: 7px 0px;background: #e7e7e7;;text-align: center;">';
        // $body .= '<a href="https://www.forexmart.com/unsubscribe/ref/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px;color: #565656;">Unsubscribe this email</a>';
        $body .= "</div>";
        return $body;
    }

    public static function NewestFoooterHundredPercentRussian()
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
        // $body .= '<a href="https://www.forexmart.com/ru/unsubscribe/ref2/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Отписаться от рассылки</a>';
        $body .= "</div>";
        return $body;
    }   

    public static function NewestFoooterRussian($unsubscribe_key)
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;text-align:justify"><span style="font-weight: bold;color: #ff0000;">Предупреждение о рисках:</span> Торговля на Форекс имеет спекулятивный и сложный характер, и может подойти не всем инвесторам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорекМарт, пожалуйста, оцените и примите <a href="https://www.forexmart.com/risk-disclosure">риски</a> связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> официальный Форекс Трейдинг партнер ФК Лас Пальмас.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> является торговой маркой компании <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" alt="tradomart-ltd-small-black" width="101" height="10">, Кипрской Инвестиционной Компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">266/15</a>.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> признан лучшим брокером Европы по итогам 2015 года и самым перспективным брокером Азии по итогам 2015 года по версии ShowFx World.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> признан Лучшим Новым Брокером Европы в 2016 году по версии Международного Финансового Журнала (International Finance Magazine).';
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
        $body .= '<a href="https://www.forexmart.com/unsubscribe/ref/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Отписаться от рассылки</a>';
        $body .= "</div></body></html>";
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

    public static function NewestFoooterForTradeOffer($unsubscribe_key)
    {
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
        $body .= '<a href="https://www.forexmart.com/unsubscribe/ref4/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Unsubscribe this email</a>';
        $body .= "</div>";
        return $body;
    }

    public static function NewestFoooterForTradeOfferEnglish($unsubscribe_key)
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
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://www.facebook.com/ForexMart"><img src="https://www.forexmart.com/assets/images/massmail/icon-facebook.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://twitter.com/ForexMartPage"><img src="https://www.forexmart.com/assets/images/massmail/icon-twitter.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                     <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;margin:0;"><a href="https://plus.google.com/+Forexmartpage"><img src="https://www.forexmart.com/assets/images/massmail/icon-googleplus.png" style="height:36px; width:36px;"></a></li>';
        $body .= '                                </ul class="sub-list"></div>';
        $body .= '                            </li>';
        $body .= '                            <li style="margin:0; width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;" >';
        $body .= '                                <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;" >TRADE ANYWHERE</p>';
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
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b>ForexMart</b> was named by ShowFx World as the <b>"Best Broker in Europe 2015"</b> and <b>"Most Perspective Broker in Asia 2015"</b>.International Finance Magazine (IFM) awarded ForexMart <b>"Best New Broker Europe 2016"</b>.Global Business Outlook recognized ForexMart as the <b>"Best Forex Newcomer in 2016"</b></p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b>ForexMart</b> a trading name of <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p>';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b>Risk Warning:</b> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.</p>';
        $body .= '                                <ul class="border-top" style="border-top-width:1px;border-top-style:solid;border-top-color:#bbb;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" >© 2015 - 2017 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10"></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" ><a href="https://www.forexmart.com/unsubscribe/ref4/' . $unsubscribe_key . '" style="color:#ee6a56;text-decoration:underline;" >Unsubscribe this email</a></li>';
        $body .= '                                </ul>';
        $body .= '                            </td>';
        $body .= '                        </tr>';
        $body .= '                        </table>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '            </table>';
        return $body;
    }

    public static function NewestFoooterForTradeOfferRussian($unsubscribe_key)
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
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" ><a href="https://www.forexmart.com/unsubscribe/ref4/' . $unsubscribe_key . '" style="color:#ee6a56;text-decoration:underline;" >Отписаться от рассылки</a></li>';
        $body .= '                                </ul>';
        $body .= '                            </td>';
        $body .= '                        </tr>';
        $body .= '                        </table>';
        $body .= '                    </td>';
        $body .= '                </tr>';
        $body .= '            </table>';
        return $body;
    }
    
    public static function NewestFoooterForMassMailerRussian($unsubscribe_key)
    {
        $body = '<div style="background:url(https://www.forexmart.com/assets/images/univ-bg-footer2.png);padding: 20px; padding-top: 5px;position: relative;border-top: 1px solid #002036;">';
        $body .= "<div style='padding: 0;width: 100%;float: none;display: block;'>";
        $body .= '<p style="line-height: 15px;color: #656565;font-size: 13px;"><span style="font-weight: bold;color: #ff0000;">Предупреждение о рисках:</span> Торговля на Форекс имеет спекулятивный и сложный характер, и может подойти не всем инвесторам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорекМарт, пожалуйста, оцените и примите <a href="www.forexmart.com/ru/risk-disclosure">риски</a> связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> официальный Форекс Трейдинг партнер ФК Лас Пальмас.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> является торговой маркой компании <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, Кипрской Инвестиционной Компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">266/15</a>.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> признан лучшим брокером Европы по итогам 2015 года и самым перспективным брокером Азии по итогам 2015 года по версии ShowFx World.';
        $body .= '<br><br><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart) </span> признан Лучшим Новым Брокером Европы в 2016 году по версии Международного Финансового Журнала (International Finance Magazine).';
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
        $body .= '<a href="https://www.forexmart.com/ru/unsubscribe/ref2/' . $unsubscribe_key . '" style="text-decoration: underline;font-size: 12px; color: #565656;">Отписаться от рассылки</a>';
        $body .= "</div>";
        return $body;
    }


    //for ndb 
    public function HundredPercentBonus($to)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" alt= "image-header" src="https://www.forexmart.com/assets/images/mailing_hundredpercentbonus_img.png">';
        $body .= '</div><br>';
        $body .= '<div style="padding: 0 10px 10px 10px;">';
        $body .= 'Dear Client,';
        $body .= '<br><br>We have a Special Offer for you! <br><br>';
        $body .= "Maximize your capital with this personal offer. Grab the chance to DOUBLE your deposit with 100% bonus. This offer is only available for 48 hours starting today. Deposit any sum up to $2000 and get it twice with this limited time offer! <br><br>";
        $body .= 'Click <a href="https://www.forexmart.com/limited-bonus" style="text-decoration: underline;">here</a> to visit the official page and learn more about the Terms & Conditions. <br><br>';
        $body .= 'Hurry and don’t miss this opportunity to get better deals! Happy Trading!';
        $body .= '';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Truly yours,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $footer = self::NewestFoooterHundredPercent();
        $body .= $footer;
        $body .= '</body>';
        // $to, $replyto, $from, $pass, $body, $subject
        echo $body;
        //  $sender = self::ndbMailer($to, 'Countdown to Limited Bonus! Get it now!', $body); bulletin_noreply
        return self::bulletin_noreply($to, 'noreply@bulletin.forexmart.com', $body,'Countdown to Limited Bonus! Get it now!');
        // return self::sender($to, 'Countdown to Limited Bonus! Get it now!', $body, "noreply@mail.forexmart.com","noreply@mail.forexmart.com");
    }

    public function HundredPercentBonus_russian($to)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" alt= "image-header" src="https://www.forexmart.com/assets/images/100percentbonus4-russian.png">';
        $body .= '</div><br>';
        $body .= '<div style="padding: 0 10px 10px 10px;">';
        $body .= 'Уважаемый клиент,';
        $body .= '<br><br>Спешим предложить вам уникальное ограниченное предложение!  <br><br>';
        $body .= "Приумножайте свой капитал с помощью персонального 100% Бонуса! Не упустите шанс УДВОИТЬ свой депозит с этим лимитированным предложением. Оно доступно для Вас в течении 48 часов, начиная с сегодняшнего дня. <br><br>";
        $body .= "Чтобы воспользоваться нашим специальным предложением и увеличить свой депозит вдвое, необходимо пополнить счет любой суммой до $2000. <br><br>";
        $body .= "Торопитесь и не упустите возможность получить сверх-выгодные условия торговли! <br><br>";       
        $body .= 'Чтобы узнать больше об условиях предоставления услуги, посетите официальный сайт нашей компании по <a href="https://www.forexmart.com/ru/limited-bonus" style="text-decoration: underline;">ссылке</a>. <br><br>';     

        // $body .= 'Click <a href="https://www.forexmart.com/limited-bonus" style="text-decoration: underline;">here</a> to visit the official page and learn more about the Terms & Conditions. <br><br>';
        // $body .= 'Hurry and don’t miss this opportunity to get better deals! Happy Trading!';
        // $body .= '';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Успешной торговли,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт.</span></label>';
        $body .= '</div>';
        $footer = self::NewestFoooterHundredPercentRussian();
        $body .= $footer;
        $body .= '</body>';
        echo $body;
        return self::bulletin_noreply($to, 'noreply@bulletin.forexmart.com', $body,'Успейте получить бонус 100%! Предложение действует только 48 часов!');
    }

    //Mailer Scheduler Cron
    public static function importantInstruments($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_threemostimportantinstruments_img.png" alt="threemostimportantinstruments">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';
        $body .= "Greetings! <br><br>";

        $body .= 'Foreign exchange trading can be perplexing at first. We are here to help you on every step of the way. <br><br>';
        $body .= 'To be profitable in trading you have to consider:';
        $body .= '</p>';
        $body .= '<div style="width: 100%;display: table;margin: 20px auto;">';
        $body .= "<h1 style='font-size: 20px;margin: 0 auto;margin-bottom: 20px;text-align: center;color: #0070be;font-weight:200;font-family: Georgia,Times New Roman,serif;'>Three Essential Instruments</h1>";

        $body .= '<table width="100%">
    <tr>
        <td style="width: 33.3333333%;">
            <img src="https://www.forexmart.com/assets/images/instrument-1.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="instrument-1.">
            <p style="text-decoration: none;width: 100%;color: #fff;border: none;height:60px;margin: 10px auto;text-align: center; display: inline-table; padding: 10px 0;"><span style="margin: 0 5px;color: #1d1d1d;">Latest Glitch-free Trading platform, competitive rates and instant execution.</span></p>
        </td>
        <td style="width: 33.3333333%;">
            <img src="https://www.forexmart.com/assets/images/instrument-2.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="instrument-2">
            <p style="text-decoration: none;width: 100%;color: #fff;border: none;height:60px;margin: 10px auto;text-align: center; display: inline-table; padding: 10px 0;"><span style="margin: 0 5px;color: #1d1d1d;">Pattern Graphix to help you identify chart patterns and customize as you want it.</span></p>
        </td>
        <td style="width: 33.3333333%;">
            <img src="https://www.forexmart.com/assets/images/instrument-3.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="instrument-3">
            <p style="text-decoration: none;width: 100%;color: #fff;border: none;height:60px;margin: 10px auto;text-align: center; display: inline-table; padding: 10px 0;"><span style="margin: 0 5px;color: #1d1d1d;">A reliable trading partner. Award winning EU regulated broker.</span></p>
        </td>
    </tr>
</table>';

        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/instrument-1.png" width="75" height="75">';
        //     $body .= '<p style="color: #1d1d1d;">Latest Glitch-free Trading platform, competitive rates and instant execution.</p>';
        // $body .= '</div>';

        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/instrument-2.png" width="75" height="75">';
        //     $body .= '<p style="color: #1d1d1d;">Pattern Graphix to help you identify chart patterns and customize as you want it.</p>';
        // $body .= '</div>';

        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/instrument-3.png" width="75" height="75">';
        //     $body .= '<p style="color: #1d1d1d;">A reliable trading partner. Award winning EU regulated broker.</p>';
        // $body .= '</div>';

        $body .= '</div>';

        $body .= '<p style="#1d1d1d">ForexMart provides widest choice of trading instruments with comfortable conditions.  <br><br>';

        $body .= 'To learn more visit <a href="https://www.forexmart.com/three-most-important-instruments" style="text-decoration: underline;">https://www.forexmart.com/three-most-important-instruments</a> <br><br>';
        $body .= 'We wish you success in trading!</p>';
        $body .= '</div>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">FUND MY ACCOUNT</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-bottom: 20px;font-weight: normal;display: block;">Truly yours,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, '3 Most Important Instrument for Getting the Profit', $body);
        return $sender;
    }

    public static function importantInstrumentsRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_threemostimportantinstruments_img-russian.png" alt="threemostimportantinstruments">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';
        $body .= "Приветствуем вас!<br><br>";

        $body .= 'Ни для кого не секрет, что торговля на Forex сперва может сильно озадачить и вызвать массу вопросов. Но мы здесь, чтобы помочь Вам на каждом этапе вашего становления как успешного трейдера. <br><br>';
        $body .= 'Для того, чтобы ваша торговля приносила  прибыль, необходимо учитывать три основных инструмента:';
        $body .= '</p>';
        $body .= '<div style="width: 100%;display: table;margin: 20px auto;">';

        $body .= '<table width="100%" style="margin-top:-120px;">
    <tr>
        <td style="width: 33.3333333%;">
            <img src="https://www.forexmart.com/assets/images/instrument-1.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="instrument-1.">
            <p style="text-decoration: none;width: 100%;color: #fff;border: none;height:60px;margin: 10px auto;text-align: center; display: inline-table; padding: 10px 0;"><span style="margin: 0 5px;color: #1d1d1d;">Эффективную торговую платформу, конкурентноспособные цены и моментальное исполнение.</span></p>
        </td>
        <td style="width: 33.3333333%;padding-top:60px;">
            <img src="https://www.forexmart.com/assets/images/instrument-2.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="instrument-2">
            <p style="text-decoration: none;width: 100%;color: #fff;border: none;height:60px;margin: 10px auto;text-align: center; display: inline-table; padding: 10px 0;"><span style="margin: 0 5px;color: #1d1d1d;">Индикатор графических фигур Pattern Graphix, который поможет вам получать информацию о возникновении тех или иных фигур на графике и менять настройки в соответствии с вашими пожеланиями. </span></p>
        </td>
        <td style="width: 33.3333333%;padding-top:26px;">
            <img src="https://www.forexmart.com/assets/images/instrument-3.png" style="margin: 10px auto;display: table; float:none;" width="75" height="75" alt="instrument-3">
            <p style="text-decoration: none;width: 100%;color: #fff;border: none;height:60px;margin: 10px auto;text-align: center; display: inline-table; padding: 10px 0;"><span style="margin: 0 5px;color: #1d1d1d;">Надежного торгового партнера и обладателя международных премий и наград. Брокера с европейской регуляцией.</span></p>
        </td>
    </tr>
</table>';

        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/instrument-1.png" width="75" height="75">';
        //     $body .= '<p style="color: #1d1d1d;">Latest Glitch-free Trading platform, competitive rates and instant execution.</p>';
        // $body .= '</div>';

        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/instrument-2.png" width="75" height="75">';
        //     $body .= '<p style="color: #1d1d1d;">Pattern Graphix to help you identify chart patterns and customize as you want it.</p>';
        // $body .= '</div>';

        // $body .= '<div style="width: calc(92% / 3);float:left; padding: 10px; box-sizing: border-box;">';
        //     $body .= '<img style="margin: 10px auto;display: table;" src="https://www.forexmart.com/assets/images/instrument-3.png" width="75" height="75">';
        //     $body .= '<p style="color: #1d1d1d;">A reliable trading partner. Award winning EU regulated broker.</p>';
        // $body .= '</div>';

        $body .= '</div>';

        $body .= '<p style="#1d1d1d">ФорексМарт предоставляет широкий выбор торговых инструментов с комфортными торговыми условиями.<br><br>';

        $body .= 'Для получения более подробной информации посетите эту страницу:  <a href="https://www.forexmart.com/three-most-important-instruments" style="text-decoration: underline;">https://www.forexmart.com/three-most-important-instruments</a> <br><br>';
        $body .= 'Желаем вам удачной торговли!</p>';
        $body .= '</div>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОПОЛНИТЬ СЧЕТ</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Веб-терминал</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-bottom: 20px;font-weight: normal;display: block;">С уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт.</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, '3 самых важных инструмента для получения прибыли', $body);
        return $sender;
    }

    //Mailer Scheduler Cron
    public static function LasPalmas($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_laspalmas.png" alt="laspalma">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>ForexMart is the official partner of Union Deportiva Las Palmas, a Spanish football team located in Las Palmas de Gran Canaria on the Canary Islands. <br><br>';

        $body .= "UD Las Palmas traces back its roots in the Spanish autonomous community when five powerful teams in the island recognized the need for uniting. Hence, the inception of the football club in 1949, which aims to retain good players for them not to seek better career opportunities somewhere else. It has played 31 seasons in La Liga, the most popular and strongest league in Europe. <br><br>";

        $body .= 'ForexMart Chief Executive Savvas Patsalides considers the collaboration as a significant milestone for the Cyprus-based company and another remarkable chapter in the football club\'s history. For ForexMart President Ildar Sharipov, the football club will become a solid player in La Liga, saying this is something the company was searching for a long time: the best is meeting the best <br><br>';

        $body .= 'We will give away VIP passes to see UD Las Palmas compete with the best European football teams at Gran Canaria Stadium. The raffle promo is open to all active ForexMart clients. <br><br>';

        $body .= 'For more information, visit VIP Raffle Ticket for full mechanisms or UD Las Palmas to know more about the football club.';

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">Get Bonus</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';


        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'The Best Meets the Best - ForexMart is official partner of UD Las Palmas
', $body);
        return $sender;
    }

    public static function LasPalmasRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_laspalmas_img_index-russian.png" alt="mailing_laspalmas_img_index-russian">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый(ая) ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "ФорексМарт - официальный партнер ФК Лас-Пальмас, испанской футбольной команды города Лас-Пальмас-де-Гран-Канария, гордости Канарских островов. <br><br>";

        $body .= "ФК Лас-Пальмас был основан в 1949 году путём объединения пяти местных команд, чтобы удержать лучших игроков острова от перехода в другие клубы. Команда провела 31 сезон в Ла Лиге - одном из самых популярных и сильных чемпионатов Европы. <br><br>";

        $body .= "Исполнительный Директор ФорексМарт Саввас Патсалидис видит в этом сотрудничестве важную веху для кипрской финансовой компании и замечательную главу в истории футбольного клуба. Для Ильдара Шарипова, президента ФорексМарт, Лас Пальмас станет надежным игроком в высшем дивизионе испанского футбола. Это то, что компания искала долгое время: лучший находит лучшего. <br><br>";

        $body .= "В рамках сотрудничества мы разыгрываем VIP билеты на игры ФК Лас-Пальмас с лучшими европейскими командами на стадионе Гран-Канария. Розыгрыш проводится для всех активных клиентов ФорексМарт. <br><br>";

        $body .= "Получите дополнительную информацию на странице розыгрыша или зайдите на официальную страницу ФК Лас-Пальмас, чтобы поближе познакомится с нашим партнёром.<br><br>";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Лучшие встречают лучших - ФорексМарт официальный партнер ФК Лас-Пальмас', $body);
        return $sender;
    }




    //Mailer Scheduler Cron
    public static function EuroLicense($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_europeanlicense_img.png" alt="europeanlicense_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>We exert much effort on adhering to regulations to protect clients and their private data, provide better services, and secure trades. Traders appreciate when a company places great importance on how to serve them better. <br><br>';

        $body .= "Aside from abiding to the Cyprus Investment Services and Activities Regulated Markets Law of 2007, ForexMart is subject to the supervision of the following.";
        $body .= '</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/cysec.png" alt="cysec" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Cyprus Securities and Exchange Commission</strong>
            <p style="margin-top:0px">a Cypriot financial regulatory agency securing the safety of investors and innovation in the security markets.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/mifid.png" alt="mifid" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Markets in Financial Instruments Derivative</strong>
            <p style="margin-top:0px">a directive responsible for regulating the investment services within the region.</p>
        </td>
    </tr>
</table>';
        $body .= '<p>The company also ascribes to the rules set forth by different regulatory bodies worldwide.</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/autorite.png" alt="autorite" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Autorité des marchés financiers</strong>
            <p style="margin-top:0px">the France regulator ensures the privacy of clients, as well as govern all products and services in the market.</p>
        </td>
    </tr>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/consob.png" alt="consob" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Commissione Nazionale per le Società e la Borsa</strong>
            <p style="margin-top:0px">it is anchored in three attributions every market should have: credibility, integrity, and transparency.</p>
        </td>
    </tr>

    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/esma.png" alt="esma" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">European Securities and Markets Authority</strong>
            <p style="margin-top:0px">a standalone entity upholding the financial system in the European Union by ensuring efficiency, integrity, and transparency of the markets.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/bafin.png" alt="bafin" style="margin: 10px auto;display: table; float:none;max-width: 500px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Federal Financial Supervisory Authority</strong>
            <p style="margin-top:0px">the Germany-based authority oversees financial institutions and undertakings in the country.</p>
        </td>
    </tr>

    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/fca.png" alt="fca" style="margin: 10px auto;display: table; float:none;max-width: 400px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Financial Conduct Authority</strong>
            <p style="margin-top:0px">an EU regulatory body cultivating development of clients, competition, and market integrity.</p>
        </td>
    </tr>
</table>';
        // $body .= '<ul style="padding: 10px 0;margin: 0 auto;">';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/cysec.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">Cyprus Securities and Exchange Commission</strong>';
        // $body .= '<p style="margin-top:0px;">a Cypriot financial regulatory agency securing the safety of investors and innovation in the security markets.</p></div>';
        // $body .= '</li>';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/mifid.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">Markets in Financial Instruments Derivative</strong>';
        // $body .= '<p style="margin-top:0px;">a directive responsible for regulating the investment services within the region.</p></div>';
        // $body .= '</li>';
        // $body .= '</ul>';


        // $body .= '<ul style="padding: 10px 0;margin: 0 auto;">';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/autorite.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">Autorité des marchés financiers</strong>';
        // $body .= '<p style="margin-top:0px;">the France regulator ensures the privacy of clients, as well as govern all products and services in the market.</p></div>';
        // $body .= '</li>';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/consob.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">Commissione Nazionale per le Società e la Borsa</strong>';
        // $body .= '<p style="margin-top:0px;">it is anchored in three attributions every market should have: credibility, integrity, and transparency.</p></div>';
        // $body .= '</li>';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/esma.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">European Securities and Markets Authority</strong>';
        // $body .= '<p style="margin-top:0px;">a standalone entity upholding the financial system in the European Union by ensuring efficiency, integrity, and transparency of the markets.</p></div>';
        // $body .= '</li>';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/bafin.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">Federal Financial Supervisory Authority</strong>';
        // $body .= '<p style="margin-top:0px;">the Germany-based authority oversees financial institutions and undertakings in the country.</p></div>';
        // $body .= '</li>';

        // $body .= '<li style="list-style-type: none;display: table;width: 100%;padding: 7px 0;">';
        // $body .= '<div style="width: 20%;float: left;"><img src="https://www.forexmart.com/assets/images/mailer/fca.png"></div>';
        // $body .= '<div style="width: 80%;float: right;"><strong style="color: #0070be;">Financial Conduct Authority</strong>';
        // $body .= '<p style="margin-top:0px;">an EU regulatory body cultivating development of clients, competition, and market integrity.</p></div>';
        // $body .= '</li>';

        // $body .= '</ul>';

        $body .= '<p>As we put clients above our own interests, ForexMart vows to offer the highest quality of services to our most valuable business partner – you. Trust us to work on this commitment incessantly. For concerns or inquiries, please feel free to send us an email at <a href="mailto:support@forexmart.com">support@forexmart.com</a></p>';

        $body .= '<p>Happy trading!</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div  style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #2988ca;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://my.forexmart.com/client/signin" style="color:white;text-decoration:none">Start Trading Today</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">Fund My Account</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';


        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'ForexMart: European License and Regulation', $body);
        return $sender;
    }

   public static function EuroLicenseRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_europeanlicense_img-russian.png" alt="mailing_europeanlicense_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>Компания ФорексМарт постоянно совершенствуется и делает все возможное, чтобы повышать качество предоставляемых услуг. Соблюдение прав наших клиентов, защита из личных данных и безопасность проведения сделок – приоритетные цели нашей компании.<br><br>';

        $body .= "Помимо закона об инвестиционных услугах и регулировании деятельности рынков Кипра от 2007 года, ФорексМарт подлежит надзору:";
        $body .= '</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/cysec.png" alt="cysec" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Кипрской комиссии по ценным бумагам и биржам (CySEC)</strong>
            <p style="margin-top:0px">Кипрский финансовый регулирующий орган обеспечивает безопасность инвесторов, осуществляет преобразования и защищает рынки.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/mifid.png" alt="mifid" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Директива Евросоюза "О рынках финансовых инструментов" (MiFID)</strong>
            <p style="margin-top:0px">Директива регулирует осуществление инвестиционных услуг в регионе.</p>
        </td>
    </tr>
</table>';
        $body .= '<p>Компания также выполняет правила, установленные различными регулирующими органами Европы.</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/autorite.png" alt="autorite" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Autorité des marchés financiers (AFM)</strong>
            <p style="margin-top:0px">Французский регулятор обеспечивает конфиденциальность клиентов, проверяет качество товаров и услуг на финансовых рынках.</p>
        </td>
    </tr>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/consob.png" alt="consob" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Commissione Nazionale per le Società e la Borsa (CONSOB)</strong>
            <p style="margin-top:0px">Итальянская комиссия по ценным бумагам и биржам поддерживает три необходимых качества рынка: доверие, честность и прозрачность.</p>
        </td>
    </tr>

        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/bafin.png" alt="bafin" style="margin: 10px auto;display: table; float:none;max-width: 500px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Federal Financial Supervisory Authority (BaFin)</strong>
            <p style="margin-top:0px">Регулирующий орган Германии осуществляет надзор над финансовыми учреждениями и предприятиями в стране.</p>
        </td>
    </tr>

    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/fca.png" alt="fca" style="margin: 10px auto;display: table; float:none;max-width: 400px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">The Financial Conduct Authority (FCA)</strong>
            <p style="margin-top:0px">Регулирующий орган Великобритании обеспечивает целостность рынка, защиту клиентов и поддержание конкуренции.</p>
        </td>
    </tr>
</table>';


        $body .= '<p>Поскольку мы ставим интересы клиентов выше своих собственных, мы делаем всё возможное для оказания услуг на самом высоком уровне. ФорексМарт всегда исполняет взятые на себя обязательства. <br><br>';

        $body .= 'По вопросам и предложениям, пожалуйста, пишите на электронный адрес: <a href="mailto:support@forexmart.com">support@forexmart.com</a></p>';

        $body .= '<p>Удачных торгов!</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'ФорексМарт: Европейская Лицензия и Регулирование', $body);
        return $sender;
    }


    //Mailer Scheduler Cron
    public static function depositInsurance($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_depositinsurance_img.png" alt="depositinsurance_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">We make adherence to industry regulations and standards our topmost priority. ForexMart is in the business of facilitating clients\' orders and safeguarding their funds. We separate all risks by our assets. Our company is not engaged in proprietary trading and we don\'t use our assets to hedge against trades.  <br><br>';

        $body .= "Our company is part of the Investor Compensation Fund, a fund formed by the Investment Firms Law 2002, aimed at protecting the claims of covered clients against the firm's members by covering their failure to perform their obligations. <br><br>";

        $body .= "If an investment firm fails to return the money owed to their clients or turn over the assets that belong to its customers, the fund shall pay up to €20,000 to the client. The amount to be paid is determined by checking the company's books, as well as its existing legal and contractual terms. For investment firms that service its customers through a branch located in a third country, the amount should not exceed €20,000. <br><br>";

        $body .= "To know more about deposit insurance, visit <a href='https://www.forexmart.com/deposit-insurance' style='text-decoration: underline;'>Deposit Insurance</a> or <a href='https://www.forexmart.com/contact-us' style='text-decoration: underline;'>contact us.</a>";

        $body .= '</p>';

        $body .= '<center><a href="https://my.forexmart.com/deposit">';
        $body .= '<img src="https://www.forexmart.com/assets/images/btn-dept-insurance.png" alt="btn-dept-insurance" style="float: none;margin: 0 auto;"></a></center>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Deposit Insurance - highest level of client’s funds security', $body);
        return $sender;
    }

    public static function depositInsuranceRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();

        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_depositinsurance_img-russian.png" alt="depositinsurance_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';

        $body .= '<p style="#1d1d1d">Следование правилам регуляции и стандартам, существующим в индустрии Форекс – одна из важнейших задач компании ФорексМарт. Мы стремимся предоставлять нашим клиентам только высококачественные и безопасные услуги.<br><br>';

        $body .= "ФорексМарт входит в состав Компенсационного Фонда Инвесторов, действующего в соответствии с «Законом об инвестиционных услугах и деятельности регулируемых рынков» от 2007 года. Согласно этому закону, Фонд занимается покрытием исков защищенных клиентов к инвестиционным компаниям в случае невыполнения ими своих обязательств. <br><br>";

        $body .= "Все депозиты клиентов нашей компании автоматически застрахованы. При возникновении страхового случая, Компенсационный Фонд Инвесторов обязуется вернуть застрахованным клиентам их средства в размере, не превышающем 20 тысяч евро. Размер компенсации рассчитывается в соответствии с правовыми и контрактными условиями.<br><br>";

        $body .= 'Чтобы узнать больше о страховании депозита, посетите страницу "Страхование Депозита" или свяжитесь с нами.';

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #2988ca;padding:15px;width: 315px;display: inline-block;">
                <a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">Сделать безопасное пополнение</a>
                </div></center>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С наилучшими пожеланиями,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Страхование Депозита – самый высокий уровень безопасности средств клиента', $body);
        return $sender;
    }



    public static function moneyfallContest($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_moneyfallcontest_img_2.png" alt="mailing_moneyfallcontest_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Prove your worth. Put your skills into test. Participate in Money Fall, our weekly contest. Reach the maximum profit, beat other traders, and get a chance to win a prize every week. <br><br>";

        $body .= "The contest is open for all ForexMart clients, where the 1st place takes home $300! We reward top 10 traders each week! <br><br>";

        $body .= "The weekly contest happens from Monday to Friday. For further information, visit the official page of the contest <a href='https://www.forexmart.com/contact-us'>here</a>. <br><br>";

        $body .= "Register in the contest page to join. The weekly contest is held from Monday to Friday. For more information about the contest, visit Money Fall or contact us <a href='https://www.forexmart.com/forex-contests/money-fall'>here</a>. Go ahead. Crunch the numbers now!";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div  style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #319ae3;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration" style="color:white;text-decoration:none">Register Now!</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">Fund My Account</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';


        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Good Luck,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Take a chance to win in weekly contest Money Fall', $body);
        return $sender;
    }

    public static function moneyfallContestRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_moneyfallcontest_img-russian.png" alt="mailing_moneyfallcontest_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемые ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">Покажите, чего вы стоите! <br><br>';

        $body .= "Проверьте свои навыки: учавствуйте в Деньгопаде - нашем первом еженедельном конкурсе. Получайте максимальную прибыль, побеждайте других трейдеров и выигрывайте до €300 еженедельно. <br><br>";

        $body .= "В конкурсе может участвовать каждый активный клиент ФорексМарт. <br>";

        $body .= "Победитель получает $300!<br>";
        $body .= "2-е место - $90.<br>";
        $body .= "3-е место - $75.<br>";
        $body .= "Занявшие 4-е, 5-е места выигрывают $70 и $65 соответственно.<br>";
        $body .= "Занявшие 6-е, 7-е, 8-е, 9-е и 10-е места выигрывают $60, $55, $50, $45 и $40 соответственно. <br><br>";

        $body .= "Конкурс проводится каждую неделю с понедельника по пятницу. Зарегистрируйтесь на странице конкурса или откройте демо-счет для того, чтобы принять участие. Для получения дополнительной информации посетите наш сайт или напишите нам. <br>Начните зарабатывать прямо сейчас!";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div  style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #319ae3;padding:15px;min-width: calc(75% / 3);width: 233px;display: inline-block;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration" style="color:white;text-decoration:none;font-size:13px;">ПРИСОЕДИНЯЙТЕСЬ СЕЙЧАС!</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(75% / 3);width: 195px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(75% / 3);width: 195px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';


        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Удачи,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Примите участие в еженедельном конкурсе Деньгопад.', $body);
        return $sender;
    }

    //Mailer Scheduler Cron
    public static function callbackServices($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/call-back"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_callbackservice_img.png" alt="callbackservice_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">We are here to answer your questions and solve your problems. Upholding our firm commitment to be your reliable trading partner, ForexMart wants to help you in every step of your trading journey. <br><br>';

        $body .= "If you are having any trouble calling our customer service, you may get in touch with us using our callback service. The feature is primarily designed to give solutions to all problems as fast as possible. With this service, you can request to get in touch with one of our managers at your most convenient time. Ask and we shall call you back. <br><br>";

        $body .= "All you need to do is to provide your contact details and indicate your preferred callback time by filling up this <a href='https://www.forexmart.com/call-back' style='text-decoration: underline;'>form</a>. Our support specialists will respond to all your concerns within 24 hours. For other questions, please do not hesitate to <a href='https://www.forexmart.com/contact-us' style='text-decoration: underline;'>contact us.</a> <br><br>";

        $body .= "The service is free of charge and can be used by all our clients. Here's to wishing you a successful trading!";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Have a call from our specialists any time', $body);
        return $sender;
    }

    public static function callbackServicesRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/ru/call-back"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_callbackservice_img-russian2.png" alt="mailing_callbackservice_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Мы здесь, чтобы ответить на ваши вопросы и решить ваши проблемы, связанные с торговлей. Отстаивая нашу твердую приверженность быть вашим надежным торговым партнером, ФорексМарт хочет помочь вам на каждом шаге вашего торгового пути. <br><br>";

        $body .= "Если вам неудобно звонить в отдел поддержки клиентов, вы можете связаться с нами, используя услугу обратного звонка. Эта функция, в первую очередь, предназначена для быстрого решения всех возникших проблем. Благодаря этой услуге, вы можете заказать обратный звонок от одного из наших менеджеров в самое удобное для Вас время. Оставьте заявку, и мы вам перезвоним. <br><br>";

        $body .= "Все, что вам нужно сделать, это предоставить свои контактные данные и указать желаемое время обратного звонка, заполнив эту форму. Наши специалисты службы поддержки ответят на все ваши вопросы в течение 24 часов.<br><br>";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Закажите звонок от наших специалистов в любое время', $body);
        return $sender;
    }


    //Mailer Scheduler Cron
    public static function vpsServices($to, $name, $unsubscribe_key)
    {
        $CI =& get_instance();
        $CI->lang->load('vpsmailing');
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/vps-hosting"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_freevpsservice_img.png" alt="freevpsservice_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">'.lang('vps_l1').' '. $name . ',</label>';
        $body .= '<p style="#1d1d1d">'.lang('vps_l2').'<br><br>';
        $body .= lang('vps_l3')." <br><br>";
        $body .= lang('vps_l4')."<br><br>";
        $body .= lang('vps_l5')."<a href='mailto:support@forexmart.com'>support@forexmart.com</a>. <br><br>";
        $body .= lang('vps_l6').'</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">'.lang('vps_l7').'<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">'.lang('vps_l8').'</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Don’t stop trading with Free VPS from ForexMart', $body);
        return $sender;
    }

    public static function vpsServicesRussian($to, $name, $unsubscribe_key)
    {
        $CI =& get_instance();
        $CI->lang->load('vpsmailing');
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/vps-hosting"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_freevpsservice_img-russian.png" alt="freevpsservice_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый '. $name . ',</label>';
        $body .= '<p style="#1d1d1d">Спешим представить вам еще один ценный инструмент для успешной торговли на валютном рынке - VPS хостинг от ФорексМарт. <br><br>';
        $body .= "В вашем распоряжении будет удаленный персональный компьютер Dell R730xd с 2x E5-2680v3 на платформе Windows Server 2008 с 26 GB дискового пространства и 1GB оперативной памяти. Компьютер имеет бесперебойный доступ в интернет. <br><br>";
        $body .= "VPS хостинг на надежном сервере гарантирует высокую скорость работы в любое время, отсутствие перезагрузок, безопасность и защищенность всех соединений.<br><br>";
        $body .= "Услуга предоставляется бесплатно всем активным клиентам ФорексМарт. Для получения VPS необходимо внести от $500 (или эквивалент в любой валюте) на свой торговый счет. Для активации услуги просто отправьте письмо в наш отдел поддержки клиентов на электронный адрес: <a href='mailto:support@forexmart.com'>support@forexmart.com</a>. <br><br>";
        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Не переставайте торговать с бесплатным VPS от ФорексМарт', $body);
        return $sender;
    }
    public static function vpsServices1($to, $name)
    {
        $CI =& get_instance();
        $CI->lang->load('vpsmailing');
        $body = self::NewestHeader();
        $subject = "test VPS mailing";

        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/vps-hosting"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_freevpsservice_img.png"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">'.lang('vps_l1').' '. $name . ',</label>';
        $body .= '<p style="#1d1d1d">'.lang('vps_l2').'<br><br>';
        $body .= lang('vps_l3')." <br><br>";
        $body .= lang('vps_l4')."<br><br>";
        $body .= lang('vps_l5')."<a href='mailto:support@forexmart.com'>support@forexmart.com</a>. <br><br>";
        $body .= lang('vps_l6').'</p>';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">'.lang('vps_l7').'<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">'.lang('vps_l8').'</span></label>';
        $body .= '</div>';
        //$footer = self::NewestFoooter($unsubscribe_key);

        // $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        //$sender = self::MailerSchedulerSenderPeriodic($to, 'Don’t stop trading with Free VPS from ForexMart', $body);
        //return $sender;
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";

        self::sender($to,$subject,$body,$from,$returnPath);
    }

    //Mailer Scheduler Cron
    public static function leverage($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_leverage_img.png" alt="leverage">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">Revealing and optimizing the ongoing advancements in the market, ForexMart endeavors to improve its products and services continuously to make trading more appealing and interesting. We realize the necessity of exploring trading opportunities to keep up with the fast-paced market movements.<br><br>';

        $body .= '</p>';

        // $body .= '<div style="width: 92%;float: none!important;display: table;vertical-align: middle;">';
        // $body .= '<div style="width:25%;float:left;">';
        // $body .= '<img src="https://www.forexmart.com/assets/images/mailing-img2.png" style="margin: 0 auto;display: table;">';
        // $body .= '</div>';
        // $body .= '<div style="width:75%;float:left;">';
        // $body .= '<p style="margin: 35px 0;">We have increased the leverage up to 1:5000, the highest leverage in the market. This is one of the best offers on the market. You just need to deposit $1 on your trading account to keep the positions open and benefit from our leverage offers.</p>';
        // $body .= '</div>';

        // $body .= '<div style="width: 92%;float: none!important;display: table;vertical-align: middle;">';
        // $body .= '<div style="width:25%;float:left;">';
        // $body .= '<img src="https://www.forexmart.com/assets/images/mailing-img3.png" style="margin: 0 auto;display: table;">';
        // $body .= '</div>';
        // $body .= '<div style="width:75%;float:left;">';
        // $body .= '<p style="margin: 35px 0;">Today is the best time to dive into trading. Visit our <a href="https://www.forexmart.com/" style="text-decoration: underline;color: #2988ca;">official website</a> or send us an email at <a href="mailto:info@forexmart.com" style="text-decoration: underline;color: #2988ca;">info@forexmart.com</a> for more information.</p>';
        // $body .= '</div>';
        // $body .= '</div>';

        $body .= '<table width="92%">
    <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailing-img2.png" alt="mailing-img" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <p style="margin-top:0px">We have increased the leverage up to 1:5000, the highest leverage in the market. This is one of the best offers on the market. You just need to deposit $1 on your trading account to keep the positions open and benefit from our leverage offers.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailing-img3.png" alt="mailing-img3" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <p style="margin-top:0px">Today is the best time to dive into trading. Visit our official website or send us an email at info@forexmart.com for more information.</p>
        </td>
    </tr>
</table>';

        $body .= '<center><div style="margin: 20px auto;margin-bottom: 10px;">';
        $body .= '<p style="color: #2988ca;font-size: 17px;text-align: center;margin-bottom: 0;line-height: 35px;">';
        $body .= '<i style="font-family: georgia,times new roman,serif;font-weight: 600;font-size: 35px;line-height: 10px;color: #2988ca;">“</i>';
        $body .= 'Have an effective and profitable day ahead!';
        $body .= '<i style="font-family: georgia,times new roman,serif;font-weight: 600;font-size: 35px;line-height: 10px;color: #2988ca;">”</i>';
        $body .= '</p></div>';
        $body .= '</center>';

        $body .= '<center><p style="color: #1d1d1d;">If you are ready</p>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div  style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #2988ca;padding:15px;min-width: calc(75% / 3);width: 215px;display: inline-block;">';
        $body .= '<a href="#" style="color:white;text-decoration:none">Get Maximum Leverage!</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(75% / 3);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';


        $body .= '</div></center>';


        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Take Your Trading to the Next Level', $body);
        return $sender;
    }
    public static function leverageRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_leverage_img-russian.png" alt="leverage">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">ФорексМарт стремится к непрерывному совершенствованию предлагаемых продуктов и услуг, постоянно открывая новые возможности для вашего роста и финансового успеха.<br><br>';

        $body .= '</p>';

        // $body .= '<div style="width: 92%;float: none!important;display: table;vertical-align: middle;">';
        // $body .= '<div style="width:25%;float:left;">';
        // $body .= '<img src="https://www.forexmart.com/assets/images/mailing-img2.png" style="margin: 0 auto;display: table;">';
        // $body .= '</div>';
        // $body .= '<div style="width:75%;float:left;">';
        // $body .= '<p style="margin: 35px 0;">We have increased the leverage up to 1:5000, the highest leverage in the market. This is one of the best offers on the market. You just need to deposit $1 on your trading account to keep the positions open and benefit from our leverage offers.</p>';
        // $body .= '</div>';

        // $body .= '<div style="width: 92%;float: none!important;display: table;vertical-align: middle;">';
        // $body .= '<div style="width:25%;float:left;">';
        // $body .= '<img src="https://www.forexmart.com/assets/images/mailing-img3.png" style="margin: 0 auto;display: table;">';
        // $body .= '</div>';
        // $body .= '<div style="width:75%;float:left;">';
        // $body .= '<p style="margin: 35px 0;">Today is the best time to dive into trading. Visit our <a href="https://www.forexmart.com/" style="text-decoration: underline;color: #2988ca;">official website</a> or send us an email at <a href="mailto:info@forexmart.com" style="text-decoration: underline;color: #2988ca;">info@forexmart.com</a> for more information.</p>';
        // $body .= '</div>';
        // $body .= '</div>';

        $body .= '<table width="92%">
    <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailing-img2.png" alt="mailing-img" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <p style="margin-top:0px">Четко осознавая необходимость освоения новых торговых технологий для того, чтобы идти в ногу со стремительными движениями на рынке, мы увеличили плечо до 1:5000. Это самый большой размер кредитного плеча из существующих сегодня. Воспользоваться нашим уникальным предложением можно, пополнив торговый счет на сумму от $1. Торговля с ФорексМарт при сверх выгодных условиях поможет вам извлечь максимальную выгоду. </p>
        </td>
    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailing-img3.png" alt="mailing-img3" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <p style="margin-top:0px">Сейчас самое лучшее время для того, чтобы погрузиться в торговлю. Посетите официальный веб-сайт компании или свяжитесь с нами по e-mail info@forexmart.com для получения более подробной информации.</p>
        </td>
    </tr>
</table>';

        $body .= '<center><div style="margin: 20px auto;margin-bottom: 10px;">';
        $body .= '<p style="color: #2988ca;font-size: 17px;text-align: center;margin-bottom: 0;line-height: 35px;">';
        $body .= '<i style="font-family: georgia,times new roman,serif;font-weight: 600;font-size: 35px;line-height: 10px;color: #2988ca;">“</i>';
        $body .= 'Желаем эффективного и прибыльного дня!';
        $body .= '<i style="font-family: georgia,times new roman,serif;font-weight: 600;font-size: 35px;line-height: 10px;color: #2988ca;">”</i>';
        $body .= '</p></div>';
        $body .= '</center>';

        $body .= '<center>';
        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #2988ca;padding:15px;width: 400px;display: inline-block;">
                <a  href="#" style="color:white;text-decoration:none">получите максимальное кредитное плечо!</a>
                </div></center>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Переведите Свою Торговлю на Следующий Уровень', $body);
        return $sender;
    }

    //Mailer Scheduler Cron
    public static function mt5($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_mt5forextradingportal_img.png" alt="forextradingportal_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">We would like to share the info about MT5 Forex Trading Portal. <br><br>';

        $body .= "Here, you’ll be provided with the latest news events in the market. All data are fresh and relevant with educational materials for your perusal. The popular information website has been designed to supply all the essential market information in a user-friendly interface to ensure that you get the right news at the right moment. <br><br>";

        $body .= "We have compact information boxes that presents the different aspects of the forex trade. There are Forex charts and quotes for the trader on-the-go. Hot news and Forex TV stream and update real-time for easy access. MT5 also keeps your mood light and your wits sharp with Forex humor and Forex anecdotes. Forex analysis, monitoring, Trader’s position, Market Map, and Major stock indices box are all available to summarize the Forex Market. In Experts Say, users can take a look at editorials. Today’s promo shows bonuses and trading deals. Keep track of market events on the Forex calendar as you browse through the Photo news. MT5 members can interact through Forum activity. We give you everything you need to know. <br><br>";

        $body .= "Get the right information. Learn the trade. Visit the MT5 Forex Trading Portal and be in the know. <br><br>";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Best Regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Latest market news. Real-time data. It’s all here.', $body);
        return $sender;
    }

    public static function mt5_email_tracker($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_mt5forextradingportal_img.png" alt="forextradingportal_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">We would like to share the info about MT5 Forex Trading Portal. <br><br>';

        $body .= "Here, you’ll be provided with the latest news events in the market. All data are fresh and relevant with educational materials for your perusal. The popular information website has been designed to supply all the essential market information in a user-friendly interface to ensure that you get the right news at the right moment. <br><br>";

        $body .= "We have compact information boxes that presents the different aspects of the forex trade. There are Forex charts and quotes for the trader on-the-go. Hot news and Forex TV stream and update real-time for easy access. MT5 also keeps your mood light and your wits sharp with Forex humor and Forex anecdotes. Forex analysis, monitoring, Trader’s position, Market Map, and Major stock indices box are all available to summarize the Forex Market. In Experts Say, users can take a look at editorials. Today’s promo shows bonuses and trading deals. Keep track of market events on the Forex calendar as you browse through the Photo news. MT5 members can interact through Forum activity. We give you everything you need to know. <br><br>";

        $body .= "Get the right information. Learn the trade. Visit the MT5 Forex Trading Portal and be in the know. <br><br>";

        $body .= '</p>';

       
        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Best Regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Latest market news. Real-time data. It’s all here.', $body);
        return $sender;
    }

    public static function mt5Russian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_mt5forextradingportal_img-russian.png" alt="forextradingportal_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">Мы рады поделиться с вами информацией о Форекс-портале для трейдеров MT5. <br><br>';

        $body .= "Здесь вы будете постоянно в курсе последних новостей и событий рынка. Все самые свежие данные и обучающие материалы всегда в вашем распоряжении. Популярный информационный портал создан специально для того, чтобы предоставлять всю необходимую информацию о состоянии рынка в удобном интерфейсе и обеспечивать вас нужными новостями в нужный момент. <br><br>";

        $body .= 'Компактные информационные блоки с различными аспектами торговли на Форекс. Графики Форекс и котировки онлайн. Горячие новости. Форекс-телевидение. Порция здорового юмора, чтобы разнообразить трейдерские будни. Живая аналитика, мониторинг, позиции трейдеров, карта рынка и блок с основными биржевыми индикаторами дают текущую характеристику рынка Форекс. Раздел "Авторитетное мнение" позволит вам узнать мнение ключевых финансовых и политических фигур о наиболее важных событиях в мире. В блоке "Сегодняшние промо" отображаются актуальные бонусы и торговые сделки. Следите за важными событиями рынка через Форекс-календарь так же, как вы просматриваете фото в новостной ленте. Пользователи MT5 могут свободно общаться друг с другом на форуме портала. Мы предоставляем вам все, о чем вы хотите узнать больше.<br><br>';

        $body .= "Получайте нужную информацию. Изучайте торговлю. Посещайте Форекс портал для трейдеров <a href='www.MT5.com'>www.MT5.com</a> и будьте всегда в курсе. <br><br>";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С наилучшими пожеланиями,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Последние новости рынка. Данные в реальном режиме. Все это здесь.', $body);
        return $sender;
    }

    public static function rpj_racing_cooperation($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/banner-rpj4.jpg" alt="banner-rpj4">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">ForexMart is pleased to announce the official partnership with RPJ Racing. <br><br>';

        $body .= "RPJ Racing is the company of racing and rock legend Rick Parfitt Jnr. It has a long history of success in racing and in winning. It’s latest undertaking is the British GT Championship, a world-renowned racing competition attended by the elites of the racing industry. Rick Parfitt Jnr himself is in the competition this year aboard the Bentley GT3. As a former 2013 GT4 Champion, expectations are high for him. He joins the Bentley Team Parker. <br><br>";

        $body .= "We believe that this partnership will stimulate mutual growth for both companies and expected to bear a fruitful collaboration between the two companies with the aim of mutual growth through joint campaigns and new promotions. <br><br>";

        $body .= "Follow us on social media to keep updated with our latest endeavors. <br><br>";

        $body .= "ForexMart and RPJ Racing looks forward to a great partnership to provide a better service to you, our clients.";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">FUND MY ACCOUNT</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'The skills, the speed, the ambitions. ForexMart is official Partner of RPJ racing.', $body);
        return $sender;
    }

    public static function rpj_racing_cooperationRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_rpj-partnership_img.png" alt="mailing_rpj-partnership_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Компания ФорексМарт рада объявить об официальном партнерстве с PPJ Рейсинг.<br><br>";

        $body .= "RPJ Рейсинг это команда гонщика и рок-музыканта Рика Парфитта Младшего. <br><br>";

        $body .= "Можно долго рассказывать о выдающихся успехах и победах этой команды. Они принимают участие во всемирноизвестном британском чемпионате (British GT Championship), где соревнуются с элитой британского гоночного спорта. Сам Рик Парфитт Младший также примет участие в этих соревнованиях за рулем Bentley GT3. Он уже становился победителем чемпионата GT4 в 2013 году, поэтому команда рассчитывает на его успех и в этот раз. Он присоединится к команде Bentley Team Parker. <br><br>";

        $body .= "Мы уверены, что это партнерство будет стимулировать взаимный рост для обеих компаний, а также поспособствует плодотворному сотрудничеству в виде проведения совместных кампаний и участия в акциях. <br><br>";

        $body .= "Подписывайтесь на нас в социальных сетях, чтобы быть в курсе последних новостей и вместе радоваться нашим успехам. <br><br>";

        $body .= "ФорексМарт и RPJ Рейсинг делают все для улучшения качества сервисов для Вас - наших клиентов.";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С наилучшими пожеланиями,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Навыки, скорость, амбиции. ФорексМарт - официальный партнер RPJ рейсинг', $body);
        return $sender;
    }


    public static function affiliate_program($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/affiliate-program"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_affiliateprogram_img.png" alt="affiliateprogram_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">As your trading companion in the industry, we want nothing but the best for you. <br><br>';

        $body .= 'Our affiliate program enables you to generate profits even if you are not trading. Simply promote our products and services and you shall earn accordingly. When a client signs up for a ForexMart account through an advertisement or link, you get paid for the transaction. <br><br>';

        $body .= 'As a partner you will have a personal affiliate manager, complete promotional materials, and high commission rates, letting you optimize your profits, expand your client network, and make a mark in the industry. <br><br>';

        $body .= 'ForexMart offers the following partnership packages:';
        $body .= '</p>';

        $body .= '<table width="92%">
    <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/friend-referrer.png" alt="friend-referrer" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">Friend-referrer</h2></center>
            <p style="margin-top:0px">Let people earn for you. Simply promote ForexMart services to prospective clients and sign them up into our company. As they trade and gain money, you earn as well.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/local-office-partner.png" alt="local-office-partner" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">Local Office Partner</h2></center>
            <p style="margin-top:0px">Set up a ForexMart office in your city or town and pitch our offerings. All our representatives have access to dedicated personal managers, and also receive expansive reading materials about trading and latest trading technology.</p>
        </td>
    </tr>

    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/online-partner.png" alt="online-partner" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">Online Partner</h2></center>
            <p style="margin-top:0px">Is designed for tech-savvy people, take advantage of the website traffic. When an individual opens a ForexMart account through your advertisement or link, the person is automatically added to your client database. make money on their trade.</p>
        </td>
    </tr>

    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/webmaster_mail.png" alt="webmaster_mail" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">Webmaster</h2></center>
            <p style="margin-top:0px">Seeking to unveil a website or improve an existing site? Use our glitch-free widgets and other promotional materials to advertise our services. Adding info on your site is as simple as providing online contents.</p>
        </td>
    </tr>
</table>';

        $body .= '<p style="#1d1d1d">All our affiliate programs have high, competitive commissions, complete marketing tools, affiliate link, and personalized partnership support. <br><br>';

        $body .= 'Innovate the way you do trading. Be a ForexMart partner and discover endless opportunities to gain profit.</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">FUND MY ACCOUNT</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Start your business with ForexMart', $body);
        return $sender;
    }

    public static function affiliate_programRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/affiliate-program"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_affiliateprogram_img-russian.png" alt="affiliateprogram_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">Компания ФорексМарт, будучи вашим надёжным партнёром, предлагает множество способов приумножения вашего дохода.<br><br>';

        $body .= 'Вы можете получать прибыль, участвуя в партнерской программе, даже не торгуя самостоятельно. Зарабатывайте на продвижении наших товаров и услуг. Вам заплатят за каждую сделку, совершенную новым клиентом, пришедшим в компанию ФорексМарт по вашей рекламе или ссылке. <br><br>';

        $body .= 'При этом вам будет помогать персональный менеджер, и вы получите все необходимые рекламные материалы, чтобы расширить клиентскую базу и найти свое место в отрасли Форекс торговли. Вы будете получать высокую комиссию, которая поможет вам значительно увеличить ваш заработок. <br><br>';

        $body .= 'ФорексМарт предлагает следующие виды партнерства: ';
        $body .= '</p>';

        $body .= '<table width="92%">
    <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/friend-referrer.png" alt="friend-referrer" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">“Привлекаю друзей”</h2></center>
            <p style="margin-top:0px">Пусть люди зарабатывают для вас. Просто рекламируйте услуги ФорексМарт потенциальным клиентам и регистрируйте их в нашей компании. Когда они торгуют и получают деньги, вы тоже зарабатываете.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/local-office-partner.png" alt="local-office-partner" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">“Региональный представитель”</h2></center>
            <p style="margin-top:0px">Создайте офис ФорексМарт в вашем городе и распространяйте наши предложения. Все наши представители консультируются с персональным менеджером, а также получают разносторонние материалы для изучения рынка и последних торговых технологий.</p>
        </td>
    </tr>

    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/online-partner.png" alt="online-partner" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">“Онлайн партнер”</h2></center>
            <p style="margin-top:0px">Для технически продвинутых. Заработайте на трафике вашего сайта. Клиент, открывший счет в компании ФорексМарт, перейдя по вашей рекламе или ссылке, автоматически попадает в вашу клиентскую базу. Вы зарабатываете на его торговле.</p>
        </td>
    </tr>

    </tr>
        <tr>
        <td style="width: 20%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/webmaster_mail.png" alt="webmaster_mail" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 80%;">
            <center><h2 style="margin: 20px auto;font-size: 18px;margin-bottom: 10px;margin-top: 0px;color:#2988ca;font-family: Georgia,serif;font-weight: 500;">“Вебмастер”</h2></center>
            <p style="margin-top:0px">Собираетесь запустить сайт или улучшить уже имеющийся? Используете наши виджеты и другие рекламные инструменты. Это не сложнее, чем вставить строку текста, но приносит прибыль.</p>
        </td>
    </tr>
</table>';

        $body .= '<p style="#1d1d1d">Все партнерские программы имеют высокие комиссии, разнообразные маркетинговые инструменты, партнерскую ссылку и персональную поддержку. <br><br>';

        $body .= 'Откройте для себя торговлю по-новому! Станьте партнером ФорексМарт, используйте все возможности зарабатывать вместе с нами.</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С наилучшими пожеланиями<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Компания ФорексМарт.</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Начни свой бизнес с ФорексМарт', $body);
        return $sender;
    }

    //testing zoffmyan10
    public function rpjmail($to, $unsubscribe)
    {

        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/banner-rpj4.jpg">';
        $body .= '</div><br>';

        $body .= '<div class="main-bg-body" style="min-height: 312px;">              <label style="font-family: arial; color: rgb(29, 29, 29); font-weight: normal;">Dear Client,</label>              <p style="font-family: arial; color: rgb(29, 29, 29); text-align: justify; display: block; -webkit-margin-after: 1em; -webkit-margin-start: 0px; -webkit-margin-end: 0px;">              ForexMart is pleased to announce the official partnership with RPJ Racing.<br><br>RPJ Racing is the company of racing and rock legend Rick Parfitt Jnr. It has a long history of success in racing and in winning. Its latest undertaking is the British GT Championship, a world-renowned racing competition attended by the elites of the racing industry. Rick Parfitt Jnr himself is in the competition this year aboard the Bentley GT3. As a former 2013 GT4 Champion, expectations are high for him. He joins the Bentley Team Parker. <br><br>We believe that this partnership will stimulate mutual growth for both companies and expected to bear a fruitful collaboration between the two companies with the aim of mutual growth through joint campaigns and new promotions. <br><br>Follow us on social media to keep updated with our latest news and activities. <br><br>ForexMart and RPJ Racing looks forward to a great partnership to provide a better service to you, our clients.</p><p style="text-align: justify; display: block; -webkit-margin-after: 1em; -webkit-margin-start: 0px; -webkit-margin-end: 0px;"><span style="color: rgb(29, 29, 29); font-family: arial;">ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</span><br></p></div>';
        // $footer = self::NewestFoooter();
        $body .= '<div style="display:block; width:100%; text-align:center;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a></div>                <span style="color: rgb(29, 29, 29); font-size: 14px; font-family: Helvetica;">All the best,</span>        <span class="name-team" style="font-family: &quot;Times New Roman&quot;; font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">        <span style="font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">ForexMart Team</span>        <br>        </span>        ';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }

    public function rpjmail_russian($to, $unsubscribe)
    {

        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/periodic-mailing_rpj-partnership_img.png">';
        $body .= '</div><br>';

        $body .= '<div class="main-bg-body" style="min-height: 312px;"><span class="name-team" style="display: block;"><label style="color: rgb(29, 29, 29); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; display: block;">Уважаемые клиенты,</label><p style="color: rgb(29, 29, 29); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; text-align: justify;">Компания ФорексМарт рада объявить об официальном партнерстве с PPJ Рейсинг.<br></p>
<p style="text-align: justify;"><span style="color: rgb(29, 29, 29);">RPJ Рейсинг - это команда гонщика и рок-музыканта Рика Парфитта Младшего.</span></p>
<p style="text-align: justify;"><span style="color: rgb(29, 29, 29);">Можно долго рассказывать о выдающихся успехах и победах этой команды:она участвует во всемирноизвестном британском чемпионате (British GT Championship), где соревнуются элита британского гоночного спорта. Рик Парфитт Младший также примет участие в этих соревнованиях за рулем Bentley GT3. Он уже становился победителем чемпионата GT4 в 2013 году, поэтому команда рассчитывает на успех и в этот раз. Он присоединится к команде Bentley Team Parker.</span></p>
<p style="text-align: justify;"><span style="color: rgb(29, 29, 29);">Мы уверены, что это партнерство будет стимулировать взаимный рост для обеих компаний, а также поспособствует плодотворному сотрудничеству в виде проведения совместных кампаний и участия в акциях.</span></p>
<p style="text-align: justify;"><span style="color: rgb(29, 29, 29);">Подписывайтесь на нас в социальных сетях, чтобы быть в курсе последних новостей и вместе радоваться нашим успехам.</span></p>
<p style="text-align: justify;"></p>
<p style="text-align: justify;"><span style="color: rgb(29, 29, 29);">ФорексМарт и RPJ Рейсинг делают все возможное для улучшения качества сервиса наших клиентов.</span></p>
<div style="text-align: justify;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</div>
<div style="text-align: justify;"><br></div>
<div style="color: rgb(0, 58, 98); font-family: &quot;Times New Roman&quot;; font-size: 15px; font-weight: bold; display: block; width: 100%; text-align: center;"><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Открыть счет</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Получить бонус</a></div>
<br><label style="color: rgb(29, 29, 29); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; display: block;">С наилучшими пожеланиями,<span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ФорексМарт</span></label></span></div>';
        // $footer = self::NewestFoooter();.
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, ' Навыки, скорость, амбиции. ФорексМарт - официальный партнер RPJ рейсинг');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }

    public function fiftymail($to)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container">      <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;">                <div class="wrapper-body second-wrapper-body background-wrapper-body" style="    padding: 0;    position: relative;    border-top: 1px solid 333;">            <div class="main-bg-image" style="    overflow: hidden;    position: relative;"><img src="https://www.forexmart.com/assets/images/mailing_fiftypercentbonus_img.png" class="img-responsive" style="    margin: 0 auto;    display: table;"></div>            <div class="main-bg-body" style="    padding: 0 10px 10px 10px;    min-height: 312px;    display: block;">              <label style="    display: block;    font-weight: normal;    padding-top: 20px;    color: #1d1d1d;">Dear Client,</label>              <p style="    color: #1d1d1d;    text-align: justify;    display: block;    -webkit-margin-before: 1em;    -webkit-margin-after: 1em;    -webkit-margin-start: 0px;    -webkit-margin-end: 0px;">              <br>              With ForexMart, you can get the most out of your capital and gain more profit by availing of ForexMart’s 50% Bonus offer. You can get as much as 50% of the total money you deposited if you do it in our system. With just one click, you can instantly get an additional $50 once you deposit $100 in your account. A 50% bonus is automatically available for every deposit made.To know more about our bonus offer, click the button below.</p>     <br>         <div class="start-real-trading get-bonus-button" style="    background: #2988ca;    display: table;    margin: 0 auto;    cursor: pointer;    padding: 15px 20px;    transition: all 0.2s linear;">                <a href="https://www.forexmart.com/fifty-percent-bonus" style="    color: #fff;    font-size: 16px;    text-decoration: none;    text-transform: uppercase;    display: block;     padding: 15px 20px;">Get Bonus Here!</a>              </div> <span style="color: rgb(29, 29, 29); font-size: medium;">All the best,</span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block; ">ForexMart Team</span>    </div>        </div>                     </div>    </div>';
        $footer = self::NewestFoooter();
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Gain more profit by using ForexMart’s Bonus');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        echo $body;
    }


    public function analytical_reviews_english_client($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container"><div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;"><div class="wrapper-body second-wrapper-body background-wrapper-body" style="position: relative; line-height: 1.4;"><div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;"><img src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img.png" class="img-responsive" style="    margin: 0 auto;    display: table;"><span style="color: rgb(29, 29, 29); font-family: Helvetica;"><br><span style="font-size: 14px;">Dear ForexMart Client,</span></span></div>
<div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;"><span style="color: rgb(29, 29, 29); font-family: Helvetica;"><span style="font-size: 14px;"><br></span></span></div>
<div class="main-bg-body" main-bg-body="" style="min-height: 262px; display: block; line-height: 1.4;"><p style="color: rgb(29, 29, 29); text-align: justify; line-height: 1.4;"><span style="font-family: Helvetica;"><span style="font-size: 14px;">Greetings!&nbsp;</span><br><br><span style="font-size: 14px;">ForexMart would like to let you know that our website now features an Analytical Reviews Page which features important analytical tools, such as Forex market reviews, forecast articles, and Forex analysis articles which are sourced from significant economic events happening in the financial market. With this new ForexMart feature, clients can now make effective trading decisions which will then lead to more successful trades in the future.&nbsp;</span><br><br><span style="font-size: 14px;">For more details on the Analytical Reviews Page, kindly click on this link here:&nbsp;</span><a href="https://www.forexmart.com/analytical-reviews" class="link-color" style="color: rgb(41, 136, 202); text-decoration: underline;"><span style="font-size: 14px;">https://www.forexmart.com/analytical-reviews</span></a><br><br><span style="font-size: 14px;">Thank you so much, and may you have a successful trading experience!</span></span></p>
<p style="color: rgb(29, 29, 29); text-align: justify; display: block; -webkit-margin-before: 1em; -webkit-margin-after: 1em; -webkit-margin-start: 0px; -webkit-margin-end: 0px; line-height: 1.4;"></p>
<span style="color: rgb(29, 29, 29); font-size: 14px; font-family: Helvetica;">All the best,</span><span class="name-team" style="font-size: 14px; font-weight: bold; color: rgb(0, 58, 98); display: block;"><span style="font-family: Helvetica; font-size: 14px;">ForexMart Team</span></span></div>
        </div>
                     </div>
    </div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Have a successful trading experience through ForexMart’s Analytical Reviews Page');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        echo $body;
    }

    public function analytical_reviews_english_partner($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container">      <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;">                <div class="wrapper-body second-wrapper-body background-wrapper-body" style="position: relative; line-height: 1.4;">            <div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;"><img src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img.png" class="img-responsive" style="    margin: 0 auto;    display: table;"><span style="color: rgb(29, 29, 29); font-family: Helvetica;"><br><span style="font-size: 14px;">Dear ForexMart Partner,</span></span></div>
<p style="color: rgb(29, 29, 29); text-align: justify; line-height: 1.4;"><span style="font-family: Helvetica;"><br><span style="font-size: 14px;">Greetings!&nbsp;</span><br><br><span style="font-size: 14px;">ForexMart would like to announce that our website is now featuring an Analytical Reviews Page. This particular section of ForexMart will feature essential analytical tools, from fundamental and technical analysis, Forex market reviews, and forecast articles which are based on important economic events in the financial market. These can help you make sound trading decisions and more importantly, successful trades.&nbsp;</span><br><br><span style="font-size: 14px;">If you want to explore ForexMart’s Analytical Reviews Page, kindly click on this link:&nbsp;</span><a href="https://www.forexmart.com/analytical-reviews" class="link-color" style="color: rgb(41, 136, 202); text-decoration: underline;"><span style="font-size: 14px;">https://www.forexmart.com/analytical-reviews</span></a><br><br><span style="font-size: 14px;">Thank you so much, and we wish you a successful trading!</span></span></p>
<div class="main-bg-body" style="min-height: 20px; display: block; line-height: 1.4;"><span style="color: rgb(29, 29, 29); font-size: medium; font-family: Helvetica;"><span style="font-size: 14px;">All the best,</span></span><span class="name-team" style="font-size: 14px; font-weight: bold; color: rgb(0, 58, 98); display: block;"><span style="font-family: Helvetica; font-size: 14px;">ForexMart Team</span></span>    </div>
</div>
                     </div>
    </div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Have a successful trading experience through ForexMart’s Analytical Reviews Page');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        echo $body;
    }

    public function analytical_reviews_russian_partner($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container">      <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;">                <div class="wrapper-body second-wrapper-body background-wrapper-body" style="position: relative; line-height: 1.4;">            <div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;"><img src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img-russian.png" class="img-responsive" style="    margin: 0 auto;    display: table;"><span style="color: rgb(29, 29, 29);"><br><span style="font-size: 14px;">Уважаемый Партнер,</span></span></div>
<p style="color: rgb(29, 29, 29); text-align: justify; line-height: 1.4;"><span style="font-size: 14px;">Здравствуйте! &nbsp;</span><br><br><span style="font-size: 14px;">ФорексМарт рад сообщить, что на нашем вебсайте запущен новый раздел «Аналитические обзоры». В данном разделе будут представлены основные аналитические инструменты технического и фундаментального анализа, обзоры рынка&nbsp;форекс и статьи с прогнозами, основанные на важных экономических событиях финансового рынка. Вся эта информация поможет принимать более надежные торговые решения и что ещё важнее, способствовать более успешной торговле. &nbsp;</span><br><br><span style="font-size: 14px;">Если Вы хотите ознакомиться с разделом Аналитических обзоров от ФорексМарт, пожалуйста, пройдите по данной ссылке:&nbsp;</span><a href="https://www.forexmart.com/analytical-reviews" class="link-color" style="color: rgb(41, 136, 202); text-decoration: underline;"><span style="font-size: 14px;">https://www.forexmart.com/analytical-reviews</span></a><br><br><span style="font-size: 14px;">Спасибо, желаем Вам успешной торговли!</span></p>
<div class="main-bg-body" style="min-height: 20px; display: block; line-height: 1.4;"><span style="color: rgb(29, 29, 29); font-size: 14px;">Всего наилучшего,</span><span class="name-team" style="font-size: 14px; font-weight: bold; color: rgb(0, 58, 98); display: block;">Команда ФорексМарт</span>    </div>
</div>
                     </div>
    </div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Добейтесь успехов в торговле с аналитикой от ФорексМарт');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        echo $body;
    }

    public function analytical_reviews_russian_client($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container"><div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;"><div class="wrapper-body second-wrapper-body background-wrapper-body" style="position: relative; line-height: 1.4;"><div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;"><img src="https://www.forexmart.com/assets/images/mailing_analyticalreviews_img-russian.png" class="img-responsive" style="    margin: 0 auto;    display: table;"><span style="color: rgb(29, 29, 29);"><br><span style="font-size: 14px;">Уважаемый Клиент,</span></span></div>
<div class="main-bg-body" main-bg-body="" style="min-height: 262px; display: block; line-height: 1.4;"><p style="color: rgb(29, 29, 29); text-align: justify; line-height: 1.4;"><span style="font-size: 14px;">Здравствуйте!&nbsp;</span><br><br><span style="font-size: 14px;">ФорексМарт рад сообщить, что на нашем вебсайте запущен новый раздел «Аналитические обзоры». В данном разделе будут представлены основные аналитические инструменты технического и фундаментального анализа, обзоры рынка&nbsp;форекс и статьи с прогнозами, основанные на важных экономических событиях финансового рынка. Вся эта информация поможет Вам принимать более эффективные торговые решения, которые будут способствовать более успешной торговле. </span><br><br><span style="font-size: 14px;">Если Вы хотите ознакомиться с разделом Аналитических обзоров от ФорексМарт, пожалуйста, пройдите по данной ссылке:&nbsp;</span><a href="https://www.forexmart.com/analytical-reviews" class="link-color" style="color: rgb(41, 136, 202); text-decoration: underline;"><span style="font-size: 14px;">https://www.forexmart.com/analytical-reviews</span></a><br><br><span style="font-size: 14px;">Спасибо, желаем Вам успешной торговли!</span></p>
<p style="color: rgb(29, 29, 29); text-align: justify; display: block; -webkit-margin-before: 1em; -webkit-margin-after: 1em; -webkit-margin-start: 0px; -webkit-margin-end: 0px; line-height: 1.4;"></p>
<span style="color: rgb(29, 29, 29); font-size: 14px;">

Всего наилучшего,
</span><span class="name-team" style="font-size: 14px; font-weight: bold; color: rgb(0, 58, 98); display: block;">Команда ФорексМарт</span>    </div>        </div>                     </div>    </div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Добейтесь успехов в торговле с аналитикой от ФорексМарт');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        echo $body;
    }

    public function lasPalmasEnglishClient($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container"><div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;"><div class="wrapper-body second-wrapper-body background-wrapper-body" style="position: relative; line-height: 1.4;"><div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;">
        <img src="https://www.forexmart.com/assets/images/mailing_laspalmas_v4.png" style="width:100%!important;">
        <span style="color: rgb(29, 29, 29);font-size: 14px;"></span></div><div class="main-bg-body" main-bg-body="" style="min-height: 262px; display: block; line-height: 1.4;"><label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">Dear Trader,</label><p style="color: rgb(29, 29, 29); text-align: justify;"><br>Good news for football enthusiasts! We are excited to tell you that this year’s La Liga Season has started on 19th of August 2016 and will end on 21st of May 2017. Let us cheer together and support UD Las Palmas as they compete on their upcoming games!&nbsp;<br><br>Who is UD Las Palmas? Union Deportiva Las Palmas Club is a Spanish Football team who represents the community of Canary Islands. They are the only club who has been promoted back to back in the first two seasons of La Liga. For 19 years it has been part of the La Liga competition until ‘82-’83. Then returned as champions at the end of ‘63-’64 season and became successful in the succeeding competition. From 90s onwards, they played primarily in the Segunda Division and Segunda Division B. Just last year, it was promoted back to La liga after winning against Real Zaragoza.&nbsp;<br><br>ForexMart, a foreign exchange brokerage company based in Cyprus, being their official sponsor is giving full support to UD Las Palmas. Recently, they have been awarded as the Broker in Europe for 2 consecutive years from 2015 to present given by ShowFx World and International Finance Magazine accordingly. These awarding bodies recognize people and institutions that give impact to the financial industry and we are grateful to be recognized as we continue to provide innovative products and services to our clients.&nbsp;<br><br>They believe that a strong solid team like Las Palmas matches their pace to start powerful and give their best. They are convinced that both are positioned directed towards the same goals with future prospects hoping for a successful relationship. This is a great opportunity and a motivational drive to become better.&nbsp;<br><br>This collaboration marks a new chapter for both. Be part of the Las Palmas History as ForexMart continues to support the UD Las Palmas to success.</p><span style="color: rgb(29, 29, 29); font-size: 14px;">Regards,</span><span class="name-team" style="font-size: 14px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span></div>        </div>                     </div>    </div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ForexMart and Las Palmas open new season of collaboration');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        // echo $body;
    }

    public function lasPalmasRussianClient($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div class="wrapper-container"><div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    margin: 0 auto;    padding: 0!important;"><div class="wrapper-body second-wrapper-body background-wrapper-body" style="position: relative; line-height: 1.4;"><div class="main-bg-image" style="overflow: hidden; position: relative; line-height: 1.4;"><img src="https://www.forexmart.com/assets/images/mailing_laspalmas_img-russian.png" style="width:100%!important;"><label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">Уважаемые клиенты!</label><p style="color: rgb(29, 29, 29); text-align: justify;"><br>С радостью сообщаем вам о продлении нашего сотрудничества с испанским футбольным клубом “Лас-Пальмас”.&nbsp;<br><br>Прошедший год был успешным и для ФК, и для нашей компании - команда “Лас-Пальмас” уверенно выступила в Испанской Примере, а ФорексМарт ФорексМарт был признан “Лучшим новым брокером Европы 2015 года” по версии ShowFx World и “Лучшим новым брокером Европы 2016” по версии международного финансового журнала (IFM). Кроме того, благодаря сотрудничеству с испанским футбольным клубом, клиенты ФорексМарт смогли посмотреть зрелищный футбольный матч между клубами “Лас-Пальмас” и “Малага” в мае.&nbsp;<br><br>Надеемся, что благодаря нашей поддержке ФК “Лас-Пальмас” сможет занять лидирующее место и достойно выступить на чемпионате. А нашим клиентам еще раз выпадет шанс побывать на игре испанского футбольного клуба.</p><label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">C наилучшими пожеланиями,<span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ФорексМарт</span></label></div>        </div>                     </div>    </div>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ФорексМарт и ФК “Лас-Пальмас” продолжат сотрудничество');
        // $sender = self::MailerSchedulerSenderTest($to,'Gain more profit by using ForexMart’s Bonus',$body);
        // echo $body;
    }

    public static function mini_bonus_for_inactive_users($s_data){

        $r_data = array(
            'account_number' =>$s_data['account_number'],
            'Email' =>$s_data['Email'],
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();

        $subject = ' We have credited a Bonus to your account!';

        $body .='
                        <h2 style="text-align: center;color: #2988CA;">
                                 We have credited a Bonus to your account!
                         </h2>

                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">
                           Dear Client,
                        </p>
                          <br/>
                        <p class="greetings" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555">
                           Congratulations!
                        </p>
                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            We have great news for you! Your account has been credited with $10 Mini bonus. With this you could trade immediately and test our platform.
                         </p>

                        <p class="letter-body" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; text-align: justify; line-height: 19px">
                            Login -  '.$r_data['account_number'].' or   '.$r_data['Email'].'
                         </p>
  <br/>
                          <br/>
   <a href="https://my.forexmart.com/client/signin"><button type="button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;font: inherit;color: #fff;overflow: visible;text-transform: none;-webkit-appearance: button;cursor: pointer;font-family: inherit;font-size: inherit;line-height: inherit;width: 184px;;border: none;padding: 10px 30px;background: #29a643;">
                              GO TO CABINET
                        </button></a>

                        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
This is a wonderful opportunity to test our platform in real time without any investments. Profits can  be withdrawn immediately.
                        </p>

                          <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
To learn more information about mini-bonus, you could visit <a href="https://www.forexmart.com/no-deposit-bonus-agreement">here</a>. Please do not hesitate to contact us if you have any concerns or inquiries regarding your account or our services.
                        </p>
 <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
Thank you for staying with us. We wish you luck in Trading!
                        </p>
                        <br/>
                        <p class="closing" style="margin: 0 auto; font-size: 14px; font-family: Arial; font-weight: 400; color: #555; margin-top: 15px; line-height: 19px">
                            <span style="margin: 0 auto; font-weight: 600; color: #2988ca">
                                 Truly yours
                            </span>
                            <br/>
                                ForexMart Team
                        </p>
                    </div>';

        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        return  self::sender($r_data['Email'],$subject,$body,$from,$returnPath);
    }

    public static function live_registration_for_WSFM($data){

        $r_data = array(
            'fullname' => $data['full_name'],
            'email' => $data['email'],
            'password' => $data['trader_password'],
            'account_number' => $data['account_number'],
            'trader_password' => $data['trader_password'],
            'investor_password' => $data['investor_password'],
            'phone_password' => $data['phone_password'],
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MT4 Demo account details ';
        $body .= '
                <h2 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;page-break-after: avoid;font-family: Georgia,serif;font-weight: 500;line-height: 1.1;color: #2988ca;margin-top: 20px;margin-bottom: 10px;font-size: 22px;text-align: center;">
                    ForexMart MT4 Live Trading Account Details
                </h2>
                 <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
                <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">
                    Hi '.$r_data['fullname'].',
                </label> <br>
                Thank you for opening an MT4 account with ForexMart! Your login details are as follows
                </p>
<div class="cabinet-login-details" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 30px 20px;width: 500px;">
                <h1 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: .67em 0;font-size: 15px;font-family: inherit;font-weight: 500;line-height: 1.1;color: #5a5a5a;margin-top: 20px;margin-bottom: 10px;">
                    Cabinet login details.
                </h1>
                <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                    <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
                       Username:
                    </label>
                    '.$r_data['account_number'].' or  <a href="javascript:;" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">'.$r_data['email'].'</a>
                </div>

                    <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                        <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
                             Password:
                        </label>
                        <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;">'.urlencode($r_data['trader_password']).'</span>
                    </div>



                <div class="login-button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box; width: 350px; margin-top: 20px;">
                    <a href="https://my.forexmart.com/client/signin" style="text-decoration: none; text-align: center" >
                        <div style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;text-decoration: none; width:300px; box-sizing: border-box;margin: 0;text-align:center;font: inherit;color: #fff;overflow: visible;text-transform: none;-webkit-appearance: button;cursor: pointer;font-family: inherit;font-size: inherit;line-height: inherit;border: none;padding: 10px 30px;background: #29a643;">
                           Login to cabinet
                        </div>
                      </a>
                </div>
            </div>
            <div class="cabinet-login-details" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 30px 20px;width: 500px;">
                <h1 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: .67em 0;font-size: 15px;font-family: inherit;font-weight: 500;line-height: 1.1;color: #5a5a5a;margin-top: 20px;margin-bottom: 10px;">
					MT4 login details.
                </h1>
                <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                    <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
							Account Number:
                    </label>
                    <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;">  '.$r_data['account_number'].'</span>
                </div>
                <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                    <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
                        Trader Password:
                    </label>
                    <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;">  </span>
                </div>
                <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                    <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
						Investor Password:
                    </label>
                    <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;">'.$r_data['investor_password'].'</span>
                </div>
                <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                    <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
						Phone Password:
                    </label>
                    <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;">'.$r_data['phone_password'].'</span>
                </div>
                <div class="cabinet-login-data" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                    <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block!important;max-width: 100%;margin-bottom: 5px;font-weight: bold;color: #555;">
                        MT4 Live Server:
                    </label>
                    <a href="javascript:;" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">'.MT4_SERVER_LIVE.'</a>
                </div>
                <div class="download-button" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box; width: 300px;  margin-top: 20px;">
                    <a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe" style="text-decoration: none;text-align: center">
                        <div style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;text-decoration: none; width:300px;box-sizing: border-box;margin: 0;font: inherit;color: #fff;overflow: visible;text-transform: none;-webkit-appearance: button;cursor: pointer;font-family: inherit;font-size: inherit;line-height: inherit;border: none;padding: 10px 30px;background: #2988ca;text-decoration: none;text-align: center">
                           Download MT4 desktop platform
                        </div>
                       </a>
                </div>
            </div>
            <p style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;color: #5a5a5a;text-align: justify;">
                Keep your account details safe and secure at all times.
                <br><br>

					To express our gratitude for jump-starting your trading with us, you can avail of the 30%
                <a href="'.FXPP::loc_url('bonuses').'" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">'.lang('liv_acc_htm_16').'</a>
					offer, Open a real account make a deposit, and have the opportunity to get 30% of the total amount of this and every subsequent deposit.
                <br><br>
                We also offer several was to deposit money into your account. You can quickly and securely make deposits via credit/debit card, from your bank account via a Bank Transfer or through online money transfer services such as Skrill, Paypal, Webmoney, Neteller,
                Payco and many more. Please click here to know more about our different
                <a href="'.FXPP::loc_url('deposit-withdraw-page').'" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">
					'.lang('liv_acc_htm_19').'
				</a>.
                <br><br>

					You are categorized as a Retail Client. If you desire to be reclassified, kindly send a request to us and follow the steps outlined in the Client Categorization. You can start trading once your request is approved.
                <br><br>
					For more information, please do not hesitate to contact us at
                <a href="javascript:;" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background-color: transparent;color: #2988ca;text-decoration: underline;">support@forexmart.com</a>.
                <br><br>

					May you have a successful trading!
                <label style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;max-width: 100%;margin-bottom: 5px;font-weight: normal;color: #000;padding-top: 30px;">

						All the best,
                    <span style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: block;">
						ForexMart Team
                    </span>
                </label>
            </p>
        </div>
             ';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        return  self::sender($r_data['email'], $subject, $body, $from, $returnPath);

    }

    public static function demo_registration_for_WSFM($data){

        $r_data = array(
            'fullname' => $data['full_name'],
            'email' => $data['email'],
            'password' => $data['trader_password'],
            'account_number' => $data['account_number'],
            'trader_password' => $data['trader_password'],
            'investor_password' => $data['investor_password'],
            'server_link' => $data['server_link'],
        );

        $CI =& get_instance();
        $CI->lang->load('FxMailer');
        $body = self::head();
        $subject = 'ForexMart MT4 Demo account details';
        $body .= '
                <h1 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 30px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">
                    ForexMart MT4 Demo account details
                </h1>
    <div class="content-grid" style="">
        <p class="greetings" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;">
				Hi '.$r_data['fullname'].',
		</p>

        <p class="letter-body" style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
			Thank you for opening an MT4 demo account with ForexMart! Below are your account details:
        </p>
        <div style="margin: 20px 0 20px 50px;font-size: 14px;font-family: Arial;font-weight: 400;color: #555; margin-top: 15px; text-align: left; line-height: 19px;">
            <table style="font-size: 14px;font-family: Arial;font-weight: 400;color: #555;text-align: justify;line-height: 19px;">
                <tr>
                    <th >
						Account number:
                    </th>
                    <td > '.$r_data['account_number'].' </td>
                </tr>
                <tr>
                    <th >
                        Trader password:
                    </th>
                    <td > '.$r_data['trader_password'].' </td>
                </tr>
                <tr>
                    <th>
						Investor password:
                    </th>
                    <td > '.$r_data['investor_password'].' </td>
                </tr>
                <tr>
                    <th >
						MT4 Demo Server:
                    </th>
                    <td >'.$r_data['server_link'].'</td>
                </tr>


            </table>
        </div>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
			Please store your login details safe and secure at all times.
        </p>
        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
			Note that your login and password will work Meta Trader 4 only.
        </p>
        <p style="font-size: 14px;font-family: Arial sans-serif;font-weight: 400;color: #555;margin: 25px 0px 30px 0px;text-align: justify;"><a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe" style="cursor:pointer;background: none repeat scroll 0 0 #2988ca; border: 1px solid #2988ca; color: #fff; font-family: Arial; font-size: 15px; font-weight: 500; padding: 8px 25px; transition: all 0.3s ease 0s; text-decoration: none;">
            Download MT4 desktop platform
            </a></p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;line-height: 19px;">
			You may visit our
            <a target="_blank" href="'.FXPP::loc_url('faq').'" >
				Frequently Asked Questions
            </a>
				for more technical information. We wish you a successful trading!
        </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;text-align: justify;">
			For more information please do not hesitate to contact us at
            <a href="#"  style="margin: 0 auto;color: #2988ca;text-decoration: none;">
                support@forexmart.com
            </a>.
        </p>

        <p style="margin: 0 auto;font-size: 14px;font-family: Arial;font-weight: 400;color: #555;margin-top: 15px;line-height: 19px;">
			Thank you
            <br style="margin: 0 auto;">
				With best regards,
            <br style="margin: 0 auto;">
            <span style="margin: 0 auto;font-weight: 600;color: #2988ca;">
				ForexMart
            </span>
				Team
        </p>
    </div>
  </div>
             ';
        $body .= self::foot();
        $returnPath = "noreply@mail.forexmart.com";
        $from = "noreply@mail.forexmart.com";
        return  self::sender($r_data['email'], $subject, $body, $from, $returnPath);

    }

    public function lasPalmasVipTicket($to, $unsubscribe,$name)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/periodic-mailing_laspalmas-vipticket_img.png">';
        $body .= '</div><br>';
        $body .= '<div class="main-bg-body" style="line-height: 1.4;">  Dear '.$name.', <br><p style="font-weight: normal; color: rgb(29, 29, 29); text-align: justify; line-height: 1.4;">We would like to announce that ForexMart clients can now have a unique opportunity to get VIP passes and watch football games of Las Palmas absolutely for free!&nbsp;<br><br>For this season, ForexMart will be giving away free VIP tickets to lucky active clients who will win in ForexMart’s VIP Ticket Raffle. Winners will get the chance to watch famed football club Union Deportiva Las Palmas play against some of Europe’s best football teams.&nbsp;<br><br>Active clients are automatically eligible for this particular raffle, with each client automatically getting ONE (1) valid raffle entry. Winners of the said raffle draw will be sent a confirmation via their respective emails.&nbsp;<br><br>For more details regarding this raffle giveaway, kindly visit ForexMart’s official&nbsp;<a href="https://www.forexmart.com/tiket-raffle" style="color: rgb(41, 136, 202); text-decoration: underline;">raffle page</a>.&nbsp;<br><br>Get a chance to win this once in a lifetime giveaway, and we wish you the best of luck on ForexMart’s VIP raffle ticket draw!&nbsp;<br><br>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p>        <div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div> <span style="color: rgb(29, 29, 29);"><br>Kind regards,</span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span><br></div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'support@forexmart.com', $body, 'Get a chance to win free Las Palmas VIP Ticket. Just register with ForexMart!');
        echo $body;
    }

    public function lasPalmasVipTicket_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/periodic-mailing_laspalmas-vipticket_img-russian.png">';
        $body .= '</div><br>';
        $body .= 'Уважаемые трейдеры!<br><br>Рады сообщить вам, что ФорексМарт вновь проводит <a href="https://www.forexmart.com/ru/tiket-raffle" style="color: rgb(41, 136, 202); text-decoration: underline;">розыгрыш VIP-билетов</a> на матчи ФК “Лас-Пальмас” против лучших европейских футбольных клубов. Вы можете выиграть бесплатные билеты на игры клуба в Ла Лиге, приняв участие в нашем розыгрыше. Все, что вам нужно - это иметь свой реальный счет (или зарегистрировать новый) и подтвердить свое участие в розыгрыше. О вашей победе мы оповестим вас лично.&nbsp;<br><br>Не упустите реальный шанс увидеть игры ФК Лас-Пальмас в этом сезоне на стадионе Гран-Канария!&nbsp;<p style="color: rgb(29, 29, 29); text-align: justify;">Увидимся на матче!</p><div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.<br><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/ru/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;">С уважением,<span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда ФорексМарт</span></label><br>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'support@forexmart.com', $body, 'Получите шанс выиграть бесплатный VIP-билет на игру ФК Лас Пальмас. Просто зарегистрируйтесь на ФорексМарт!');
        echo $body;
    }


    public function showfxKievEventClient($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/kiev-banner_v2.png">';
        $body .= '</div><br>';
        $body .= '<div class="main-bg-body" style="line-height: 1.4;">  Dear Client, <br><br>Greetings!&nbsp;<br><br>ForexMart would like to invite you to attend the ShowFx World Expo this coming December 17-18, 2016 at the Hyatt Regency in Kiev, Ukraine. Clients who will attend this particular expo can get the chance to experience Ukraine while learning from workshops and seminars spearheaded by top trading experts in CIS, learn tips on how to manage personal finances from financial figureheads, and join raffle contests and win prizes from the expo organizers.&nbsp;<br><br>We at ForexMart will also be more than pleased to personally invite interested clients to the expo and inform clients regards latest upgrades and developments in ForexMart.&nbsp;<br><br>Admission to the ShowFx World Expo is absolutely free!&nbsp;<br><br>See you on the conference!</div>
<div class="main-bg-body" style="line-height: 1.4;"><br></div>
<div class="main-bg-body" style="line-height: 1.4;"><p>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.<br></p>
<p></p>
<div style="display:block; width:100%; text-align:center;"><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a></div>
<p></p>
<br><span style="color: rgb(29, 29, 29);"><br>Kind regards,</span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">ForexMart Team</span><br></div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Kiev');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }

    public function showfxKievEventClient_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/kiev-banner_v2.png">';
        $body .= '</div><br>';
        $body .= '<div class="main-bg-body" style="min-height: 312px; line-height: 1.4;">Уважаемые клиенты!<br><br>Рады пригласить вас на выставку ShowFX World Expo, которая пройдет с 17 по 18 декабря 2016 года, в Киеве, в отеле Hyatt Regency. Участники смогут обсудить самые актуальные вопросы, касающиеся биржевой и валютной торговли, посетить различные семинары и мастер-классы от ведущих специалистов финансового мира. Это отличная возможность приобрести новые навыки в торговле, интересные знакомства, обсудить с мировыми экспертами текущую финансовую обстановку.<br><br>   Представители ФорексМарт будут рады встретится со всеми участниками выставки лично, обсудить последние новости и события, которые произошли в жизни компании, рассказать о новых акциях и уникальных предложениях. На выставке будут также проведены различные конкурсы, в которых будут разыграны гаджеты и денежные призы. Все посетители смогут получить подарки и бонусы от компании.<br><br>Вход на выставку ShowFX World Expo - свободный. Ждем вас в Украине, в отеле в Hyatt Regency 17 и 18 декабря 2016 года.<br><br><span style="color: rgb(29, 29, 29); text-align: justify;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</span><br><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div><p style="color: rgb(29, 29, 29); text-align: justify;"><br></p><br><br>С уважением,<br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;"><span style="font-size: 14px;">команда ФорексМарт</span><br></span></div>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Конференция ShowFx World в Киеве');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }


    public function showfxKievEventPartner($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/kiev-banner_v2.png">';
        $body .= '</div><br>';
        $body .= 'Dear&nbsp;<span style="color: rgb(29, 29, 29);">Partner</span>,<br><br>Greetings!&nbsp;<br><br>ForexMart invites you to take part at the ShowFx World Expo which will be held at the Hyatt Regency in Kiev, Ukraine this coming December 17-18, 2016. Attendees to the said expo can experience the sights and sounds in Ukraine while gaining valuable advice regarding personal finance management from top financial experts, attend trading workshops and seminars headed by trading experts around the world, and win prizes from raffle contests and giveaways. Furthermore, ForexMart representatives will be more than happy to personally invite partners to the ShowFx expo and personally discuss the most recent updates in ForexMart.&nbsp;<br><br>Admission to the said expo is free.&nbsp;<br><br>See you on December 17-18!<p style="color: rgb(29, 29, 29); text-align: justify;"><span style="text-align: start;">Warmest regards,</span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block; text-align: start;">ForexMart Team</span></p>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Kiev');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }


    public function showfxKievEventPartner_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/kiev-banner_v2.png">';
        $body .= '</div><br>';
        $body .= 'Уважаемый партнер,<br><br>Рады пригласить вас на выставку ShowFX World Expo, которая пройдет с 17 по 18 декабря 2016 года, в Киеве, в отеле Hyatt Regency. Участники смогут обсудить самые актуальные вопросы, касаающиеся биржевой и валютной торговли, посетить различные семинары и мастер-классы от ведущих специалистов финансового мира. Это отличная возможность приобрести новые навыки в торговле, интересные знакомства, обсудить с мировыми экспертами текущую финансовую обстановку.<br>&nbsp;<br>Представители ФорексМарт будут рады встретится с партнерами нашей компании лично, обсудить последние новости и события, которые произошли в жизни компании, рассказать о новых акциях и уникальных предложениях. На выставке будут также проведены различные конкурсы, в которых будут разыграны гаджеты и денежные призы. Все посетители смогут получить подарки и бонусы от компании.<div><br></div>
<div>Вход на выставку ShowFX World Expo - свободный. Ждем вас в Украине, в отеле в Hyatt Regency 17 и 18 декабря 2016 года.<br><p></p>
 <br><label style="color: rgb(29, 29, 29); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; display: block;">С уважением,<br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда ФорексМарт<br></span></label></div>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Конференция ShowFx World в Киеве');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }


    public function showfxKievEventUploaded($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/kiev-banner_v2.png">';
        $body .= '</div><br>';
        $body .= '<p>Dear Trader,<br><br>Greetings!&nbsp;<br><br>ForexMart would like to invite you to attend the ShowFx World Expo this coming December 17-18, 2016 at the Hyatt Regency in Kiev, Ukraine. Clients who will attend this particular expo can get the chance to experience Ukraine while learning from workshops and seminars spearheaded by top trading experts in CIS, learn tips on how to manage personal finances from financial figureheads, and join raffle contests and win prizes from the expo organizers.&nbsp;<br><br>We at ForexMart will also be more than pleased to personally invite interested clients to the expo and inform clients regards latest upgrades and developments in ForexMart.&nbsp;<br><br>Admission to the ShowFx World Expo is absolutely free!&nbsp;<br><br>See you on the conference!</p><p>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.<br></p><p></p><div style="display:block; width:100%; text-align:center;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">Get Bonus</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a></div><p style="color: rgb(29, 29, 29); text-align: justify;"></p><p style="color: rgb(29, 29, 29); text-align: justify;"><span style="text-align: start;">Kind regards,</span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block; text-align: start;">ForexMart Team</span></p><p></p>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'ShowFx World Conference in Kiev');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }


    public function showfxKievEventUploaded_russian($to, $unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/kiev-banner_v2.png">';
        $body .= '</div><br>';
        $body .= 'Уважаемый трейдер!<br><br><div style="text-align: justify;"><span style="color: rgb(29, 29, 29);">Рады пригласить вас на выставку ShowFX World Expo, которая пройдет с 17 по 18 декабря 2016 года, в Киеве, в отеле Hyatt Regency. Участники смогут обсудить самые актуальные вопросы, касающиеся биржевой и валютной торговли, посетить различные семинары и мастер-классы от ведущих специалистов финансового мира. Это отличная возможность приобрести новые навыки в торговле, интересные знакомства, обсудить с мировыми экспертами текущую финансовую обстановку.</span></div><br style="color: rgb(29, 29, 29); text-align: justify;"><div style="text-align: justify;"><span style="color: rgb(29, 29, 29);">Представители ФорексМарт будут рады встретится со всеми участниками выставки лично, обсудить последние новости и события, которые произошли в жизни компании, рассказать о новых акциях и уникальных предложениях. На выставке будут также проведены различные конкурсы, в которых будут разыграны гаджеты и денежные призы. Все посетители смогут получить подарки и бонусы от компании.</span></div><br style="color: rgb(29, 29, 29); text-align: justify;"><span style="text-align: justify;"><div><span style="color: rgb(29, 29, 29);">Вход на выставку ShowFX World Expo - свободный. Ждем вас в Украине, в отеле в Hyatt Regency 17 и 18 декабря 2016 года.</span><span style="color: rgb(29, 29, 29);">&nbsp;</span></div></span><br style="color: rgb(29, 29, 29); text-align: justify;"><span style="color: rgb(29, 29, 29); text-align: justify;">ФорексМарт - инвестиционная компания, регулируемая на всей территории ЕС. Мы предлагаем клиентам услуги высочайшего качества, включая 30% торгуемый бонус на каждый депозит. Откройте счет и получите бонус уже сегодня. Чтобы узнать больше о нашем предложении, просто кликните на кнопки ниже.</span><br><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">ОТКРЫТЬ СЧЕТ</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div><p style="color: rgb(29, 29, 29); text-align: justify;"><br></p><p style="color: rgb(29, 29, 29); text-align: justify;"><span style="text-align: start;">С уважением,</span><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block; text-align: start;">команда ФорексМарт</span></p>';
        $footer = self::NewestFoooterForMassMailerRussian($unsubscribe);
        $body .= $footer;
        self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Конференция ShowFx World в Киеве');
        // $sender = self::MailerSchedulerSenderTest($to,'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.',$body);
        echo $body;
    }

public static function partnerWelcome($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_welcomeforexmart_img.png" alt="mailing_welcomeforexmart_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "The Forex sphere continually expand and it becomes harder to trace down the entire opportunities herein. But it’s much easier when you have a reliable partner in the face of trusted Broker.  <br><br>";

        $body .= "Our company is interested in partners and we’re always ready to offer you the best we have. You may contact us anytime and we are very much willing to cooperate with you. We hope that the account you registered with us will help you to build a successful business. <br><br>";

        $body .= "Any type of our affiliate programs is connected to the usage of special URL called Affiliate Links. The links are designed for you especially to track all attracted referrals and to keep under control the the expansion of your network. <br><br>";

        $body .= "We offer one of the highest levels of affiliate remunerations at this Market. You can see in your partner cabinet the <strong>full statistics</strong> of clicks, registrations and commissions by your affiliate link, <strong>absolutely</strong> free of charge and open <strong>24 hours a day</strong>. All commissions you earn will be automatically shown in your cabinet which will allow you to make analysis of your actions in time. <strong>All payment systems</strong> we have at ForexMart are available for the withdrawal of your commissions. At your disposal we provide a <strong>personal affiliate manager</strong> who will help you to find best ways to your success.";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Go To Cabinet</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Respectfully yours,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'We greet you in ForexMart', $body);
        return $sender;
    }

    public static function partnerGettingStarted($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_howtogetstarted_img.png" alt="howtogetstarted_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "If you already settled an affiliate account, the attraction of clients in our company are easier than ever. First, pay attention to the affiliate link for this will help you to monitor the total number of click. In your partner cabinet you can create up to 10 unique affiliate links beside the default one that we generated automatically. It will let you compare the indicators if you use few sources for clients attraction. <br><br>";

        $body .= "All you need now is to let your friends or any other internet users to follow your affiliate link and register an account with us. Once they start trading you will earn commission from each deal they close. <br><br>";

        $body .= "See, it's easy!<br><br>";

        $body .= '</p>';


        $body .= '<div style="display: table;margin: 20px auto;text-align:center;">';

        $body .= '<a href="https://my.forexmart.com/my-account?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #2988ca;">Go To Cabinet</a>';

        $body .= '<a href="https://my.forexmart.com/partnership/commission?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px;padding: 15px 10px;    background: #29a643;padding-left: 40px;padding-right: 40px;">MY LINK</a>';
        
        $body .= '</div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Respectfully yours,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'What to do next?', $body);
        return $sender;
    }

    public static function partnerLasPalmas($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_laspalmas.png" alt="mailing_laspalmas">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "ForexMart is the official partner of Union Deportiva Las Palmas, a Spanish football team located in Las Palmas de Gran Canaria on the Canary Islands. <br><br>";

        $body .= "UD Las Palmas traces back its roots in the Spanish autonomous community when five powerful teams in the island recognized the need for uniting. Hence, the inception of the football club in 1949, which aims to retain good players for them not to seek better career opportunities somewhere else. It has played 31 seasons in La Liga, the most popular and strongest league in Europe. <br><br>";

        $body .= "ForexMart Chief Executive Savvas Patsalides considers the collaboration as a significant milestone for the Cyprus-based company and another remarkable chapter in the football club's history. For ForexMart President Ildar Sharipov, the football club will become a solid player in La Liga, saying this is something the company was searching for a long time: the best is meeting the best. <br><br>";

        $body .= "We will give away VIP passes to see UD Las Palmas compete with the best European football teams at Gran Canaria Stadium. The raffle promo is open to all active ForexMart clients. <br><br>";

        $body .= "For more information, visit VIP Raffle Ticket for full mechanisms or UD Las Palmas to know more about the football club. <br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Go To Cabinet</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'The Best Meets the Best - ForexMart is official partner of UD Las Palmas', $body);
        return $sender;
    }

    public static function partnerBanner($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/banner-mailing.png" alt="banner-mailing">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "<strong>Banners</strong> are beneficial for those who deal with website management. Our banners are not website decoration only but an additional instrument for clients' attraction. Placing the banner with inserted unique affiliate code dashingly increases the number of clicks by your link. Using our banners you can attract more clients. <br><br>";

        $body .= "Once the visitor of your website clicks the banner with affiliate code he is automatically recorded in our system as referred by you and moves to your affiliate group. Full statistics of clicks and registrations are available for your analysis 24 hours a day. <br><br>";

        $body .= "Moreover <strong>ForexMart logos</strong> can be used in the same way! They are available at our website in different definitions.<br><br>";

        $body .= "We also suggest to use our <strong>informers</strong> for your website's content. Unlike banners they show actual and useful information which will bring new visitors and increase the popularity of your website. Other informers includes the list of major rates, currency converter, Forex calculator and economic calendar. <br><br>";

        $body .= "We are constantly working to expand the range of tools for partners. Please click the button below to see all available types of banners and informers.<br><br>";

        $body .= '</p>';


        $body .= '<div style="display: table;margin: 20px auto;text-align:center;">';

        $body .= '<a href="https://my.forexmart.com/my-account?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #2988ca;">Go To Cabinet</a>';

        $body .= '<a href="https://www.forexmart.com/banners" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px;padding: 15px 10px;    background: #29a643;">SEE ALL BANNERS</a>';

        $body .= '</div>';


        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Respectfully yours,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Improve your clicks statistics with ForexMart banners', $body);
        return $sender;
    }

    public static function partnerRJP($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/banner-rpj4.jpg" alt="banner-rpj4">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "ForexMart is pleased to announce the official partnership with RPJ Racing. <br><br>";

        $body .= "RPJ Racing is the company of racing and rock legend Rick Parfitt Jnr. It has a long history of success in racing and in winning. It’s latest undertaking is the British GT Championship, a world-renowned racing competition attended by the elites of the racing industry. Rick Parfitt Jnr himself is in the competition this year aboard the Bentley GT3. As a former 2013 GT4 Champion, expectations are high for him. He joins the Bentley Team Parker. <br><br>";

        $body .= "We believe that this partnership will stimulate mutual growth for both companies and expected to bear a fruitful collaboration between the two companies with the aim of mutual growth through joint campaigns and new promotions. <br><br>";

        $body .= "Follow us on social media to keep updated with our latest endeavors. <br><br>";

        $body .= "ForexMart and RPJ Racing looks forward to a great partnership to provide a better service to you, our clients. <br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Go To Cabinet</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'The skills, the speed, the ambitions. Forexmart is official partner of RPJ racing.', $body);
        return $sender;
    }


    public static function partnerBenenfitsForClient($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/benefit_mailing.png" alt="benefit_mailing">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Forexmart uses the most stable and most popular trading platform nowadays. MT4 has rich functionality wherein clients can easily work because it is simple and comfortable for the usage of each client. <br><br>";

        $body .= "Our company provides clients various educational materials, fresh analytical reviews, news block and wide range of bonus offers. <br><br>";

        $body .= "ForexMart's activity conforms with the MiFID rules and obey the demands of European Commissions and Regulators. Our company is a member of Investor Compensation Fund, therefore all clients' deposits are protected and insured. <br><br>";

        $body .= "We take care of client's concerns and security of their funds. Working with ForexMart is comfortable and safe. <br><br>";

        $body .= "Use these advantages to attract customers! <br><br>";

        $body .= '</p>';

        $body .= '<div style="display: table;margin: 20px auto;text-align:center;">';

        $body .= '<a href="https://my.forexmart.com/my-account?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #2988ca;">Go To Cabinet</a>';

        $body .= '<a href="https://my.forexmart.com/partnership/commission?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #29a643;">GET AFFILIATE LINK</a>';
        
        $body .= '</div>';


        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Respectfully yours,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Know more about your clients privileges', $body);
        return $sender;
    }
   public static function PartnerEuroLicense($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_europeanlicense_img.png" alt="europeanlicense_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>We exert much effort on adhering to regulations to protect clients and their private data, provide better services, and secure trades. Traders appreciate when a company places great importance on how to serve them better. <br><br>';

        $body .= "Aside from abiding to the Cyprus Investment Services and Activities Regulated Markets Law of 2007, ForexMart is subject to the supervision of the following.";
        $body .= '</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/cysec.png" alt="cysec" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Cyprus Securities and Exchange Commission</strong>
            <p style="margin-top:0px">a Cypriot financial regulatory agency securing the safety of investors and innovation in the security markets.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/mifid.png" alt="mifid" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Markets in Financial Instruments Derivative</strong>
            <p style="margin-top:0px">a directive responsible for regulating the investment services within the region.</p>
        </td>
    </tr>
</table>';
        $body .= '<p>The company also ascribes to the rules set forth by different regulatory bodies worldwide.</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/autorite.png" alt="autorite" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Autorité des marchés financiers</strong>
            <p style="margin-top:0px">the France regulator ensures the privacy of clients, as well as govern all products and services in the market.</p>
        </td>
    </tr>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/consob.png" alt="consob" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Commissione Nazionale per le Società e la Borsa</strong>
            <p style="margin-top:0px">it is anchored in three attributions every market should have: credibility, integrity, and transparency.</p>
        </td>
    </tr>

    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/esma.png" alt="esma" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">European Securities and Markets Authority</strong>
            <p style="margin-top:0px">a standalone entity upholding the financial system in the European Union by ensuring efficiency, integrity, and transparency of the markets.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/bafin.png" alt="bafin" style="margin: 10px auto;display: table; float:none;max-width: 500px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Federal Financial Supervisory Authority</strong>
            <p style="margin-top:0px">the Germany-based authority oversees financial institutions and undertakings in the country.</p>
        </td>
    </tr>

    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/fca.png" alt="fca" style="margin: 10px auto;display: table; float:none;max-width: 400px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Financial Conduct Authority</strong>
            <p style="margin-top:0px">an EU regulatory body cultivating development of clients, competition, and market integrity.</p>
        </td>
    </tr>
</table>';


        $body .= '<p>As we put clients above our own interests, ForexMart vows to offer the highest quality of services to our most valuable business partner – you. Trust us to work on this commitment incessantly. For concerns or inquiries, please feel free to send us an email at <a href="mailto:support@forexmart.com">support@forexmart.com</a></p>';

        $body .= '<p>Happy trading!</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;margin-bottom:15px;">';
        $body .= '<a href="https://www.forexmart.com/register"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Start Trading Today</a></div>';

        $body .= '<div style="background: #29a643;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Go To Cabinet</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'ForexMart: European License and Regulation', $body);
        return $sender;
    }

    public static function partnerCallBack($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/call-back"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_callbackservice_img2.png" alt="mailing_callbackservice_img2"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "We are here to answer your questions and solve your problems. Upholding our firm commitment to be your reliable trading partner, ForexMart wants to help you in every step of your trading journey. <br><br>";

        $body .= "If you are having any trouble calling our customer service, you may get in touch with us using our callback service. The feature is primarily designed to give solutions to all problems as fast as possible. With this service, you can request to get in touch with one of our managers at your most convenient time. Ask and we shall call you back.<br><br>";

        $body .= "All you need to do is to provide your contact details and indicate your preferred callback time by filling up this <a href='https://www.forexmart.com/call-back' style='color: #2988ca'>form</a>. Our support specialists will respond to all your concerns within 24 hours. For other questions, please do not hesitate to <a href='https://www.forexmart.com/contact-us' style='color: #2988ca'>contact us.</a> <br><br>";

        $body .= "The service is free of charge and can be used by all our clients. We wish you luck and a successful trading!<br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;margin-bottom:15px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'GO TO CABINET</a></div>';

        $body .= '<div style="background: #29a543;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;">';
        $body .= '<a href="https://www.forexmart.com/call-back"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'CONTACT US NOW!</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Have a call from our specialists any time', $body);
        return $sender;
    }

    public static function partnerHKM($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/hkm_Zvolen.gif" alt="hkm_Zvolen"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "ForexMart would like to introduce our our newest partner, HKM Zvolen.<br><br>";

        $body .= "HKM Zvolen, also known as Hokejový Klub mesta Zvolen, is one of the most successful hockey teams of Slovakia with a rich history that began in 1927. The Slovak legends have two national league championship under its belt and it has won the IIHF Continental Cup in 2005. The professional hockey club, famous for their exceptional performance and ardent fans, is our newest partner in the growing family of ForexMart. <br><br>";

        $body .= "Going into a partnership with such a legendary team opens opportunities for us to expand our reach and ideals beyond the financial industry. We have chosen HKM Zvolen as a partner because they are a strong sports team that reflects the passion and drive of ForexMart. Rest assured, clients will get to enjoy future collaborations, sponsorships, and promotions with hockey games this season. <br><br>";

        $body .= "Get to know more about HKM Zvolen by following us on social media so you can get the latest updates on us and our activities. We will continue to create new connections so that we can keep on delivering the service that you deserve. Expect great things ahead.<br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Go To Cabinet</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">All the best,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Like hockey with ForexMart', $body);
        return $sender;
    }

    public static function partnerWelcomeRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_welcomeforexmart_img-russian.png" alt="periodic-mailing_welcomeforexmart_img-russian">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Мир Форекс постоянно расширяется, и со временем разобраться во всех возможностях становится все сложнее. Гораздо проще, когда рядом есть надежная опора в виде проверенного брокера. Наша компания заинтересована в партнерах, поэтому мы с радостью готовы предложить вам лучшее, что у нас есть для сотрудничества на данный момент. Мы надеемся, что зарегистрированный счет в нашей компании поможет вам построить успешный бизнес. Любая наша партнерская программа связана с использованием специальной партнерской ссылки. Ссылки сделаны специально для того, чтобы вы могли отслеживать всех привлекаемых рефералов и держать под контролем развитие сети.<br><br>";

        $body .= "Мы предлагаем один из самых высоких уровней партнерских комиссий на рынке. В вашем кабинете вы совершенно бесплатно получаете полную статистику кликов, переходов и регистраций по вашей партнерской ссылке 24 часа в сутки. Все начисляемые комиссии будут автоматически отображаться в вашем кабинете, что позволит вам своевременно проводить анализ успешности действий по привлечению клиентов. <br><br>";

        $body .= "Для вывода партнерского вознаграждения в нашей компании можно использовать все доступные платежные системы. К вашим услугам также предоставляется персональный менеджер, который будет помогать вам находить правильные решения на пути к успеху.<br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Перейти в кабинет</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Мы приветствуем вас в ФорексМарт', $body);
        return $sender;
    }

    public static function partnerGettingStartedRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_howtogetstarted_img-russian.png" alt="periodic-mailing_howtogetstarted_img-russian">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Поскольку вы уже открыли партнерский счет, позвольте объяснить, что привлечение клиентов в нашей компании происходит как никогда просто. Во-первых, обратите внимание на партнерскую ссылку. Она поможет вам направлять в свою партнерскую группу всех, кто по ней переходит. В нашем партнерском кабинете вы можете создать до 10 собственных ссылок помимо той, что была предоставлена вам автоматически. Это поможет вам сравнивать показатели при использовании разных источников привлечения клиентов. <br><br>";

        $body .= "Во-вторых, вам нужно всего лишь позволить вашим знакомым или любым другим пользователям в интернете перейти по вашей ссылке, чтобы зарегистрировать счет. Когда они начнут торговлю, вы будете получать комиссию с каждой сделки. <br><br>";

        $body .= 'В вашем распоряжении подробная статистика переходов и регистраций и по всем ссылкам.<br><br>';

        $body .= "Видите, это очень просто! <br><br>";

        $body .= '</p>';


        $body .= '<div style="display: table;margin: 20px auto;text-align:center;">';

        $body .= '<a href="https://my.forexmart.com/my-account?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #2988ca;">Перейти в кабинет</a>';

        $body .= '<a href="https://my.forexmart.com/partnership/commission?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #29a643;padding-left: 40px;padding-right: 40px;">Моя Ссылка</a>';

        $body .= '</div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">C уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Что делать дальше?', $body);
        return $sender;
    }

    public static function partnerLasPalmasRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_laspalmas_img_index-russian.png" alt="mailing_laspalmas_img_index-russian">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый(ая) ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "ФорексМарт - официальный партнер ФК Лас-Пальмас, испанской футбольной команды города Лас-Пальмас-де-Гран-Канария, гордости Канарских островов. <br><br>";

        $body .= "ФК Лас-Пальмас был основан в 1949 году путём объединения пяти местных команд, чтобы удержать лучших игроков острова от перехода в другие клубы. Команда провела 31 сезон в Ла Лиге - самом популярном и сильном чемпионате Европы. <br><br>";

        $body .= "Исполнительный Директор ФорексМарт Саввас Патсалидис видит в этом сотрудничестве важную веху для кипрской финансовой компании и замечательную главу в истории футбольного клуба. Для Ильдара Шарипова, президента ФорексМарт, Лас Пальмас станет надежным игроком в высшем дивизионе испанского футбола. Это то, что компания искала долгое время: лучший находит лучшего. <br><br>";

        $body .= "Мы подарим VIP билеты на игры ФК Лас-Пальмас с лучшими европейскими командами на стадионе Гран-Канария. Розыгрыш проводится для всех активных клиентов ФорексМарт. <br><br>";

        $body .= "Получите дополнительную информацию на странице розыгрыша или зайдите на официальную страницу ФК Лас-Пальмас, чтобы поближе познакомится с нашим партнёром.<br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Перейти в кабинет</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Лучшие встречают лучших - ФорексМарт официальный партнер ФК Лас-Пальмас', $body);
        return $sender;
    }

    public static function partnerBannerRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/banner-mailing.png" alt="banner-mailing">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Баннеры очень полезны всем, кто занимается работой с сайтами. Баннеры нашей компании могут являться не только украшением сайта, но и дополнительным инструментом для привлечения клиентов. <br><br>";

        $body .= "Размещение баннера с встроенным в него вашим уникальным партнерским кодом повышает количество переходов по вашей ссылке. Используя баннеры, можно привлечь большее количество клиентов. <br><br>";

        $body .= "Как только посетитель вашего сайта нажимает на баннер с партнерским кодом, он автоматически фиксируется в нашей системе как привлеченный вами и попадает в вашу партнерскую группу. Всю статистику переходов и регистраций вы всегда можете наблюдать в вашем партнерском кабинете. <br><br>";

        $body .= "Более того, подобным образом вы можете использовать и логотипы ФорексМарт, доступные на нашем сайте в разных разрешениях. Мы также предлагаем использовать информеры для установки на сайт. В отличие от баннеров они могут предоставлять полезную актуальную информацию, что привлечет посетителей и поспособствует повышению популярности вашего сайта. В вашем распоряжении информер с курсами основных валют, конвертер валют, калькулятор Форекс и календарь экономических событий. <br><br>";

        $body .= "Чтобы посмотреть все доступные виды баннеров и информеров, нажмите на кнопку ниже.<br><br>";

        $body .= '</p>';

        $body .= '<div style="display: table;margin: 20px auto;text-align:center;">';

        $body .= '<a href="https://my.forexmart.com/my-account?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #2988ca;">Перейти в кабинет</a>';

        $body .= '<a href="https://www.forexmart.com/banners" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px;padding: 15px 10px;    background: #29a643;">Посмотреть Баннеры</a>';

        $body .= '</div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">C уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Улучшите статистику по кликам с баннерами от ФорексМарт', $body);
        return $sender;
    }

    public static function partnerRJPRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_rpj-partnership_img.png" alt="mailing_rpj-partnership_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Компания ФорексМарт рада объявить об официальном партнерстве с PPJ Рейсинг.<br><br>";

        $body .= "RPJ Рейсинг это команда гонщика и рок-музыканта Рика Парфитта Младшего. <br><br>";

        $body .= "Можно долго рассказывать о выдающихся успехах и победах этой команды. Они принимают участие во всемирноизвестном британском чемпионате (British GT Championship), где соревнуются с элитой британского гоночного спорта. Сам Рик Парфитт Младший также примет участие в этих соревнованиях за рулем Bentley GT3. Он уже становился победителем чемпионата GT4 в 2013 году, поэтому команда рассчитывает на его успех и в этот раз. Он присоединится к команде Bentley Team Parker. <br><br>";

        $body .= "Мы уверены, что это партнерство будет стимулировать взаимный рост для обеих компаний, а также поспособствует плодотворному сотрудничеству в виде проведения совместных кампаний и участия в акциях. <br><br>";

        $body .= "Подписывайтесь на нас в социальных сетях, чтобы быть в курсе последних новостей и вместе радоваться нашим успехам. <br><br>";

        $body .= "ФорексМарт и RPJ Рейсинг делают все для улучшения качества сервисов для Вас - наших клиентов.";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Перейти в кабинет</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С наилучшими пожеланиями,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Навыки, скорость, амбиции. ФорексМарт - официальный партнер RPJ рейсинг', $body);
        return $sender;
    }


    public static function partnerBenenfitsForClientRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/benefit_mailing.png" alt="benefit_mailing">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "ФорексМарт использует самую стабильную и самую популярную на сегодняшний торговую платформу. МТ4 имеет богатый функционал, при этом работать с терминалом удобно и просто каждому клиенту. <br><br>";

        $body .= "Наша компания предоставляет клиентам обучающие материалы, свежие аналитические обзоры, новостной блок и широкую линейку бонусных предложений. <br><br>";

        $body .= "Деятельность ФорексМарт отвечает всем нормативам Директивы Евросоюза \"О рынках финансовых инструментов\" и подчиняется требованиям Европейских Комиссий и Регуляторов. Наша компания является участником Компенсационного Фонда Инвесторов, поэтому все средства клиентов застрахованы и находятся под надежной защитой. <br><br>";

        $body .= "Мы заботимся об интересах клиентов и безопасности их средств. Работать с ФорексМарт удобно и безопасно.  <br><br>";

        $body .= "Используйте эти преимущества для привлечения клиентов!<br><br>";

        $body .= '</p>';

        $body .= '<div style="display: table;margin: 20px auto; text-align:center;">';

        $body .= '<a href="https://my.forexmart.com/my-account?login=partner" style="color: #fff!important;font-size: 16px;width: 200px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #2988ca;">Перейти в кабинет</a>';

        $body .= '<a href="https://my.forexmart.com/partnership/commission?login=partner" style="color: #fff!important;font-size: 16px;text-align: center;text-decoration: none!important;text-transform: uppercase;display: inline-block;margin: 0 5px 10px;padding: 15px 10px;    background: #29a643;">Получить Партнерскую Ссылку</a>';

        $body .= '</div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С Уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт.</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Узнайте больше о преимуществах для ваших клиентов', $body);
        return $sender;
    }
   public static function PartnerEuroLicenseRussian($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_europeanlicense_img-russian.png" alt="mailing_europeanlicense_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый(ая) ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d"><br>Мы много трудимся над соблюдением прав наших клиентов, защищаем их личные данные, проводим только безопасные сделки. Трейдеры знают, как важно постоянно повышать качеств услуг.<br><br>';

        $body .= "Помимо закона об инвестиционных услугах и регулировании деятельности рынков Кипра от 2007 года, Форекс Март подлежит надзору:";
        $body .= '</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/cysec.png" alt="cysec" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Кипрской комиссии по ценным бумагам и биржам (CySEC)</strong>
            <p style="margin-top:0px">Кипрский финансовый регулирующий орган обеспечивает безопасность инвесторов, осуществляет преобразования и защищает рынки.</p>
        </td>
    </tr>
        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/mifid.png" alt="mifid" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Директива Евросоюза "О рынках финансовых инструментов" (MiFID)</strong>
            <p style="margin-top:0px">Директива регулирует осуществление инвестиционных услуг в регионе.</p>
        </td>
    </tr>
</table>';
        $body .= '<p>Компания также выполняет правила, установленные различными регулирующими органами по всему миру.</p>';


        $body .= '<table>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/autorite.png" alt="autorite" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Autorité des marchés financiers (AFM)</strong>
            <p style="margin-top:0px">Французский регулятор обеспечивает конфиденциальность клиентов, проверяет качество товаров и услуг на финансовых рынках.</p>
        </td>
    </tr>
    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/consob.png" alt="consob" style="margin: 10px auto;display: table; float:none;max-width: 960px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Commissione Nazionale per le Società e la Borsa (CONSOB)</strong>
            <p style="margin-top:0px">Итальянская комиссия по ценным бумагам и биржам поддерживает три необходимых качества рынка: доверие, честность и прозрачность.</p>
        </td>
    </tr>

        <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/bafin.png" alt="bafin" style="margin: 10px auto;display: table; float:none;max-width: 500px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">Federal Financial Supervisory Authority (BaFin)</strong>
            <p style="margin-top:0px">Регулирующий орган Германии осуществляет надзор над финансовыми учреждениями и предприятиями в стране.</p>
        </td>
    </tr>

    <tr>
        <td style="width: 25%;vertical-align:top;">
            <img src="https://www.forexmart.com/assets/images/mailer/fca.png" alt="fca" style="margin: 10px auto;display: table; float:none;max-width: 400px;">
        </td>
        <td style="width: 75%;">
            <strong style="color:#0070be">The Financial Conduct Authority (FCA)</strong>
            <p style="margin-top:0px">Регулирующий орган Великобритании обеспечивает целостность рынка, защиту клиентов и поддержание конкуренции.</p>
        </td>
    </tr>
</table>';


        $body .= '<p>Поскольку мы ставим интересы клиентов выше своих собственных, мы делаем всё возможное для оказания услуг на самом высоком уровне. ФорексМарт всегда исполняет взятые на себя обязательства. <br><br>';

        $body .= 'По вопросам и предложениям, пожалуйста, пишите на электронный адрес:  <a href="mailto:support@forexmart.com">support@forexmart.com</a></p>';

        $body .= '<p>Удачных торгов!</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;margin-bottom:15px;">';
        $body .= '<a href="https://www.forexmart.com/register"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'НАЧНИТЕ ТОРГОВАТЬ СЕГОДНЯ</a></div>';

        $body .= '<div style="background: #29a643;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Перейти в кабинет</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'ФорексМарт: Европейская Лицензия и Регулирование', $body);
        return $sender;
    }

    public static function partnerCallBackRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/ru/call-back"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/mailing_callbackservice_img-russian2.png" alt="mailing_callbackservice_img"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Мы здесь, чтобы ответить на ваши вопросы и решить ваши проблемы, связанные с торговлей. Отстаивая нашу твердую приверженность быть вашим надежным торговым партнером, ФорексМарт хочет помочь вам на каждом шаге вашего торгового пути. <br><br>";

        $body .= "Если вам неудобно звонить в отдел поддержки клиентов, вы можете связаться с нами, используя услугу обратного звонка. Эта функция, в первую очередь, предназначена для быстрого решения всех возникших проблем. Благодаря этой услуге, вы можете заказать обратный звонок от одного из наших менеджеров в самое удобное для Вас время. Оставьте заявку, и мы вам перезвоним. <br><br>";

        $body .= "Все, что вам нужно сделать, это предоставить свои контактные данные и указать желаемое время обратного звонка, заполнив эту форму. Наши специалисты службы поддержки ответят на все ваши вопросы в течение 24 часов.<br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;margin-bottom:15px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Перейти в кабинет</a></div>';

        $body .= '<div style="background: #29a543;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;width:230px;text-align:center;">';
        $body .= '<a href="https://www.forexmart.com/ru/call-back"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Свяжитесь с нами сейчас!</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Закажите звонок от наших специалистов в любое время', $body);
        return $sender;
    }

    public static function partnerHKMRussian($to, $name, $unsubscribe_key){
        $body = self::NewestHeader();


        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<a href="https://www.forexmart.com/forex-contests/money-fall/registration"><img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/partner_periodic_mail/periodic-mailing_hkm-partnership-russian.gif" alt="hkm_Zvolen"></a>';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемый ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "Рады вам сообщить о нашем новом партнерстве со словацким хоккейным клубом “Зволен”. <br><br>";

        $body .= "“Зволен”- один из известнейших хоккейных клубов Европы, с конца девяностых является постоянным участником словацкой экстралиги. В состав команды всегда входили легендарные хоккеисты, а также молодые и перспективные игроки, благодаря чему клуб смог стать чемпионом Словакии по хоккею в 2000 и 2016 году. <br><br>";

        $body .= "ФорексМарт надеется, что новое сотрудничество будет взаимовыгодным и принесет нам интересный опыт, а хоккейный клуб сможет и дальше завоевывать титулы.<br><br>";

        $body .= "Мы обеспечиваем профессиональную работу с партнерами на всех уровнях.<br><br>";

        $body .= '</p>';

        $body .= '<div style="background: #2988ca;display: table; margin: 0 auto;cursor: pointer;padding: 15px 20px;">';
        $body .= '<a href="https://my.forexmart.com/my-account?login=partner"style="margin:15px;color:#fff;font-size:16px;text-decoration:     none;text-transform: uppercase;display: block;">';
        $body .= 'Перейти в кабинет</a></div>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Всего наилучшего,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Любите хоккей с ФорексМарт', $body);
        return $sender;
    }


    public static function traderOfferHeader()
    {
        $body = '<html> <head><style></style><body style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px;line-height: 1.42857143; color: #333;background-color: #fff;">';
        $body .= '<div style="position: relative; margin: 0px auto;max-width: 800px;height: auto;">';
        $body .= '<div style="margin: 0 auto; width:100%;padding: 0!important">';
        $body .= '<div style="background:url(https://www.forexmart.com/assets/images/header-bg.png); width:100%!important; margin-top:2px; ;border-top: 3px solid #EAEAEA;">';
        $body .= '<img alt="logo-mailing_v2" style="width:100%!important;" alt="header" src="https://www.forexmart.com/assets/images/logo-mailing_v2.png">';
        $body .= '</div>';
        return $body;
    }
    public function tradeOfferMail($to, $unsubscribe,$res){
        $body = self::traderOfferHeader();
        if(IPLoc::Office()){
            $body .= '
            <div class="wrapper-container" style="max-width:800px; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;height: auto;">
            <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;padding: 0!important;width: 100%;float: left;position: relative;min-height: 1px;">
            <div class="wrapper-header-two" style="background: url(images/header-bg.png);font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;">
            </div>
            <div class="wrapper-body trade-offer-bg" style="background-size: cover; background: url(https://www.forexmart.com/assets/images/trade-offer-bg.png) no-repeat top / auto auto;  padding: 20px 0;">
            <div class="initial-trade-span" style="    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;">
            <span style="    color: #2988ca;    font-size: 18px;    text-align: center;    display: block;    box-sizing: border-box;    line-height: 1.42857143;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;">
            ' . lang('fxtom_1') . '
            </span>
            </div>
            <div class="first-trade-span" style="    font-size: 40px;    font-weight: bold;    text-align: center;    margin: 0 auto;    display: table;">
            ' . $res['MostIncreasingPopularSymbol'] . '
            <a style="display: inline-block;    width: 32px;    height: 32px;    text-decoration: underline;    color: #2988ca;    font-family: " helvetica="" font-size:="" line-height:="" box-sizing:=""><img alt="arrow" src="https://www.forexmart.com/assets/images/arrow.png"></a>
            ' . $res['MostIncreasingPopularSymbolPercentage'] . '%
            </div>
            <div class="second-trade-span" style="text-align: center;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;box-sizing: border-box;">
            <span style="box-sizing: border-box;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;text-align: center;box-sizing: border-box;">
            ' . $res['FromDate'] . '
            </span>
            </div>
            <div class="hidden-trade-span" style="text-align: center;margin: 0 auto;display: none;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;box-sizing: border-box;-webkit-tap-highlight-color: rgba(0,0,0,0);">
            <span style="margin-top: 30px;color: #2988caleft: 0;font-size: 18px;z-index: 1000;right: 0;display: block;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height: 1.42857143;box-sizing: border-box;">
            <q style="    margin-top: 30px;    color: #2988ca;     left: 0;    font-size: 18px;    z-index: 1000;    right: 0;    display: block;    text-align: center;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    line-height: 1.42857143;    box-sizing: border-box;">
            ' . lang('fxtom_2') . ' 
            </q>
            </span>
            </div>
            <div class="third-trade-span" style="    display: table;    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;    box-sizing: border-box;">
            <span style="    color: #2988ca;     left: 0;    right: 0;    font-size: 18px;    display: block;">
            <q style="    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 18px;    line-height: 1.42857143;    color: #2988ca;">' . lang('fxtom_3') . '</q>
            </span>
            </div>
            <div class="fourth-trade-span" style="margin-top: 396px;text-align: center;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;/* margin: 0 auto; */color: #333;">
            <div style="display:table; margin:0 auto;">

            <div class="buy-trade-button-parent" style="margin: 2px;display: table;     display: inline-block; border: 1px solid #29a643;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="buy-trade-button" style="      display: inline-block;  margin: 2px;    color: #fff;    padding: 10px 34px;    background: #29a643;    border: 0;    transition: all 0.2s linear;    font-family: inherit;    font-size: inherit;    line-height: inherit;     text-decoration: none;">
            <span style="    display: block;    font-size: 25px;">
            ' . lang('fxtom_buy') . '
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            ' . lang('fxtom_4') . $res['MostIncreasingPopularSymbol'] . lang('fxtom_5') . '
            </label>
            </a>
            </div>
            <div class="sell-trade-button-parent" style="border: 1px solid #cf2323;margin: 2px;display: table;     display: inline-block; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="sell-trade-button" style="     display: inline-block;   margin: 2px;    color: #fff;    padding: 10px 37px;    background: #cf2323;    border: 0;    transition: all 0.2s linear;      text-decoration: none;">
            <span style="    font-size: 25px;    display: block;    color: #fff;">
            ' . lang('fxtom_sell') . '
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            ' . lang('fxtom_6') . $res['MostIncreasingPopularSymbol'] . lang('fxtom_7') . '
            </label>

                  </a>              </div>
                </div></div></div></div></div>
            ';
        } else {
            $body .= '
            <div class="wrapper-container" style="max-width:800px; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;height: auto;">
            <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;padding: 0!important;width: 100%;float: left;position: relative;min-height: 1px;">
            <div class="wrapper-header-two" style="background: url(images/header-bg.png);font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;">
            </div>
            <div class="wrapper-body trade-offer-bg" style="background-size: cover; background: url(https://www.forexmart.com/assets/images/trade-offer-bg.png) no-repeat top / auto auto;  padding: 20px 0;">
            <div class="initial-trade-span" style="    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;">
            <span style="    color: #2988ca;    font-size: 18px;    text-align: center;    display: block;    box-sizing: border-box;    line-height: 1.42857143;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;">
            Most Popular Symbol this Week
            </span>
            </div>
            <div class="first-trade-span" style="    font-size: 40px;    font-weight: bold;    text-align: center;    margin: 0 auto;    display: table;">
            ' . $res['MostIncreasingPopularSymbol'] . '
            <a style="display: inline-block;    width: 32px;    height: 32px;    text-decoration: underline;    color: #2988ca;    font-family: " helvetica="" font-size:="" line-height:="" box-sizing:=""><img alt="arrow" src="https://www.forexmart.com/assets/images/arrow.png"></a>
            ' . $res['MostIncreasingPopularSymbolPercentage'] . '%
            </div>
            <div class="second-trade-span" style="text-align: center;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;box-sizing: border-box;">
            <span style="box-sizing: border-box;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;text-align: center;box-sizing: border-box;">
            ' . $res['FromDate'] . '
            </span>
            </div>
            <div class="hidden-trade-span" style="text-align: center;margin: 0 auto;display: none;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;box-sizing: border-box;-webkit-tap-highlight-color: rgba(0,0,0,0);">
            <span style="margin-top: 30px;color: #2988caleft: 0;font-size: 18px;z-index: 1000;right: 0;display: block;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height: 1.42857143;box-sizing: border-box;">
            <q style="    margin-top: 30px;    color: #2988ca;     left: 0;    font-size: 18px;    z-index: 1000;    right: 0;    display: block;    text-align: center;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    line-height: 1.42857143;    box-sizing: border-box;">
            Exceptional movements are great <br>trading opportunities! 
            </q>
            </span>
            </div>
            <div class="third-trade-span" style="    display: table;    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;    box-sizing: border-box;">
            <span style="    color: #2988ca;     left: 0;    right: 0;    font-size: 18px;    display: block;">
            <q style="    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 18px;    line-height: 1.42857143;    color: #2988ca;">Catch the market tone and stay in trend</q>
            </span>
            </div>
            <div class="fourth-trade-span" style="margin-top: 396px;text-align: center;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;/* margin: 0 auto; */color: #333;">
            <div style="display:table; margin:0 auto;">

            <div class="buy-trade-button-parent" style="margin: 2px;display: table;     display: inline-block; border: 1px solid #29a643;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="buy-trade-button" style="      display: inline-block;  margin: 2px;    color: #fff;    padding: 10px 34px;    background: #29a643;    border: 0;    transition: all 0.2s linear;    font-family: inherit;    font-size: inherit;    line-height: inherit;     text-decoration: none;">
            <span style="    display: block;    font-size: 25px;">
            Buy
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            If you believe ' . $res['MostIncreasingPopularSymbol'] . ' price will climb up.
            </label>
            </a>
            </div>
            <div class="sell-trade-button-parent" style="border: 1px solid #cf2323;margin: 2px;display: table;     display: inline-block; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="sell-trade-button" style="     display: inline-block;   margin: 2px;    color: #fff;    padding: 10px 37px;    background: #cf2323;    border: 0;    transition: all 0.2s linear;      text-decoration: none;">
            <span style="    font-size: 25px;    display: block;    color: #fff;">
            Sell
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            If you believe ' . $res['MostIncreasingPopularSymbol'] . ' price will decline.
            </label>

                  </a>              </div>
                </div></div></div></div></div>
            ';
        }
            // change the footer for unsubscribe key
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image_to?email=".$to."&key=". $unsubscribe ."&email_id=". $res['id'] ."&ip_address=".$_SERVER['REMOTE_ADDR']."'>";
        $footer = self::NewestFoooterForTradeOffer($unsubscribe);
        $body .= $footer;
        echo $body;
        $sender = self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'This week most popular deal');
        // echo $body;
    }

    public static function validateEmail($from, $email)
    {
        require_once dirname(__FILE__) . '/PHPMailer/smtp-validate-email.php';

        $validator = new SMTP_Validate_Email($email, $from);
        $smtp_results = $validator->validate();
        // var_dump($smtp_results);exit;
        return $smtp_results;
    }

    public static function NewestMailerSchedulerSenderTest($to, $subject, $body)
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

        $body .= '<div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;text-align:center;">        <span style="color: inherit;"><a href="https://www.forexmart.com/register" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #067acc; text-decoration:none; margin:5px 10px; text-align:center;background:#2988ca; text-transform:uppercase;">Register Account</a><a href="https://my.forexmart.com/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">FUND MY ACCOUNT</a><a href="https://webtrader.forexmart.com/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">Web Terminal</a>        </span>        </div>';

        $body .= '</p>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Sincerely,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $footer = self::NewestFoooterForMassMailer($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::NewestMailerSchedulerSenderTest($to, 'ForexMart Mobile Platform for your comfortable trading', $body);

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
        $sender = self::MailerSchedulerSenderTest($to, 'Мобильная платформа ФорексМарт для удобства вашей торговли', $body);
        return $sender;
    }
    
    public static function web_terminal($to, $name, $unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/web-terminal2.png" alt="web-terminal2">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">Greetings! <br><br>';
        $body .= "We would like to announce that we will be launching a Web Terminal! With the ForexMart web terminal, you can now track your charts, manage your trades, and place multiple trades directly on the ForexMart website without having to install any software. With our Web Terminal, you can also customize your trading instruments according to your wish. <br><br>";

        $body .= "Get to enjoy hassle-free trading transactions by signing up to our web terminal now. You can view the features of the web terminal by clicking <a href='https://webtrader.forexmart.com/login'>here</a>. <br><br>";

        $body .= "We wish you the best of luck on your trading! <br><br>";


        $body .= '<p>ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering.</p>';

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">GET BONUS</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Kind regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Comfortable trading with ForexMart Web Terminal', $body);
        return $sender;
    }

    public static function web_terminalRussian($to,$name,$unsubscribe)
    {
        $body = self::NewestHeader();
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/web-terminal2-russian.png">';
        $body .= '</div><br>';
        $body .= '<span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Уважаемый ' . $name . ',</span><br>';

        $body .= '<p class="reset-p" style="margin-bottom: 0px; color: rgb(29, 29, 29); text-align: justify;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">';

        $body .= 'Рады вам сообщить, что теперь в ФорексМарт вы можете совершать торговые операции при помощи веб-терминала. Используйте любой браузер и практически любое устройство. Попробуйте, это безопасно, легко и удобно!&nbsp;</span><br>';

        $body .= '<style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;"><br><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">В веб-терминале можно открывать любые типы ордеров, выбирать любой из девяти доступных таймфреймов, совершать торговые операции с популярными валютными торговыми инструментами и металлами, отслеживать котировки валют в реальном времени.&nbsp;</span><br><br>';

        $body .= '<span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">Если у вас нет реального торгового счета, это отличный повод его создать. Выбирайте удобный способ торговли на рынке Форекс и оставайтесь на рынке 24 часа в сутки.<br><br>';

        $body .= '</span>';

        $body .= '<span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">В случае возникновения вопросов, обращайтесь в нашу службу поддержки, а также по электронному адресу <a href="mailto:support@forexmart.com">support@forexmart.com</a>. Наши специалисты всегда рады помочь вам в любой возникшей ситуации и ответить на все интересующие вопросы.<br><br>';
        $body .= '</span>';

        $body .= '</p><div class="las-palmas-buttons" style="margin: 0px auto; display: table; line-height: 1.4;"><span style="color: inherit;"><div style="display:block; width:100%; text-align:center;"><span style="color: rgb(29, 29, 29); text-align: justify;"><br></span><a href="https://my.forexmart.com/ru/deposit" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #1d9335; text-decoration:none; margin:5px 10px; text-align:center;background:#29a643; text-transform:uppercase;">ПОЛУЧИТЬ БОНУС</a><a href="https://webtrader.forexmart.com/ru/login" style="display:inline-block; padding:15px 20px; min-width:200px; color:#fff; border-bottom:5px solid #c44444; text-decoration:none; margin:5px 10px; text-align:center;background:#e64e54; text-transform:uppercase;">ВЕБ ТЕРМИНАЛ</a></div></span></div> <label style="display: block; font-weight: normal; color: rgb(29, 29, 29); padding-top: 20px;"><span style="font-family: &quot;Helvetica Neue&quot;, Arial, sans-serif;">C наилучшими пожеланиями,</span><br><span class="name-team" style="font-size: 15px; font-weight: bold; color: rgb(0, 58, 98); display: block;">команда Форексмарт<br></span></label><br>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe);
        $body .= $footer;
         $sender = self::MailerSchedulerSenderPeriodic($to, 'Удобная торговля с веб-терминалом ФорексМарт', $body);
         return $sender;
    }

    public static function mobile_platform_periodic($to,$name,$unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mobile-platform3.png" alt="mobile-platform3">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear ' . $name . ',</label>';
        $body .= '<p style="#1d1d1d">';

        $body .= "As part of ForexMart goals to look for ways of improvement regarding our services, we provide easier methods for you to be updated with latest trends and technologies. We are glad to inform you that ForexMart Application is now available to download for both iOS and Android platforms. <br><br>";

        $body .= "We are now launching an application for mobile platform. It works just like any other application you can get from App store for iOS or Play store for Android. This way you can now trade anytime and anywhere with just a click from your fingertips through your smart phones. <br><br>";

        $body .= "ForexMart platform is still accessible through your PC. For further inquiries regarding this application, you may contact our customer support here <a href='mailto:support@forexmart.com'>support@forexmart.com</a> <br><br>";



        $body .= '<div style="display:block; width:100%; text-align:center;"><a href="https://appsto.re/ru/HB57gb.i"><img src="https://www.forexmart.com/assets/images/app-store.png" style="height:50px; width:177px; display:imline-block; margin:0 10px; vertical-align:middle;" alt="app-store"></a> 

            <a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader"><img src="https://www.forexmart.com/assets/images/google-play.png" style="height:50px; width:177px; display:inline-block; margin:5px 10px;vertical-align:middle;" alt="google-play"></a></div>';


        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">Fund my account</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">Web Terminal</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Sincerely,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'ForexMart Mobile Platform for your comfortable trading', $body);

        return $sender;
    }

    public static function mobile_platform_periodicRussian($to,$unsubscribe_key)
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

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<a  href="https://my.forexmart.com/deposit" style="color:white;text-decoration:none">ПОЛУЧИТЬ БОНУС</a></div>';

        $body .= '<div style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #e64e54;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<a href="https://webtrader.forexmart.com/login" style="color:white;text-decoration:none">ВЕБ ТЕРМИНАЛ</a></div>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С Уважением,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ФорексМарт</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Мобильная платформа ФорексМарт для удобства вашей торговли', $body);
        return $sender;
    }
    

    public static function awards($to,$name,$unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_awards_img.png" alt="mailing_awards_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Dear Clients and Partners,</label>';
        $body .= '<p style="text-align:justify">';

        $body .= "We are grateful to our clients and we work everyday to become even better for you. As a result of our continuous efforts to provide the outstanding service you deserve, we have been recognized by esteemed financial authorities: <br><br>";

        $body .= "<span style='font-weight: bold;color: #2988ca;'>Best Broker in Europe 2015 by ShowFx World</span><br>";
        $body .= "<span style='font-weight: bold;color: #2988ca;'>Most Prospective Broker in Asia 2015 by ShowFx World</span><br>";
        $body .= "<span style='font-weight: bold;color: #2988ca;'>Best New Broker Europe 2016 by International Finance Magazine</span><br>";
        $body .= "<span style='font-weight: bold;color: #2988ca;'>Best Forex Newcomer 2016 by Global Business Outlook</span><br><br>";

        $body .= "We are humbled by this recognition and we have our clients to thank for their unwavering trust. These awards are the symbols of loyalty from our clients. We will continue to provide excellent service that brings clients the complacency and security they need in the volatile forex exchange market. We will remain as your anchor while you navigate your way to financial success. ForexMart looks forward to more celebrations with our clients as we make our way to the top. <br><br>";

        $body .= "All of these awards are dedicated to you, our revered clients, as a proof of our passion to only give the best performance. We will continue to grow our business while you continue to achieve your financial goals. <br><br>";

        $body .= "We are honored to be your brokerage and we are looking forward to further cooperation and mutual success. <br><br>";

        $body .= "At ForexMart, you have confidence in your choice. <br><br>";

        $body .= "ForexMart is an investment company regulated across the EU region. We offer the highest quality of service to our clients including a 30% trading bonus for every deposit. Register with us and get your bonus today. Simply click on the following links below to know more about our offering. <br><br>";


        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<a  href="https://my.forexmart.com/deposit" style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #319ae3;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<span style="color:white;text-decoration:none">Get 30% Bonus</span></a>';

        $body .= '<a href="https://webtrader.forexmart.com/login" style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<span style="color:white;text-decoration:none">Web Terminal</span></a>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">Best regards,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">ForexMart Team</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooter($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Our Achievements - Our pride', $body);

        return $sender;
    }

    public static function awardsRussian($to,$name,$unsubscribe_key)
    {
        $body = self::NewestHeader();
        $body .= '<div style="padding: 0;position: relative;border-top: 1px solid #333;">';
        $body .= '<div style="position: relative;">';
        $body .= '<img style="width:100%; display:table; margin: 0 auto;height: auto;" src="https://www.forexmart.com/assets/images/mailing_awards_img.png" alt="mailing_awards_img">';
        $body .= '</div>';
        $body .= '<div style="padding: 0 10px 10px 10px;min-height: 312px;">';
        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;max-width: 100%;margin-bottom: 5px;">Уважаемые клиенты и партнеры,</label>';
        $body .= '<p style="text-align:justify">';

        $body .= "Команда ФорексМарт благодарна за ваше доверие и столь ценное для нас сотрудничество. Каждый день мы делаем все возможное в стремлении предоставить вам более совершенные и исключительные условия для торговли. Наши усилия не остались незамеченными – компания ФорексМарт была удостоена нескольких наград от авторитетных финансовых организаций: <br><br>";

        $body .= "<span style='font-weight: bold;color: #2988ca;'>Лучший брокер Европы 2015 по версии ShowFx World</span><br>";
        $body .= "<span style='font-weight: bold;color: #2988ca;'>Самый перспективный брокер Азии 2015 по версии ShowFx World</span><br>";
        $body .= "<span style='font-weight: bold;color: #2988ca;'>Лучший новый брокер Европы 2016 по версии Международного Финансового Журнала (International Finance Magazine)</span><br>";
        $body .= "<span style='font-weight: bold;color: #2988ca;'>Лучшая молодая компания в брокерской сфере 2016 по версии Global Business Outlook.</span><br><br>";

        $body .= "Мы чрезвычайно признательны за присуждение этих ценных наград и хотим выразить огромную благодарность вам, нашим клиентам. Эти знаменательные награды являются символом вашего доверия и характеризуют нашу компанию как надежного и стабильного брокер-партнера. Компания ФорексМарт всегда стремится предоставлять клиентам самые продвинутые технологии для успешной торговли, не забывая при этом о безопасности и комфорте. Мы и дальше планируем развиваться, помогая нашим трейдерам и партнерам оставаться на верном пути к успеху. <br><br>";

        $body .= "ФорексМарт предоставляет вам только лучшие торговые инструменты и условия, в целях обеспечения максимальной производительности торговли на валютном рынке. Ведь ваш успех является нашей приоритетной задачей! <br><br>";

        $body .= "Выбрав ФорексМарт, вы можете быть уверены в правильности своего выбора. <br><br>";

        $body .= '</p>';

        $body .= '<center>';
        $body .= '<div style="display: table; margin: 0px auto;cursor: pointer;padding: 15px 20px;width: 100%;text-align: center;">';

        $body .= '<a  href="https://my.forexmart.com/ru/deposit" style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #319ae3;padding:15px;min-width: calc(50% /2);width: 203px;display: inline-block;">';
        $body .= '<span style="color:white;text-decoration:none">получить 30 % Бонус</span></a>';

        $body .= '<a href="https://webtrader.forexmart.com/ru/login" style="margin: 10px;color: #fff;font-size: 16px;text-decoration: none;text-transform: uppercase;background: #29a643;padding:15px;min-width: calc(50% / 2);width: 203px;display: inline-block;">';
        $body .= '<span style="color:white;text-decoration:none">Веб Терминал</span></a>';

        $body .= '</div></center>';

        $body .= '<label style="padding-top: 20px;font-weight: normal;display: block;">С наилучшими пожеланиями,<span style="display: block;font-size: 15px;font-weight: bold;color: #003a62;">Команда ФорексМарт.</span></label>';
        $body .= '</div>';
        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image?email=".$to."&key=". $unsubscribe_key ."&methodname=". __FUNCTION__ ."'>";
        $footer = self::NewestFoooterRussian($unsubscribe_key);

        $body .= $footer;
        // $to, $replyto, $from, $pass, $body, $subject
        $sender = self::MailerSchedulerSenderPeriodic($to, 'Наши достижения – наша гордость.', $body);

        return $sender;
    }

    public static function partners_registration_resend($partnership_login, $partnership_affiliate)
    {
        $subject = "ForexMart Partnership Program";
        $from = "partners@mail.forexmart.com";
        $returnpath = "partnership@forexmart.com";
        $body = self::head();

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">' . $subject . '</h2>';
        $body .= '<label style="color: #5A5A5A;font-size: 14px;float: left;">' . lang('fxm_par_reg_00') . '

' . $partnership_login['fullname'] . ',</label>';
        //        Dear
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;">';
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_01') . "
</p>";
        //Welcome to ForexMart, the world's most trusted trading partner! We express our profound gratitude for jump-starting your business with us.

        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_02') . "

</p>";
        //        Please take note of your account details below. Keep your account details safe and secure at all times.
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('fxm_par_reg_03') . "
" . $partnership_login['account_number'] . " or " . $partnership_login['email'] . "</p>";
        //        Username:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('fxm_par_reg_04') . "

" . $partnership_login['trader_password'] . "</p>";
        //        Password:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('fxm_par_reg_05') . "

" . $partnership_login['phone_password'] . "</p>";
        //        Phone Password:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('AccountNumber') . ":

" . $partnership_login['account_number'] . "</p>";

        //        Phone Password:


        $body .= "<div style='margin: 22px 20px;'><a href='" . self::CI()->config->item('PartnerSignIn') . "' style='background: #29a643; color: #fff;border: none;padding: 7px 50px;transition: all ease 0.3s;text-decoration: none;font-size: 14px;'>
" . lang('fxm_par_reg_06') . "

             </a></div>";
        //        Login to your account
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_07') . "

</p>";
        //        You may start referring clients by using the following affiliate link.
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'><a href='https://www.forexmart.com/register?id=" . $partnership_affiliate['affiliate_code'] . "'>https://www.forexmart.com/register?id=" . $partnership_affiliate['affiliate_code'] . "</a>";
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_08') . "

</p>";
        //        Should you have any issues or questions, please let us know by reaching us at partnership@forexmart.com
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_09') . "

<a href=" . self::CI()->config->item('VerifyAccount') . ">
" . lang('fxm_par_reg_10') . "

</a>
" . lang('fxm_par_reg_11') . "

</p>";

        //        Do not forget to verify your account. Click
        //        here
        //        to begin the verification process. Provide a scanned copy of your valid ID or passport, along with proof of residence. Accepted image file formats include .jpeg, .gif, .pdf, and .png
        $body .= '</p>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;">
' . lang('fxm_par_reg_12') . '

</label>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;display: block;">
' . lang('fxm_par_reg_13') . '

</label>';

        //        All the best,
        //        ForexMart Team

        $body .= self::foot();
        return self::fx_sender_partner_bcc("bug.fxpp@gmail.com", $subject, $body, $from, $returnpath);
    }

    public static function fx_sender_partner_bcc($to, $subject, $message, $from, $returnpath)
    {
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
        $mail->AddBCC("bug.fxpp@gmail.com");
        $mail->SetFrom($from, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function PRS($partnership_login, $partnership_affiliate)
    {

        $subject = "ForexMart Partnership Program";

        $from = "partners@mail.forexmart.com";
        $returnpath = "partnership@forexmart.com";
        $body = self::head();

        $body .= '<h2 style="font-size: 22px;text-align: center;color: #2988CA;">' . $subject . '</h2>';
        $body .= '<label style="color: #5A5A5A;font-size: 14px;float: left;">' . lang('fxm_par_reg_00') . '

' . $partnership_login['fullname'] . ',</label>';
        //        Dear
        $body .= '<p style="padding-top: 10px; font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;">';
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_01') . "
</p>";
        //Welcome to ForexMart, the world's most trusted trading partner! We express our profound gratitude for jump-starting your business with us.

        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_02') . "

</p>";
        //        Please take note of your account details below. Keep your account details safe and secure at all times.
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('fxm_par_reg_03') . "
" . $partnership_login['account_number'] . " or " . $partnership_login['email'] . "</p>";
        //        Username:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('fxm_par_reg_04') . "

" . $partnership_login['trader_password'] . "</p>";
        //        Password:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('fxm_par_reg_05') . "

" . $partnership_login['phone_password'] . "</p>";
        //        Phone Password:
        $body .= "<p style='font-size: 14px; line-height: 20px; color: #5A5A5A; margin-left: 20px;'>
" . lang('AccountNumber') . ":

" . $partnership_login['account_number'] . "</p>";

        //        Phone Password:


        $body .= "<div style='margin: 22px 20px;'><a href='" . self::CI()->config->item('PartnerSignIn') . "' style='background: #29a643; color: #fff;border: none;padding: 7px 50px;transition: all ease 0.3s;text-decoration: none;font-size: 14px;'>
" . lang('fxm_par_reg_06') . "

             </a></div>";
        //        Login to your account
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_07') . "

</p>";
        //        You may start referring clients by using the following affiliate link.
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'><a href='https://www.forexmart.com/register?id=" . $partnership_affiliate['affiliate_code'] . "'>https://www.forexmart.com/register?id=" . $partnership_affiliate['affiliate_code'] . "</a>";
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_08') . "

</p>";
        //        Should you have any issues or questions, please let us know by reaching us at partnership@forexmart.com
        $body .= "<p style='font-size: 14px; line-height: 20px; clear: left;color: #5A5A5A;text-align: justify;'>
" . lang('fxm_par_reg_09') . "

<a href=" . self::CI()->config->item('VerifyAccount') . ">
" . lang('fxm_par_reg_10') . "

</a>
" . lang('fxm_par_reg_11') . "

</p>";

        //        Do not forget to verify your account. Click
        //        here
        //        to begin the verification process. Provide a scanned copy of your valid ID or passport, along with proof of residence. Accepted image file formats include .jpeg, .gif, .pdf, and .png
        $body .= '</p>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;">
' . lang('fxm_par_reg_12') . '

</label>';
        $body .= '<label style="line-height: 20px; clear: left;color: #5A5A5A;text-align: justify; color: #5A5A5A;font-size: 14px;display: block;">
' . lang('fxm_par_reg_13') . '

</label>';

        //        All the best,
        //        ForexMart Team

        $body .= self::foot();
        self::fx_sender_partner('agus@forexmart.com', $subject, $body, $from, $returnpath);
        self::fx_sender_partner('trowabarton00005@gmail.com', $subject, $body, $from, $returnpath);
         return self::fx_sender_partner($partnership_login['email'], $subject, $body, $from, $returnpath);

    }



    public static function testtradermailer($to, $unsubscribe,$res){
        $body =self::tradeOfferHeader();
        $body .='      <table class="outer" align="center" style="border-spacing:0;color:#333333;Margin:0 auto;width:100%;max-width:800px;border-collapse: collapse;padding: 0;"> ' ;
        $body .='        <tbody><tr style=""> ' ;
        $body .='          <td class="full-width-image header" style="padding-top:0;padding-bottom: 0!important;padding-right:0;padding-left:0;width:100%;background-color:transparent;background-image:url(https://www.forexmart.com/assets/images/header-bg.png);background-repeat:repeat;background-position:top left;background-attachment:scroll;margin-bottom: 0!important;display: block;"> ' ;
        $body .='            <img src="https://www.forexmart.com/assets/images/logo-mailing_v2.png" width="600" alt="" style="border-width:0;width:100%;max-width:800px;height:auto;"> ' ;
        $body .='          </td> ' ;
        $body .='        </tr> ' ;
        $body .='        <tr> ' ;
        $body .='          <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='            <table style="border-spacing:0;color:#333333;width:100%;padding: 0;margin: 0;border-collapse: collapse;"> ' ;
        $body .='            <tbody style="    padding: 0;    margin: 0;    border-collapse: collapse;    border-spacing: 0;"> ' ;
        $body .='            <tr> ' ;
        $body .='              <td class="inner contents" style="padding-top:0;padding-bottom:10px;text-align:left;padding: 0;margin: 0;border-collapse: collapse;/* display: block; */"> ' ;
        $body .='                <table style="    padding: 0;    margin: 0;    border-collapse: collapse;    border-spacing: 0!important;    /* display: block; */"> ' ;
        $body .='                  <tbody><tr style="    padding: 0;    margin: 0;    border-collapse: collapse;    border-spacing: 0;    display: block;"> ' ;
        $body .='                    <td style="width:100%!important;        display: block;        padding: 0;        margin: 0;        border-collapse: collapse;"> ' ;
        $body .='                      <img src="https://www.forexmart.com/assets/images/trader_offer_mailing/trade-offer-mailing-img.png" style="display:block;max-width:100%;"> ' ;
        $body .='                    </td> ' ;
        $body .='                  </tr> ' ;
        $body .='                  <tr> ' ;
        $body .='                    <td style="background: #373737; padding: 10px; text-align: center;"> ' ;
        $body .='                      <span style="color:#fff; font-size:17px;">Most Popular Symbol this Week</span> ' ;
        $body .='                      <span style="display:block; width:100%; text-align:center; color:#fff; font-size:30px; font-weight:bold; margin:5px auto;"> ' ;
        $body .='                        '.$res['MostIncreasingPopularSymbol'];
        $body .='                        <a href="javascript:;"><img src="https://www.forexmart.com/assets/images/trader_offer_mailing/arrows-up.png" width="50" height="50"></a> ' ;
        $body .='                        '.$res['MostIncreasingPopularSymbolPercentage'].'% ' ;
        $body .='                      </span> ' ;
        $body .='                      <span style="font-size: 14px; color: #a7a7a7;">'.$res['FromDate'].'</span> ' ;
        $body .='                      <span style="font-size:18px; color: #6ac2ff; display:block;">"Catch the market tone and stay in trend"</span> ' ;
        $body .='                    </td> ' ;
        $body .='                  </tr> ' ;

        $body .= '<tr style="width:100%;">';
        $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
        $body .= '        <a href="https://my.forexmart.com/client/signin" style="text-decoration:none; margin:0 auto;display: block;background: #2988ca;border-bottom:4px solid #1771b0!important;color:#fff;border:0;padding: 23px 7px;font-size:15px;cursor:pointer;text-align: center;width:90%;">';
        $body .= '        Make A Deposit';
        $body .= '        </a>';
        $body .= '    </td>';
        $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
        $body .= '        <a href="https://www.forexmart.com/webtrader" style="text-decoration:none; margin:0 auto;display: block;background: #29a643;border-bottom:4px solid #188c30!important;color:#fff;border:0;padding: 13px 10px;font-size:15px;cursor:pointer;width:90%;text-align: center;">';
        $body .= '        BUY';
        $body .= '            <span style="display:block; margin:0 auto; font-size:12px; margin-top:5px;">';
        $body .= '            If you believe '.$res['MostIncreasingPopularSymbol'].' price will climb up';
        $body .= '            </span>';
        $body .= '        </a>';
        $body .= '    </td>';
        $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
        $body .= '        <a href="https://www.forexmart.com/webtrader" style="text-decoration:none; margin:0 auto;display: block;background: #cf2323;border-bottom:4px solid #ad1717!important;color:#fff;border:0;padding: 13px 10px;font-size:15px;cursor:pointer;width:90%;text-align: center;">';
        $body .= '        SELL';
        $body .= '            <span style="display:block; margin:0 auto; font-size:12px; margin-top:5px;">';
        $body .= '            If you believe '.$res['MostIncreasingPopularSymbol'].' price will decline';
        $body .= '            </span>';
        $body .= '        </a>';
        $body .= '    </td>';
        $body .= '</tr>';

        $body .='                </tbody></table> ' ;
        $body .='              </td> ' ;
        $body .='            </tr> ' ;
        $body .='            </tbody></table> ' ;
        $body .='            </td> ' ;
        $body .='        </tr> ' ;
        $body .=self::tradeOfferFooter($unsubscribe_key);
        echo $body;
        $sender = self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'This week most popular deal');
    }
    public static function testtradermailerRussian($to, $unsubscribe,$res){
        $body =self::tradeOfferHeader();
        $body .='      <table class="outer" align="center" style="border-spacing:0;color:#333333;Margin:0 auto;width:100%;max-width:800px;border-collapse: collapse;padding: 0;"> ' ;
        $body .='        <tbody><tr style=""> ' ;
        $body .='          <td class="full-width-image header" style="padding-top:0;padding-bottom: 0!important;padding-right:0;padding-left:0;width:100%;background-color:transparent;background-image:url(https://www.forexmart.com/assets/images/header-bg.png);background-repeat:repeat;background-position:top left;background-attachment:scroll;margin-bottom: 0!important;display: block;"> ' ;
        $body .='            <img src="https://www.forexmart.com/assets/images/logo-mailing_v2.png" width="600" alt="" style="border-width:0;width:100%;max-width:800px;height:auto;"> ' ;
        $body .='          </td> ' ;
        $body .='        </tr> ' ;
        $body .='        <tr> ' ;
        $body .='          <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='            <table style="border-spacing:0;color:#333333;width:100%;padding: 0;margin: 0;border-collapse: collapse;"> ' ;
        $body .='            <tbody style="    padding: 0;    margin: 0;    border-collapse: collapse;    border-spacing: 0;"> ' ;
        $body .='            <tr> ' ;
        $body .='              <td class="inner contents" style="padding-top:0;padding-bottom:10px;text-align:left;padding: 0;margin: 0;border-collapse: collapse;/* display: block; */"> ' ;
        $body .='                <table style="    padding: 0;    margin: 0;    border-collapse: collapse;    border-spacing: 0!important;    /* display: block; */"> ' ;
        $body .='                  <tbody><tr style="    padding: 0;    margin: 0;    border-collapse: collapse;    border-spacing: 0;    display: block;"> ' ;
        $body .='                    <td style="width:100%!important;        display: block;        padding: 0;        margin: 0;        border-collapse: collapse;"> ' ;
        $body .='                      <img src="https://www.forexmart.com/assets/images/trader_offer_mailing/trade-offer-mailing-img.png" style="display:block;max-width:100%;"> ' ;
        $body .='                    </td> ' ;
        $body .='                  </tr> ' ;
        $body .='                  <tr> ' ;
        $body .='                    <td style="background: #373737; padding: 10px; text-align: center;"> ' ;
        $body .='                      <span style="color:#fff; font-size:17px;">Самый популярный торговый инструмент на этой неделе</span> ' ;
        $body .='                      <span style="display:block; width:100%; text-align:center; color:#fff; font-size:30px; font-weight:bold; margin:5px auto;"> ' ;
        $body .='                        '.$res['MostIncreasingPopularSymbol'];
        $body .='                        <a href="javascript:;"><img src="https://www.forexmart.com/assets/images/trader_offer_mailing/arrows-up.png" width="50" height="50"></a> ' ;
        $body .='                        '.$res['MostIncreasingPopularSymbolPercentage'].'% ' ;
        $body .='                      </span> ' ;
        $body .='                      <span style="font-size: 14px; color: #a7a7a7;">'.$res['FromDate'].'</span> ' ;
        $body .='                      <span style="font-size:18px; color: #6ac2ff; display:block;">"Следите за настроением рынка и оставайтесь в тренде"</span> ' ;
        $body .='                    </td> ' ;
        $body .='                  </tr> ' ;
        $body .= '<tr style="width:100%;">';
        $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
        $body .= '        <a href="https://my.forexmart.com/client/signin" style="text-decoration:none;margin:0 auto;display: block;background: #2988ca;border-bottom:4px solid #1771b0!important;color:#fff;border:0;padding: 29px 7px;font-size:15px;cursor:pointer;text-align: center;width:90%;">';
        $body .= '        Пополнить счет';
        $body .= '        </a>';
        $body .= '    </td>';
        $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
        $body .= '        <a href="https://www.forexmart.com/webtrader" style="text-decoration:none;margin:0 auto;display: block;background: #29a643;border-bottom:4px solid #188c30!important;color:#fff;border:0;padding: 13px 10px;font-size:15px;cursor:pointer;width:90%;text-align: center;">';
        $body .= '        Купить';
        $body .= '            <span style="display:block; margin:0 auto; font-size:12px; margin-top:5px;">';
        $body .= '            Если считаете '.$res['MostIncreasingPopularSymbol'].' что цена пойдет вверх';
        $body .= '            </span>';
        $body .= '        </a>';
        $body .= '    </td>';
        $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
        $body .= '        <a href="https://www.forexmart.com/webtrader" style="text-decoration:none; margin:0 auto;display: block;background: #cf2323;border-bottom:4px solid #ad1717!important;color:#fff;border:0;padding: 13px 10px;font-size:15px;cursor:pointer;width:90%;text-align: center;">';
        $body .= '        Продать';
        $body .= '            <span style="display:block; margin:0 auto; font-size:12px; margin-top:5px;">';
        $body .= '            Если вы считаете '.$res['MostIncreasingPopularSymbol'].' что цена пойдет вниз';
        $body .= '            </span>';
        $body .= '        </a>';
        $body .= '    </td>';
        $body .= '</tr>';

        $body .='                </tbody></table> ' ;
        $body .='              </td> ' ;
        $body .='            </tr> ' ;
        $body .='            </tbody></table> ' ;
        $body .='            </td> ' ;
        $body .='        </tr> ' ;
        $body .=self::tradeOfferFooterRussian($unsubscribe_key);
        echo $body;
        $sender = self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'Популярная сделка на этой неделе');
    }

    public static function tradeOfferHeader(){
        $body ='<html lang="en"><head> ' ;
        $body .='    <meta charset="utf-8"> ' ;
        $body .='    <meta http-equiv="X-UA-Compatible" content="IE=edge"> ' ;
        $body .='    <meta name="viewport" content="width=device-width, initial-scale=1"> ' ;
        $body .='    <title>ForexMart Mail</title> ' ;
        $body .='  </head> ' ;
        $body .='  <body style="margin-top:0 !important;margin-bottom:0 !important;margin-right:0 !important;margin-left:0 !important;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#ffffff;"> ' ;
        $body .='    <center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;"> ' ;
        $body .='      <div class="webkit" style="max-width:800px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;"> ' ;
       return $body;
    }

    public static function tradeOfferFooter($unsubscribe_key){
        $body ='        <tr> ' ;
        $body .='        <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='          <ul class="three-column-list" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='            <li style="width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;"> ' ;
        $body .='              <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;">OUR PARTNER</p> ' ;
        $body .='              <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                <li style="    margin: 0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;"><a href="https://www.forexmart.com/las-palmas" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/partner-laspalmas-logo.png" alt="" style="border-width:0;"></a></li> ' ;
        $body .='                <li style="    margin: 0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;"><a href="https://www.forexmart.com/rpj-racing" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/partner-rpj-logo.png" alt="" style="border-width:0;"></a></li> ' ;
        $body .='                <li style="    margin: 0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;"><a href="https://www.forexmart.com/HKM_Zvolen" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/partner-hkm-logo.png" alt="" style="border-width:0;"></a></li> ' ;
        $body .='              </ul> ' ;
        $body .='            </li> ' ;
        $body .='            <li style="width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;"> ' ;
        $body .='              <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;">FOLLOW US</p> ' ;
        $body .='              <div style="padding-top:27.5px;padding-bottom:27.5px;padding-right:27.5px;padding-left:27.5px;"><b>Get all the latest news</b> ' ;
        $body .='              <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                  <li style="    margin: 0;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;"><a href="https://www.forexmart.com/las-palmas" style="color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;display:inline-block;"><span style="background-image:url(https://www.forexmart.com/assets/images/massmail/icon-facebook.png);background-size:cover;height:36px;width:36px;display:block;"></span></a></li>              ' ;
        $body .='                  <li style="    margin: 0;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;"><a href="https://www.forexmart.com/rpj-racing" style="color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;display:inline-block;"><span style="background-image:url(https://www.forexmart.com/assets/images/massmail/icon-twitter.png);background-size:cover;height:36px;width:36px;display:block;"></span></a></li> ' ;
        $body .='                  <li style="    margin: 0;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;"><a href="https://www.forexmart.com/HKM_Zvolen" style="color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;display:inline-block;"><span style="background-image:url(https://www.forexmart.com/assets/images/massmail/icon-googleplus.png);background-size:cover;height:36px;width:36px;display:block;"></span></a></li>  ' ;
        $body .='                </ul></div> ' ;
        $body .='            </li> ' ;
        $body .='            <li style="width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;"> ' ;
        $body .='              <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;">TRADE ANYWHERE</p> ' ;
        $body .='              <div style="padding-top:8px;padding-bottom:8px;padding-right:0;padding-left:0;"> ' ;
        $body .='              <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                <li style="    margin: 0;display:inline-block;"><a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/google-play-footer.png" style="border-width:0;"></a></li> ' ;
        $body .='                <li style="    margin: 0;display:inline-block;"><a href="https://appsto.re/ru/HB57gb.i" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/app-store-footer.png" style="border-width:0;"></a></li> ' ;
        $body .='              </ul> ' ;
        $body .='              </div> ' ;
        $body .='            </li> ' ;
        $body .='          </ul> ' ;
        $body .='        </td> ' ;
        $body .='        </tr> ' ;
        $body .='        <tr> ' ;
        $body .='          <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='            <table width="100%" style="border-spacing:0;color:#333333;"> ' ;
        $body .='            <tbody><tr> ' ;
        $body .='              <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;"> ' ;
        $body .='                <ul style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;background-color:transparent;background-image:url(https://www.forexmart.com/assets/images/header-bg.png);background-repeat:repeat;background-position:top left;background-attachment:scroll;border-top-width:1px;border-top-style:solid;border-top-color:#0f639d;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_bafin.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_cysec.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_mifid.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_autorite.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_consob.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_fca.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                    </ul> ' ;
        $body .='              </td> ' ;
        $body .='            </tr> ' ;
        $body .='            </tbody></table> ' ;
        $body .='            </td> ' ;
        $body .='        </tr> ' ;
        $body .='        <tr> ' ;
        $body .='          <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='            <table width="100%" style="border-spacing:0;color:#333333;"> ' ;
        $body .='            <tbody><tr> ' ;
        $body .='              <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;"> ' ;
        $body .='                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;"><b>ForexMart</b> was named by ShowFx World as the <b>"Best Broker in Europe 2015"</b> and <b>"Most Perspective Broker in Asia 2015"</b>.International Finance Magazine (IFM) awarded ForexMart <b>"Best New Broker Europe 2016"</b>.Global Business Outlook recognized ForexMart as the <b>"Best Forex Newcomer in 2016"</b></p>                ' ;
        $body .='                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;"><b>ForexMart</b> a trading name of <b>Tradomart Ltd</b>, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.</p> ' ;
        $body .='                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;"><b>Risk Warning:</b> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.</p> ' ;
        $body .='                <ul class="border-top" style="border-top-width:1px;border-top-style:solid;border-top-color:#bbb;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;"> ' ;
        $body .='                  <li style="list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;">© 2015 - 2017 <b>Tradomart Ltd</b></li> ' ;
        $body .='                  <li style="list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;">';
        $body .= '                  <a href="https://www.forexmart.com/unsubscribe/ref4/' . $unsubscribe_key . '" style="color:#ee6a56;text-decoration:underline;">Unsubscribe this email</a>';
        $body .='                </li></ul> ' ;
        $body .='              </td> ' ;
        $body .='            </tr> ' ;
        $body .='            </tbody></table> ' ;
        $body .='            </td> ' ;
        $body .='        </tr> ' ;
        $body .='      </tbody></table> ' ;
        $body .='      </div> ' ;
        $body .='    </center> ' ;
        $body .='</body> ' ;
        $body .='</html> ' ;
        return $body;
    }

    public static function tradeOfferFooterRussian($unsubscribe_key){
        $body ='        <tr> ' ;
        $body .='        <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='          <ul class="three-column-list" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='            <li style="width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;"> ' ;
        $body .='              <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;">НАШИ ПАРТНЕРЫ</p> ' ;
        $body .='              <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                <li style="    margin: 0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;"><a href="https://www.forexmart.com/las-palmas" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/partner-laspalmas-logo.png" alt="" style="border-width:0;"></a></li> ' ;
        $body .='                <li style="    margin: 0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;"><a href="https://www.forexmart.com/rpj-racing" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/partner-rpj-logo.png" alt="" style="border-width:0;"></a></li> ' ;
        $body .='                <li style="    margin: 0; list-style-type:none;list-style-position:outside;list-style-image:none;text-align:center;display:inline-block;"><a href="https://www.forexmart.com/HKM_Zvolen" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/partner-hkm-logo.png" alt="" style="border-width:0;"></a></li> ' ;
        $body .='              </ul> ' ;
        $body .='            </li> ' ;
        $body .='            <li style="width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;"> ' ;
        $body .='              <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;">ПОДПИСЫВАЙТЕСЬ НА НАС</p> ' ;
        $body .='              <div style="padding-top:27.5px;padding-bottom:27.5px;padding-right:27.5px;padding-left:27.5px;"><b>Следите за последними новостями</b> ' ;
        $body .='              <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                  <li style="    margin: 0;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;"><a href="https://www.forexmart.com/las-palmas" style="color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;display:inline-block;"><span style="background-image:url(https://www.forexmart.com/assets/images/massmail/icon-facebook.png);background-size:cover;height:36px;width:36px;display:block;"></span></a></li>              ' ;
        $body .='                  <li style="    margin: 0;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;"><a href="https://www.forexmart.com/rpj-racing" style="color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;display:inline-block;"><span style="background-image:url(https://www.forexmart.com/assets/images/massmail/icon-twitter.png);background-size:cover;height:36px;width:36px;display:block;"></span></a></li> ' ;
        $body .='                  <li style="    margin: 0;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;"><a href="https://www.forexmart.com/HKM_Zvolen" style="color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;display:inline-block;"><span style="background-image:url(https://www.forexmart.com/assets/images/massmail/icon-googleplus.png);background-size:cover;height:36px;width:36px;display:block;"></span></a></li>  ' ;
        $body .='                </ul></div> ' ;
        $body .='            </li> ' ;
        $body .='            <li style="width:255px;max-width:75%;list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;border-width:1px;border-style:solid;border-color:#ddd;vertical-align:top;margin-top:10px;margin-bottom:10px;margin-right:0;margin-left:0;min-height:200px;"> ' ;
        $body .='              <p class="three-column-title" style="Margin:0;font-weight:600;color:#3e3e3e;text-align:center;background-color:rgba(0, 0, 0, 0.1);background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:20px;padding-right:5px;padding-left:5px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;">ТОРГУЙТЕ ГДЕ УДОБНО</p> ' ;
        $body .='              <div style="padding-top:8px;padding-bottom:8px;padding-right:0;padding-left:0;"> ' ;
        $body .='              <ul class="sub-list" style="padding-top:5px !important;padding-bottom:5px !important;padding-right:5px !important;padding-left:5px !important;display:block;text-align:center;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                <li style="    margin: 0;display:inline-block;"><a href="https://play.google.com/store/apps/details?id=com.forexmart.mobiletrader" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/google-play-footer-ru.png" style="    border-width: 0; max-width: 162px;    height: auto;border-width:0;"></a></li> ' ;
        $body .='                <li style="    margin: 0;display:inline-block;"><a href="https://appsto.re/ru/HB57gb.i" style="display:inline-block;color:#ee6a56;text-decoration:underline;padding-top:3px;padding-bottom:3px;padding-right:3px;padding-left:3px;"><img src="https://www.forexmart.com/assets/images/massmail/app-store-footer-ru.png" style="border-width:0;   border-width: 0; max-width: 162px;    height: auto;border-width:0;"></a></li> ' ;
        $body .='              </ul> ' ;
        $body .='              </div> ' ;
        $body .='            </li> ' ;
        $body .='          </ul> ' ;
        $body .='        </td> ' ;
        $body .='        </tr> ' ;
        $body .='        <tr> ' ;
        $body .='          <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='            <table width="100%" style="border-spacing:0;color:#333333;"> ' ;
        $body .='            <tbody><tr> ' ;
        $body .='              <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;"> ' ;
        $body .='                <ul style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;background-color:transparent;background-image:url(https://www.forexmart.com/assets/images/header-bg.png);background-repeat:repeat;background-position:top left;background-attachment:scroll;border-top-width:1px;border-top-style:solid;border-top-color:#0f639d;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_bafin.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_cysec.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_mifid.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_autorite.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_consob.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                      <li style="list-style-type:none;list-style-position:outside;list-style-image:none;display:inline-block;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px;font-size:13px;"><img src="https://www.forexmart.com/assets/images/massmail/img_fca.png" style="height:auto;width:96px;border-width:0;"></li> ' ;
        $body .='                    </ul> ' ;
        $body .='              </td> ' ;
        $body .='            </tr> ' ;
        $body .='            </tbody></table> ' ;
        $body .='            </td> ' ;
        $body .='        </tr> ' ;
        $body .='        <tr> ' ;
        $body .='          <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"> ' ;
        $body .='            <table width="100%" style="border-spacing:0;color:#333333;"> ' ;
        $body .='            <tbody><tr> ' ;
        $body .='              <td class="inner contents" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;width:100%;text-align:left;"> ' ;
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b> признан лучшим брокером Европы по итогам 2015 года и самым перспективным брокером Азии по итогам 2015 года по версии ShowFx World.</p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b>  признан лучшим новым брокером Европы в 2016 году по версии Международного Финансового Журнала (International Finance Magazine).</p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b> победил в номинации Лучший Начинающий Брокер 2016 ("Best Forex Newcomer in 2016") по версии Global Business Outlook.</p>                             ';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #2988ca;">ФорексМарт (ForexMart)</span></b> является торговой маркой компании <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10">, кипрской инвестиционной компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/">266/15</a>.';
        $body .= '                                <p style="Margin:0;font-size:14px;Margin-bottom:10px;text-align:justify;" ><b><span style="font-weight: bold;color: #ff0000;">Предупреждение о рисках: </span></b>  Торговля на Форекс имеет спекулятивный и сложный характер и может подойти не всем инвесторам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорекМарт, пожалуйста, оцените и примите <a href="www.forexmart.com/ru/risk-disclosure">риски</a>, связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.</p>';
        $body .= '                                <ul class="border-top" style="border-top-width:1px;border-top-style:solid;border-top-color:#bbb;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;" >';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" >© 2015 - 2017 <img style="margin-bottom: 3px;vertical-align: middle;border: 0;" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png" width="101" height="10"></li>';
        $body .= '                                    <li style="margin:0; list-style-type:none;list-style-position:outside;list-style-image:none;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;display:inline-block;font-size:13px;" ><a href="https://www.forexmart.com/ru/unsubscribe/ref4/' . $unsubscribe_key . '" style="color:#ee6a56;text-decoration:underline;" >Отписаться от рассылки</a></li>';
        $body .= '                                </ul>';
        $body .='              </td> ' ;
        $body .='            </tr> ' ;
        $body .='            </tbody></table> ' ;
        $body .='            </td> ' ;
        $body .='        </tr> ' ;
        $body .='      </tbody></table> ' ;
        $body .='      </div> ' ;
        $body .='    </center> ' ;
        $body .='</body> ' ;
        $body .='</html> ' ;
        return $body;
    }

    public function tradeOfferMailTEST($to, $unsubscribe,$res){
        $body = self::traderOfferHeader();
        if(IPLoc::Office()){
            $body .= '
            <div class="wrapper-container" style="max-width:800px; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;height: auto;">
            <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;padding: 0!important;width: 100%;float: left;position: relative;min-height: 1px;">
            <div class="wrapper-header-two" style="background: url(images/header-bg.png);font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;">
            </div>
            <div class="wrapper-body trade-offer-bg" style="background-size: cover; background: url(https://www.forexmart.com/assets/images/trade-offer-bg.png) no-repeat top / auto auto;  padding: 20px 0;">
            <div class="initial-trade-span" style="    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;">
            <span style="    color: #2988ca;    font-size: 18px;    text-align: center;    display: block;    box-sizing: border-box;    line-height: 1.42857143;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;">
            ' . lang('fxtom_1') . '
            </span>
            </div>
            <div class="first-trade-span" style="    font-size: 40px;    font-weight: bold;    text-align: center;    margin: 0 auto;    display: table;">
            ' . $res['MostIncreasingPopularSymbol'] . '
            <a style="display: inline-block;    width: 32px;    height: 32px;    text-decoration: underline;    color: #2988ca;    font-family: " helvetica="" font-size:="" line-height:="" box-sizing:=""><img alt="arrow" src="https://www.forexmart.com/assets/images/arrow.png"></a>
            ' . $res['MostIncreasingPopularSymbolPercentage'] . '%
            </div>
            <div class="second-trade-span" style="text-align: center;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;box-sizing: border-box;">
            <span style="box-sizing: border-box;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;text-align: center;box-sizing: border-box;">
            ' . $res['FromDate'] . '
            </span>
            </div>
            <div class="hidden-trade-span" style="text-align: center;margin: 0 auto;display: none;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;box-sizing: border-box;-webkit-tap-highlight-color: rgba(0,0,0,0);">
            <span style="margin-top: 30px;color: #2988caleft: 0;font-size: 18px;z-index: 1000;right: 0;display: block;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height: 1.42857143;box-sizing: border-box;">
            <q style="    margin-top: 30px;    color: #2988ca;     left: 0;    font-size: 18px;    z-index: 1000;    right: 0;    display: block;    text-align: center;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    line-height: 1.42857143;    box-sizing: border-box;">
            ' . lang('fxtom_2') . ' 
            </q>
            </span>
            </div>
            <div class="third-trade-span" style="    display: table;    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;    box-sizing: border-box;">
            <span style="    color: #2988ca;     left: 0;    right: 0;    font-size: 18px;    display: block;">
            <q style="    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 18px;    line-height: 1.42857143;    color: #2988ca;">' . lang('fxtom_3') . '</q>
            </span>
            </div>
            <div class="fourth-trade-span" style="margin-top: 396px;text-align: center;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;/* margin: 0 auto; */color: #333;">
            <div style="display:table; margin:0 auto;">

            <div class="buy-trade-button-parent" style="margin: 2px;display: table;     display: inline-block; border: 1px solid #29a643;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="buy-trade-button" style="      display: inline-block;  margin: 2px;    color: #fff;    padding: 10px 34px;    background: #29a643;    border: 0;    transition: all 0.2s linear;    font-family: inherit;    font-size: inherit;    line-height: inherit;     text-decoration: none;">
            <span style="    display: block;    font-size: 25px;">
            ' . lang('fxtom_buy') . '
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            ' . lang('fxtom_4') . $res['MostIncreasingPopularSymbol'] . lang('fxtom_5') . '
            </label>
            </a>
            </div>
            <div class="sell-trade-button-parent" style="border: 1px solid #cf2323;margin: 2px;display: table;     display: inline-block; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="sell-trade-button" style="     display: inline-block;   margin: 2px;    color: #fff;    padding: 10px 37px;    background: #cf2323;    border: 0;    transition: all 0.2s linear;      text-decoration: none;">
            <span style="    font-size: 25px;    display: block;    color: #fff;">
            ' . lang('fxtom_sell') . '
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            ' . lang('fxtom_6') . $res['MostIncreasingPopularSymbol'] . lang('fxtom_7') . '
            </label>

                  </a>              </div>
                </div></div></div></div></div>
            ';
        } else {
            $body .= '
            <div class="wrapper-container" style="max-width:800px; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;height: auto;">
            <div class="wrapper-container-holder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;padding: 0!important;width: 100%;float: left;position: relative;min-height: 1px;">
            <div class="wrapper-header-two" style="background: url(images/header-bg.png);font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;">
            </div>
            <div class="wrapper-body trade-offer-bg" style="background-size: cover; background: url(https://www.forexmart.com/assets/images/trade-offer-bg.png) no-repeat top / auto auto;  padding: 20px 0;">
            <div class="initial-trade-span" style="    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;">
            <span style="    color: #2988ca;    font-size: 18px;    text-align: center;    display: block;    box-sizing: border-box;    line-height: 1.42857143;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;">
            Most Popular Symbol this Week
            </span>
            </div>
            <div class="first-trade-span" style="    font-size: 40px;    font-weight: bold;    text-align: center;    margin: 0 auto;    display: table;">
            ' . $res['MostIncreasingPopularSymbol'] . '
            <a style="display: inline-block;    width: 32px;    height: 32px;    text-decoration: underline;    color: #2988ca;    font-family: " helvetica="" font-size:="" line-height:="" box-sizing:=""><img alt="arrow" src="https://www.forexmart.com/assets/images/arrow.png"></a>
            ' . $res['MostIncreasingPopularSymbolPercentage'] . '%
            </div>
            <div class="second-trade-span" style="text-align: center;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;box-sizing: border-box;">
            <span style="box-sizing: border-box;margin: 0 auto;display: table;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #7f7f7f;text-align: center;box-sizing: border-box;">
            ' . $res['FromDate'] . '
            </span>
            </div>
            <div class="hidden-trade-span" style="text-align: center;margin: 0 auto;display: none;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;box-sizing: border-box;-webkit-tap-highlight-color: rgba(0,0,0,0);">
            <span style="margin-top: 30px;color: #2988caleft: 0;font-size: 18px;z-index: 1000;right: 0;display: block;text-align: center;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height: 1.42857143;box-sizing: border-box;">
            <q style="    margin-top: 30px;    color: #2988ca;     left: 0;    font-size: 18px;    z-index: 1000;    right: 0;    display: block;    text-align: center;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    line-height: 1.42857143;    box-sizing: border-box;">
            Exceptional movements are great <br>trading opportunities! 
            </q>
            </span>
            </div>
            <div class="third-trade-span" style="    display: table;    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 14px;    line-height: 1.42857143;    color: #333;    box-sizing: border-box;">
            <span style="    color: #2988ca;     left: 0;    right: 0;    font-size: 18px;    display: block;">
            <q style="    text-align: center;    margin: 0 auto;    font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;    font-size: 18px;    line-height: 1.42857143;    color: #2988ca;">Catch the market tone and stay in trend</q>
            </span>
            </div>
            <div class="fourth-trade-span" style="margin-top: 396px;text-align: center;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;/* margin: 0 auto; */color: #333;">
            <div style="display:table; margin:0 auto;">

            <div class="buy-trade-button-parent" style="margin: 2px;display: table;     display: inline-block; border: 1px solid #29a643;box-sizing: border-box;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="buy-trade-button" style="      display: inline-block;  margin: 2px;    color: #fff;    padding: 10px 34px;    background: #29a643;    border: 0;    transition: all 0.2s linear;    font-family: inherit;    font-size: inherit;    line-height: inherit;     text-decoration: none;">
            <span style="    display: block;    font-size: 25px;">
            Buy
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            If you believe ' . $res['MostIncreasingPopularSymbol'] . ' price will climb up.
            </label>
            </a>
            </div>
            <div class="sell-trade-button-parent" style="border: 1px solid #cf2323;margin: 2px;display: table;     display: inline-block; font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;">
            <a href=" https://webtrader.forexmart.com/login" class="sell-trade-button" style="     display: inline-block;   margin: 2px;    color: #fff;    padding: 10px 37px;    background: #cf2323;    border: 0;    transition: all 0.2s linear;      text-decoration: none;">
            <span style="    font-size: 25px;    display: block;    color: #fff;">
            Sell
            </span>
            <label style="    padding-top: 0;    color: #fff;    font-weight: normal;    display: block;    max-width: 100%;    margin-bottom: 5px;">
            If you believe ' . $res['MostIncreasingPopularSymbol'] . ' price will decline.
            </label>

                  </a>              </div>
                </div></div></div></div></div>
            ';
        }

        $body .= "<img src='https://www.forexmart.com/Email_Tracker/request_image_to?email=".$to."&key=". $unsubscribe ."&email_id=". $res['id'] ."&ip_address=".$_SERVER['REMOTE_ADDR']."'>";
            // change the footer for unsubscribe key
        $footer = self::NewestFoooterForTradeOffer($unsubscribe);
        $body .= $footer;
        //echo $body;
        $sender = self::Mailersender_singapore($to, 'marketing@notify.forexmart.com', $body, 'This week most popular deal');
        // echo $body;
    }


}