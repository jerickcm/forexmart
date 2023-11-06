<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forex_charts extends MY_Controller {

	public function index(){
        if (!IPLOC::OfficeIP_forexchart()){redirect(FXPP::loc_url());}
		$this->lang->load('forexchart');

		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('x_forcha_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('x_forcha_kew');
		$this->template->title(lang('x_forcha_tit'))
			->set_layout('external/main')
			->build('external_forexCharts', $data['data']);
	}
    public function dev(){
        if (!IPLOC::OfficeIP_forexchart()){redirect(FXPP::loc_url());}
        $this->lang->load('forexchart');

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('x_forcha_kew');
        $this->template->title(lang('x_forcha_tit'))
            ->set_layout('external/main')
            ->build('external_forexCharts_dev', $data['data']);

    }
}
