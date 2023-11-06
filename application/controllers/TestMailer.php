<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestMailer extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        FXPP::CI()->lang->load('demo-account-html');
        // if(!IPLoc::Office()){redirect("");}
    }

    public function index(){
        exit;
       // echo "test";
    }

    //mailer for demo account
  public function demo_account(){
        $to = 'uness1954@gmail.com';
        $email = trim($to);
        $password = 'farker';
        
        $email_data = array(
            'full_name' => 'Test25-01',
            'email' => $email,
            'password'=> $password,
            'account_number'=> '25012501',
            'trader_password'=> 'TRDRPWD',
            'investor_password'=> 'INVSTRPWD',
            'phone_password'=> 'PHNPWD',
        );
        $subject = lang('dem_acc_htm_01');;
        $config = array(
            'mailtype'=> 'html'
        );
        $isSendSuccess = $this->general_model->sendEmail('demo-account-html', $subject, $email_data['email'], $email_data,$config);
        var_dump($isSendSuccess);
    }

    //mailer for live account
      public function live_account(){
        $to = 'uness1954@gmail.com';
        $email = trim($to);
        $password = 'farkerii';
        
        $email_data = array(
            'full_name' => 'Test25-02',
            'email' => $email,
            'password'=> $password,
            'account_number'=> '25012501',
            'trader_password'=> 'TRDRPWD',
            'investor_password'=> 'INVSTRPWD',
            'phone_password'=> 'PHNPWD',
        );
        $subject = "ForexMart MT4 Live Trading Account details";
        $config = array(
            'mailtype'=> 'html'
        );
        $isSendSuccess = $this->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data,$config);
        var_dump($isSendSuccess);
    }

    //mailer for mwp admin panel
      public function manageaccess_email(){
        $to = 'uness1954@gmail.com';
        $email = trim($to);
        $password = 'PWD-03';
        
        $email_data = array(
            'full_name' => 'Test25-03',
            'email' => $email,
            'password'=> $password,
            'user_id' => $email,
            'header' => 'ForexMart Mwp account details',
            'title' => 'An account has been created for you to be able to access ForexMart Mwp Admin Panel.'
        );
        $config = array(
            'mailtype'=> 'html'
        );
        $isSendSuccess = $this->general_model->sendEmail('manage_access-html', "ForexMart Team", $email_data['email'], $email_data, $config);
        var_dump($isSendSuccess);
    }

    //mailer for fx_mailer - partner registration
    public function mailer_partner_reg(){
        $email_data = array(
            'fullname' => 'Test25-04b',
            'email' => 'uness1954@gmail.com',
            'password'=> 'PWD-04b',
            'account_number'=> '25042504',
            'trader_password'=> 'TRDRPWD',
            'investor_password'=> 'INVSTRPWD',
            'phone_password'=> 'PHNPWD',
            'affiliate_code'=> 'AFFCODE'
        );
      print_r($email_data); 
      // Fx_mailer::partners_registration($email_data);
      Fx_mailer::partners_registration($email_data, $email_data);
  }

  //mailer for fx-mailer - ticket raffle 
  public function mailer_tic_raff(){
        $email_data = array(
            'full_name' => 'Test25-04c',
            'email' => 'uness1954@gmail.com',
            'password'=> 'PWD-04c',
            'account_number'=> '25042504',
            'trader_password'=> 'TRDRPWD',
            'investor_password'=> 'INVSTRPWD',
            'phone_password'=> 'PHNPWD',
        );
       
       print_r($email_data); 
       Fx_mailer::ticket_raffle($email_data);
  }

  //mailer for fx-mailer - moneyfall registration access
    public function mailer_mf_ra(){
        $email_data = array(
            'Title' => 'TitleTest',
            'FullName' => 'Test25-04d',
            'AccountNumber'=> '25042504',
            'Password'=> 'PWD-04d',
            'InvestorPassword'=> 'INVSTRPWD',
            'Email' => 'uness1954@gmail.com',
        );
       
       print_r($email_data); 
       Fx_mailer::MoneyFallRegistrationAccess($email_data);
  }

    //mailer for fx-mailer - moneyfall registration code
    public function mailer_mf_rc(){
        $email_data = array(
            'Title' => lang('fxpp-7115-tit'),
            'FullName' => 'Test25-04d',
            'Code'=> '25042504',
            'Email' => 'uness1954@gmail.com',
        );
       
       print_r($email_data); 
       Fx_mailer::MoneyFallRegistrationCode($email_data);
  }

  //mailer for fx-mailer - decline both documents
  public function mailer_decline(){
      $email_data = array(
            'SelectedReason' => 'Reason',
            'ReasonExplanation' => 'Explanation',
            'Email' => 'uness1954@gmail.com',
            'AccountNumber' => '25042504',
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
      print_r($email_data); 
      Fx_mailer::AccountVerificationDeclinedBothDocuments($email_data);
  }

 //mailer for fx-mailer - decline 2nd document
  public function mailer_decline2nd(){
      $email_data = array(
            'SelectedReason' => 'Reason',
            'ReasonExplanation' => 'Explanation',
            'Email' => 'uness1954@gmail.com',
            'AccountNumber' => '25042504',
            'FullName' => 'test25-4e',

            'ClientName0' => 'cn02',
            'FileName0' => 'fn02',
            'DocIdx0' => 'doc02',

            'ClientName1' => 'cn12',
            'FileName1' => 'fn12',
            'DocIdx1' =>'doc12',

            'ClientName2' => 'cn22',
            'FileName2' => 'fn22',
            'DocIdx2' => 'doc22'
      );
      print_r($email_data); 
      Fx_mailer::AccountVerificationDeclined2ndDocuments($email_data);
  }

    //mailer for fx-mailer - decline 1st document
    public function mailer_decline1st(){
      $email_data = array(
            'SelectedReason' => 'Reason1',
            'ReasonExplanation' => 'Explanation1',
            'Email' => 'uness1954@gmail.com',
            'AccountNumber' => '25042504',
            'FullName' => 'test25-4f1',

            'ClientName0' => 'cn01',
            'FileName0' => 'fn01',
            'DocIdx0' => 'doc01',

            'ClientName1' => 'cn11',
            'FileName1' => 'fn11',
            'DocIdx1' =>'doc11',

            'ClientName2' => 'cn21',
            'FileName2' => 'fn21',
            'DocIdx2' => 'doc21'
      );
      print_r($email_data); 
      Fx_mailer::AccountVerificationDeclined1stDocuments($email_data);
  }

      //mailer for fx-mailer - account verification verified user
      public function mailer_av_vu(){
      $email_data = array(
            'Email' => 'uness1954@gmail.com',
            'AccountNumber' => '25042504',
            'FullName' => 'test25-4g',

            'ClientName0' => 'cn03',
            'FileName0' => 'fn03',
            'DocIdx0' => 'doc03',

            'ClientName1' => 'cn13',
            'FileName1' => 'fn13',
            'DocIdx1' =>'doc13',

            'ClientName2' => 'cn23',
            'FileName2' => 'fn23',
            'DocIdx2' => 'doc23'
      );
      print_r($email_data); 
      Fx_mailer::AccountVerificationVerifiedUser($email_data);
  }

        //mailer for fx-mailer - account verification document approved
      public function mailer_doc_ok(){
      $email_data = array(
            'Email' => 'uness1954@gmail.com',
            'AccountNumber' => '25042504',
            'FullName' => 'test25-4h',

            'DocumentFilename' => 'DocumentFilename1',
            'HashFilename' => 'HashFilename1',
            'DocIdx' => 'DocIdx1'
      );
      print_r($email_data); 
      Fx_mailer::AccountVerificationDocumentApproved($email_data);
  }

      //mailer for no deposit client request -- tested in cron controller instead

        public function sendNoDepositMailTest(){
            echo 'err';
        $email_data = array(
            'title' => 'Application for No Deposit Bonus to account 25052505'
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
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('uness1954@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/no-deposit-request-html', $email_data, TRUE));
        if($this->email->send()){
            //$this->deposit_model->updateNoDepositSentByUserID($no_deposit['user_id']);
            echo 'sent!';
        }else{
            echo 'error';
        }
    }


  public function trader_offer_mailing() {
        // error_reporting(E_ALL);
        // ini_set('display_errors', 1);
        // ini_set('memory_limit', '-1');

        // $server = array('server' => 'trading');
        // $WebService = new WebService($server);

        // $from =  date('Y-m-d\T00:00:00', strtotime('last monday', strtotime('today')));
        // $to = date('Y-m-d\T23:59:59', strtotime('friday', strtotime($from)));

        // // date("M j,Y",strtotime($cd));
        // $test = array(
        //     'from' =>$from,
        //     'to' => $to
        // );
        // // var_dump($test);
        // $res = (array) $WebService->getmosttraded($test);
        // $res = $res['results'];
        // // print_r($res);
        // if( $res['ReqResult'] == 'RET_OK' ) {
        //     $date = new DateTime($res['FromDate']);
        //     $res['FromDate'] = $date->format('d-M Y g:i e');
          $to = 'german.pavlyak@forexmart.com';
          // $to = 'mottakaquezo68@gmail.com';
          // $to = 'test.02914@gmail.com';    
          $unsubscribe = 'p5VaF0qwHTREp5gLsPaW5';
          $this->load->model('Mailer_model'); //  
          $res = $this->Mailer_model->getTradeOfferContent()['0']; //

          print_r($res);
          exit;
          echo $to;
          Fx_mailer::tradermailer($to,$unsubscribe ,$res);
        //   echo "<br>";
        //   echo "<br>";
        //   echo "<br>";
          Fx_mailer::tradermailerRussian($to,$unsubscribe ,$res);

        // }else{
        //         $data['most'] = 'No result';
        // }


  }

  public function testingEconomicCalendarLoop() {
    
        $this->load->model('Calendar_model');
        foreach ( $this->Calendar_model->getAllClientByLangAndDate('En') as $key => $value) {
          print_r($value);
          $this->Calendar_model->economicCalendarCounter($value['Id']);
        }

  }


  public function market_tone() {
    // $to = 'german.pavlyak@forexmart.com';
    $to = 'mottakaquezo68@gmail.com';
    // $to = 'test.02914@gmail.com';    
    $replyto = 'marketing@notify.forexmart.com';

    $subject = 'test1';
    $body = Fx_mailer::traderOfferHeader();
    $body .= '          <table width="100%" style="border-spacing:0;font-family:"Open Sans";color:#333333; background:url(images/market-tone-bg.png) center bottom; background-repeat:no-repeat;" >';
    $body .= '            <tr>';
    $body .= '              <td class="inner contents" style="padding-top:10px;padding-bottom:10px; width:98%;text-align:left;" >';
    $body .= '              <h1 style="text-align:center; font-size:20px; margin:0 auto; margin-top:10px;">Traders dashboard for the last week</h1>';
    $body .= '              <div style="width: 55%; margin:0 auto; padding: 5px; display:table; background-color: rgba(255, 255, 255, 0.3);">';
    $body .= '              <table style="min-width:230px; margin:10px auto; border-collapse:collapse; font-size:12px; color:#000; font-family:"Open Sans", helvetica, sans-serif; overflow-x:auto;">';
    $body .= '                <thead>';
    $body .= '                  <th style="padding:5px; text-align:center;">Buy</th>';
    $body .= '                  <th style="padding:5px; text-align:center;" colspan="2"></th>';
    $body .= '                  <th style="padding:5px; text-align:center;">Sell</th>';
    $body .= '                  <th style="padding:5px; text-align:center;">Symbol</th>';
    $body .= '                  <th style="padding:5px; text-align:center;">Buy</th>';
    $body .= '                  <th style="padding:5px; text-align:center;">Sell</th>';
    $body .= '                </thead>';
    $body .= '                <tbody>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">7.36%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:17.3%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:82.7%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">92.64%</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.73224</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.73224</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">67.57%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:95%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:5%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">32.43% </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.1245</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.5567</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">56.00%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:45%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:55%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">32.43% </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.1245</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.5567</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">7.36%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:17.3%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:82.7%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">92.64%</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.73224</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.73224</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">67.57%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:95%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:5%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">32.43% </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.1245</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.5567</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">56.00%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:45%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:55%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">32.43% </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.1245</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.5567</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">7.36%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:17.3%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:82.7%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">92.64%</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.73224</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.73224</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">67.57%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:95%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:5%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">32.43% </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.1245</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.5567</td>';
    $body .= '                  </tr>';
    $body .= '                  <tr>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">56.00%</td>';
    $body .= '                    <td colspan="2" style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:40%;">';
    $body .= '                      <div style="width:100%; height:20px; display:table;">';
    $body .= '                        <a style="width:45%; text-decoration:none; float:left; height:20px; background:#2886cd;"></a>';
    $body .= '                        <a style="width:55%; text-decoration:none; float:left; height:20px; background:#ff0000;"></a>';
    $body .= '                      </div>';
    $body .= '                    </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">32.43% </td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">AUDUSD</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.1245</td>';
    $body .= '                    <td style="padding:5px; text-align:center; border:1px solid #bcbcbc; width:15%;">0.5567</td>';
    $body .= '                  </tr>';
    $body .= '                </tbody>';
    $body .= '              </table>';
    $body .= '            </div>';
    $body .= '            <h2 style="font-family:Arial!important;font-weight:300;color:#fff;font-size:20px;margin-top:25px!important;background:rgba(0,0,0,0.25);padding:10px;width:60%; margin:0 auto; text-align:center;">Catch the market tone and stay in trend.</h2>';
    $body .= '            <div style="display:table; margin:0 auto; margin-top:20px; text-align:center;">';
    $body .= '              <a href="javascript:;" style="font-size:17px; color:#fff; background: #29a643; padding:15px 0; width:250px; text-decoration:none; margin:5px auto; margin-left:5px; margin-right:5px; display:inline-block;">Buy</a>';
    $body .= '              <a href="javascript:;" style="font-size:17px; color:#fff; background: #ff0000; padding:15px 0; width:250px; text-decoration:none; margin:5px auto; margin-left:5px; margin-right:5px; display:inline-block;">Sell</a>';
    $body .= '            </div>';
    $body .= '          </td>';
    $body .= '        </tr>';
    $body .= '      </table>';
    $body .= Fx_mailer::NewestFoooterForTradeOffer('sadfgasdfasdfasdf');
      
    echo $body;
    // Fx_mailer::Mailersender_singapore($to, $replyto, $body, $subject);
  }

  public function birthday() {
    // $to = 'german.pavlyak@forexmart.com';
    // $to = 'mottakaquezo68@gmail.com';
    $to = 'test.02914@gmail.com';    
    $replyto = 'marketing@notify.forexmart.com';
    $name = 'Client';
    $subject = 'testing birthday';
    $body = Fx_mailer::traderOfferHeader();
    $body .='<div style="display:inline-block; position:relative;">';
    $body .='<img src="https://www.forexmart.com/assets/images/birthday/birthday-mailing-v3.jpg" style="width: 800px;">';
    $body .='</div>';
    $body .='<div><br></div>';
    $body .= '<div>Many happy returns of the day from all ForexMart team! </div>';
    $body .= '<div><br></div>';
    $body .= '<div>We would like to let you know how honored we are to have an opportunity to guide you in every step of your trading journey. Our company is sincerely grateful for the confidence and trust you have put in ForexMart. </div>';
    $body .= '<div><br></div>';
    $body .= '<div>On this special day, ForexMart wishes you nothing but a rewarding and successful trades in the upcoming days, months, and years. May our business relationship remain as flourishing as ever. May the heavens storm you with boundless trading opportunities. </div>';
    $body .= '<div><br></div>';
    $body .= '<div>Have a wonderful birthday celebration!</div>';
    $body .= '<div><br></div>';
    $body .= '<div>Best Regards,</div>';
    $body .= '<div style="    font-size: 15px;    font-weight: bold;    color: #003a62;    ">ForexMart Team</div>';
    $body .= Fx_mailer::tradeOfferFooter('sadfgasdfasdfasdf');
      
    echo $body;
    Fx_mailer::Mailersender_singapore($to, $replyto, $body, $subject);
  }



  public function GetSymbol() {
        date_default_timezone_set('Etc/GMT-8');

        $client = new SoapClient( "https://78w.forexmart.com:6589/TicksMngrService.svc?wsdl" );
        $TicksMngrService = $client->GetSymbolWithBiggestPriceDifferenceForLastWeek();
        $TicksMngrService = $TicksMngrService->GetSymbolWithBiggestPriceDifferenceForLastWeekResult;
        // echo "<br>";
        // echo "<br>";

        // var_dump($TicksMngrService->Symbol);
        // echo "<br>";
        // echo "<br>";

        $res['Symbol'] = $TicksMngrService->Symbol;
        $res['ChangePercentageString'] = $TicksMngrService->ChangePercentageString;
        $res['From'] = date('Y-m-d h:i:s', strtotime($TicksMngrService->From));
        var_dump($res);
    // exit;
    // $to = 'german.pavlyak@forexmart.com';
    // $to = 'mottakaquezo68@gmail.com';
    $to = 'test.02914@gmail.com';    
    $replyto = 'marketing@notify.forexmart.com';
    $name = 'Client';
    $subject = 'This week most popular deal';

    $body =Fx_mailer::tradeOfferHeader();
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
    $body .='                        '.$res['Symbol'];
    $body .='                        <a href="javascript:;"><img src="https://www.forexmart.com/assets/images/trader_offer_mailing/arrows-up.png" width="50" height="50"></a> ' ;
    $body .='                        '.$res['ChangePercentageString'];
    $body .='                      </span> ' ;
    $body .='                      <span style="font-size: 14px; color: #a7a7a7;">'.$res['From'].'</span> ' ;
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
    $body .= '        <a href="https://webterminal.forexmart.com/" style="text-decoration:none; margin:0 auto;display: block;background: #29a643;border-bottom:4px solid #188c30!important;color:#fff;border:0;padding: 13px 10px;font-size:15px;cursor:pointer;width:90%;text-align: center;">';
    $body .= '        BUY';
    $body .= '            <span style="display:block; margin:0 auto; font-size:12px; margin-top:5px;">';
    $body .= '            If you believe '.$res['Symbol'].' price will climb up';
    $body .= '            </span>';
    $body .= '        </a>';
    $body .= '    </td>';
    $body .= '    <td style="width:33.33%; display:inline-block; position:relative; padding:20px 0;">';
    $body .= '        <a href="https://webterminal.forexmart.com/" style="text-decoration:none; margin:0 auto;display: block;background: #cf2323;border-bottom:4px solid #ad1717!important;color:#fff;border:0;padding: 13px 10px;font-size:15px;cursor:pointer;width:90%;text-align: center;">';
    $body .= '        SELL';
    $body .= '            <span style="display:block; margin:0 auto; font-size:12px; margin-top:5px;">';
    $body .= '            If you believe '.$res['Symbol'].' price will decline';
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
    $body .=Fx_mailer::tradeOfferFooter($unsubscribe);
      
    echo $body;
    Fx_mailer::Mailersender_singapore($to, $replyto, $body, $subject);
  }



}