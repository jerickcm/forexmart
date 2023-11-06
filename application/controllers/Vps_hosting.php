<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vps_hosting extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load('vpshosting');
	}

	public function index(){
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('vps_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('vps_kew');
		$this->template->title(lang('vps_tit'))
			->set_layout('external/main')
			->build('external_vpsHosting', $data['data']);
	}
	public function testvps(){
        if(!IPLOC::Office_and_Vpn()){
            redirect(FXPP::loc_url());
        }
		//$to = 'imaritelle01@jourrapide.com';
		$to = 'tomhardy1293@gmail.com';
		$name = "Imari";
		Fx_mailer::vpsServices1($to,$name);
	}
}
