<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_account extends MY_Controller {

	private $country_code;
	private $user_country;

	function __construct()
	{
		parent::__construct();
		$this->user_country = FXPP::getUserCountryCode();

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->country_code = FXPP::getUserCountryCode() or null;

	}

	      public function index(){

			$this->lang->load('demoaccounts');
		$illicit_country = unserialize(ILLICIT_COUNTRIES);
//
//			if(in_array(strtoupper(trim($this->country_code)), $illicit_country)) {
//				$data['data']['allowed_country'] = false;
//			}else{
//				$data['data']['allowed_country'] = true;
//
//			}

		$this->form_validation->set_rules('email', 'e-mail address', 'trim|valid_email|required|xss_clean|callback_character_check');
		$this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean|callback_character_check');
		$this->form_validation->set_message('is_unique', 'This email is already used.');
		if ($this->form_validation->run()) {
			$user_data = array(
				'email_demo' => $this->input->post('email',true),
				'full_name_demo' => $this->input->post('full_name',true)
			);
			$this->session->set_userdata($user_data);
			redirect(FXPP::loc_url('register/demo/step2'));
		}
		$data['data']['form'] = Form_key::InputKey_array();
		// $data['data']['metadata_description'] = lang('da_dsc');
              $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('da_kew');
		$this->template->title(lang('da_tit'))
			->prepend_metadata("
                        <script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>
                            ")
			->set_layout('external/main')
			->build('external_demoAccounts', $data['data']);
	}
	public  function character_check($str){
        if (preg_match(Cyrillic::register_page(), $str)) {
			$this->form_validation->set_message( 'character_check', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2') );
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
