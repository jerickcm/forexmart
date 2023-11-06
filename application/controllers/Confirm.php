<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm extends CI_Controller {

    private $country_code;

    function __construct(){

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->model('General_model');
        $this->g_m=$this->General_model;

        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->country_code = FXPP::getUserCountryCode() or null;
    }

    public function index(){

        $this->code();
    }

    public function code(){

        $data['data']['custom_validation']='';
        $data['data']['custom_validation_success']=NULL;
        $this->form_validation->set_rules('ConfirmationCode', 'Confirmation Code', array('numeric','required','trim', 'min_length[6]','xss_clean'));
        $data['data']['custom_validation_web']=NULL;
        if ($this->form_validation->run()) {

            $data['data']['Code'] = $this->g_m->showssingle3($table="contestmoneyfall","Code",$this->input->post('ConfirmationCode',true),"Activation","0","*",'');

            if ($data['data']['Code']!=false){
                    $login_type = 0;
                    $use_username = $this->config->item('use_username', 'tank_auth');
                    $email_activation = $this->config->item('email_activation', 'tank_auth');

                $this->db->trans_start();

                $data['Activation']=array(
                    "Activation"=>1
                );

                $data['updateRet']=$this->g_m->updatemy($table="contestmoneyfall","Code",$this->input->post('ConfirmationCode',true), $data['Activation']);

                $user_inser_data = $this->tank_auth->create_user(
                        $use_username ? $this->form_validation->set_value('username') : '',
                        $data['data']['Code']['Email'],
                        $data['mycode']=$this->GetCode(10),
                        $email_activation, 0, $login_type);

                $user_id = $user_inser_data['user_id'];

                $data['Users_Id']=array(
                    "users_id"=>$user_id
                );

                $this->g_m->updatemy($table="contestmoneyfall","Code",$this->input->post('ConfirmationCode',true), $data['Users_Id']);

//                $account_info = array(
//                    'is_swap_on' => $data['data']['Code']['SwapFree'] ? true : false,
//                    'name' => $data['data']['Code']['FullName'],
//                    'email' => $data['data']['Code']['Email'],
//                    'city' => $data['data']['Code']['City'],
//                    'country' => $data['data']['Code']['Country'],
//                    'phone_number' => $data['data']['Code']['PhoneNumber'],
//                );

                $swap_free = $data['data']['Code']['SwapFree'] ? 1 : 0;
                $groupCurrency = $this->general_model->getDemoGroupCurrency(3, '', $swap_free);

                $account_info = array(
                    'address' => '',
                    'city' => $data['data']['Code']['City'],
                    'country' => $this->general_model->getCountries($data['data']['Code']['Country']),
                    'email' => $data['data']['Code']['Email'],
                    'group' => $groupCurrency,
                    'leverage' => '500',
                    'name' => $data['data']['Code']['FullName'],
                    'phone_number' => $data['data']['Code']['PhoneNumber'],
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => ''
                );

                $webservice_config = array(
                    'server' => 'demo_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($account_info);

                if( $WebService->request_status === 'RET_OK' ) {

                    $RandomNumber = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $InvestorPassword = $WebService->get_result('InvestorPassword');
//                    $RegDate = $WebService->get_result('RegDate');
                    //$RegDate = FXPP::getServerTime();

                    $data['insert'] = array(
                        'Title' => 'ForexMart Money Fall Contest',
                        'FullName' => $data['data']['Code']['FullName'],
                        'AccountNumber' => $RandomNumber,
                        'Email' => $data['data']['Code']['Email'], //added email for mailer
                        'Password' => $TraderPassword,
                        'InvestorPassword' => $InvestorPassword
                    );
                    Fx_mailer::MoneyFallRegistrationAccess($data['insert']);
                    $WebService2 = new WebService($webservice_config);
                    $WebService2->update_demo_deposit_balance($RandomNumber, '5000');
                    $profile = array(
                        'full_name' => $data['data']['Code']['FullName'],
                        'user_id' => $user_id,
                        'country' => $data['data']['Code']['Country'],

                    );

                    //Deactivate Account Trades
                    $WebService3 = new WebService($webservice_config);
                    $WebService3->deactivate_demo_account($RandomNumber);

                    $this->general_model->insert('user_profiles', $profile);

                    $WebService4 = new WebService($webservice_config);
                    $account_info2 = array(
                            'iLogin' =>  $RandomNumber
                        );
                    if( $WebService4->request_status === 'RET_OK'){
                        $RegDate = $WebService4->get_result('RegDate');
                    }else{
                        $RegDate  = FXPP::getServerTime();
                    }

                    //study this
                    $mt_account = array(
                        'leverage' => '1:500',
                        'amount' => 5000,
                        'mt_currency_base' => 'USD',
                        'mt_account_set_id' => 1,
                        'registration_ip' => $_SERVER['REMOTE_ADDR'],
                        'registration_time' => date('Y-m-d H:i:s', strtotime($RegDate)),
                        'user_id' => $user_id,
                        'mt_type' => 0,
                        'account_number' => $RandomNumber,
                        'trader_password' => $TraderPassword,
                        'investor_password' => $InvestorPassword
                    );

                    $this->general_model->insert('mt_accounts_set', $mt_account);
                    $this->g_m->updatemy($table = "users", "id", $user_id, array('created' => date('Y-m-d H:i:s', strtotime($RegDate))));


                    $email_data = array(
                        'full_name' => $data['data']['Code']['FullName'],
                        'email' => $data['data']['Code']['Email'],
                        'password' => $user_inser_data['password']
                    );

                    $this->general_model->delete("incomplete_registers", "email", $email_data['email']);

                    $this->db->trans_complete();

                    $data['data']['insertsuccess'] = true;
                    $data['data']['custom_validation_success'] = 'Your email address has been confirmed.We have sent you demo-account access to your email.';
                    $data['data']['AccountNumber'] = $RandomNumber;
                    $data['data']['trader_password'] = $TraderPassword;
                    $data['data']['investor_password'] = $InvestorPassword;

                }else{

                    $data['data']['custom_validation_web'] = 'Service is currently unavailable.';
                    $data['data']['custom_validation'] = $WebService->request_status;

                }

            }else{
                $data['data']['custom_validation'] = 'Confirmation Code is incorrect';
            }
        }


        $js = $this->template->Js();
        $this->template->title("Money Fall Registration | Forexmart")
            ->set_layout('external/main')
            ->append_metadata_js("
                      <script src='".$js."jquery.validate.js'></script>
                ")
            ->build('MoneyFall/confirm', $data['data']);
    }

    private function GetCode($length) {
        $key = '';
        $keys = array_merge(range(0, 9),range('A', 'Z'),range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function corroborate(){
        $loopwallet=true;
        do {
            $RandomNumber=rand(10000000,99999999);
            $loopwallet =$this->g_m->showlike($table='mt_accounts_set',$field='account_number',$id=$RandomNumber,$select="account_number");
        }while($loopwallet==true);
        echo 'FM'.$RandomNumber;

    }
    public function forexmart_landing(){
        $data['data']['custom_validation']='';
        $data['data']['custom_validation_success']=NULL;
        $this->form_validation->set_rules('ConfirmationCode', 'Confirmation Code', array('numeric','required','trim', 'min_length[6]','xss_clean'));
        $data['data']['custom_validation_web']=NULL;
        if ($this->form_validation->run()) {
            $data['data']['Code'] = $this->g_m->showssingle3($table = "forexmart_landing", "Code", $this->input->post('ConfirmationCode',true), "Activation", "0", "*", '');
            if ($data['data']['Code'] != false) {
                $this->db->trans_start();
                $whereData = array('countryCode' => $this->country_code);
                $conndata = $this->general_model->getQueryStringRow('country_to_courrency', '*', $whereData);
                if ($conndata->currencyCode != 'EUR' and $conndata->currencyCode != 'GBP' and $conndata->currencyCode != 'RUB') {
                    $currency = 'USD';
                } else {
                    $currency = $conndata->currencyCode;
                }


                $login_type = 0;
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $data['Activation'] = array(
                    "Activation" => 1
                );
                $data['updateRet'] = $this->g_m->updatemy($table = "forexmart_landing", "Code", $this->input->post('ConfirmationCode',true), $data['Activation']);


                $user_inser_data = $this->tank_auth->create_user(
                    $use_username ? $this->form_validation->set_value('username') : '',
                    $data['data']['Code']['Email'],
                    $data['mycode'] = $this->GetCode(10),
                    $email_activation, 1, $login_type);

                $user_id = $user_inser_data['user_id'];
                $data['Users_Id'] = array(
                    "users_id" => $user_id
                );
                $this->g_m->updatemy($table = "forexmart_landing", "Code", $this->input->post('ConfirmationCode',true), $data['Users_Id']);
                $this->session->set_userdata($data['Users_Id']);
                $profile = array(
                    'full_name' => $data['data']['Code']['Fullname'],
                    'user_id' => $user_id,
                    'country' => $this->country_code,
                    'street' => '',
                    'city' => '',
                    'state' => '',
                    'zip' => '',
                    'dob' => ''

                );
                $this->general_model->insert('user_profiles', $profile);
                $swap_free = 0;
                $phone_password = FXPP::RandomizeCharacter(7);

                if(IPLoc::isChinaIP() || $this->country_code == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(1, $currency, $swap_free);
                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->country_code,
                    'email' => $data['data']['Code']['Email'],
                    'group' => $groupCurrency . '1',
                    'leverage' => count($ex_leverage = explode(":", '1:200')) > 1 ? $ex_leverage[1] : '1:200',
                    'name' => $data['data']['Code']['Fullname'],
                    'phone_number' => '',
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

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
                    $RegDate = FXPP::getServerTime();

                    $mt_account = array(
                        'leverage' => '1:200',
                        'amount' => '',
                        'mt_currency_base' => $currency,
                        'mt_account_set_id' => 1,
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
                } else {
                    $mt_account = array(
                        'leverage' => '1:200',
                        'amount' => '',
                        'mt_currency_base' => $currency,
                        'mt_account_set_id' => 1,
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
                }

                $trading_experience = array(
                    'investment_knowledge' => '',
                    'risk' => '',
                    'experience' => '',
                    'user_id' => $user_id,
                    'technical_analysis' => '',
                    'trade_duration' => '',
                );
                $this->general_model->insert('trading_experience', $trading_experience);

                $contacts_data = array(
                    'phone1' => '',
                    'user_id' => $user_id
                );
                $this->general_model->insert('contacts', $contacts_data);

                $email_data = array(
                    'full_name' => $data['data']['Code']['Fullname'],
                    'email' => $data['data']['Code']['Email'],
                    'password' => $data['mycode'],
                    'account_number' => $mt_account['account_number'],
                    'trader_password' => $mt_account['trader_password'],
                    'investor_password' => $mt_account['investor_password'],
                    'phone_password' => $mt_account['phone_password'],
                );

                $subject = "ForexMart MT4 Live Trading Account details";
                $config = array(
                    'mailtype' => 'html'
                );
                $this->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data, $config);
                $this->dailyCountryReport($user_id);
                $data['data']['insertsuccess'] = true;
                $data['data']['custom_validation_success'] = 'Your email address has been confirmed.We have sent you live-account access to your email.';
                $data['data']['AccountNumber'] = $mt_account['account_number'];
                $data['data']['trader_password'] = $mt_account['trader_password'];
                $data['data']['investor_password'] = $mt_account['investor_password'];
                $this->db->trans_complete();
                $_SESSION['landing'] = true;
                redirect(FXPP::my_url('client/signin'));

            } else {
                $_SESSION['landing'] = false;
                $data['data']['custom_validation'] = 'Confirmation Code is incorrect';
            }
        }

        $this->template->title("ForexMart Landing | Forexmart")
            ->set_layout('external/main')
            ->append_metadata_js("
                      <script src='".$this->template->Js()."jquery.validate.js'></script>
                ")
            ->build('confirm_landing', $data['data']);

    }
    public function authenticate(){
        redirect(FXPP::loc_url('home'));
    }
    public function substantiate(){
        redirect(FXPP::loc_url('home'));
    }
    public function justify(){
        redirect(FXPP::loc_url('home'));
    }
    public function vindicate(){
        redirect(FXPP::loc_url('home'));
    }
    public function support(){
        redirect(FXPP::loc_url('home'));
    }
    public function uphold(){
        redirect(FXPP::loc_url('home'));
    }

    private function dailyCountryReport($user_id){

        $this->load->model('account_model');
        $this->load->model('general_model');



        if($row = $insert_data['client_country'] = $this->account_model->getClientInfoByUserId($user_id)){
            $c_code = $row[0]->country;


            $insert_data['country'] = $this->general_model->getCountries();
            $insert_data['country']["GB','IE"] = "UK and Ireland ";
            $insert_data['country']["AT','DE"] = "Austria and Germany ";
            $insert_data['country']["AM','BY','KZ','KG','MD','RU','TJ','TM','UA','UZ"] = "Russia and CIS";

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


            );


            // $insert_data['email'] = "fin-stats@forexmart.com";
            // $insert_data['email'] = "moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com";

            if (isset($to_email[$c_code])) {
                $insert_data['email'] = $to_email[$c_code];
            } else {
                return true; // At the moment we do not need the real time mailing with registrations from all countries.
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
            //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to($insert_data['email']);
            //  $this->email->to("moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com");

            if (isset($to_email[$c_code])) {
                $this->email->bcc('german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com,pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com');
            } else {
                // $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
                $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');
            }


            $this->email->subject($insert_data['subject']);
            $this->email->message($this->load->view('email/realtime_client_report', $insert_data, TRUE));
            $this->email->send();
        }

    }
}
