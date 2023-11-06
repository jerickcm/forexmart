<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Risk_disclosure extends MY_Controller {

	public function index(){
		$this->lang->load('riskdisclosure');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

		//$data['data']['metadata_description'] = lang('x_ris_dis_dsc');
        $data['data']['metadata_description'] = '';
		$data['data']['metadata_keyword'] = lang('x_ris_dis_kew');

		$this->template->title(lang('x_ris_dis_tit'))

			->set_layout('external/main')
			->build('external_RiskDisclosure', $data['data']);
	}
}
