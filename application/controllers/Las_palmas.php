<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Las_palmas extends MY_Controller {

	public function index(){
		$this->lang->load('laspalmas');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		$data['data']['metadata_description'] = lang('ljv_dsc');
		$data['data']['metadata_keyword'] = lang('act_ver_kew');

        $data['data']['menu_item'] = array('l_e','news','l_a','l_d','l_b','r_a','r_d','r_b','l_c','r_c','l_k');

		$this->template->title(lang('xnv_UDLP') . " | " . lang('x_b_p1-1'))
			->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'lightslider.css">')
			->append_metadata_js('<script src="' . $this->template->Js() . 'lightslider.js" type="text/javascript"></script>')
			->set_layout('external/main')
			->build('las_palmas2', $data['data']);
	}
}
