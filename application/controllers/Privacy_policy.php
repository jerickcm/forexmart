<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_policy extends MY_Controller {

	public function index(){
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		$data['data']['metadata_description'] =lang('pri_pol_dsc');
		$data['data']['metadata_keyword'] = lang('pri_pol_kew');
		$this->template->title(lang('pri_pol_tit'))
			->set_layout('external/main')
			->build('external_PrivacyPolicy', $data['data']);
	}
}
