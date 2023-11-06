<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Why_choose_us extends MY_Controller {

	public function index(){
		$this->lang->load('whychooseus');
		//$data['data']['metadata_description'] = lang('wcu_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('wcu_kew');
		$this->template->title(lang('wcu_tit'))
			->set_layout('external/main')
			->build('external_whychooseus', $data['data']);
	}
	public function two(){
        if(!IPLOC::Office_and_Vpn()){
            redirect(FXPP::www_url());
        }

		$this->lang->load('whychooseus');
		$data['data']['metadata_description'] = lang('wcu_dsc');
		$data['data']['metadata_keyword'] = lang('wcu_kew');
		$this->template->title(lang('wcu_tit'))
			->set_layout('external/main')
			->build('external_whychooseus2', $data['data']);
	}
}
