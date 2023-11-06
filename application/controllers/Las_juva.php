<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Las_juva extends MY_Controller {

	public function index(){
		$this->lang->load('lasjuva');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('ljv_tit');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('ljv_kew');
		$this->template->title(lang('ljv_tit'))
			->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'lightslider.css">')
			->append_metadata_js('<script src="' . $this->template->Js() . 'lightslider.js" type="text/javascript"></script>')
			->set_layout('external/main')
			->build('las_juva2', $data['data']);
	}
}
