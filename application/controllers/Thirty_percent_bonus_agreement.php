<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thirty_percent_bonus_agreement extends MY_Controller {
	public function __construct(){
		parent::__construct();

	}
	public function index(){

		$this->lang->load('tpdepositbonusagreement');

		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('tpdba_dsc');
        $data['data']['metadata_description'] = '';
		$data['data']['metadata_keyword'] = lang('tpdba_kew');
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
		$this->template->title(lang('tpdba_tit'))
			->set_layout('external/main')
			->build('external_ThirtyPercentBonusAgreement', $data['data']);
	}
}
