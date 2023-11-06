<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonuses extends MY_Controller {

	public function index(){
		$this->lang->load('bonuses');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('xbnss_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('xbnss_kew');
		$this->template->title(lang('xbnss_tit'))
			->set_layout('external/main')
			->build('external_bonuses', $data['data']);
	}
}
