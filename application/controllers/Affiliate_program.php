

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Affiliate_program extends MY_Controller
    {
        private $js;
        private $country_code;

        public function __construct()
        {
            parent::__construct();
            if (!IPLoc::Banned()) {
                $this->load->library('fx_mailer');
                $this->load->library('tank_auth');
                // $this->load->model('user_model');
                // $this->load->model('account_model');
                $this->load->model('Logs_model');
                $this->lang->load('tank_auth');
                $this->g_m = $this->general_model;
                $this->js = $this->template->Js();
                $this->load->helper('string');
                $this->country_code = FXPP::getUserCountryCode() or null;
               // $this->lang->load('affiliate_program');
              $this->lang->load('partnership');
                $this->nlanguage = FXPP::html_url();
            } else {
                show_404();
            }
        }
        public function is_mobile()
        {

            $this->load->library('user_agent');
            $is_mobile = $this->agent->is_mobile();
            $result['is_mobile'] = $is_mobile;
//        if($is_mobile){
            $userContinent = FXPP::getUserContinentCode();
            $currency = 'USD';

            if ($userContinent === 'EU') {
                $getCountryCode = FXPP::getUserCountryCode();
                switch ($getCountryCode) {
                    case 'RU':
                        $currency = 'RUB';
                        break;
                    case 'GB':
                        $currency = 'GBP';
                        break;
                    default:
                        $currency = 'EUR';
                        break;
                }
            }

            $result = array(
                'is_mobile' => $is_mobile,
                'currency' => $currency
            );
//        }

            return $result;
        }
        public function index()
        {
            $this->lang->load('affiliate_program');

//            if(IPLoc::Office()) {
                $data['postsubmited'] = "";
                $this->form_validation->set_rules('affiliate_type', 'Affiliate Type', 'trim|required|xss_clean');
                $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
                $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
                $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
                $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('status_type', 'Status', 'trim|required|xss_clean');
                $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');

                if ($this->input->post('status_type') > 0) {
                    $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
                    $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
                    $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
                }

                $_SESSION['tmp_full_name'] = $this->input->post('fullname', true);
                $_SESSION['tmp_email'] = $this->input->post('email', true);
                $_SESSION['tmp_login_type'] = 1;

                if ($this->form_validation->run() && FXPP::limit_15reg_24hrs_p() == false && Form_key::isValid(trim($this->input->post('form_key', true)))) {
                    $country = $this->input->post('country', true);
                    $illicit_country = unserialize(ILLICIT_COUNTRIES);
                    if (!in_array(strtoupper(trim($country)), $illicit_country)) {
                        $generatePass = FXPP::generateGUIDForgotPassword(8);
                        $use_username = $this->config->item('use_username', 'tank_auth');
                        $email_activation = $this->config->item('email_activation', 'tank_auth');
                        $login_type = 1;    //type 0 = client user / 1 = partner user
                        $phone_password = FXPP::RandomizeCharacter(7);
                        $user_inser_data = $this->tank_auth->create_user(
                            $use_username,
                            $this->input->post('email', true),
                            $generatePass,
                            $email_activation,
                            1,
                            $login_type,
                            $phone_password
                        );

                        $partner_id = $user_inser_data['user_id'];
                        $data['random_alpha_string_analytics'] = '';
                        $data['random_alpha_string_analytics'] = 'z42esbsn4yqu2p';
                        $data['save_hash'] = array(
                            'first_login_hash' => $data['random_alpha_string_analytics'],
                            'first_login_stat' => 1
                        );
                        $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                        $profile = array(
                            'full_name' => $this->input->post('fullname', true),
                            'user_id' => $partner_id,
                            'country' => $this->input->post('country', true),
                            'skype' => $this->input->post('skype', true)
                        );
                        $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                        $web = $this->input->post('websites', true);
                        $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                        if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                            $this->session->set_userdata('isChina', '1');
                        }

                        $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency'));
                        /*registration_log*/
                        //$this->load->model('Logs_model');
                        $profilelog = $profile;
                        $profilelog['date']= FXPP::getCurrentDateTime();
                        $data['log']=array(
                            'partner_id'=>$partner_id,
                            'record0'=>json_encode($profilelog),
                            'registration_type'=> $affiliate_type = $this->input->post('affiliate_type',true),
                            'date'=> FXPP::getCurrentDateTime()
                        );

                        $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);

                        $service_data = array(
                            'address' => '',
                            'city' => '',
                            'country' => $this->general_model->getCountries($this->input->post('country', true)),
                            'email' => $this->input->post('email', true),
                            'group' => $groupCurrency,
                            'leverage' => '',
                            'name' => $this->input->post('fullname', true),
                            'phone_number' => $this->input->post('phone_number', true),
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
                            $reference_number = $WebService->get_result('LogIn');
                            $TraderPassword = $WebService->get_result('TraderPassword');
                            $partnership_details = array(
                                'reference_num' => $reference_number, //FXPP::getCustomReferenceNum()
                                'phone_number' => $this->input->post('phone_number', true),
                                'target_country' => $this->input->post('target_country', true),
                                'message' => $this->input->post('message', true),
                                'websites' => $websites,
                                'type_of_partnership' => $affiliate_type,
//                                    =$this->input->post('affiliate_type', true),
                                'status_type' => $this->input->post('status_type', true),
                                'company_name' => $this->input->post('company_name', true),
                                'registration_number' => $this->input->post('registration_number', true),
                                'date_of_incorporation' => $this->input->post('date_of_inc', true),
                                'partner_id' => $partner_id,
                                'currency' => $this->input->post('currency', true),
                                'phone_password' => $phone_password,
                                'trader_password' =>$TraderPassword
                            );
                            $this->general_model->insert('partnership', $partnership_details);
                            /*registration_log*/
                            $service_datalog = $service_data;
                            $service_datalog['date']= FXPP::getCurrentDateTime();
                            $service_datalog['error']= false;
                            $data['log'] = array(
                                'API1'=>json_encode($service_datalog),
                                'record1'=>json_encode($partnership_details)
                            );
                            $Logsupdate = $this->Logs_model->update_log($table='partnership_log',$field='partner_id',$id=$partner_id,$data=$data['log']);
                            /*registration_log*/
                            if($affiliate_type=='cpa'){

                                $generatePass2 = FXPP::generateGUIDForgotPassword(8);
                                $use_username = $this->config->item('use_username', 'tank_auth');
                                $email_activation = $this->config->item('email_activation', 'tank_auth');
                                $login_type = 1;    //type 0 = client user / 1 = partner user
                                $phone_password =  FXPP::RandomizeCharacter(7);
                                $user_inser_data = $this->tank_auth->create_user(
                                    $use_username,
                                    $this->input->post('email',true),
                                    $generatePass2,
                                    $email_activation,
                                    1,
                                    $login_type,
                                    $phone_password
                                );
                                $partner_id2 = $user_inser_data['user_id'];
                                $WebService2 = new WebService($webservice_config);
                                $WebService2->open_account_standard($service_data);
                                if( $WebService2->request_status === 'RET_OK' ) {
                                    $reference_number2 = $WebService2->get_result('LogIn');
                                    $partnership_details = array(
                                        'reference_num' => $reference_number2,
                                        'phone_number' => $this->input->post('phone_number',true),
                                        'target_country' => $this->input->post('target_country',true),
                                        'message' => $this->input->post('message',true),
                                        'websites' => $websites,
                                        'type_of_partnership' => 'cpa',
                                        'status_type' => $this->input->post('status_type',true),
                                        'company_name' => $this->input->post('company_name',true),
                                        'registration_number' => $this->input->post('registration_number',true),
                                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                                        'partner_id' => $partner_id2,
                                        'currency' => $this->input->post('currency',true),
                                        'phone_password' => $phone_password,
                                        'reference_subnum' => $reference_number
                                    );
                                    $this->general_model->insert('partnership', $partnership_details);

                                    /*registration_log*/
                                    $service_datalog = $service_data;
                                    $service_datalog['date']= FXPP::getCurrentDateTime();
                                    $service_datalog['error']= false;
                                    $partnership_details['date']=FXPP::getCurrentDateTime();
                                    $data['log'] = array(
                                        'API2'=>json_encode($service_datalog),
                                        'record2'=>json_encode($partnership_details)
                                    );
                                    $Logsupdate = $this->Logs_model->update_log($table='partnership_log',$field='partner_id',$id=$partner_id,$data=$data['log']);

                                    /*registration_log*/

                                }else{
                                    /*Error Creation of second(2nd) account*/
                                    /*registration_log*/
                                    $service_datalog['date']= FXPP::getCurrentDateTime();
                                    $service_datalog['error']= true;
                                    $data['log'] = array(
                                        'API2'=>json_encode($service_datalog),
                                        'record2'=>'N/A'
                                    );
                                    $Logsupdate = $this->Logs_model->update_log($table='partnership_log',$field='partner_id',$id=$partner_id,$data=$data['log']);
                                    /*registration_log*/
                                }
                            }
                            if($affiliate_type=='cpa'){
                                $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                                $partnership_affiliate = array(
                                    'partner_id' => $partner_id2,
                                    'affiliate_code' => $generateAffiliateCode
                                );
                                $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);
                            }else{
                                $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                                $partnership_affiliate = array(
                                    'partner_id' => $partner_id,
                                    'affiliate_code' => $generateAffiliateCode
                                );
                                $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);
                            }

                            $partnership_authdetails = array(
                                'email' => $this->input->post('email', true),
                                'password' => $generatePass,
                                'fullname' => $this->input->post('fullname', true),
                                'phone_password' => $phone_password,
                                'account_number' => $reference_number,
                                'trader_password' =>$TraderPassword
                            );

                            $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                            $this->fx_mailer->partnersdetails($this->input->post('email', true), $partnership_details, $profile);

                            $fullname = $this->input->post('fullname',true);
                            $email = $this->input->post('email',true);
                            $country = $this->input->post('country',true);

                            FXPP::createPeriodicMailerPartner($email, $fullname,$country);
                            /*registration_log*/
                            $lastdetails=array(
                                'date'=>FXPP::getCurrentDateTime(),
                                'affiliate_code'=>$generateAffiliateCode

                            );
                            $data['log'] = array(
                                'record3'=>json_encode($lastdetails)
                            );
                            $Logsupdate = $this->Logs_model->update_log($table='partnership_log',$field='partner_id',$id=$partner_id,$data=$data['log']);
                            /*registration_log*/

//                            $this->session->set_flashdata("success", 'ok');
//                            $data['postsubmited'] = "done";
                           // redirect(FXPP::www_url('Affiliate_program'));

                        }else{
                            /*Error Creation of first(1st) account*/

                            /*registration_log*/
                            $service_datalog['date']= FXPP::getCurrentDateTime();
                            $service_datalog['error']= true;
                            $data['log'] = array(
                                'API1'=>json_encode($service_datalog),
                                'record1'=>'N/A'
                            );
                            $Logsupdate = $this->Logs_model->update_log($table='partnership_log',$field='partner_id',$id=$partner_id,$data=$data['log']);
                            /*registration_log*/
                        }
                    }
                    $data['postsubmited'] = "done";
                    $this->session->set_flashdata("success", 'ok');
                    

                }

                $this->lang->load('affiliateprogram');
                $data['form'] = Form_key::InputKey_array();
                $set_value = isset($country)?$country:false;
                if($set_value!=false){
                    $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
                }else{
                    $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
                }
                $data['calling_code'] = '+' . $this->general_model->getCallingCode($this->country_code);
                $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
                $data['is_mobile'] = $this->is_mobile();
                $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
                $data['metadata_description'] = lang('p_reg_dsc');
                $data['metadata_keyword'] = lang('p_reg_kew');


//                $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//                $data['data']['metadata_description'] = '';
//                $data['data']['metadata_keyword'] = '';

                $this->js = $this->template->Js();
                $this->css = $this->template->Css();
                $d = "<link rel='stylesheet' href='" . $this->css . "/intlTelInput.css'>";
                $d .= " <link rel='stylesheet' href='" . $this->css . "loaders.css'/>";
                $d .= "<script src='" . $this->js . "/intlTelInput.min.js'></script>";
                $d .= "<script src='" . $this->js . "custom-partnership-registration-new.js'></script>";
                $d .= "<script src='" . $this->js . "/jquery.validate.min.js'></script>";

                $this->template->title(lang('al_pro'))
                    ->append_metadata($d)
                    ->set_layout('external/main')
                    ->build('external_affiliate_program', $data);

        }




        public function urlEncWebsites($websites)
        {
            $url = '';
            foreach ($websites as $key => $w) {
                $url[] .= urlencode($w);
            }
            return $url;
        }

        public function character_fullname($str)
        {

            if (preg_match(Cyrillic::register_page(), $str)) {
                $this->form_validation->set_message('character_fullname', lang('validate_engrus1') . ' %s ' . lang('validate_engrus2'));
                return FALSE;
            } else {
                return TRUE;
            }


        }


        public function character_email($str)
        {

            if (preg_match(Cyrillic::register_page(), $str)) {
                $this->form_validation->set_message('character_email', lang('validate_engrus1') . ' %s ' . lang('validate_engrus2'));
                return FALSE;
            } else {
                return TRUE;
            }


        }


        public function character_phone($str)
        {

            if (preg_match(Cyrillic::register_page(), $str)) {
                $this->form_validation->set_message('character_phone', lang('validate_engrus1') . ' %s ' . lang('validate_engrus2'));
                return FALSE;
            } else {
                return TRUE;
            }


        }

        public  function character_companyname($str){
            if(preg_match(Cyrillic_partnership::companyname(), $str)){
                $this->form_validation->set_message( 'character_companyname', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
                return FALSE;
            }else{
                return TRUE;
            }


        }

        public  function character_registrationnumber($str){

            if(preg_match(Cyrillic_partnership::registrationnumber(), $str)){
                $this->form_validation->set_message( 'character_registrationnumber', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
                return FALSE;
            }else{
                return TRUE;
            }


        }
    }


//else{
//
//    class Affiliate_program extends MY_Controller {
//
//        public function index(){
//            $this->lang->load('affiliateprogram');
//            $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//            $data['data']['metadata_description'] = '';
//            $data['data']['metadata_keyword'] = '';
//            $this->template->title("Affiliate Program | Forexmart")
//                ->set_layout('external/main')
//                ->build('external_affiliate_program', $data['data']);
//        }
//    }
//}