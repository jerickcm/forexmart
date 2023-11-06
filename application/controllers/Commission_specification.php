<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Commission_specification extends MY_Controller {

	public function index(){
		$this->lang->load('commissionspecification');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

		// $data['data']['metadata_description'] = lang('x_cs_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('x_cs_kew');
		$this->template->title(lang('x_cs_tit'))
			->set_layout('external/main')
			->build('external_CommissionSpecification', $data['data']);
	}
}
