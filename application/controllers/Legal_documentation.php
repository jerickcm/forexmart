<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legal_documentation extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->lang->load('legaldocumentation');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('ldoc_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('ldoc_kew');
		$this->template->title(lang('ldoc_tit'))
			->append_metadata_js("")
			->set_layout('external/main')
			->build('external_LegalDocumentation', $data['data']);
	}
}