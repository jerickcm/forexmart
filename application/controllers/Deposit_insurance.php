<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_insurance extends MY_Controller {
	public function index(){
		$this->lang->load('deposit_insurance');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('di_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('di_kew');
		$this->template->title(lang('di_tit'))
			->append_metadata_js("
                ")
			->set_layout('external/main')
			->build('external_deposit_insurance', $data['data']);
	}
}
