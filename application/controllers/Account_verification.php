<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_verification extends MY_Controller {

	public function index(){
		$this->lang->load('accountverification');
		$data['data'] = '';
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('act_ver_tit');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('act_ver_kew');
		$this->template->title(lang('act_ver_tit'))
			->append_metadata_js("
                ")
			->set_layout('external/main')
			->build('external_AccountVerification', $data['data']);
	}
}
