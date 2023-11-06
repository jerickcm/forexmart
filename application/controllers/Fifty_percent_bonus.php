<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fifty_percent_bonus extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->lang->load('fpdepositbonus');
    }
    public function index(){
       // $data['data']['metadata_description'] = lang('fpdb_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('fpdb_kew');

        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
            $default_currency_symbol = '&euro;';
        }else{
            $default_currency = 'USD';
            $default_currency_symbol = '&#36;';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['default_currency_symbol'] = $default_currency_symbol;

        $this->template->title(lang('fpdb_tit'))
            ->set_layout('external/main')
            ->build('external_FiftyPercentBonus', $data['data']);
    }
}
