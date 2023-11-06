<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');

        // if(!IPLoc::Office()){redirect("");}
    }

    public function index(){
        exit;
       // echo "test";
    }

    public function test_client(){
      $this->load->model('account_model');
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      ini_set('memory_limit', '-1');
      $this->load->library('IPLoc', null);

      if(IPLoc::Office()){
          $clientA = $this->account_model->getAllEmailByLogintype('0');
          foreach ($clientA as $value) {
            echo "<br>";
            echo $value['email'];
          }
        }
    }


    public function testPeriodic(){
        $this->load->model('Mailer_model');
        $dateToday = date('Y-m-d');
        $getAllPeriodicMailer = $this->Mailer_model->getAllPeriodicMailerTag($dateToday, 0);
        print_r($getAllPeriodicMailer);
    }

    public function testPartnerWithoutClientAccount(){
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      ini_set('memory_limit', '-1');
      $this->load->model('account_model');
      $this->load->library('IPLoc', null);
      if(IPLoc::Office()){
          $client                      = $this->account_model->getAllEmailByLogintype('0');
          $partner                     = $this->account_model->getAllEmailByLogintype('1');
          $client                      = array_map('current', $client);
          $partner                     = array_map('current', $partner);
          $partnerWithoutClientAccount = array_diff($partner,$client);

          foreach ($partnerWithoutClientAccount as $value) {
            echo $value;
            echo "<br>";
          }
        }
    }

    public function rpj(){
      // exit();
      Fx_mailer::rpj('test.02914@gmail.com');
    }


    public function singaporePartner($to){
       $subject = 'ForexMart Reminds you of ShowFx World Conference in Singapore';
       $replyto = 'support@notify.forexmart.com';
      Fx_mailer::Mailertest_singapore_partner2( $to , $replyto , $subject );
    }

    public function singaporeClient($to){
       $subject = 'ForexMart Reminds you of ShowFx World Conference in Singapore';
       $replyto = 'support@notify.forexmart.com';
      Fx_mailer::Mailertest_singapore_client2( $to , $replyto , $subject );
    }


    public function europeanlicense(){
        echo Fx_mailer::newNav();
        echo Fx_mailer::european_license_content();
        echo Fx_mailer::newFooter();
    }

    public function legitimateEmailChecker($email){
      $this->load->library('FXPP');
        $from = 'marketing@notify.forexmart.com';
        $verifyEmail = FXPP::verifyLegitEmail($email, $from);
        if ($verifyEmail === 'invalid') {
            $this->form_validation->set_message('legitimateEmailChecker', 'Your email is invalid.');
            return false;
        }
        return true;
    }

    public function transfermailtomailertesttable(){
      // created > "2016-06-12 00:00:00"
      $this->load->model('account_model');
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      ini_set('memory_limit', '-1');
      $date = '2016-08-08'; 

      echo $date;
      echo "<br>";
      echo "<br>";
      $emailsNotYetVerified = $this->account_model->getAllEmailAfter($date);
      $emailsVerified = $this->account_model->getAllVerifiedEmail();
      $oneDimensionalArray = array_map('current', $emailsVerified);
      $oneDimensionalArray2 = array_map('current', $emailsNotYetVerified);

      $oneDimensionalArray = array_map('strtolower', $oneDimensionalArray);
      $oneDimensionalArray2 = array_map('strtolower', $oneDimensionalArray2);
      $diff_email = array_diff($oneDimensionalArray2,$oneDimensionalArray);
      $diff_email = array_unique($diff_email);
      $number = 1;
          foreach ($diff_email as $value) {
              $emailaddress = $value;
              echo $numer;
              $trimEmail = preg_replace('/\s+/', ' ', trim($emailaddress));
                if ($this->legitimateEmailChecker($trimEmail)) {
                  echo $number.'. ';
                  echo $trimEmail;

                  $insert = array(
                       'email' => $trimEmail,
                       'Language' => 'EN',
                       'recipient_type' => '1'
                   );

                  $this->account_model->insertmailer_test_recipients($insert);
                  print_r($insert);          

                }
              $number++;
              echo "<br>";

          }
    }

    public function getallemailsVerified(){
      $this->load->model('account_model');
      $emailsVerified = $this->account_model->getAllVerifiedEmail();
      echo json_encode($emailsVerified);
    }

    public function getallgetAllEmailAfter(){

      $this->load->model('account_model');

      $emailsVerified = $this->account_model->getAllEmailAfter();

      echo json_encode($emailsVerified);
      
    }

    public function mailSingaporeCron(){
      $this->load->model('account_model');
      $selectAllUnsentEmailforSingapore = $this->account_model->selectAllUnsentEmailforSingapore();
      // var_dump($selectAllUnsentEmailforSingapore);
      // print_r($selectAllUnsentEmailforSingapore);
       foreach ($selectAllUnsentEmailforSingapore as $value) {
        // 1473321122
        if ($value['start_date'] < strtotime('now') ) {
            echo $value['email'];
            echo $value['start_date'];
            echo "<br>";
            
            if ($value['type']==1) {
              $this->singaporePartner($value['email']);
            }else{
              $this->singaporeClient($value['email']);
            }

            $this->account_model->selectAllUnsentEmailforSingaporeCounter($value['id']);
        }

       }


    }

    public function getAllDistinctEmail(){

        $this->load->model('Mailer_model');
        $getAllDistinctEmail = $this->Mailer_model->getAllDistinctEmail();

        foreach($getAllDistinctEmail as $user){
            $email = trim($user['email']);

            $getRecipientDetails = $this->Mailer_model->getRecipientDetails($email);

            if(!$getRecipientDetails){
                $insert = array(
                    'Email' => $email
                );
                $this->Mailer_model->insert_dynamic('mailer_test_recipients',$insert);
                echo '<pre>',print_r($email,1),'</pre>';
            }

        }

    }

    public function runPeriodicMailer(){

        $this->load->model('Mailer_model');

        $dateToday = date('Y-m-d');

        $getAllPeriodicMailer = $this->Mailer_model->getAllPeriodicMailer($dateToday);

        if(!$getAllPeriodicMailer){
            exit;
        }

        FXPP::print_data($getAllPeriodicMailer);exit;

        foreach($getAllPeriodicMailer as $mailer){

            $className = 'Fx_mailer';
            $methodName = $mailer['MethodName'];

            if(is_callable(array($className, $methodName))){
                $args = array(
                    $mailer['Email'],
                    $mailer['Fullname'],
                    $mailer['Unsubscribe_key']
                );
                $callFunction = call_user_func_array(array($className, $methodName), $args);
                if($callFunction){
                    $updateData = array(
                        'Counter' => $mailer['Counter'] + 1
                    );
                    $this->Mailer_model->updatePeriodicCounter($mailer['Id'], $updateData);
                }
            }
        }

    }

    public function tester(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        FXPP::test_this();
    }
    // emdf

    //gil

    public function getAllClientToStaging(){
      for($x = 1;$x <= 500; $x++){
          $ch = curl_init();
          $data = $this->General_model->getClientByDate('2016-12-09','2017-01-25');
          // if(empty($data)){
          //   echo '1';
          //   break;
          // }
          // print_r($data);
          // exit;
          curl_setopt($c, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
          curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/test/GetAllClientFromLive");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $server_output = curl_exec($ch);
          curl_close ($ch);
          var_dump($server_output);
          foreach ($data as $key => $value) {
            $counter_staging = array('Counter_to_staging' => 1);
            $this->General_model->updatemy('mailer_periodic','Id',$value['Id'],$counter_staging);
          }
      }
    }

    public function test_yahoo(){
        $email = $_GET['email'];
        $dateToday = date('Y-m-d H:i:s');

         $periodicSequence = array(
                'HowToGetStarted',
                'ThirtyPercentBonus',
    //            'HundredPercentBonus', //removed - logic in internal not yet done
                'importantInstruments',
                'LasPalmas',
                'EuroLicense',
                'depositInsurance',
                'moneyfallContest',
                'callbackServices',
                'affiliate_program',
                'vpsServices',
                'leverage',
                'mt5',
                'rpj_racing_cooperation',
                'web_terminal',
                'mobile_platform_periodic'
            );
        //yahoo mail detector
        $parts = explode("@", $email);
        $username = $parts[1];
        $domain = explode(".", $parts[1]);

        if ($domain[0] == 'yahoo' or $domain[0] == 'ymail' or  $domain[0] == 'rocketmail') {
            $yahoomail = true;
        }
        foreach($periodicSequence as $key => $method){

            // $getMailerByRecipientId = $CI->Mailer_model->getMailerByRecipientId($method, $recipientId);
            // if(!$getMailerByRecipientId){
                $day = $key + 1;
                $dateTomorrow = date('Y-m-d H:i:s', strtotime($dateToday.' +'.$day.' day'));

                $unsubscribeKey = FXPP::generateUnsubscribeKey();
                $insert = array(
                    'RecipientId' => $recipientId,
                    'MethodName' => $method,
                    'DateRegistered' => $dateToday,
                    'DateAvailable' => $dateTomorrow,
                    'Unsubscribe_key'   => $unsubscribeKey
                );
                if($yahoomail == true){
                    $insert['Counter'] = 1;
                }

                print_r($insert);
                // $CI->Mailer_model->insert_dynamic('mailer_periodic',$insert);
            //}
        }
    }
    public function testing_mail_send(){

              
              Fx_mailer::moneyfallContest('test.client.0334@gmail.com','Client','oV4eNtYuDwwwDWKaODul9Aso');
              // Fx_mailer::partnerHKM('mcleen.paloma@gmail.com','Client','1231242455');
              // Fx_mailer::HowToGetStartedRussian('newbee4test14@gmail.com','Client','1231242455');
              // Fx_mailer::partnerWelcome('newbee4test14@gmail.com','Client','1231242455');
              // Fx_mailer::partnerWelcomeRussian('newbee4test14@gmail.com','Client','1231242455');
              // Fx_scheduled_mailer::showfx_the_parkPartner('mailing_test_group@forexmart.com','1231242455','Partner');
              // Fx_scheduled_mailer::showfx_the_parkRussian('mailing_test_group@forexmart.com','1231242455','Клиенты');
              // Fx_scheduled_mailer::showfx_the_parkRussian_partner('mailing_test_group@forexmart.com','1231242455','Партнеры');
              // Fx_mailer::HowToGetStarted('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::mt5('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::leverage('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::ThirtyPercentBonus('newbee4test17@gmail.com','Клиент','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::LasPalmas('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::leverage('newbee4test17@gmail.com','Клиент','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::depositInsurance('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::moneyfallContest('newbee4test17@gmail.com','трейдеры','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::callbackServices('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::vpsServices('newbee4test17@gmail.com','клиент','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::rpj_racing_cooperation('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::affiliate_program('newbee4test17@gmail.com','Клиент','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::web_terminal('newbee4test17@gmail.com','клиент','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::mobile_platform_periodic('newbee4test17@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerWelcome('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerGettingStarted('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerLasPalmas('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerBanner('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerBenenfitsForClient('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::PartnerEuroLicense('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerCallBack('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerHKM('newbee4test17@gmail.com','Partner','oV4eNtYuDDWKaODul9Aso');


              // Fx_mailer::partnerWelcomeRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerGettingStartedRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerLasPalmasRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerBannerRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerBenenfitsForClientRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::PartnerEuroLicenseRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerCallBackRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              // Fx_mailer::partnerHKMRussian('newbee4test15@gmail.com','клиенты','oV4eNtYuDDWKaODul9Aso');
              


    }

public function testmail_to(){
    $this->load->model('Mailer_model');
    $emailContent = $this->Mailer_model->getTradeOfferContent()['0'];

    // print_r($emailContent);
  Fx_mailer::tradermailer('mottakaquezo68@gmail.com', '001231515135', $emailContent);
}
    public function check_opened_mail(){
      // echo date('Y-m-d');
      // exit;
      // $this->load->model('General_Model');

      // $data = $this->General_Model->show_mailer_periodic_emailTracker('2017-03-23');
      // print_r($data);
      print_r(date('Y-m-d 22:59:59', strtotime('last friday', strtotime('yesterday'))));
    }

    public function mt4_test(){
        $this->lang->load('metatrader4');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

        $data['data']['metadata_description'] = lang('mt4_dsc');
        $data['data']['metadata_keyword'] = lang('mt4_kew');
        $data['data']['form'] = Form_key::InputKey_array();
        $this->template->title(lang('mt4_tit'))
          ->set_layout('external/main')
          ->append_metadata_css("
                                <link rel='stylesheet' href='" . $this->template->Css() . "/mt4.css'>
                            ")
          ->build('external_MetaTrader4', $data['data']);
    }

    public function query(){
      $this->load->model('General_model');
      $results = $this->General_model->showsfields('users','*');

      print_r('1');
    }
    //testing zoffmyan10
    public function testing_rpj(){
      $email = 'gil@f.zetaol.com';
      $Unsubscribe_key = 'lPfZfzaLRWP8zLMbpelc2';
      Fx_mailer::rpjmail_russian($email,$Unsubscribe_key);
      Fx_mailer::rpjmail($email,$Unsubscribe_key);
    }

public function analytical_reviews_client(){
  exit;
  $email = 'js3493111@gmail.com ';
  $Unsubscribe_key = 'lPfZfzaLRWP8zLMbpelcX';
   echo $email;
   echo "</br>";
   echo $Unsubscribe_key;
   Fx_mailer::analytical_reviews_russian_partner($email,$Unsubscribe_key);
   echo "</br>";
   echo "</br>";
   echo "</br>";
   echo "</br>";
   Fx_mailer::analytical_reviews_russian_client($email,$Unsubscribe_key);   
   echo "</br>";
   echo "</br>";
   echo "</br>";
   echo "</br>";
   Fx_mailer::analytical_reviews_english_client($email,$Unsubscribe_key);
  echo "</br>";
   echo "</br>";
   echo "</br>";
   echo "</br>";
   Fx_mailer::analytical_reviews_english_partner($email,$Unsubscribe_key);
}

  public function LasPalmas(){
    $email = 'js3493111@gmail.com';
    $Unsubscribe_key = 'lPfZfzaLRWP8zLMbpelcX';
    $email = 'newbee4test1@gmail.com';
    $Unsubscribe_key = 'lPfZfzaLRWP8zLMbpelcX';
    // $email = 'mailing_test_group@forexmart.com';
    // $Unsubscribe_key = 'lPfZfzaLRWP8zLMbpelc2';
    echo $email;
    echo $Unsubscribe_key;
    //partner
    Fx_mailer::lasPalmasVipTicket($email,$Unsubscribe_key,'Partner');
    // client
    Fx_mailer::lasPalmasVipTicket($email,$Unsubscribe_key,'Client');
    // trader 
    Fx_mailer::lasPalmasVipTicket($email,$Unsubscribe_key,'Trader');

    // all Russian
    Fx_mailer::lasPalmasVipTicket_russian($email,$Unsubscribe_key);
  }


    public function forMassMailingLasPalmas(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        $this->load->model('Mailer_model');
        $getAllSubscribeMassMailer = $this->Mailer_model->getAllSubscribeMassMailer();
        foreach($getAllSubscribeMassMailer as $user){
          $email = trim($user['Email']);
        $isEmailUnique = $this->Mailer_model->massmailuniq2($email);
        if ($isEmailUnique) {
          $lang = $user['Language'];
          $Unsubscribe = $user['Unsubscribe_key'];
          echo '<pre>',print_r($email,1),'</pre>';
              $insert = array(
                    'email' => $email,
                    'language' => $lang,
                    'unsubscribe' => $Unsubscribe,
                );
                $this->Mailer_model->insert_dynamic('MassMailerConnection',$insert);
              }else{
                echo "noooooooooooo";
                echo "<br>";
              }
        }
    }


public function manualUnsubscribe(){
  $removeEmail = array("email@email.com");
    $this->load->model('Mailer_model');
    foreach($removeEmail as $email){
          echo '<pre>',print_r($email,1),'</pre>';
          echo $this->Mailer_model->manualUnsubscribe($email);
    }
}


    public function ndb(){

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');

        $this->email->to('bug.fxpp@gmail.com');
        $email_data = array(
            'title' => 'Countdown to Limited Bonus! Get it now!'
        );

        $this->email->subject( $email_data['title']);
        $this->email->message($this->load->view('email/ndb_24', $email_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
        echo "end";
        exit();
    }

  public function transferRU(){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('memory_limit', '-1');
    $this->load->model('Mailer_model');

    $getAllSubscribeMassMailer = $this->Mailer_model->getAllRUIn_mailer_test_recipients();

    foreach ($getAllSubscribeMassMailer as $key => $value) {
      echo $value['Email'];
      echo "<br>";
      // change language to RU
                                $data = array(
                                    'Language' => 'RU'
                                );
      $this->Mailer_model->updateMassMail($value['Email'],$data);
    }
  }

  public function removePeriodic(){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('memory_limit', '-1');
    $this->load->model('Mailer_model');
    $getAllSubscribeMassMailer = $this->Mailer_model->getAllPeriodicEmail();

    foreach ($getAllSubscribeMassMailer as $key => $value) {
      echo $value['Email'];
      echo "<br>";
      $data = array(
        'tagForRPJ' => '1'
      );
      $this->Mailer_model->updateMassMail($value['Email'],$data);



    }

  }



    public function scheduleForRPJ(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        $this->load->model('Mailer_model');
        $mailerId = 2;
        $getAllSubscribeMassMailer = $this->Mailer_model->getAllSubscribeMassMailer2();

        foreach($getAllSubscribeMassMailer as $user){
          $email = trim($user['Email']);
          $isEmailUnique = $this->Mailer_model->massmailuniq2($email,$mailerId);
          if ($isEmailUnique) {
            $lang = $user['Language'];
            $Unsubscribe = $user['Unsubscribe_key'];
            echo '<pre>',print_r($email,1),'</pre>';
                $insert = array(
                      'email' => $email,
                      'language' => $lang,
                      'unsubscribe' => $Unsubscribe,
                      'mailerId' =>  $mailerId
                  );
                  $this->Mailer_model->insert_dynamic('MassMailerConnection',$insert);
          }else{
                  echo "noooooooooooo";
                  echo "<br>";
          }

        }
    }



    public function scheduleForVIP(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        $this->load->model('Mailer_model');
        $mailerId = 8;
        $getAllSubscribeMassMailer = $this->Mailer_model->getAllSubscribeMassMailer2();

        foreach($getAllSubscribeMassMailer as $user){
          $email         = trim($user['Email']);
          $isEmailUnique = $this->Mailer_model->massmailuniq2($email,$mailerId);
          $login_type    = $user['Login_type'];
          $lang          = $user['Language'];
          echo $email;
          echo "Login_type = ";
          echo $login_type;
          echo "        <  lang  == >";
          echo $lang;
          echo "<br>";

          if ($isEmailUnique) {
            $Unsubscribe = $user['Unsubscribe_key'];
            echo '<pre>',print_r($email,1),'</pre>';
                $insert = array(
                      'email' => $email,
                      'language' => $lang,
                      'unsubscribe' => $Unsubscribe,
                      'mailerId' =>  $mailerId,
                      'login_type' =>  $login_type
                  );



             // print_r($insert);
                  $this->Mailer_model->insert_dynamic('MassMailerConnection',$insert);
          }else{
                  echo "noooooooooooo";
                  echo "<br>";
          }

        }
    }

    public function change_error_details(){
      $this->load->model('general_model');
      $results = $this->general_model->show_all('mt_accounts_set','registration_time','0001-01-01 00:00:00','*');
// print_r($results);
// exit;
      foreach($results as $key => $result){
        if($result['account_number'] != null){
            if($result['mt_type'] == 1){
                  $webservice_config = array(
                      'server' => 'live_new'
                  );
            }else{
                $webservice_config = array(
                      'server' => 'demo_new'
                  );
            }

            $WebService4 = new WebService($webservice_config);
                $account_info2 = array(
                    'iLogin' =>  $result['account_number']
                    // 'iLogin' =>  '184904'
                );
                $WebService4->request_account_details($account_info2);
                $res = $WebService4->get_result('RegDate');
                //$this->general_model->updatemy($table = "mt_accounts_set", "account_number", $result['account_number'], array('registration_time' => date('Y-m-d H:i:s', strtotime($res))));
        }
      }
    }

    public function change_error_details_users(){
        $this->load->model('general_model');
        $results = $this->general_model->show_all('users','created','0001-01-01 00:00:00','*');
        foreach($results as $result){
            $result_ac_num = $this->general_model->show_all('mt_accounts_set','user_id',$result['id'],'*');
            if($result_ac_num[0]['account_number'] != null){
                if($result_ac_num[0]['mt_type'] == 1){
                    $webservice_config = array(
                      'server' => 'live_new'
                    );
                }else{
                      $webservice_config = array(
                      'server' => 'demo_new'
                      );
                }
                $WebService4 = new WebService($webservice_config);
                $account_info2 = array(
                    'iLogin' =>  $result_ac_num[0]['account_number']
                    // 'iLogin' =>  '184904'
                );
                $WebService4->request_account_details($account_info2);
                $res = $WebService4->get_result('RegDate');
                //$this->general_model->updatemy($table = "users", "id", $result_ac_num[0]['user_id'], array('created' => date('Y-m-d H:i:s', strtotime($res))));
                echo $result_ac_num[0]['user_id'].'<br>';
            }
        }
        exit;
        print_r($results);
    }

    
    public function contestArchiveTest(){
        date_default_timezone_set('Europe/Minsk');
        $this->load->model('account_model');
        $contest_date_start =  date('Y-m-d 23:00:00', strtotime('last sunday', strtotime('tomorrow')));
        $contest_date_end   =  date('Y-m-d 22:59:59', strtotime('sunday', strtotime($contest_date_start)));
        $date_now = date('Y-m-d H:i:s', strtotime('now'));

        echo $contest_date_start ;
        echo "<br>"              ;
        echo $contest_date_end   ;
        echo "<br>"              ;
        echo $date_now           ;
        echo "<br>"              ; 
        echo "<br>"              ;

        if( strtotime($date_now) <= strtotime($contest_date_end) && strtotime($date_now) >= strtotime($contest_date_start)) {
          //Get last week monday to sunday contest registrants
          $start_date = date('Y-m-d  23:00:00', strtotime('last sunday -1 week', strtotime('tomorrow')));
          // $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
          $end_date   = date('Y-m-d 22:59:59', strtotime($start_date . ' +1 week'));
          echo $start_date        ;
          echo "<br>"             ;
          echo $end_date          ;
          echo "<br>"             ;
        

            $contest_winners = $this->account_model->getContestAccountsByDateRange($start_date, $end_date);

            echo '<pre>';
            print_r($contest_winners);
          }else{
            echo "test";
          }

    }


    public function test_deposit_bonus(){
        print_r($this->session->userdata());
        exit;
        FXPP::DepositBonus($this->session->userdata('user_id'), '207192', '1', 'neteller', 'fpb', '29739953');
        FXPP::Deposit100PercentBonus($this->session->userdata('user_id'),'207192','1', 'megatransfer', 'hplb','29739953');
    }

    public function limited(){
        $this->load->model('account_model');
        $this->load->library('WebService');
        $date_from = date('Y-m-d 00:00:00', strtotime(' -1 day'));
        $date_now = date('Y-m-d 23:59:59', strtotime(' -1 day'));

        $limited_bonus = array();

        if($limited = $this->account_model->getLimitedBonusByDate($date_from,$date_now)){

            foreach($limited as $d){
                $ref = "N/A";
                if(strlen($d->reference_num)>1){
                    $ref = $d->referral_affiliate_code.':'. $d->reference_num;
                }
                $limited_bonus[$d->account_number] = array('ref'=>$ref, 'country' => $d->country );
            }
        }


        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->getFinanceRecordByComment('FOREXMART LIMITED BONUS', $date_from, $date_now);
        $finance_data = array();
        if($WebService->request_status == 'RET_OK'){
            $finance_records = $WebService->get_result('FinanceRecords');
            $finance_data = $finance_records->FinanceRecordData;

        }

        $email_data = array(
            'finance_data'=>$finance_data,
            'subject'   => 'Limited Bonus Report['.date('Y-m-d', strtotime(' -1 day')).']'
        );
        $email_data['limited'] = $limited_bonus;

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //$this->email->to('agus@forexmart.com');
        $this->email->to('bug.fxpp@gmail.com');
        $this->email->bcc('bug.fxpp@gmail.com');
//
        $this->email->subject($email_data['subject']);
        $this->email->message($this->load->view('email/limited_bonus_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

        //print_r($data);
    }

    public function ndbAndlimitedBonusReport(){
        $this->load->model('account_model');
        $date_from = date('Y-m-d 00:00:00', strtotime(' -8 day'));
        $date_now = date('Y-m-d 23:59:59', strtotime(' -1 day'));
        $email_data = array(
            'bonus_data'=>$this->account_model->ndbAndLimitedBonusReport($date_from,$date_now),
            'subject'   => 'NDB/Limited Bonus Applicant Report'
        );


        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('agus@forexmart.com');
        //$this->email->to('bug.fxpp@gmail.com');
        $this->email->bcc('bug.fxpp@gmail.com');
//
        $this->email->subject($email_data['subject']);
        $this->email->message($this->load->view('email/ndb_and_hpb_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }

public function testHundredPercent(){
  date_default_timezone_set('Europe/Minsk');
  $todayMinus3days =  date('Y-m-d H:i:s', strtotime('-3 day', strtotime(date('Y-m-d H:00:00'))));
  $plus1hr =  date('Y-m-d  H:i:s', strtotime('+1 hour', strtotime($todayMinus3days)));
  // get all by todayMinus3days on  no deposit bonus is_sent_3days 0 
  $this->load->model('account_model');
  echo $todayMinus3days;
  echo "<br>";
  echo $plus1hr;

  $ndbRequest = $this->account_model->getAllNdbRequestByDate($todayMinus3days, $plus1hr);

  foreach ($ndbRequest as $key => $value) {
    if (!$this->account_model->checkIdOnDeposittable($value['id'])) {
        echo $value['email'];
        echo '<br>';
    // Fx_mailer::HundredPercentBonus($value['email']);
    }
    // working 
    //  $is_sent_3days = array('is_sent_3days' => '1' );
    // $this->account_model->updateUserDetails('no_deposit', 'id', $value['id'], $is_sent_3days);
  }
}

public function HundredPercentBonus_mailTest(){
  $to = 'friend4test0001@yahoo.com';
  Fx_mailer::rpjmail_russian($to);

  }


    public function moneyFallContest(){

        $this->load->model('account_model');
        $this->load->library('WebService');
        $from =  date('Y-m-d 00:00:00', strtotime('last week monday', strtotime('tomorrow')));
        $to = date('Y-m-d 01:00:00', strtotime('last saturday', strtotime('yesterday')));

        $config = array(
            'server' => 'tradings'
        );

        echo "<pre>";
        $data = array();
        $WebService = new WebService($config);
        if($account = $this->account_model->getWeekContestWinnersByDates($from, $to)){

            foreach($account as $d){

                $account_info = array(
                    'iLogin' => $d->account_number,
                    'start_date' => $from,
                    'end_date' => $to
                );


                $WebService->GetMoneyFallContestReport($account_info);
                if ($WebService->request_status === 'RET_OK') {
                    $web = $WebService->get_all_result();
                    $data[] = array(
                        'login' =>$d->account_number,
                        'name'=>$d->nickname,
                        'balance'=>$d->amount,
                        'email'=>$d->email,
                        'LessThen2MinutesOrdersCount'=>$web['LessThen2MinutesOrdersCount'],
                        'EURUSD'=>$web['ProfitLossPercentageEURUSD'],
                        'USDJPY'=>$web['ProfitLossPercentageUSDJPY'],
                        'duplicate'=>$d->num
                    );

                }
            }

            $email_data = array(
                'moneyFall'=>$data,
                'subject'   => 'MoneyFall Contest Results'
            );

            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('agus@forexmart.com');
           // $this->email->to('bug.fxpp@gmail.com');
            $this->email->bcc('bug.fxpp@gmail.com');
//
            $this->email->subject('MoneyFall Contest Results');
            $this->email->message($this->load->view('email/moneyFallContest', $email_data, TRUE));
            if($this->email->send()){
                //echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }

            print_r($data);


        }
    }

    public function test_single_query(){
      $this->load->Model('General_model');
      $data['mt_accounts_set'] = $this->g_m->showssingle($table = "partnership", "partner_id", '134362', "reference_num, currency", '');

       $data['users'] = $this->g_m->showssingle($table = "users", "id", '134362', "*", '');
      print_r($data['users']['login_type']);
    }



#this is for mail
  public function test_economic_calendar() {
    // exit;
    // saving first high volatile to db,then send the last record
          $to = "test.02914@gmail.com";
          $unsubscribe = 'p5VaF0qwHTREp5gLsPaW5';
          echo $to;
          Fx_mailer::test_economic_calendar($to,$unsubscribe ,$res);
  }

  public function trader_offer_mailing() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');

        $server = array('server' => 'trading');
        $WebService = new WebService($server);

        $from =  date('Y-m-d\T00:00:00', strtotime('last monday', strtotime('today')));
        $to = date('Y-m-d\T23:59:59', strtotime('friday', strtotime($from)));

        // date("M j,Y",strtotime($cd));
        $test = array(
            'from' =>$from,
            'to' => $to
        );
        // var_dump($test);
        $res = (array) $WebService->getmosttraded($test);
        $res = $res['results'];
        // print_r($res);
        if( $res['ReqResult'] == 'RET_OK' ) {
            $date = new DateTime($res['FromDate']);
            $res['FromDate'] = $date->format('d-M Y g:i e');
          // $to = 'test.02914@gmail.com';
          $unsubscribe = 'p5VaF0qwHTREp5gLsPaW5';
            
          $to = 'mottakaquezo68@gmail.com';
          echo $to;
          Fx_mailer::tradermailer($to,$unsubscribe ,$res);
          echo "<br>";
          echo "<br>";
          echo "<br>";
          Fx_mailer::tradermailerRussian($to,$unsubscribe ,$res);

        }else{
                $data['most'] = 'No result';
        }


  }



  public function MassMailer(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        $this->load->model('Mailer_model');
        $this->load->model('account_model');
        $NewlyRegForMassmailer = $this->account_model->getNewlyRegForMassmailer(date('Y-m-d', strtotime('now')));
        var_dump($NewlyRegForMassmailer);
        exit;
        foreach ($NewlyRegForMassmailer as $key => $value) {
           $isEmailUnique = $this->Mailer_model->massmailuniq($value['email']);
          if ($isEmailUnique) {
              echo "<br>"; 
                $fullname = "Client";

                  if($value ['login_type'] == '1') {
                    $fullname = "Partner";
                  }

                  if (!empty($value['full_name'])) {
                     $fullname = $value['full_name'];  
                  }

              if($value['country'] == 'RU') {
                $lang = 'RU';
              }else{
                $lang = 'EN';
              }
                    $Unsubscribe_key = FXPP::generateUnsubscribeKeyMassMailer();
                    $insert = array(
                        'Email' => $value['email'],
                        'Full_name' => $fullname,
                        'Language' => $lang,
                        'Login_type' => $value['login_type'],
                        'Unsubscribe_key'   =>  $Unsubscribe_key
                    );   
          $this->Mailer_model->insert_dynamic('MassMailer',$insert);

          self::postToStaging($insert);

          }
      }
      echo "finished";
  }


  public function postToStaging($array){
        $ch = curl_init();
        $insert = array(
            'Email' => $array['Email'],
            'Full_name' => $array['Full_name'],
            'Language' => $array['Language'],
            'Login_type' => $array['Login_type'],
            'Unsubscribe_key'   =>  $array['Unsubscribe_key']
        );

        curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/Unsubscribe/insertToMassMailer");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $insert);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }

#this is for mail end

    public function moneyFallContest1(){

        $this->load->model('account_model');
        $this->load->library('WebService');
        $from =  date('Y-m-d 00:00:00', strtotime('last week monday', strtotime('tomorrow')));

       // $from =  date('2016-12-26 00:00:00');
        $to = date('Y-m-d 01:00:00', strtotime('last saturday', strtotime('yesterday')));

        //$to =  date('2016-12-31 01:00:00');

        $config = array(
            'server' => 'tradings'
        );

       //  echo "<pre>";

        $data = array();
        $WebService = new WebService($config);
        if($account = $this->account_model->getWeekContestWinnersByDates($from, $to)){

            foreach($account as $d){

                $account_info = array(
                    'iLogin' => $d->account_number,
                    'start_date' => $from,
                    'end_date' => $to
                );


                $WebService->GetMoneyFallContestReport($account_info);
                if ($WebService->request_status === 'RET_OK') {

                    $num = $d->num;
                    if($d->num >1){
                        $num = $this->account_model->getWeekContestWinnersByEmail($d->email);
                    }
                    $web = $WebService->get_all_result();
                    $data[] = array(
                        'login' =>$d->account_number,
                        'name'=>$d->nickname,
                        'balance'=>$d->amount,
                        'email'=>$d->email,
                        'dup' =>$d->dup, // duplicate email of this contest
                        'LessThen2MinutesOrdersCount'=>$web['LessThen2MinutesOrdersCount'],
                        'EURUSD'=>$web['ProfitLossPercentageEURUSD'],
                        'USDJPY'=>$web['ProfitLossPercentageUSDJPY'],
                        'duplicate'=>$num,
                        'instruments' =>$web['ProfitLossAdditionalInstrumentsPercentage'],
                        'profitlosspercentage'=> $web['LessThen2MinutesOrdersProfitLossPercentage'],
                        'allOrder'=> $web['AllOrdersCount']
                    );

                }
            }
//print_r($data); exit();
            $email_data = array(
                'moneyFall'=>$data,
                'subject'   => 'MoneyFall Contest Results'
            );

            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
            //$this->email->to('agus@forexmart.com');
            $this->email->to('mf_participants@forexmart.com');
            $this->email->bcc('agus@forexmart.com,bug.fxpp@gmail.com');
//
            $this->email->subject('MoneyFall Contest Results');
            $this->email->message($this->load->view('email/moneyFallContest_test', $email_data, TRUE));
            if($this->email->send()){
                //echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }

            // print_r($data);


        }
    }

    public function test_bulletin(){
      // var_dump(Fx_mailer::bulletin_noreply('lucas4test@outlook.com',  'noreply@bulletin.forexmart.com', "","",'body','test'));
      // var_dump(Fx_mailer::Mailersender_singapore('mottakaquezo68@gmail.com',  'marketing@notify.forexmart.com', 'body','test'));
      $to = 'mottakaquezo68@gmail.com';
      echo $to;
      Fx_mailer::HundredPercentBonus_russian($to);

    }



    public function unsubForTradeOffer(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
      @ini_set('max_execution_time',0);
      $this->load->Model('Mailer_model');
      $this->load->Model('General_model');
      // geting the unsubscribe key.
      foreach ($this->Mailer_model->getAllMailerTestRecipients(57000) as $key => $value) {
        $value['unsubscribekey'] = FXPP::generateUnsubscribeKeyForTradeOffer();
        $this->General_model->updatemy('mailer_test_recipients','Id',$value['Id'],$value);
      }
    } 
    // ---------------------------as reference

    public function removeThisEmail(){
      // for removing emails
      $arrayName = array('Senoch89@yahoo.com',
                'efinance67@yahoo.ca');

      $this->load->Model('General_model');

      foreach ($arrayName as $key => $value) {
        echo $value;
        echo '<BR>';
        // $this->general_model->updatemy($table = "mailer_test_recipients", "Email", $value, array('Active' => '0'));
        $this->general_model->updatemy($table = "MassMailer", "Email", $value, array('Unsubscribe' => '1'));
      }


    }


    public function ndbAndlimitedBonusReport1(){
        $this->load->model('account_model');
        $date_from = date('Y-m-d 00:00:00', strtotime(' -7 day'));
        $date_now = date('Y-m-d 23:59:59', strtotime(' -1 day'));
        $email_data = array(
            'bonus_data'=>$this->account_model->ndbAndLimitedBonusReport($date_from,$date_now),
            'subject'   => 'NDB/Limited Bonus Applicant Report'
        );


        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //$this->email->to(' ad-stats_2@forexmart.com');
        $this->email->to('agus@forexmart.com');
        $this->email->bcc('bug.fxpp@gmail.com');
        $this->email->subject($email_data['subject']);
        $this->email->message($this->load->view('email/ndb_and_hpb_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }




  public function upload(){
    // phpinfo();
    // exit;
    ini_set('upload_max_filesize', '10M');
    ini_set('post_max_size', '10M'); 
    ini_set('memory_limit', '1024M');
      // ini_set('display_errors', 1);
      error_reporting(E_ALL);
     print_r($_FILES);

      if(!empty($_FILES['file']['name'])){
          $this->load->helper(array('form', 'url'));
          $_FILES['userfile']['name']    = $_FILES['file']['name'];
          $_FILES['userfile']['type']    = strtolower($_FILES['file']['type']);
          $_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
          $_FILES['userfile']['error']       = $_FILES['file']['error'];
          $_FILES['userfile']['size']    = $_FILES['file']['size'];
          $config['file_name']=  hash('sha384',$_FILES['userfile']['name']);// hash for external pages.
          $config['upload_path'] = '/var/www/html/my.forexmart.com/assets/user_docs/';
          $config['allowed_types'] = 'gif|JPG|JPEG|jpg|jpeg|png|bmp|pdf';
          $config['max_size']      = 15000;
          $config['max_width']     = '0';
          $config['max_height']    = '0';
          $config['overwrite']     = false; //DO NOT CHANGE
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          try{
              if($this->upload->do_upload()){
                  $uploadData = $this->upload->data();
                  $updData = array(
                      'user_id' => 1,
                      'doc_type' => $this->input->post('doc_type',true),
                      'file_name' => $uploadData['file_name'],
                      'client_name' => $uploadData['client_name'],
                      'status' => 0,
                  );
                  $this->load->library('image_lib');
                  $config['source_image'] = "/var/www/html/my.forexmart.com/assets/user_docs/". $uploadData['file_name'];

                  FXPP::setWaterMark($config['source_image']);
                  $this->g_m->insertmy($table="user_documents",$updData);
                  $data['error'] = false;
                  $data['msg'] = $this->image_lib->display_errors();
                  $data['msgError_ext']=false;
              }else{
                echo "failed";

              }
          } catch(Exception $e){
                echo "failed";
          }

      }else{
          $data['msgError'] = 'Please select a file.';
          $data['error'] = true;
      }
      echo json_encode($data);
  }



  public function mailtranslation(){
        $to = 'uness1954@gmail.com';
        $email = trim($to);
        $password = 'PWD-03';
        // send email  to user email
        $email_data = array(
            'full_name' => 'Test25-03',
            'email' => $email,
            'password'=> $password,
            'user_id' => $email,
            'header' => 'ForexMart Mwp account details',
            'title' => 'An account has been created for you to be able to access ForexMart Mwp Admin Panel.'
            //'account_number'=> '25012501',
            //'trader_password'=> 'TRDRPWD-03',
            //'investor_password'=> 'INVSTRPWD-03',
            //'phone_password'=> 'PHNPWD',
        );
        //$subject = "ForexMart MT4 Live Trading Account details";
        $config = array(
            'mailtype'=> 'html'
        );
        $isSendSuccess = $this->general_model->sendEmail('manage_access-html', "ForexMart Team", $email_data['email'], $email_data, $config);
        var_dump($isSendSuccess);
    }

  public function test_decline(){
      $data = array(
            'SelectedReason' => 'Reason',
            'ReasonExplanation' => 'Explanation',
            'Email' => 'uness1954@gmail.com',
            'AccountNumber' => '123456',
            'FullName' => 'test25',

            'ClientName0' => 'cn0',
            'FileName0' => 'fn0',
            'DocIdx0' => 'doc0',

            'ClientName1' => 'cn1',
            'FileName1' => 'fn1',
            'DocIdx1' =>'doc1',

            'ClientName2' => 'cn2',
            'FileName2' => 'fn2',
            'DocIdx2' => 'doc2'
      );
      print_r($data); 
      Fx_mailer::AccountVerificationDeclinedBothDocuments($data);
  }

    public function reSentPartner(){
        $partnership_authdetails = array(
            'email' => "tutankhomon-ra@mail.ru",
            'password' => "1AJpcCU",
            'fullname' => "ilgar gadirov",
            'phone_password' => "AfrFbl3",
            'account_number'=>'236836',
            'trader_password' =>"1AJpcCU"
        );

        $partnership_affiliate = array(

            'affiliate_code' => "XYEBN",
        );


        Fx_mailer::partners_registration_resend($partnership_authdetails,$partnership_affiliate);
        echo "sent";
        exit();
    }

    public function testingNumberOfDeposit(){
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M'); 
        ini_set('memory_limit', '1024M');
        $this->load->model('account_model');
        print_r($this->account_model->getnumberOfDeposit('newbee4test5@gmail.com'));
    }


    public function economicCalendar(){
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      ini_set('memory_limit', '-1');
      $this->load->model('Calendar_model');
        $date_start =  date('Y-m-d 00:00:00', strtotime('last monday', strtotime('tomorrow')));
        $date_end = date('Y-m-d 23:59:59', strtotime('friday', strtotime($date_start)));
// $date_start = '2016-02-27 23:59:59' ;
// $date_end = '2017-02-27 00:00:00';
        echo $date_start;
        echo $date_end;
        echo "<br>";
      foreach ($this->Calendar_model->getCalendar($date_start,$date_end) as $key => $value) {

        switch ($value['Country']) {
          case 'au':
            $value['currency'] = "AUD";
            break;
          case 'ge':
            $value['currency'] = "EUR";
            break;   
          case 'fr':
            $value['currency'] = "EUR";
            break;  
          case 'it':
            $value['currency'] = "EUR";
            break;  
          case 'ja':
            $value['currency'] = "JMD";
            break;  
          case 'us':
            $value['currency'] = "USD";
            break;  
          case 'nz':
            $value['currency'] = "NZD";
            break;  
          case 'ch':
            $value['currency'] = "CHF";
            break;  
          case 'es':
            $value['currency'] = "EUR";
            break;  
          case 'eu':
            $value['currency'] = "EUR";
            break;  
          case 'uk':
            $value['currency'] = "GBP";
            break;  
          case 'ca':
            $value['currency'] = "CAD";
            break;  
          case 'cn':
            $value['currency'] = "CNY";
            break;  
          default:
            print_r($value['Country']);
            break;
        }

        print_r($value);
        echo "<BR>";
      }
    }



    public function cashBackProgram($period=1){

        exit();
        // if(!IPLoc::Office()){redirect("");}
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');

        switch( $period){
            case 1:
                $from = date('Y-m-d H:i:s', strtotime('-1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            case 2:
                $from = date('Y-m-d H:i:s', strtotime('-1 week -1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            case 3:
                $from = date('Y-m-d H:i:s', strtotime('-1 month -1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            default:
                $from = date('Y-m-d H:i:s', strtotime('+1 day')); // no calculation
                $to = date('Y-m-d H:i:s', strtotime('+1 day')); // no calculation
        }


        // echo $from."<br>".$to;
        // echo "<pre>"; //exit();
        $webservice_config = array(
            'server' => 'live_new'
        );

        if($cashBackList  = $this->account_model->getCashBackAccountList('IHXBM')){

            foreach($cashBackList as $d){

                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iAgent' => 239789 , // int Agent Account Number who pay cashback bonus
                    'iAccount' => $d->account_number, // Client account number who registered using "IHXBM" referal code
                    'from' => date('Y-m-d\T00:00:00', strtotime($from)),
                    'to' => date('Y-m-d\T23:59:59', strtotime($to))
                );

                if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){

                    if($commission->TotalAmount>0){
                        $data_input = array(
                            'agent'=>$commission->AgentLogin,
                            'account'=>$commission->FromAccount,
                            'amount'=>$commission->TotalAmount*1, // 1 is pip cashback=commission*pip
                            'pip'=>1,
                            'date'=>date('Y-m-d H:i:s')
                        );
                        $this->general_model->insert('cashback_log',$data_input);

                        //================ Commission using API ==========================================

                        $accData = $this->general_model->showssingle("mt_accounts_set", "account_number", $commission->FromAccount, "*");
                        $partnerData = $this->general_model->showssingle("partnership", "reference_num", $commission->AgentLogin, "*");

                        $conv_amount = $this->get_convert_amount($accData['mt_currency_base'], $data_input['amount'], $partnerData['currency']);
                        $config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($config);
                        $account_number = $accData['account_number'];
                        $WebService->update_live_deposit_balance($account_number, $conv_amount, "Cashback  from ".$commission->AgentLogin);
                        if ($WebService->request_status === 'RET_OK') {
                            $data['mt_ticket'] = $WebService->get_result('Ticket');
                            $WebService2 = new WebService($config);
                            $WebService2->request_live_account_balance($account_number);
                            if ($WebService2->request_status === 'RET_OK') {
                                $balance = $WebService2->get_result('Balance');
                                $this->deposit_model->updateAccountBalance($account_number, $balance);

                                // ================================== Deduct rebate commission


                                $config = array(
                                    'server' => 'live_new'
                                );
                                $WebService = new WebService($config);
                                $account_number = $commission->AgentLogin;
                                $WebService->update_live_deposit_balance($account_number, -$data_input['amount'], "Cashback to ".$commission->AgentLogin." where ".$commission->FromAccount." is account number of client");
                                if ($WebService->request_status === 'RET_OK') {
                                    $data['mt_ticket'] = $WebService->get_result('Ticket');
                                    $WebService2 = new WebService($config);
                                    $WebService2->request_live_account_balance($account_number);
                                    if ($WebService2->request_status === 'RET_OK') {
                                        $balance = $WebService2->get_result('Balance');
                                        $this->deposit_model->updatePartnerBalance($account_number, $balance);

                                    }
                                }

                                // ============================
                            }
                        }





                        // end ===============================================

                    }


                }

            }
        }
    }

    public function cashBackProgramPerHour(){

         if(!IPLoc::Office()){redirect("");}
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');

        $from = date('2017-05-29 00:01:01');
        $to = date('2017-05-29 23:59:59');


        // echo $from."<br>".$to;
        // echo "<pre>"; //exit();
        $webservice_config = array(
            'server' => 'live_new'
        );
        echo "<pre>";
        if($cashBackList  = $this->account_model->getCashBackAccountList('IHXBM')){

            //print_r($cashBackList);
            foreach($cashBackList as $d){

                // checking claim the NDB
                if($d->nodepositbonus==1){continue;} // Iggnor next step;
                // No cashback if client already has another agent (affiliate)
                if($client_ref_num =$this->account_model->getClientReferralAffiliateCode($d->email)){
                    continue;
                    //echo $d->email;
                    /* $spacial_ref_code = array(
                         'dep30','JSMUI','HEVGG','JYUOR','KTVDM','YFURM','MJLHV','VYPHE','ZAGJU','KMSdep30','s_hol_zar','s_hol_ter','s_hol_akc','s_hol_par',
                         's_tep_for','s_hol_opt','p_bezdep','p_bons','p_hol_zar','p_hol_ter','p_hol_opt','SEZPP','CJVMD','SJFTQ','VTJZV','MIRXG','EBLRV',
                         'HOEIZ','WMBZP','ODAZE','SSEOT','NKKLH','YQNKI','JLGNR'
                     );
                     if(sizeof($client_ref_num)==1){

                         if(!in_array($client_ref_num[0]['referral_affiliate_code'],$spacial_ref_code)){

                             continue;
                         }

                     }else{
                         continue;
                     }*/
                }


                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iAgent' => 239789 , // int Agent Account Number who pay cashback bonus
                    'iAccount' => 272859, // Client account number who registered using "IHXBM" referal code
                    'from' => date('Y-m-d\TH:i:s', strtotime($from)),
                    'to' => date('Y-m-d\TH:i:s', strtotime($to))
                );
                print_r($account_info);

                if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){

                    if($commission->TotalAmount>0){
                        $data_input = array(
                            'agent'=>$commission->AgentLogin,
                            'account'=>$commission->FromAccount,
                            'amount'=>$commission->TotalAmount*1, // 1 is pip cashback=commission*pip
                            'pip'=>1,
                            'date'=>date('Y-m-d H:i:s')
                        );



                        print_r($data_input);


                        //================ Commission using API ==========================================

                   /*     $accData = $this->general_model->showssingle("mt_accounts_set", "account_number", $commission->FromAccount, "*");
                        $partnerData = $this->general_model->showssingle("partnership", "reference_num", $commission->AgentLogin, "*");

                        $conv_amount = $this->get_convert_amount($accData['mt_currency_base'], $data_input['amount'], $partnerData['currency']);
                        $config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($config);
                        $account_number = $accData['account_number'];
                        $WebService->update_live_deposit_balance($account_number, $conv_amount, "Cashback");
                        if ($WebService->request_status === 'RET_OK') {
                            $data['mt_ticket'] = $WebService->get_result('Ticket');
                            $WebService2 = new WebService($config);
                            $WebService2->request_live_account_balance($account_number);
                            if ($WebService2->request_status === 'RET_OK') {
                                $balance = $WebService2->get_result('Balance');
                                $this->general_model->insert('cashback_log',$data_input);
                                $this->deposit_model->updateAccountBalance($account_number, $balance);

                                // ================================== Deduct rebate commission


                                $config = array(
                                    'server' => 'live_new'
                                );
                                $WebService = new WebService($config);
                                $account_number = $commission->AgentLogin;
                                $WebService->update_live_deposit_balance($account_number, -$data_input['amount'], "Cashback to ".$commission->AgentLogin." where ".$commission->FromAccount." is account number of client");
                                if ($WebService->request_status === 'RET_OK') {
                                    $data['mt_ticket'] = $WebService->get_result('Ticket');
                                    $WebService2 = new WebService($config);
                                    $WebService2->request_live_account_balance($account_number);
                                    if ($WebService2->request_status === 'RET_OK') {
                                        $balance = $WebService2->get_result('Balance');
                                        $this->deposit_model->updatePartnerBalance($account_number, $balance);

                                    }
                                }

                                // ============================
                            }
                        } */





                        // end ===============================================

                    }


                }

            }
        }
    }
    private function get_convert_amount($currency, $amount, $to_currency = 'USD') {
        if ($currency == $to_currency) {
            $conv_amount = $amount;
        } else {
            $converter_config = array(
                'server' => 'converter'
            );

            $WebService = new WebService($converter_config);
            $data = array(
                'Amount' => $amount,
                'FromCurrency' => $currency,
                'ToCurrency' => $to_currency,
                'ServiceLogin' => '505641',
                'ServicePassword' => '5fX#p8D^c89bQ'
            );

            $ConvertCurrency = $WebService->ConvertCurrency($data);
            $resultConvertCurrency = $ConvertCurrency['ConvertCurrencyResult'];
            if ($resultConvertCurrency['Status'] === 'RET_OK') {
                $converted_amount = $resultConvertCurrency['ToAmount'];
                $conv_amount = number_format($converted_amount, 2);
            } else {
                $conv_amount = $amount;
            }
        }

        return $conv_amount;
    }

    public function cashBackProgramMenual(){
        exit();

        $this->load->library('WebService');
        if(!IPLoc::Office()){redirect("");}
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');

        $from = date('2016-05-29 00:01:01');
        $to = date('2017-06-06 23:59:59');

        $webservice_config = array(
            'server' => 'live_new'
        );
        echo "<pre>";

exit();

                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iAgent' => 239789 , // int Agent Account Number who pay cashback bonus
                    'iAccount' => 272859, // Client account number who registered using "IHXBM" referal code
                    'from' => date('Y-m-d\TH:i:s', strtotime($from)),
                    'to' => date('Y-m-d\TH:i:s', strtotime($to))
                );
                print_r($account_info);

                if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){

                    if($commission->TotalAmount>0){
                        $data_input = array(
                            'agent'=>$commission->AgentLogin,
                            'account'=>$commission->FromAccount,
                            'amount'=>$commission->TotalAmount*1, // 1 is pip cashback=commission*pip
                            'pip'=>1,
                            'date'=>date('Y-m-d H:i:s')
                        );

                        print_r($data_input);

                             $accData = $this->general_model->showssingle("mt_accounts_set", "account_number", $commission->FromAccount, "*");
                             $partnerData = $this->general_model->showssingle("partnership", "reference_num", $commission->AgentLogin, "*");


                             $conv_amount = $this->get_convert_amount($accData['mt_currency_base'], $data_input['amount'], $partnerData['currency']);
                             $config = array(
                                 'server' => 'live_new'
                             );

                             $WebService = new WebService($config);
                             $account_number = $accData['account_number'];

                        echo $account_number.'=='.$conv_amount;
                             $WebService->update_live_deposit_balance($account_number, $conv_amount, "Cashback");
                             if ($WebService->request_status === 'RET_OK') {

                                 print_r($WebService->get_all_result());
                                 $data['mt_ticket'] = $WebService->get_result('Ticket');
                                 $WebService2 = new WebService($config);
                                 $WebService2->request_live_account_balance($account_number);
                                 if ($WebService2->request_status === 'RET_OK') {
                                     print_r($WebService2->get_all_result());
                                     $balance = $WebService2->get_result('Balance');
                                     $this->general_model->insert('cashback_log',$data_input);
                                     $this->deposit_model->updateAccountBalance($account_number, $balance);

                                     // ================================== Deduct rebate commission


                                     $config = array(
                                         'server' => 'live_new'
                                     );
                                     $WebService = new WebService($config);
                                     $account_number = $commission->AgentLogin;
                                     $WebService->update_live_deposit_balance($account_number, -$data_input['amount'], "Cashback to ".$commission->AgentLogin." where ".$commission->FromAccount." is account number of client");
                                     if ($WebService->request_status === 'RET_OK') {
                                         print_r($WebService->get_all_result());
                                         $data['mt_ticket'] = $WebService->get_result('Ticket');
                                         $WebService2 = new WebService($config);
                                         $WebService2->request_live_account_balance($account_number);
                                         if ($WebService2->request_status === 'RET_OK') {
                                             print_r($WebService2->get_all_result());
                                             $balance = $WebService2->get_result('Balance');
                                             $this->deposit_model->updatePartnerBalance($account_number, $balance);

                                         }
                                     }

                                     // ============================
                                 }
                             }





                        // end ===============================================

                    }


                }


    }

    public function testCashBack(){

        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');
        if(!IPLoc::Office()){redirect('');}
            echo "<pre>";
        $this->account_model->getCashBackAccountList('IHXBM');

        if($cashBackList  = $this->account_model->getCashBackAccountList('IHXBM')){


            $webservice_config = array(
                'server' => 'live_new'
            );

            foreach($cashBackList as $d){

                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iAgent' => 239789 , // int Agent Account Number who pay cashback bonus
                    'iAccount' => $d->account_number, // Client account number who registered using "IHXBM" referal code
                    'from' => date('Y-m-d\T00:00:00', strtotime('2014-01-01')),
                    'to' => date('Y-m-d\T23:59:59', strtotime('2017-03-17'))
                );

                if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){
                    $data_input = array(
                        'agent'=>$commission->AgentLogin,
                        'account'=>$commission->FromAccount,
                        'amount'=>$commission->TotalAmount*1, // 1 is pip cashback=commission*pip
                        'pip'=>1,
                        'date'=>date('Y-m-d H:i:s')
                    );

                    print_r($data_input);
                }





            }
        }
    }


    public function testconnection(){
        echo 'test';
    }
    
    public function test_email_sender(){
      Fx_scheduled_mailer::tester_mail('web-1c4sb@mail-tester.com', 'lPfZfzaLRWP8zLMbpelc2' ,'Client');

    }


          public function home_slider(){
        $nlanguage = FXPP::html_url();
        $user_country = FXPP::getUserCountryCode();
        $this->lang->load('home');
        $this->lang->load('moneyfall');
        $this->lang->load('contest');
        $this->load->model('account_model');
        $this->load->model('news_model');
        $this->lang->load('Location');

        if(in_array($user_country, array('US', 'KP', 'MM', 'SD', 'SY'))){
            $data['unavailable'] = true;
        }else{
            $data['unavailable'] = false;
        }


            //Contest Monitoring
            $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
            $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
            $contest_data = $this->account_model->getContestWinnersLimit( $start_date, $end_date, 10 );
            if($contest_data){
                $rank = 0;
                $prev_value = 0;

                $start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
                $end_dates = date('Y-m-d 22:59:59', strtotime($start_dates . ' +4 days'));


                foreach($contest_data as $key => $value){
                    if($prev_value <> $value['amount']){
                        $rank++;
                        $prev_value = $value['amount'];
                    }

                    $country_name = $this->g_m->getCountries($value['country']);
                    if(!is_array($country_name)){
                        if($country_name){
                            $contest_data[$key]['country_name'] = $country_name;
                        }else{
                            $contest_data[$key]['country_name'] = '';
                        }
                    }else{
                        $contest_data[$key]['country_name'] = '';
                    }
                    $contest_data[$key]['rank'] = $rank;
                    $contest_data[$key]['start_end'] = date("m/d/Y", strtotime($start_dates))." - ". date("m/d/Y", strtotime($end_dates));
                }
            }
            $data['rankings'] = $contest_data;

            /* Get Latest News List */
            $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, $nlanguage);
            if(count($latest_news) > 0){
                $top_latest_news = $latest_news[0];
                if(!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
                unset($latest_news[0]);
            }else{
                $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, 'EN');
                if(count($latest_news) > 0){
                    $top_latest_news = $latest_news[0];
                    if(!empty($top_latest_news['publisher_image'])) {
                        if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                            $top_latest_news['publisher_image'] = 'avatar.png';
                        }
                    }else{
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                    unset($latest_news[0]);
                }else{
                    $top_latest_news = array();
                }
            }

            $top_news_images = $this->news_model->getNewsImagesByNewsId($top_latest_news['id']);

            $data['latest_news'] = $latest_news;
            $data['top_latest_news'] = $top_latest_news;
            $data['top_news_images'] = $top_news_images;
            $data['nlanguage'] = $nlanguage;


        $sysmbolsData = FXPP::generateQuotesRow();
        $data['quotes'] = $sysmbolsData;
        
        $data['metadata_description'] = '';
        $data['metadata_keyword'] = lang('x_hom_kew');
            $css_files = "
                       <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400|Playball' rel='stylesheet' type='text/css'>
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."awardarea.css'>
                 ";

        $this->template->title(lang('x_hom_tit'))
            ->append_metadata_css($css_files)
            ->append_metadata_js('
                     <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
                     <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.touchSwipe.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.simpleslider.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/custom.js" type="text/javascript"></script>
                ')
            ->set_layout('external/main')
            ->build('home_test', $data);
    }


    public function test_newsletter(){
        $this->load->model('Mailer_model');
        $emailContent = $this->Mailer_model->getTradeOfferContent()['0'];
        Fx_scheduled_mailer::tradeOfferMail('newbee4test17@gmail.com', 'lPfZfzaLRWP8zLMbpelc2' ,'клиенты');
    }

    public function set_agent(){
        $this->load->model('General_model');
        $referrals = $this->General_model->show_referral();

        print_r($referrals);
        exit;
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        foreach($referrals as $referral){


            $data = [
              'iLogin' => $referral['referral_affiliate_code']
            ];
            
            $WebService->request_account_details($data);
            $agent = $WebService->get_result('Agent');
            if($agent == '261755'){
                print_r($result);
            }
            
        }
        
    }

  public function set_agent2(){
        // $this->load->model('General_model');
        // $data = $this->General_model->show_referral();
        echo '1';
  }


    public function ndb_report_weekly(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -1 days'));

        $from =  date('Y-m-d 00:00:00', strtotime('last week sunday', strtotime('last week')));
        // $from =  date('2016-12-26 00:00:00');
        $to = date('Y-m-d 23:59:59', strtotime('last saturday', strtotime('yesterday')));



        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate_ndb( $from, $to );
        $real_account_chart_data_30 = array();
        foreach($real_accounts_data_30 as $key => $account){
            $real_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 60 days
        $real_accounts_data_60 = $this->account_model->clients_who_claimed_NDB( $from, $to );
        $real_account_chart_data_60 = array();
        foreach($real_accounts_data_60 as $key => $account){
            $real_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 180 days
        $real_accounts_data_180 = $this->account_model->clients_who_did_not_complete_registration($from,$to);
        $real_account_chart_data_180 = array();
        foreach($real_accounts_data_180 as $key => $account){
            $real_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }



        $data['real_accounts_data_30'] = $real_account_chart_data_30;
        $data['real_accounts_data_60'] = $real_account_chart_data_60;
        $data['real_accounts_data_180'] = $real_account_chart_data_180;
        $data['table'] = array(
            'registered_clients'=> count($real_accounts_data_30),
            'received_NDB'=> count($real_accounts_data_60),
            'Percentage'=>count($real_accounts_data_60)/ count($real_accounts_data_30)
        );


//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_real_accounts_ndb', $data);
    }

    public function dailyOpenedRealAccountsGraphs(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -1 days'));





        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate_ndb( $date_from_30, $date_now );
        $real_account_chart_data_30 = array();
        foreach($real_accounts_data_30 as $key => $account){
            $real_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 60 days
        $real_accounts_data_60 = $this->account_model->clients_who_claimed_NDB( $date_from_30, $date_now );
        $real_account_chart_data_60 = array();
        foreach($real_accounts_data_60 as $key => $account){
            $real_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 180 days
        $real_accounts_data_180 = $this->account_model->clients_who_did_not_complete_registration($date_from_30,$date_now);
        $real_account_chart_data_180 = array();
        foreach($real_accounts_data_180 as $key => $account){
            $real_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }



        $data['real_accounts_data_30'] = $real_account_chart_data_30;
        $data['real_accounts_data_60'] = $real_account_chart_data_60;
        $data['real_accounts_data_180'] = $real_account_chart_data_180;
        $data['table'] = array(
            'registered_clients'=> count($real_accounts_data_30),
            'received_NDB'=> count($real_accounts_data_60),
            'Percentage'=>count($real_accounts_data_60)/ count($real_accounts_data_30)
        );


//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_real_accounts_ndb', $data);
    }

    public function send_ndb_report_weekly(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_real_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/test/ndb_report_weekly /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'form'=>date('Y-m-d 00:00:00', strtotime('last week sunday', strtotime('last week'))),
            'to'=>date('Y-m-d 23:59:59', strtotime('last saturday', strtotime('yesterday')))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
      $this->email->to('agus@forexmart.com');
      //  $this->email->to('bug.fxpp@gmail.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('bug.fxpp@gmail.com');
        $this->email->subject('NDB clients statistics weekly');
        $this->email->message($this->load->view('email/daily_real_accounts_graph_ndb', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function send_ndb_report_daily(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_real_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/test/dailyOpenedRealAccountsGraphs /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('agus@forexmart.com');
        //$this->email->to('bug.fxpp@gmail.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('bug.fxpp@gmail.com');
        $this->email->subject('NDB clients statistics daily');
        $this->email->message($this->load->view('email/daily_real_accounts_graph_ndb', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function manual_access_resend(){
        $partnership_authdetails = array(
//            'email' => 'mariaclove04@gmail.com',
//            'email' => 'eduard.savchenko@forexmart.com',
            'password' => 'JeweOhf',
            'fullname' => 'Adrian Cross',
            'phone_password' => 'UNvCrDh',
            'account_number'=>'280802',
            'trader_password' =>'JeweOhf'
        );
//        $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
        $partnership_affiliate = array(
            'partner_id' => 220976,
            'affiliate_code' => 'GULIC'
        );
//        $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);
        $this->load->library('Fx_mailer');
//        Fx_mailer::partners_registration_manual_resend($partnership_authdetails, $partnership_affiliate);
        print_r("success");
    }



    public function curlTest(){
        $ch = curl_init();
        // $data = rray('' => , );;
        $arrayName = array(
          'array' => '33',
          'array1' => '11',
          'array2' => '222',          
           );
        curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/test/getdata");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayName);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        return $server_output;
    }

    public function testcurlsdasdasd()
    {
        // echo '1';
        var_dump($this->curlTest());
    }


    public function passport(){
        if(!IPLoc::Office()){redirect(FXPP::loc_url());}

        set_time_limit(3000);
        @ini_set('max_execution_time',200);
        $this->load->model('account_model');
        $this->lang->load('rpjracing');
        $this->load->model('General_model');

        $data['passport'] =   $this->account_model->getReportAllpartner();
       // $data['passport'] = $this->general_model->showmy("test_doc");



        $this->load->view('test/passport',$data);


    }


   public function get_code_referrals(){
        // $this->load->model('Account_model');
        // $account_referrals = $this->Account_model->getReferrals( 'DJSWZ' );
        // echo json_encode($account_referrals);
        // ini_set("soap.wsdl_cache_enabled", "0");
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        // if ( $this->input->post('pwd') != 'oUwP3bZLSLu49YW3MNgroudmFXE_4QeJlBpuLiIVCsg' ) {
        //     show_404();
        // }
        $accountnumbers = $this->uri->segment(4);

        if ($accountnumbers != '101889') {
            show_404();
        }
        $from = DateTime::createFromFormat('Y-m-d H:i:s', $this->uri->segment(3).'-01 00:00:00');
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $this->uri->segment(3).'-31 23:59:59');
        $start = 0;
        $limit = 9000;
        $account_info = array(
            'iLogin' => $accountnumbers,
            'from' => $from->format('Y-m-d\TH:i:s') ,
            'to' => $to->format('Y-m-d\TH:i:s'),
            'offset' => $start,
            'limit' => $limit
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $getServiceData = $WebService->GetAgentsCommissionByDateWithLimitAndOffset($account_info);
        echo json_encode($getServiceData->GetAgentsCommissionByDateWithLimitAndOffSetResult->CommisionList->CommissionData);
    }

}