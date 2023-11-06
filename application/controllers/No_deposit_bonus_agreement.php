<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_deposit_bonus_agreement extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->lang->load('nodepositbonusagreement');
	}
	public function index(){
        $this->config->load('lang_ndba', TRUE);
		$data['data']['bonus'] = IPLoc::bonus();

		$data['data']['check'] = $this->load->ext_view('modal', 'check', $data['data'], TRUE);
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

		if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
			$default_currency = 'EUR';
			$default_currency_symbol = '&euro;';
			$default_currency_code = 'EU';
		}else{
			$default_currency = 'USD';
			$default_currency_symbol = '&#36;';
			$default_currency_code = 'US';
		}
		$data['data']['default_currency'] = $default_currency;
		$data['data']['default_currency_symbol'] = $default_currency_symbol;
		$data['data']['default_currency_code'] = $default_currency_code;

		// $data['data']['metadata_description'] = lang('ndba_dsc');
        $data['data']['metadata_description'] = '';

		$data['data']['metadata_keyword'] = lang('ndba_kew');
		$this->template->title(lang('ndba_tit'))
			->set_layout('external/main')
			->build('external_NoDepositBonusAgreement', $data['data']);
	}
}
