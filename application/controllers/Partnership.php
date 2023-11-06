<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partnership extends MY_Controller
{
    private $js;
    private $country_code;

    public function __construct()
    {
        parent::__construct();
//        redirect('maintenance');
        if(!IPLoc::Banned()) {
            $this->load->library('fx_mailer');
            $this->load->library('tank_auth');
            $this->load->model('user_model');
            $this->load->model('account_model');
            $this->lang->load('tank_auth');
            $this->g_m = $this->general_model;
            $this->js = $this->template->Js();online
            $this->load->helper('string');
            $this->country_code = FXPP::getUserCountryCode() or null;
            $this->lang->load('partnership');
            $this->lang->load('register');
            $this->nlanguage = FXPP::html_url();
        }else{
            show_404();
        }
    }

    public function index(){
        redirect(FXPP::loc_url('partnership/friend-referrer'));
    }

    public function is_mobile(){

        $this->load->library('user_agent');
        $is_mobile = $this->agent->is_mobile();
        $result['is_mobile'] = $is_mobile;
//        if($is_mobile){
            $userContinent = FXPP::getUserContinentCode();
            $currency = 'USD';

            if($userContinent === 'EU'){
                $getCountryCode = FXPP::getUserCountryCode();
                switch($getCountryCode){
                    case 'RU':
                        $currency = 'RUR';
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

    public function registration(){
//        if(!IPLoc::Office() && FXPP::html_url()=='zh'){  show_404(); }

        $this->lang->load('partnership');

        $this->form_validation->set_rules('affiliate_type', 'Affiliate Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        if(IPLoc::Office()){
                $this->form_validation->set_rules('status_type','Status', 'trim|required|xss_clean|callback_status_check');
                //$this->form_validation->set_message(lang('part_error_1'));
        }else{
            $this->form_validation->set_rules('status_type','Status', 'trim|required|xss_clean');
        }
        
        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');

        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false  &&  Form_key::isValid(trim($this->input->post('form_key',true)))){

            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ){
                
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password =  FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );

                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);

                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));

                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date']= FXPP::getCurrentDateTime();
                $data['log']=array(
                    'partner_id'=>$partner_id,
                    'record0'=>json_encode($profilelog),
                    'registration_type'=> $affiliate_type = $this->input->post('affiliate_type',true),
                    'date'=> FXPP::getCurrentDateTime()
                );

                $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);
                /*registration_log*/

                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);

                if( $WebService->request_status === 'RET_OK' ) {

                    $reference_number = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $partnership_details = array(
                        'reference_num' => $reference_number, //FXPP::getCustomReferenceNum()
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => $affiliate_type,
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
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
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);

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


                    $this->session->set_flashdata("success", 'ok');
                    $this->session->set_flashdata("successregistration", 'ok');
                        //start: FXPP-5267
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/registration'));
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
        }
        $data['form'] = Form_key::InputKey_array();
        $set_value = isset($country)?$country:false;
        if($set_value!=false){
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        }else{
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }
        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);
        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();

        $data['is_mobile'] = $this->is_mobile();

        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
       // $data['metadata_description'] = lang('p_reg_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('p_reg_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."custom-partnership-registration.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";
        $this->template->title(lang('p_reg_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/registration', $data);
    }

    public function friend_referrer(){

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');

        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        $this->form_validation->set_rules('form_key', 'Form Key', 'trim|xss_clean|required');

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }
        $data['success'] = false;
        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ){
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password =  FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));

                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date']= FXPP::getCurrentDateTime();
                $data['log']=array(
                    'partner_id'=>$partner_id,
                    'record0'=>json_encode($profilelog),
                    'registration_type'=>'friend_referrer',
                    'date'=> FXPP::getCurrentDateTime()
                );

                $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);

                /*registration_log*/

                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);

                if( $WebService->request_status === 'RET_OK' ) {
                    $reference_number = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $partnership_details = array(
                        'reference_num' => $reference_number, //FXPP::getCustomReferenceNum()
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'friend-referrer',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
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

                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);
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


                    $this->session->set_flashdata("success", 'ok');
                        //start: FXPP-5267 cpa
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/friend-referrer'));
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
        }

        $data['form'] = Form_key::InputKey_array();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();

        $set_value = isset($country)?$country:false;
        if($set_value!=false){
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        }else{
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }

        $data['is_mobile'] = $this->is_mobile();

        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);

      //  $data['metadata_description'] = lang('p_fri_ref_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('p_fri_ref_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= "<link rel='stylesheet' href='".$this->css."custom_partnership.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";

        $this->template->title(lang('p_fri_ref_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/friend_referrer',$data);
    }

    public function urlEncWebsites($websites){
        $url = '';
        foreach($websites as $key=>$w){
            $url[] .= urlencode($w);
        }
        return $url;
    }

//    public function test2(){
//        $test = array('https://www.google.com.ph', 'https://www.forexmart.com');
//        $sqldata = json_encode($this->test($test));
//        $sqldatadecode = json_decode($sqldata,true);
//        foreach($sqldatadecode as $s){
//            echo urldecode($s).'<br>';
//        }
//
//
//    }

    public function webmaster(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('websites[]', 'Website', 'trim|xss_clean');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');
        

        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }
        $data['success'] = false;

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ){
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password =  FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));
                    /*registration_log*/
                    $this->load->model('Logs_model');
                    $profilelog = $profile;
                    $profilelog['date']= FXPP::getCurrentDateTime();
                    $data['log']=array(
                        'partner_id'=>$partner_id,
                        'record0'=>json_encode($profilelog),
                        'registration_type'=>'webmaster',
                        'date'=> FXPP::getCurrentDateTime()
                    );

                    $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);

                    /*registration_log*/
                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $reference_number = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');

                    $partnership_details = array(
                        'reference_num' => $reference_number,
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'webmaster',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
                        'phone_password' => $phone_password,
                        'trader_password'=>$TraderPassword
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


                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);
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

                    $data['success'] = true;


                    $this->session->set_flashdata("successWeb", 'ok');
                        //start: FXPP-5267 cpa
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/webmaster'));

                }else{
                    $partnership_details = array(
                        'reference_num' => '',
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'webmaster',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_o,ner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
                        'phone_password' => $phone_password

                    );
                    $this->general_model->insert('partnership', $partnership_details);

                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    /*Error Creation of first(1st) account*/

                    /*registration_log*/
                    $service_datalog['date']= FXPP::getCurrentDateTime();
                    $service_datalog['error']= true;
                    $lastdetails=array(
                        'date'=>FXPP::getCurrentDateTime(),
                        'affiliate_code'=>$generateAffiliateCode

                    );
                    $data['log'] = array(
                        'API1'=>json_encode($service_datalog),
                        'record1'=>json_encode($partnership_details),
                        'record3'=>json_encode($lastdetails)
                    );
                    $Logsupdate = $this->Logs_model->update_log($table='partnership_log',$field='partner_id',$id=$partner_id,$data=$data['log']);
                    /*registration_log*/

                }
            }
        }
        $data['form'] = Form_key::InputKey_array();
        $set_value = isset($country)?$country:false;
        if($set_value!=false){
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        }else{
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }

        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);

        $data['is_mobile'] = $this->is_mobile();

        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
       // $data['metadata_description'] = lang('p_web_mas_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('p_web_mas_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";

        $this->template->title(lang('p_web_mas_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/webmaster', $data);
    }

    public function online_partner(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        $data['success'] = false;
        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ){
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password =  FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));

                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date']= FXPP::getCurrentDateTime();
                $data['log']=array(
                    'partner_id'=>$partner_id,
                    'record0'=>json_encode($profilelog),
                    'registration_type'=>'online_partner',
                    'date'=> FXPP::getCurrentDateTime()
                );

                $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);
                /*registration_log*/


                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $reference_number = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $partnership_details = array(
                        'reference_num' => $reference_number,
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'online-partner',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
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
                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode,
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);

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

                    $data['success'] = true;

                    $this->session->set_flashdata("successop", 'ok');
                        //start: FXPP-5267 cpa
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/online-partner'));
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
        }
        $data['form'] = Form_key::InputKey_array();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $set_value = isset($country)?$country:false;
        if($set_value!=false){
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        }else{
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }

        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);
        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
      //  $data['metadata_description'] = lang('p_onl_par_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('p_onl_par_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";
        $this->template->title(lang('p_onl_par_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/online_partner',$data);
    }

    public function local_online_partner(){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }
        $data['success'] = false;

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ){
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password =  FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));
                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date']= FXPP::getCurrentDateTime();
                $data['log']=array(
                    'partner_id'=>$partner_id,
                    'record0'=>json_encode($profilelog),
                    'registration_type'=>'local_online_partner',
                    'date'=> FXPP::getCurrentDateTime()
                );

                $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);
                /*registration_log*/
                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $reference_number = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $partnership_details = array(
                        'reference_num' => $reference_number,
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'local-online-partner',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency'),
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
                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);

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
                    $data['success'] = true;


                    $this->session->set_flashdata("successlop", 'ok');
                        //start: FXPP-5267 cpa
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/local-online-partner'));
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

        }

        $data['form'] = Form_key::InputKey_array();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $set_value = isset($country)?$country:false;
        if($set_value!=false){
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        }else{
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }
        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);

        $data['is_mobile'] = $this->is_mobile();

        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
      //  $data['metadata_description'] = lang('p_loc_onl_dsc');
        $data['metadata_description'] = '';
        $data['metadata_keyword'] = lang('p_loc_onl_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";
        $this->template->title(lang('p_loc_onl_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/local_online_partner', $data);
    }

    public function local_office_partner(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }
        $data['success'] = false;

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ) {
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password = FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency'));
                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date']= FXPP::getCurrentDateTime();
                $data['log']=array(
                    'partner_id'=>$partner_id,
                    'record0'=>json_encode($profilelog),
                    'registration_type'=>'local_office_partner',
                    'date'=> FXPP::getCurrentDateTime()
                );
                $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);
                /*registration_log*/
                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country')),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
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
                        'reference_num' => $reference_number,
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'local-office-partner',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
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
                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);
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

                    $data['success'] = true;

                    $this->session->set_flashdata("successlocalop", 'ok');
                        //start: FXPP-5267
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/local-office-partner'));
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
        }

        $data['form'] = Form_key::InputKey_array();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $set_value = isset($country)?$country:false;
        if($set_value!=false){
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        }else{
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }
        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);

        $data['is_mobile'] = $this->is_mobile();

        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
       // $data['metadata_description'] = lang('p_loc_off_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('p_loc_off_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";
        $this->template->title(lang('p_loc_off_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/local_office_partner', $data);
    }


    public function cpa(){

         $this->load->library('IPLoc', null);
//          if(!IPLoc::WhitelistPIPCandCC()){
//          show_404();
//          }
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }
        $data['success'] = false;

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ){
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password =  FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));

                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date']= FXPP::getCurrentDateTime();
                $data['log']=array(
                    'partner_id'=>$partner_id,
                    'record0'=>json_encode($profilelog),
                    'registration_type'=>'cpa',
                    'date'=> FXPP::getCurrentDateTime()
                );

                $LogsId = $this->Logs_model->insert_log($table="partnership_log",$data['log']);

                /*registration_log*/


                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $reference_number = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $partnership_details = array(
                        'reference_num' => $reference_number,
                        'phone_number' => $this->input->post('phone_number'),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'cpa',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
                        'phone_password' => $phone_password,
                        'trader_password' => $TraderPassword
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


//          if(IPLoc::WhitelistPIPCandCC()){
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
                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();

                    $partnership_affiliate = array(
                        'partner_id' => $partner_id2,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);
//          }else{
//              $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
//              $partnership_affiliate = array(
//                  'partner_id' => $partner_id,
//                  'affiliate_code' => $generateAffiliateCode
//              );
//              $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);
//          }

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);
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

                    $data['success'] = true;

                    $this->session->set_flashdata("successlocalop", 'ok');
                    $this->session->set_flashdata("testing", 'michi');
                        //start: FXPP-5267 cpa
                        $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                        $this->session->set_flashdata("userdet2", $generatePass);
                        //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/cpa'));
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
        } else {
            $this->session->set_flashdata("testing", 'mochi');
        }

        $data['form'] = Form_key::InputKey_array();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//        if(IPLoc::Office()){
            $set_value = isset($country)?$country:false;
            if($set_value!=false){
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
            }else{
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
            }

//        }else{
//            $data['countries'] = $this->general_model->selectOptionList_cpa($this->general_model->getAllCountries(), $this->country_code);
//            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
//            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), $this->country_code);
//        }
        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);

        $data['is_mobile'] = $this->is_mobile();

        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
       // $data['metadata_description'] = lang('p_cpa_dsc');
        $data['metadata_description'] = '';
        $data['metadata_keyword'] = lang('p_cpa_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";
        $this->template->title(lang('p_cpa_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/cpa', $data);
    }

    public function isUniqueAffiliateCode($affiliateCode){
        $this->load->model('user_model');
        $checkAffiliateCode = $this->user_model->checkAffiliateCode($affiliateCode);
        return $checkAffiliateCode;
    }

    public function Advantages(){
        $this->lang->load('advantages');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = lang('x_ap_dsc');
		$data['data']['metadata_keyword'] = lang('x_ap_kew');
		$this->template->title(lang('x_ap_tit'))
            ->set_layout('external/main')
            ->build('external_Advantages',$data['data']);
    }

    public function affiliate_program(){
        $this->template->title("Partnership | Affiliate Program")
                ->set_layout('external/main')
                ->build('partnership/affiliate_program');
    }

    public function extra_partnership(){
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'Integrate our eye-catching, sophisticated banner on your website, blog, or personal site to advertise our offerings.';
        $data['data']['metadata_keyword'] = 'ForexMart Extra Partnership';

        $this->template->title("ForexMart Extra Partnership")
            ->set_layout('external/main')
            ->build('external_extra_partnership', $data['data']);
    }

    public function getnullaffiliatecode(){

        $getnull = $this->account_model->getAllNullAffiliateCode();
        foreach($getnull as $r){
            $this->fx_mailer->partners_registration_recoveraffiliatecode($r['email'], $r['full_name'], $r['affiliate_code']);
        }
    }
    public function test_automails(){
        $a = 'mariaclove04@gmail.com';
        $b = 'Programmer J';
        $c = 'test_affiliate_code';
        $d = 'testing';
        $e = '123456';
        $partnership_authdetails = array(
            'email' => $a,
            'password' => $d,
            'fullname' => $b,
            'phone_password' => $d,
            'account_number'=>$e,
            'trader_password' =>$d
        );
        $partnership_affiliate = array(
            'partner_id' => $e,
            'affiliate_code' => $c
        );
        $partnership_details = array(
            'reference_num' => $e,
            'phone_number' => $d,
            'target_country' => $d,
            'message' => $d,
            'websites' => $d,
            'type_of_partnership' => 'local-office-partner',
            'status_type' => $d,
            'company_name' => $d,
            'registration_number' => $d,
            'date_of_incorporation' => $d,
            'partner_id' =>$e,
            'currency' => $d,
            'phone_password' => $d,
            'trader_password'=>$d
        );
        $profile = array(
            'full_name' =>$b,
            'user_id' => $e,
            'country' => $d,
            'skype' => $d
        );
//        $this->fx_mailer->partners_registration_recoveraffiliatecode($a, $b, $c);
//        $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
//        $this->fx_mailer->partnersdetails($a, $partnership_details, $profile);
//        Fx_mailer::HundredPercentBonus($a);
        Fx_mailer::lasPalmasRussianClient($a,$d);
        Fx_mailer::EuroLicense($a,$b,$d);
        Fx_mailer::depositInsurance($a,$b,$d);
        Fx_mailer::moneyfallContest($a,$b,$d);
        Fx_mailer::callbackServices($a,$b,$d);
        Fx_mailer::vpsServices($a,$b,$d);
        Fx_mailer::leverage($a,$b,$d);
        Fx_mailer::mt5($a,$b,$d);
        Fx_mailer::rpj_racing_cooperation($a,$b,$d);
    }
    public function new_partnership(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->form_validation->set_rules('fullname', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('target_country', lang('target'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|callback_character_message');
        $this->form_validation->set_rules('status_type', 'Status', 'trim|xss_clean');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|xss_clean|required|max_length[3]');
        if($this->input->post('status_type',true) > 0){
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|callback_character_companyname');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean|callback_character_registrationnumber');
            $this->form_validation->set_rules('date_of_inc', 'Date of Incorporation', 'trim|required|xss_clean');
        }
        $data['success'] = false;

        $_SESSION['tmp_full_name']= $this->input->post('fullname',true);
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false && Form_key::isValid(trim($this->input->post('form_key',true)))){
            $country = $this->input->post('country',true);
            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( !in_array(strtoupper(trim($country)), $illicit_country) ) {
                $generatePass = FXPP::generateGUIDForgotPassword(8);
                $use_username = $this->config->item('use_username', 'tank_auth');
                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password = FXPP::RandomizeCharacter(7);
                $user_inser_data = $this->tank_auth->create_user(
                    $use_username,
                    $this->input->post('email',true),
                    $generatePass,
                    $email_activation,
                    1,
                    $login_type,
                    $phone_password
                );
                $partner_id = $user_inser_data['user_id'];
                $data['random_alpha_string_analytics']='';
                $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'] ,
                    'first_login_stat' => 1
                );
                $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);
                $profile = array(
                    'full_name' => $this->input->post('fullname',true),
                    'user_id' => $partner_id,
                    'country' => $this->input->post('country',true),
                    'skype' => $this->input->post('skype',true)
                );
                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $web = $this->input->post('websites',true);
                $websites = empty($web[0]) ? '' : json_encode($this->urlEncWebsites($web));

                if(IPLoc::isChinaIP() || $country == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $groupCurrency = $this->general_model->getGroupCurrency(3, $this->input->post('currency',true));

                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => $this->general_model->getCountries($this->input->post('country',true)),
                    'email' => $this->input->post('email',true),
                    'group' => $groupCurrency,
                    'leverage' => '',
                    'name' => $this->input->post('fullname',true),
                    'phone_number' => $this->input->post('phone_number',true),
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
                        'reference_num' => $reference_number,
                        'phone_number' => $this->input->post('phone_number',true),
                        'target_country' => $this->input->post('target_country',true),
                        'message' => $this->input->post('message',true),
                        'websites' => $websites,
                        'type_of_partnership' => 'local-office-partner',
                        'status_type' => $this->input->post('status_type',true),
                        'company_name' => $this->input->post('company_name',true),
                        'registration_number' => $this->input->post('registration_number',true),
                        'date_of_incorporation' => $this->input->post('date_of_inc',true),
                        'partner_id' => $partner_id,
                        'currency' => $this->input->post('currency',true),
                        'phone_password' => $phone_password,
                        'trader_password'=>$TraderPassword
                    );
                    $this->general_model->insert('partnership', $partnership_details);

                    $generateAffiliateCode = strtoupper(random_string('alpha', 5));
                    while ($this->isUniqueAffiliateCode($generateAffiliateCode)) {
                        $generateAffiliateCode = strtoupper(random_string('alpha', 5));
                    }
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );
                    $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $partnership_authdetails = array(
                        'email' => $this->input->post('email',true),
                        'password' => $generatePass,
                        'fullname' => $this->input->post('fullname',true),
                        'phone_password' => $phone_password,
                        'account_number'=>$reference_number,
                        'trader_password' =>$TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email',true), $partnership_details, $profile);

                    $data['success'] = true;

                    $this->session->set_flashdata("successlocalop", 'ok');
                    //start: FXPP-5267 cpa
                    $this->session->set_flashdata("userdet1", $this->input->post('email',true));
                    $this->session->set_flashdata("userdet2", $generatePass);
                    //end: FXPP-5267
                    redirect(FXPP::www_url('partnership/new_partnership'));
                }
            }
        }

        $data['form'] = Form_key::InputKey_array();
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);
        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();
        $data['metadata_description'] = lang('p_loc_off_dsc');
        $data['metadata_keyword'] = lang('p_loc_off_kew');

        $this->js    = $this->template->Js();
        $this->css   = $this->template->Css();

        $d = "<link rel='stylesheet' href='".$this->css."/intlTelInput.css'>";
        $d .= " <link rel='stylesheet' href='".$this->css."loaders.css'/>";
        $d .= "<script src='".$this->js."/intlTelInput.min.js'></script>";
        $d .= "<script src='".$this->js."/jquery.validate.min.js'></script>";
        $this->template->title(lang('p_loc_off_tit'))
            ->append_metadata($d)
            ->set_layout('external/main')
            ->build('partnership/new_partnership', $data);
    }

    public function fullname_check($text_string){
        if(preg_match("/^[ a-zA-Z0-9]+$/", $text_string) == 1) {
            // string only contain the a to z , A to Z, 0 to 9
            return TRUE;
        }else{
            $this->form_validation->set_message('fullname_check', 'The {field} is invalid');
            return FALSE;

        }

    }
    
    public function informers()
   {
        
        /* forex mart calculator */

        $this->lang->load('calculator');
        $this->lang->load('informers');
        $this->lang->load('home');
        $data['data']['CurrencyPair'] = $this->general_model->getCurrenciesPairFI();
		$data['data']['Leverage'] = $this->general_model->getFCLeverage();
		$data['data']['Volume'] = $this->general_model->getFCVolume();
		$data['data']['Currency'] = $this->general_model->getAccountCurrencyBase3();
                
        /* currency conversetion */

        $this->lang->load('currencyconversion');
        $data['data']['countries'] = $this->general_model->getCurrencyV2();
        $data['data']['flagelist'] = $this->general_model->getFlage();

		unset($data['data']['countries']['GGP']);
		unset($data['data']['countries']['TRL']);
		unset($data['data']['countries']['ANG']);
		unset($data['data']['countries']['MZN']);
		unset($data['data']['countries']['JEP']);
		unset($data['data']['countries']['IMP']);
		unset($data['data']['countries']['GHC']);
		unset($data['data']['countries']['EEK']);
		unset($data['data']['countries']['XCD']);
		unset($data['data']['countries']['TVD']);
		unset($data['data']['countries']['VEF']);

       /* news */
       $this->load->model('news_model');
       $page = 1;
       $latest_news = $this->news_model->getLatestNewsByLimit(5, (($page-1)*5), $this->nlanguage);

       $news_count = $this->news_model->getAllNewsCount2($this->nlanguage);
       $this->load->library('pagination');
       $config['base_url'] = base_url() . 'news';
       $config['total_rows'] = $news_count;
       $config['per_page'] = 5;
       $config['num_links'] = 5;
       $config['page'] = $page;
       $config['use_page_numbers'] = TRUE;
       $config['first_link'] = '&lt;';
       $config['prev_link'] = '&laquo;';
       $config['last_link'] = '&gt;';
       $config['next_link'] = '&raquo;';
       $config['full_tag_open'] = '<ul class="pagination pagination-sm news-page">';
       $config['full_tag_close'] = '</ul>';
       $config['first_tag_open'] = '<li class="latest-page">';
       $config['prev_tag_open'] = '<li class="latest-page">';
       $config['last_tag_open'] = '<li class="latest-page">';
       $config['next_tag_open'] = '<li class="latest-page">';
       $config['first_tag_close'] = '</li>';
       $config['prev_tag_close'] = '</li>';
       $config['last_tag_close'] = '</li>';
       $config['next_tag_close'] = '</li>';
       $config['uri_segment'] = 3;
       $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
       $config['cur_tag_close'] = '</a></li>';
       $config['num_tag_open'] = '<li class="latest-page">';
       $config['num_tag_close'] = '</li>';
       $this->pagination->initialize($config);
       $latest_news_page_links = $this->pagination->create_links();

       $data['data']['latest_news_page_links'] = $latest_news_page_links;
       $data['data']['latest_news'] = $latest_news;

       $data['data']['quotes'] = FXPP::getQuotes();

       $data['data']['internbank'] = array(
            '0' => '+/- 0%',
            '1' => '+/- 1%',
            '2' => '+/- 2% (Typical ATM rate)',
            '3' => '+/- 3% (Typical Credit Card rate)',
            '4' => '+/- 4% ',
            '5' => '+/- 5% (Typical Kiosk rate)'
       );
       
       
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['widget_informers_tab'] = $this->load->view('widget_informers-tab', NULL, TRUE);
        $data['data']['metadata_description'] = lang('x_ap_dsc');
	$data['data']['metadata_keyword'] = lang('x_ap_kew');
	$this->template->title(lang('x_ap_tit'))
                
            ->append_metadata_css('
                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">                
                 <link rel="stylesheet" href="' . $this->template->Css() . 'informer.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'flags16.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'flags32.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
             ')
			->append_metadata_js('
              <script src="' . $this->template->Js() . 'Moment.js" type="text/javascript"></script>
                <script src="' . $this->template->Js() . 'bootstrap-datetimepicker.min.js" ></script>
            ')
                
            ->set_layout('external/main')
            ->build('external_informers',$data['data']);
    }
                    

  public function economicCalendarIframe(){

      
        
      $limit=$this->input->get('numofRow');
        $data['calendarData'] =$this->general_model->getQueryStirngResult('calendar','*',"",$limit);

         $tickers=$this->input->get('tickers',true);
         $data['tickersArray'] = FXPP::getQuotes($tickers);

         $this->load->view('iframebox/economic_calendar', $data);
      }
      

    
    


    public function informerMajorIframe(){

       if(IPLoc::Office()){
          // header('X-Frame-Options: SAMEORIGIN');
           header('X-Frame-Options: GOFORIT');
           //header_remove("X-Frame-Options");
       }
        $tickers=$this->input->get('tickers',true);

        $uri = 3;
        if(strlen($this->uri->segment(1))==2){
            $uri = 4;
        }
        $type = $this->uri->segment($uri);
        $id = $this->uri->segment($uri+1);

        if($values = $this->g_m->where('iframe',array('id'=>$id,'type'=>$type))){
            $row = $values->row_array();

            $array = array();
            foreach( explode("&",$row['value']) as $d){
                $explode = explode("=",$d);
                $array[$explode[0]] = $explode[1];
            }

            $data['tickersArray'] = FXPP::getQuotes($array['tickers']);
            $data['value'] = $array;

            $this->load->view('iframebox/install_forex_major', $data);
        }else{

            $data['tickersArray'] = FXPP::getQuotes();
            $this->load->view('iframebox/install_forex_major', $data);
        }


    }
      
      
     public function informerCalculatorIframe(){
         
         
                $this->lang->load('calculator');
                $data['data']['CurrencyPair'] = $this->general_model->getCurrenciesPairFI();
		$data['data']['Leverage'] = $this->general_model->getFCLeverage();
		$data['data']['Volume'] = $this->general_model->getFCVolume();
		$data['data']['Currency'] = $this->general_model->getAccountCurrencyBase3();

         // Iframe value
         $uri = 3;
         if(strlen($this->uri->segment(1))==2){
             $uri = 4;
         }
         $type = $this->uri->segment($uri);
         $id = $this->uri->segment($uri+1);

         $data['data']['values'] = $this->g_m->where('iframe',array('id'=>$id,'type'=>$type));
         // Iframe value end

              $this->load->view('iframebox/install_forex_calculator',$data['data']);
      }    
      
      
      
           
     public function informerCurrencyIframe(){
         
         
                    
           /* currency conversetion */
                $this->lang->load('currencyconversion');
                $data['data']['countries'] = $this->general_model->getCurrencyV2();
                $data['data']['flagelist'] = $this->general_model->getFlage();
		unset($data['data']['countries']['GGP']);
		unset($data['data']['countries']['TRL']);
		unset($data['data']['countries']['ANG']);
		unset($data['data']['countries']['MZN']);
		unset($data['data']['countries']['JEP']);
		unset($data['data']['countries']['IMP']);
		unset($data['data']['countries']['GHC']);
		unset($data['data']['countries']['EEK']);
		unset($data['data']['countries']['XCD']);
		unset($data['data']['countries']['TVD']);
		unset($data['data']['countries']['VEF']);
                
                
                $data['data']['internbank'] = array(
                    '0' => '+/- 0%',
                    '1' => '+/- 1%',
                    '2' => '+/- 2% (Typical ATM rate)',
                    '3' => '+/- 3% (Typical Credit Card rate)',
                    '4' => '+/- 4% ',
                    '5' => '+/- 5% (Typical Kiosk rate)'
                );


         // Iframe value
         $uri = 3;
         if(strlen($this->uri->segment(1))==2){
             $uri = 4;
         }
         $type = $this->uri->segment($uri);
         $id = $this->uri->segment($uri+1);

         $data['data']['values'] = $this->g_m->where('iframe',array('id'=>$id,'type'=>$type));
         // Iframe value end


              $this->load->view('iframebox/install_forex_currency',$data['data']);
      }


    public function informer_info_Iframe(){

        ini_set('memory_limit', '-1');
        $all_client = array();
        foreach($this->account_model->getAllAccountWithoutTest() as $d){
            $all_client[$d->account_number] = array('full_name'=>$d->full_name,'country'=>$d->country);
        }

        $this->load->library('WebService');
        $commissions = array();
        $amount = array();
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->GetTopAccountsTotalCommissions();
        if($WebService->request_status == "RET_OK"){

            $res =  $WebService->result['TopCommissionsList']->TopCommissionData;

            if(count($res)>0){
                foreach($res as $d){
                    $commissions[$d->Account] = $d;
                }
            }
        }

        $WebService1 = new WebService($webservice_config);
        $WebService1->GetTopaccountsTotalBalances();

        if($WebService1->request_status == "RET_OK"){

            $res =  $WebService1->result['TopBalancesList']->TopBalanceData;

            if(count($res)>0){
                foreach($res as $d){
                    $amount[$d->Account] = $d;
                }
            }
        }
        $data['data']['account'] = $amount;
        $data['data']['commissions'] = $commissions;
        $data['data']['all_client'] = $all_client;
        // Iframe value
        $uri = 3;
        if(strlen($this->uri->segment(1))==2){
            $uri = 4;
        }
        $type = $this->uri->segment($uri);
        $id = $this->uri->segment($uri+1);

        $data['data']['values'] = $this->g_m->where('iframe',array('id'=>$id,'type'=>$type));
        // Iframe value end
        $this->load->view('iframebox/install_informer_info',$data);
    }

    public function informerNewsIframe(){
        /*$width = $this->input->get('width');
        $height = $this->input->get('height');
        $num_articles = $this->input->get('numarticles');
        $bg_header = $this->input->get('bgheader');
        $bg_body = $this->input->get('bgbody');
        $bg_footer = $this->input->get('bgfooter');
        $header_font = $this->input->get('headerfont');
        $header_size = $this->input->get('headersize');
        $header_align = $this->input->get('headeralign');
        $header_color = $this->input->get('headercolor');
        $date_font = $this->input->get('datefont');
        $date_size = $this->input->get('datesize');
        $date_color = $this->input->get('datecolor');
        $text_font = $this->input->get('textfont');
        $text_color = $this->input->get('textcolor');
        $footer_font = $this->input->get('footerfont');
        $footer_color = $this->input->get('footercolor');*/

        $uri = 3;
        if(strlen($this->uri->segment(1))==2){
            $uri = 4;
        }
        $type = $this->uri->segment($uri);
        $id = $this->uri->segment($uri+1);

        if($values = $this->g_m->where('iframe',array('id'=>$id,'type'=>$type))){
            $row = $values->row_array();

            $array = array();
            foreach( explode("&",$row['value']) as $d){
                $explode = explode("=",$d);
                $array[$explode[0]] = $explode[1];
            }

            $width = $array['width'];
            $height = $array['height'];
            $num_articles = $array['numarticles'];
            $bg_header = $array['bgheader'];
            $bg_body = $array['bgbody'];
            $bg_footer = $array['bgfooter'];
            $header_font = $array['headerfont'];
            $header_size = $array['headersize'];
            $header_align = $array['headeralign'];
            $header_color = $array['headercolor'];
            $date_font = $array['datefont'];
            $date_size = $array['datesize'];
            $date_color = $array['datecolor'];
            $text_font = $array['textfont'];
            $text_color = $array['textcolor'];
            $footer_font = $array['footerfont'];
            $footer_color = $array['footercolor'];
        }

        /* news */
        $this->load->model('news_model');
        $page = 1;
        $latest_news = $this->news_model->getLatestNewsByLimit(5, (($page-1)*5), $this->nlanguage);

        $news_count = $this->news_model->getAllNewsCount2( $this->nlanguage);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'news';
        $config['total_rows'] = $news_count;
        $config['per_page'] = 5;
        $config['num_links'] = 5;
        $config['page'] = $page;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '<';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = '>';
        $config['next_link'] = '&raquo;';
        $config['full_tag_open'] = '<ul class="pagination pagination-sm news-page">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="latest-page">';
        $config['prev_tag_open'] = '<li class="latest-page">';
        $config['last_tag_open'] = '<li class="latest-page">';
        $config['next_tag_open'] = '<li class="latest-page">';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_close'] = '</li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_close'] = '</li>';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="latest-page">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $latest_news_page_links = $this->pagination->create_links();

        $data['latest_news_page_links'] = $latest_news_page_links;
        $data['latest_news'] = $latest_news;

        $data['width'] = $width;

        $data['height'] = $height;
        $data['bg_header'] = '#' . $bg_header;
        $data['bg_body'] = '#' . $bg_body;
        $data['bg_footer'] = '#' . $bg_footer;
        $data['header_font'] = $header_font;
        $data['header_size'] = $header_size . 'px';
        $data['header_align'] = $header_align;
        $data['header_color'] = '#' . $header_color;
        $data['date_font'] = $date_font;
        $data['date_size'] = $date_size . 'px';
        $data['date_color'] = '#' . $date_color;
        $data['text_font'] = $text_font;
        $data['text_color'] = '#' . $text_color;
        $data['footer_font'] = $footer_font . 'px';
        $data['footer_color'] = '#' . $footer_color;

        $this->load->view('iframebox/install_forex_news', $data);
    }
      
      
      
      
      
    public function informers_currency_conversion() {
        //essentials

        error_reporting(-1);
        $this->lang->load('currencyconversion');
        $data['data']['countries'] = $this->general_model->getCurrencyV2();

        unset($data['data']['countries']['GGP']);
        unset($data['data']['countries']['TRL']);
        unset($data['data']['countries']['ANG']);
        unset($data['data']['countries']['MZN']);
        unset($data['data']['countries']['JEP']);
        unset($data['data']['countries']['IMP']);
        unset($data['data']['countries']['GHC']);
        unset($data['data']['countries']['EEK']);
        unset($data['data']['countries']['XCD']);
        unset($data['data']['countries']['TVD']);
        unset($data['data']['countries']['VEF']);

        //essentials

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['widget_informers_tab'] = $this->load->view('widget_informers-tab', NULL, TRUE);
        $data['data']['metadata_description'] = lang('x_ap_dsc');
        $data['data']['metadata_keyword'] = lang('x_ap_kew');
        $this->template->title(lang('x_ap_tit'))
            ->append_metadata_css('
                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2-bootstrap.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">
                 ')
            ->append_metadata_js('
                <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
                <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
                <script src="' . $this->template->Js() . 'select2.js" type="text/javascript"></script>
                <script src="' . $this->template->Js() . 'Moment.js" type="text/javascript"></script>
                <script src="' . $this->template->Js() . 'bootstrap-datetimepicker.min.js" ></script>
                <script src="' . $this->template->Js() . 'canvasjs.min.js" ></script>
            ')
//            ->append_metadata_css('
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2-bootstrap-v2.css">
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2v4.0.2.min.css">
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
//                  <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">
//                 ')
//            ->append_metadata_js('
//                <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
//                <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
//                <script src="' . $this->template->Js() . 'select2v4.0.2.js" type="text/javascript"></script>
//                <script src="' . $this->template->Js() . 'Moment.js" type="text/javascript"></script>
//                <script src="' . $this->template->Js() . 'bootstrap-datetimepicker.min.js" ></script>
//                <script src="' . $this->template->Js() . 'canvasjs.min.js" ></script>
//            ')
            ->set_layout('external/main')
            ->build('widget_currency-conversion',$data['data']);
    }
    public function informers_forex_major() {
        //essentials
        //essentials
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['widget_informers_tab'] = $this->load->view('widget_informers-tab', NULL, TRUE);
        $data['data']['metadata_description'] = lang('x_ap_dsc');
        $data['data']['metadata_keyword'] = lang('x_ap_kew');
        $this->template->title(lang('x_ap_tit'))
            ->set_layout('external/main')
            ->build('external_informers',$data['data']);
    }
    public function informers_forex_calculator() {
        //essentials
        //essentials
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['widget_informers_tab'] = $this->load->view('widget_informers-tab', NULL, TRUE);
        $data['data']['metadata_description'] = lang('x_ap_dsc');
        $data['data']['metadata_keyword'] = lang('x_ap_kew');



        $this->template->title(lang('x_ap_tit'))
            ->set_layout('external/main')
            ->build('external_informers',$data['data']);
    }
    public function informers_company_news() {
        //essentials
        //essentials
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['widget_informers_tab'] = $this->load->view('widget_informers-tab', NULL, TRUE);
        $data['data']['metadata_description'] = lang('x_ap_dsc');
        $data['data']['metadata_keyword'] = lang('x_ap_kew');
        $this->template->title(lang('x_ap_tit'))
            ->set_layout('external/main')
            ->build('external_informers',$data['data']);
    }
    public function informers_economic_calendar() {
        //essentials
        //essentials
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['widget_informers_tab'] = $this->load->view('widget_informers-tab', NULL, TRUE);

        $data['data']['metadata_description'] = lang('x_ap_dsc');
        $data['data']['metadata_keyword'] = lang('x_ap_kew');
        $this->template->title(lang('x_ap_tit'))
            ->set_layout('external/main')
            ->build('external_informers',$data['data']);
    }

    public function updateNewsLatestPage( $page = 1 ){
        if($this->input->is_ajax_request()){
            $this->load->model('news_model');
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }

            $latest_news = $this->news_model->getLatestNewsByLimit(5, (($page-1)*5), $this->nlanguage);
            $news_count = $this->news_model->getAllNewsCount2($this->nlanguage);
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '<';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '>';
            $config['next_link'] = '&raquo;';
            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="latest-page">';
            $config['prev_tag_open'] = '<li class="latest-page">';
            $config['last_tag_open'] = '<li class="latest-page">';
            $config['next_tag_open'] = '<li class="latest-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';
            $config['uri_segment'] = 3;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $latest_news_page_links = $this->pagination->create_links();
            $latest_news_html = '';
            foreach( $latest_news as $key => $news ){

                $latest_news_html .= '<div class="forexnews-holder">
                    <p class="news-date">' . date('Y-m-d H:i', strtotime($news['date_created'])) . '</p>
                    <h2 class="forexnews-text"> ' . $news['headline'] . ' </h2>
                    <a target="_blank" href="' . base_url('news/article/' . $news['id']) . '" class="forexnews-more">Read More</a>
                    <div class="clearfix"></div>
                    </div>';
            }

           // $str = preg_replace('/\x{feff}$/u', '', $latest_news_html);
           // echo json_encode(array('html_data' =>$str, 'html_page_links' => $latest_news_page_links));
            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $latest_news_html, 'html_page_links' => $latest_news_page_links)));
        }
    }
    public  function character_check($str){

            if(preg_match(Cyrillic_partnership::check(), $str)){
                $this->form_validation->set_message( 'character_check', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
                return FALSE;
            }else{
                return TRUE;
            }


    }
    public  function character_fullname($str){

            if(preg_match(Cyrillic_partnership::fullname(), $str)){
                $this->form_validation->set_message( 'character_fullname', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
                return FALSE;
            }else{
                return TRUE;
            }


    }
    public  function character_email($str){

            if(preg_match(Cyrillic_partnership::email(), $str)){
                $this->form_validation->set_message( 'character_email', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2') );
                return FALSE;
            }else{
                return TRUE;
            }


    }
    public  function character_phone($str){

            if(preg_match(Cyrillic_partnership::phone(), $str)){
                $this->form_validation->set_message( 'character_phone',lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
                return FALSE;
            }else{
                return TRUE;
            }


    }
    public  function character_message($str){

            if(preg_match(Cyrillic_partnership::message(), $str)){
                $this->form_validation->set_message( 'character_message', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
                return FALSE;
            }else{
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
    public function status_check($str){
        if($str==''){
            $this->form_validation->set_message( 'status_check', lang('part_error_1') );
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function iframValues(){

        if($this->input->is_ajax_request()){

            $values = array(
                'session_id'=>$this->input->post('session_id'),
                'value'=>$this->input->post('value',true),
                'type'=>$this->input->post('type',true)
            );

            if($row = $this->g_m->where('iframe',array('session_id'=>$this->input->post('session_id'),'type'=>$this->input->post('type',true)))){

                $this->g_m->updateConditional('iframe',array('session_id'=>$this->input->post('session_id'),'type'=>$this->input->post('type',true)), $values);
                echo $row->row()->id;
            }else{
                echo  $this->g_m->insertmy('iframe',$values);
            }


        }
    }

    public function informers_registration_form(){

        if(IPLoc::Office()){
            $this->lang->load('partnership');
//        $this->load->library('form_validation');
//        if(IPLoc::Office()){
//            print_r( 'test');
//            print_r( $this->input->post('username'));
//            print_r( $this->input->post('email'));
//            print_r( $this->input->post('phone'));
//            print_r( 'errors:');
//            print_r( validation_errors() );
//            echo  validation_errors() ;
//        }

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_character_fullname');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|xss_clean|callback_character_phone');
            $this->form_validation->set_rules('form_key', 'Form Key', 'trim|xss_clean|required');

            $_SESSION['tmp_full_name']= 'Partner';
            $_SESSION['tmp_email']= $this->input->post('email',true);
            $_SESSION['tmp_login_type']= 1;

            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            $data['allowed_country'] = true;
            if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
                $data['allowed_country'] = false;
            }

            $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);
            $data['country_code'] = $this->country_code;

            $fullname = 'Partner';
            $generatePass = FXPP::generateGUIDForgotPassword(8);
            $phone_password =  FXPP::RandomizeCharacter(7);



            if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false  &&  Form_key::isValid(trim($this->input->post('form_key',true)))) {
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');

                $email_activation = $this->config->item('email_activation', 'tank_auth');
                $login_type = 1;    //type 0 = client user / 1 = partner user
                $phone_password = FXPP::RandomizeCharacter(7);

                //IF USERNAME IS ALREADY USED - INSERT A VALIDATION
                $userexists = $this->General_model->showssingle2($table = "users", $field = "username", $username, $select = "id");
                if ($userexists) {
                    $this->session->set_flashdata('userexists', 'The username is already taken.');
                    redirect(FXPP::www_url('partnership/informers_registration_form'));
                } else {
                    $user_inser_data = $this->tank_auth->create_user(
                        $username,
                        $email,
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
                        'full_name' => $fullname,
                        'user_id' => $partner_id,
                    );

                    $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                    /*registration_log*/
                    $this->load->model('Logs_model');
                    $profilelog = $profile;
                    $profilelog['date'] = FXPP::getCurrentDateTime();
                    $data['log'] = array(
                        'partner_id' => $partner_id,
                        'record0' => json_encode($profilelog),
                        'registration_type' => 'Partnership Widget',
                        'date' => FXPP::getCurrentDateTime()
                    );

                    $LogsId = $this->Logs_model->insert_log($table = "partnership_log", $data['log']);
                    /*end of registration_log*/

                    /*open account through API*/
                    $service_data = array(
                        'address' => '',
                        'city' => '',
                        'country' => '',
                        'email' => $this->input->post('email', true),
                        'group' => 'PaUS', //make US default group currency for partnership widget registration
                        'leverage' => '200', //make 200 default leverage for partnership widget registration
                        'name' => $fullname,
                        'phone_number' => $this->input->post('phone', true),
                        'state' => '',
                        'zip_code' => '',
                        'phone_password' => $phone_password
                    );

                    $webservice_config = array(
                        'server' => 'live_new'
                    );
                    $WebService2 = new WebService($webservice_config);
                    $WebService2->open_account_standard($service_data);

                    if ($WebService2->request_status === 'RET_OK') {
                        $reference_number = $WebService2->get_result('LogIn');
                        $TraderPassword = $WebService2->get_result('TraderPassword');
                        $partnership_details = array(
                            'reference_num' => $reference_number, //FXPP::getCustomReferenceNum()
                            'phone_number' => $this->input->post('phone', true),
                            'target_country' => '',
                            'message' => '',
                            'websites' => '',
                            'type_of_partnership' => '', //$affiliate_type,
                            'status_type' => '',
                            'company_name' => '',
                            'registration_number' => '',
                            'date_of_incorporation' => '',
                            'partner_id' => $partner_id,
                            'currency' => '',
                            'phone_password' => $phone_password,
                            'trader_password' => $TraderPassword
                        );

                        $this->general_model->insert('partnership', $partnership_details);

                        /*registration_log*/
                        $service_datalog = $service_data;
                        $service_datalog['date'] = FXPP::getCurrentDateTime();
                        $service_datalog['error'] = false;
                        $data['log'] = array(
                            'API1' => json_encode($service_datalog),
                            'record1' => json_encode($partnership_details)
                        );
                        $Logsupdate = $this->Logs_model->update_log($table = 'partnership_log', $field = 'partner_id', $id = $partner_id, $data = $data['log']);
                        /*registration_log*/

                        $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                        $partnership_affiliate = array(
                            'partner_id' => $partner_id,
                            'affiliate_code' => $generateAffiliateCode
                        );

                        $print = $this->General_model->insert('partnership_affiliate_code', $partnership_affiliate);

                        $fullname = 'Partner';
                        $partnership_authdetails = array(
                            'email' => $this->input->post('email', true),
                            'password' => $generatePass,
                            'fullname' => $fullname,
                            'phone_password' => $phone_password,
                            'account_number' => $reference_number,
                            'trader_password' => $TraderPassword
                        );

                        $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                        $this->fx_mailer->partnersdetails($this->input->post('email', true), $partnership_details, $profile);

                        $this->session->set_flashdata("success", 'Registration successful!');
                        $data['success_partner'] = true;
//                    print_r($this->session->flashdata("success"));
//                    exit;

                        $email = $this->input->post('email', true);
                        $country = '';

                        FXPP::createPeriodicMailerPartner($email, $fullname, $country);

                        /*registration_log*/
                        $lastdetails = array(
                            'date' => FXPP::getCurrentDateTime(),
                            'affiliate_code' => $generateAffiliateCode

                        );
                        $data['log'] = array(
                            'record3' => json_encode($lastdetails)
                        );
                        $Logsupdate = $this->Logs_model->update_log($table = 'partnership_log', $field = 'partner_id', $id = $partner_id, $data = $data['log']);
                        /*registration_log*/


                        redirect(FXPP::www_url('partnership/informers_registration_form'));
                    } else {
                        /*Error Creation of first(1st) account*/
                        /*registration_log*/
                        $service_datalog['date'] = FXPP::getCurrentDateTime();
                        $service_datalog['error'] = true;
                        $data['log'] = array(
                            'API1' => json_encode($service_datalog),
                            'record1' => 'N/A'
                        );
                        $Logsupdate = $this->Logs_model->update_log($table = 'partnership_log', $field = 'partner_id', $id = $partner_id, $data = $data['log']);
                        /*registration_log*/
                    }
                }
            }
            else if(FXPP::limit_15reg_24hrs_p()==true){
                $this->session->set_flashdata("limit", 'You have reached your maximum limit registration for today.');
                redirect(FXPP::www_url('partnership/informers_registration_form'));
            }
            else{
                // print_r('validation errors');
                //  echo validation_errors();
            }

            $data['form'] = Form_key::InputKey_array();
            $set_value = isset($country) ? $country : false;
            if ($set_value != false) {
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
            } else {
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
            }
            $data['calling_code'] = '+' . $this->general_model->getCallingCode($this->country_code);
            $data['currency'] = $this->general_model->getPartnershipCurrency_v2();

            $data['is_mobile'] = $this->is_mobile();

            $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
            $data['metadata_description'] = '';

            $data['metadata_keyword'] = lang('p_reg_kew');

            $this->js = $this->template->Js();
            $this->css = $this->template->Css();

            $this->load->view('iframebox/install_partner_regform', $data);
        }
    }
    public function partnership_teaser_registration(){

        $this->lang->load('partnership');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_character_fullname');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|xss_clean|callback_character_phone');
        $this->form_validation->set_rules('form_key', 'Form Key', 'trim|xss_clean|required');

        $_SESSION['tmp_full_name']= 'Partner';
        $_SESSION['tmp_email']= $this->input->post('email',true);
        $_SESSION['tmp_login_type']= 1;

        $illicit_country = unserialize(ILLICIT_COUNTRIES);
        $data['allowed_country'] = true;
        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
            $data['allowed_country'] = false;
        }

        $data['calling_code'] = '+'.$this->general_model->getCallingCode($this->country_code);
        $data['country_code'] = $this->country_code;

        $fullname = 'Partner';
        $generatePass = FXPP::generateGUIDForgotPassword(8);
        // $phone_password =  FXPP::RandomizeCharacter(7);
        if($this->form_validation->run() && FXPP::limit_15reg_24hrs_p()==false  &&  Form_key::isValid(trim($this->input->post('form_key',true)))) {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');

            $email_activation = $this->config->item('email_activation', 'tank_auth');
            $login_type = 1;    //type 0 = client user / 1 = partner user
            $phone_password = FXPP::RandomizeCharacter(7);

            //IF USERNAME IS ALREADY USED - INSERT A VALIDATION
            $userexists = $this->General_model->showssingle2($table = "users", $field = "username", $username, $select = "id");
            if ($userexists) {
                $this->session->set_flashdata('userexists', 'The username is already taken.');
                redirect(FXPP::www_url('partnership/partnership-teaser-registration'));
            } else {
                $user_inser_data = $this->tank_auth->create_user(
                    $username,
                    $email,
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
                    'full_name' => $fullname,
                    'user_id' => $partner_id,
                );

                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                /*registration_log*/
                $this->load->model('Logs_model');
                $profilelog = $profile;
                $profilelog['date'] = FXPP::getCurrentDateTime();
                $data['log'] = array(
                    'partner_id' => $partner_id,
                    'record0' => json_encode($profilelog),
                    'registration_type' => 'Partnership Widget',
                    'date' => FXPP::getCurrentDateTime()
                );

                $LogsId = $this->Logs_model->insert_log($table = "partnership_log", $data['log']);
                /*end of registration_log*/

                /*open account through API*/
                $service_data = array(
                    'address' => '',
                    'city' => '',
                    'country' => '',
                    'email' => $this->input->post('email', true),
                    'group' => 'PaUS', //make US default group currency for partnership widget registration
                    'leverage' => '200', //make 200 default leverage for partnership widget registration
                    'name' => $fullname,
                    'phone_number' => $this->input->post('phone', true),
                    'state' => '',
                    'zip_code' => '',
                    'phone_password' => $phone_password
                );

                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService2 = new WebService($webservice_config);
                $WebService2->open_account_standard($service_data);

                if ($WebService2->request_status === 'RET_OK') {
                    $reference_number = $WebService2->get_result('LogIn');
                    $TraderPassword = $WebService2->get_result('TraderPassword');
                    $partnership_details = array(
                        'reference_num' => $reference_number, //FXPP::getCustomReferenceNum()
                        'phone_number' => $this->input->post('phone', true),
                        'target_country' => '',
                        'message' => '',
                        'websites' => '',
                        'type_of_partnership' => '', //$affiliate_type,
                        'status_type' => '',
                        'company_name' => '',
                        'registration_number' => '',
                        'date_of_incorporation' => '',
                        'partner_id' => $partner_id,
                        'currency' => '',
                        'phone_password' => $phone_password,
                        'trader_password' => $TraderPassword
                    );

                    $this->general_model->insert('partnership', $partnership_details);

                    /*registration_log*/
                    $service_datalog = $service_data;
                    $service_datalog['date'] = FXPP::getCurrentDateTime();
                    $service_datalog['error'] = false;
                    $data['log'] = array(
                        'API1' => json_encode($service_datalog),
                        'record1' => json_encode($partnership_details)
                    );
                    $Logsupdate = $this->Logs_model->update_log($table = 'partnership_log', $field = 'partner_id', $id = $partner_id, $data = $data['log']);
                    /*registration_log*/

                    $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                    $partnership_affiliate = array(
                        'partner_id' => $partner_id,
                        'affiliate_code' => $generateAffiliateCode
                    );

                    $print = $this->General_model->insert('partnership_affiliate_code', $partnership_affiliate);

                    $fullname = 'Partner';
                    $partnership_authdetails = array(
                        'email' => $this->input->post('email', true),
                        'password' => $generatePass,
                        'fullname' => $fullname,
                        'phone_password' => $phone_password,
                        'account_number' => $reference_number,
                        'trader_password' => $TraderPassword
                    );

                    $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                    $this->fx_mailer->partnersdetails($this->input->post('email', true), $partnership_details, $profile);

                    $this->session->set_flashdata("success", 'Registration successful!');

                    $email = $this->input->post('email', true);
                    $country = '';

                    FXPP::createPeriodicMailerPartner($email, $fullname, $country);

                    /*registration_log*/
                    $lastdetails = array(
                        'date' => FXPP::getCurrentDateTime(),
                        'affiliate_code' => $generateAffiliateCode

                    );
                    $data['log'] = array(
                        'record3' => json_encode($lastdetails)
                    );

                    $Logsupdate = $this->Logs_model->update_log($table = 'partnership_log', $field = 'partner_id', $id = $partner_id, $data = $data['log']);
                    /*registration_log*/

                    // no deposit bonus 1000 for partnership teaser registration START

                    $WebService = new WebService($webservice_config);
                    $account_info = array(
                        'Login' => $reference_number,
                        'FundTransferAccountReciever' => $reference_number,
                        'Amount' => 1000,
                        'Comment' => 'FOREXMART NO DEPOSIT BONUS',
                        'ProcessByIP' => $this->input->ip_address()
                    );

                    $WebService->open_Deposit_NoDepositBonus($account_info);

                    if ($WebService->request_status === 'RET_OK') {

                    }
                    // no deposit bonus 1000 for partnership teaser registration END



                    redirect(FXPP::www_url('partnership/partnership-teaser-registration'));
                } else {
                    /*Error Creation of first(1st) account*/
                    /*registration_log*/
                    $service_datalog['date'] = FXPP::getCurrentDateTime();
                    $service_datalog['error'] = true;
                    $data['log'] = array(
                        'API1' => json_encode($service_datalog),
                        'record1' => 'N/A'
                    );
                    $Logsupdate = $this->Logs_model->update_log($table = 'partnership_log', $field = 'partner_id', $id = $partner_id, $data = $data['log']);
                    /*registration_log*/
                }
            }
        }
        else if(FXPP::limit_15reg_24hrs_p()==true){
            $this->session->set_flashdata("limit", 'You have reached your maximum limit registration for today.');
            redirect(FXPP::www_url('partnership/partnership-teaser-registration'));
        }

        $data['form'] = Form_key::InputKey_array();
        $set_value = isset($country) ? $country : false;
        if ($set_value != false) {
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $set_value);
        } else {
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getAllCountries(), $this->country_code);
        }
        $data['calling_code'] = '+' . $this->general_model->getCallingCode($this->country_code);
        $data['currency'] = $this->general_model->getPartnershipCurrency_v2();

        $data['is_mobile'] = $this->is_mobile();

        // $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        // $data['metadata_description'] = lang('p_reg_dsc');
        //$data['metadata_description'] = '';

        // $data['metadata_keyword'] = lang('p_reg_kew');

        $this->js = $this->template->Js();
        $this->css = $this->template->Css();
        $data['tab']='';


        $this->load->view('iframebox/partner-teaser-registration', $data);
    }


}

