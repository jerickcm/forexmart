<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financial_instruments extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->lang->load('FinancialInstruments');
	}

	public function index(){
		redirect(FXPP::www_url('Financial_instruments/forex'));
	}
	public function forex() {
		$data['instruments_tab_active'] = 'forex';
		$data['data']['metadata_description'] = lang('fi_dsc_f');
		$data['data']['metadata_keyword'] =  lang('fi_dsc_f_kew');
		$this->template->title( lang('fi_dsc_f_tit'))
			->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'financial-instrument.css">
                 ')
			->set_layout('external/main')
			->build('external_FinancialInstruments', $data);
	}

	public function spotmetals() {
		$data['instruments_tab_active'] = 'spotmetals';
		$data['data']['metadata_description'] = lang('fi_dsc_s');
		$data['data']['metadata_keyword'] =  lang('fi_dsc_s_kew');
		$this->template->title( lang('fi_dsc_s_tit'))
			->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'financial-instrument.css">
                 ')
			->set_layout('external/main')
			->build('external_FinancialInstruments', $data);
	}

	public function shares() {
		$data['instruments_tab_active'] = 'shares';
		$data['data']['metadata_description'] = lang('fi_dsc_c');
		$data['data']['metadata_keyword'] =  lang('fi_dsc_c_kew');
		$this->template->title( lang('fi_dsc_c_tit'))
			->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'financial-instrument.css">
                 ')
			->set_layout('external/main')
			->build('external_FinancialInstruments', $data);
	}

	public function bitcoin() {
		$data['instruments_tab_active'] = 'bitcoin';
		$data['data']['metadata_description'] = lang('fi_dsc_b');
		$data['data']['metadata_keyword'] =  lang('fi_dsc_b_kew');
		$this->template->title( lang('fi_dsc_b_tit'))
			->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'financial-instrument.css">
                 ')
			->set_layout('external/main')
			->build('external_FinancialInstruments', $data);
	}

    public function ruble(){
         //if(!IPLoc::Office()){redirect('');}
        $this->lang->load('liveaccounts');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean|callback_character_check');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_check');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run()) {

            $user_data = array(
                'email_live' => $this->input->post('email',true),
                'full_name_live' => $this->input->post('full_name',true)
            );
            $this->session->set_userdata($user_data);
            redirect(FXPP::loc_url('register/index/step2'));
        }

       // $data['data']['metadata_description'] = lang('da_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('da_kew');
        $this->template->title( lang('da_tit'))
			->prepend_metadata("
                        <script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>
                            ")
            ->set_layout('external/main')
            ->build('external_ruble', $data['data']);
    }
	public  function character_check($str){
		if(preg_match(Cyrillic::register_page(), $str)){
			$this->form_validation->set_message( 'character_check', 'The characters you have entered in the %s field are not yet supported. You can only enter English and Russian characters.' );
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
