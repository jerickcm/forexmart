<?php

class Manual_task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(IPLoc::WhitelistPIPCandCC()) {
            $this->load->library('WebService');
        }else{
            show_404();
        }
        $this->load->helper(array('form', 'url'));
        $this->load->model('general_model');
        $this->load->model('user_model');
        $this->load->model('partnership_model');
        $this->g_m = $this->general_model;
    }

    #FXPP-4613
    public function change_partner_password(){
        error_reporting(E_ALL);
        $this->load->library('tank_auth');
        $account_numbers = array('110113', '115400', '139205', '140624', '142055', '142056', '142057', '142941');
        foreach($account_numbers as $account_number){
            $partner = $this->partnership_model->getAccountByAccountNumber($account_number);
            $trader_password = $partner['trader_password'];
            if(trim($trader_password) == ''){
                $trader_password = FXPP::RandomizeCharacter(7);
                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array('account_number' => $account_number, 'password' => $trader_password);
                $WebService->changeUserMasterPasswordAdmin($account_info);
                if ($WebService->request_status === 'RET_OK') {
                    $account_data = array('trader_password' => $trader_password);
                    if($this->partnership_model->updateAccountByPartnerId($partner['partner_id'], $account_data)){
                        $hasher = new PasswordHash(
                            $this->config->item('phpass_hash_strength', 'tank_auth'),
                            $this->config->item('phpass_hash_portable', 'tank_auth'));
                        $hashed_password = $hasher->HashPassword($trader_password);

                        $this->user_model->updateUserById($partner['partner_id'], 'password', $hashed_password);
                        echo '|' . $account_number . '|' . $trader_password . '|' . '<br/>';
                    }
                }else{
                    echo $WebService->request_status;
                }
            }else{
                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array('account_number' => $account_number, 'password' => $trader_password);
                $WebService->changeUserMasterPasswordAdmin($account_info);
                if ($WebService->request_status === 'RET_OK') {
                    $account_data = array('trader_password' => $trader_password);
                    if($this->partnership_model->updateAccountByPartnerId($partner['partner_id'], $account_data)){
                        $hasher = new PasswordHash(
                            $this->config->item('phpass_hash_strength', 'tank_auth'),
                            $this->config->item('phpass_hash_portable', 'tank_auth'));
                        $hashed_password = $hasher->HashPassword($trader_password);
                        $this->user_model->updateUserById($partner['partner_id'], 'password', $hashed_password);
                        echo '|' . $account_number . '|' . $trader_password . '|' . '<br/>';
                    }
                }else{
                    echo $WebService->request_status;
                }
            }
        }
    }

    public function createManualAccount(){
        $this->load->library('tank_auth');
        $login_type = 0; //login_type 0 = client user / 1 = partner user
        $use_username = $this->config->item('use_username', 'tank_auth');
        $email_activation = $this->config->item('email_activation', 'tank_auth');
        $password = 'vkUV6Lh';

        $user_inser_data = $this->tank_auth->create_user(
            '',
            'Email@mail.com',
            $password,
            $email_activation, 1, $login_type);
        $user_id = $user_inser_data['user_id'];
        $profile = array(
            'full_name' => 'Test Affiliate',
            'user_id' => $user_id,
            'country' => 'DE',
            'street' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zip' => 478,
            'dob' => '1986-01-01'
        );

        $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.
        $swap_free = 0;
        $phone_password = FXPP::RandomizeCharacter(7);
        $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
        $affiliate_code_data = array(
            'users_id' => $user_id,
            'affiliate_code' => $generateAffiliateCode
        );

        $this->general_model->insert('users_affiliate_code', $affiliate_code_data);

        $mt_account = array(
            'leverage' => '1:100',
            'registration_leverage' => '1:100',
            'amount' => $this->input->post('amount', true) ? $this->input->post('amount', true) : 0,
            'mt_currency_base' => 'USD',
            'mt_account_set_id' => 1,
            'registration_ip' => '148.251.122.78',
            'registration_time' => '2015-11-05 11:08:46',
            'user_id' => $user_id,
            'mt_type' => 1,
            'swap_free' => $swap_free,
            'account_number' => '102032',
            'trader_password' => 'vkUV6Lh',
            'investor_password' => 'on3mreC',
            'phone_password' => $phone_password
        );
        $this->general_model->insert('mt_accounts_set', $mt_account);

        $trading_experience = array(
            'investment_knowledge' => 1,
            'risk' => 1,
            'experience' => 1,
            'user_id' => $user_id,
            'technical_analysis' => 1,
            'trade_duration' => 0,
        );
        $this->general_model->insert('trading_experience', $trading_experience);

        $contacts_data = array(
            'phone1' => '123478-89891',
            'user_id' => $user_id
        );
        $this->general_model->insert('contacts', $contacts_data);
    }

    public function exchangeNewClientAccount(){
        $this->load->model('account_model');
        $account_number = 1087;
        $user_details = $this->account_model->getAccountDetailsByAccountNumber($account_number);
//        $login_type = 0;
//        $email_activation = $this->config->item('email_activation', 'tank_auth');

//        $password = urldecode($this->form_validation->set_value('password'));
//        if ($this->input->post('auto_generate', true) == 1) {
//            $password = $this->autoPassword(8);
//        }
//
//        $user_inser_data = $this->tank_auth->create_user(
//            '',
//            $user_details['email'],
//            $password,
//            $email_activation, 1, $login_type);
//
//
//        $user_id = $user_inser_data['user_id'];
//
//        $user_data = array(
//            'user_id' => $user_id,
//        );
//        $this->session->set_userdata($user_data);
//
//        $data['random_alpha_string_analytics'] = '';
//        $data['random_alpha_string_analytics'] = 'z42esbsn4yqu2p';
//        $data['save_hash'] = array(
//            'first_login_hash' => $data['random_alpha_string_analytics'],
//            'first_login_stat' => 1,
//            'registration_location'=>1,
//        );
//        $this->general_model->update('users', 'id', $user_id, $data['save_hash']);

//        $profile = array(
//            'full_name' => $user_details['full_name'],
//            'user_id' => $user_id,
//            'country' => $user_details['country'],
//            'street' => $user_details['street'],
//            'city' => $user_details['city'],
//            'state' => $user_details['state'],
//            'zip' => $user_details['zip'],
//            'dob' => $user_details['dob']
//        );
//
//        $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

        $swap_free = $user_details['swap_free'];
        $swap_free = empty($swap_free) ? 0 : 1;
        $phone_password = FXPP::RandomizeCharacter(7);

        $mt_set_id = $user_details['mt_account_set_id'];

        if(IPLoc::isChinaIP() || $user_details['country'] == 'CN' || FXPP::html_url() == 'zh' ){
            $this->session->set_userdata('isChina', '1');
        }

        $groupCurrency = $this->general_model->getGroupCurrency((int)$mt_set_id, $user_details['mt_currency_base'], $swap_free).'1';

        // Save Affiliate Link
//        $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
//        $affiliate_code_data = array(
//            'users_id' => $user_id,
//            'affiliate_code' => $generateAffiliateCode
//        );
//
//        $this->general_model->insert('users_affiliate_code', $affiliate_code_data);

//        $input_affiliate_code = $this->input->post('affiliate_code', true);
//        $affiliate_code_logs = self::getAffiliateLogs($input_affiliate_code);
//        $affiliate_referral_codes = ':' . str_replace('-', ':', $affiliate_code_logs);

        $webservice_config = array(
            'server' => 'live_new'
        );

        $service_account_info = array(
            'iLogin' => $account_number
        );
        $AccountWebService = new WebService($webservice_config);
        $AccountWebService->open_RequestAccountDetails($service_account_info);

        $account_comment = '';
        if($AccountWebService->request_status == 'RET_OK'){
            $account_comment = $AccountWebService->get_result('Comment');
        }

        $service_data = array(
            'address' => $user_details['street'],
            'city' => $user_details['city'],
            'country' => $this->general_model->getCountries($user_details['country']),
            'email' => $user_details['email'],
            'group' => $groupCurrency,
            'leverage' => count($ex_leverage = explode(":", $user_details['leverage'])) > 1 ? $ex_leverage[1] : $user_details['leverage'],
            'name' => $user_details['full_name'],
            'phone_number' => $user_details['phone1'],
            'state' => $user_details['state'],
            'zip_code' => $user_details['zip'],
            'phone_password' => $phone_password,
            'comment' => $account_comment
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
                'leverage' => $user_details['leverage'],
                'registration_leverage' => $user_details['leverage'],
                'amount' => 0,
                'mt_currency_base' => $user_details['mt_currency_base'],
                'mt_account_set_id' => $user_details['mt_account_set_id'],
                'registration_ip' => $user_details['registration_ip'],
                'registration_time' => date('Y-m-d H:i:s', strtotime($RegDate)),
                'user_id' => 0,
                'mt_type' => 1,
                'swap_free' => $swap_free,
                'account_number' => $AccountNumber,
                'trader_password' => $TraderPassword,
                'investor_password' => $InvestorPassword,
                'phone_password' => $phone_password
            );

//            if($this->general_model->insert('mt_accounts_set', $mt_account)){
                print_r($mt_account);
//            }
//            $this->g_m->updatemy($table = "users", "id", $user_id, array('created' => date('Y-m-d H:i:s', strtotime($RegDate))));

//            $getCookieAffiliate = $this->input->cookie('forexmart_affiliate');
//            $forexmart_affiliate = $this->user_model->getUserReferralAffiliateCode($user_details['user_id']);
//
//            if (!empty($forexmart_affiliate)) {
//                $this->load->model('account_model');
//                $getAccountNumberByAffiliateCode = $this->account_model->getAccountNumberByCode($forexmart_affiliate);
//                $AgentAccountNumber = $getAccountNumberByAffiliateCode['account_number'];
//
//                if (!empty($AgentAccountNumber)) {
//
//                    $service_data = array(
//                        'AccountNumber' => $AccountNumber,
//                        'AgentAccountNumber' => $AgentAccountNumber
//                    );
//
//                    $webservice_config = array(
//                        'server' => 'live_new'
//                    );
//                    $WebService = new WebService($webservice_config);
//                    $WebService->SetAccountAgent($service_data);
//                    if ($WebService->request_status === 'RET_OK') {
//                        $referral_data = array(
//                            'referral_affiliate_code' => $forexmart_affiliate
//                        );
//                        $this->account_model->updateUserDetails('users_affiliate_code', 'users_id', $user_id, $referral_data);
//
//                        // Invite friend status update
////                        $this->load->model('invite_model');
////                        $email_user = $this->session->userdata('email_live');
////                        $inv_ref = $forexmart_affiliate;
////                        $ref_code = $this->invite_model->getInvitedAffiliateCode($email_user);
////                        $tbl_code = 'user_affiliate_code';
////                        $tbl_email = 'email';
////
////                        $invite_data = array(
////                            'status' => 8
////                        );
////
////                        if($inv_ref == $ref_code){
////                            $this->invite_model->updateInviteDetails('invite_friends', $inv_ref, $tbl_code,$email_user,$tbl_email,$invite_data);
////                        }
//                        // end invite friend status update
//
//
//                    }
//
//
//                }
//            }
//
//            $trading_experience_details = $this->user_model->getUserTradingExperience($user_details['user_id']);
//            if($trading_experience_details){
//                $trading_experience = array(
//                    'investment_knowledge' => $trading_experience_details['investment_knowledge'],
//                    'risk' => $trading_experience_details['risk'],
//                    'experience' => $trading_experience_details['experience'],
//                    'user_id' => $user_id,
//                    'technical_analysis' => $trading_experience_details['technical_analysis'],
//                    'trade_duration' => $trading_experience_details['trade_duration'],
//                );
//                $this->general_model->insert('trading_experience', $trading_experience);
//            }
//
//            $contact_details = $this->user_model->getUserContact($user_details['user_id']);
//            if($contact_details){
//                $contacts_data = array(
//                    'phone1' => $this->input->post('phone', true),
//                    'user_id' => $user_id
//                );
//                $this->general_model->insert('contacts', $contacts_data);
//            }


            // send email  to user email
//            $email_data = array(
//                'full_name' => $this->session->userdata('full_name_live'),
//                'email' => $this->session->userdata('email_live'),
//                'password' => $password,
//                'account_number' => $mt_account['account_number'],
//                'trader_password' => $mt_account['trader_password'],
//                'investor_password' => $mt_account['investor_password'],
//                'phone_password' => $mt_account['phone_password'],
//            );
//            $subject = lang('liv_acc_htm_00'); //"ForexMart MT4 Live Trading Account details";
//            $config = array(
//                'mailtype' => 'html'
//            );

//            $isSendSuccess = $this->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data,$config);
//
//            if($isSendSuccess){
//                //Create Periodic Mailer
//                $fullname = $this->session->userdata('full_name_live');
//                $email = $this->session->userdata('email_live');
//
//                FXPP::createPeriodicMailer($email, $fullname);
//            }

            //send debug email - daryll
//                    $debug_data = array(
//                        'message' => 'RegDate: ' . date('Y-m-d H:i:s', strtotime($RegDate)) . '<br/> API RegDate: ' . $RegDate
//                    );
//                    $this->general_model->sendEmail('debug-html', 'Debug', 'vela.nightclad@gmail.com', $debug_data,$config);

//            $this->dailyCountryReport($user_id); // sent real time to the email groups

//            $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => true, 'error' => '')));

        }
    }
}