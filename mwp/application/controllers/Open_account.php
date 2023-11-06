<?php

class Open_account extends CI_Controller {

    private $allow_register = true;

    public function __construct(){
        parent::__construct();
        $this->load->model('Finance_model');
        $this->load->library('Fx_mailer');
        $this->load->library('UserAccess');
        $this->load->model('Account_model');
        $this->load->model('General_model');
        $this->load->model('Quick_model');
        $this->load->library('WebService');
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
        $this->country_code = FXPP::getUserCountryCode() or null;
        $this->g_m=$this->General_model;
        $this->q_m=$this->Quick_model;

        if (!$this->tank_auth->is_logged_in()) { // logged in
            redirect('signin');
        }
    }

    public function index(){
        UserAccess::checkUserPermission("openacc");

        $data['active'] = "quick-jump";
        $data['li_active'] = "li_openacct";
        $data['access'] = UserAccess::ManageAccessList();
        $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), isset($user_details['country']) ? $user_details['country'] : $this->country_code);

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='".$js."Moment.js'></script>
                      <script src='".$js."bootstrap-datetimepicker.min.js'></script>
                      <script src='".$js."bootstrap-datepicker.min.js'></script>
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                ")
            ->set_layout('mwp/v2_main')
            ->build('accounts/v2_open_account', $data);
        }

    public function validate_email(){
        UserAccess::checkUserPermission("openacc");
        if($this->session->userdata('admin_manage') && $this->input->is_ajax_request()){
              $data['success'] = false;
        
              $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_is_valid_email|required|xss_clean');        
              $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|max_length[48]|xss_clean|callback_character_check');
              $this->form_validation->set_message('is_unique', 'This email is already used.');

              if ($this->form_validation->run() ) {
                    $user_data = array(
                        'email_live' => $this->input->post('email', true),
                        'full_name_live' => $this->input->post('full_name', true)
                    );
                    $this->session->set_userdata($user_data);

                    $incomplete_registers = array(
                        'email' => $this->input->post('email', true),
                        'full_name' => $this->input->post('full_name', true)
                    );
                   $inc = $this->General_model->insert_inc($incomplete_registers);
                  
                    $data['incid'] =$inc;
                    $data['success'] =true;
                }
            }
            else{
              $data['success'] = false;
            }

            $data['errors'] = validation_errors();
             echo json_encode($data);
    }

    public function is_valid_email($email){
            $return = Fx_mailer::validateEmail('notify@forexmart.com',$email);
            if($return[$email] == 'bool(true)'){
                return true;
            }else{
                $this->form_validation->set_message('is_valid_email', 'Please input a valid Email.');
                return false;
            }
    }

    public function character_check($str)
    {
        if (preg_match('/[^a-zA-Z 0123456789 ??????????????????????????????????????????????????????? !"#$%&()*+,\ :;?{}~@`
ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥ƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ.-_\-\_]/i', $str)
        ) {
            $this->form_validation->set_message('character_check', lang('validate_engrus1') . ' %s ' . lang('validate_engrus2'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function open_account_reg1($id){
        UserAccess::checkUserPermission("openacc");
        
        $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), isset($user_details['country']) ? $user_details['country'] : $this->country_code);
        $data['account_type'] = $this->general_model->selectOptionList($this->general_model->getAccountType(), 1);
        $data['account_currency_base'] = $this->general_model->selectOptionList($this->general_model->getAccountCurrencyBase(), 'EUR');

        $user_country = FXPP::getUserCountryCode();
        if (in_array(strtoupper($user_country), array('PL'))) {
            $data['leverage'] = $this->general_model->selectOptionList($this->general_model->getLeverage(null, 100), "1:100");
        } else {
            $data['leverage'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), "1:200");
        }

        $data['amount'] = $this->general_model->selectOptionList($this->general_model->getAmount(), '50000');
        $data['country_code'] = $this->country_code;
        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['postal_code'] = FXPP::getVisitorInfo()->postal_code;
        $data['investment_knowledge'] = $this->general_model->selectOptionList($this->general_model->getInvestmentKnowledge(), isset($user_details['investment_knowledge']) ? $user_details['investment_knowledge'] : 1);
        $data['trade_duration'] = $this->general_model->selectOptionList($this->general_model->geTtradeDuration(), isset($user_details['trade_duration']) ? $user_details['trade_duration'] : null);
        $data['employment_status'] = $this->general_model->selectOptionList($this->general_model->getEmploymentStatus(), isset($user_details['employment_status']) ? $user_details['employment_status'] : 0);
        $data['industry'] = $this->general_model->selectOptionList($this->general_model->getIndustry(), isset($user_details['industry']) ? $user_details['industry'] : null);
        $data['source_of_funds'] = $this->general_model->selectOptionList($this->general_model->getSourceOfFunds());
        $data['estimated_annual_income'] = $this->general_model->selectOptionList($this->general_model->getEstimatedAnnualIncome(), isset($user_details['estimated_annual_income']) ? $user_details['estimated_annual_income'] : 3);
        $data['estimated_net_worth'] = $this->general_model->selectOptionList($this->general_model->getEstimatedNetWorth(), isset($user_details['estimated_net_worth']) ? $user_details['estimated_net_worth'] : 3);
        $data['education_level'] = $this->general_model->selectOptionList($this->general_model->getEducationLevel(), isset($user_details['education_level']) ? $user_details['education_level'] : null);


       $data['active'] = "quick-jump";
       $data['li_active'] = "li_openacct";
       $data['access'] = UserAccess::ManageAccessList();

       $js = $this->template->Js();
       $css = $this->template->Css();
       $this->template->title("Administration | Forexmart")
           ->append_metadata_css("
                 <link rel='stylesheet' href='" . $css . "summernote.css'>
               ")
           ->append_metadata_js("
               ")
           ->set_layout('mwp/v2_main')
           ->build('accounts/open_account_reg1', $data);
        }

  public function saveLiveAccount(){
      if($this->session->userdata('logged')) {
          UserAccess::checkUserPermission("openacc");

        if (strlen($this->session->userdata('email_live')) < 1 || strlen($this->session->userdata('full_name_live')) < 1) {
            redirect(FXPP::loc_url('open-account'));
            exit();
        }

          $_SESSION['tmp_live_full_name'] = $_SESSION['full_name_live'];
          $_SESSION['tmp_live_email'] = $_SESSION['email_live'];
          $_SESSION['tmp_live_login_type'] = 0;

          $this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[128]|xss_clean|callback_character_check');
          $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[32]|xss_clean|callback_character_check');
          $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[32]|xss_clean|callback_character_check');
          $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
          $this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[16]|xss_clean|callback_character_check');
          $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
          if ($this->input->post('auto_generate', true) != 1) {
              $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
              $this->form_validation->set_rules('re_password', 'Re-password', 'trim|required|xss_clean|matches[password]');
          }
          $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
          $this->form_validation->set_rules('mt_account_set_id', 'Account type', 'trim|required|xss_clean');
          $this->form_validation->set_rules('mt_currency_base', 'Account Currency Base', 'trim|required|xss_clean');
          $this->form_validation->set_rules('leverage', 'Leverage', 'trim|required|xss_clean');

          if ($this->form_validation->run() && (FXPP::limit_15reg_24hrs() == false)) {
              $country = $this->input->post('country', true);
              $illicit_country = unserialize(ILLICIT_COUNTRIES);
              if (!in_array(strtoupper(trim($country)), $illicit_country)) {
                  $login_type = 0; //login_type 0 = client user / 1 = partner user
                  $use_username = $this->config->item('use_username', 'tank_auth');
                  $email_activation = $this->config->item('email_activation', 'tank_auth');

                  $password = urldecode($this->form_validation->set_value('password'));
                  if ($this->input->post('auto_generate', true) == 1) {
                      $password = $this->autoPassword(8);
                  }

                  $user_inser_data = $this->tank_auth->create_user(
                      $use_username ? $this->form_validation->set_value('username') : '',
                      $this->session->userdata('email_live'),
                      $password,
                      $email_activation, 1, $login_type);

//                print_r($user_inser_data);exit;
                  $user_id = $user_inser_data['user_id'];

                  $user_data = array(
                      'new_account_user_id' => $user_id,
                  );
                  $this->session->set_userdata($user_data);
                 // print_r('fak');exit;

                  $data['random_alpha_string_analytics'] = '';
                  $data['random_alpha_string_analytics'] = 'z42esbsn4yqu2p';
                  $data['save_hash'] = array(
                      'first_login_hash' => $data['random_alpha_string_analytics'],
                      'first_login_stat' => 1,
                      'registration_location'=>5,
                  );
                  $this->general_model->update('users', 'id', $user_id, $data['save_hash']);
                  $user_data = array(
                      'analytic_hash' => $data['random_alpha_string_analytics'],
                  );
                  $this->session->set_userdata($user_data);

                  $profile = array(
                      'full_name' => $this->session->userdata('full_name_live'),
                      'user_id' => $user_id,
                      'country' => $this->input->post('country', true),
                      'street' => $this->input->post('street', true),
                      'city' => $this->input->post('city', true),
                      'state' => $this->input->post('state', true),
                      'zip' => $this->input->post('zip', true),
                      'dob' => $this->input->post('dob', true)
                  );

                  if ($this->input->post('country', true) == 'PL') {
                      $_SESSION['temp_country'] = 'PL';
                  }

                  $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                  // track registration link
                  $this->load->helpers('url');
                  // $reg_date = FXPP::getServerTime(); //original
                  $reg_date = FXPP::getCurrentDateTime();
                  $reg_link_details = array(
                      'registration_link' => current_full_url(),
                      'user_id' => $user_id,
                      'street' => $this->input->post('street', true),
                      'date_created' => date('Y-m-d H:i:s', strtotime($reg_date)),
                  );
//                    print_r($reg_link_details);exit;
                  $return_id=$this->general_model->insert('track_registration', $reg_link_details);
//                print_r($return_id);exit;

                  $swap_free = $this->input->post('swap_free', true);
                  $swap_free = empty($swap_free) ? 0 : 1;
                  $phone_password = FXPP::RandomizeCharacter(7);

                  /*  =============== Spread project  setting ================================ */
                  $speardGroup = $this->input->cookie('forexmart_account_type');  // Here store spread of value using affiliateChecker hook.
                  $mt_set_id =$this->input->post('mt_account_set_id',true);
                  $speardGroup = $mt_set_id==1? "refSt".$speardGroup:"refZe".$speardGroup;

                  if(!$this->general_model->getGroupSpard($speardGroup)){

                      $groupCurrency = $this->general_model->getGroupCurrency((int)$mt_set_id, $this->input->post('mt_currency_base',true), $swap_free).'1';

                  }else{

                      $groupCurrency = $speardGroup;
                  }

                  /*  =============== End Spread project  setting ================================ */
                  // Save Affiliate Link
                  $generateAffiliateCode = $this->GenerateRandomAffiliateCode();
                  $affiliate_code_data = array(
                      'users_id' => $user_id,
                      'affiliate_code' => $generateAffiliateCode
                  );

                  $this->general_model->insert('users_affiliate_code', $affiliate_code_data);

                  $input_affiliate_code = $this->input->post('affiliate_code', true);
                  $affiliate_code_logs = self::getAffiliateLogs($input_affiliate_code);
                  $affiliate_referral_codes = ':' . str_replace('-', ':', $affiliate_code_logs);


                  $service_data = array(
                      'address' => $this->input->post('street', true),
                      'city' => $this->input->post('city', true),
                      'country' => $this->general_model->getCountries($this->input->post('country', true)),
                      'email' => $this->session->userdata('email_live'),
                      'group' => $groupCurrency,
                      'leverage' => count($ex_leverage = explode(":", $this->input->post('leverage', true))) > 1 ? $ex_leverage[1] : $this->input->post('leverage', true),
                      'name' => $this->session->userdata('full_name_live'),
                      'phone_number' => $this->input->post('phone', true),
                      'state' => $this->input->post('state', true),
                      'zip_code' => $this->input->post('zip', true),
                      'phone_password' => $phone_password,
                      'comment' => strtolower(FXPP::html_url()) . ':' . $this->input->ip_address() . $affiliate_referral_codes
                  );
//            var_dump($service_data);die();
                  $webservice_config = array(
                      'server' => 'live_new'
                  );
                  $WebService = new WebService($webservice_config);
                  $WebService->open_account_standard($service_data);

                  if ($WebService->request_status === 'RET_OK') {
                      $AccountNumber = $WebService->get_result('LogIn');
                      $TraderPassword = $WebService->get_result('TraderPassword');
                      $InvestorPassword = $WebService->get_result('InvestorPassword');
//                    $RegDate = $WebService->get_result('RegDate');
                      //$RegDate = FXPP::getServerTime();
                      $WebService4 = new WebService($webservice_config);
                      $account_info2 = array(
                          'iLogin' =>  $AccountNumber
                      );
                      $WebService4->request_account_details($account_info2);
                      if( $WebService4->request_status === 'RET_OK'){
                          $RegDate = $WebService4->get_result('RegDate');
                      }else{
                          $RegDate  = FXPP::getServerTime();
                      }

                      $mt_account = array(
                          'leverage' => $this->input->post('leverage', true),
                          'registration_leverage' => $this->input->post('leverage', true),
                          'amount' => $this->input->post('amount', true) ? $this->input->post('amount', true) : 0,
                          'mt_currency_base' => $this->input->post('mt_currency_base', true),
                          'mt_account_set_id' => $this->input->post('mt_account_set_id', true),
                          'registration_ip' => $_SERVER['REMOTE_ADDR'],
                          'registration_time' => date('Y-m-d H:i:s', strtotime($RegDate)),
                          'user_id' => $user_id,
                          'mt_type' => 1,
                          'swap_free' => $swap_free,
                          'account_number' => $AccountNumber,
                          'trader_password' => $TraderPassword,
                          'investor_password' => $InvestorPassword,
                          'phone_password' => $phone_password
                      );
                      $this->general_model->insert('mt_accounts_set', $mt_account);
                      $this->g_m->updatemy($table = "users", "id", $user_id, array('created' => date('Y-m-d H:i:s', strtotime($RegDate))));

//                    $getUserId = $this->q_m->getUserIdbyAccountNumber($account_number);
//                    $data['user_id'] = $getUserId;

                      $getCookieAffiliate = $this->input->cookie('forexmart_affiliate');
                      $forexmart_affiliate = empty($input_affiliate_code) ? $getCookieAffiliate : $input_affiliate_code;

                      if (!empty($forexmart_affiliate)) {
                          $this->load->model('account_model');
                          $getAccountNumberByAffiliateCode = $this->account_model->getAccountNumberByCode($forexmart_affiliate);
                          $AgentAccountNumber = $getAccountNumberByAffiliateCode['account_number'];

                          if (!empty($AgentAccountNumber)) {

                              $service_data = array(
                                  'AccountNumber' => $AccountNumber,
                                  'AgentAccountNumber' => $AgentAccountNumber
                              );

                              $webservice_config = array(
                                  'server' => 'live_new'
                              );
                              $WebService = new WebService($webservice_config);
                              $WebService->SetAccountAgent($service_data);
                              if ($WebService->request_status === 'RET_OK') {
                                  $referral_data = array(
                                      'referral_affiliate_code' => $forexmart_affiliate
                                  );
                                  $this->account_model->updateUserDetails('users_affiliate_code', 'users_id', $user_id, $referral_data);

                              }else{
                                  $agent_data = array(
                                      'user_id' => $user_id,
                                      'account_number' => $AccountNumber,
                                      'agent_account_number' => $AgentAccountNumber
                                  );
                                  $this->account_model->insertFailedSetAgent($agent_data);
                              }
                          }
                      }

                      // Invite friend status update
//                    $this->load->model('invite_model');
                      $email_user = $this->session->userdata('email_live');
                      $inv_ref = $forexmart_affiliate;
                      // $ref_code = $this->invite_model->getInvitedAffiliateCode($email_user);
                      $ref_code = $this->account_model->getInvitedRefCode($email_user,$user_id);
                      $tbl_code = 'ref_number';
                      $tbl_email = 'email';

                      $invite_data = array(
                          'status' => 8,
                          'user_id_after_registration' => $user_id
                      );

                      if($inv_ref == $ref_code){
                          $this->account_model->updateInviteDetails('invite_friends', $inv_ref, $tbl_code,$email_user,$tbl_email,$invite_data);
                      }
                      // end invite friend status update

                      $trading_experience = array(
                          'investment_knowledge' => $this->input->post('investment_knowledge', true),
                          'risk' => $this->input->post('risk', true),
                          'experience' => $this->input->post('experience', true),
                          'user_id' => $user_id,
                          'technical_analysis' => $this->input->post('technical_analysis', true),
                          'trade_duration' => $this->input->post('trade_duration', true),
                      );
                      $this->general_model->insert('trading_experience', $trading_experience);

                      $contacts_data = array(
                          'phone1' => $this->input->post('phone', true),
                          'user_id' => $user_id
                      );

                      $this->general_model->insert('contacts', $contacts_data);
                      $this->lang->load('live-account-html');


                      // send email  to user email
                      $email_data = array(
                          'full_name' => $this->session->userdata('full_name_live'),
                          'email' => $this->session->userdata('email_live'),
                          'password' => $password,
                          'account_number' => $mt_account['account_number'],
                          'trader_password' => $mt_account['trader_password'],
                          'investor_password' => $mt_account['investor_password'],
                          'phone_password' => $mt_account['phone_password'],
                      );
                      $subject = lang('liv_acc_htm_00'); //"ForexMart MT4 Live Trading Account details";
                      $config = array(
                          'mailtype' => 'html'
                      );


                      $isSendSuccess = $this->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data,$config);

                      if($isSendSuccess){
                          unset($_SESSION['ru_ctm_links']);
                          //Create Periodic Mailer
                          $fullname = $this->session->userdata('full_name_live');
                          $email = $this->session->userdata('email_live');

                          FXPP::createPeriodicMailer($email, $fullname);
                      }

                      $this->dailyCountryReport($user_id); // sent real time to the email groups

                      $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => true, 'error' => '', 'user_id' => $user_id)));

                  } else {
                      $mt_account = array(
                          'leverage' => $this->input->post('leverage', true),
                          'amount' => $this->input->post('amount', true) ? $this->input->post('amount', true) : 0,
                          'mt_currency_base' => $this->input->post('mt_currency_base', true),
                          'mt_account_set_id' => $this->input->post('mt_account_set_id', true),
                          'registration_ip' => $_SERVER['REMOTE_ADDR'],
                          'registration_time' => FXPP::getServerTime(),
                          'user_id' => $user_id,
                          'mt_type' => 1,
                          'swap_free' => $swap_free,
                          'account_number' => '',
                          'trader_password' => '',
                          'investor_password' => '',
                          'phone_password' => $phone_password
                      );
                      $this->general_model->insert('mt_accounts_set', $mt_account);
                      $getUserId = $this->q_m->getUserIdbyAccountNumber($account_number);
                      //print_r($getUserId);exit;
                      $data['user_id'] = $getUserId;
                      //print_r($data['user_id']);exit;
                      $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => false, 'error' => 'Oops, something goes wrong, please try once again in a few minutes.')));
                  }
              } else {
                  $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => false, 'error' => 'Country is not currently available. Try it again.')));
              }

          } else {
              if (FXPP::limit_15reg_24hrs() == true) {
                  $this->output->set_content_type('application/json')->set_output(json_encode(array('registration_limit' => true, 'success' => false, 'error' => 'You have reached the limit allowed in the registration of accounts.')));
              } else {
                  $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => false, 'error' => validation_errors())));
              }
//            echo json_encode(validation_errors());
          }
          // }
      } else {
          redirect('signout');
      }
    }

    private function autoPassword($nc, $a = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'){
        $l = strlen($a) - 1;
        $r = '';
        while ($nc-- > 0) $r .= $a{mt_rand(0, $l)};
        return $r;
    }

    public function getAffiliateLogs($input_affiliate_code)
    {
        $getCookieLogs = $this->input->cookie('forexmart_affiliate_logs');
        $affiliate_code = $this->input->cookie('forexmart_affiliate');

        if (empty($getCookieLogs) and !empty($affiliate_code)) {
            $getCookieLogs = $affiliate_code;
        }

        if (empty($getCookieLogs)) {
            $affiliate_code = $input_affiliate_code;
        } else {
            $affiliate_code = '-' . $input_affiliate_code;
        }

        if (!empty($input_affiliate_code)) {
            $getCookieLogs = $getCookieLogs . $affiliate_code;
        }

        return $getCookieLogs;
    }

    public function dailyCountryReport($user_id){
        $this->load->model('account_model');
        $this->load->model('general_model');

        if ($row = $insert_data['client_country'] = $this->account_model->getClientInfoByUserId($user_id)) {
            $c_code = $row[0]->country;

            $insert_data['country'] = $this->general_model->getCountries();
            $insert_data['country']["GB','IE"] = "UK and Ireland ";
            $insert_data['country']["AT','DE"] = "Austria and Germany ";
            $insert_data['country']["AM','BY','KZ','KG','MD','RU','TJ','TM','UA"] = "Russia and CIS";

            $to_email = array(
                "ES" => 'clients_spain_daily_1@forexmart.com',
                "AT" => 'clients_germany_daily_1@forexmart.com',
                "DE" => 'clients_germany_daily_1@forexmart.com',
                "FR" => 'clients_france_daily_1@forexmart.com',
                "GB" => 'clients_ukireland_daily_1@forexmart.com',
                "IE" => 'clients_ukireland_daily_1@forexmart.com',
                "BG" => 'clients_bulgaria_daily_1@Forexmart.com',
                "CA" => 'clients_ukireland_daily_1@forexmart.com',
                "NL" => 'clients_ukireland_daily_1@forexmart.com',
                "AM" => 'clients_russia_daily_1@forexmart.com',
                "BY" => 'clients_russia_daily_1@forexmart.com',
                "KZ" => 'clients_russia_daily_1@forexmart.com',
                "KG" => 'clients_russia_daily_1@forexmart.com',
                "MD" => 'clients_russia_daily_1@forexmart.com',
                "RU" => 'clients_russia_daily_1@forexmart.com',
                "TJ" => 'clients_russia_daily_1@forexmart.com',
                "TM" => 'clients_russia_daily_1@forexmart.com',
                "UA" => 'clients_russia_daily_1@forexmart.com',
                "UZ" => 'clients_russia_daily_1@forexmart.com',
                "PL" => 'clients_poland_daily_1@forexmart.com',
                "SK" => 'clients_czech.slovak_daily_1@forexmart.com',
                "CZ" => 'clients_czech.slovak_daily_1@forexmart.com',
                "IN" => "clients_india_daily_1@forexmart.com",
                "PK" => "clients_pakistan_daily_1@forexmart.com",
                "CF" => "clients_africa_daily_1@forexmart.com",
                "JM" => "clients_jamaica_daily_1@forexmart.com",
                "AU" => "clients_australia_daily_1@forexmart.com",
                "NZ" => "clients_australia_daily_1@forexmart.com",
                "MT" => "clients_malta_daily_1@forexmart.com",
                "SG" => "clients_singapore_daily_1@forexmart.com",
                "UZ" => "clients_uzbekistan_daily_1@forexmart.com",
                "TN" => "clients_france_daily_1@forexmart.com",
                "MA" => "clients_france_daily_1@forexmart.com",
                "MD" => "clients_moldavia_daily_1@forexmart.com",
                "RO" => "clients_romania_daily_1@forexmart.com",
                "MY" => "clients_malaysia_daily_1@forexmart.com",
            );

            if (isset($to_email[$c_code])) {

                if ($to_email[$c_code] == "clients_russia_daily_1@forexmart.com") {
                    if($exGroup = $this->general_model->where("cis_group_mail",array('email'=>$row[0]->email))){
                        $insert_data['email'] = "clients_russia_daily_".$exGroup->row()->group_id."@forexmart.com";
                        $this->general_model->insertmy('cis_group_mail_list',array('account_number'=>$row[0]->account_number,'group_id'=>$exGroup->row()->group_id));
                    }else{
                        $val = $this->account_model->getCISRegPerDay() %5;
                        if($val==0){
                            $insert_data['email'] = "clients_russia_daily_5@forexmart.com";
                            $this->general_model->insertmy('cis_group_mail',array('email'=>$row[0]->email,'group_id'=>5));
                            $this->general_model->insertmy('cis_group_mail_list',array('account_number'=>$row[0]->account_number,'group_id'=>5));
                        }else{
                            $insert_data['email'] = "clients_russia_daily_".$val."@forexmart.com";
                            $this->general_model->insertmy('cis_group_mail',array('email'=>$row[0]->email,'group_id'=>$val));
                            $this->general_model->insertmy('cis_group_mail_list',array('account_number'=>$row[0]->account_number,'group_id'=>$val));
                        }
                    }
                } else {
                    $insert_data['email'] = $to_email[$c_code];
                }
            } else {
                return true;
                $insert_data['email'] = "german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
            }

            $insert_data['subject'] = "Clients from " . $insert_data['country'][$c_code] . " on  " . date('Y-m-d');
            $config = array(
                'mailtype' => 'html'
            );

            $this->load->library('email');
            if ($config != null) {
                $this->email->initialize($config);
            }
            $this->SMTPDebug = 1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to($insert_data['email']);

            if (isset($to_email[$c_code])) {
                $this->email->bcc('german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com,pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com');
            } else {
                $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');
            }
            $this->email->subject($insert_data['subject']);
            $this->email->message($this->load->view('email/realtime_client_report', $insert_data, TRUE));
            $this->email->send();
        }

    }
    public function GenerateRandomAffiliateCode(){
        $this->load->model('account_model');
        $this->load->helper('string');
        $generateAffiliateCode = strtoupper(random_string('alpha', 5));
        $unique = $this->account_model->checkUniqueAffiliateCode($generateAffiliateCode);
        return ($unique) ? $generateAffiliateCode : self::GenerateRandomAffiliateCode();
    }

    public function checkAffiliateCode()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('affiliate_code', 'Referral Code', 'trim|required');
            if ($this->form_validation->run() == true) {
                $affiliate_code = $this->input->post('affiliate_code', true);
                $this->load->model('account_model');
                $getAccountNumberByAffiliateCode = $this->account_model->getAccountNumberByCode($affiliate_code);
                if ($getAccountNumberByAffiliateCode) {
                    // Invite friend status update
                        $inv_ref = $affiliate_code;
                        $email_user = $this->session->userdata('email_live');
                        $this->load->model('invite_model');
                        $inviter_affiliate_code = $this->invite_model->getInvitedAffiliateCode($email_user);
                        if ($inv_ref != $inviter_affiliate_code) {
                            $invite_data = array(
                                'status' => 7,
                                'bonus_status' => 7
                            );
                            $this->account_model->updateUserDetails('invite_friends', 'email', $email_user, $invite_data);
                        }
                    $error = false;
                } else {
                    $error = true;
                    $message = "Referral Code does not exist.";
                }
            } else {
                $error = true;
                $message = form_error('affiliate_code');
            }
            $data = array(
                'error' => $error,
                'message' => $message
            );
            echo json_encode($data);
        }
    }

    public function checkCountryLimit(){
        if ($this->input->is_ajax_request()) {
            $country = $this->input->post('country', true);
            if (in_array(strtoupper($country), array('PL'))) {
                $data['leverage_list'] = $this->general_model->selectOptionList($this->general_model->getLeverage(null, 100), isset($user_details['leverage']) ? $user_details['leverage'] : "1:100");
            } else {
                $data['leverage_list'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), isset($user_details['leverage']) ? $user_details['leverage'] : "1:200");
            }

            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if (in_array(strtoupper(trim($country)), $illicit_country)) {
                $data['banned'] = true;
            } else {
                $data['banned'] = false;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            show_404();
        }
    }

  public function passwordCheck(){
        $password = urldecode($this->input->post('pass', true));
        $this->load->library('Tank_auth');
        if ($this->input->post('status', true) == "demo") {
            $email = $this->session->userdata('email_demo');
        } else {
            $email = $this->session->userdata('email_live');
        }

        if ((strlen($email) > 0) AND (strlen($password) > 0)) {

            if (!is_null($users = $this->users->get_user_by_email($email))) { // login ok
                //print_r($users);
                //exit();
                // Does password match hash in database?
                $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'),
                    $this->config->item('phpass_hash_portable', 'tank_auth'));

                foreach ($users as $user) {
                    if ($hasher->CheckPassword($password, $user->password)) { // password ok
                        echo "true";
                        return true;
                    }
                }
            } else { // fail - wrong login
            }
        }
        return FALSE;
    }

    public function insertEmploymentDetails(){
      $new_account_user_id = $this->session->userdata('new_account_user_id');
      //print_r($new_account_user_id); exit;
      if ($this->session->userdata('new_account_user_id')) {
            $employment_detail = array(
                'employment_status' => $this->input->post('employment_status', true),
                'industry' => $this->input->post('industry', true),
                'source_of_funds' => $this->input->post('source_of_funds', true),
                'estimated_annual_income' => $this->input->post('estimated_annual_income', true),
                'estimated_net_worth' => $this->input->post('estimated_net_worth', true),
                'politically_exposed_person' => $this->input->post('politically_exposed_person', true),
                'education_level' => $this->input->post('education_level', true),
                'us_resident' => $this->input->post('us_resident', true),
                'us_citizen' => $this->input->post('us_citizen', true),
                'user_id' => $new_account_user_id
            );
            $emp_details = $this->general_model->insert('employment_details', $employment_detail);
            //var_dump($employment_detail); 
            //exit;
        }
        if($emp_details!=''){
          $data['success'] = true;
        }
        else{
          $data['success'] = false; 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $data['success'])));
    }

     public function upload(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $new_account_user_id = $this->session->userdata('new_account_user_id');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

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
            $config['max_size']      = '10240';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $config['overwrite']     = false; //DO NOT CHANGE
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            try{
                if($this->upload->do_upload()){
                    $uploadData = $this->upload->data();
                    $updData = array(
                        'user_id' => $new_account_user_id,
                        'doc_type' => $this->input->post('doc_type',true),
                        'file_name' => $uploadData['file_name'],
                        'client_name' => $uploadData['client_name'],
                        'status' => 0,
                    );
                    $this->load->library('image_lib');
                    $config['source_image'] = "/var/www/html/my.forexmart.com/assets/user_docs/". $uploadData['file_name'];
                    /*if (substr(strtolower($uploadData['file_name']), -3)!='pdf'){
                        FXPP::setWaterMark($config['source_image']);
                    }*/
                    FXPP::setWaterMark($config['source_image']);

                    $this->g_m->insertmy($table="user_documents",$updData);
                    $data['error'] = false;
                    $data['msg'] = $this->image_lib->display_errors();
                    $data['msgError_ext']=false;
                }else{
                    $data['msgError'] = $this->upload->display_errors();
                    $data['error'] = true;

                    //http://php.net/manual/en/function.exif-imagetype.php
                    $data['filetype'] = exif_imagetype($_FILES['file']['tmp_name']);
                    $data['filetype2']=strtolower($_FILES['file']['type']);
                    $data['msgError_ext']=false;
                    switch(strtolower($_FILES['file']['type'])){
                        case 'image/gif':
                            if (exif_imagetype($_FILES['file']['tmp_name'])==1){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        case 'image/jpeg':
                            if (exif_imagetype($_FILES['file']['tmp_name'])==2){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        case 'image/png':
                            if (exif_imagetype($_FILES['file']['tmp_name'])==3){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        default:
                    }

                }
            } catch(Exception $e){


                $data['msgError_ext']=false;
                if (strpos($e->getMessage(), 'pdf') !== false) {
                    $data['msgError']="The PDF file type that you uploaded is not supported.";
                }else{
                    $data['msgError'] = $e->getMessage() ;
                }
                $data['error'] = true;
            }

        }else{
            $data['msgError'] = 'Please select a file.';
            $data['error'] = true;
        }
        echo json_encode($data);
    }

    public function deleteIncomplete(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

      // Delete the incomplete  register email
        $delete_inc = $this->Account_model->ret_delete("incomplete_registers", "email", $this->session->userdata('email_live'));

        //print_r($delete_inc . 'luh'); exit;
        if($delete_inc){
          $data['success'] = true;
        }
        else{
          $data['success'] = false; 
        }

            //$TraderPassword = $WebService->get_result('TraderPassword');
            $accounts = $this->Account_model->getAccountsByUserId($this->session->userdata('new_account_user_id'));
            //print_r($accounts[0]['account_number']); exit;
            //$account_info= $this->getUserdetails($accounts[0]['TraderPassword']);
            //print_r($account_info); exit;
            $this->session->set_flashdata("userdet1", $this->session->userdata('email_live'));
            $this->session->set_flashdata("userdet2", $accounts[0]['trader_password']);

        //print_r($accounts[0]['trader_password']. $this->session->userdata('email_live')); exit;
        $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $data['success'], 'user' => $this->session->userdata('email_live'), 'pass' => $accounts[0]['trader_password'])));
       // $link = anchor('document/index', 'cancel');
       // $message = 'Open account successful!' .' '. $link .' '. 'GO TO CLIENT CABINET.';
       // $this->session->set_flashdata('success', $message);
       // redirect(FXPP::my_url('my-account' . '?' . $this->session->userdata('analytic_hash')));
        }

     public function getUserdetails($account_number){
        $webservice_config = array(  'server' => 'live_new'  );
        $webService = new WebService($webservice_config);
        $data = array( 'iLogin' => $account_number );
        $webService->request_account_details($data);
        if ($webService->request_status === 'RET_OK') {
            $data = $webService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }
}