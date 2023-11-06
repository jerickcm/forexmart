<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Call_back extends MY_Controller {
	public function __construct(){
		parent::__construct();

	}
	public function index(){
		$this->lang->load('Callback');
		$this->load->library('tank_auth');
		$this->load->library('IPLoc');
		$this->lang->load('tank_auth');

		$captcha_registration = TRUE;
		$use_recaptcha = TRUE;


		if ($captcha_registration) {
			if ($use_recaptcha) {
				$this->form_validation->set_rules('recaptcha_response_field', 'valid confirmation code', 'trim|xss_clean|required|callback__check_recaptcha');
			} else {
				$this->form_validation->set_rules('captcha', 'valid confirmation code', 'trim|xss_clean|required|callback__check_captcha');
			}
		}

		$this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
//        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');

		if ($this->form_validation->run()) {


			$mdata = array(
				'name' => $this->input->post('name',true),
				'email' => $this->input->post('email',true),
				'account_number' => $this->input->post('account_number',true),
				'country' => $this->input->post('country',true),
				'phone' => $this->input->post('phone',true),
				'time' => $this->input->post('time',true),
				'language' => $this->input->post('language',true),
				'subject' => $this->input->post('subject',true),
				'comments' => $this->input->post('comments',true)
			);
			$email_store = array(
				'email' => $this->input->post('email',true),
				'country' => $this->input->post('country',true),
				'phone' => $this->input->post('phone',true)
			);

			$this->general_model->insert('call_back', $mdata);
			$this->session->set_flashdata('msg', 'Data Send Successful');
			$this->session->set_userdata(array('clk' =>1));

			$email=$this->input->post('email',true);
			$checkVal=$this->general_model->chechkId('email_store','email',$email);
			if($checkVal=="" or $checkVal==false) {$this->general_model->insert('email_store',$email_store);}

			$country_code= $mdata['country'];
			unset($mdata['country']);
			$array_country=$this->general_model->getCountries();
			$mdata['country']=$array_country[$country_code];
			$mdata['title']='Client Information .';
			//support@forexmart.com
			$config = array('mailtype' => 'html');
			$this->general_model->sendEmail('call-back-html', "ForexMart Callback", 'support@forexmart.com', $mdata, $config);
//			$this->general_model->sendEmail('call-back-html', "ForexMart Callback", 'testemail', $mdata, $config);

		}


		if ($captcha_registration) {
			if ($use_recaptcha) {
				$data['recaptcha_html'] = $this->_create_recaptcha();
			} else {
				$data['captcha_html'] = $this->_create_captcha();
			}
		}

		if(IPLoc::Office()){
			if($this->session->userdata('logged')){
				$fullname = $this->session->userdata('full_name');
				$email = $this->session->userdata('email');
				$this->load->model('account_model');
				$getAccountNumberByUserId = $this->account_model->getAccountNumberByUserId($this->session->userdata('user_id'));
				$account_number = $getAccountNumberByUserId['account_number'];
				$data['fullname'] = $fullname;
				$data['email'] = $email;
				$data['account_number'] = $account_number;
			}
		}


		$data['country'] = $this->general_model->getCallingCode($this->country_code);
		$ck=$this->session->userdata('clk');
		$data['pld']=0;
		if($ck!=1){$c_code=set_value('country')?set_value('country'):$this->country_code;$data['pld']=1;}else{$c_code=$this->country_code;}

		$data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), $c_code);

		//$data['metadata_description'] = lang('x_cb_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('x_cb_kew');
		$this->template->title(lang('x_cb_tit'))

			->set_layout('external/main')
			->build('external_callback', $data);
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha() {
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path' => './' . $this->config->item('captcha_path', 'tank_auth'),
			'img_url' => base_url() . $this->config->item('captcha_path', 'tank_auth'),
			'font_path' => './' . $this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size' => $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width' => $this->config->item('captcha_width', 'tank_auth'),
			'img_height' => $this->config->item('captcha_height', 'tank_auth'),
			'show_grid' => $this->config->item('captcha_grid', 'tank_auth'),
			'expiration' => $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
			'captcha_word' => $cap['word'],
			'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code) {
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float) $usec + (float) $sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;
		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
			strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha() {
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'), '', true);

		return $options . $html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha() {
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'), $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}
}
