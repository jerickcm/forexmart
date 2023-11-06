<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Live_account extends MY_Controller {

    private $country_code;
    private $user_country;

    function __construct() {
        parent::__construct();
        $this->user_country = FXPP::getUserCountryCode();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->country_code = FXPP::getUserCountryCode() or null;
    }

    public function index() {
        $this->lang->load('liveaccounts');
        $illicit_country = unserialize(ILLICIT_COUNTRIES);
//		$data['data']['allowed_country'] = true;
//		if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
//			$data['data']['allowed_country'] = false;
//		}


        $this->form_validation->set_rules('email', 'E-mail address', 'trim|valid_email|required|xss_clean|callback_character_check');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_check');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run() && FXPP::limit_15reg_24hrs() == false) {
            $user_data = array(
                'email_live' => $this->input->post('email', true),
                'full_name_live' => $this->input->post('full_name', true)
            );
            $this->session->set_userdata($user_data);
            redirect(FXPP::loc_url('register/index/step2'));
        }

        /* FXPP-7006 */
        $type = $this->uri->segment(2);
        switch ($type) {
            case 'standard': $data['data']['type'] = 1;
                break;
            case 'spread' : $data['data']['type'] = 2;
                break;
            case 'micro' : $data['data']['type'] = 4;
                break;
        }
        /* END OF FXPP-7006 */

        $data['data']['form'] = Form_key::InputKey_array();
        ///$data['data']['metadata_description'] = lang('da_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('da_kew');
        $this->template->title(lang('da_tit'))
                ->prepend_metadata("
                        <script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>

                  ")
                ->set_layout('external/main')
                ->build('external_liveAccounts', $data['data']);
    }

    public function micro() {
        $this->lang->load('liveaccounts');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean|callback_character_check');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_check');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run() && Form_key::isValid(trim($this->input->post('form_key')))) {
            $user_data = array(
                'email_live' => $this->input->post('email', true),
                'full_name_live' => $this->input->post('full_name', true),
                'regacc_type' => 'microacc',
            );
            $this->session->set_userdata($user_data);
            redirect(FXPP::loc_url('register/index/step2'));
        }
        /* FXPP-7006 */
        $data['data']['type'] = 4;
        /* END OF FXPP-7006 */
        $data['data']['form'] = Form_key::InputKey_array();
        $data['data']['metadata_description'] = lang('da_dsc');
        $data['data']['metadata_keyword'] = lang('da_kew');
        $this->template->title(lang('da_tit'))
                ->prepend_metadata("<script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>")
                ->set_layout('external/main')
                ->build('external_liveAccounts', $data['data']);
    }

<<<<<<< .mine
     public function standard(){
||||||| .r34856
        public function standard(){
=======
    public function standard() {
>>>>>>> .r36653
        $this->lang->load('liveaccounts');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean|callback_character_check');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_check');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run() && Form_key::isValid(trim($this->input->post('form_key')))) {
            $user_data = array(
                'email_live' => $this->input->post('email', true),
                'full_name_live' => $this->input->post('full_name', true)
            );
            $this->session->set_userdata($user_data);
            redirect(FXPP::loc_url('register/index/step2'));
        }
        /* FXPP-7006 */
        $data['data']['type'] = 1;
        /* END OF FXPP-7006 */
        $data['data']['form'] = Form_key::InputKey_array();
        $data['data']['metadata_description'] = lang('da_dsc');
        $data['data']['metadata_keyword'] = lang('da_kew');
        $this->template->title(lang('da_tit'))
                ->prepend_metadata("<script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>")
                ->set_layout('external/main')
                ->build('external_liveAccounts', $data['data']);
    }

    public function spread() {
        $this->lang->load('liveaccounts');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean|callback_character_check');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_check');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run() && Form_key::isValid(trim($this->input->post('form_key')))) {
            $user_data = array(
                'email_live' => $this->input->post('email', true),
                'full_name_live' => $this->input->post('full_name', true),
                'regacc_type' => 'spreadacc',
            );
            $this->session->set_userdata($user_data);
            redirect(FXPP::loc_url('register/index/step2'));
        }
        /* FXPP-7006 */
        $data['data']['type'] = 2;
        /* END OF FXPP-7006 */
        $data['data']['form'] = Form_key::InputKey_array();
        $data['data']['metadata_description'] = lang('da_dsc');
        $data['data']['metadata_keyword'] = lang('da_kew');
        $this->template->title(lang('da_tit'))
                ->prepend_metadata("<script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>")
                ->set_layout('external/main')
                ->build('external_liveAccounts', $data['data']);
    }

    public function character_check($str) {
        if (preg_match(Cyrillic::register_page(), $str)) {
            $this->form_validation->set_message('character_check', lang('validate_engrus1') . ' %s ' . lang('validate_engrus2'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
