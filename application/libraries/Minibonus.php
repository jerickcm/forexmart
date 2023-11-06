<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Minibonus {

    function __construct(){

        FXPP::CI()->load->library('Fx_mailer');
        FXPP::CI()->load->library('form_validation');
        FXPP::CI()->load->helper(array('form', 'url'));
        FXPP::CI()->load->model('account_model');
        FXPP::CI()->load->model('deposit_model');

        FXPP::CI()->load->library('tank_auth');
        FXPP::CI()->load->helper('string');
        FXPP::CI()->lang->load('tank_auth');

        FXPP::CI()->flag = 1;

        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;

        FXPP::CI()->user_country = FXPP::getUserCountryCode();
        FXPP::CI()->load->library('tank_auth');
        FXPP::CI()->lang->load('tank_auth');
        FXPP::CI()->lang->load('register');
        FXPP::CI()->country_code = FXPP::getUserCountryCode() or null;

    }

    public static function mark_all_inactiveaccounts() {

        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;
        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m = FXPP::CI()->Minibonus_model;
        $data = FXPP::CI()->mb_m->all_live_users();

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        foreach ($data as $key => $value) {

            $data = array(
                'iLogin' => $value['account_number']
            );
            $WebService->open_Request_Inactive_Account_Details($data);
            if ($WebService->request_status === 'RET_OK') {

                //inactive
                $mtas = FXPP::CI()->g_m->showssingle2($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $select = 'inactive_date,inactive_counter');
                $save_data = array(
                    'active' => 5,
                    'inactive_date' => ($mtas['inactive_date'] == Null) ? FXPP::getServerTime() : $mtas['inactive_date'],
                    'inactive_counter' => $mtas['inactive_counter'] + 1,
                );
                FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = $save_data);

            } else {

            }
        }
        self::mark_for_non_ndb();
    }

    private static function mark_for_non_ndb() {
//    public static function mark_for_non_ndb() {

        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;

        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m = FXPP::CI()->Minibonus_model;

        // account status 1
        // active is 4
        // is_ndb_acquire_from_another_account <> 1 and <> 2

        $data['specific_inactive'] = FXPP::CI()->mb_m->all_live_users_validations();

        foreach ($data['specific_inactive'] as $key => $value) {

            $no_deposit = FXPP::CI()->g_m->showssingle2($table = 'no_deposit', $field = 'account_number', $id = $value['account_number'], $select = '*');

            if ($no_deposit) {

            } else {

                $OtherAccount_is_enable = True;

                $ThisAccount_is_enable = True;

                $count_active_accounts = 0;
                $has_ndbmini_uniquetag1st = false;

                $accounts = '';

                //check for account fullname
                $data['accountfullname'] = FXPP::CI()->mb_m->showFullname_v2(
                    $table1 = 'users', $table2 = 'user_profiles', $table3 = 'mt_accounts_set',
                    $field2 = 'user_profiles.full_name', $id2 = trim($value['full_name']),
                    $field1 = 'user_profiles.dob', $id1 = trim($value['dob']),
                    $field3 = 'users.ndb_bonus!=', $id3 = '',
                    $field4 = 'users.id !=', $id4 = $value['user_id'],
                    $join12 = 'users.id=user_profiles.user_id',
                    $join13 = 'users.id=mt_accounts_set.user_id',
                    $select = 'ndb_bonus,users.email,user_profiles.dob,account_number,nodepositbonus,ndbmini_uniquetag1st'
                );

                //check for account email
                $data['accountemail'] = FXPP::CI()->mb_m->showEmail_v2(
                    $table1 = 'users', $table2 = 'user_profiles', $table3 = 'mt_accounts_set',
                    $field1 = 'UCASE(users.email)', $id1 = strtoupper($value['email']),
                    $field3 = 'users.ndb_bonus!=', $id3 = '',
                    $field4 = 'users.id !=', $id4 = $value['user_id'],
                    $join12 = 'users.id=user_profiles.user_id',
                    $join13 = 'users.id=mt_accounts_set.user_id',
                    $select = 'ndb_bonus,users.email,account_number,nodepositbonus,ndbmini_uniquetag1st'
                );
                $webservice_config = array('server' => 'live_new');
                $WebServiceX = new WebService($webservice_config);

                $IsAcquiredFromOtherAccount = false;
                //check for account fullname
                if ($data['accountfullname']) {

                    foreach ($data['accountfullname'] as $key1 => $value1) {

                        if($value1['ndbmini_uniquetag1st']==1){
                            $has_ndbmini_uniquetag1st = True;
                        }

                        if ((!isset($value1['ndb_bonus'])) || trim($value1['ndb_bonus']) === '') {

                        } else if (is_null($value1['ndb_bonus'])) {

                        } else {

                            $IsAcquiredFromOtherAccount = true;
                        }

                        $account_info = array(
                            'iLogin' => $value1['account_number']
                        );

                        $webservice_config = array('server' => 'live_new');

                        $WebService2 = new WebService($webservice_config);

                        $WebService2->open_RequestAccountDetails($account_info);

                        if ($WebService2->request_status === 'RET_OK') {
                            if ($WebService2->get_result('IsEnable') == False) {

                                $OtherAccount_is_enable = False;

                                FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value1['account_number'], $data = array('is_enabled' => 2));

                            } else {

                                FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value1['account_number'], $data = array('is_enabled' => 1));

                            }
                        }

                        //check for active accounts using inactive account check method.
                        $WebServiceX->open_Request_Inactive_Account_Details($account_info);
                        if ($WebServiceX->request_status === 'RET_OK') {

                        }else{
                            $count_active_accounts = $count_active_accounts + 1;
                            $accounts .= $value1['account_number'] . ',';
                        }


                    }

                }

                //check for account email
                $webservice_config = array('server' => 'live_new');
                $WebServiceY = new WebService($webservice_config);
                if ($data['accountemail']) {
                    foreach ($data['accountemail'] as $key2 => $value2) {

                        if($value2['ndbmini_uniquetag1st']==1){
                            $has_ndbmini_uniquetag1st = True;
                        }

                        if ((!isset($value2['ndb_bonus'])) || trim($value2['ndb_bonus']) === '') {

                        } else if (is_null($value2['ndb_bonus'])) {
                            $OtherAccount_is_enable = False;
                            FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value1['account_number'], $data = array('is_enabled' => 2));
                        } else {
                            $IsAcquiredFromOtherAccount = true;
                        }

                        $account_info = array(
                            'iLogin' => $value2['account_number']
                        );
                        $WebService3 = new WebService($webservice_config);
                        $WebService3->open_RequestAccountDetails($account_info);
                        if ($WebService3->request_status === 'RET_OK') {
                            if ($WebService3->get_result('IsEnable') == False) {

                            }else{
                                FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value1['account_number'], $data = array('is_enabled' => 1));
                            }
                        }

                        //check for active accounts using inactive account check method.
                        $WebServiceY->open_Request_Inactive_Account_Details($account_info);
                        if ($WebServiceY->request_status === 'RET_OK') {

                        }else{
                            $count_active_accounts = $count_active_accounts + 1;
                            $accounts .= $value2['account_number'] . ',';
                        }

                    }
                }

                if ($count_active_accounts > 0) {
                    FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = array('has_activeaccount' => 1));
                } else {
                    FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = array('has_activeaccount' => 2));
                }

                if ($IsAcquiredFromOtherAccount == true) {

                    FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = array('is_ndb_acquire_from_another_account' => 1));
                } else {
                    // trigger open
                    FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = array('is_ndb_acquire_from_another_account' => 2));
                }

                if ($IsAcquiredFromOtherAccount == false and $count_active_accounts < 1 and $ThisAccount_is_enable == True and $has_ndbmini_uniquetag1st==False) {
                    // validate all query validations for all_live_accounts_validations
                    FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = array('restored_inactive_account' => 4,'ndbmini_uniquetag1st'=>1));
                }
            }

        }
        self::mark_inactive_accounts();

    }

    private static function mark_inactive_accounts(){

        //stable use
//        if (!IPLOC::Office_and_Vpn()){die();}
        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;

        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m = FXPP::CI()->Minibonus_model;

        $data['ready_to_restore'] = FXPP::CI()->mb_m->all_live_users_restoration();


        foreach ($data['ready_to_restore'] as $key => $value) {

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);

            $data = array(
                'iLogin' => $value['account_number']
            );
            $WebService->open_Request_Inactive_Account_Details($data);
            if ($WebService->request_status === 'RET_OK') {
                //inactive
                FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = array('new_account_ready', 1));
            } else {
            }

        }
        self::credit_accounts();
    }

//    private static function credit_accounts(){
    public static function credit_accounts(){
        //stable use


        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;

        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m=FXPP::CI()->Minibonus_model;

        $data['ready_to_restore'] = FXPP::CI()->mb_m->FXPP_4280();

        $comment = 'FOREXMART NO DEPOSIT BONUS';
        $amount = 10;

        foreach( $data['ready_to_restore']  as $key => $value ){

            $new_account_number='';

            $webservice_config = array('server' => 'live_new');
            $account_info = array(
                'iLogin' => $acctnmbr=$value['account_number']
            );
            $WebServiceCheckEnabled = new WebService($webservice_config);
            $WebServiceCheckEnabled->open_RequestAccountDetails($account_info);

            if( $WebServiceCheckEnabled->request_status === 'RET_OK' ) {
                if ($WebServiceCheckEnabled->get_result('IsEnable')==False){

                    FXPP::CI()->general_model->updatemy($table='mt_accounts_set',$field='account_number',$id=$acctnmbr,$data=array('is_enabled'=>2));

                }else{

                    $mtas = FXPP::CI()->g_m->showssingle($table='mt_accounts_set',$field="account_number",$id=$acctnmbr,$select="*",$order_by="");
                    $c_user_id = $mtas['user_id'];
                    $usrs = FXPP::CI()->g_m->showssingle($table='users',$field="id",$id=$c_user_id,$select="*",$order_by="");
                    $usr_prfls = FXPP::CI()->g_m->showssingle($table='user_profiles',$field="user_id",$id=$c_user_id,$select="*",$order_by="");
                    $cntcts = FXPP::CI()->g_m->showssingle($table='contacts',$field="user_id",$id=$c_user_id,$select="*",$order_by="");
                    $trdng_xprnc = FXPP::CI()->g_m->showssingle($table='trading_experience',$field="user_id",$id=$c_user_id,$select="*",$order_by="");

                    // duplicate Live www registration
                    $date = new DateTime(FXPP::getServerTime());
                    $date_db_last_update = new DateTime($mtas['inactive_date']);
                    $diff = $date->diff($date_db_last_update);

//                    if(($mtas['inactive_counter'])>=12 and ( intval((($diff->format('%y') * 12) + $diff->format('%m')))>=12)){

                        $login_type = 0;
                        $use_username = FXPP::CI()->config->item('use_username', 'tank_auth');
                        $email_activation = FXPP::CI()->config->item('email_activation', 'tank_auth');
                        $password = self::autoPassword(8);

                        $user_inser_data = FXPP::CI()->tank_auth->create_user(
                            $use_username ? FXPP::CI()->form_validation->set_value('username') : '',
                            $usrs['email'],
                            $password,
                            $email_activation, 1, $login_type);
                        $user_id = $user_inser_data['user_id'];
                        $user_data = array(
                            'user_id' => $user_id,
                        );
                        FXPP::CI()->session->set_userdata($user_data);

                        $data['random_alpha_string_analytics'] = '';
                        $data['random_alpha_string_analytics'] = 'z42esbsn4yqu2p';
                        $data['save_hash'] = array(
                            'first_login_hash' => $data['random_alpha_string_analytics'],
                            'first_login_stat' => 1,
                            'auto_created_account'=>1
                        );
                        FXPP::CI()->general_model->update('users', 'id', $user_id, $data['save_hash']);
                        $user_data = array(
                            'analytic_hash' => $data['random_alpha_string_analytics'],
                        );
                        FXPP::CI()->session->set_userdata($user_data);

                        $profile = array(
                            'full_name' => $usr_prfls['full_name'],
                            'user_id' => $user_id,
                            'country' => $usr_prfls['country'],
                            'street' => $usr_prfls['street'],
                            'city' => $usr_prfls['city'],
                            'state' => $usr_prfls['state'],
                            'zip' => $usr_prfls['zip'],
                            'dob' => $usr_prfls['dob']
                        );

                        if ($usr_prfls['country'] == 'PL') {
                            $_SESSION['temp_country'] = 'PL';
                        }

                        FXPP::CI()->general_model->insert('user_profiles', $profile);

                        $swap_free = $mtas['swap_free'];
                        $swap_free = empty($swap_free) ? 0 : 1;
                        $phone_password = FXPP::RandomizeCharacter(7);

                        /*  =============== Spread project  setting ================================ */
                        $speardGroup = FXPP::CI()->input->cookie('forexmart_account_type');  // Here store spread of value using affiliateChecker hook.
                        $mt_set_id =$mtas['mt_account_set_id'];
                        $speardGroup = $mt_set_id==1? "refSt".$speardGroup:"refZe".$speardGroup;

                        if(!FXPP::CI()->general_model->getGroupSpard($speardGroup)){

                            $groupCurrency = FXPP::CI()->general_model->getGroupCurrency((int)$mt_set_id, $mtas['mt_currency_base'] , $swap_free).'1';

                        }else{

                            $groupCurrency = $speardGroup;
                        }

                        /*  =============== End Spread project  setting ================================ */


                        // Save Affiliate Link
                        $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                        $affiliate_code_data = array(
                            'users_id' => $user_id,
                            'affiliate_code' => $generateAffiliateCode
                        );

                        FXPP::CI()->general_model->insert('users_affiliate_code', $affiliate_code_data);

                        $input_affiliate_code = '';
                        $affiliate_code_logs = self::getAffiliateLogs($input_affiliate_code);
                        $affiliate_referral_codes = ':' . str_replace('-', ':', $affiliate_code_logs);

                        $service_data = array(
                            'address' => $usr_prfls['street'],
                            'city' => $usr_prfls['city'],
                            'country' => $usr_prfls['country'],
                            'email' => $usrs['email'],
                            'group' => $groupCurrency,
                            'leverage' => $mtas['leverage'],
                            'name' => $usr_prfls['full_name'],
                            'phone_number' => $cntcts['phone1'],
                            'state' => $usr_prfls['state'],
                            'zip_code' => $usr_prfls['zip'],
                            'phone_password' => $phone_password,
                            'comment' => strtolower('EN') . ':' . $mtas['registration_ip'] . $affiliate_referral_codes
                        );

                        $webservice_config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($webservice_config);
                        $WebService->open_account_standard($service_data);

                        if ($WebService->request_status === 'RET_OK') {
                            FXPP::CI()->g_m->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $acctnmbr, $data = array('old_account_created_newaccount'=>1));

                            $AccountNumber = $WebService->get_result('LogIn');
                            $TraderPassword = $WebService->get_result('TraderPassword');
                            $InvestorPassword = $WebService->get_result('InvestorPassword');
                            $RegDate = FXPP::getServerTime();
                            $mt_account = array(
                                'leverage' => $mtas['leverage'],
                                'registration_leverage' =>$mtas['leverage'],
                                'amount' => 0,
                                'mt_currency_base' => $mtas['mt_currency_base'],
                                'mt_account_set_id' => $mtas['mt_account_set_id'],
                                'registration_ip' => $mtas['registration_ip'],
                                'registration_time' => date('Y-m-d H:i:s', strtotime($RegDate)),
                                'user_id' => $user_id,
                                'mt_type' => 1,
                                'swap_free' => $swap_free,
                                'account_number' => $new_account_number=$AccountNumber,
                                'trader_password' => $TraderPassword,
                                'investor_password' => $InvestorPassword,
                                'phone_password' => $phone_password
                            );

                            FXPP::CI()->general_model->insert('mt_accounts_set', $mt_account);

                            $getCookieAffiliate = FXPP::CI()->input->cookie('forexmart_affiliate');
                            $forexmart_affiliate = empty($input_affiliate_code) ? $getCookieAffiliate : $input_affiliate_code;

                            $trading_experience = array(
                                'investment_knowledge' => $trdng_xprnc['investment_knowledge'],
                                'risk' => $trdng_xprnc['risk'],
                                'experience' => $trdng_xprnc['experience'],
                                'user_id' => $user_id,
                                'technical_analysis' => $trdng_xprnc['technical_analysis'],
                                'trade_duration' => $trdng_xprnc['trade_duration'],
                            );

                            FXPP::CI()->general_model->insert('trading_experience', $trading_experience);

                            $contacts_data = array(
                                'phone1' => $cntcts['phone1'],
                                'user_id' => $user_id
                            );
                            FXPP::CI()->general_model->insert('contacts', $contacts_data);


                            // send email  to user email
                            $email_data = array(
                                'full_name' => $usr_prfls['full_name'],
                                'email' => $usrs['email'],
                                'password' => $password,
                                'account_number' => $mt_account['account_number'],
                                'trader_password' => $mt_account['trader_password'],
                                'investor_password' => $mt_account['investor_password'],
                                'phone_password' => $mt_account['phone_password'],
                            );
                            $subject = "ForexMart MT4 Live Trading Account details";
                            $config = array(
                                'mailtype' => 'html'
                            );

                            FXPP::CI()->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data, $config);

                            self::dailyCountryReport($user_id);

                            FXPP::CI()->output->set_content_type('application/json')->set_output(json_encode(array('success' => true, 'error' => '')));

                            if($new_account_number!=""){

                                $N_mtas = FXPP::CI()->g_m->showssingle($table='mt_accounts_set',$field="account_number",$id=$new_account_number,$select="*",$order_by="");

                                $N_c_user_id = $mtas['user_id'];

                                $N_usrs = FXPP::CI()->g_m->showssingle($table='users',$field="id",$id=$N_c_user_id,$select="*",$order_by="");
                                $usr_prfls = FXPP::CI()->g_m->showssingle($table='user_profiles',$field="user_id",$id=$N_c_user_id,$select="*",$order_by="");
                                $N_cntcts = FXPP::CI()->g_m->showssingle($table='contacts',$field="user_id",$id=$N_c_user_id,$select="*",$order_by="");
                                $N_trdng_xprnc = FXPP::CI()->g_m->showssingle($table='trading_experience',$field="user_id",$id=$N_c_user_id,$select="*",$order_by="");

                                $webservice_config = array(
                                    'server' => 'live_new'
                                );

                                $WebServiceT = new WebService($webservice_config);

                                $account_info = array(
                                    'AccountNumber' => $new_account_number
                                );

                                $WebServiceT->open_ActivateAccountTrading($account_info);

                                if( $WebServiceT->request_status === 'RET_OK' ) {


                                    $data['mts_update'] = array(
                                        'mt_status' => 1
                                    );

                                    FXPP::CI()->g_m->updatemy($table = "mt_accounts_set", "user_id", $N_c_user_id, $data['mts_update']);

                                    //not sending verification email
                                    $WebService = new WebService($webservice_config);

                                    if ($N_mtas['mt_currency_base']=='USD'){

                                        $conv_amount = $amount;

                                    }else{

                                        $conv_amount =  FXPP::getCurrencyRate( $amount = 10, $from_currency='USD', $to_currency=$N_mtas['mt_currency_base']);

                                    }

                                    $account_info = array(
                                        'Login' => $N_mtas['account_number'],
                                        'FundTransferAccountReciever' => $N_mtas['account_number'],
                                        'Amount' => $conv_amount,
                                        'Comment' => $comment,
                                        'ProcessByIP' => FXPP::CI()->input->ip_address()
                                    );

                                    $WebService->open_Deposit_NoDepositBonus_working($account_info);

                                    if ($WebService->request_status === 'RET_OK') {

                                        FXPP::CI()->db->trans_start();

                                        $WebService2 = new WebService($webservice_config);
                                        $groupCurrency = FXPP::CI()->g_m->getGroupCurrency($N_mtas['mt_account_set_id'], $N_mtas['mt_currency_base'], $N_mtas['swap_free']);
                                        FXPP::update_account_group_specific($N_mtas['user_id']);
                                        $account_details = FXPP::CI()->account_model->getAccountByUserId($N_mtas['user_id']);

                                        $isMicro = FXPP::CI()->account_model->isMicro($N_mtas['user_id']);
                                        if($isMicro){
                                            $groupCurrency .= 'C';
                                        }

                                        $groupCurrency .= 'ndb' . $account_details['group_code'];

                                        $account_info2 = array(
                                            'iLogin' => $N_mtas['account_number'],
                                            'strGroup' => $groupCurrency
                                        );
                                        $WebService2->open_ChangeAccountGroup($account_info2);
                                        FXPP::CI()->load->model('user_model');
                                        $user = FXPP::CI()->user_model->getUserProfileByUserId($N_mtas['user_id']);

                                        if (in_array(strtoupper($user['country']), array('PL'))) {

                                            $account_info3 = array(
                                                'iLogin' => $N_mtas['account_number'],
                                                'iLeverage' => '100'
                                            );

                                        } else {

                                            $account_info3 = array(
                                                'iLogin' => $N_mtas['account_number'],
                                                'iLeverage' => '200'
                                            );

                                        }

                                        $WebService3 = new WebService($webservice_config);
                                        $WebService3->open_ChangeAccountLeverage($account_info3);

                                        $sum = floatval($conv_amount) + 0;

                                        $prvt_data['amount'] = array(
                                            'amount' => $sum,
                                            'leverage' => '1:'.$account_info3['iLeverage'],
                                            'mini_bonus_credit'=>1,
                                            'annually_credited_minibonus'=>1,
                                            'new_account_minibonus'=>1,
                                        );

                                        FXPP::CI()->g_m->updatemy($table = 'mt_accounts_set', $field = 'user_id', $id = $N_mtas['user_id'], $prvt_data['amount']);

                                        $date_updated = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                        $prvt_data['nodepositbonus'] = array(
                                            'nodepositbonus' => 1,
                                            'ndba_acquired' => $date_updated->format('Y-m-d H:i:s'),
                                            'ndb_bonus' => floatval($amount)
                                        );
                                        //update table users

                                        FXPP::CI()->g_m->updatemy($table = 'users', $field = 'id', $id = $N_mtas['user_id'], $prvt_data['nodepositbonus']);

                                        FXPP::CI()->deposit_model->setNoDepositRequestStatus($N_mtas['user_id'], 1);

                                        //add nodeposit bonus log  start jira FXPP-5004
                                        $pass_param = array(
                                            'admin_user_id'=>0,
                                            'user_id'=>$N_mtas['user_id'],
                                            'amount' => $amount,
                                            'account_number' => $new_account_number,
                                            'location' => 'external year minibonus',
                                        );
                                        FXPP::insert_ndblogs($pass_param);


                                        //add nodeposit bonus log end


                                        FXPP::CI()->db->trans_complete();

                                        $email_data = array(
                                            'account_number' =>$new_account_number,
                                            'Email' => $N_usrs['email'],

                                        );
                                        $subject = "We have credited a Bonus to your account!";

                                        $config = array(
                                            'mailtype' => 'html'
                                        );
                                        FXPP::CI()->load->library('email');

                                        if ($config != null) {
                                            FXPP::CI()->email->initialize($config);
                                        }
                                        FXPP::CI()->SMTPDebug = 1;
                                        FXPP::CI()->email->from('noreply@mail.forexmart.com', 'ForexMart');
                                        FXPP::CI()->email->to($email_data['Email']);
                                        FXPP::CI()->email->subject($subject);
                                        FXPP::CI()->email->message(FXPP::CI()->load->view('email/minibonus', $email_data, TRUE));
                                        FXPP::CI()->email->send();

                                        FXPP::CI()->output->set_content_type('application/json')->set_output(json_encode(array('success' => true, 'error' => '')));

                                    }else{
//                                        FXPP::CI()->g_m->updatemy($table = 'mt_accounts_set', $field = 'user_id', $id = $N_mtas['user_id'], $data = array('mini_bonus_credit'=>2,'annually_credited_minibonus'=>2));
                                    }
                                }else{

                                }

                            }
                        }else{
                            $mt_account = array(
                                'leverage' => $mtas['leverage'],
                                'amount' =>  0,
                                'mt_currency_base' => $mtas['mt_currency_base'],
                                'mt_account_set_id' =>$mtas['mt_account_set_id'],
                                'registration_ip' =>  $mtas['registration_ip'],
                                'registration_time' => FXPP::getServerTime(),
                                'user_id' => $user_id,
                                'mt_type' => 1,
                                'swap_free' => $swap_free,
                                'account_number' => '',
                                'trader_password' => '',
                                'investor_password' => '',
                                'phone_password' => $phone_password
                            );

                            FXPP::CI()->general_model->insert('mt_accounts_set', $mt_account);
                            FXPP::CI()->output->set_content_type('application/json')->set_output(json_encode(array('success' => false, 'error' => 'Web service is not available. Try it again.')));
                        }

                        //  use new account number to credit 10USD
                        //  comment Crediting MINIBONUS START


                        //   comment Crediting MINIBONUS END

//                    }

                }
            }
            session_destroy();
        }

    }

    public static function autoPassword($nc, $a = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'){
        $l = strlen($a) - 1;
        $r = '';
        while ($nc-- > 0) $r .= $a{mt_rand(0, $l)};
        return $r;
    }

    public static function getAffiliateLogs($input_affiliate_code){

        $getCookieLogs = FXPP::CI()->input->cookie('forexmart_affiliate_logs');
        $affiliate_code = FXPP::CI()->input->cookie('forexmart_affiliate');

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

    private static function dailyCountryReport($user_id)
    {

        FXPP::CI()->load->model('account_model');
        FXPP::CI()->load->model('general_model');

        if ($row = $insert_data['client_country'] = FXPP::CI()->account_model->getClientInfoByUserId($user_id)) {
            $c_code = $row[0]->country;

            $insert_data['country'] = FXPP::CI()->general_model->getCountries();
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
            );


            // $insert_data['email'] = "fin-stats@forexmart.com";
            // $insert_data['email'] = "moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com";

            if (isset($to_email[$c_code])) {

                if ($to_email[$c_code] == "clients_russia_daily_1@forexmart.com") {
                    /* if (FXPP::CI()->account_model->getCISRegPerDay() % 2 == 0) {
                         $insert_data['email'] = "clients_russia_daily_1@forexmart.com";
                     } else {
                         $insert_data['email'] = "clients_russia_daily_2@forexmart.com";
                     }*/


                    if ($exGroup = FXPP::CI()->general_model->where("cis_group_mail", array('email' => $row[0]->email))) {

                        $insert_data['email'] = "clients_russia_daily_" . $exGroup->row()->group_id . "@forexmart.com";

                    } else {

                        if (FXPP::CI()->account_model->getCISRegPerDay() % 2 == 0) {

                            $insert_data['email'] = "clients_russia_daily_1@forexmart.com";
                            FXPP::CI()->general_model->insertmy('cis_group_mail', array('email' => $row[0]->email, 'group_id' => 1));

                        } else {

                            $insert_data['email'] = "clients_russia_daily_2@forexmart.com";
                            FXPP::CI()->general_model->insertmy('cis_group_mail', array('email' => $row[0]->email, 'group_id' => 2));
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


            FXPP::CI()->load->library('email');
            if ($config != null) {
                FXPP::CI()->email->initialize($config);
            }
            FXPP::CI()->SMTPDebug = 1;
            FXPP::CI()->email->from('noreply@mail.forexmart.com', 'ForexMart');
            //  FXPP::CI()->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            FXPP::CI()->email->to($insert_data['email']);
            //  FXPP::CI()->email->to("moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com");

            if (isset($to_email[$c_code])) {
                FXPP::CI()->email->bcc('german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com,pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,bug.fxpp@gmail.com');
            } else {
                // $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
                FXPP::CI()->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com,bug.fxpp@gmail.com');
            }

            FXPP::CI()->email->subject($insert_data['subject']);
            FXPP::CI()->email->message(FXPP::CI()->load->view('email/realtime_client_report_minibonus', $insert_data, TRUE));
            FXPP::CI()->email->send();

//            echo 'email done';
        }

    }

//    2nd to Nth Account validation
    public static function mark_inactive_3rdtoNth() {

        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;
        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m = FXPP::CI()->Minibonus_model;
        $data = FXPP::CI()->mb_m->all_3rd_to_Nth();

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        foreach ($data as $key => $value) {
            $data = array(
                'iLogin' => $value['account_number']
            );
            $WebService->open_Request_Inactive_Account_Details($data);
            if ($WebService->request_status === 'RET_OK') {
                //inactive
                $mtas = FXPP::CI()->g_m->showssingle2($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $select = 'inactive_date,inactive_counter');
                $save_data = array(
                    'active' => 5,
                    'inactive_date' => ($mtas['inactive_date'] == Null) ? FXPP::getServerTime() : $mtas['inactive_date'],
                    'inactive_counter' => $mtas['inactive_counter'] + 1,
                );
                FXPP::CI()->general_model->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'], $data = $save_data);
//                echo 1;
            }else{
//                echo 2;
            }

        }

        self::mark_check_relative_account_ndbdeposit_3rdtoNth();
    }

    private static function mark_check_relative_account_ndbdeposit_3rdtoNth() {
//    public static function mark_check_relative_account_ndbdeposit_3rdtoNth() {

        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;
        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m = FXPP::CI()->Minibonus_model;

        $data = FXPP::CI()->mb_m->all_3rd_to_Nth_2();
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $has_ndbmini_uniquetagnth = false;
        $date = new DateTime(FXPP::getServerTime());
        foreach ($data as $key => $value) {

            //check for account fullname
            $data['accountfullname'] = FXPP::CI()->mb_m->showFullname_v3(
                $table1 = 'users', $table2 = 'user_profiles', $table3 = 'mt_accounts_set',
                $field2 = 'user_profiles.full_name', $id2 = trim($value['full_name']),
                $field1 = 'user_profiles.dob', $id1 = trim($value['dob']),
//                $field3 = 'users.ndb_bonus!=', $id3 = '',
                $field4 = 'users.id =', $id4 = $value['user_id'],
                $join12 = 'users.id=user_profiles.user_id',
                $join13 = 'users.id=mt_accounts_set.user_id',
                $select = 'account_number,ndbmini_uniquetagnth'
            );

            //check for account email
            $data['accountemail'] = FXPP::CI()->mb_m->showEmail_v3(
                $table1 = 'users', $table2 = 'user_profiles', $table3 = 'mt_accounts_set',
                $field1 = 'UCASE(users.email)', $id1 = strtoupper($value['email']),
//                $field3 = 'users.ndb_bonus!=', $id3 = '',
//                $field4 = 'users.id !=', $id4 = $value['user_id'],
                $join12 = 'users.id=user_profiles.user_id',
                $join13 = 'users.id=mt_accounts_set.user_id',
                $select = 'account_number,ndbmini_uniquetagnth'
            );


            $is_over1year = false;


            if ($data['accountfullname']) {
                foreach ($data['accountfullname'] as $key1 => $value1) {

//                    if($value1['ndbmini_uniquetagnth']==1){
//                        $has_ndbmini_uniquetagnth = True;
//                    }

                    $ndb_l = FXPP::CI()->g_m->show_all($table = 'ndb_logs', $field = 'account_number', $id = $value1['account_number'], $select = 'date_api');
                    if($ndb_l){
                        foreach($ndb_l as $k => $v){
                            $date_db_last_update = new DateTime($v['date_api']);
                            $diff = $date->diff($date_db_last_update);
                            if( intval((($diff->format('%y') * 12) + $diff->format('%m')))>=12){
                                $is_over1year = true;
                            }
                        }
                    }

                }
            }

            if ($data['accountemail']) {
                foreach ($data['accountemail'] as $key2 => $value2) {
//                    if($value2['ndbmini_uniquetagnth']==1){
//                        $has_ndbmini_uniquetagnth = True;
//                    }
                    $ndb_l = FXPP::CI()->g_m->show_all($table = 'ndb_logs', $field = 'account_number', $id = $value2['account_number'], $select = 'date_api');
                    if($ndb_l){
                        foreach($ndb_l as $k => $v){
                            $date_db_last_update = new DateTime($v['date_api']);
                            $diff = $date->diff($date_db_last_update);
                            if( intval((($diff->format('%y') * 12) + $diff->format('%m')))>=12){
                                $is_over1year = true;
                            }
                        }
                    }

                }
            }

        }

        //tag true or false if relative account has nodeposit bonus for the past 12months
//        echo '1year';
//        var_dump($is_over1year);
//        echo 'unique';
//        var_dump($has_ndbmini_uniquetagnth);

//        if($is_over1year==true  and $has_ndbmini_uniquetagnth==False){
        if($is_over1year==true ){
            $data['nth_update'] = array(
                'ready_nth_newaccount' => 1,
                'ndbmini_uniquetagnth' => 1
            );
            FXPP::CI()->g_m->updatemy($table = "mt_accounts_set", "user_id", $value['user_id'], $data['nth_update']);
        }

        self::credit_accounts_nth();

    }

    private static function credit_accounts_nth(){
//    public static function credit_accounts_nth(){
        //stable use


        FXPP::CI()->load->model('General_model');
        FXPP::CI()->g_m = FXPP::CI()->General_model;

        FXPP::CI()->load->model('Minibonus_model');
        FXPP::CI()->mb_m=FXPP::CI()->Minibonus_model;

        $data['nth'] = FXPP::CI()->mb_m->annual_ndb_3rd_to_nth_3();

        $comment = 'FOREXMART NO DEPOSIT BONUS';
        $amount = 10;
        $date = new DateTime(FXPP::getServerTime());

        foreach( $data['nth']  as $key => $value ){

            $date_registration = new DateTime($value['registration_time']);
            $diff = $date->diff($date_registration);

            if( intval((($diff->format('%y') * 12) + $diff->format('%m')))>=12){

                $new_account_number='';

                $webservice_config = array('server' => 'live_new');
                $account_info = array(
                    'iLogin' => $acctnmbr=$value['account_number']
                );
                $WebServiceCheckEnabled = new WebService($webservice_config);
                $WebServiceCheckEnabled->open_RequestAccountDetails($account_info);

                if( $WebServiceCheckEnabled->request_status === 'RET_OK' ) {

                    if ($WebServiceCheckEnabled->get_result('IsEnable')==False){

                        FXPP::CI()->general_model->updatemy($table='mt_accounts_set',$field='account_number',$id=$acctnmbr,$data=array('is_enabled'=>2));

                    }else{

                        $mtas = FXPP::CI()->g_m->showssingle($table='mt_accounts_set',$field="account_number",$id=$acctnmbr,$select="*",$order_by="");
                        $c_user_id = $mtas['user_id'];
                        $usrs = FXPP::CI()->g_m->showssingle($table='users',$field="id",$id=$c_user_id,$select="*",$order_by="");
                        $usr_prfls = FXPP::CI()->g_m->showssingle($table='user_profiles',$field="user_id",$id=$c_user_id,$select="*",$order_by="");
                        $cntcts = FXPP::CI()->g_m->showssingle($table='contacts',$field="user_id",$id=$c_user_id,$select="*",$order_by="");
                        $trdng_xprnc = FXPP::CI()->g_m->showssingle($table='trading_experience',$field="user_id",$id=$c_user_id,$select="*",$order_by="");

                        // duplicate Live www registration
                        $date = new DateTime(FXPP::getServerTime());
                        $date_db_last_update = new DateTime($mtas['inactive_date']);
                        $diff = $date->diff($date_db_last_update);

//                    if(($mtas['inactive_counter'])>=12 and ( intval((($diff->format('%y') * 12) + $diff->format('%m')))>=12)){

                        $login_type = 0;
                        $use_username = FXPP::CI()->config->item('use_username', 'tank_auth');
                        $email_activation = FXPP::CI()->config->item('email_activation', 'tank_auth');
                        $password = self::autoPassword(8);

                        $user_inser_data = FXPP::CI()->tank_auth->create_user(
                            $use_username ? FXPP::CI()->form_validation->set_value('username') : '',
                            $usrs['email'],
                            $password,
                            $email_activation, 1, $login_type);
                        $user_id = $user_inser_data['user_id'];
                        $user_data = array(
                            'user_id' => $user_id,
                        );
                        FXPP::CI()->session->set_userdata($user_data);

                        $data['random_alpha_string_analytics'] = '';
                        $data['random_alpha_string_analytics'] = 'z42esbsn4yqu2p';
                        $data['save_hash'] = array(
                            'first_login_hash' => $data['random_alpha_string_analytics'],
                            'first_login_stat' => 1,
                            'auto_created_account'=>1
                        );
                        FXPP::CI()->general_model->update('users', 'id', $user_id, $data['save_hash']);
                        $user_data = array(
                            'analytic_hash' => $data['random_alpha_string_analytics'],
                        );
                        FXPP::CI()->session->set_userdata($user_data);

                        $profile = array(
                            'full_name' => $usr_prfls['full_name'],
                            'user_id' => $user_id,
                            'country' => $usr_prfls['country'],
                            'street' => $usr_prfls['street'],
                            'city' => $usr_prfls['city'],
                            'state' => $usr_prfls['state'],
                            'zip' => $usr_prfls['zip'],
                            'dob' => $usr_prfls['dob']
                        );

                        if ($usr_prfls['country'] == 'PL') {
                            $_SESSION['temp_country'] = 'PL';
                        }

                        FXPP::CI()->general_model->insert('user_profiles', $profile);

                        $swap_free = $mtas['swap_free'];
                        $swap_free = empty($swap_free) ? 0 : 1;
                        $phone_password = FXPP::RandomizeCharacter(7);

                        /*  =============== Spread project  setting ================================ */
                        $speardGroup = FXPP::CI()->input->cookie('forexmart_account_type');  // Here store spread of value using affiliateChecker hook.
                        $mt_set_id =$mtas['mt_account_set_id'];
                        $speardGroup = $mt_set_id==1? "refSt".$speardGroup:"refZe".$speardGroup;

                        if(!FXPP::CI()->general_model->getGroupSpard($speardGroup)){

                            $groupCurrency = FXPP::CI()->general_model->getGroupCurrency((int)$mt_set_id, $mtas['mt_currency_base'] , $swap_free).'1';

                        }else{

                            $groupCurrency = $speardGroup;
                        }

                        /*  =============== End Spread project  setting ================================ */


                        // Save Affiliate Link
                        $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                        $affiliate_code_data = array(
                            'users_id' => $user_id,
                            'affiliate_code' => $generateAffiliateCode
                        );

                        FXPP::CI()->general_model->insert('users_affiliate_code', $affiliate_code_data);

                        $input_affiliate_code = '';
                        $affiliate_code_logs = self::getAffiliateLogs($input_affiliate_code);
                        $affiliate_referral_codes = ':' . str_replace('-', ':', $affiliate_code_logs);

                        $service_data = array(
                            'address' => $usr_prfls['street'],
                            'city' => $usr_prfls['city'],
                            'country' => $usr_prfls['country'],
                            'email' => $usrs['email'],
                            'group' => $groupCurrency,
                            'leverage' => $mtas['leverage'],
                            'name' => $usr_prfls['full_name'],
                            'phone_number' => $cntcts['phone1'],
                            'state' => $usr_prfls['state'],
                            'zip_code' => $usr_prfls['zip'],
                            'phone_password' => $phone_password,
                            'comment' => strtolower('EN') . ':' . $mtas['registration_ip'] . $affiliate_referral_codes
                        );

                        $webservice_config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($webservice_config);
                        $WebService->open_account_standard($service_data);

                        if ($WebService->request_status === 'RET_OK') {
                            FXPP::CI()->g_m->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $acctnmbr, $data = array('old_account_created_newaccount'=>1));
                            $AccountNumber = $WebService->get_result('LogIn');
                            $TraderPassword = $WebService->get_result('TraderPassword');
                            $InvestorPassword = $WebService->get_result('InvestorPassword');
                            $RegDate = FXPP::getServerTime();
                            $mt_account = array(
                                'leverage' => $mtas['leverage'],
                                'registration_leverage' =>$mtas['leverage'],
                                'amount' => 0,
                                'mt_currency_base' => $mtas['mt_currency_base'],
                                'mt_account_set_id' => $mtas['mt_account_set_id'],
                                'registration_ip' => $mtas['registration_ip'],
                                'registration_time' => date('Y-m-d H:i:s', strtotime($RegDate)),
                                'user_id' => $user_id,
                                'mt_type' => 1,
                                'swap_free' => $swap_free,
                                'account_number' => $new_account_number=$AccountNumber,
                                'trader_password' => $TraderPassword,
                                'investor_password' => $InvestorPassword,
                                'phone_password' => $phone_password
                            );

                            FXPP::CI()->general_model->insert('mt_accounts_set', $mt_account);

                            $getCookieAffiliate = FXPP::CI()->input->cookie('forexmart_affiliate');
                            $forexmart_affiliate = empty($input_affiliate_code) ? $getCookieAffiliate : $input_affiliate_code;

                            $trading_experience = array(
                                'investment_knowledge' => $trdng_xprnc['investment_knowledge'],
                                'risk' => $trdng_xprnc['risk'],
                                'experience' => $trdng_xprnc['experience'],
                                'user_id' => $user_id,
                                'technical_analysis' => $trdng_xprnc['technical_analysis'],
                                'trade_duration' => $trdng_xprnc['trade_duration'],
                            );

                            FXPP::CI()->general_model->insert('trading_experience', $trading_experience);

                            $contacts_data = array(
                                'phone1' => $cntcts['phone1'],
                                'user_id' => $user_id
                            );
                            FXPP::CI()->general_model->insert('contacts', $contacts_data);


                            // send email  to user email
                            $email_data = array(
                                'full_name' => $usr_prfls['full_name'],
                                'email' => $usrs['email'],
                                'password' => $password,
                                'account_number' => $mt_account['account_number'],
                                'trader_password' => $mt_account['trader_password'],
                                'investor_password' => $mt_account['investor_password'],
                                'phone_password' => $mt_account['phone_password'],
                            );
                            $subject = "ForexMart MT4 Live Trading Account details";
                            $config = array(
                                'mailtype' => 'html'
                            );

                            FXPP::CI()->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data, $config);

                            self::dailyCountryReport($user_id);

//                            FXPP::CI()->output->set_content_type('application/json')->set_output(json_encode(array('success' => true, 'error' => '')));

                            if($new_account_number!=""){

                                $N_mtas = FXPP::CI()->g_m->showssingle($table='mt_accounts_set',$field="account_number",$id=$new_account_number,$select="*",$order_by="");

                                $N_c_user_id = $mtas['user_id'];

                                $N_usrs = FXPP::CI()->g_m->showssingle($table='users',$field="id",$id=$N_c_user_id,$select="*",$order_by="");
                                $usr_prfls = FXPP::CI()->g_m->showssingle($table='user_profiles',$field="user_id",$id=$N_c_user_id,$select="*",$order_by="");
                                $N_cntcts = FXPP::CI()->g_m->showssingle($table='contacts',$field="user_id",$id=$N_c_user_id,$select="*",$order_by="");
                                $N_trdng_xprnc = FXPP::CI()->g_m->showssingle($table='trading_experience',$field="user_id",$id=$N_c_user_id,$select="*",$order_by="");

                                $webservice_config = array(
                                    'server' => 'live_new'
                                );

                                $WebServiceT = new WebService($webservice_config);

                                $account_info = array(
                                    'AccountNumber' => $new_account_number
                                );

                                $WebServiceT->open_ActivateAccountTrading($account_info);

                                if( $WebServiceT->request_status === 'RET_OK' ) {


                                    $data['mts_update'] = array(
                                        'mt_status' => 1
                                    );

                                    FXPP::CI()->g_m->updatemy($table = "mt_accounts_set", "user_id", $N_c_user_id, $data['mts_update']);

                                    //not sending verification email
                                    $WebService = new WebService($webservice_config);

                                    if ($N_mtas['mt_currency_base']=='USD'){

                                        $conv_amount = $amount;

                                    }else{

                                        $conv_amount =  FXPP::getCurrencyRate( $amount = 10, $from_currency='USD', $to_currency=$N_mtas['mt_currency_base']);

                                    }

                                    $account_info = array(
                                        'Login' => $N_mtas['account_number'],
                                        'FundTransferAccountReciever' => $N_mtas['account_number'],
                                        'Amount' => $conv_amount,
                                        'Comment' => $comment,
                                        'ProcessByIP' => FXPP::CI()->input->ip_address()
                                    );

                                    $WebService->open_Deposit_NoDepositBonus_working($account_info);

                                    if ($WebService->request_status === 'RET_OK') {

                                        FXPP::CI()->db->trans_start();

                                        $WebService2 = new WebService($webservice_config);
                                        $groupCurrency = FXPP::CI()->g_m->getGroupCurrency($N_mtas['mt_account_set_id'], $N_mtas['mt_currency_base'], $N_mtas['swap_free']);
                                        FXPP::update_account_group_specific($N_mtas['user_id']);
                                        $account_details = FXPP::CI()->account_model->getAccountByUserId($N_mtas['user_id']);

                                        $isMicro = FXPP::CI()->account_model->isMicro($N_mtas['user_id']);
                                        if($isMicro){
                                            $groupCurrency .= 'C';
                                        }

                                        $groupCurrency .= 'ndb' . $account_details['group_code'];

                                        $account_info2 = array(
                                            'iLogin' => $N_mtas['account_number'],
                                            'strGroup' => $groupCurrency
                                        );
                                        $WebService2->open_ChangeAccountGroup($account_info2);
                                        FXPP::CI()->load->model('user_model');
                                        $user = FXPP::CI()->user_model->getUserProfileByUserId($N_mtas['user_id']);

                                        if (in_array(strtoupper($user['country']), array('PL'))) {

                                            $account_info3 = array(
                                                'iLogin' => $N_mtas['account_number'],
                                                'iLeverage' => '100'
                                            );

                                        } else {

                                            $account_info3 = array(
                                                'iLogin' => $N_mtas['account_number'],
                                                'iLeverage' => '200'
                                            );

                                        }

                                        $WebService3 = new WebService($webservice_config);
                                        $WebService3->open_ChangeAccountLeverage($account_info3);

                                        $sum = floatval($conv_amount) + 0;


                                        $prvt_data['amount'] = array(
                                            'amount' => $sum,
                                            'leverage' => '1:'.$account_info3['iLeverage'],
                                            'mini_bonus_credit'=>1,
                                            'annually_credited_minibonus'=>1,
                                            'new_account_minibonus'=>1,
                                        );

                                        FXPP::CI()->g_m->updatemy($table = 'mt_accounts_set', $field = 'user_id', $id = $N_mtas['user_id'], $prvt_data['amount']);

                                        $date_updated = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

                                        $prvt_data['nodepositbonus'] = array(
                                            'nodepositbonus' => 1,
                                            'ndba_acquired' => $date_updated->format('Y-m-d H:i:s'),
                                            'ndb_bonus' => floatval($amount)
                                        );
                                        //update table users
                                        FXPP::CI()->g_m->updatemy($table = 'users', $field = 'id', $id = $N_mtas['user_id'], $prvt_data['nodepositbonus']);

                                        FXPP::CI()->deposit_model->setNoDepositRequestStatus($N_mtas['user_id'], 1);


                                        //add nodeposit bonus log  start jira FXPP-5004
                                        $pass_param = array(
                                            'admin_user_id'=>0,
                                            'user_id'=>$N_mtas['user_id'],
                                            'amount' => $amount,
                                            'account_number' => $new_account_number,
                                            'location' => 'external year minibonus',
                                        );
                                        FXPP::insert_ndblogs($pass_param);

                                        //add nodeposit bonus log end

                                        FXPP::CI()->db->trans_complete();

                                        $email_data = array(
                                            'account_number' =>$new_account_number,
                                            'Email' => $N_usrs['email'],

                                        );
                                        $subject = "We have credited a Bonus to your account!";

                                        $config = array(
                                            'mailtype' => 'html'
                                        );
                                        FXPP::CI()->load->library('email');

                                        if ($config != null) {
                                            FXPP::CI()->email->initialize($config);
                                        }
                                        FXPP::CI()->SMTPDebug = 1;
                                        FXPP::CI()->email->from('noreply@mail.forexmart.com', 'ForexMart');
                                        FXPP::CI()->email->to($email_data['Email']);
                                        FXPP::CI()->email->subject($subject);
                                        FXPP::CI()->email->message(FXPP::CI()->load->view('email/minibonus', $email_data, TRUE));
                                        FXPP::CI()->email->send();

                                        FXPP::CI()->output->set_content_type('application/json')->set_output(json_encode(array('success' => true, 'error' => '')));
//

                                    }else{

                                    }
                                }else{

                                }

                            }
                        }else{
                            $mt_account = array(
                                'leverage' => $mtas['leverage'],
                                'amount' =>  0,
                                'mt_currency_base' => $mtas['mt_currency_base'],
                                'mt_account_set_id' =>$mtas['mt_account_set_id'],
                                'registration_ip' =>  $mtas['registration_ip'],
                                'registration_time' => FXPP::getServerTime(),
                                'user_id' => $user_id,
                                'mt_type' => 1,
                                'swap_free' => $swap_free,
                                'account_number' => '',
                                'trader_password' => '',
                                'investor_password' => '',
                                'phone_password' => $phone_password
                            );

                            FXPP::CI()->general_model->insert('mt_accounts_set', $mt_account);
                            FXPP::CI()->output->set_content_type('application/json')->set_output(json_encode(array('success' => false, 'error' => 'Web service is not available. Try it again.')));
                        }

                        //  use new account number to credit 10USD
                        //  comment Crediting MINIBONUS START


                        //   comment Crediting MINIBONUS END

//                    }

                    }
                }

            }else{

            }

            session_destroy();
        }

    }
}