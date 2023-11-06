<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Licence_and_regulations extends MY_Controller {

	public function index(){
		$this->lang->load('licenceandregulations');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
		//$data['data']['metadata_description'] = lang('lar_desc');
		$data['data']['metadata_keyword'] = lang('lar_kew');
		$this->template->title(lang('lar_tit'))
			->set_layout('external/main')
			->build('external_licenceandregulations', $data['data']);
	}
}
